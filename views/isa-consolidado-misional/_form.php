<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\IsaConsolidadoMisional */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJs( file_get_contents( '../web/js/consolidadoMisional.js' ) );
?>

<div class="isa-consolidado-misional-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_institucion')->DropDownList($institucion) ?>

    <?= $form->field($model, 'id_sede')->DropDownList($sedes) ?>

  
	<div class="row">
	 <div class="col-md-4"><?= $form->field($model, 'fecha')->widget(
			DatePicker::className(), [
			'template' 		=> '{addon}{input}',
			'language' 		=> 'es',
			'clientOptions' => [
				'autoclose' 	=> true,
				'format' 		=> 'yyyy-mm',
				'minViewMode'=>'months',
			],
		]);  
	?>
	</div>
	</div>



	<?= $this->context->actionFormulario($model,$form)  ?>
	
	<div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
	
    <?php ActiveForm::end(); ?>

</div>
