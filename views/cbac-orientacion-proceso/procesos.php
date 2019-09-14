<?php

use app\models\CbacProcesos;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$procesos = CbacProcesos::find()->where( "estado=1 and id_proyecto=$idProyecto" )->orderby("id")->all();
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