<?php

namespace app\models;

use yii\db\ActiveRecord;

class ChangeLog extends ActiveRecord
{
    public static function tableName()
    {
        return '{{change_log}}';
    }
}