<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformeAvanceEjecucionMisionalBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-informe-avance-ejecucion-misional-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_institucion') ?>

    <?= $form->field($model, 'id_eje') ?>

    <?= $form->field($model, 'id_persona') ?>

    <?= $form->field($model, 'id_coordinador') ?>

    <?php // echo $form->field($model, 'id_secretaria') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'presentacion') ?>

    <?php // echo $form->field($model, 'productos') ?>

    <?php // echo $form->field($model, 'presentacion_retos') ?>

    <?php // echo $form->field($model, 'alarmas') ?>

    <?php // echo $form->field($model, 'consolidad_avance') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
