<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\EcProyectos;
use app\models\EcAcciones;
use app\models\EcProductos;
use app\models\EcEstrategias;
use app\models\EcProcesos;
use app\models\ComunasCorregimientos;
use app\models\BarriosVeredas;
use nex\chosen\Chosen;
use	yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\EcInformePlaneacionIeo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ec-informe-planeacion-ieo-form">

    <?php 
    	$form = ActiveForm::begin();
     ?>
	 
	 <?= $form->field($model, 'id_sede')->dropDownList($sedes) ?>
	 
	 <label> Código Dane </label>

	<h6 style='border: 1px solid #ccc;padding:10px;border-radius:4px;'><?=$codigoDane?></h6>
	 
	 <?= $form->field($model, 'id_institucion')->dropDownList($instituciones) ?>

    <?= $form->field($model, 'zona_educativa')->textInput() ?>
	
	<label> Comuna </label>

	<h6 style='border: 1px solid #ccc;padding:10px;border-radius:4px;'><?=$comunas?></h6>

	<label> Barrio</label>
	<h6 style='border: 1px solid #ccc;padding:10px;border-radius:4px;'><?=$barrios?></h6>

 
	<?= $form->field($model, 'zona_educativa')->DropDownList($fases,['prompt'=>'Seleccione...']) ?>
		
        
        
		<?= $form->field($model, 'fecha_reporte')->widget(
			DatePicker::className(), [
				 // modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy'
				]
		])->label('Fecha del reporte (dd-mm-aaaa)');?> 	

	    <h3 style='background-color: #ccc;padding:5px;'>I.E.O Misional</h3>

	    <?= $this->context->actionViewFases($model);   ?>


    <?php ActiveForm::end(); ?>

</div>
