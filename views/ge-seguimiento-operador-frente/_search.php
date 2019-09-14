<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperadorFrenteBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ge-seguimiento-operador-frente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_tipo_seguimiento') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'id_persona_diligencia') ?>

    <?= $form->field($model, 'id_gestor_a_evaluar') ?>

    <?php // echo $form->field($model, 'mes_reporte') ?>

    <?php // echo $form->field($model, 'fecha_corte') ?>

    <?php // echo $form->field($model, 'cumple_cronograma')->checkbox() ?>

    <?php // echo $form->field($model, 'descripcion_cronograma') ?>

    <?php // echo $form->field($model, 'compromisos_establecidos') ?>

    <?php // echo $form->field($model, 'cuantas_reuniones') ?>

    <?php // echo $form->field($model, 'aportes_reuniones') ?>

    <?php // echo $form->field($model, 'logros') ?>

    <?php // echo $form->field($model, 'dificultades') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
