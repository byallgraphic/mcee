<?php


use app\models\IsaForDebRet;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$IsaForDebRet = IsaForDebRet::find()->where( "estado=1 and id_variaciones_actividades=$idVariaciones" )->all();
$IsaForDebRet = ArrayHelper::map($IsaForDebRet,'id','descripcion');
       
foreach ($IsaForDebRet as $idIsaForDebRet => $dataIsaForDebRet)
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