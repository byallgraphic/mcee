<?php

use app\models\CbacAcciones;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$acciones = CbacAcciones::find()->where( "estado=1 and id_proceso=$idProceso" )->orderby("id")->all();
$acciones = ArrayHelper::map($acciones,'id','descripcion');
       


foreach( $acciones as $idAcciones => $v )
{
	
		$items[] = 	[
					'label' 		=>  $v,
					'content' 		=>  $this->render( 'avances',
																[
																	'form' => $form,
																	'contador' => $idAcciones,
																	'datos' => $datos,
																	
																] ),
					'contentOptions'=> []
				];	
}




echo Collapse::widget([
    'items' => $items, 
]);