<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GcMomento2Buscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gc-momento2-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_semana') ?>

    <?= $form->field($model, 'realizo_visita')->checkbox() ?>

    <?= $form->field($model, 'estudiantes') ?>

    <?= $form->field($model, 'docentes') ?>

    <?php // echo $form->field($model, 'directivos') ?>

    <?php // echo $form->field($model, 'otro') ?>

    <?php // echo $form->field($model, 'justificacion_no_visita') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
