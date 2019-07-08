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




$this->title = "Iniciación Sensibilización Artistica";
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
			<h3 class="panel-title">Sensibilización Artistica</h3>
		</div>
		<div class="panel-body">
			
			<div class="form-group">
		   <?= Html::a('1. Planeación', 
									[
										'isa-iniciacion-sencibilizacion-artistica/index',
										// 'idReporte'	=> 1,
									], 
									['class' => 'btn btn-success'
			]) ?>
			
			 <?= Html::a('2. Reporte', 
									[
										'rom-reporte-operativo-misional/index',
										// 'idReporte'		=> 2,
									], 
									['class' => 'btn btn-success'
			]) ?> 
			
			<?= Html::a('3. Informe de ejecución semanal', 
									[
										
										'is-isa-informe-semanal-isa/index',
										// 'idReporte'		=> 3, 
									], 
									['class' => 'btn btn-success'
			]) ?>
			
			<?= Html::a('4. Orientación del proceso - Seguimiento', 
									[
										'isa-seguimiento-proceso/index',
										// 'idReporte'		=> 4,
									], 
									['class' => 'btn btn-success'
			]) ?>
			
			
		</div>

		<div class="form-group">
			
			<?= Html::a('4. Orientación del proceso - Orientación', 
									[
										'isa-orientacion-proceso/index',
										// 'idReporte'		=> 4,
									], 
									['class' => 'btn btn-success'
			]) ?>
			
			<?= Html::a('5. Consolidado por mes - Operativo', 
										[
											'isa-iniciacion-sensibilizacion-artistica-consolidado/index',
											// 'idReporte'		=> 5,
										], 
										['class' => 'btn btn-success']) ?>
										
			<?= Html::a('5.Consolidado por mes - Misional', 
										[
											'isa-consolidado-misional/index',
											// 'idReporte'		=> 5,
										], 
										['class' => 'btn btn-success']) ?>
										
										
			
										


		</div>
			
		</div>
	
	</div>
	
	


</div>
<?php ActiveForm::end(); ?>