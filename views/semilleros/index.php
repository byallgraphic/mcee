<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}

/**********
Versión: 001
Fecha: 18-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Index donde van los botones se semilleros tic
---------------------------------------
Fecha: 2019-02-12
Desarrollador: Edwin Molina Grisales
Descripción: Se pide selección de año y tipo al ingresar a este formulario
---------------------------------------

**********/


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use yii\bootstrap\Modal;

use app\models\Sedes;
use app\models\Instituciones;

use yii\widgets\ActiveForm;

use yii\bootstrap\Button;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsginaturasBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$tag = [];
$selectAnios = preg_replace('/\n+/', '', Html::dropDownList( "anio", null, $anios, ['id'=>'swal-anio','class'=>'swal2-input', 'prompt' => 'Seleccione...' ] ) );
$selectTiposSemilleros = preg_replace('/\n+/', '', Html::dropDownList( "docente", null, $tiposSemilleros, ['id'=>'swal-tipo','class'=>'swal2-input', 'prompt' => 'Seleccione...'] ) );

$this->title = "Semilleros TIC";
$this->params['breadcrumbs'][] = $this->title;

$displayEstudiante 	= "display:none;";
$displayDocente 	= "display:none;";

$url = Url::to("index.php?r=semilleros/index");

$script = <<< JSSCRIPT
	Swal.fire({
		allowEscapeKey: false,
		allowOutsideClick: false,
		title: 'Seleccione año',
		html:
			'<label>Año</label>$selectAnios' +
			'<label>Tipo Semillero</label>$selectTiposSemilleros',
			focusConfirm: false,
			preConfirm: () => {
			  
				if( !$('#swal-anio').val() || !$('#swal-tipo').val() )
				{
					return false;
				}
				else
				{
					window.location.href = "$url"+"&esDocente="+$('#swal-tipo').val()+"&anio="+$('#swal-anio').val();
				}
			}
		});

		
JSSCRIPT;

if( !isset( $esDocente ) )
{
	$this->registerJs($script);
}
else{

	if( $esDocente ){
		$displayDocente = '';
	}
	else{
		$displayEstudiante = '';
	}
}
?>


<div id="modal" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header" style='background-color:#ccc'>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>Ciclos</h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>


<div class="asignaturas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
                
    </p>

    <div class="semilleros-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<div class="panel panel-info" style='<?=$displayDocente?>'>
		
		<div class="panel-heading">
			<h3 class="panel-title">Docentes</h3>
		</div>
		
		<div class="panel-body">
			
			<div class="form-group">
			   <?= Html::a('Creación Semilleros TIC docentes', 
										[
											'semilleros-datos-ieo/create',
											'anio'	=> $anio,
											'esDocente'	=> $esDocente,
											
										], 
										['class' => 'btn btn-success'
				]) ?>
				
				 <?= Html::a('Ejecución fase I', 
										[
											'ejecucion-fase-i/create',
											'anio'	=> $anio,
											'esDocente'	=> $esDocente,
											
										], 
										['class' => 'btn btn-success'
				]) ?> 
				
				<?= Html::a('Ejecución Fase II', 
										[
											
											'ejecucion-fase-ii/create',
											'anio'	=> $anio,
											'esDocente'	=> $esDocente,
										], 
										['class' => 'btn btn-success'
				]) ?>
				
				<?= Html::a('Ejecución fase III', 
										[
											'ejecucion-fase-iii/create',
											'anio'	=> $anio,
											'esDocente'	=> $esDocente,
										], 
										['class' => 'btn btn-success'
				]) ?>
				
				
			</div>

			<div class="form-group">
				<?= Html::a('Diario de campo', 
											[
												'semilleros-tic-diario-de-campo/index',
												'anio'	=> $anio,
												'esDocente'	=> $esDocente,
											], 
											['class' => 'btn btn-success']) ?>
											
											
				<?= Html::a('Resumen Operativo', 
											[
												'resumen-operativo-fases-docentes/index',
												'anio'	=> $anio,
												'esDocente'	=> $esDocente,
												
											], 
											['class' => 'btn btn-success']) ?>
											
				<?= Html::a('Población', 
											[
												'instrumento-poblacion-docentes/create',
												'anio'	=> $anio,
												'esDocente'	=> $esDocente,
											], 
											['class' => 'btn btn-success']) ?>

			</div>
			
			<div class='text-right'>
				<?= Html::a('Cambiar a estudiantes', 
						[
							'semilleros/index',
							'esDocente'	=> 0,
							'anio' 		=> $anio,
						],
						['class' => 'btn btn-warning']
					) ?>

			</div>
		
		</div>
	
	</div>
	
	<div class="panel panel-info" style='<?=$displayEstudiante?>'>
		
		<div class="panel-heading">
			<h3 class="panel-title">Estudiantes</h3>
		</div>
		<div class="panel-body">
		
		<div class="form-group">
		
		
		<?= Html::a('Creación semilleros TIC estudiantes', 
									[
										'semilleros-datos-ieo-estudiantes/create',
										'anio'	=> $anio,
										'esDocente'	=> $esDocente,
									], 
									['class' => 'btn btn-success']) ?>
									
		 <?= Html::a('Ejecución fase I', 
								[
									'ejecucion-fase-i-estudiantes/create',
									'anio'	=> $anio,
									'esDocente'	=> $esDocente,
								], 
								['class' => 'btn btn-success'
		]) ?> 
		<?= Html::a('Ejecución fase II', 
										[
											'ejecucion-fase-ii-estudiantes/create',
											'anio'	=> $anio,
											'esDocente'	=> $esDocente,
										], 
										['class' => 'btn btn-success'
				]) ?> 
		<?= Html::a('Ejecución fase III', 
										[
											'ejecucion-fase-iii-estudiantes/create',
											'anio'	=> $anio,
											'esDocente'	=> $esDocente,
										], 
										['class' => 'btn btn-success'
				]) ?> 

		</div>

		<div class="form-group">
		<?= Html::a('Diario de campo', 
									[
										'semilleros-tic-diario-de-campo-estudiantes/index',
										'anio'	=> $anio,
										'esDocente'	=> $esDocente,
									], 
									['class' => 'btn btn-success']) ?>
									
									
		<?= Html::a('Resumen Operativo', 
									[
										'resumen-operativo-fases-estudiantes/index',
										'anio'	=> $anio,
										'esDocente'	=> $esDocente,
									], 
									['class' => 'btn btn-success']) ?>
									
		<?= Html::a('Población', 
									[
										'instrumento-poblacion-estudiantes/create',
										'anio'	=> $anio,
										'esDocente'	=> $esDocente,
									], 
									['class' => 'btn btn-success']) ?>
									


		</div>
		
		<div class='text-right'>
				<?= Html::a('Cambiar a docentes', 
							[
								'semilleros/index',
								'esDocente'	=>1, 
								'anio' 		=> $anio,
							],
							['class' => 'btn btn-warning']
						) ?>
			</div>

	</div>
	
	</div>


</div>
<?php ActiveForm::end(); ?>