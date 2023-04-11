<?php

namespace app\middleware;

use support\Log;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\Middleware;
use Webman\MiddlewareInterface;

class ResponseLogging implements MiddlewareInterface
{
    public function process(Request $request, callable $handler) : Response
    {
        $response = $handler($request);
        $responseData = [
            'params' => $request->all(),
            'response' => json_encode($response->rawBody() ?? "{}", JSON_THROW_ON_ERROR)
        ];
        Log::channel('response')->info('请求日志', $responseData);
        return $response;
    }
}