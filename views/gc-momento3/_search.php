<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GcMomento3Buscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gc-momento3-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_semana') ?>

    <?= $form->field($model, 'id_proposito_momento1') ?>

    <?= $form->field($model, 'nivel_avance') ?>

    <?= $form->field($model, 'justificacion_avance') ?>

    <?php // echo $form->field($model, 'observaciones_prof') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
