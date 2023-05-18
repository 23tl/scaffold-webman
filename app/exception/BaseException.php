<?php

namespace app\exception;

use Throwable;
use Exception;

class BaseException extends Exception
{
    public function __construct($message = "系统异常", $code = 1000, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}