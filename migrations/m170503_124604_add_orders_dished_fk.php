<?php

use yii\db\Migration;

class m170503_124604_add_orders_dished_fk extends Migration
{
    public function up()
    {
        $this->addForeignKey('fk_orders_order', '{{dishes_to_orders}}', 'order_id',
            \app\models\Orders::tableName(), 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('fk_dishes_dish', '{{dishes_to_orders}}', 'dish_id',
            \app\models\Dishes::tableName(), 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_orders_order', '{{dishes_to_orders}}');
        $this->dropForeignKey('fk_dishes_dish', '{{dishes_to_orders}}');
    }
}
