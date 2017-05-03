<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Workers
 * @package app\models
 */
class Workers extends ActiveRecord
{
    public static function tableName()
    {
        return '{{workers}}';
    }
}