<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
    <?php Pjax::end(); ?></div>
