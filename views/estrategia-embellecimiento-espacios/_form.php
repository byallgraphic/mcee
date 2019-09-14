<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstrategiaEmbellecimientoEspacios */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentosOficiales.js',['depends' => [\yii\web\JqueryAsset::className()]]);

echo Html::hiddenInput( 'idInstitucion', '$idInstitucion' );
?>

<div class="estrategia-embellecimiento-espacios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, '[0]seguimiento_uso_espacios')->dropDownList($parametrosUsos, [ 'prompt' => 'Seleccione...' ]) ?>

    <?= $form->field($model, '[0]plan_enlucimiento')->textInput() ?>

    <?= $form->field($model, '[0]estrateguia_enbellecimiento')->dropDownList($parametrosEmbellecimiento, [ 'prompt' => 'Seleccione...' ]) ?>
    
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
