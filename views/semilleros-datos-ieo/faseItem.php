<?php

/**********
Versión: 001
Fecha: 2018-08-28
Desarrollador: Edwin Molina Grisales
Descripción: Formulario SEMILLEROS DATOS IEO
---------------------------------------
Modificaciones:
Fecha: 2019-02-12
Desarrollador: Edwin Molina Grisales
Descripción: El plugin CHOSEN para docentes se deja de elección multiple
---------------------------------------
Fecha: 2019-02-04
Descripción: Se desagregan los campos Profesional A y docentes de cada sesión con respecto a a la conformación de los semilleros
			 y se dejan los campos select en español
---------------------------------------
Modificaciones:
Fecha: 2018-11-06
Desarrollador: Edwin Molina Grisales
Descripción: Se hacen modificaciones varias para guardar varios profesionales A, docentes aliados y nombres de docentes
---------------------------------------
Modificaciones:
Fecha: 2018-10-29
Persona encargada: Edwin Molina Grisales
Descripción: Se agregan filas dinámicas traídas de los modelos
---------------------------------------
Modificaciones:
Fecha: 2018-09-19
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin XEditable, para poderlos editar
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use nex\chosen\Chosen;

use app\models\AcuerdosInstitucionales;

// $acuerdos = [new AcuerdosInstitucionales()];
// $idPE = 0;

$total_docentes = 0;
?>

<div class="container-fluid" id='container-<?= $fase->id ?>' fase='<?= $fase->id ?>'>

	<div class="form-group">
        <?= Html::button('Agregar', [
					'class' => 'btn btn-success', 
					'id' 	=> 'btnAgregar'.$fase->id, 
				]) ?>
        
		<?= Html::button('Eliminar', [
					'class' => 'btn btn-danger',
					'id' 	=> 'btnEliminar'.$fase->id, 
					'style'	=> 'display:none',
				]) ?>
    </div>

	<div class=row style='text-align:center;'>
		
		<div class="col-sm-2" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px;'>Nombre del docente</span>
		</div>
		
		<div class="col-sm-2" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Nombre de las asignaturas asignadas</span>
		</div>
		
		<div class="col-sm-2" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Especialidad de la Media Técnica o Técnica</span>
		</div>
		
		<div class="col-sm-1" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Frecuencia sesiones</span>
		</div>
		
		<div class="col-sm-1" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Jornada</span>
		</div>
		
		<div class="col-sm-1" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Recursos requeridos</span>
		</div>
		
		<div class="col-sm-1" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Total Docentes</span>
		</div>
		
		<div class="col-sm-2" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>OBSERVACIONES</span>
		</div>
	
	</div>
	
	<?php foreach( $acuerdos as $key => $acuerdo ) :  ?>
	
		<div class=row id='dvFilas-<?= $fase->id."-".$index ?>' fase='<?= $fase->id ?>' >
		
			<div class="col-sm-2" style='padding:0px;display:none;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]id" )
						->hiddenInput()
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-2" style='padding:0px;'>
				<?= $form->field( $acuerdo, "[$fase->id][$index]id_docente" )->widget(
					Chosen::className(), [
						'items' => $docentes,
						'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
						'multiple' => true,
						'clientOptions' => [
							'search_contains' => true,
							'single_backstroke_delete' => false,
						]
				])->label(null,['style'=>'display:none']); ?>
			</div>
			
			<div class="col-sm-2" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]asignatura" )
						->textarea()
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-2" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]especialidad" )
						->textarea()
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-1" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]frecuencias_sesiones" )
						->dropDownList( $parametros, [ 'prompt' => 'Seleccione...'])
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-1" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]jornada" )
						->dropDownList( $jornadas, [ 'prompt' => 'Seleccione...'])
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-1" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]recursos_requeridos" )
						->dropDownList( $recursos, [ 'prompt' => 'Seleccione...'])
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-1" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]total_docentes" )
						->textarea( [
							'data-type' => 'number',
							'data-disabled' => 'true',
						] )
						->label(null,['style'=>'display:none']) ?>
			</div>
		
			<div class="col-sm-2" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]observaciones" )
						->textarea()
						->label(null,['style'=>'display:none']) ?>
			</div>
		
		</div>
	
	<?php
		$index++; 
		
		$total_docentes += $acuerdo->total_docentes;
		
		endforeach; 
	?>
	
</div>

<div>

	<div><label>Total docentes por fase: </label>&nbsp;<span id='total_docentes-<?= $fase->id ?>' style='text-align: center;'><?= $total_docentes ?></span></div>

</div>


	

