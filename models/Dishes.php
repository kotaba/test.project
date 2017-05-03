<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;
use yii\db\Expression;

/**
 * Class Dishes
 * @package app\models
 *
 */
class Dishes extends ActiveRecord
{
    public $orders_count;
    public $selled_sum;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['name', 'price'], 'safe'],
        ];
    }

    public static function tableName()
    {
        return '{{dishes}}';
    }

    /**
     * @return array
     */
    public static function getOptions()
    {
        $data = [];

        $dishes = Dishes::find()->all();

        foreach ($dishes as $dish) {
            $data[$dish->id] = $dish->name;
        }

        return $data;
    }

    /**
     * @return $this
     */
    public static function getMostPopular()
    {
        $query = Dishes::find()
            ->select(['name',
                'price',
                new Expression('COUNT(t2.dish_id) as orders_count'),
                new Expression('SUM(t1.price) as selled_sum')
            ])
            ->from('{{dishes}} as t1')
            ->join('JOIN', '{{dishes_to_orders}} as t2', 't1.id = t2.dish_id')
            ->join('JOIN', '{{orders}} as t3', 't2.order_id = t3.id')
            ->groupBy('t2.dish_id')
            ->where(new Expression('DATE(t3.created_at) = CURDATE()'));

        return $query;
    }
}