<?php
use yii\helpers\Html;

$items = [];
$index = 0;

foreach( $fases as $keyFase => $fase ){
	
	/*$sesiones = Sesiones::find()
					->andWhere( 'id_fase='.$fase->id )
					->all();*/

	$items[] = 	[
					'label' 		=>  $fase,
					'content' 		=>  $this->render( 'faseItem', 
													[ 
                                                        'items' 	=> ["Tipo y cantidad de población"], 
														'index' 	=> $index,
														'sesiones' 	=> $index,
                                                        'fase' 		=> $fase,
                                                        "tipo_poblacion" => $tipo_poblacion,
                                                        "docentes" => $docentes,
														"estudiasntes" => $estudiasntes,
														"actividades" => $actividades,
														"visitas"  => $visitas,
													] 
										),
					'contentOptions'=> []
				];
				
	$index ++;
}


use yii\bootstrap\Collapse;



echo Collapse::widget([
    'items' => $items,
]);