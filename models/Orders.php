<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Orders
 * @package app\models
 */
class Orders extends ActiveRecord {

    public static function tableName()
    {
        return '{{orders}}';
    }

}