<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;


$avances = new EcAvances();

 

?>

<div class="container-fluid">
            <div class="ieo-form">

                    <?= $form->field($avances, "[$contador]estado_actual")->DropDownList($estadoActual,['prompt' => 'Seleccione','value' =>  $datos[$contador]['estado_actual']])->label('Estado Actual') ?>
                    <?= $form->field($avances, "[$contador]logros")->textArea([ 'value' => $datos[$contador]['logros'],'readonly'=> true ])->label('Logros') ?>
                    <?= $form->field($avances, "[$contador]retos")->textInput([ 'value' => $datos[$contador]['retos'] ])->label('Retos') ?>
                    <?= $form->field($avances, "[$contador]argumentos")->textInput([ 'value' => $datos[$contador]['argumentos'] ])->label('Argumentos') ?>
                    <?= $form->field($avances, "[$contador]id_acciones")->hiddenInput( [ 'value' => $contador ] )->label( false ) ?>
                    <?= $form->field($avances, "[$contador]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
            </div>
</div>