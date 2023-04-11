<?php
/**
 * Here is your custom functions.
 */

function ok(array $data): \support\Response
{
    return json([
        'code' => 0,
        'msg' => 'ok',
        'time' => time(),
        'date' => date('Y-m-d H:i:s'),
        'data' => $data,
    ]);
}


function fail(int $code, string $msg): \support\Response
{
    return json([
        'code' => $code,
        'msg' => $msg,
        'time' => time(),
        'date' => date('Y-m-d H:i:s'),
        'data' => new stdClass(),
    ]);
}