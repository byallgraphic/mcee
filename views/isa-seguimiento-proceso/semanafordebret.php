<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;
use app\models\IsaSemanaLogrosForDebRet;
use app\models\IsaOrientacionMetodologicaVariaciones;
use yii\helpers\ArrayHelper;

$semanLogros = new IsaSemanaLogrosForDebRet();
$orientacion = new IsaOrientacionMetodologicaVariaciones();
//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	
	$id = $_GET['id'];
	// traer el id de la tabla IsaOrientacionMetodologicaVariaciones para luego traer el modelo con los datos correspondintes
	$oma = new IsaOrientacionMetodologicaVariaciones();
	$oma = $oma->find()->where("id_variaciones_actividades = $idIsaForDebRet and id_seguimiento_proceso =". $id)->all();
	$oma = ArrayHelper::getColumn($oma,'id');
	
	// traer el modelo con los datos de cada actividad
	$orientacion = IsaOrientacionMetodologicaVariaciones::findOne($oma[0]);
}
?>


<div class="container-fluid">
            <div class="ieo-form">
			
				<div class="row">

					<div id="<?= $idActividad."_".substr($dataIsaForDebRet,0,5);?>"></div>
				</div>


				<div class="row">
				  <div class="col-md-8"><?= $form->field($orientacion, "[$idIsaForDebRet]descripcion")->textarea(['rows' => '3' ])->label("ORIENTACION METODOLÓGICA")?></div>
				  <div class="col-md-4"></div>
				</div>  
				
					<?= $form->field($orientacion, "[$idIsaForDebRet]id_variaciones_actividades")->hiddenInput( [ 'value' => $idIsaForDebRet ] )->label(false ) ?>
					<?= $form->field($orientacion, "[$idIsaForDebRet]estado")->hiddenInput( [ 'value' => 1 ] )->label(false ) ?>
            </div>
</div>