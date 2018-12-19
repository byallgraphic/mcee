<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\IsaSeguimientoProceso */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="isa-seguimiento-proceso-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, "seguimiento_proceso")->textInput()?>
	
	
	<?= $form->field($model, 'fecha_desde')->widget(
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
	
	<?= $form->field($model, 'fecha_hasta')->widget(
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
	
    <?= $form->field($model, 'id_institucion')->dropDownList($instituciones) ?>

    <?= $form->field($model, 'id_sede')->dropDownList($sedes) ?>

    <?= $form->field($model, 'estado')->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
	
	<?= $this->context->actionFormulario($model,$form,$datos)   ?>
	

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
