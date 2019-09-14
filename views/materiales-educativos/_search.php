<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesEducativosBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materiales-educativos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'autor') ?>

    <?= $form->field($model, 'nivel') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'otro_cual') ?>

    <?php // echo $form->field($model, 'nombre_apellidos') ?>

    <?php // echo $form->field($model, 'reseña') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
