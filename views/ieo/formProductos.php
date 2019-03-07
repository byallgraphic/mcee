<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\EcProducto;


$producto = new EcProducto();

use dosamigos\datepicker\DatePicker;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
    
?>    
      
	<div class=row style=''>
		<div class="col-sm-6" style='padding:0px;'>
			<?= $form->field($producto, "[$idactividad]informe_ruta[]")->label('Informe de rutas de cualificación ')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		 <div class="col-sm-6" style='padding:0px;'>  
			<?= $form->field($producto, "[$idactividad]plan_accion_ruta[]")->label('Plan de acción')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
	</div>
