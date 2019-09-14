<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PccTbConsolidacionArticulacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pcc-tb-consolidacion-articulacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Fecha_accion') ?>

    <?= $form->field($model, 'Id_formador') ?>

    <?= $form->field($model, 'Nombre1') ?>

    <?= $form->field($model, 'Apellido1') ?>

    <?php // echo $form->field($model, 'IE') ?>

    <?php // echo $form->field($model, 'Mes') ?>

    <?php // echo $form->field($model, 'Avance_actores') ?>

    <?php // echo $form->field($model, 'Avance_transv') ?>

    <?php // echo $form->field($model, 'Insercion_PEI') ?>

    <?php // echo $form->field($model, 'Avance_biblio') ?>

    <?php // echo $form->field($model, 'Avance_otros') ?>

    <?php // echo $form->field($model, 'Adjuntos') ?>

    <?php // echo $form->field($model, 'Observaciones') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
