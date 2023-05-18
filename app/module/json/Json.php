<?php

namespace app\module\json;

/**
 * Class Json
 * @package app\module\json
 */
class Json
{
    /**
     * @param $data
     * @return false|string
     * @throws \JsonException
     */
    public static function encode($data)
    {
        return json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $str
     * @return array|mixed
     * @throws \JsonException
     */
    public static function decode($str)
    {
        if (empty($str)) {
            return [];
        }
        return json_decode($str, true, 512, JSON_THROW_ON_ERROR);
    }
}