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
     * @param string $apiVersion number of version
     * @param string $context    name of context
     * @param string $format     json|array|object
     */
    public function __construct($apiVersion = '1.0', $context = 'api', $format = 'json')
    {
        $this->apiVersion  = $apiVersion;
        $this->context     = $context;
        $this->format      = $format;
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
        if (empty($data)) {
            return false;
        }

        switch ($this->format) {
            case 'array':
                $response = (array)$data;
                break;
            case 'object':
                $response = (object)$data;
                break;
            case 'json':
                $response = json_encode($data);
                break;
            default:
                $response = json_encode($data);
        }

        return $response;
    }
}
