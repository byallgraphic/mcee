<?php


use app\models\IsaRomProcesos;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;

use dosamigos\datepicker\DatePicker;
use app\models\Parametro;


$estados_actividad = Parametro::find()
							->alias('p')
							->innerJoin( 'tipo_parametro tp','tp.id=p.id_tipo_parametro' )
							->where( 'p.estado=1' )
							->andWhere( "tp.estado=1" )
							->andWhere( [ 'tp.descripcion' => '2 Reporte Iniciación - estados' ] )
							->all();
							
$estados_actividad = ArrayHelper::map( $estados_actividad,'id','descripcion' );

foreach( $procesos as $idProceso => $v )
{ 
	$items[] = 	[
					'label' 		=>  $v['descripcion'],
					'content' 		=>  $this->render( 'actividades', 
													[ 
														'idProceso' 				=> $v['id'],
														'form' 						=> $form,
														'idProyecto'				=> $idProyecto,
														// 'datos'			=> [],
														'estados'					=> $estados,
														'actividades'				=> $v['actividades'],
														'actividadesParticipadas'	=> $actividadesParticipadas,
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