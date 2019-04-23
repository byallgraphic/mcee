<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSensibilizacionArtisticaConsolidado */
/* @var $form yii\widgets\ActiveForm */
?>


    <?= Html::activeHiddenInput($actividad, '['.$index.']id') ?>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']total_sesiones_realizadas')->textInput(['readonly' => true]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;<?= $form->field($actividad, '['.$index.']avance_por_mes')->textInput(['readonly' => true, 'data-porcentaje' => $index ]) ?> </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']total_sesiones_aplazadas')->textInput(['readonly' => true]) ?> </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']total_sesiones_canceladas')->textInput(['readonly' => true]) ?> </div>
	</div>
  
	
	<h3 style='background-color:#ccc;padding:5px;'><?="Número de participantes por actividad comunitaria por sede educativa." ?></h3>

	<div class="row">
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']vecinos')->textInput([ "data-participante" => $index ]) ?></div>
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']lideres_comunitarios')->textInput([ "data-participante" => $index ]) ?></div>
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']empresarios_comerciantes_microempresas')->textInput([ "data-participante" => $index ]) ?></div>
	</div>
	
	<div class="row">
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']representantes_organizaciones_locales')->textInput([ "data-participante" => $index ]) ?></div>
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']asociaciones_grupos_comunitarios')->textInput([ "data-participante" => $index ]) ?></div>
	  <div class="col-md-4">&nbsp;<?= $form->field($actividad, '['.$index.']otros_actores')->textInput([ "data-participante" => $index ]) ?></div>
	</div>
	
	<div class="row">
	  <div class="col-md-4"><?= Html::label( "Total de Participantes en la actividad." ) ?>
		
		<?= Html::textInput( $index."-total_participantes", "", [ 
					"class" 		=> "form-control", 
					"style" 		=> "background-color:#eee",
					"disabled" 		=> true, 
					"id" 			=> $index."-total_participantes", 
				] ) ?></div>
	  <div class="col-md-4"></div>
	  <div class="col-md-4"></div>
	</div>
	<div class="form-group">
	
		
		
	</div>

	<h3 style='background-color:#ccc;padding:5px;'><?="Evidencias (Indique la cantidad y destino de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )" ?></h3>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']actas')->textInput() ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']reportes')->textInput() ?> </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']listados')->textInput() ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']plan_trabajo')->textInput() ?></div>
	</div>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']formato_seguimiento')->textInput() ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']formato_evaluacion')->textInput() ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']fotografias')->textInput() ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']videos')->textInput() ?></div>
	</div>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']otros_productos')->textInput() ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
	</div>
    

    

    

    

    

    

    

    