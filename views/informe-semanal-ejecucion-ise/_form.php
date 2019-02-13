<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\InformeSemanalEjecucionIse */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/ise.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/ise-docentes.js',['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile(Yii::$app->request->baseUrl.'/js/ise-actividades.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/ise-actividades_.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="informe-semanal-ejecucion-ise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_institucion')->textInput(['value' => $institucion]) ?>
    
    <?= $form->field($model, 'fecha_inicio')->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
            ],
    ]);  ?>

    <?= $form->field($model, 'fecha_fin')->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
            ],
    ]);  ?>

    <?= $this->context->actionViewFases($model, $form, isset($datos) ? $datos : 0, isset($datos2) ? $datos2 : 0, $_SESSION["idTipoInforme"]);   ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
