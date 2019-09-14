<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcLevantamientoOrientacionBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-levantamiento-orientacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_institucion') ?>

    <?= $form->field($model, 'id_sede') ?>

    <?= $form->field($model, 'visita_realizada') ?>

    <?= $form->field($model, 'actividad_seguimiento') ?>

    <?php // echo $form->field($model, 'profesional_encargado') ?>

    <?php // echo $form->field($model, 'fortalezas_identificadas') ?>

    <?php // echo $form->field($model, 'necesidades_orientacion') ?>

    <?php // echo $form->field($model, 'observacion_general') ?>

    <?php // echo $form->field($model, 'uso_insumo') ?>

    <?php // echo $form->field($model, 'id_tipo_levantamiento') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
