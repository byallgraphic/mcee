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
	
	<h3 style="background-color:#ccc;padding:5px;">	Procesos de gestión institucional de los proyectos pedagógicos transversales fortalecidos</h3>
		<?=  $form->field($model, 'procesos_gestion_avances')->textArea()->label("Avances") ?>
        <?= $form->field($model, 'procesos_gestion_dificultades')->textArea()->label("Dificultades") ?>
		
	<h3 style="background-color:#ccc;padding:5px;">	Estrategias de Transversalización y vinculación en el PEI instaladas </h3>
		
		<?= $form->field($model, 'estrategias_tranversalizacion_avances')->textArea()->label("Avances")?>
		<?= $form->field($model, 'estrategias_tranversalizacion_difcultades')->textArea()->label("Dificultades") ?>
		 
	<h3 style="background-color:#ccc;padding:5px;">	Orientaciones conceptuales y metodológicas para el fortalecimiento de las competencias básicas y habilidades para la vida en los estudiantes a través de los ppt </h3>
	
	    <?= $form->field($model, 'orientacion_conceptuales_avances')->textArea()->label("Avances")?>
		<?= $form->field($model, 'orientacion_conceptuales_dificultades')->textArea()->label("Dificultades")?>

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
