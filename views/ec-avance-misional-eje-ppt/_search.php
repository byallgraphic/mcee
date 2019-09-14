<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalEjePptBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-avance-misional-eje-ppt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'resposable_sem') ?>

    <?= $form->field($model, 'operador') ?>

    <?= $form->field($model, 'acciones_realizadas') ?>

    <?= $form->field($model, 'proceso_gestion_avances') ?>

    <?php // echo $form->field($model, 'proceso_gestion_dificultades') ?>

    <?php // echo $form->field($model, 'estrategias_avances') ?>

    <?php // echo $form->field($model, 'estrategias_dificultades') ?>

    <?php // echo $form->field($model, 'orientaciones_avances') ?>

    <?php // echo $form->field($model, 'orientaciones_dificultades') ?>

    <?php // echo $form->field($model, 'guia_avances') ?>

    <?php // echo $form->field($model, 'guia_dificultades') ?>

    <?php // echo $form->field($model, 'iniciativas_avances') ?>

    <?php // echo $form->field($model, 'iniciativas_dificultades') ?>

    <?php // echo $form->field($model, 'red_municipal_avances') ?>

    <?php // echo $form->field($model, 'red_municipal_dificultades') ?>

    <?php // echo $form->field($model, 'proyectos_avances') ?>

    <?php // echo $form->field($model, 'proyectos_dificultades') ?>

    <?php // echo $form->field($model, 'dispositivo_avances') ?>

    <?php // echo $form->field($model, 'dispositivo_dificultades') ?>

    <?php // echo $form->field($model, 'fuente_informacion') ?>

    <?php // echo $form->field($model, 'avances_importantes') ?>

    <?php // echo $form->field($model, 'dificultades_importantes') ?>

    <?php // echo $form->field($model, 'alarmas_importantes') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
