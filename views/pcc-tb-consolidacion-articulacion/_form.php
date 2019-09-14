<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PccTbConsolidacionArticulacion */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="pcc-tb-consolidacion-articulacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_accion')->textInput() ?>

    <?= $form->field($model, 'Id_formador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nombre1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellido1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Mes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Avance_actores')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Avance_transv')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Insercion_PEI')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Avance_biblio')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Avance_otros')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Adjuntos')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Observaciones')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
