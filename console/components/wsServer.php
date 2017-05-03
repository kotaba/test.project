<?php

namespace app\console\components;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

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
        echo "New client ({$conn->resourceId})\n";
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
            echo $from->resourceId . "\n";
            echo 'action is: ' . $data['action'];
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
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}