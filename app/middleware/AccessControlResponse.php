<?php

namespace app\middleware;

use stdClass;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
class AccessControlResponse implements MiddlewareInterface
{
    public function process(Request $request, callable $handler) : Response
    {
        $data = [
            'code' => 0,
            'msg' => 'ok',
            'dateTime' => date('Y-m-d H:i:s'),
            'data' => new stdClass()
        ];
        $response = $handler($request);
        $exception = $response->exception();
        if ($exception) {
            $data['code'] = $exception->getCode() ?? 1000;
            $data['msg'] = $exception->getMessage();
            return json($data);
        }

        return $response;
    }
}