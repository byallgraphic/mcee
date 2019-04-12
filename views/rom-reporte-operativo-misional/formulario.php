<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\IsaActividadesRom;
use app\models\IsaEvidenciasRom;
use app\models\IsaTipoCantidadPoblacionRom;

// echo "<pre>"; print_r($datos); echo "</pre>"; 
// die;
$actividades_rom 	= new IsaActividadesRom();
$evidencias_rom 	= new IsaEvidenciasRom();
$tipo_poblacion_rom = new IsaTipoCantidadPoblacionRom();
 
?>


 <h3 style='background-color: #ccc;padding:5px;'>Evidencias (Indique la cantidad y destino de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
	<?= $form->field($evidencias_rom, "[$idActividad]actas[]")->label('ACTAS (Cantidad)')->fileInput(['multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	
	<?= $form->field($evidencias_rom, "[$idActividad]reportes[]")->label('REPORTES  (Cantidad)')->fileInput(['multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]listados[]")->label('LISTADOS  (Cantidad)')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]plan_trabajo[]")->label('PLAN DE TRABAJO (Cantidad)')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]formato_seguimiento[]")->label('FORMATOS DE SEGUIMIENTO (Cantidad)')->fileInput([ 'multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]formato_evaluacion[]")->label('FORMATOS DE EVALUACIÓN (Cantidad)')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]fotografias[]")->label('FOTOGRAFÍAS (Cantidad)')->fileInput([ 'multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]vidoes[]")->label('VIDEOS (Cantidad)')->fileInput([ 'multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]otros_productos[]")->label('Otros productos  de la actividad')->fileInput([ 'multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]cantidad")->textInput() ?>
	<?= $form->field($evidencias_rom, "[$idActividad]archivos_enviados_entregados")->textInput() ?>
	<?= $form->field($evidencias_rom, "[$idActividad]id_rom_actividad")->hiddenInput(['value' => $idActividad])->label(false) ?>
	
	
	<?= $form->field($evidencias_rom, "[$idActividad]fecha_entrega_envio")->widget(
		DatePicker::className(), [
			// modify template for custom rendering
			'template' => '{addon}{input}',
			'language' => 'es',
			'clientOptions' => [
				'autoclose' => true,
				'format'    => 'yyyy-mm-dd',
		],
	]);  ?>