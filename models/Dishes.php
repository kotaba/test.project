<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Dishes
 * @package app\models
 *
 */
class Dishes extends ActiveRecord
{
    public static function tableName()
    {
        return '{{dishes}}';
    }
}