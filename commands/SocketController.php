<?php

namespace app\commands;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use app\console\components\wsServer as wsComponent;
use yii\console\Controller;

class SocketController extends Controller
{
    /**
     * @param int $port
     */
    public function actionStartSocket($port=8080)
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new wsComponent()
                )
            ),
            $port
        );
        $server->run();
    }
}