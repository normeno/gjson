<?php

namespace Normeno\Gjson;

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
     * Friendly welcome
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
    public function echoPhrase($phrase)
    {
        return $phrase;
    }

    /**
     * @param object|array $collect items
     *
     * @return mixed
     */
    public function removeEmpty($collect)
    {
        $data = ( !is_array($collect) ) ? (array)$collect : $collect;

        foreach ($data as $k => $v) {

            if ( empty($v) ) {
                unset($data[$k]);
            }
        }

        return is_array($collect) ? $data : (object)$data;
    }
}
