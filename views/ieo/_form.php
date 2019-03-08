<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/ieo.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$idTipoInforme = (isset($_GET['idTipoInforme'])) ?  $_GET['idTipoInforme'] :  $model->id_tipo_informe;
?>

<div class="ieo-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'zonas_educativas_id')->dropDownList( $zonasEducativas, [ 'prompt' => 'Seleccione...' ] ) ?>

    <?= $form->field($model, 'comuna')->dropDownList( $comunas, [ 'prompt' => 'Seleccione...',  
                'onchange'=>'
                    $.post( "index.php?r=ieo/lists&id="+$(this).val(), function( data ) {
                    $( "select#ieo-barrio" ).html( data );
                    });' ] ) ?>

    <?= $form->field($model, 'barrio')->dropDownList( [], [ 'prompt' => 'Seleccione...',  ] ) ?>                 
    
  
	<?= $form->field($model, 'persona_acargo')->textInput() ?> 
	
	<?= $form->field($model, 'id_tipo_informe')->hiddenInput(['value'=> $idTipoInforme])->label(false) ?> 
    
    <h3 style='background-color: #ccc;padding:5px;'>I.E.O Avance Ejecución</h3>

    <?= $this->context->actionViewFases($model, $form, isset($datos) ? $datos : 0, isset($model->persona_acargo) ?  $model->persona_acargo : '', $idTipoInforme );   ?>
    
    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
   
    <?php ActiveForm::end(); ?>

</div>
