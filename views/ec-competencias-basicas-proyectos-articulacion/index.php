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
Fecha: 23-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Index donde van los botones competencias basicas proyectos pedagogicos transversales
---------------------------------------

**********/


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Sedes;
use app\models\Instituciones;

use yii\widgets\ActiveForm;

use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsginaturasBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */




$this->title = "Competencias básicas";
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="asignaturas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
                
    </p>

    <div class="semilleros-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<div class="panel panel-info">
		
		<div class="panel-heading">
			<h3 class="panel-title">Articulación Familiar</h3>
		</div>
		<div class="panel-body">
			
			<div class="form-group">
			   <?= Html::a('2. Planeación y reporte de actividad', 
										[
											'ec-datos-basicos/index',
											'idTipoInforme'	=> 25,
										], 
										['class' => 'btn btn-success'
				]) ?>
				
				
				<?= Html::a('3.A Informe de avance Mensual I.E.O Fase Plan de acción - Ejecución', 
										[
											
											'ieo/index',
											'idTipoInforme'		=> 26, 
										], 
										['class' => 'btn btn-success'
				]) ?>
				
			</div>
			<div class="form-group">
				<?= Html::a('3.A Informe de avance Mensual I.E.O Fase Plan de acción - Misional', 
										[
											'ecinformeplaneacionieo/index',
											'idTipoInforme'		=> 27,
										], 
										['class' => 'btn btn-success'
				]) ?>
				
				<?= Html::a('3. B Informe de avance Mensual I.E.O Fase Implementación Plan de acción - Ejecución', 
										[
											'implementacion-ieo/index',
											'idTipoInforme'		=> 28,
										], 
										['class' => 'btn btn-success'
				]) ?> 
			</div>
			

		<div class="form-group">
			<?= Html::a('3. B Informe de avance Mensual I.E.O Fase Implementación Plan de acción - Misional', 
										[
											'informe-avance-plan-accion-misional/index',
											'idTipoInforme'		=> 29,
										], 
										['class' => 'btn btn-success'
				]) ?> 
			<?= Html::a('4. Informe ejecutivo del estado del eje en la IEO', 
										[
											'ec-informe-ejecutivo-estado/index',
											'idTipoInforme'		=> 30,
										], 
										['class' => 'btn btn-success']) ?>
										
										
			
		</div>
		<div class="form-group">
			<?= Html::a('5 y 6. Informe Semanal Ejecución - Informe de cierre de fase', 
										[
											'informe-semanal-ejecucion-ise/index',
											'idTipoInforme'		=> 31,
										], 
										['class' => 'btn btn-success']) ?>
			<?= Html::a('5 y 6. Informe Semanal Ejecución - Informe de cierre de fase - Total ejecutivo', 
										[
											'ec-informe-semanal-total-ejecutivo/index',
											'idTipoInforme'		=> 32,
										], 
										['class' => 'btn btn-success']) ?>
										
			
		</div>
        <div class="form-group">
			<?= Html::a('7. Levantamiento de orientación misional y método', 
										[
											'ec-levantamiento-orientacion/index',
											'idTipoInforme'		=> 33,
										], 
										['class' => 'btn btn-success']) ?>
			<?= Html::a('8.Informe Avance Misional Ejes - TP IEO', 
										[
											'informe-avance-misional-ejes-tpieo/index',
											'idTipoInforme'		=> 34,
										], 
										['class' => 'btn btn-success']) ?>
										
			
		</div>	
        <div class="form-group">
			<?= Html::a('8.Informe Avance Misional Ejes - TP misional', 
										[
											'informe-avance-misional-ejes-misional/index',
											'idTipoInforme'		=> 35,
										], 
										['class' => 'btn btn-success']) ?>
			<?= Html::a('9. Informe de avance ejecución y misional del proyecto', 
										[
											'ec-informe-avance-ejecucion-misional/index',
											'idTipoInforme'		=> 36,
										], 
										['class' => 'btn btn-success']) ?>

		</div>
			
		</div>
	
	</div>
	
	
	
	</div>


</div>
<?php ActiveForm::end(); ?>