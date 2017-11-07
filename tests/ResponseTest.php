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
 * @category Test
 * @package  Normeno\Gjson\Test
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/gjson
 */


namespace Normeno\Gjson\Test;

use Normeno\Gjson\Response;

/**
 * Tests for Response
 *
 * @category Test
 * @package  Normeno\Gjson\Test
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/gjson
 */
class ResponseTest extends \PHPUnit\Framework\TestCase
{
    private $response;

    /**
     * FormatTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->response = new Response();
    }

    /**
     * Test for error function
     *
     * @use Response::error() for the test
     *
     * @return void
     */
    public function testError()
    {
        $error = $this->response->error(404, 'File Not Found');
        json_decode($error);
        $checkJson = (json_last_error() == JSON_ERROR_NONE);

        $this->assertTrue($checkJson);
    }

    /**
     * Test for error function with extra params
     *
     * @use Response::error() for the test
     *
     * @return void
     */
    public function testErrorWithExtra()
    {
        $extra = [
            'errors'    => [
                'domain'    => 'Calendar',
                'reason'    => 'ResourceNotFoundException',
                'message'   => 'File Not Found'
            ]
        ];

        $error = $this->response->error(404, 'File Not Found', $extra);
        json_decode($error);
        $checkJson = (json_last_error() == JSON_ERROR_NONE);

        $this->assertTrue($checkJson);
    }
}
