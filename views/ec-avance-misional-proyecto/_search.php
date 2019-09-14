<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalProyectoBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-avance-misional-proyecto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'equipo_sem') ?>

    <?= $form->field($model, 'operado') ?>

    <?= $form->field($model, 'acciones_realizadas') ?>

    <?= $form->field($model, 'actores_lideres') ?>

    <?php // echo $form->field($model, 'proceso_gestion') ?>

    <?php // echo $form->field($model, 'iniciativas_pedagogicas') ?>

    <?php // echo $form->field($model, 'estudiantes') ?>

    <?php // echo $form->field($model, 'fuente_informacion') ?>

    <?php // echo $form->field($model, 'avances_importante') ?>

    <?php // echo $form->field($model, 'dificultades_importantes') ?>

    <?php // echo $form->field($model, 'alarmas_importantes') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
