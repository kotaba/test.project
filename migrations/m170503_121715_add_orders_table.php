<?php

use yii\db\Migration;

class m170503_121715_add_orders_table extends Migration
{
    public function up()
    {
        $this->createTable(\app\models\Orders::tableName(), [
            'id' => 'INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT',
            'created_at' => 'DATETIME NOT NULL',
            'is_payed' => 'TINYINT(1)',
            'worker_id' => 'INT(11) UNSIGNED NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable(\app\models\Orders::tableName());
    }
}
