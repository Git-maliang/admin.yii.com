<?php

namespace app\commands;

use app\components\widgets\WebSocket;

class SiteController extends Controller
{
    public function actionService()
    {
        $config= [
            'address' => '127.0.0.1',
            'port' => '8080',
            'event' => 'event',//回调函数的函数名
            'log' => true,
        ];

        $webSocket = new WebSocket($config);
        $webSocket->run();
    }
}
