<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;
use app\models\CbacPorcentajesActividades;
use app\models\IsIsaActividadesIsIsa;
use app\models\IsaActividadesRom;
use yii\helpers\ArrayHelper;

$porcentajes = new CbacPorcentajesActividades();
//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	$id = $_GET['id'];
	// traer el id de la tabla IsaOrientacionMetodologicaVariaciones para luego traer el modelo con los datos correspondintes
	$pa = new CbacPorcentajesActividades();
	$pa = $pa->find()->where("id_rom_actividades = $idActividad and id_seguimiento_proceso =". $id)->all();
	$pa = ArrayHelper::getColumn($pa,'id');
	
	// traer el modelo con los datos de cada actividad
	$porcentajes = CbacPorcentajesActividades::findOne($pa[0]);
}

?>

<div class="container-fluid">
    <div class="ieo-form">
			<div class="row">
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]total_sesiones")->textInput(['readonly' => true  ])?></div>
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]avance_sede")->textInput( [ 'readonly' => true ])?></div>
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]avance_ieo")->textInput( [ 'readonly' => true ])?> </div>
			</div>
             

			<div class="row">
			  <div class="col-md-6"><?= $form->field($porcentajes, "[$idActividad]seguimiento_actividades")->textInput( )?></div>
			  <div class="col-md-6"><?= $form->field($porcentajes, "[$idActividad]evaluacion_actividades")->textInput()?></div>
			</div>			 
					<?= $form->field($porcentajes, "[$idActividad]id_rom_actividades")->hiddenInput( [ 'value' => $idActividad ] )->label(false ) ?>
                    <?= $form->field($porcentajes, "[$idActividad]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
            </div>
</div>