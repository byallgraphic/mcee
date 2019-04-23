<?php


use app\models\IsaLogrosActividades;
use app\models\IsaOrientacionMetodologicaActividades;
use app\models\IsaVariacionesActividades;
use app\models\IsaActividadesSeguimiento;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\bootstrap\Tabs;

$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];




$actividadesSeguimiento = IsaActividadesSeguimiento::find()->where( "estado=1 and id_proceso=$idProceso" )->all();
$actividadesSeguimiento = ArrayHelper::map($actividadesSeguimiento,'id','descripcion');

$content = '';       
foreach ($actividadesSeguimiento as $idActividad => $dataActividad)
{
		$content = Html::tag( 
						'div',  
						$this->render( 'porcentajes', 
										[ 
											'idActividad' => $idActividad,
											'form' => $form,
											'datos' => $datos,
											'idProyecto' => $idProyecto,
										] 
									),
						[ 'class' => 'list-group-item' ]
					);
					
		$content .= Html::tag( 
						'div',  
						$this->render( 'logros', 
									[ 
										'idActividad' => $idActividad,
										'form' => $form,
										'datos' => $datos,
										'idProyecto' => $idProyecto,
									] 
								),
						[ 'class' => 'list-group-item' ]
					);
					
		$content .= Html::tag( 
						'div',  
						$this->render( 'variacionesactividades', 
										[ 
											'idActividad' => $idActividad,
											'form' => $form,
											'datos' => $datos,
											'idProyecto' => $idProyecto,
										] 
									),
						[ 'class' => 'list-group-item' ]
					);
	
		$items[] = 	[
						'label' 		=>  $dataActividad,
						'content' 		=>	$content,
						'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$idActividad];"],			
						'contentOptions'=> [],
						'active'		=> false,
					];								
					
}


echo Tabs::widget([
    'items' => $items,
]);

$this->registerCss(".nav-tabs > li {
						
						width: 380px;
						height: 80px;
					}
					
					.row {
						margin-left: 2px;
					}");

// foreach ($actividadesSeguimiento as $idActividad => $dataActividad)
// {
		// $items[] = 	[
						// 'label' 		=>  $dataActividad,
						// 'content' 		=>	[  
												// $this->render
														// ( 'porcentajes', 
															// [ 
																// 'idActividad' => $idActividad,
																// 'form' => $form,
																// 'datos' => $datos,
																// 'idProyecto' => $idProyecto,
															// ] 
														// ),
												// $this->render
														// ( 'logros', 
															// [ 
																// 'idActividad' => $idActividad,
																// 'form' => $form,
																// 'datos' => $datos,
																// 'idProyecto' => $idProyecto,
															// ] 
														// ),
												// $this->render
														// ( 'variacionesactividades', 
															// [ 
																// 'idActividad' => $idActividad,
																// 'form' => $form,
																// 'datos' => $datos,
																// 'idProyecto' => $idProyecto,
															// ] 
														// ),														
											// ],
									
						// 'contentOptions'=> []
					// ];								
					
// }


// $procesos = IsaOrientacionMetodologicaActividades::find()->where( "estado=1 and id_proyecto=$idProyecto" )->all();
// $procesos = ArrayHelper::map($procesos,'id','descripcion');
       
// foreach ($procesos as $idProceso => $dataProceso)
// {
		// $items[] = 	[
						// 'label' 		=>  $dataProceso,
						// 'content' 		=>  $this->render( 'orientacion', 
														// [ 
															// 'idProceso' => $idProceso,
															// 'form' => $form,
															// 'idProyecto' => $idProyecto,
															// 'datos' => $datos,
														// ] 
											// ),
						// 'contentOptions'=> []
					// ];			


// }




// $procesos = IsaVariacionesActividades::find()->where( "estado=1 and id_proyecto=$idProyecto" )->all();
// $procesos = ArrayHelper::map($procesos,'id','descripcion');
       
// foreach ($procesos as $idProceso => $dataProceso)
// {
		// $items[] = 	[
						// 'label' 		=>  $dataProceso,
						// 'content' 		=>  $this->render( 'variacionesactividades', 
														// [ 
															// 'idProceso' => $idProceso,
															// 'form' => $form,
															// 'idProyecto' => $idProyecto,
															// 'datos' => $datos,
														// ] 
											// ),
						// 'contentOptions'=> []
					// ];			


// }

// echo Collapse::widget([
    // 'items' => $items, 
// ]);