<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalSsBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-avance-misional-ss-search">

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

    <?php // echo $form->field($model, 'gestion_institucional_avances') ?>

    <?php // echo $form->field($model, 'gestion_institucional_dificultades') ?>

    <?php // echo $form->field($model, 'proyectos_servicio_social_avances') ?>

    <?php // echo $form->field($model, 'proyectos_servicio_social_difcultades') ?>

    <?php // echo $form->field($model, 'competencias_habilidades_avances') ?>

    <?php // echo $form->field($model, 'competencias_habilidades_dificultades') ?>

    <?php // echo $form->field($model, 'fuente_informacion') ?>

    <?php // echo $form->field($model, 'avances_acompanamiento') ?>

    <?php // echo $form->field($model, 'dificultades_acompanamiento') ?>

    <?php // echo $form->field($model, 'alarmas_importantes') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
