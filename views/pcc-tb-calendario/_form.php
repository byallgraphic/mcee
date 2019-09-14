<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PccTbCalendario */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="pcc-tb-calendario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_captura')->textInput() ?>

    <?= $form->field($model, 'Nmero_de_identificacin_del_Tutor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Institucin_Educativa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sede')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_de_programacin')->textInput() ?>

    <?= $form->field($model, 'Hora_inicio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora_final')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Actividad')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Cantidad_de_refrigerios_requerid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Seguimiento_pedagogico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Estado_del_evento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_reprogramacion')->textInput() ?>

    <?= $form->field($model, 'Motivo_reprogramacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Perfi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Lugar_reunion_as')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Requiere_refrigerios')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Taller')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Laboratorio')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
