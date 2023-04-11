<?php

namespace app\module\logs;

class Log
{
    /**
     * @return \Monolog\Logger
     */
    public static function Log()
    {
        return \support\Log::channel('daily');
    }
}