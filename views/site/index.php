<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Cafe Borsh and Herring - Main';
?>
<div class="site-index">

    <h3>Last 5 Orders</h3>
    <div class="body-content">

        <?php Pjax::begin(['id' => 'stats']) ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'columns' => [
                'id',
                'created_at',
                [
                    'attribute' => 'worker_name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->getWorkerName();
                    },
                ],
                [
                    'attribute' => 'dishes',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->getDishesNames();
                    }
                ],
                [
                    'attribute' => 'order_sum',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->getOrderSum() . ' UAH';
                    }
                ]
            ]
        ]) ?>

        <h3>Most popular 5 Dishes</h3>

        <?= GridView::widget([
            'dataProvider' => $dataProviderDishes,
            'summary' => '',
            'columns' => [
                'name',
                [
                    'attribute' => 'orders_count_today',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->orders_count;
                    }
                ],
                [
                    'attribute' => 'selled_sum',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->selled_sum . ' UAH';
                    }
                ]
            ]
        ]) ?>

        <h3>Today selled sum</h3>

        <?= GridView::widget([
            'dataProvider' => $dataProviderDaySell,
            'summary' => '',
            'columns'=>[
                [
                    'attribute'=>'sum',
                    'format'=>'raw',
                    'value' => function ($data) {
                        return $data['sum'] . ' UAH';
                    }
                ]
            ]
        ]);
        ?>

        <?php yii\widgets\Pjax::end(); ?>

    </div>

</div>

<script>

    document.addEventListener("DOMContentLoaded", ready);

    function ready() {

        socket = new WebSocket('ws://<?php echo $_SERVER['SERVER_NAME'] ?>:8080');
        socket.onopen = function (e) {
            setInterval(function () {
                var ping = JSON.stringify({'action': 'ping', 'params': {}});
                socket.send(ping);
            }, 2000);
        };
        socket.onmessage = function (e) {
            var data = JSON.parse(e.data);
            if (data.action == 'refreshStats') {

                $.pjax.reload({container: "#stats"});
            }
        };
    }
</script>
