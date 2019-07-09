<?php

use app\models\IsaRomProcesos;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;



$procesos = IsaRomProcesos::find()->where( "estado=1 and id_rom_proyectos=$idProyecto" )->all();
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
														] 
											),
						'contentOptions'=> []
					];			


}
		
echo Collapse::widget([
    'items' => $items, 
]);