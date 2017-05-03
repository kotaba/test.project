<?php

namespace app\console\components;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

/**
 * Class wsServer
 * @package app\console\components
 *
 * Websocket server class
 */
class wsServer implements MessageComponentInterface
{
    protected $connections;

    public function __construct()
    {
        $this->connections = new \SplObjectStorage;
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->connections->attach($conn);
    }

    /**
     * @param ConnectionInterface $from
     * @param string $msg
     * @return mixed
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        if (!is_null($data)) {
            switch ($data['action']) {
                case 'refreshStats':
                    foreach ($this->connections as $client) {
                        $client->send($msg);
                    }
            }
        }
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {
        $this->connections->detach($conn);
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }
}