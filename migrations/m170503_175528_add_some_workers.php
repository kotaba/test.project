<?php

use yii\db\Migration;

class m170503_175528_add_some_workers extends Migration
{
    public function up()
    {
        $data = [['id' => 1,
            'first_name' => 'Сицилия',
            'last_name' => 'Грей'],
            [
                'id' => 2,
                'first_name' => 'Анастасия',
                'last_name' => 'Равицкая'
            ],
            [
                'id' => 3,
                'first_name' => 'Александр',
                'last_name' => 'Фесько',
            ],
            [
                'id' => 4,
                'first_name' => 'Евгения',
                'last_name' => 'Мильнер'
            ],
            [
                'id' => 5,
                'first_name' => 'Женя',
                'last_name' => 'Раневская'
            ]];

        foreach ($data as $item) {
            $this->insert(\app\models\Workers::tableName(), [
                'id' => $item['id'],
                'first_name' => $item['first_name'],
                'last_name' => $item['last_name']
            ]);
        }
    }

    public function down()
    {
        $this->delete(\app\models\Workers::tableName(), [
            'id' => [1, 2, 3, 4, 5]
        ]);
    }
}
