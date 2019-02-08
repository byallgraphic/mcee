<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */
/* @var $form yii\widgets\ActiveForm */
?>


	

	<div class='content-fluid'>
				
				<h1 style='background-color:#ccc;'><?= Html::encode("PLANEACIÓN MISIONAL") ?></h1>

				<?= $form->field($modelPlaneacion, 'tipo_actividad')->dropDownList( [  'prompt' => 'Seleccione...', 'Mesa de trabajo', 'Acompañamiento a la práctica', 'Salidas pedagógicas', 'Evento de ciudad' ] ) ?>
				
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

				<?= $form->field($modelPlaneacion, 'objetivo')->textarea() ?>

				<?= $form->field($modelPlaneacion, 'responsable')->textInput() ?>

				<?= $form->field($modelPlaneacion, 'rol')->textInput() ?>
				
				<?= $form->field($modelPlaneacion, 'descripcion_actividad')->textarea() ?>
				
				<h1 style='background-color:#ccc;'><?= Html::encode( "TIPO ACTOR - CANTIDAD ASISTENTES" ) ?></h1>
				
				<div class="cantidades" style="margin-left: 30px;">
					<div class="row" style='text-align:center;'>
							<div class="col-sm-3" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px;'>Estudiantes</span>
						</div>
						<div class="col-sm-3" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Familias</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Docentes</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Directivos</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Otros</span>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-3" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "estudiantes", [ 'type' => 'number', 'class' => "form-control", 'value' => isset($datos['estudiantes']) ? $datos['estudiantes'] : ''] ) ?>
						</div>
						<div class="col-sm-3" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "familas", [ 'type' => 'number', 'class' => "form-control", 'value' => isset($datos['familas']) ? $datos['familas'] : ''] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "docentes", [ 'type' => 'number', 'class' => "form-control", 'value' => isset($datos['docentes']) ? $datos['docentes'] : ''] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "directivos", [ 'type' => 'number', 'class' => "form-control", 'value' => isset($datos['directivos']) ? $datos['directivos'] : ''] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "otros", [ 'type' => 'number', 'class' => "form-control", 'value' => isset($datos['otros']) ? $datos['otros'] : ''] ) ?>
						</div>
					</div>
				</div>
				<br>
				
				<h1 style='background-color:#ccc;'><?= Html::encode( "MEDIOS DE VERIFICACIÓN Y PRODUCTOS" ) ?></h1>
				
				
				<?= $form->field($modelVerificacion, 'tipo_verificacion')->dropDownList( $tiposVerificacion, ['prompt' => 'Seleccione...' ] ) ?>
				
				<?= $form->field($modelVerificacion, 'ruta_archivo[]')->fileInput(['multiple' => true,  'accept' => ".doc, .docx, .pdf, .xls" ]) ?>

				
			
			
			
			
			
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
				
				<?= $form->field($modelReportes, 'observaciones')->textarea() ?>
			
			
		
	</div>
