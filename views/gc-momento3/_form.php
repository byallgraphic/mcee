<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GcMomento3 */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerCssFile("@web/css/momentos.css");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/momentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

//se captura el valor de la semana
$id_bitacora= $_GET['id_bitacora'];
$id_semana= $_GET['id'];
$id_momento1= 2;
?>

	<fieldset>
		<h4>Niveles de avance de los propósitos</h4>
		<hr>
		<div class="gc-momento3-form">

			<div class="row bg-info">
				<?php $form = ActiveForm::begin(); ?>

				<?= $form->field($model, 'id_semana')->hiddenInput(['value' => $id_semana])->label(false) ?>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($model, 'id_proposito_momento1')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50 , 'value' => '1. Promover la conformación o consolidación y desarrollo de Comunidades de Práctica y Aprendizaje en la Institución Educativa.', 'disabled' => true] )->label('Propósito') ?> </div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($model, 'nivel_avance')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50 ,'placeholder' => 'Nivel de avance del propósito'] )->label('Nivel de avance del propósito') ?> </div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($model, 'justificacion_avance')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50 ,'placeholder' => 'Justificación del nivel de avance'] )->label('Justificación de avance')?> </div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($model, 'observaciones_prof')->textArea(['disabled' => true , 'rows' => 6, 'cols' => 50])->label('Profesional de acompañamiento') ?></div>

				<?= $form->field($model, "estado")->hiddenInput(['value'=> 1])->label(false) ?>
				
			</div>
			<br>
			<div class="form-group">
				<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		

		</div>
	
	</fieldset>
