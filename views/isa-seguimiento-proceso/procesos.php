<?php

use app\models\IsaProcesoSeguimiento;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$procesos = IsaProcesoSeguimiento::find()->where( "estado=1 and id_proyecto=$idProyecto" )->all();
$procesos = ArrayHelper::map($procesos,'id','descripcion');
       
foreach ($procesos as $idProceso => $labelProceso)
{
		$items[] = 	[
						'label' 		=>  $labelProceso,
						'content' 		=>  $this->render( 'actividades', 
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