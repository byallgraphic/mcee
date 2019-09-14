<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ieo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'zonas_educativas_id')->dropDownList( $zonasEducativas, [ 'prompt' => 'Seleccione...' ] ) ?>
    <?= $form->field($model, 'comuna')->textInput([ 'value' => 'No asignado' , 'readonly' => true]) ?>
    <?= $form->field($model, 'barrio')->textInput([ 'value' => 'No asignado' , 'readonly' => true]) ?>  

    
    <h3 style='background-color: #ccc;padding:5px;'>I.E.O Avance Ejecución</h3>

    <?= $this->context->actionViewFases($model, $form);   ?>
    
    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
   
    <?php ActiveForm::end(); ?>

</div>
