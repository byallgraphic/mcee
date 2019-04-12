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
		color: black;
	}
	
	ul.tabs > li:nth-child(1){ background : #EBDEF0; }
	ul.tabs > li:nth-child(2){ background : #F6DDCC; }
	ul.tabs > li:nth-child(3){ background : #F9EBEA; }
	ul.tabs > li:nth-child(4){ background : #FDF2E9; }
	ul.tabs > li:nth-child(5){ background : #F2F3F4; }
	
	ul.tabs > li > a:hover{
		color: #444;
		background: #f7f7f7;
	}
	
	ul.tabs > li > a:focus{
		color: #555;
		cursor: default;
		background-color: #fff;
		border: 1px solid #ddd;
			border-bottom-color: rgb(221, 221, 221);
		border-bottom-color: transparent;
	}
   
	/*.tab-selected{
	   -webkit-box-shadow: 10px 10px 10px 0px rgba(0,0,0,1);
		-moz-box-shadow: 10px 10px 10px 0px rgba(0,0,0,1);
		box-shadow: 10px 10px 10px 0px rgba(0,0,0,1);
	}*/
</style>

<div class="rom-reporte-operativo-misional-form">


	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'id_institucion')->dropDownList($institucion) ?>

    <?= $form->field($model, 'id_sedes')->dropDownList( $sedes ) ?>
	
    <?= $form->field($model, 'estado')->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>


    <div class="panel panel panel-primary" >
        
        <?= $this->context->actionFormulario($model, $form, $datos);   ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
