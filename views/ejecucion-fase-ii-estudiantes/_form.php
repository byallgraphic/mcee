<?php

/**********
Versión: 001
Fecha: 2018-08-23
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE II ESTUDIANTES
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
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
---------------------------------------
**********/


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nex\chosen\Chosen;

if( !$sede ){
	$this->registerJs( "$( cambiarSede ).click()" );
	return;
}

$this->registerJsFile(
    '@web/js/ejecucionFaseIIEstudiantes.js',
    [
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\dosamigos\editable\EditableBootstrapAsset::className(),
					]
	]
);

/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */
/* @var $form yii\widgets\ActiveForm */

if( $guardado ){
	
	$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
	
	$this->registerJs( "
	  swal({
			text: 'Registro guardado',
			icon: 'success',
			button: 'Salir',
		});" 
	);
}

?>

<style>
	.col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1{
		padding: 0px;
	}
	
	.title{
		height: 100px;
		background-color: #ccc;
	}
	
	.title > div > span{
		height: 100px;
	}
	
	.title2 > div > span{
		height: 70px;
	}
	
	.panel-body{
		overflow: auto;
	}
	
	.row{
		width: 300%;
	}
	
	row-normal{
		width: 100%;
	}
</style>

<div class="form-group">
		
		<?= Html::a('Volver', 
									[
										'semilleros/index',
										'esDocente' => $esDocente,
										'anio' 		=> $anio,
									], 
									['class' => 'btn btn-info']) ?>
				
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
            </div>
            <div id="listEstudiantes" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar estudiantes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="ejecucion-fase-form">

	<h3 style='background-color:#ccc;padding:5px;'><?= Html::encode( 'DATOS IEO' ) ?></h3>

    <?php $form = ActiveForm::begin([ 
							'action'=> Yii::$app->urlManager->createUrl([
												'ejecucion-fase-ii-estudiantes/create', 
												'anio' 		=> $anio, 
												'esDocente' => $esDocente, 
											]) 
						]); ?>

    <?= $form->field($profesional, 'id_institucion')->dropDownList([ $institucion->id => $institucion->descripcion ])->label( 'Institución educativa' )?>

    <?= $form->field($profesional, 'id_sede')->dropDownList([ $sede->id => $sede->descripcion ])->label( 'Sede' ) ?>

    <?= $form->field($profesional, 'id_profesional_a')->widget(
        Chosen::className(), [
        'items' => $docentes,
        'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
        'multiple' => true,
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ],
        'placeholder' => 'Seleccione algunas opciones',
    ])->label( 'Profesional A' ); ?>

    <?= $form->field($profesional, 'curso_participantes')->widget(
        Chosen::className(), [
        'items' => $cursos,
        'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
        'multiple' => true,
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ],
        'placeholder' => 'Curso de los participantes',
    ])->label( 'Curso de los participantes' ); ?>

    <?= $form->field($profesional, "estudiantes_id")
        ->hiddenInput()
        ->label(null,['style'=>'display:none'])?>

	<?= Html::hiddenInput( 'guardar', 1, [ 'id' => 'guardar', 'value' => 1 ]) ?>
	
	<div class="form-group">
        <?= Html::Button('Agregar sesión', ['class' => 'btn btn-success', 'id' => 'btnAddSession' ]) ?>
    </div>
    
	<?php 	
		if( true || !empty( $profesional->id_profesional_a ) && !empty( $profesional->curso_participantes ) )
		{	
			echo $this->render( 'sesiones', [ 
						'datosModelos' 	=> $datosModelos,
						'form' 			=> $form,
						'sesiones' 		=> $sesiones,
					]);
	?>
		<div class='container-fluid' style='margin:10px 0;'>
		
			<div class='row text-center' style='width:100%;'>
				
				<div class='col-sm-8'>
					<span total class='form-control' style='background-color:#ccc;'>CONDICIONES INSTITUCIONALES</span>
				</div>
				
				<div class='col-sm-4'>
					<span total class='form-control' style='background-color:#ccc;'></span>
				</div>
			
			</div>
			
			<div class='row text-center title' style='width:100%;'>
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Por parte de la IEO</span>
				</div>
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Por parte de UNIVALLE</span>
				</div>
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>Por parte de la SEM</span>
				</div>
				<div class='col-sm-2'>
					<span total class='form-control' style='background-color:#ccc;'>OTRO</span>
				</div>
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Número de Sesiones participantes por curso</span>
				</div>
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Número de estudiantes participantes por curso (Promedio)</span>
				</div>
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Total sesiones por IEO</span>
				</div>
				<div class='col-sm-1'>
					<span total class='form-control' style='background-color:#ccc;'>Total estudiantes IEO (Promedio)</span>
				</div>
				
			</div>
			
			<div class='row text-center' id='condiciones-institucionales' style='width:100%;'>
				
				<div class='col-sm-2'>
					<?= $form->field($condiciones, "parte_ieo")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-2'>
					<?= $form->field($condiciones, "parte_univalle")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-2'>
					<?= $form->field($condiciones, "parte_sem")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-2'>
					<?= $form->field($condiciones, "otro")->textarea([ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($condiciones, "participantes_por_curso")
							->textarea([ 
								'class' 		=> 'form-control', 
								'maxlength' 	=> true, 
								'data-type' 	=> 'number',
								'data-disabled' => 'true',
							])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($condiciones, "promedio_estudiantes_por_curso")
							->textarea([ 
								'class' 		=> 'form-control', 
								'maxlength' 	=> true, 
								'data-type' 	=> 'number',
								'data-disabled' => 'true',
							])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($condiciones, "total_sesiones")
							->textarea([ 
								'class' 		=> 'form-control', 
								'maxlength' 	=> true, 
								'data-type' 	=> 'number',
								'data-disabled' => 'true',
							])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>
				
				<div class='col-sm-1'>
					<?= $form->field($condiciones, "total_estudiantes")
							->textarea([ 
								'class' 		=> 'form-control', 
								'maxlength' 	=> true, 
								'data-type' 	=> 'text',
								'data-disabled' => 'true',
							])->label( null, [ 'style' => 'display:none' ]) ?>
				</div>

			</div>
			
		</div>

		<div class="form-group">
			<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
		</div>
		
	<?php 
		}
	?>

    <?php ActiveForm::end(); ?>

</div>
