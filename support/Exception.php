<?php

namespace support;

use Throwable;
use support\exception\Handler;
use Webman\Http\Request;
use Webman\Http\Response;

class Exception extends Handler
{
    public function report(Throwable $exception): void
    {
        Log::channel('daily')->error($exception->getMessage(), [
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]);
    }
    /**
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     */
    public function render(Request $request, Throwable $exception): Response
    {
        return parent::render($request, $exception);
    }

}