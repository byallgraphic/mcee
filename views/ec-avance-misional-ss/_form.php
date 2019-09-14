<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalSs */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ec-avance-misional-ss-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'id_institucion')->DropDownList($instituciones) ?>

    <?= $form->field($model, 'id_sede')->DropDownList($sedes) ?>

   <?= $form->field($model, 'fecha_inicio')->widget(
			DatePicker::className(), [
				
			 // modify template for custom rendering
			'template' 		=> '{addon}{input}',
			'language' 		=> 'es',
			'clientOptions' => [
				'autoclose' 	=> true,
				'format' 		=> 'yyyy-mm-dd'
			],
		]);  
	?>

	<?= $form->field($model, 'fecha_fin')->widget(
			DatePicker::className(), [
				
			 // modify template for custom rendering
			'template' 		=> '{addon}{input}',
			'language' 		=> 'es',
			'clientOptions' => [
				'autoclose' 	=> true,
				'format' 		=> 'yyyy-mm-dd'
			],
		]);  
	?>

    <?= $form->field($model, 'responsable_sem')->textInput() ?>

    <?= $form->field($model, 'operador')->textInput() ?>

    <?= $form->field($model, 'acciones_realizadas')->TextArea() ?>
	<h3 style="background-color:#ccc;padding:5px;">	Gestión institucional de los Proyectos de servicio social fortalecida</h3>

    <?= $form->field($model, 'gestion_institucional_avances')->TextArea() ?>

    <?= $form->field($model, 'gestion_institucional_dificultades')->TextArea() ?>
	<h3 style="background-color:#ccc;padding:5px;">	Proyectos de Servicio Social y el contexto de la I.E.O articulados</h3>

    <?= $form->field($model, 'proyectos_servicio_social_avances')->TextArea() ?>

    <?= $form->field($model, 'proyectos_servicio_social_difcultades')->TextArea() ?>
	<h3 style="background-color:#ccc;padding:5px;">	Competencias y habilidades en relación a los proyectos de vida de los estudiantes fortalecidas</h3>

    <?= $form->field($model, 'competencias_habilidades_avances')->TextArea() ?>

    <?= $form->field($model, 'competencias_habilidades_dificultades')->TextArea() ?>

    <?= $form->field($model, 'fuente_informacion')->TextArea() ?>

    <?= $form->field($model, 'avances_acompanamiento')->TextArea() ?>

    <?= $form->field($model, 'dificultades_acompanamiento')->TextArea() ?>

    <?= $form->field($model, 'alarmas_importantes')->TextArea() ?>

    <?= $form->field($model, 'estado')->DropDownList($estados) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
