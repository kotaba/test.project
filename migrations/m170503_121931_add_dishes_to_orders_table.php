<?php

use yii\db\Migration;

class m170503_121931_add_dishes_to_orders_table extends Migration
{
    public function up()
    {
        $this->createTable('{{dishes_to_orders}}', [
            'dish_id' => 'INT(11) UNSIGNED NOT NULL',
            'order_id' => 'INT(11) UNSIGNED NOT NULL',
        ]);
    }

    public function down()
    {

    }
}
