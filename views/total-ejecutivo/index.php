<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}

/**********
Versión: 001
Fecha: 
Desarrollador: Oscar David Lopez Villa
---------------------------------------

**********/


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Button;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AsginaturasBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */




$this->title = "Total Ejecutivo";
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="aulas-index">
	
		

    <?= DataTables::widget([
        'dataProvider' 	=> $dataProvider,
		'clientOptions' => [
		'language'=>[
                'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
            ],
		"lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
		"info"=>false,
		"responsive"=>true,
		 "dom"=> 'lfTrtip',
		 "tableTools"=>[
			 "aButtons"=> [  
				// [
				// "sExtends"=> "copy",
				// "sButtonText"=> Yii::t('app',"Copiar")
				// ],
				// [
				// "sExtends"=> "csv",
				// "sButtonText"=> Yii::t('app',"CSV")
				// ],
				[
				"sExtends"=> "xls",
				"oSelectorOpts"=> ["page"=> 'current']
				],
				[
				"sExtends"=> "pdf",
				"oSelectorOpts"=> ["page"=> 'current']
				],
				// [
				// "sExtends"=> "print",
				// "sButtonText"=> Yii::t('app',"Imprimir")
				// ],
			],
		 ],
	],
        'columns' => [
           
            'actividad',
			'porcentajeieo',
            'porcentajeactividad',
            'benficiarios',
            'realizadas',
            'aplazadas',
            'canceladas',
           

        ],
    ]); ?>
</div>


