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

use Carbon\Carbon;

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

    public function allFormats($collect)
    {
        $formatted  = $this->convertSnakeToCamel($collect);


        if (is_array($formatted) && count($formatted) > 0) {
            $formatted = $this->loopAndFormat($formatted);
        }

        return $formatted;
    }

    /**
     * Remove empty fields (null, '' or zero)
     *
     * @param object|array $collect items
     *
     * @return array|object
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

    /**
     * Set RFC3339 format
     *
     * @param string $date Format yyyy-mm-dd
     * @param string $time Format hh:ii:ss
     *
     * @return false|string
     */
    public function setRfc3339($date = null, $time = null)
    {
        if (is_null($date)
            || !\DateTime::createFromFormat('Y-m-d', $date)
            || !\DateTime::createFromFormat('Y-m-d H:i:s', "{$date} {$time}")) {
            return false;
        }

        $format = (!is_null($time))
            ? Carbon::createFromFormat('Y-m-d H:i:s', "{$date} {$time}")
            : Carbon::createFromFormat('Y-m-d', "{$date}");

        return $format->toRfc3339String();
    }

    /**
     * Change snake case to camel case
     *
     * @param object|array $data Data to convert
     *
     * @see https://stackoverflow.com/a/3600758
     *
     * @return false|object|array
     */
    public function convertSnakeToCamel($data)
    {
        if (!is_object($data) && !is_array($data)) {
            return false;
        }

        $dataToWork = is_object($data) ? (array)$data : $data;

        foreach ($dataToWork as $k => $v) {
            $newK = strtolower($k);
            $newK = str_replace('_', '', ucwords($newK, '_'));

            $dataToWork[$newK] = $v;    // Add element
            unset($dataToWork[$k]);     // Remove element
        }

        return is_object($data) ? (object)$dataToWork : $dataToWork;
    }

    /**
     * Set ISO-6709 standard
     *
     * @param object $coords Array with lat and lng
     *
     * @return false|array
     */
    public function setIso6709($coords)
    {
        if (!is_array($coords) || count($coords) != 2) {
            return false;
        }

        $coordinates = "{$coords[0]}{$coords[1]}";

        return $coordinates;
    }

    /**
     * Format collection with all formats
     *
     * @param array $collect collect to format
     *
     * @return array
     */
    private function loopAndFormat($collect)
    {
        foreach ($collect as $k => $v) {
            if (!is_array($v)) {
                if (\DateTime::createFromFormat('Y-m-d', $v)) {
                    $collect[$k] = $this->setRfc3339($v);
                } elseif (\DateTime::createFromFormat('Y-m-d H:i:s', $v)) {
                    $collect[$k] = $this->setRfc3339($v);
                }
            }

            if (is_array($v) && count($v) > 0) { // Format snake
                $formatChild = $this->convertSnakeToCamel($v);
                $collect[$k] = $formatChild;
            }
        }

        return $collect;
    }
}
