<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GcBitacora */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="gc-bitacora-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php   $countries=\app\models\GcCiclos::find()->all();
            $listData=ArrayHelper::map($countries,'id','descripcion');
            echo $form->field($model, 'id_ciclo')->dropDownList(
                $listData,
                ['prompt'=>'Seleccione un ciclo']
            ); ?>
    <?php   $countries=\app\models\Personas::find()->all();
    $listData=ArrayHelper::map($countries,'id','nombres');
    echo $form->field($model, 'id_jefe')->dropDownList(
        $listData,
        ['prompt'=>'Seleccione un jefe']
    ); ?>
    <?php   $countries=\app\models\Sedes::find()->all();
    $listData=ArrayHelper::map($countries,'id','descripcion');
    echo $form->field($model, 'id_sede')->dropDownList(
        $listData,
        ['prompt'=>'Seleccione una sede']
    ); ?>

    <?= $form->field($model, 'observaciones')->textInput() ?>
    <?php   $countries=\app\models\Estados::find()->all();
    $listData=ArrayHelper::map($countries,'id','descripcion');
    echo $form->field($model, 'estado')->dropDownList(
        $listData,
        ['prompt'=>'Seleccione un estado']
    ); ?>

    <?php   $countries=\app\models\Jornadas::find()->all();
    $listData=ArrayHelper::map($countries,'id','descripcion');
    echo $form->field($model, 'jornada')->dropDownList(
        $listData,
        ['prompt'=>'Seleccione una jornada']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
