<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * This file is part of the Gjson library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP Version 5, 7
 *
 * LICENSE: This source file is subject to the MIT license that is available
 * through the world-wide-web at the following URI:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category Src
 * @package  Normeno\Gjson
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/gjson
 */

namespace Normeno\Gjson;

/**
 * Tests for Format
 *
 * @category Src
 * @package  Normeno\Gjson
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/gjson
 */
class Response
{
    /**
     * Api Version
     *
     * @var string number of version
     */
    private $apiVersion;

    /**
     * Api Context
     *
     * @var string name of context
     */
    private $context;

    /**
     * Output Format
     *
     * @var string json|array|object
     */
    private $format;

    /**
     * Response constructor.
     *
     * @param array $opts Options
     */
    public function __construct($opts = null)
    {
        $this->apiVersion  = (isset($opts['apiVersion'])) ? $opts['apiVersion'] : '1.0';
        $this->context     = (isset($opts['context'])) ? $opts['context'] : 'api';
        $this->format      = (isset($opts['format'])) ? $opts['format'] : 'json';
    }

    /**
     * Generate error response
     *
     * @param integer $code  number of error
     * @param string  $msg   message to identify error
     * @param array   $extra extra data
     *
     * @return array|object|string
     */
    public function error($code, $msg, $extra = [])
    {
        $error = [
            'error' => [
                'code'      => $code,
                'message'   => $msg
            ]
        ];

        if (!empty($extra)) {
            $extraErrors = (array_key_exists('errors', $extra)) ? $extra['errors'] : $extra;
            $error['error']['errors'] = $extraErrors;
        }

        $response = $this->basicStructure() + $error;
        return $this->output($response);
    }

    /**
     * Generate success response
     *
     * @param array   $data data
     *
     * @return array|object|string
     */
    public function success($data)
    {
        $response = $this->basicStructure() + $data;
        return $this->output($response);
    }

    /**
     * Generate basic structure
     *
     * This structure is used in all the responses
     *
     * @return array
     */
    private function basicStructure()
    {
        return [
            'apiVersion'    => $this->apiVersion,
            'context'       => $this->context
        ];
    }

    /**
     * Generate output
     *
     * @param array|object $data output data
     *
     * @return array|object|string|false
     */
    private function output($data)
    {
        switch ($this->format) {
            case 'array':
                return (array)$data;
            case 'object':
                return (object)$data;
            case 'json':
                return json_encode($data);
            default:
                return json_encode($data);
        }
    }
}
