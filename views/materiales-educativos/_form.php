<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesEducativos */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/materialesEducativos.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$idInstitucion = $_SESSION['instituciones'][0];
echo Html::hiddenInput( 'idInstitucion', $idInstitucion );
?>

<div class="materiales-educativos-form">

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
	
			<?= $form->field($model, '[0]tipo')->DropDownList($tipo,['prompt'=>'Seleccione...']) ?>
			
			<?= $form->field($model, '[0]otro_cual')->textInput() ?>

			<?= $form->field($model, '[0]autor')->DropDownList($autor,['prompt'=>'Seleccione...']) ?>

			<?= $form->field($model, '[0]nivel')->DropDownList($nivel,['prompt'=>'Seleccione...'])?>
			
			<?= $form->field($model, '[0]nombre_apellidos')->textInput() ?>

			<?= $form->field($model, '[0]reseña')->textArea() ?>
			
			<?= $form->field($model, '[0]ruta')->fileInput() ?>
			
			<?= $form->field($model, '[0]estado')->DropDownList($estados) ?>

		</div>
	</div>
	
	
		<div class="form-group">
			<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>
</div>
