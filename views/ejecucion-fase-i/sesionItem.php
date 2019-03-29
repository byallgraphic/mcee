<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I
---------------------------------------
Modificaciones:
Fecha: 2019-02-04
Descripción: Se desagregan los campos Profesional A y docentes de cada sesión con respecto a a la conformación de los semilleros
			 y se dejan los campos select en español
---------------------------------------
Modificaciones:
Fecha: 2018-11-06
Descripción: Se modifica los campos para que se vea las validaciones correctas de acuerdo a los colores
---------------------------------------
Modificaciones:
Fecha: 2018-10-16
Descripción: Se premite insertar y modificar registros del formulario Ejecucion Fase I Docentes
---------------------------------------
**********/
// use app\models\EjecucionFase;
// $model = new EjecucionFase();
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use nex\chosen\Chosen;
?>

<style>
	.col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1{
		padding: 0px;
	}
	
	.title{
		height: 150px;
		background-color: #ccc;
	}
	
	.title > div > span{
		height: 150px;
	}
	
	.title2 > div > span{
		height: 70px;
	}
</style>

<div class="ejecucion-fase-form">


	<!-- Creo campo oculta para saber el id de la sesion -->
	<?= Html::activeHiddenInput($datosSesion, "[$indexEf]id_sesion", [ 'value' => $sesion->id ]) ?>
	
	<!-- Creo campo oculto para saber el id de la los datos de la sesion -->
	<?= Html::activeHiddenInput($datosSesion, "[$indexEf]id") ?>
	
	<?= Html::activeHiddenInput($datosSesion, "[$indexEf]estado", [ 'value' => 1 ]) ?>
	
	<?= $form->field($datosSesion, '['.$indexEf.']fecha_sesion')->widget(
			DatePicker::className(), [
				
				 // modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy',
					'enableOnReadonly' => false,
				]
		])->label('Fecha de la sesión(dd-mm-aaaa)');?> 	
		
	<?= $form->field( $datosSesion, "[$indexEf]duracion_sesion" )
				->textInput()
				->label() ?>
	
	<div class="form-group">
		<?= Html::button('Agregar fila' , ['class' => 'btn btn-success agregar', 'id' => 'btnAddFila'.$sesion->id ]) ?>
		<?= Html::button('Eliminar fila', ['class' => 'btn btn-success', 'id' => 'btnRemoveFila'.$sesion->id, "style" => "display:none" ]) ?>
	</div>
	
	<div class='container-fluid' id='dvSesion<?= $sesion->id ?>'>
		
		<div class='row text-center'>
			
			<div class='col-sm-12'>
				<span total class='form-control' style='background-color:#ccc;'>FASE I CREACIÓN Y PRUEBA</span>
			</div>
			
		</div>
		
		<div class='row text-center title'>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre del docente</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre de las asignaturas que enseña</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Especialidad de la Media Técnica o Técnica</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Participación Sesiones</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Número de Apps 0.0 creadas</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre de las aplicaciones creadas</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Número de sesiones empleadas para la creación de cada aplicación</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Acciones realizadas con mayor incidencia para estimular la creación de las App 0.0</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Temas problema que atiende la creación</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de competencias inferencias y comprometidas en el proceso de creación de la App 0.0</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Observaciones</span>
			</div>
			
		</div>
		
		<?php foreach( $models as $key => $ejecucionFase ) :  ?>
		
			<div class='row text-center' id='dvFilaSesion<?= $sesion->id ?>'>
								
				<div class='col-sm-1' style='display:none'>
					<?= Html::activeHiddenInput($ejecucionFase, "[$indexEf][$index]id") ?>
				</div>
				
				<div class='col-sm-2'>
				
					<?= $form->field( $ejecucionFase, "[".$indexEf."][".$index."]docente" )->widget(
								Chosen::className(), [
									'items' => $docentes,
									'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
									'multiple' => true,
									'clientOptions' => [
										'search_contains' => true,
										'single_backstroke_delete' => false,
									]
							])->label(null,['style'=>'display:none']) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]asignaturas" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1 prueba'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]especiaidad" )
							->dropDownList( $especialidades )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1 sesiones'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]paricipacion_sesiones" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]numero_apps" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]nombre_aplicaciones_creadas" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]seiones_empleadas" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]acciones_realiadas" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]temas_problama" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]tipo_conpetencias" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field( $ejecucionFase, "[$indexEf][$index]observaciones" )
							->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'] )
							->label( null, ['style' => 'display:none'] ) ?>
				</div>
				
			</div>

			
		
		<?php 
		$index++; 
		endforeach; ?>
	
	</div>




</div>


