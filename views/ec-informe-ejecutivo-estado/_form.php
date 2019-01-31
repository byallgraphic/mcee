<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformeEjecutivoEstado */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ec-informe-ejecutivo-estado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_institucion')->DropDownList($instituciones) ?>

    <?= $form->field($model, 'id_eje')->DropDownList($ejes,['prompt'=>"Seleccione..."]) ?>
	
    <?= $form->field($model, 'id_persona')->DropDownList($persona) ?>

    <?= $form->field($model, 'id_coordinador')->DropDownList($coordinador,['prompt'=>"Seleccione..."]) ?>
	
    <?= $form->field($model, 'id_secretaria')->DropDownList($secretario,['prompt'=>"Seleccione..."]) ?>

    <?= $form->field($model, 'mision')->textArea(['placeholder' => "Ingrese el texto 300 caracteres máximo ",'maxlength' => 300, 'rows' => 6, 'cols' => 50] )?>

    <?= $form->field($model, 'descripcion')->textArea(['placeholder' => "Ingrese el texto 300 caracteres máximo ",'maxlength' => 300, 'rows' => 6, 'cols' => 50]) ?>

    <?= $form->field($model, 'avance_producto')->textArea(['placeholder' => "Ingrese el texto 300 caracteres máximo ",'maxlength' => 300, 'rows' => 6, 'cols' => 50]) ?>

    <?= $form->field($model, 'hallazgos')->textArea(['placeholder' => "Ingrese el texto 300 caracteres máximo ",'maxlength' => 300, 'rows' => 6, 'cols' => 50]) ?>

    <?= $form->field($model, 'logros')->textArea(['placeholder' => "Ingrese el texto 300 caracteres máximo ",'maxlength' => 300, 'rows' => 6, 'cols' => 50]) ?>

    <?= $form->field($model, 'estado')->hiddenInput(['value'=> 1])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
