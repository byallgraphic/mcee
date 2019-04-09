<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSencibilizacionArtistica */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJs( file_get_contents( '../web/js/sensibilizacion.js' ) );

?>

<div class="isa-iniciacion-sencibilizacion-artistica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_institucion')->dropDownList($institucion) ?>

    <?= $form->field($model, 'id_sede')->dropDownList($sede) ?>

    <?= $form->field($model, 'caracterizacion_si_no')->dropDownList($arraySiNo ) ?>

    <?= $form->field($model, 'caracterizacion_nombre')->textInput() ?>

    <?= $form->field($model, 'caracterizacion_fecha')->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
            ],
    ]);  ?>
    <?= $form->field($model, 'caracterizacion_justificacion')->textInput() ?>
	<?= $form->field($model, 'estado')->hiddenInput(['value'=> 1])->label(false) ?> 

    <div class="panel panel panel-primary" >
        <div class="panel-heading" style="margin-bottom: 15px;">Fortalecer el vínculo comunidad-escuela mediante el mejoramiento de la oferta en artes y cultura desde las instituciones educativas oficiales para la ocupación del tiempo libre en las comunas y corregimientos de Santiago de Cali.</div>
        <?= $this->context->actionViewFases($model, $form);   ?>
    </div>
  

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
