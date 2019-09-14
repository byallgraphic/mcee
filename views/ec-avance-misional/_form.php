<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Collapse;
/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalPpt */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ec-avance-misional-ppt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_institucion')->DropDownList($instituciones) ?>

    <?= $form->field($model, 'id_sede')->DropDownList($sedes) ?>

   <?= $form->field($model, 'fecha_inicio')->widget(
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

	<?= $form->field($model, 'fecha_fin')->widget(
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

    <?= $form->field($model, 'responsable_sem')->textArea() ?>

    <?= $form->field($model, 'operador')->textArea() ?>

    <?= $form->field($model, 'acciones_realizadas')->textArea() ?>
	
	<h3 style="background-color:#ccc;padding:5px;">Acompañamiento pedagógico que realizan las familias para el desarrollo de Competencias Básicas y Habilidades para la Vida en los estudiantes fortalecido</h3>
		 <?= $form->field($model, 'acompanamiento_pedagogico_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'acompanamiento_pedagogico_dificultades')->textArea()->label("Dificultades") ?>


		
	<h3 style="background-color:#ccc;padding:5px;">	Comunicación pedagógica entre familia y escuela fortalecida </h3>
		
		
    <?= $form->field($model, 'comunicacion_pedagogica_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'comunicacion_pedagogica_difcultades')->textArea()->label("Dificultades") ?>

  
		 
	<h3 style="background-color:#ccc;padding:5px;">	Organismos y mecanismos de participación de las familias en las escuelas articulados</h3>
	
	     <?= $form->field($model, 'organismos_mecanismos_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'organismos_mecanismos_dificultades')->textArea()->label("Dificultades") ?>
	
	
	
    <?= $form->field($model, 'fuente_informacion')->textArea() ?>

    <?= $form->field($model, 'avances_acompanamiento')->textArea() ?>

    <?= $form->field($model, 'dificultades_acompanamiento')->textArea() ?>

    <?= $form->field($model, 'alarmas_importantes')->textArea() ?>
	
    <?= $form->field($model, 'estado')->DropDownList($estados) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
	
	
	

    <?php ActiveForm::end(); ?>

</div>
