<?php

use yii\db\Migration;

class m170503_121741_add_dishes_table extends Migration
{
    public function up()
    {
        $this->createTable(\app\models\Dishes::tableName(), [
            'id' => 'INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT',
            'name' => 'VARCHAR(100) NOT NULL',
            'price' => 'DECIMAL(6,2) NOT NULL',
            'weight' => 'INT(11) DEFAULT 0'
        ]);
    }

    public function down()
    {
        $this->dropTable(\app\models\Dishes::tableName());
    }
}
