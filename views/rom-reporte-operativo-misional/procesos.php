<?php


use app\models\IsaRomProcesos;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;

foreach( $procesos as $idProceso => $v )
{
 
	$items[] = 	[
					'label' 		=>  $v['descripcion'],
					'content' 		=>  $this->render( 'actividades', 
													[ 
														'idProceso' 	=> $v['id'],
														'form' 			=> $form,
														'idProyecto'	=> $idProyecto,
														// 'datos'			=> [],
														'estados'		=> $estados,
														'actividades'	=> $v['actividades'],
													] 
										),
					'contentOptions'=> []
				];					
	
}

echo Collapse::widget([
	'items' => $items, 
]);















// $procesos = IsaRomProcesos::find()->where( "estado=1 and id_rom_proyectos=$idProyecto" )->all();
// $procesos = ArrayHelper::map($procesos,'id','descripcion');
       


// // foreach ($procesos as $porcentaje_avance => $dataProceso)
// // {
	// foreach( $procesos as $idProceso => $v )
	// {
	 
		// $items[] = 	[
						// 'label' 		=>  $v,
						// 'content' 		=>  $this->render( 'actividades', 
														// [ 
															// 'idProceso' => $idProceso,
															// 'form' 		=> $form,
															// 'idProyecto'=> $idProyecto,
															// 'datos'		=> [],
															// 'estados'	=> $estados,
														// ] 
											// ),
						// 'contentOptions'=> []
					// ];					
		
	// }
	
// // }
// echo Collapse::widget([
    // 'items' => $items, 
// ]);