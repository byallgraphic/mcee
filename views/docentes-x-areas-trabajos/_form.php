<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocentesXAreasTrabajos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docentes-xareas-trabajos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_perfiles_x_personas_docentes')->dropDownList( $personas, [ 'prompt' => 'Seleccione...' ] ) ?>

    <?= $form->field($model, 'id_areas_trabajos')->dropDownList( $areasTrabajo, [ 'prompt' => 'Seleccione...' ] ) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
