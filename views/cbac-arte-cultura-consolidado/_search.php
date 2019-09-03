<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSensibilizacionArtisticaConsolidadoBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="isa-iniciacion-sensibilizacion-artistica-consolidado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'id_institucion') ?>

    <?= $form->field($model, 'id_sede') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'total_sesiones_realizadas') ?>

    <?php // echo $form->field($model, 'avance_por_mes') ?>

    <?php // echo $form->field($model, 'total_sesiones_aplazadas') ?>

    <?php // echo $form->field($model, 'total_sesiones_canceladas') ?>

    <?php // echo $form->field($model, 'vecinos') ?>

    <?php // echo $form->field($model, 'lideres_comunitarios') ?>

    <?php // echo $form->field($model, 'empresarios_comerciantes_microempresas') ?>

    <?php // echo $form->field($model, 'representantes_organizaciones_locales') ?>

    <?php // echo $form->field($model, 'asociaciones_grupos_comunitarios') ?>

    <?php // echo $form->field($model, 'otros_actores') ?>

    <?php // echo $form->field($model, 'actas') ?>

    <?php // echo $form->field($model, 'reportes') ?>

    <?php // echo $form->field($model, 'listados') ?>

    <?php // echo $form->field($model, 'plan_trabajo') ?>

    <?php // echo $form->field($model, 'formato_seguimiento') ?>

    <?php // echo $form->field($model, 'formato_evaluacion') ?>

    <?php // echo $form->field($model, 'fotografias') ?>

    <?php // echo $form->field($model, 'videos') ?>

    <?php // echo $form->field($model, 'otros_productos') ?>

    <?php // echo $form->field($model, 'id_actividad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
