<?php


use app\models\CbacVariacionesActividades;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;


$variaciones = CbacVariacionesActividades::find()->where( "estado=1 and id_actividades=$idActividad" )->all();
$variaciones = ArrayHelper::map($variaciones,'id','descripcion');
       
foreach ($variaciones as $idVariaciones => $dataVariaciones)
{
		$items[] = 	[
						'label' 		=>  $dataVariaciones,
						'content' 		=>  $this->render( 'fordebret', 
														[ 
															'idVariaciones' => $idVariaciones,
															'form' => $form,
															'datos' => $datos,
														] 
											),
						'contentOptions'=> []
					];			


}


// echo tabs::widget([
    // 'items' => $items, 
// ]);

echo Collapse::widget([
    'items' => $items, 
]);