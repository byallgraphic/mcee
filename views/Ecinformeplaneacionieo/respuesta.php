<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcRespuestas;
use yii\widgets\ActiveForm;


$model = new EcRespuestas();
?>


<div class="container-fluid">

            <div class="ieo-form">
                    <?= $form->field($model, "[$contador]respuesta")->DropDownList($estadoActual,['prompt' => 'Seleccione'])->label($fecha) ?>
                    <?= $form->field($model, "[$contador]id_estrategia")->hiddenInput( [ 'value' => $contador ] )->label( '' ) ?>
                    <?= $form->field($model, "[$contador]estado")->hiddenInput( [ 'value' => '1' ] )->label( '' ) ?>
            </div>
</div>