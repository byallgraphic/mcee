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
Fecha: 04-12-2018
Desarrollador: Maria Viviana Rodas
Descripción: Index donde van los botones acompañamiento in situ de gestion escolar
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




$this->title = "Acompañamiento in Situ";
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
			<h3 class="panel-title">Acompañamiento in Situ</h3>
		</div>
		<div class="panel-body">
			
			<div class="form-group">
			   <?= Html::a('Seguimiento operadores', 
										[
											'ge-seguimiento-operador/',
											'idTipoSeguimiento'	=> 1,
										], 
										['class' => 'btn btn-success'
				]) ?>
				
				
				<?= Html::a('Seguimiento Institucional', 
										[
											
											'ge-seguimiento-gestion/create',
											'idTipoSeguimiento'		=> 2, 
										], 
										['class' => 'btn btn-success'
				]) ?>
				
			</div>
			<div class="form-group">
				<?= Html::a('Seguimiento a gestores por frente', 
										[
											'ge-seguimiento-operador-frente/create',
											'idTipoSeguimiento'		=> 3,
										], 
										['class' => 'btn btn-success'
				]) ?>
				
				<?= Html::a('Seguimiento a gestión escolar', 
										[
											'ge-seguimiento-gestion/create',
											'idTipoSeguimiento'		=> 4,
										], 
										['class' => 'btn btn-success'
				]) ?> 
			</div>
			

		
			
		</div>
	
	</div>
	
	
	
	</div>


</div>
<?php ActiveForm::end(); ?>