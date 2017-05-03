<?php

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
use app\models\Dishes;
use app\models\Workers;
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">

        <?= $form->field($model, 'dishes')->widget(MultiSelect::className(), [

            'id' => "multi_select_dishes",
            "options" => ['multiple' => "multiple"],
            'data' => Dishes::getOptions(),
            'name' => 'multi_select_dishes',
            "clientOptions" =>
                [
                    'numberDisplayed' => 3
                ],

        ]) ?>

        <?= $form->field($model, 'worker_id')->widget(MultiSelect::className(), [

            'id' => "select_workers",
            'data' => Workers::getOptions(),
            'name' => 'multi_select_workers'
        ]) ?>

    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

    document.addEventListener("DOMContentLoaded", ready);

    function ready() {
        jQuery('#w0').on('beforeSubmit', function () {

            socket = new WebSocket('ws://<?php echo $_SERVER['SERVER_NAME'] ?>:8080');
            socket.onopen = function (e) {
                var data = JSON.stringify({'action': 'refreshStats', 'params': {}});
                socket.send(data);
            }
        });
    }
</script>
