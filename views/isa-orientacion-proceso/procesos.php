<?php

use app\models\IsaProcesos;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$procesos = IsaProcesos::find()->where( "estado=1 and id_proyecto=$idProyecto" )->all();
$procesos = ArrayHelper::map($procesos,'id','descripcion');
       
foreach ($procesos as $idProceso => $dataProceso)
{
		$items[] = 	[
						'label' 		=>  $dataProceso,
						'content' 		=>  $this->render( 'acciones', 
														[ 
															'idProceso' => $idProceso,
															'form' => $form,
															'idProyecto' => $idProyecto,
															'datos' => $datos,
														] 
											),
						'contentOptions'=> []
					];			


}


echo Collapse::widget([
    'items' => $items, 
]);