<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\CbacPlanMisionalOperativo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="cbac-plan-misional-operativo-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
	  <div class="col-md-8"> <?= $form->field($model, 'nombre_institucion')->textInput(['readonly' => true, 'value' => $institucion]) ?></div>
	  <div class="col-md-4"></div>
	</div>
	
	<div class="row">
	  <div class="col-md-8"> <?= $form->field($model, 'id_sede')->dropDownList( $sedes, [ 'prompt' => 'Seleccione...' ] ) ?></div>
	  <div class="col-md-4"></div>
	</div>
	
    <div class="row">
	  <div class="col-md-6"><?= $form->field($model, 'caracterizacion_diagnostico')->dropDownList( [ 'prompt' => 'Seleccione...', 'SI', 'NO' ] ) ?></div>
	  <div class="col-md-6"></div>
	</div>

    <div class="row">
	  <div class="col-md-6"><?= $form->field($model, "fecha_caracterizacion_")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> </div>
	  <div class="col-md-6"><?= $form->field($model, 'nombre_caracterizacion')->textInput() ?></div>
	</div>

    <div class="row">
	  <div class="col-md-6"> <?= $form->field($model, 'caracterizacion_no_justificacion')->textArea(['rows'=>3,'cols'=>10]) ?></div>
	  <div class="col-md-6"></div>
	</div>
   

    <?= $form->field($model, "estado")->hiddenInput(['value'=> 1])->label(false); ?>

    <div class="panel panel panel-primary" >
        <div class="panel-heading" style="margin-bottom: 15px;">Implementar estrategias artisticas y culturales que fortalezcan las competencias básicas de los estudiantes de grados sexto a once de las Instituciones Educativas Oficiales </div>
        <?= $this->context->actionViewFases($model, $form, isset($datos) ? $datos : 0);   ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
