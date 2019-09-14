<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\EcLevantamientoOrientacion */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ec-levantamiento-orientacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_institucion')->DropDownList($instituciones) ?>

    <?= $form->field($model, 'id_sede')->DropDownList($sedes) ?>

	<?= $form->field($model, 'visita_realizada')->widget(
			DatePicker::className(), [
				
			 // modify template for custom rendering
			'template' 		=> '{addon}{input}',
			'language' 		=> 'es',
			'clientOptions' => [
				'autoclose' 	=> true,
				'format' 		=> 'yyyy-mm-dd'
			],
		]);  
	?>

    <?= $form->field($model, 'actividad_seguimiento')->TextArea() ?>

    <?= $form->field($model, 'profesional_encargado')->textInput() ?>

    <?= $form->field($model, 'fortalezas_identificadas')->TextArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'necesidades_orientacion')->TextArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'observacion_general')->TextArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'uso_insumo')->TextArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tipo_levantamiento')->DropDownList($parametros) ?>
	
	<?= $form->field($model, 'id_tipo_informe')->hiddenInput( [ 'value' => $idTipoInforme ] )->label( false ) ?>

    <?= $form->field($model, 'estado')->DropDownList($estados) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
