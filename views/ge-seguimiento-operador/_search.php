<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperadorBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ge-seguimiento-operador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_tipo_seguimiento') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'id_operador') ?>

    <?= $form->field($model, 'cual_operador') ?>

    <?php // echo $form->field($model, 'proyecto_reportar') ?>

    <?php // echo $form->field($model, 'id_ie') ?>

    <?php // echo $form->field($model, 'mes_reporte') ?>

    <?php // echo $form->field($model, 'semana_reporte') ?>

    <?php // echo $form->field($model, 'id_persona_responsable') ?>

    <?php // echo $form->field($model, 'descripcion_actividad') ?>

    <?php // echo $form->field($model, 'poblacion_beneficiaria') ?>

    <?php // echo $form->field($model, 'quienes') ?>

    <?php // echo $form->field($model, 'numero_participantes') ?>

    <?php // echo $form->field($model, 'duracion_actividad') ?>

    <?php // echo $form->field($model, 'logros_alcanzados') ?>

    <?php // echo $form->field($model, 'dificultadades') ?>

    <?php // echo $form->field($model, 'avances_cumplimiento_cuantitativos') ?>

    <?php // echo $form->field($model, 'avances_cumplimiento_cualitativos') ?>

    <?php // echo $form->field($model, 'dificultades') ?>

    <?php // echo $form->field($model, 'propuesta_dificultades') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
