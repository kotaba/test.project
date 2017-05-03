<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Workers;
use app\models\Dishes;
use yii\db\Expression;

/**
 * Class Orders
 * @package app\models
 */
class Orders extends ActiveRecord
{

    public $dishes;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dishes'], 'required'],
            [['worker_id', 'created_at', 'dishes'], 'safe'],
        ];
    }

    public static function tableName()
    {
        return '{{orders}}';
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $rows = [];

        foreach ($this->dishes as $dish) {
            $rows[] = ['dish_id' => $dish, 'order_id' => $this->id];
        }

        \Yii::$app->db->createCommand()
            ->batchInsert('{{dishes_to_orders}}',
                ['dish_id', 'order_id'],
                $rows)
            ->execute();
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * Get single worker related to this order
     */
    public function getWorker()
    {
        return $this->hasMany(Workers::className(), ['id' => 'worker_id']);
    }

    /**
     * @return mixed
     *
     * Get worker name for this order
     */
    public function getWorkerName()
    {
        $worker = $this->getWorker()->one();

        return $worker->getName();
    }

    /**
     * @return $this
     *
     * Get dishes related to this order
     */
    public function getDishes()
    {
        return $this
            ->hasMany(Dishes::className(), ['id' => 'dish_id'])
            ->viaTable('{{dishes_to_orders}}', ['order_id' => 'id']);
    }

    /**
     * @return string
     *
     * Get name of dishes related to this order
     */
    public function getDishesNames()
    {
        $data = [];

        $dishes = $this->getDishes()->all();

        foreach ($dishes as $dish) {
            $data[] = $dish->name;
        }

        return implode(',', $data);
    }

    /**
     * @return int
     *
     * Get total sum of dishes for this order
     */
    public function getOrderSum()
    {
        $sum = 0;

        $dishes = $this->getDishes()->all();

        foreach ($dishes as $dish) {
            $sum = $sum + $dish->price;
        }

        return $sum;
    }

    /**
     * @return array
     *
     * Get sum of today orders
     */
    public static function getAllOrdersSum()
    {
        $sum = 0;

        $orders = Orders::find()
            ->where(new Expression('DATE(created_at) = CURDATE()'))
            ->all();

        foreach ($orders as $order) {
            $sum = $sum + $order->getOrderSum();
        }

        return [['id'=>1, 'sum'=>$sum]];
    }

}