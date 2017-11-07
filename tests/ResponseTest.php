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

use Normeno\Gjson\Format;
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
    private $format;

    /**
     * FormatTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->format   = new Format();
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

    /**
     * Test for success function
     *
     * @use Response::success() for the test
     *
     * @return void
     */
    public function testFlattenedSuccessResponse()
    {
        $data = [
            'items' => [
                'company'   => 'Google',
                'website'   => 'https://www.google.com/'
            ]
        ];

        $success = $this->response->success($data);
        json_decode($success);
        $checkJson = (json_last_error() == JSON_ERROR_NONE);

        $this->assertTrue($checkJson);
    }

    /**
     * Test for success function
     *
     * @use Response::success() for the test
     *
     * @return void
     */
    public function testStructuredSuccessResponse()
    {
        $data = [
            'items' => [
                'company'   => 'Google',
                'website'   => 'https://www.google.com/',
                'address'   => [
                    'line1' => '111 8th Ave',
                    'line2' => '4th Floor',
                    'state' => 'NY',
                    'city'  => 'New York',
                    'zip'   => '10011'
                ]
            ]
        ];

        $success = $this->response->success($data);
        json_decode($success);
        $checkJson = (json_last_error() == JSON_ERROR_NONE);

        $this->assertTrue($checkJson);
    }

    /**
     * Test for success function
     *
     * @use Response::success() for the test
     *
     * @return void
     */
    public function testFormattedSuccessResponse()
    {
        $collect = [
            'company_name'  => 'Google',
            'website_url'   => 'https://www.google.com/',
            'facebook_url'  => null,
            'twitter_url'   => '',
            'linkedin_url'  => 0,
            'created_at'    => '1998-09-04',
            'address'       => [
                'line_1'    => '111 8th Ave',
                'line_2'    => '4th Floor',
                'state'     => 'NY',
                'city'      => 'New York',
                'zip'       => '10011'
            ]

        ];

        $formatted = $this->format->allFormats($collect);
        $success = $this->response->success($formatted);
        json_decode($success);
        $checkJson = (json_last_error() == JSON_ERROR_NONE);

        $this->assertTrue($checkJson);
    }
}
