<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\bootstrap\Collapse;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ec-datos-basicos-form">

    <?php $form = ActiveForm::begin([ 'layout' => 'horizontal']); ?>

    <?= $form->field($modelDatosBasico, 'profesional_campo')->textInput() ?>

    <?= $form->field($modelDatosBasico, 'id_institucion')->textInput() ?>

    <?= $form->field($modelDatosBasico, 'id_sede')->textInput() ?>

	<?= $form->field($modelDatosBasico, 'fecha_diligenciamiento')->widget(
					DatePicker::className(), [
						
						 // modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'dd-mm-yyyy'
						]
				]); ?>

    <?php // echo $form->field($modelDatosBasico, 'estado')->textInput(); ?>
	
	
	<?= Collapse::widget([
		'items' => [
						[
							'label' 		=>  'AGREGANDO PLANEACIÓN MISIONAL',
							'content' 		=>  $this->render( 'planeacionMisional', [ 
														'form' 				=> $form,
														'modelPlaneacion' 	=> $modelPlaneacion,
														'modelVerificacion' => $modelVerificacion,
														'modelReportes' 	=> $modelReportes,
														'tiposVerificacion'	=> $tiposVerificacion,
														'modelDatosBasico' => $modelDatosBasico,
												] ),
							'contentOptions'=> [],
						]
					] 
				]); ?>
	
	<?php $this->render( 'planeacionMisional', [ 
			'form' 				=> $form,
			'modelPlaneacion' 	=> $modelPlaneacion,
			'modelVerificacion' => $modelVerificacion,
			'modelReportes' 	=> $modelReportes,
			'tiposVerificacion'	=> $tiposVerificacion,
			'modelDatosBasico' => $modelDatosBasico,
	] ); ?>
		
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
