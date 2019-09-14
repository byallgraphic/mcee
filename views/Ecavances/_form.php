<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvances */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ec-avances-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estado_actual')->textInput() ?>

    <?= $form->field($model, 'logros')->textInput() ?>

    <?= $form->field($model, 'retos')->textInput() ?>

    <?= $form->field($model, 'argumentos')->textInput() ?>

    <?= $form->field($model, 'id_acciones')->textInput() ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
