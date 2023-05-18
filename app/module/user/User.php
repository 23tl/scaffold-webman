<?php

namespace app\module\user;

use app\exception\BaseException;
use app\module\json\Json;
use app\module\logs\Log;
use app\redis\cache\services\UserCache;
use Illuminate\Support\Collection;

class User
{
    protected Collection $user;

    protected string $token;

    public function __construct()
    {
        $token = request()->header('Authorization');
        if (!$token) {
            $token = request()->input('token');
        }
        Log::Log()->info('token', ['token' => $token]);
        if (!$token) {
            throw new BaseException("请登录", 403);
        }
        $user = UserCache::getUserTokenCache($token);
        if (!$user) {
            throw new BaseException("请登录", 403);
        }
        $this->token = $token;
        $this->user = collect(Json::decode($user));
    }

    /**
     * @param string $name
     * @param string|null $default
     * @return mixed
     */
    public function get(string $name, string $default = null): string
    {
        return $this->user->get($name, $default);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * 修改用户token中储存的信息
     * @param array $data
     * @return void
     * @throws \JsonException
     */
    public function updateUserTokenInfo(array $data): void
    {
        $user = $this->user->toArray();
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $user)) {
                $user[$key] = $value;
            }
        }
        UserCache::setUserTokenCache($this->token, Json::encode($user));
        Log::Log()->info('更新用户token号码成功', ['token' => $this->token, 'userId' => $this->user->get('id'), 'mobile' => $mobile]);
    }
}