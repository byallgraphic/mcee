<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PccTbCalendarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pcc-tb-calendario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Fecha_captura') ?>

    <?= $form->field($model, 'Nmero_de_identificacin_del_Tutor') ?>

    <?= $form->field($model, 'Nombre') ?>

    <?= $form->field($model, 'Apellido') ?>

    <?php // echo $form->field($model, 'Institucin_Educativa') ?>

    <?php // echo $form->field($model, 'Sede') ?>

    <?php // echo $form->field($model, 'Fecha_de_programacin') ?>

    <?php // echo $form->field($model, 'Hora_inicio') ?>

    <?php // echo $form->field($model, 'Hora_final') ?>

    <?php // echo $form->field($model, 'Actividad') ?>

    <?php // echo $form->field($model, 'Cantidad_de_refrigerios_requerid') ?>

    <?php // echo $form->field($model, 'Seguimiento_pedagogico') ?>

    <?php // echo $form->field($model, 'Estado_del_evento') ?>

    <?php // echo $form->field($model, 'Fecha_reprogramacion') ?>

    <?php // echo $form->field($model, 'Motivo_reprogramacion') ?>

    <?php // echo $form->field($model, 'Perfi') ?>

    <?php // echo $form->field($model, 'Lugar_reunion_as') ?>

    <?php // echo $form->field($model, 'Requiere_refrigerios') ?>

    <?php // echo $form->field($model, 'Taller') ?>

    <?php // echo $form->field($model, 'Laboratorio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
