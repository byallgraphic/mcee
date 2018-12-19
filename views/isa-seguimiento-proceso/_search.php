<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IsaSeguimientoProcesoBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="isa-seguimiento-proceso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'seguimiento_proceso') ?>

    <?= $form->field($model, 'fecha_desde') ?>

    <?= $form->field($model, 'fecha_hasta') ?>

    <?= $form->field($model, 'id_institucion') ?>

    <?php // echo $form->field($model, 'id_sede') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
