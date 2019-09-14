<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvancesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-avances-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'estado_actual') ?>

    <?= $form->field($model, 'logros') ?>

    <?= $form->field($model, 'retos') ?>

    <?= $form->field($model, 'argumentos') ?>

    <?php // echo $form->field($model, 'id_acciones') ?>

    <?php // echo $form->field($model, 'estado')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
