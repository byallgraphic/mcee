<?php
use yii\helpers\Html;

$items = [];
$index = 0;

foreach( $proyectos as $key => $proyecto ){
	

	$items[] = 	[
					'label' 		=>  $proyecto,
					'content' 		=>  $this->render( 'faseItem', 
													[  
														'form' => $form,
                                                        "model" => $model,
                                                        'idproyecto' => $key,
														'actividades_pom' => $actividades_pom,
														'arraySiNo' => $arraySiNo,
														'rol'			  => $rol,
														'reqLogisticos'  => $reqLogisticos,
														'reqTecnicos' => $reqTecnicos,
														'equiposCampo' => $equiposCampo,
														'intervencionIeo' =>  $intervencionIeo,
														'perfiles' => $perfiles,
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