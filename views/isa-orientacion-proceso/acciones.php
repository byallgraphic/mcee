<?php

use app\models\IsaAcciones;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;

$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];



$acciones = IsaAcciones::find()->where( "estado=1 and id_proceso=$idProceso" )->orderby("id")->all();
$acciones = ArrayHelper::map($acciones,'id','descripcion');
       
$index = 0; 

foreach( $acciones as $idAcciones => $v )
{
	
		$items[] = 	[
						'label' 		=>  $v,
						'content' 		=>  $this->render( 'avances',
																	[
																		'form' => $form,
																		'contador' => $idAcciones,
																		'datos' => $datos,
																		
																	] ),
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

					

// foreach( $acciones as $idAcciones => $v )
// {
	
		// $items[] = 	[
					// 'label' 		=>  $v,
					// 'content' 		=>  $this->render( 'avances',
																// [
																	// 'form' => $form,
																	// 'contador' => $idAcciones,
																	// 'datos' => $datos,
																	
																// ] ),
					// 'contentOptions'=> []
				// ];	
// }

// echo Collapse::widget([
    // 'items' => $items, 
// ]);