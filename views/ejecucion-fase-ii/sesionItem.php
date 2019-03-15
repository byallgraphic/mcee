<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE II
---------------------------------------
Modificaciones:
Fecha: 2019-02-05
Descripción: El plugin chosen se deja multiple para poder seleccionar más de un docente y permita desagregarlos de la conformación de semilleros
---------------------------------------
Fecha: 2018-09-18
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin Textarea, para poderlos editar
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use nex\chosen\Chosen;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="ejecucion-fase-form">
	
	<?= Html::activeHiddenInput($dataSesion, "[$indexEf]id_sesion", [ 'value' => $sesion->id ]) ?>
	
	<?= Html::activeHiddenInput($dataSesion, "[$indexEf]id") ?>
	
	<?= Html::activeHiddenInput($dataSesion, "[$indexEf]estado", [ 'value' => 1 ]) ?>
	
	<?= $form->field($dataSesion, '['.$indexEf.']fecha_sesion')->widget(
		DatePicker::className(), [
			
			 // modify template for custom rendering
			'template' => '{addon}{input}',
			'language' => 'es',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'dd-mm-yyyy'
			]
	])->label('Fecha de la sesión(dd-mm-aaaa)');?> 	
	
	<?= $form->field( $dataSesion, "[$indexEf]duracion_sesion" )
				->textInput()
				->label() ?>
	
	<div class="form-group">
		<?= Html::button('Agregar fila' , ['class' => 'btn btn-success', 'id' => 'btnAddFila'.$indexEf ]) ?>
		<?= Html::button('Eliminar fila', ['class' => 'btn btn-success', 'id' => 'btnRemoveFila'.$indexEf, "style" => "display:none" ]) ?>
	</div>
	
	<div class='container-fluid' id='dvSesion<?= $indexEf ?>'>
	
		
		<div class='row text-center title2'>
			
			<div class='col-sm-6 mod-col-sm-6'>
				<span total class='form-control' style='background-color:#ccc;'></span>
			</div>
			
			<div class='col-sm-3 mod-col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Obras derivadas con el desarrollo e implementación de las App 0.0</span>
			</div>
			
			<div class='col-sm-2 mod-col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Mejoras realizadas a las App 0.0</span>
			</div>
			
			<div class='col-sm-1 mod-col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'></span>
			</div>
			
		</div>
		
		<div class='row text-center title'>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre de docentes participantes</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre de las asignaturas que enseña</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Especialidad de la Media Técnica o Técnica</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Número de Apps 0.0 desarrolladas e implementadas</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre de las aplicaciones desarrolladas</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre de las aplicaciones creadas</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Número</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de obras</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Indice de temas escolares disciplinares abordados a través de las App 0.0</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Numero de pruebas realizadas a la aplicación</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Número de disecciones realizadas a la aplicación</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de competencias inferencias y comprometidas en el proceso de creación de la App 0.0</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>OBSERVACIONES GENERALES</span>
			</div>
			
			
			
		</div>
		
		<?php foreach( $ejecucionesFase as $key => $ejecucionFase ) :  ?>
		
			<div class='row text-center mod-sesion' id='dvFilaSesion<?= $sesion->id ?>'>
				
				<div class='col-sm-1' style='display:none;'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]id")->hiddenInput( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
				<?= $form->field( $ejecucionFase, "[$indexEf][$index]docentes" )->widget(
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
					<?= $form->field($ejecucionFase, "[$indexEf][$index]asignaturas")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]especialidad")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]numero_apps_desarrolladas")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]nombre_aplicaciones_desarrolladas")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]nombre_aplicaciones_creadas")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]numero")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]tipo_obra")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]temas_abordados")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]numero_pruebas")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]numero_disecciones")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]tipo_conpetencias")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($ejecucionFase, "[$indexEf][$index]observaciones_generales")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
				</div>
				
			</div>
		
		<?php 
			$index++; 
			endforeach; 
		?>
	
	</div>
		
	
	
	
	<div class='container-fluid'>
	
	
		<div class='row text-center'>
			
			<div class='col-sm-12'>
				<span total class='form-control' style='background-color:#ccc;'>ACCIONES REALIZADAS PARA DESARROLLAR E IMPLEMENTAR LAS APP 0.0</span>
			</div>
			
		</div>
		
		<div class='row text-center title3'>
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de Acción </span>
			</div>
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Descripción</span>
			</div>
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Responsable de la ejecución de la Acción</span>
			</div>
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Tiempo de desarrollo de las aplicaciones  (Horas reloj)</span>
			</div>
			
		</div>
		
		<div class='row text-center row-data-2'>
			
			<div class='col-sm-3'>
				<?= $form->field($accioneRecurso, "[$indexEf]tipo_accion")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-3'>
				<?= $form->field($accioneRecurso, "[$indexEf]descripcion_accion")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-3'>
				<?= $form->field($accioneRecurso, "[$indexEf]responsable_accion")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-3'>
				<?= $form->field($accioneRecurso, "[$indexEf]tiempo_desarrollo")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
		</div>
		
		
		
		
		
		
		
		
		
		
		
		<div class='row text-center'>
			
			<div class='col-sm-12'>
				<span total class='form-control' style='background-color:#ccc;'>RECURSOS EMPLEADOS EN LA CONSTRUCCIÓN (DESARROLLO E IMPLEMENTACIÓN) DE APP 0.0</span>
			</div>
			
		</div>
		
		<div class='row text-center title3'>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>TIC (infraestructura existente en la IEO)</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Digitales</span>
			</div>
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Escolares (No TIC)</span>
			</div>
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Tiempo de uso de los recursos TIC en el diseño de las App 0.0 (Horas reloj)</span>
			</div>
			
		</div>
		
		<div class='row text-center row-data-3'>
			
			<div class='col-sm-1'>
				<?= $form->field($accioneRecurso, "[$indexEf]tic")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-1'>
				<?= $form->field($accioneRecurso, "[$indexEf]tipo_recurso_tic")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field($accioneRecurso, "[$indexEf]digitales")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-3'>
				<?= $form->field($accioneRecurso, "[$indexEf]tipo_recurso_digitales")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-1'>
				<?= $form->field($accioneRecurso, "[$indexEf]escolares")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-3'>
				<?= $form->field($accioneRecurso, "[$indexEf]tipo_recurso_no_tic")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
			<div class='col-sm-1'>
				<?= $form->field($accioneRecurso, "[$indexEf]tiempo_uso_recurso")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null, ['style' => 'display:none' ] ) ?>
			</div>
			
		</div>
	
	
		
	</div>

</div>
