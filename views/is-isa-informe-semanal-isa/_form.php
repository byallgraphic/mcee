<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\IsIsaInformeSemanalIsa */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$nroSemana = empty( $_POST['nroSemana'] ) ? '' : $_POST['nroSemana'];
?>

<div class="is-isa-informe-semanal-isa-form">

    <?php $form = ActiveForm::begin(); ?>

	<div class="row">
	  <div class="col-md-8"> <?= $form->field($model, 'nombre_institucion')->textInput(['readonly' => true, 'value' => $institucion]) ?></div>
	  <div class="col-md-4"></div>
	</div>
   
   <div class="row">
	  <div class="col-md-8"><?= $form->field($model, 'id_sede')->dropDownList( $sedes ) ?></div>
	  <div class="col-md-4"></div>
	</div>

	<div class="row">
	  
		<div class="col-md-4" style='display:none;'>
			<?= $form->field($model, 'nro_semana')->textInput([ 'value' => $nroSemana ]) ?>
		</div>
	  
	  <div class="col-md-6"><?= $form->field($model, "desde")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> 
		</div>
		<div class="col-md-6"> <?= $form->field($model, "hasta")->widget(
			DatePicker::className(), [
				// modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format'    => 'yyyy-mm-dd',
			],
    ]);  ?> </div>
	</div>
    


    

   
    <?= $form->field($model, "estado")->hiddenInput(['value'=> 1])->label(false); ?>

    <div class="panel panel panel-primary" >
        <div class="panel-heading" style="margin-bottom: 15px;">Fortalecer el vínculo comunidad-escuela mediante el mejoramiento de la oferta en artes y cultura desde las instituciones educativas oficiales para la ocupación del tiempo libre en las comunas y corregimientos de Santiago de Cali.</div>
        <?= $this->context->actionViewFases($model, $form);   ?>
    </div>


    <!-- <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
