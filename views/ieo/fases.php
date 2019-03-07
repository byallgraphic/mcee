<?php
use yii\helpers\Html;

$items = [];
$index = 0;
$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];


foreach( $fases as $keyFase => $fase ){
	
	/*$sesiones = Sesiones::find()
					->andWhere( 'id_fase='.$fase->id )
					->all();*/
	

	$items[] = 	[
		'label' 		=>  $fase,
		'content' 		=>  $this->render( 'contenedorItem', 
										[  
											'form' => $form,
											'numProyecto' 	=> $keyFase,
											'index' 	=> $index,
											'fase' 		=> $fase,
											'documentosReconocimiento' => $documentosReconocimiento,
											'tiposCantidadPoblacion' => $tiposCantidadPoblacion,
											'evidencias' => $evidencias,
											'producto' => $producto,
											'requerimientoExtra' => $requerimientoExtra,
											"model" => $model,
											"estudiantesGrado" =>  $estudiantesGrado,
											'datos'=> $datos,
											"persona" => $persona,
											"nombres" => $nombres,
											"idTipoInforme" => $idTipoInforme,
										] 
							),
		
		'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$keyFase];"],
		'contentOptions'=> []
	];


				
	$index ++;
}

use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;

/*echo Collapse::widget([
    'items' => $items,
]);*/
echo Tabs::widget([
    'items' => $items,
]);

$this->registerJs("$('.tab1').removeClass('active');");

$this->registerCss(".nav-tabs > li {
						
						width: 290px;
						height: 102px;
					}
					
					.row {
						margin-left: 2px;
					}");

