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

/**
 * Tests for Format
 *
 * @category Test
 * @package  Normeno\Gjson\Test
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/gjson
 */
class FormatTest extends \PHPUnit\Framework\TestCase
{
    private $_format;

    /**
     * FormatTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_format = new Format();
    }

    /**
     * Test for RemoveEmpty function
     *
     * @uses Format::removeEmpty() for the test
     *
     * @return void
     */
    public function testRemoveEmpty()
    {
        $arr = ['foo' => 'bar', 'null' => null, 'empty' => '', 'zero' => 0];
        $obj = (object)$arr;

        $formatArr  = $this->_format->removeEmpty($arr);
        $formatObj  = $this->_format->removeEmpty($obj);

        $checkArr   = in_array('null', $formatArr)
            || in_array('empty', $formatArr)
            || in_array('zero', $formatArr);

        $checkObj   = property_exists($formatObj, 'null')
            || property_exists($formatObj, 'empty')
            || property_exists($formatObj, 'zero');

        $this->assertFalse($checkArr && $checkObj);
    }
}
