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
class Format
{
    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        // constructor body
    }

    /**
     * Remove empty fields (null, '' or zero)
     *
     * @param object|array $collect items
     *
     * @return mixed
     */
    public function removeEmpty($collect)
    {
        $data = ( !is_array($collect) ) ? (array)$collect : $collect;

        foreach ($data as $k => $v) {
            if (empty($v)) {
                unset($data[$k]);
            }
        }

        return is_array($collect) ? $data : (object)$data;
    }
}
