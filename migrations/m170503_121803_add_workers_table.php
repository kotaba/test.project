<?php

use yii\db\Migration;

class m170503_121803_add_workers_table extends Migration
{
    public function up()
    {
        $this->createTable(\app\models\Workers::tableName(), [
            'id' => 'INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT',
            'first_name' => 'VARCHAR(40) NOT NULL',
            'last_name' => 'VARCHAR(40) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable(\app\models\Workers::tableName());
    }
}
