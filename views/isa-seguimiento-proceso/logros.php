<?php

use app\models\IsaLogrosActividades;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;

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


echo Tabs::widget([
    'items' => $items, 
]);

$this->registerCss(".nav-tabs > li {
						
						width: 380px;
						height: 80px;
					}
					
					.row {
						margin-left: 2px;
					}");

// foreach ($logros as $idLogros => $dataLogros)
// {
		// $items[] = 	[
						// 'label' 		=>  $dataLogros,
						// 'content' 		=>  $this->render( 'semanalogros', 
														// [ 
															// 'idLogros' => $idLogros,
															// 'form' => $form,
															// 'datos' => $datos,
															// 'idActividad' => $idActividad,
														// ] 
											// ),
						// 'contentOptions'=> []
					// ];			


// }


// echo Collapse::widget([
    // 'items' => $items, 
// ]);