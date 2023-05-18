<?php

namespace app\redis\cache;

use app\redis\BaseCache;

class UserSignCache extends BaseCache
{
    /**
     * @var string
     */
    public const USER_SIGN_KEY = 'lottery_user_sign_%d_%s';

    /**
     * 生成签到缓存
     * @param int $userId
     * @param string $date
     * @param int $ttl
     * @return bool
     */
    public static function setUserSignDayCache(int $userId, string $date, int $ttl = self::OneWeek): bool
    {
        return self::setEx(self::getKey(self::USER_SIGN_KEY, $userId, $date), $ttl, date('Y-m-d H:i:s'));
    }

    /**
     * 读取签到缓存
     * @param int $userId
     * @param string $date
     * @return bool|string
     */
    public static function getUserSignDayCache(int $userId, string $date)
    {
        return self::get(self::getKey(self::USER_SIGN_KEY, $userId, $date));
    }

}