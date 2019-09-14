<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PermisosBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permisos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_modulos') ?>

    <?= $form->field($model, 'id_perfiles') ?>

    <?= $form->field($model, 'eliminar') ?>

    <?= $form->field($model, 'editar') ?>

    <?php // echo $form->field($model, 'listar') ?>

    <?php // echo $form->field($model, 'agregar') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
