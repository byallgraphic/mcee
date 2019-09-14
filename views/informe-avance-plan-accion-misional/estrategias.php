<?php

use app\models\EcEstrategias;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$ecEstrategias = EcEstrategias::find()->where( "estado=1 and id_producto=$idProductos" )->all();
$ecEstrategias = ArrayHelper::map($ecEstrategias,'id','descripcion','anio');
       

foreach ($ecEstrategias as $fecha => $dataEstrategia)
{
	
	foreach( $dataEstrategia as $idEstrategia => $v )
	{
		
			$items[] = 	[
						'label' 		=>  "$v - $fecha",
						'content' 		=>  $this->render( 'respuesta',
																	[
																		'contador'=> $idEstrategia,
																		'form' => $form,
																		'estadoActual' => $estadoActual,
																		'fecha' => $fecha,
																		'datoRespuesta'=> $datoRespuesta,
																	] ),
						'contentOptions'=> []
					];	

	}

}

echo Collapse::widget([
    'items' => $items, 
]);