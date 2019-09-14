<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalPptBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-avance-misional-ppt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_institucion') ?>

    <?= $form->field($model, 'id_sede') ?>

    <?= $form->field($model, 'fecha_inicio') ?>

    <?= $form->field($model, 'fecha_fin') ?>

    <?php // echo $form->field($model, 'responsable_sem') ?>

    <?php // echo $form->field($model, 'operador') ?>

    <?php // echo $form->field($model, 'acciones_realizadas') ?>

    <?php // echo $form->field($model, 'procesos_gestion_avances') ?>

    <?php // echo $form->field($model, 'procesos_gestion_dificultades') ?>

    <?php // echo $form->field($model, 'estrategias_tranversalizacion_avances') ?>

    <?php // echo $form->field($model, 'estrategias_tranversalizacion_difcultades') ?>

    <?php // echo $form->field($model, 'orientacion_conceptuales_avances') ?>

    <?php // echo $form->field($model, 'orientacion_conceptuales_dificultades') ?>

    <?php // echo $form->field($model, 'fuente_informacion') ?>

    <?php // echo $form->field($model, 'avances_acompanamiento') ?>

    <?php // echo $form->field($model, 'dificultades_acompanamiento') ?>

    <?php // echo $form->field($model, 'alarmas_importantes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
