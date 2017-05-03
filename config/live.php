<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db1.ecsv.org.ua;dbname=cifrus',
            'username' => 'user',
            'password' => 's45fdfx65',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'forceCopy' => true
        ]
    ]
];

?>