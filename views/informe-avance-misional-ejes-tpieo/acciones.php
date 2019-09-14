<?php

use app\models\EcAcciones;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$ecAcciones = EcAcciones::find()->where( "estado=1 and id_proceso=$idProceso" )->all();
$ecAcciones = ArrayHelper::map($ecAcciones,'id','descripcion');
       


foreach( $ecAcciones as $idAcciones => $v )
{
	
		$items[] = 	[
					'label' 		=>  $v,
					'content' 		=>  $this->render( 'avances',
																[
																	'form' => $form,
																	'contador' => $idAcciones,
																	'estadoActual' => $estadoActual,
																	'idProyecto' => $idProyecto,
																	'datos'=>$datos,
																] ),
					'contentOptions'=> []
				];	
}




echo Collapse::widget([
    'items' => $items, 
]);