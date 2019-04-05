<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Permisos */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="permisos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_modulos')->DropDownList($modulo) ?>

    <?= $form->field($model, 'id_perfiles')->DropDownList($perfil) ?>
	
	  <?= $form->field($model, 'eliminar')->checkbox($perfil) ?>
	  <?= $form->field($model, 'editar')->checkbox($perfil) ?>
	  <?= $form->field($model, 'listar')->checkbox($perfil) ?>
	  <?= $form->field($model, 'agregar')->checkbox($perfil) ?>
	

   <?= $form->field($model, 'estado')->hiddenInput(['value'=> 1])->label(false) ?> 

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
