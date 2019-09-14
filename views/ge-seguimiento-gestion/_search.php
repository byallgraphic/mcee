<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoGestionBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ge-seguimiento-gestion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_tipo_seguimiento') ?>

    <?= $form->field($model, 'id_ie') ?>

    <?= $form->field($model, 'id_cargo') ?>

    <?= $form->field($model, 'id_nombre') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'id_persona_gestor') ?>

    <?php // echo $form->field($model, 'numero_visitas') ?>

    <?php // echo $form->field($model, 'socializo_plan') ?>

    <?php // echo $form->field($model, 'plan_trabajo_socializo') ?>

    <?php // echo $form->field($model, 'descripcion_plan_trabajo') ?>

    <?php // echo $form->field($model, 'cronocrama_propuesto') ?>

    <?php // echo $form->field($model, 'descripcion_cronograma') ?>

    <?php // echo $form->field($model, 'avances_proyectos') ?>

    <?php // echo $form->field($model, 'dificultades') ?>

    <?php // echo $form->field($model, 'mejoras') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'calificacion_nivel') ?>

    <?php // echo $form->field($model, 'descripcion_calificacion') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
