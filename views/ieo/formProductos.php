<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

// use app\models\EcProducto;
use app\models\Producto;


// $producto = new EcProducto();
$producto = new Producto();

use dosamigos\datepicker\DatePicker;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
    
?>    
      
	<div class=row style=''>
		<div class="col-sm-6" style='padding:0px;'>
			<?= $form->field($producto, "[0]informe_ruta[]")->label('Informe de rutas de cualificación ')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			<?= $form->field($producto, "[0]plan_accion_ruta[]")->label('Informe de rutas de cualificación ')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		 <div class="col-sm-6" style='padding:0px;'>  
			<?= $form->field($producto, "[0]presentacion_plan[]")->label('presentacion_plan')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
	</div>