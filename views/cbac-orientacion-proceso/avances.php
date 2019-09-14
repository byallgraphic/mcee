<?php
/* @var $this yii\web\View */
/* @var $avances app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\CbacAvances;
use yii\widgets\ActiveForm;


$avances = new CbacAvances();


?>

<div class="container-fluid">
            <div class="ieo-form">
			
					<?= $form->field($avances, "[$contador]logros")->textInput([ 'value' => $datos[$contador]['logros'] ]) ?>
					<?= $form->field($avances, "[$contador]fortalezas")->textInput([ 'value' => $datos[$contador]['fortalezas'] ]) ?>
					<?= $form->field($avances, "[$contador]debilidades")->textInput([ 'value' => $datos[$contador]['debilidades'] ]) ?>
					<?= $form->field($avances, "[$contador]alternativas")->textInput([ 'value' => $datos[$contador]['alternativas'] ]) ?>
					<?= $form->field($avances, "[$contador]retos")->textInput([ 'value' => $datos[$contador]['retos'] ]) ?>
					<?= $form->field($avances, "[$contador]observaciones")->textInput([ 'value' => $datos[$contador]['observaciones'] ]) ?>
					<?= $form->field($avances, "[$contador]alarmas")->textInput([ 'value' => $datos[$contador]['alarmas'] ]) ?>
					<?= $form->field($avances, "[$contador]necesidades")->textInput([ 'value' => $datos[$contador]['necesidades'] ]) ?>
					<?= $form->field($avances, "[$contador]estrategias_fortalezas")->textInput([ 'value' => $datos[$contador]['estrategias_fortalezas'] ]) ?>
					<?= $form->field($avances, "[$contador]estrategias_debilidades")->textInput([ 'value' => $datos[$contador]['estrategias_debilidades'] ]) ?>
					<?= $form->field($avances, "[$contador]ajustes")->textInput([ 'value' => $datos[$contador]['ajustes'] ]) ?>
					<?= $form->field($avances, "[$contador]temas_abordar")->textInput([ 'value' => $datos[$contador]['temas_abordar'] ]) ?>
					<?= $form->field($avances, "[$contador]como")->textInput([ 'value' => $datos[$contador]['como'] ]) ?>
					<?= $form->field($avances, "[$contador]necesidades_articulacion")->textInput([ 'value' => $datos[$contador]['necesidades_articulacion'] ]) ?>
					<?= $form->field($avances, "[$contador]indique")->textInput([ 'value' => $datos[$contador]['indique'] ]) ?>
                    <?= $form->field($avances, "[$contador]id_acciones")->hiddenInput( [ 'value' => $contador ] )->label( false ) ?>
                    <?= $form->field($avances, "[$contador]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
            </div>
</div>
