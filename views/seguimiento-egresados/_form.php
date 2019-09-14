<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientoEgresados */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentosOficiales.js',['depends' => [\yii\web\JqueryAsset::className()]]);

echo Html::hiddenInput( 'idInstitucion', '$idInstitucion' );
?>

<div class="seguimiento-egresados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, '[0]estrategia_seguimiento')->dropDownList($parametrosSeguimiento, [ 'prompt' => 'Seleccione...' ]) ?>

     <?= $form->field($model, '[0]otro')->textInput() ?>

    <?= $form->field($model, '[0]cantidad_promociones')->textInput() ?>

    <?= $form->field($model, '[0]cantidad_alumnos_egresados')->textInput() ?>

   <div style="margin-left: 13px;margin-right: -400px; margin-bottom: 5px;">
        <div class=row style='text-align:center; margin'>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px;'>Estudios</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Cantidad</span>
            </div>
        </div>
   
        <?php
            foreach($parametros as $parametro){
                ?>
                    <div class=row>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span><?= $parametro?></span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($model, '[0]cantidad_egresados_estudiso', [ 'class' => 'form-control'] ) ?>
                        </div>
                    </div>
                <?php
                
            }
        ?>
    </div>


    <?= $form->field($model, '[0]id_instituciones')->dropDownList( $instituciones ) ?>

    <?= $form->field($model, '[0]id_tipo_documento')->dropDownList( $tiposDocumento, [ 'prompt' => 'Seleccione...' ] ) ?>

    <?= $form->field($model, '[0]file')->label('Archivo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>

    <div style='display:none'>
        <?= $form->field($model, '[0]estado')->hiddenInput( [ 'value' => '1' ] )->label( '' ) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
