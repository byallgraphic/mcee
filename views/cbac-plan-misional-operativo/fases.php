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
														'form' => $form,
                                                        "model" => $model,
                                                        'idproyecto' => $keyFase,
														'actividades_pom' => $actividades_pom,
														'arraySiNo' => $arraySiNo,
														'rol'			  => $rol,
														'reqLogisticos'  => $reqLogisticos,
														'reqTecnicos' => $reqTecnicos,
														'equiposCampo' => $equiposCampo,
														'intervencionIeo' =>  $intervencionIeo,
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