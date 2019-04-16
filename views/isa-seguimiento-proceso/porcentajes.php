<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;
use app\models\IsaPorcentajesActividades;


$porcentajes = new IsaPorcentajesActividades();
 
?>

<div class="container-fluid">
    <div class="ieo-form">
			<div class="row">
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]total_sesiones")->textInput(['readonly' => true, 'value' => $datos['PorcentajesActividades'][$idActividad]['total_sesiones'] ])?></div>
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]avance_sede")->textInput( [ 'readonly' => true, 'value' => $datos['PorcentajesActividades'][$idActividad]['avance_sede'] ])?></div>
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]avance_ieo")->textInput( [ 'readonly' => true, 'value' => $datos['PorcentajesActividades'][$idActividad]['avance_ieo'] ])?> </div>
			</div>
             

			<div class="row">
			  <div class="col-md-6"><?= $form->field($porcentajes, "[$idActividad]seguimiento_actividades")->textInput([ 'value' => $datos['PorcentajesActividades'][$idActividad]['seguimiento_actividades'] ])?></div>
			  <div class="col-md-6"><?= $form->field($porcentajes, "[$idActividad]evaluacion_actividades")->textInput([ 'value' => $datos['PorcentajesActividades'][$idActividad]['evaluacion_actividades'] ])?></div>
			</div>			 
                      
					<?= $form->field($porcentajes, "[$idActividad]id_actividades_seguimiento")->hiddenInput( [ 'value' => $idActividad ] )->label(false ) ?>
                    <?= $form->field($porcentajes, "[$idActividad]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
            </div>
</div>