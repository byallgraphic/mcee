<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use fedemotta\datatables\DataTables;
use app\models\CbacInformeSemanalCac;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $model app\models\EcInformeSemanalTotalEjecutivo */
/* @var $form yii\widgets\ActiveForm */



if( isset($_GET['guardado']) && $_GET['guardado'] == 1 ){    
    echo Html::hiddenInput( 'guardado', '1' );
}

$this->registerJsFile(
	"@web/js/jQuery-TableToExcel-master/jquery.tableToExcel.js", 
	['depends' => [\yii\web\JqueryAsset::className()]]
);


$this->registerJsFile(Yii::$app->request->baseUrl.'/js/informe-semanal-total-ejecutivo.js',['depends' => [\yii\web\JqueryAsset::className()]]);



	 $dataProvider = new ActiveDataProvider([
            'query' => CbacInformeSemanalCac::find(),
        ]);

?>

  <!--<?= DataTables::widget(['dataProvider' => $dataProvider,     ]); ?> -->


<style>
    
    table {
		width:90%;
		border-top:1px solid #e5eff8;
		border-right:1px solid #e5eff8;
		margin:1em auto;
		border-collapse:collapse;
    }
	
    td {
		color:#678197;
		border: 1px solid #000;
		padding:.3em 1em;
		text-align:left;
    }
	
	thead > tr > th {
		text-align: center;
		background-color: #ccc;
		border: 1px solid #ddd;
	}
	
	tfoot > tr > td {
		font-weight: bold;
		text-align: left;
		background-color: #ddd;
		border: 1px solid #ddd;
	}

tr.group, tr.group:hover 
{
    background-color: #ddd !important;
}
</style>


<div class="ec-informe-semanal-total-ejecutivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <table id='tb'>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Agregar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<p>
        <?php //echo Html::button('Excel', ['class' => 'btn btn-success', 'onclick' => 'exportar()' ]) ?>
    </p>
    </table>

    <div class="form-group" style="display:none">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
	
	
</div>


<table id="example" class="display" style="width:100%">

       
    </table>