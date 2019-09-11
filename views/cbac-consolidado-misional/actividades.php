<?php

use app\models\CbacActividadesConsolidadoMisional;
use yii\helpers\ArrayHelper;
// use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;

$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];

$actividadesConsolidado = CbacActividadesConsolidadoMisional::find()->where( "estado=1 and id_rom_procesos=$idProceso" )->all();
$actividadesConsolidado = ArrayHelper::map($actividadesConsolidado,'id','descripcion');

	 
foreach ($actividadesConsolidado as $idActividad => $dataActividad)
{

	if($idActividad == 1 or $idActividad == 5 )
	{		
		$items[] = 
		[
			'label' 		=>  $dataActividad,
			'content' 		=>  
				$this->render( 'personas', 
					[ 
						'idActividad' => $idActividad,
						'form' => $form,
						'idProyecto' => $idProyecto,
					] 
				),
			'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$idActividad];"],
			'contentOptions'=> []
		];
		
	}
	else
	{
		$items[] = 
			[
				'label' 		=>  $dataActividad,
				'content' 		=>  
					$this->render( 'estadoactual', 
						[ 
							'idActividad' => $idActividad,
							'form' => $form,
							'idProyecto' => $idProyecto,
						] 
					),
				'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$idActividad];"],
				'contentOptions'=> []
			];
	}
}
	


echo Tabs::widget([
    'items' => $items,
]);

$this->registerCss("

			.nav-tabs > li {
						
						width: 380px;
						height: 100px;
					}
					
					#w2 li
						{
						 height: 142px;
						}
					// #w6 li:first-child:hover
						// {
						 // height: 150px;
						// }
					// #w9 li:first-child:hover
						// {
						 // height: 150px;
						// }
					// #w13 li:first-child:hover
						// {
						 // height: 150px;
						// }	
					// .row {
						// margin-left: 2px;
					// }");

