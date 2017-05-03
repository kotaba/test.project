<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Workers
 * @package app\models
 */
class Workers extends ActiveRecord
{
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required']
            ];
    }

    public static function tableName()
    {
        return '{{workers}}';
    }

    /**
     * @return string
     *
     * Get fullname for worker
     */
    public function getName()
    {
        return "{$this->first_name} {$this->last_name}";

    }

    /**
     * @return array
     *
     * Get options for select
     */
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