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
	
	
	<div class="cantidades" style="margin-left: 20%;">
					<div class="row" style="text-align:center; background-color:#fff;">
							<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px;'>Eliminar</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Editar</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Listar</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Agregar</span>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($model, "eliminar", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($model, "editar", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($model, "listar", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($model, "agregar", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
					</div>
				</div>

   <?= $form->field($model, 'estado')->hiddenInput(['value'=> 1])->label(false) ?> 

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
