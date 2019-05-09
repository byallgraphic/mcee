<?php
use yii\helpers\Html;

$items = [];
$index = 0;

foreach( $fases as $keyFase => $fase )
{
	
	/*$sesiones = Sesiones::find()
					->andWhere( 'id_fase='.$fase->id )
					->all();*/

	$items[] = 	[
					'label' 		=>  $fase,
					'content' 		=>  $this->render( 'faseItem', 
													[  
														'form' => $form,
                                                        "model" => $model,
                                                        'proyecto' => $keyFase,
                                                        'actividades_is_isa' => $actividades_is_isa,
                                                        'actividade_is_isa' => $actividade_is_isa,
                                                        'tipo_poblacion_is_isa' => $tipo_poblacion_is_isa,
														
													] 
										),
					'contentOptions'=> []
				];
				
	$index++;
}

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => $items,
]);