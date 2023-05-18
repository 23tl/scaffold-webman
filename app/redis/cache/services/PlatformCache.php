<?php

namespace app\redis\cache\services;

use app\module\json\Json;
use app\redis\BaseCache;

class PlatformCache extends BaseCache
{
    /**
     * @var string
     */
    public const PLATFORM_CACHE_KEY = 'dream_platform_%s';

    /**
     * 从缓存中获取平台信息
     * @param $uuid
     * @return array|mixed
     * @throws \JsonException
     */
    public static function getPlatformCacheByUuid($uuid): mixed
    {
        $cache = self::get(self::getKey(self::PLATFORM_CACHE_KEY, $uuid));
        return Json::decode($cache);
    }

    /**
     * 判断缓存是否存在
     * @param $uuid
     * @return bool
     */
    public static function hasPlatformCacheByUuid($uuid): bool
    {
        return self::exists(self::getKey(self::PLATFORM_CACHE_KEY, $uuid));
    }

    /**
     * 设置平台缓存
     * @param $uuid
     * @param string $platform
     * @param int $ttl
     * @return bool
     */
    public static function setPlatformCache($uuid, string $platform, int $ttl = self::OneDay): bool
    {
        return self::setEx(self::getKey(self::PLATFORM_CACHE_KEY, $uuid), $ttl, $platform);
    }
}