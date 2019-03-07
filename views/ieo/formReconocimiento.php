<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


$index =1;
$numProyecto =2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\DocumentosReconocimiento;
$documentosReconocimiento = new DocumentosReconocimiento();

$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
    
?>    
<div class="" style=''>
	<div class="col-sm-6" style='padding:0px;'>
		<?= $form->field($documentosReconocimiento, "[$numProyecto]informe_caracterizacion[]")->label('Informe Caracterización')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		<?= $form->field($documentosReconocimiento, "[$numProyecto]matriz_caracterizacion[]")->label('Matriz de Trazabilidad ')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		<?= $form->field($documentosReconocimiento, "[$numProyecto]revision_pei[]")->label('Revisión Pei')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	</div>
	<div class="col-sm-6" style='padding:0px;'>
		<?= $form->field($documentosReconocimiento, "[$numProyecto]revision_autoevaluacion[]")->label('Revisión Autoevaluación')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		<?= $form->field($documentosReconocimiento, "[$numProyecto]revision_pmi[]")->label('Revisión Pmi')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		<?= $form->field($documentosReconocimiento, "[$numProyecto]resultados_caracterizacion[]")->label('Resultados Caracterización')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	</div>
</div>     

    <?= $form->field($documentosReconocimiento, "[$numProyecto]horario_trabajo")->label('Horario Trabajo')->textArea() ?>

