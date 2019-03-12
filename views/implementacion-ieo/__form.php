<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\ImplementacionIeo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/imp-ieo.js',['depends' => [\yii\web\JqueryAsset::className()]]);
// $this->registerJsFile(Yii::$app->request->baseUrl.'/js/imp-ieo-doncentes.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="implementacion-ieo-form">

    <?php $form = ActiveForm::begin(); ?>
       
        <?= $form->field($model, 'zona_educativa')->dropDownList( $zonasEducativas) ?>
        <?= $form->field($model, 'comuna')->dropDownList( $comunas, [ 'prompt' => 'Seleccione...',  
        'onchange'=>'
            $.post( "index.php?r=ieo/lists&id="+$(this).val(), function( data ) {
            $( "select#implementacionieo-barrio" ).html( data );
            });' ] ) ?>
        <?= $form->field($model, 'barrio')->dropDownList( [], [ 'prompt' => 'Seleccione...',  ] ) ?>                 
        <?= $form->field($model, 'profesional_cargo')->dropDownList( $nombres, [ 'prompt' => 'Seleccione...' ] ) ?>
        <?= $form->field($model, 'horario_trabajo')->textArea() ?>

        <?= $this->context->actionViewFases($model, $form, isset($datos) ? $datos : 0);   ?>
    
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>