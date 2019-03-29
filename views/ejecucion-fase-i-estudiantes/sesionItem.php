<?php

/**********
Versión: 001
Fecha: 2018-08-23
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I ESTUDIANTES
---------------------------------------
Modificaciones:
Fecha: 2018-11-01
Persona encargada: Edwin Molina Grisales
Cambios realizados: Cambios varios para permitir ingresar o actualizar registros
---------------------------------------
Fecha: 2018-09-19
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin Textarea, para poderlos editar
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

$index = 0;
?>

<div class="ejecucion-fase-form">
	
	<?= Html::activeHiddenInput( $datosSesion,'['.$sesion->id.']id' ) ?>
	
	<?= $form->field($datosSesion, '['.$sesion->id.']fecha_sesion')->widget(
				DatePicker::className(), [
				
				 // modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy'
				]
			])->label('Fecha de la sesión(dd-mm-aaaa)');?> 	
			
	<?= $form->field( $datosSesion, "[$sesion->id]duracion_sesion" )
				->textInput()
				->label() ?>
	
	<div class="form-group">
		<?= Html::button('Agregar fila' , ['class' => 'btn btn-success', 'id' => 'btnAddFila'.$sesion->id ]) ?>
		<?= Html::button('Eliminar fila', ['class' => 'btn btn-danger', 'id' => 'btnRemoveFila'.$sesion->id, "style" => "display:none" ]) ?>
	</div>
	
	<div class='container-fluid' id='container-<?= $sesion->id ?>' sesion='<?= $sesion->id ?>'>
		
		<div class='row text-center'>
			
			<div class='col-sm-12'>
				<span total class='form-control' style='background-color:#ccc;'>FASE I CREACIÓN Y PRUEBA</span>
			</div>
			
		</div>
		
		<div class='row text-center title'>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Participación Sesiones</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Número de estudiantes participantes</span>
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
				<span total class='form-control' style='background-color:#ccc;'>Tipo de competencias inferencias y comprometidas en el proceso de creación de App 0.0</span>
			</div>
			
			<div class='col-sm-4'>
				<span total class='form-control' style='background-color:#ccc;'>OBSERVACIONES GENERALES</span>
			</div>
			
		</div>
		
		<?php foreach( $ejecucionesFases as $key => $ejecucionFase ) : ?>
		
			<div class='row text-center' id='dvFilaSesion-<?= $sesion->id ?>-<?= $index ?>'>
				
				<div class='col-sm-1' style='display:none;'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]id")->hiddenInput([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1 sesiones'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]participacion_sesiones")
									->textarea(
										[ 
											'class' 				=> 'form-control', 
											'maxlength' 			=> true, 
											'data-type' 			=> 'number',
											'data-typevalidation' 	=> 'number',
											// 'data-source' 			=> '[ 1, 2, 3,4, 5,6, 7, 8,9,10,11,12]',
										])
									->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1 estudiantes'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]numero_estudiantes")
									->textarea(
										[ 
											'class' 				=> 'form-control', 
											'maxlength' 			=> true, 
											'data-type' 			=> 'number',
											'data-typevalidation' 	=> 'number',
										])
									->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]apps_creadas")
									->textarea(
										[ 
											'class' 				=> 'form-control', 
											'maxlength' 			=> true, 
											'data-type' 			=> 'number',
											'data-typevalidation' 	=> 'number',
										])
									->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]aplicaciones_creadas" )->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]sesiones_empleadas" )
									->textarea(
										[ 
											'class' 				=> 'form-control', 
											'maxlength' 			=> true, 
											'data-type' 			=> 'number',
											'data-typevalidation' 	=> 'number',
										])
									->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]acciones_realizadas" )->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]problemas_creacion" )->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]competencias_inferidas")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-4'>
					<?= $form->field($ejecucionFase, "[$sesion->id][$index]observaciones")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
			</div>
		
		<?php 
			$index++;
			endforeach;
		?>
		
	</div>

</div>
