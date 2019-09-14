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
		'content' 		=>  $this->render( 'faseItem', 
										[ 
											//'items' 	=> ["Tipo y cantidad de población"], 
											'index' 	=> $keyFase,
											'fase' 		=> $fase,
											"tipo_poblacion" => $tipo_poblacion,
											"estudiasntes" => $estudiasntes,
											"actividades" => $actividades,
											"visitas"  => $visitas,
											"form" => $form,
											"datos" => $datos,
											"datos2" => $datos2,
											"sedes" => $sedes,
											"idTipoInforme" => $idTipoInforme
										] 
							),
		'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$keyFase];"],
		'contentOptions'=> []
	];

	/*if($keyFase == 0){
		$items[] = 	[
			'label' 		=>  $fase,
			'content' 		=>  $this->render( 'faseItem', 
											[ 
												'items' 	=> ["Tipo y cantidad de población"], 
												'index' 	=> $index,
												'fase' 		=> $fase,
												"tipo_poblacion" => $tipo_poblacion,
												"estudiasntes" => $estudiasntes,
												"actividades" => $actividades,
												"visitas"  => $visitas,
												"form" => $form,
												"datos" => $datos,
												"datos2" => $datos2,
											] 
								),
			'headerOptions' => ['class' => 'tab1', 'style' => 'background-color: #f2dedf;'],
			'contentOptions'=> []
		];
	}
	if($keyFase == 1){
		$items[] = 	[
			'label' 		=>  $fase,
			'content' 		=>  $this->render( 'faseItem', 
											[ 
												'items' 	=> ["Tipo y cantidad de población"], 
												'index' 	=> $index,
												'fase' 		=> $fase,
												"tipo_poblacion" => $tipo_poblacion,
												"estudiasntes" => $estudiasntes,
												"actividades" => $actividades,
												"visitas"  => $visitas,
												"form" => $form,
												"datos" => $datos,
												"datos2" => $datos2,
											] 
								),
			'headerOptions' => ['style' => 'background-color: #def0d8;'],
			'contentOptions'=> []
		];
	}
	if($keyFase == 2){
		$items[] = 	[
			'label' 		=>  $fase,
			'content' 		=>  $this->render( 'faseItem', 
											[ 
												'items' 	=> ["Tipo y cantidad de población"], 
												'index' 	=> $index,
												'fase' 		=> $fase,
												"tipo_poblacion" => $tipo_poblacion,
												"estudiasntes" => $estudiasntes,
												"actividades" => $actividades,
												"visitas"  => $visitas,
												"form" => $form,
												"datos" => $datos,
												"datos2" => $datos2,
											] 
								),
			'headerOptions' => ['style' => 'background-color: #95b3d7'],
			'contentOptions'=> []
		];
	}*/
	
				
	$index ++;
}


use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;

echo Tabs::widget([
    'items' => $items,
]);

$this->registerJs("$('.tab1').removeClass('active');");

$this->registerCss(".nav-tabs > li {
						width: 290px;
					}

					.row {
						margin-left: 2px;
					}");