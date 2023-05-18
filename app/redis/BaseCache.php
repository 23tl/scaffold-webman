<?php

namespace app\redis;

use support\Redis;
class BaseCache extends Redis
{
    public const OneMinute = 60;

    public const OneHour = 3600;

    public const OneDay = 86400;

    public const OneWeek = 604800;

    public const OneMonth = 2592000;

    public const OneYear = 31536000;

    public const PREFIX = '';

    /**
     * 用于格式化每个 Key 序列
     * @param string $str
     * @param ...$keys
     * @return string
     * @example self::getKey('abc_%s_%s', 1, 2)
     */
    public static function getKey(string $str, ...$keys): string
    {
        return vsprintf(static::PREFIX . $str, $keys);
    }
}