<?php

if ($_SERVER['SERVER_NAME'] == 'cifrus.test.ecsv.org.ua') {
    defined('YII_ENV') or define('YII_ENV', 'live');
} else {
    defined('YII_ENV') or define('YII_ENV', 'local');
    defined('YII_DEBUG') or define('YII_DEBUG', true);
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = \yii\helpers\ArrayHelper::merge(
    require(dirname(__FILE__).'/../config/web.php'),
    require(dirname(__FILE__).'/../config/' . YII_ENV . '.php')
);


(new yii\web\Application($config))->run();
