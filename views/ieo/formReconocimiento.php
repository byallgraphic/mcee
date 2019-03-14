<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\DocumentosReconocimiento;
$documentosReconocimiento = new DocumentosReconocimiento();

$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
    
?>    
<div class="" style=''>
	<div class="col-sm-6" style='padding:0px;'>
		<?= $form->field($documentosReconocimiento, "[0]informe_caracterizacion[]")->label('Informe Caracterización')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		<?= $form->field($documentosReconocimiento, "[0]matriz_caracterizacion[]")->label('Matriz de Trazabilidad ')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		<?= $form->field($documentosReconocimiento, "[0]revision_pei[]")->label('Revisión Pei')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	</div>
	<div class="col-sm-6" style='padding:0px;'>
		<?= $form->field($documentosReconocimiento, "[0]revision_autoevaluacion[]")->label('Revisión Autoevaluación')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		<?= $form->field($documentosReconocimiento, "[0]revision_pmi[]")->label('Revisión Pmi')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		<?= $form->field($documentosReconocimiento, "[0]resultados_caracterizacion[]")->label('Resultados Caracterización')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	</div>
</div>     

    <?= $form->field($documentosReconocimiento, "[0]horario_trabajo")->label('Horario Trabajo')->textArea() ?>

