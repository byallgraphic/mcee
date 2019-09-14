<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE III
---------------------------------------
Modificaciones:
Fecha: 2019-02-12
Descripción: Ya no se pide el ciclo y el año viene por url y todas las realiciones con id_ciclo se cambian a año
---------------------------------------
Fecha: 2018-09-18
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin Textarea, para poderlos editar
---------------------------------------
**********/


use yii\helpers\Html;
use yii\widgets\ActiveForm;

if( !$sede ){
	$this->registerJs( "$( cambiarSede ).click()" );
	return;
}
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/bootstrap-multiselect.css');
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/bootstrap-multiselect.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/multiples.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile(
    '@web/js/ejecucionFaseIII.js',
    [
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\dosamigos\editable\EditableBootstrapAsset::className(),
						\dosamigos\editable\EditableComboDateAsset::className(),
						// \dosamigos\editable\EditableDatePickerAsset::className(),
						\dosamigos\editable\EditableDateTimePickerAsset::className(),
					]
	]
);

if( $guardado ){
	
	$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
	
	$this->registerJs( "
	  swal({
			text: 'Registro guardados correctamente',
			icon: 'success',
			button: 'Salir',
		});" 
	);
	
}

$this->registerJs( 
	"
	con = ".( count( $models )+1 ).";
	min = ".( count( $models )-1 ).";
	"
);

/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */
/* @var $form yii\widgets\ActiveForm */
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
	
	.title3 > div > span{
		height: 120px;
	}
</style>

<div class="ejecucion-fase-form">

    <?php $form = ActiveForm::begin([
							'action'=> Yii::$app->urlManager->createUrl([
												'ejecucion-fase-iii/create', 
												'esDocente' => $esDocente, 
												'anio' 		=> $anio, 
											]) 
						]); ?>
	
	<div class="form-group">
		
		<?= Html::button('Agregar' , ['class' => 'btn btn-success', 'id' => 'btnAddFila1' ]) ?>
		
		<?= Html::button('Eliminar', ['class' => 'btn btn-danger', 'id' => 'btnRemoveFila1', "style" => "display:none" ]) ?>
		
		<?= Html::hiddenInput( 'guardar', 1, [ 'id' => 'guardar', 'value' => 1 ]) ?>
		
	</div>
    
	<?= $this->render( 'sesiones', [
										'model' 		=> $model,
										'models' 		=> $models,
										'institucion' 	=> $institucion,
										'sede' 			=> $sede,
										'docentes' 		=> $docentes,
										'fase' 			=> $fase,
										'form' 			=> $form,
										'profesional' 	=> $profesional,
										'profesionales' => $profesionales,
										'cursos' 		=> $cursos,
										'listaSesiones'	=> $listaSesiones,
									]) ?>
									
	<div class='container-fluid' style='margin:10px 0;'>
	
		<div class='row text-center'>
			
			<div class='col-sm-12'>
				<span total class='form-control' style='background-color:#ccc;'>CONDICIONES INSTITUCIONALES</span>
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
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>OTRO</span>
			</div>
			
			<div class='col-sm-3'>
				<span total class='form-control' style='background-color:#ccc;'>Total aplicaciones usadas</span>
			</div>
			
		</div>
		
		<div class='row text-center' id='condiciones-institucionales'>
			
			<div class='col-sm-2'>
				<?= $form->field( $condiciones, "parte_ieo" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2'>
				<?= $form->field( $condiciones, "parte_univalle" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-2 '>
				<?= $form->field( $condiciones, "parte_sem" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-3'>
				<?= $form->field( $condiciones, "otro" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea'])->label(null,['style'=>'display:none']) ?>
			</div>
			
			<div class='col-sm-3'>
				<?= $form->field( $condiciones, "total_aplicaciones_usadas" )->textarea( [ 'class' => 'form-control', 'maxlength' => true, 'data-type' => 'textarea', 'data-disabled' => 'true'])->label(null,['style'=>'display:none']) ?>
			</div>

		</div>
		
	</div>
	
	<div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); 
		
	?>

</div>
