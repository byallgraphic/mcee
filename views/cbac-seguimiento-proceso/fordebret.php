<?php


use app\models\CbacForDebRet;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$CbacForDebRet = CbacForDebRet::find()->where( "estado=1 and id_variaciones_actividades=$idVariaciones" )->all();
$CbacForDebRet = ArrayHelper::map($CbacForDebRet,'id','descripcion');
       
foreach ($CbacForDebRet as $idIsaForDebRet => $dataIsaForDebRet)
{
		$items[] = 	[
						'label' 		=>  $dataIsaForDebRet,
						'content' 		=>  $this->render( 'semanafordebret', 
														[ 
															'idIsaForDebRet' => $idIsaForDebRet,
															'form' => $form,
															'datos' => $datos,
															'idVariaciones' => $idVariaciones,
														] 
											),
						'contentOptions'=> []
					];			


}


echo Collapse::widget([
    'items' => $items, 
]);