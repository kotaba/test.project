<?php

use yii\db\Migration;

class m170503_175538_add_some_dishes extends Migration
{
    public function up()
    {
        $data = [
            ['id' => 1,
                'name' => 'Курник с мойвой',
                'price' => 80],
            ['id' => 2,
                'name' => 'Чай',
                'price' => 20],
            ['id' => 3,
                'name' => 'Кофе',
                'price' => 25],
            ['id' => 4,
                'name' => 'Салат с редиской',
                'price' => 40],
            ['id' => 5,
                'name' => 'Омары под соусом',
                'price' => 150],
            ['id' => 6,
                'name' => 'Макароны',
                'price' => 15],
            ['id' => 7,
                'name' => 'Гречка',
                'price' => 25],
            ['id' => 8,
                'name' => 'Котлеты',
                'price' => 50],
            ['id' => 9,
                'name' => 'Отбивные',
                'price' => 35],
            ['id' => 10,
                'name' => 'Вода',
                'price' => 10],
            ['id' => 11,
                'name' => 'Кола',
                'price' => 15],
            ['id' => 12,
                'name' => 'Суп',
                'price' => 25],
            ['id' => 13,
                'name' => 'Борщ',
                'price' => 15],
        ];

        foreach ($data as $item) {
            $this->insert(\app\models\Dishes::tableName(), [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price']
            ]);
        }
    }

    public function down()
    {
        $this->delete(\app\models\Dishes::tableName(), [
            'id' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
        ]);
    }
}
