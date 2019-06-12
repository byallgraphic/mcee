<?php

use app\models\IsaLogrosActividades;
use app\models\IsaVariacionesActividades;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use app\models\IsaForDebRet;

$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];



$logros = IsaLogrosActividades::find()->where( "estado=1 and id_actividades=$idActividad" )->all();
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
														] 
											),
						'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$index];"],
						'contentOptions'=> [],
						'active'		=> false,
					];			

		$index++;
}

// $items[] = 	[
				// 'label' 		=>  "Variaciones en la implementación del proyecto: Describa las situaciones de dificultad, reto  y/o ventaja, surgidos o presentes durante el periodo,  que influyen en el cumplimiento de los objetivos.",
				// 'content' 		=>  $this->render( 'variacionesactividades', 
												// [ 
													// 'idActividad' => $idActividad,
													// 'form' => $form,
													// 'datos' => $datos,
												// ] 
									// ),
				// 'contentOptions'=> []
			// ];
					


$index = 0; 
$variaciones = IsaVariacionesActividades::find()->where( "estado=1 and id_actividades=$idActividad" )->all();
$variaciones = ArrayHelper::map($variaciones,'id','descripcion');

// echo "<pre>"; print_r($variaciones); echo "</pre>"; 

foreach ($variaciones as $idVariaciones => $dataVariaciones)
{
	$IsaForDebRet = IsaForDebRet::find()->where( "estado=1 and id_variaciones_actividades=$idVariaciones" )->all();
	$IsaForDebRet = ArrayHelper::map($IsaForDebRet,'id','descripcion');
		   
	foreach ($IsaForDebRet as $idIsaForDebRet => $dataIsaForDebRet)
	{
		$items[] = 	[
						'label' 		=>  $dataIsaForDebRet,
						'content' 		=>  $this->render( 'semanafordebret', 
														[ 
															'idIsaForDebRet' => $idIsaForDebRet,
															'form' => $form,
															'datos' => $datos,
															'idVariaciones' => $idVariaciones,
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

