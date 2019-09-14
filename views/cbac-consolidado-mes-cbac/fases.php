<?php
use yii\helpers\Html;

$items = [];
$index = 0;

foreach( $fases as $keyFase => $fase ){
	
	/*$sesiones = Sesiones::find()
					->andWhere( 'id_fase='.$fase->id )
					->all();*/
	if($keyFase ==  4){
		$items[] = 	[
						'label' 		=>  $fase,
						'content' 		=>  $this->render( 'faseItem', 
														[  
															'form' => $form,
															"model" => $model,
															'proyecto' => $keyFase,
															'imp_cbac' => $imp_cbac,
															'actividade_cbac' => $actividade_cbac,
															'tipo_poblacion_cbac' => $tipo_poblacion_cbac,
															'evidencias_cbac' => $evidencias_cbac,
															'datos' => $datos														
														] 
											),
						'options' => ['style' => 'display: none;'],
						'contentOptions'=> []
					];
	}else{
		$items[] = 	[
			'label' 		=>  $fase,
			'content' 		=>  $this->render( 'faseItem', 
											[  
												'form' => $form,
												"model" => $model,
												'proyecto' => $keyFase,
												'imp_cbac' => $imp_cbac,
												'actividade_cbac' => $actividade_cbac,
												'tipo_poblacion_cbac' => $tipo_poblacion_cbac,
												'evidencias_cbac' => $evidencias_cbac,
												'datos' => $datos														
											] 
								),
			'contentOptions'=> []
		];
	}
				
	$index ++;
}

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => $items,
]);