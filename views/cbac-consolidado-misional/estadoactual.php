<?php
/********************
Modificaciones:
Fecha: 04-07-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: Creacion del formulario
----------------------------------------
**********/



use yii\helpers\Html;
use app\models\CbacEstadoActualMisional;

$estadoActual = new CbacEstadoActualMisional();
//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	$id = $_GET['id'];
	$estadoActual = new CbacEstadoActualMisional();
	$estadoActual = $estadoActual->find()->where("id_actividades_consolidado = $idActividad and id_consolidado_misional=". $id)->one();	
}
?>


   
<div class="panel panel-info">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<?= $form->field($estadoActual, "[$idActividad]estado_actual")->textInput() ?>
			</div>
			<div class="col-md-4"> 
				<div id="<?=$idActividad ?>_Logro"> </div>
			</div>
			<div class="col-md-4"> 
				<div id="<?=$idActividad ?>_Forta"> </div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<div id="<?=$idActividad ?>_Retos"> </div>
			</div>
			<div class="col-md-4"> 
				<div id="<?=$idActividad ?>_Debil"> </div>
			</div>
			<div class="col-md-4"> 
				<div id="<?=$idActividad ?>_Alarm"> </div>
			</div>
		</div>
	</div>	 
</div>	 