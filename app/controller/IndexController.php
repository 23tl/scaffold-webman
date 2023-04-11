<?php

namespace app\controller;

use app\module\logs\Log;
use app\request\TestRequest;
use support\Request;

class IndexController
{
    public function index(Request $request)
    {
        return ok([
            'name' => config('app.name'),
            'version' => '1.0.0',
            'date' => date('Y-m-d H:i:s')
        ]);
    }
}
