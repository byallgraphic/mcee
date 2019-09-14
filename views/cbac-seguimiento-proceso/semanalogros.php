<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;
use app\models\CbacOrientacionMetodologicaActividades;
use yii\helpers\ArrayHelper;
$orientacion = new CbacOrientacionMetodologicaActividades();

//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	
	$id = $_GET['id'];
	// traer el id de la tabla CbacOrientacionMetodologicaActividades para luego traer el modelo con los datos correspondintes
	$oma = new CbacOrientacionMetodologicaActividades();
	$oma = $oma->find()->where("id_logros = $idLogros and id_seguimiento_proceso =". $id)->all();
	$oma = ArrayHelper::getColumn($oma,'id');
	
	// traer el modelo con los datos de cada actividad
	$orientacion = CbacOrientacionMetodologicaActividades::findOne($oma[0]);
}
?>

<div class="container-fluid">
            <div class="ieo-form">
			
				<div class="row">
					
					<div id="<?= $idActividad."_".substr($dataLogros,0,5);?>"> </div>
				 
				</div>  
                 
                <div class="row">
				  <div class="col-md-8"><?= $form->field($orientacion, "[$idLogros]descripcion")->textarea(['rows' => '3' ])->label("ORIENTACION METODOLÓGICA")?></div>
				  <div class="col-md-4"></div>
				</div> 
					<?= $form->field($orientacion, "[$idLogros]id_actividades")->hiddenInput( [ 'value' => $idActividad ] )->label(false ) ?>
					<?= $form->field($orientacion, "[$idLogros]id_logros")->hiddenInput( [ 'value' => $idLogros ] )->label(false ) ?>
					
			</div>
</div>