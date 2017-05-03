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

    public function getName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public static function getOptions()
    {
        $data = [];

        $workers = Workers::find()->all();

        foreach ($workers as $worker) {
            $data[$worker->id] = $worker->name;
        }

        return $data;
    }
}