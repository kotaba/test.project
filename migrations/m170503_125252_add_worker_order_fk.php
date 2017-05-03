<?php

use yii\db\Migration;

class m170503_125252_add_worker_order_fk extends Migration
{
    public function up()
    {
        $this->addForeignKey('fk_order_worker', \app\models\Orders::tableName(), 'worker_id',
            \app\models\Workers::tableName(), 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_order_worker', \app\models\Orders::tableName());
    }
}
