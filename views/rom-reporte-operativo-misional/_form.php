<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RomReporteOperativoMisional */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

?>
<style>

	ul.tabs {
		display: flex;
		padding: 0px;
		box-sizing: border-box;
	}
	
	ul.tabs > li{
		list-style: none;
		border : 1px solid black;
		padding : 5px;
		flex : 1 1 1;
		margin: 0 5px;
	}
	
	ul.tabs > li:nth-child(1){ background : #009246; }
	ul.tabs > li:nth-child(2){ background : #F1F2F1; }
	ul.tabs > li:nth-child(3){ background : #CE2B37; }
   
	.tab-selected{
	   -webkit-box-shadow: 10px 10px 10px 0px rgba(0,0,0,1);
		-moz-box-shadow: 10px 10px 10px 0px rgba(0,0,0,1);
		box-shadow: 10px 10px 10px 0px rgba(0,0,0,1);
	}
</style>

<div class="rom-reporte-operativo-misional-form">


	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'id_institucion')->dropDownList($institucion) ?>

    <?= $form->field($model, 'id_sedes')->dropDownList( $sedes, [ 'prompt' => 'Seleccione...' ] ) ?>
	
    <?= $form->field($model, 'estado')->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>


    <div class="panel panel panel-primary" >
        
        <?= $this->context->actionFormulario($model, $form, $datos);   ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
