<?php

use app\models\CbacLogrosActividades;
use app\models\CbacVariacionesActividades;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use app\models\CbacForDebRet;

$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];



$logros = CbacLogrosActividades::find()->where( "estado = 1 and id_rom_actividades = $idActividad" )->all();
$logros = ArrayHelper::map($logros,'id','descripcion');


$index = 0; 
 
foreach ($logros as $idLogros => $dataLogros)
{
		$items[] = 	[
						'label' 		=>  $dataLogros,
						'content' 		=>  $this->render( 'semanalogros', 
														[ 
															'idLogros' => $idLogros,
															'form' => $form,
															'datos' => $datos,
															'idActividad' => $idActividad,
															'dataLogros' => $dataLogros,
														] 
											),
						'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$index];"],
						'contentOptions'=> [],
						'active'		=> false,
					];			

		$index++;
}


					


$index = 0; 
$variaciones = CbacVariacionesActividades::find()->where( "estado=1 and id_rom_actividades=$idActividad" )->all();
$variaciones = ArrayHelper::map($variaciones,'id','descripcion');

// echo "<pre>"; print_r($variaciones); echo "</pre>"; 

foreach ($variaciones as $idVariaciones => $dataVariaciones)
{
	$CbacForDebRet = CbacForDebRet::find()->where( "estado=1 and id_variaciones_actividades=$idVariaciones" )->all();
	$CbacForDebRet = ArrayHelper::map($CbacForDebRet,'id','descripcion');
		   
	foreach ($CbacForDebRet as $idIsaForDebRet => $dataIsaForDebRet)
	{
		$items[] = 	[
						'label' 		=>  $dataIsaForDebRet,
						'content' 		=>  $this->render( 'semanafordebret', 
														[ 
															'idIsaForDebRet' => $idIsaForDebRet,
															'form' => $form,
															'datos' => $datos,
															'idVariaciones' => $idVariaciones,
															'idActividad' => $idActividad,
															'dataIsaForDebRet' => $dataIsaForDebRet
														] 
											),
						'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$index];",'title'=>$dataVariaciones],
					];
		$index++;					
	}

}




echo Tabs::widget([
    'items' => $items, 
]);

