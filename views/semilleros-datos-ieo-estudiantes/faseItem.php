<?php
/**********
Versión: 001
Fecha: 2018-08-16
Desarrollador: Edwin Molina Grisales
Descripción: Formulario CONFORMACION SEMILLEROS TIC ESTUDIANTES
				Muestrea el contenido de cada acordeon de las fases
---------------------------------------
Modificaciones:
Fecha: 2018-10-31
Persona encargada: Edwin Molina Grisales
Descripción: Se permite guardar o modificar los registros por parte del usuario
---------------------------------------
Modificaciones:
Fecha: 2018-09-19
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin XEditable, para poderlos editar
---------------------------------------
**********/

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

use nex\chosen\Chosen;
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
			<span total class='form-control' style='background-color:#ccc;height:70px;'>Curso</span>
		</div>
		
		<div class="col-sm-1" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Cantidad inscritos convocatoria</span>
		</div>
		
		<div class="col-sm-2" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Frecuencia sesiones</span>
		</div>
		
		<div class="col-sm-2" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Jornada</span>
		</div>
		
		<div class="col-sm-2" style='padding:0px;'>
			<span total class='form-control' style='background-color:#ccc;height:70px'>Recursos requeridos</span>
		</div>
		
		<div class="col-sm-3" style='padding:0px;'>
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

				<?= $form->field($acuerdo, "[$fase->id][$index]curso")->widget(
						Chosen::className(), [
							'items' => $cursos,
							'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
							'multiple' => true,
							'clientOptions' => [
								'search_contains' => true,
								'single_backstroke_delete' => false,
							],
                            'placeholder' => 'Seleccione algunos grupos',
					])->label(null,['style'=>'display:none'])?>

                <?= $form->field($acuerdo, "[$fase->id][$index]estudiantes_id")
                    ->hiddenInput()
                    ->label(null,['style'=>'display:none'])?>
			</div>
			
			<div class="col-sm-1" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]cantidad_inscritos" )
						->textarea([ 
								'class' 	=> 'form-control',
								'data-type' => 'number',
							])
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-2" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]frecuencia_sesiones" )
						->dropDownList( $parametros, [ 'class' => 'form-control', 'prompt' => 'Seleccione...' ])
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-2" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]jornada" )
						->dropDownList( $jornadas, [ 'class' => 'form-control', 'prompt' => 'Seleccione...' ])
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-2" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]recursos_requeridos" )
						->dropDownList( $recursos, [ 'class' => 'form-control', 'prompt' => 'Seleccione...'])
						->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class="col-sm-3" style='padding:0px;'>
				<?= $form->field($acuerdo, "[$fase->id][$index]observaciones" )
						->textarea([ 'class' => 'form-control', 'data-type' => 'textarea' ])
						->label(null,['style'=>'display:none']) ?>
			</div>
			
		</div>
		
	<?php
		$index++; 
		endforeach;
	?>
</div>


	

