<?php

namespace app\redis\cache\services;

use app\redis\BaseCache;

class AccessTokenCache extends BaseCache
{
    /**
     * @var string
     */
    public const ACCESS_TOKEN = 'dream_access_token_%s';

    /**
     * @param string $uuid
     * @return bool|string|null
     */
    public static function getAccessTokenCache(string $uuid): bool|string|null
    {
        return self::get(self::getKey(self::ACCESS_TOKEN, $uuid));
    }

    /**
     * @param string $uuid
     * @param string $token
     * @param int $ttl
     * @return bool
     */
    public static function setAccessTokenCache(string $uuid, string $token, int $ttl = 7200): bool
    {
        return self::setEx(self::getKey(self::ACCESS_TOKEN, $uuid), $ttl, $token);
    }
}