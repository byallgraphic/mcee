<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I
---------------------------------------
Modificaciones:
Fecha: 2019-02-12
Descripción: Ya no se pide el ciclo y el año viene por url
---------------------------------------
Fecha: 2018-11-06
Descripción: Se usa en los select el plugin chosen y se modifica la función que calcula el total de sesiones
---------------------------------------
Modificaciones:
Fecha: 2018-10-16
Descripción: Se premite insertar y modificar registros del formulario Ejecucion Fase I Docentes
---------------------------------------
Modificación: 
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
**********/


use yii\helpers\Html;
use nex\chosen\Chosen;
use yii\widgets\ActiveForm;
use dosamigos\editable\Editable;


// $this->registerCssFile(Yii::$app->request->baseUrl.'/css/bootstrap-multiselect.css');
// $this->registerJsFile(Yii::$app->request->baseUrl.'/js/bootstrap-multiselect.js',['depends' => [\yii\web\JqueryAsset::className()]]);
// $this->registerJsFile(Yii::$app->request->baseUrl.'/js/multiples.js',['depends' => [\yii\web\JqueryAsset::className()]]);

if( !$sede ){
	$this->registerJs( "$( cambiarSede ).click()" );
	return;
}



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
	
$this->registerJsFile(
    '@web/js/ejecucionFaseI.js',
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

?>
<div class="form-group">
		
		<?= Html::a('Volver', 
									[
										'semilleros/index',
										'esDocente' => $esDocente,
										'anio' => $anio,
									], 
									['class' => 'btn btn-info']) ?>
				
</div>
<div class="ejecucion-fase-form">

	<h3 style='background-color:#ccc;padding:5px;'><?= Html::encode( 'DATOS IEO' ) ?></h3>

    <?php $form = ActiveForm::begin([ 
							'action'=> Yii::$app->urlManager->createUrl([
												'ejecucion-fase-i/create', 
												'anio' 		=> $anio, 
												'esDocente' => $esDocente, 
											]) 
						]); ?>

    <?= $form->field($datosIeoProfesional, 'id_institucion')->dropDownList([ $institucion->id => $institucion->descripcion ])->label( 'Institución educativa' )?>

    <?= $form->field($sede, 'id')->dropDownList([ $sede->id => $sede->descripcion ])->label( 'Sede' ) ?>

    <?= $form->field($datosIeoProfesional, 'id_profesional_a')->dropDownList( $profesionales, [ 'prompt' => 'Seleccione...', 'onchange' => 'guardar.value = 0; this.form.submit();'] )->label('Profesional A.') ?>
    
	<?= $form->field($datosIeoProfesional, 'estado')->hiddenInput( [ 'value' => 1 ] )->label( null , [ 'style' => 'display:none' ] ); ?>
	
	<?= Html::hiddenInput( 'guardar', 1, [ 'id' => 'guardar', 'value' => 1 ]) ?>
	
	<div class="form-group">
        <?= Html::button('Agregar sesión', ['class' => 'btn btn-success', 'id' => 'btnAddSession' ]) ?>
    </div>
	
	<?= $this->render( 'sesiones', [ 
										'idPE' 			=> null,
										'model' 		=> $model,
										'sesiones'		=> $sesiones,
										'form'			=> $form,
										'condiciones'	=> $condiciones,
										'datosModelos'	=> $datosModelos,
										'docentes' 		=> $docentes,
									]) ?>

									
	<div class='container-fluid' style='margin:10px 0;'>
	
		<div class='row text-center'>
			
			<div class='col-sm-8'>
				<span total class='form-control' style='background-color:#ccc;'>CONDICIONES INSTITUCIONALES</span>
			</div>
			
			<div class='col-sm-4'>
				<span total class='form-control' style='background-color:#ccc;'></span>
			</div>
		
		</div>
		
		<div class='row text-center title2'>
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
			<div class='col-sm-2'>
				<span total class='form-control' style='background-color:#ccc;'>Número de Sesiones por docentes participante </span>
			</div>
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Total sesiones por IEO</span>
			</div>
			<div class='col-sm-1'>
				<span total class='form-control' style='background-color:#ccc;'>Total Docentes participantes por IEO</span>
			</div>
			
		</div>
		
		<div class='row text-center' id='condiciones-institucionales'>
			
			<div class='col-sm-2'>
				<?= $form->field($condiciones, "parte_ieo")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,[ 'style' => 'display:none' ]) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field($condiciones, "parte_univalle")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,[ 'style' => 'display:none' ]) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field($condiciones, "parte_sem")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,[ 'style' => 'display:none' ]) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field($condiciones, "otro")->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,[ 'style' => 'display:none' ]) ?>
			</div>
			
			<div class='col-sm-2'>

				<?= $form->field($condiciones, "sesiones_por_docente")
						->textarea( [ 
							'class' => 'form-control', 
							'maxlength' => true, 
							'data-type' => 'number',
						])->label(null,[ 'style' => 'display:none' ]) ?>
			</div>
			
			<div class='col-sm-1 total-sesiones'>
				<?= $form->field($condiciones, "total_sesiones_ieo")
						->textarea( [ 
							'class' => 'form-control', 
							'maxlength' => true, 
							'data-type' => 'textarea', 
							'data-disabled' => 'true',
						])->label(null,[ 'style' => 'display:none' ]) ?>
			</div>
			
			<div class='col-sm-1 total-docentes'>
				<?= $form->field($condiciones, "total_docentes_ieo")
						->textarea( [ 
							'class' => 'form-control', 
							'maxlength' => true, 
							'data-type' => 'textarea', 
							'data-disabled' => 'true',
						])->label(null,[ 'style' => 'display:none' ]) ?>
			</div>

		</div>
			
	</div>
	
	
									
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
    
	<?php ActiveForm::end(); 
		$this->registerJs(
			'$(document).ready(function(){
				$(".total-sesiones").click(function(){
					var total = 0;
					var list = $(".sesiones textarea");
					for (var i=0;i<list.length;i++) {
						if(!isNaN(parseInt(list[i].value))){
							total += parseInt(list[i].value);
						}	
					}

					$("#condicionesinstitucionales-total_sesiones_ieo").text(total);		
				});

				$(".total-docentes").click(function(){
					$("#condicionesinstitucionales-total_docentes_ieo").text($( "select[id$=docente] option:selected" ).length);
				});
				
			});
			
			'
		);
	
	?>

	


</div>
