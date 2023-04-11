<?php

namespace app\request;

use think\Validate;

class TestRequest extends Validate
{
    protected $rule = [
        'name' => 'require'
    ];

    protected $message = [
        'name.require' => '名称必须'
    ];
}