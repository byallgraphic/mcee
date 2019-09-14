<?php
/**********
Versión: 001
Fecha: 2018-08-16
Desarrollador: Edwin Molina Grisales
Descripción: Formulario CONFORMACION SEMILLEROS TIC ESTUDIANTES
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
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use nex\chosen\Chosen;


$this->registerJsFile(
    '@web/js/semillerosDatosIEOEstudiantes.js',
    [
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\dosamigos\editable\EditableBootstrapAsset::className(),
					]
	]
);

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

/* @var $this yii\web\View */
/* @var $model app\models\SemillerosDatosIeoEstudiantes */
/* @var $form yii\widgets\ActiveForm */
?>


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

<datalist id='list_persona_a'>
	<?php foreach( $profesionales as $data ) :?>
		<option value='<?=$data?>'>
	<?php endforeach; ?>
</datalist>

<datalist id='list_docente_aliado'>
	<?php foreach( $docentes_aliados as $key => $data ) :?>
		<option value='<?=$data?>' <?=$key?> >
	<?php endforeach; ?>
</datalist>

<div class="form-group">
		
		<?= Html::a('Volver', 
									[
										'semilleros/index',
										'esDocente' => $esDocente,
										'anio' 		=> $anio,
									], 
									['class' => 'btn btn-info']) ?>
				
</div>	

<div class="semilleros-datos-ieo-estudiantes-form">

	<h3 style='background-color: #ccc;padding:5px;'>DATOS IEO</h3>

    <?php $form = ActiveForm::begin([ 
							'action'=> Yii::$app->urlManager->createUrl([
												'semilleros-datos-ieo-estudiantes/create', 
												'anio' 		=> $anio, 
												'esDocente' => $esDocente, 
											]) 
						]); ?>

    <?= $form->field($institucion, 'codigo_dane')->dropDownList([ $institucion->codigo_dane => $institucion->codigo_dane ])->label( 'CÓDIGO DANE IEO' ) ?>
    
	<?= $form->field($datosIEO, 'id_institucion')->dropDownList([ $institucion->id => $institucion->descripcion ]) ?>

    <?= $form->field($sede, 'codigo_dane')->dropDownList([ $sede->codigo_dane => $sede->codigo_dane ], ['maxlength' => true])->label( 'CÓDIGO DANE SEDE' ) ?>
	
    <?= $form->field($datosIEO, 'id_sede')->dropDownList([ $sede->id => $sede->descripcion ], ['maxlength' => true]) ?>
	
	<?= $form->field($datosIEO, 'profecional_a')->widget(
			Chosen::className(), [
				'items' => $docentes,
				'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
				'multiple' => true,
				'clientOptions' => [
					'search_contains' => true,
					'single_backstroke_delete' => false,
				],
                'placeholder' => 'Seleccione algunas opciones',
		]); ?>
		
		
	<?= $form->field($datosIEO, 'docente_aliado')->widget(
			Chosen::className(), [
				'items' => $docentes,
				'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
				'multiple' => true,
				'clientOptions' => [
					'search_contains' => true,
					'single_backstroke_delete' => false,
				],
                'placeholder' => 'Seleccione algunas opciones',
		]); ?>
								
	<?= $form->field($datosIEO, 'id')->hiddenInput()->label( null,[ 'style' => 'display:none' ] ) ?>
	
	<?= Html::hiddenInput( 'guardar', 1, [ 'id' => 'guardar', 'value' => 1 ]) ?>
	
	<h3 style='background-color: #ccc;padding:5px;'>ACUERDOS INSTITUCIONES (CONFORMACIÓN)</h3>
	
	<?php	
			echo $this->render( 'fases',[
				'fases' 		=> $fases,
				'docentes' 		=> $docentes,
				'jornadas' 		=> $jornadas,
				'recursos' 		=> $recursos,
				'parametros' 	=> $parametros,
				'modelos' 		=> $modelos,
				'form' 			=> $form,
				'cursos' 		=> $cursos,
			]); ?>
			
			<div class="form-group">
				<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
			</div>
    
	<!-- <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
