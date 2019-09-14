<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlantaDocenteAdministrativa */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentosPlantaDocenteAdministrativa.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");

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

<div class="planta-docente-administrativa-form">

    <?php $form = ActiveForm::begin([
		// 'id' => 'contact-form',
		// 'enableAjaxValidation' => true,
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
				<?= $form->field($model, '[0]tipo_documento_id')->dropDownList( $tiposDocumento, [ 'prompt' => 'Seleccione...' ] ) ?>
			</div>
            
            <div class=cell>
				<?= $form->field($model, '[0]file')->label('Archivo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>

            <div class=cell style='display:none'>
				<?= $form->field($model, '[0]estado')->hiddenInput( [ 'value' => '1' ] )->label( '' ) ?>
			</div>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
