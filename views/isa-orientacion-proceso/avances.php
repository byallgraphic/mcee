<?php
/* @var $this yii\web\View */
/* @var $avances app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\IsaAvances;
use yii\widgets\ActiveForm;


$avances = new IsaAvances();


?>

<div class="container-fluid">
            <div class="ieo-form">
				
				<?= $form->field($avances, "[$contador]logros")->textarea([ 'value' => $datos[$contador]['logros'] ]) ?>
				  
				<div class="row">
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]fortalezas")->textarea(['rows' => '3', 'value' => $datos[$contador]['fortalezas'] ]) ?></div>
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]debilidades")->textarea(['rows' => '3', 'value' => $datos[$contador]['debilidades'] ]) ?></div>
				</div>
				<div class="row">
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]alternativas")->textarea(['rows' => '3', 'value' => $datos[$contador]['alternativas'] ]) ?></div>
				  <div class="col-md-6">&nbsp;&nbsp;<?= $form->field($avances, "[$contador]retos")->textarea(['rows' => '3', 'value' => $datos[$contador]['retos'] ]) ?></div>
				</div>
				<div class="row">
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]observaciones")->textarea(['rows' => '3', 'value' => $datos[$contador]['observaciones'] ]) ?></div>
				  <div class="col-md-6">&nbsp;&nbsp;<?= $form->field($avances, "[$contador]alarmas")->textarea(['rows' => '3', 'value' => $datos[$contador]['alarmas'] ]) ?></div>
				</div>
				<div class="row">
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]necesidades")->textarea(['rows' => '3', 'value' => $datos[$contador]['necesidades'] ]) ?></div>
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]ajustes")->textarea(['rows' => '3', 'value' => $datos[$contador]['ajustes'] ]) ?></div>
				</div>
				<div class="row">
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]estrategias_debilidades")->textarea(['rows' => '3', 'value' => $datos[$contador]['estrategias_debilidades'] ]) ?></div>
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]estrategias_fortalezas")->textarea(['rows' => '3', 'value' => $datos[$contador]['estrategias_fortalezas'] ]) ?></div>
				</div>
				<div class="row">
				  <div class="col-md-6">&nbsp;&nbsp;<?= $form->field($avances, "[$contador]temas_abordar")->textarea(['rows' => '3', 'value' => $datos[$contador]['temas_abordar'] ]) ?></div>
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]como")->textarea(['rows' => '3', 'value' => $datos[$contador]['como'] ]) ?></div>
				</div>
				<div class="row">
				  <div class="col-md-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $form->field($avances, "[$contador]necesidades_articulacion")->textarea(['rows' => '3', 'value' => $datos[$contador]['necesidades_articulacion'] ]) ?></div>
				  <div class="col-md-6"><?= $form->field($avances, "[$contador]indique")->textarea(['rows' => '3', 'value' => $datos[$contador]['indique'] ]) ?></div>
				</div>	
				
				  <?= $form->field($avances, "[$contador]id_acciones")->hiddenInput( [ 'value' => $contador ] )->label( false ) ?>
				                  
                  <?= $form->field($avances, "[$contador]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
            </div>
</div>
