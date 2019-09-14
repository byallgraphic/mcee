<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\IsaSeguimientoProceso */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJs( file_get_contents( '../web/js/cbacSeguimientoProceso.js' ) );
?>

<div class="cbac-seguimiento-proceso-form">

    <?php $form = ActiveForm::begin(); ?>
	
	
	<div class="row">
	  <div class="col-md-8"> <?= $form->field($model, 'id_institucion')->dropDownList($instituciones) ?></div>
	  <div class="col-md-4"></div>
	</div>
   
   <div class="row">
	  <div class="col-md-8"> <?= $form->field($model, 'id_sede')->dropDownList($sedes) ?></div>
	  <div class="col-md-4"></div>
	</div>
	
	<div class="row">
	  <div class="col-md-6"><?= $form->field($model, 'fecha')->widget(
			DatePicker::className(), [
				
			 // modify template for custom rendering
			'template' 		=> '{addon}{input}',
			'language' 		=> 'es',
			'clientOptions' => [
				'autoclose' 	=> true,
				'format' 		=> 'yyyy-mm',
				'minViewMode'=>'months',
			],
			
		]);  
	?></div>
	
	</div>
	

    <?= $form->field($model, 'estado')->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
	
	<?= $this->context->actionFormulario($model,$form)   ?>
	

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
