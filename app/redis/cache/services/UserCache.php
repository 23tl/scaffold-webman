<?php

namespace app\redis\cache\services;

use app\redis\BaseCache;

class UserCache extends BaseCache
{
    public const USER_CACHE_KEY = 'dream_user_%s';

    /**
     * @param string $token
     * @param string $data
     * @param int $ttl
     * @return bool
     */
    public static function setUserTokenCache(string $token, string $data, int $ttl = self::OneDay): bool
    {
        return self::setEx(self::getKey(self::USER_CACHE_KEY, $token), $ttl, $data);
    }

    /**
     * @param string $token
     * @return bool|string
     */
    public static function getUserTokenCache(string $token): bool|string
    {
        return self::get(self::getKey(self::USER_CACHE_KEY, $token));
    }

    /**
     * @param string $token
     * @return int
     */
    public static function delUserTokenCache(string $token)
    {
        return self::del(self::getKey(self::USER_CACHE_KEY, $token));
    }
}