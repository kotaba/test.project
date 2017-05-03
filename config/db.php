<?php

if (gethostname() == 'instance-1') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=db1.ecsv.org.ua;dbname=cifrus',
        'username' => 'user',
        'password' => 's45fdfx65',
        'charset' => 'utf8',
    ];
} else {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=cifrus',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
    ];
}
