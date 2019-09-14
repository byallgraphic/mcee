<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */
/* @var $form yii\widgets\ActiveForm */
?>

	<div class='content-fluid'>
		
		<div class='row'>
		
			<div class='col-sm-6'>
	
				<h1 style='background-color:#ccc;'><?= Html::encode("PLANEACIÓN MISIONAL") ?></h1>

				<?= $form->field($modelPlaneacion, 'tipo_actividad')->textInput() ?>
				
				<?= $form->field($modelPlaneacion, 'fecha')->widget(
					DatePicker::className(), [
						
						 // modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'dd-mm-yyyy'
						]
				]); ?>

				<?= $form->field($modelPlaneacion, 'tipo_actor')->textInput() ?>
				
				<?= $form->field($modelPlaneacion, 'cantidad_asistentes')->textInput() ?>

				<?= $form->field($modelPlaneacion, 'objetivo')->textInput() ?>

				<?= $form->field($modelPlaneacion, 'responsable')->textInput() ?>

				<?= $form->field($modelPlaneacion, 'rol')->textInput() ?>
				
				<?= $form->field($modelPlaneacion, 'descripcion_actividad')->textInput() ?>
				
				
				
				<h1 style='background-color:#ccc;'><?= Html::encode( "MEDIOS DE VERIFICACIÓN Y PRODUCTOS" ) ?></h1>
				
							
				
				<?= $form->field($modelVerificacion, 'tipo_verificacion')->dropDownList( $tiposVerificacion, ['prompt' => 'Seleccione...' ] ) ?>
				
				<?= $form->field($modelVerificacion, 'ruta_archivo')->fileInput() ?>
			
			</div>
			
			<div class='col-sm-6'>
			
				<h1 style='background-color:#ccc;'><?= Html::encode( "REPORTES" ) ?></h1>
				
				<?= $form->field($modelReportes, 'fecha_diligenciamiento')->widget(
					DatePicker::className(), [
						
						 // modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'dd-mm-yyyy'
						]
				]); ?>
				
				
				
				<?= $form->field($modelReportes, 'ejecutado')->textInput() ?>
				
				<?= $form->field($modelReportes, 'no_ejecutado')->textInput() ?>
				
				<?= $form->field($modelReportes, 'variaciones')->textInput() ?>
				
				<?= $form->field($modelReportes, 'observaciones')->textInput() ?>
			
			</div>
			
		</div>
		
	</div>
