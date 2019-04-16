<?php


use app\models\IsaRomActividades;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;

use yii\helpers\Html;

$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];
       
foreach( $actividades as $idActividad => $v )
{
	$labels[] = $v['descripcion'];
	$items[] = 	[
					'label' 		=>  $v['descripcion'],
					'content' 		=>  $this->render( 'formulario', 
													[ 
														'idActividad' 	=> $v['id'],
														'form' 			=> $form,
														'idProyecto'	=> $idProyecto,
														// 'datos'			=> $datos,
														'estados'		=> $estados,
														'evidencias_rom'=> $v['evidencia'],
													] 
										),
					'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$idActividad];"],
					'contentOptions'=> []
				];	
	
	
}

echo Tabs::widget([
    'items' => $items,
]);

// $this->registerJs("$('.tab1').removeClass('active');");

$this->registerCss(".nav-tabs > li {
						
						width: 400px;
						height: 80px;
					}
					
					.row {
						margin-left: 2px;
					}");