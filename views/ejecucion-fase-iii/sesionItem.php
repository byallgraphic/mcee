<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE III
---------------------------------------
Modificaciones:
Fecha: 2019-02-25
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se quita campo número de estudiantes cultivadores y docentes creadores se deja como multiplo
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

	<h3 style='background-color:#ccc;padding:5px;'><?= Html::encode( 'DATOS IEO' ) ?></h3>
	
	<?= $form->field($profesional, "[$index]id_institucion")->dropDownList([ $institucion->id => $institucion->descripcion ])->label( 'Institución educativa' )?>

	<?= $form->field($sede, "[$index]id")->dropDownList([ $sede->id => $sede->descripcion ])->label( 'Sede' ) ?>
	
	<h3 style='background-color:#ccc;padding:5px;'><?= Html::encode( 'DATOS PROFESIONALES' ) ?></h3>

	<?= $form->field( $profesional, "[$index]id_profesional_a" )->widget(
		Chosen::className(), [
			'items' => $profesionales,
			'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
			'multiple' => false,
			'clientOptions' => [
				'search_contains' => true,
				'single_backstroke_delete' => false,
			]
	])->label(null,['style'=>'display:none']) ?>
	
	
	<h3 style='background-color:#ccc;padding:5px;'><?= Html::encode( 'DATOS DE LA SESIÓN' ) ?></h3>
	
	<?= $form->field( $dataSesion, "[$index]id_sesion" )->dropDownList( $listaSesiones, [ 'prompt' => 'Seleccione...' ])->label( "Sesión" ) ?>
	
	<?= Html::activeHiddenInput($dataSesion, "[$index]id") ?>
	
	<?= $form->field($dataSesion, '['.$index.']fecha_sesion')->widget(
		DatePicker::className(), [
			
			 // modify template for custom rendering
			'template' => '{addon}{input}',
			'language' => 'es',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'dd-mm-yyyy'
			]
	])->label('Fecha de la sesión(dd-mm-aaaa)');?> 	
	
	<?= $form->field( $dataSesion, "[$index]duracion_sesion" )
				->textInput()
				->label() ?>
	
	

	<h3 style='background-color:#ccc;padding:5px;'><?= Html::encode($fase->descripcion) ?></h3>
	
	<div class='container-fluid'>
		
		<div class='row text-center title'>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre del docente creador</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Asignatura en la que se usa la aplicaión</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre del docente usuario de la Aplicación</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Grado en el que se usa la aplicación</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Número de Apps 0.0 usadas</span>
			</div>
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Nombre de las aplicaciones usadas</span>
			</div>
			
			
		</div>
		
		<div class='row text-center'>
			
			<div class='col-sm-2' style='display:none;'>
				<?= Html::activeHiddenInput( $model, "[$index]id" ) ?>
			</div>
			
			<div class='col-sm-2'>
							
				<?= $form->field( $model, "[$index]docente_creador" )->widget(
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
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]asignatura" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]docente_usuario" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]grado" )
						->textarea( [ 
							'class' => 'form-control', 
							'maxlength' => true, 
							'data-type' => 'select',
							'data-source' => json_encode($cursos),
						])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-1 apps'>
				<?= $form->field( $model, "[$index]numero_apps_usadas" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-3'>
				<?= $form->field( $model, "[$index]nombre_aplicaciones" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
		</div>
	
	
	
		<div class='row text-center'>
			
			<div class='col-sm-12'>
				<span total class='form-control' style='background-color:#ccc;'>Recursos empleados para usar las App 0.0</span>
			</div>
			
		</div>
		
		<div class='row text-center title3'>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>TIC (infraestructura existente en la IEO)</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Digitales</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Escolares (No TIC)</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de Uso del Recurso</span>
			</div>
			
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Tiempo de uso de los recursos TIC en el uso de las App 0.0 (Horas)</span>
			</div>
			
		</div>
		
		<div class='row text-center'>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]tic" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]tipo_recurso_tic" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]digitales" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]tipo_recurso_digital" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]escolares_no_tic" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-1'>
				<?= $form->field( $model, "[$index]tipo_recurso_no_tic" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-1'>
				<?= $form->field( $model, "[$index]tiempo_uso_recurso_tic" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
		</div>
		
		
		
		<div class='row text-center'>
			
			<div class='col-sm-4'>
				<span total class='form-control' style='background-color:#ccc;'>Obras derivadas en el uso de las App 0.0</span>
			</div>
			
			<div class='col-sm-6'>
				<span total class='form-control' style='background-color:#ccc;'></span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'></span>
			</div>
			
		</div>
		
		<div class='row text-center title2'>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Número</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Tipo de producción</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Indice de temas escolares disciplinares tratados y abordados a través del uso de las  App 0.0</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Indice de problematicas abordadas a través del uso de las  App 0.0</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Fecha de Uso de las aplicaciones</span>
			</div>
			
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>OBSERVACIONES GENERALES</span>
			</div>
			
		</div>
		
		<div class='row text-center'>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]numero" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'number'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]tipo_de_produccion" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]temas_escolares" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]indice_problematicas" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]fecha_uso_aplicaciones" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'date'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $model, "[$index]observaciones" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
		</div>
		
		
	<br>	
		
	<?php //echo $form->field( $model, "[$index]total_aplicaciones_usadas" )->textInput()->label( 'Total aplicaciones usadas' )?>

    <?= $form->field( $model, "[$index]estudiantes_cultivadores" )->textInput([ 'readonly' => 'readonly' ])->label( 'Número de docentes creadores' ) ?>
		
	</div>

</div>
