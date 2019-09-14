<?php
/********************
Modificaciones:
Fecha: 04-07-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: Creacion del formulario
----------------------------------------
**********/

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

// use yii\helpers\Html;
// use yii\web\helpers\CHtml;
// use yii\bootstrap\ActiveForm;
// use dosamigos\datepicker\DatePicker;
// use app\models\IsaActividadesIsa;

// use yii\helpers\ArrayHelper;
// use nex\chosen\Chosen; 
// use yii\helpers\Url;
use app\models\CbacPersonasComunidad;


$personas = new CbacPersonasComunidad();
//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	$id = $_GET['id'];
	//traer el id de la tabla isa.actividades_isa para luego traer el modelo con los datos correspondintes
	$personas = new CbacPersonasComunidad();
	$personas = $personas->find()->where("id_actividades_consolidado = $idActividad and id_consolidado_misional=". $id)->one();
	
	
}


?>

<div class="panel panel-info">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6"><?= $form->field($personas, "[$idActividad]mision")->textInput() ?></div>
			<div class="col-md-6"><?= $form->field($personas, "[$idActividad]descripcion")->textInput() ?></div>
			<div class="col-md-6"><?= $form->field($personas, "[$idActividad]hallazgos")->textInput() ?></div>
			
		</div>
	</div>	 
</div>	