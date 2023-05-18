<?php

namespace app\services;

abstract class BaseServices
{
    protected static $_instance;

    protected function __construct(){}



    public static function instance(): BaseServices
    {
        if( empty(self::$_instance[static::class]) ) {
            self::$_instance[static::class] = new static();
        }
        return self::$_instance[static::class];
    }
}