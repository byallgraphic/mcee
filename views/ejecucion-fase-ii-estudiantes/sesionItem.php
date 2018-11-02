<?php

/**********
Versión: 001
Fecha: 2018-08-23
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I ESTUDIANTES
---------------------------------------
Modificaciones:
Fecha: 2018-11-02
Persona encargarda: Edwin Molina Grisales
Descripción: Modificaciones varias para poder insertar o actualizar los registros del usuario
---------------------------------------
Fecha: 2018-09-19
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin XEditable, para poderlos editar
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */
/* @var $form yii\widgets\ActiveForm */

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
	
	<div class="form-group">
		<?= Html::button('Agregar fila' , ['class' => 'btn btn-success', 'id' => 'btnAddFila'.$sesion->id ]) ?>
		<?= Html::button('Eliminar fila', ['class' => 'btn btn-danger', 'id' => 'btnRemoveFila'.$sesion->id, "style" => "display:none" ]) ?>
	</div>
	
	<div class='container-fluid' id='container-<?= $sesion->id ?>' sesion='<?= $sesion->id ?>'>
	
		
		<div class='row text-center title2'>
			
			<div class='col-sm-4 title'>
			
				<div class='col-sm-3'>
					<span total class='form-control' style='background-color:#ccc;'></span>
				</div>
				<div class='col-sm-8'>
					<span total class='form-control' style='background-color:#ccc;'>Acciones realizadas para desarrollar e implementar las App 0.0</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'></span>
				</div>
			
			</div>
			
			<div class='col-sm-4 title'>
			
				<div class='col-sm-11'>
					<span total class='form-control' style='background-color:#ccc;'>Recursos empleados en la construcción (Desarrollo e implementación) de App 0.0</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'></span>
				</div>
			
			</div>
			
			<div class='col-sm-4 title'>
			
				<div class='col-sm-3'>
					<span total class='form-control' style='background-color:#ccc;'>Obras resultado del  desarrollo e implementación de las App 0.0</span>
				</div>
				
				<div class='col-sm-4'>
					<span total class='form-control' style='background-color:#ccc;'></span>
				</div>
				
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Mejoras realizadas a las App 0.0</span>
				</div>
				
				<div class='col-sm-3'>
					<span total class='form-control' style='background-color:#ccc;'></span>
				</div>
			
			</div>
			
		</div>
		
		<div class='row text-center title'>
			
			<div class='col-sm-4 title'>
			
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Número de estudiantes participantes</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Número de Apps 0.0 desarrolladas e implementadas</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Nombre de las aplicaciones desarrolladas</span>
				</div>
				
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Tipo de Acción </span>
				</div>
				
				<div class='col-sm-4'>
					<span total class='form-control' style='background-color:#ccc;'>Descripción</span>
				</div>
				
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Responsable de la ejecución de la Acción</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Tiempo de desarrollo de las aplicaciones  (Horas reloj)</span>
				</div>
			
			</div>
			
			<div class='col-sm-4 title'>
			
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>TIC (infraestructura existente en la IEO)</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Digitales</span>
				</div>
				
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
				</div>
				
				<div class='col-sm-4'>
					<span total class='form-control' style='background-color:#ccc;'>Escolares (No TIC)</span>
				</div>
				
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Tiempo de uso de los recursos TIC en el diseño de las App 0.0 (Horas)</span>
				</div>
			
			</div>
			
			<div class='col-sm-4 title'>
			
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Número</span>
				</div>
				
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Tipo de obras</span>
				</div>
				
				<div class='col-sm-4'>
					<span total class='form-control' style='background-color:#ccc;'>Indice de temas escolares disciplinares abordados a través de las App 0.0</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Numero de pruebas realizadas a la aplicación</span>
				</div>
				
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Número de disecciones realizadas a la aplicación</span>
				</div>
				
				<div class='col-sm-3'>
					<span total class='form-control' style='background-color:#ccc;'>OBSERVACIONES GENERALES</span>
				</div>
			
			</div>
			
		</div>
		
		<?php foreach( $ejecucionesFases as $key => $ejecucionFase ) : ?>
		
			<div class='row text-center' id='dvFilaSesion-<?= $sesion->id ?>-<?= $index ?>'>
			
				<div class='col-sm-4'>
				
					<div class='col-sm-1' style='display:none;'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]id")->hiddenInput([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
				
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]estudiantes_participantes")
									->textarea(
										[ 
											'class' 				=> 'form-control', 
											'maxlength' 			=> true, 
											'data-type' 			=> 'text',
											'data-typevalidation' 	=> 'number',
										])
									->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]apps_desarrolladas")
									->textarea(
										[ 
											'class' 				=> 'form-control', 
											'maxlength' 			=> true, 
											'data-type' 			=> 'text',
											'data-typevalidation' 	=> 'number',
										])
									->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]nombre_aplicaciones")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-2'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]tipo_accion")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-4'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]descripcion")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-2'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]responsable_accion")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]tiempo_desarrollo")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
				
				</div>
				
				<div class='col-sm-4'>
				
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]tic")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]tipo_uso_tic")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]digitales")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-2'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]tipo_uso_digitales")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-4'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]no_tic")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-2'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]tipo_uso_no_tic")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]tiempo_uso_tic")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
				
				</div>
				
				<div class='col-sm-4'>
				
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]numero_obras")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-2'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]tipo_obras")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-4'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]indice_temas")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]numero_pruebas")
									->textarea(
										[ 
											'class' 				=> 'form-control', 
											'maxlength' 			=> true, 
											'data-type' 			=> 'text',
											'data-typevalidation' 	=> 'number',
										])
									->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-1'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]numero_disecciones")
									->textarea(
										[ 
											'class' 				=> 'form-control', 
											'maxlength' 			=> true, 
											'data-type' 			=> 'text',
											'data-typevalidation' 	=> 'number',
										])
									->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
					
					<div class='col-sm-3'>
						<?= $form->field($ejecucionFase, "[$sesion->id][$index]observaciones")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
					</div>
				
				</div>
				
			</div>
		
		<?php 
			$index++;
			endforeach;
		?>
		
	</div>

</div>
