<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\bootstrap\Collapse;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */
/* @var $form yii\widgets\ActiveForm */
?>

<style>

.header-table > div> span{
	background-color: #ccc;
}

.header-table > div > span{
	padding: 0;
}

.header-table .col-sm-12, 
.header-table .col-sm-11, 
.header-table .col-sm-10, 
.header-table .col-sm-9, 
.header-table .col-sm-8, 
.header-table .col-sm-7, 
.header-table .col-sm-6, 
.header-table .col-sm-5, 
.header-table .col-sm-4, 
.header-table .col-sm-3, 
.header-table .col-sm-2, 
.header-table .col-sm-1{
		padding: 0px;
	}
</style>

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
	

	<div class="form-group">
		<?= Html::submitButton('Agregar', ['class' => 'btn btn-success']) ?>
		<?= Html::submitButton('Eliminar', ['class' => 'btn btn-danger']) ?>
	</div>
	
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
	] ); ?>
		
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
