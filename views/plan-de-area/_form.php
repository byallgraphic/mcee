<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlanDeArea */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/plandeArea.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<style>
	.table{
		display: table;
	}

	.row{
		display: table-row;
	}

	.cell{
		display: table-cell;
	}
</style>
<div class="plan-de-area-form">

    <?php $form = ActiveForm::begin([
		'method' 				=> 'post',
		'enableClientValidation'=> true,		
		'options' 				=> [ 'enctype' => 'multipart/form-data' ],
	]); ?>
	
	<div class=table>
		<div class=row>
			<div class="form-group" style='display:inline;'>
				<?= Html::buttonInput('Agregar', ['class' => 'btn btn-success', 'onclick' => 'agregarCampos()', 'id' => 'btnAgregar' ]) ?>
			</div>
			
			<div class="form-group" style='display:inline;'>
				<?= Html::buttonInput('Eliminar', ['class' => 'btn btn-success', 'onclick' => 'eliminarCampos()', 'id' => 'btnEliminar', 'display' => 'none' ]) ?>
			</div>
		</div>
	</div>

  <div id=dvTable class=table>
		
		<div class=row>

			<div class=cell>
			<?= $form->field($model, '[0]descripcion')->textInput() ?>
			</div>

				<div class=cell>
				<?= $form->field($model, '[0]id_tipos_documentos')->dropDownList( $tiposDocumento, [ 'prompt' => 'Seleccione...' ] ) ?>
			</div>

				<div class=cell>
			<?= $form->field($model, '[0]ruta')->label('Archivo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>

				<div class=cell>
			<?= $form->field($model, '[0]estado')->hiddenInput( [ 'value' => '1' ] )->label( '' ) ?>
			</div>
		</div>
	
	</div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
