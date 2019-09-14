<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformeEjecutivoEstadoBuscar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-informe-ejecutivo-estado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_institucion') ?>

    <?= $form->field($model, 'id_eje') ?>

    <?= $form->field($model, 'id_persona') ?>

    <?= $form->field($model, 'id_coordinador') ?>

    <?php // echo $form->field($model, 'id_secretaria') ?>

    <?php // echo $form->field($model, 'mision') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'avance_producto') ?>

    <?php // echo $form->field($model, 'hallazgos') ?>

    <?php // echo $form->field($model, 'logros') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
