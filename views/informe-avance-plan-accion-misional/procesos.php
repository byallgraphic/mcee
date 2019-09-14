<?php

use app\models\EcProcesos;
use app\models\EcProductos;
use app\models\EcInformePlaneacionProyectos;
use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;

$model = new EcInformePlaneacionProyectos();

$ecProcesos = EcProcesos::find()->where( "estado=1 and id_proyecto=$idProyecto" )->all();
$ecProcesos = ArrayHelper::map($ecProcesos,'id','descripcion','porcentaje_avance');
 
$arrayColores = array('#F2F3F4','#EBDEF0','#F9EBEA','#FDF2E9','#F6DDCC','LIGHTCYAN'); 
$items[] = 	
		[
			'label' 		=>  "Horario fijo de trabajo con docentes",
			'content' 		=>  $form->field($model, "[$idProyecto]horario_de_trabajo_docentes")->textInput( [ 'value' => $datoInformePlaneacionProyectos[$idProyecto] ] )->label("Horario fijo de trabajo con docentes").
								$form->field($model, "[$idProyecto]id_proyecto")->hiddenInput( [ 'value' => $idProyecto ] )->label( false).
								$form->field($model, "[$idProyecto]estado")->hiddenInput( [ 'value' => '1' ] )->label( false),
								'contentOptions' => ['class' => 'in'],
								'headerOptions' => ['style' => 'background-color:LIGHTCYAN;'],
		];

$contador = 0;
foreach ($ecProcesos as $porcentaje_avance => $dataProceso)
{
	foreach( $dataProceso as $idProceso => $v )
	{
	 
		$items[] = 	[
						'label' 		=>  $v,
						'content' 		=>  $this->render( 'acciones', 
														[ 
															'idProceso' => $idProceso,
															'form' => $form,
															'estadoActual' => $estadoActual,
															'idProyecto' => $idProyecto,
															'datos'=>$datos,
														] 
											),
						'contentOptions'=> [],
						'headerOptions' => ['style' => "background-color: $arrayColores[$contador]"],
					];			
	$contador++;	
	}
}

				
$ecProductos = EcProductos::find()->where( "estado=1 and id_proyecto=$idProyecto" )->all();
$ecProductos = ArrayHelper::map($ecProductos,'id','descripcion');

foreach( $ecProductos as $idProductos => $v )
{
	$contador++;
	$items[] = 	[
					'label' 		=>  $v,
					'content' 		=>  $this->render( 'estrategias', 
													[ 
                                                        'idProductos' => $idProductos,
														'form' => $form,
														'estadoActual' => $estadoActual,
														'datoRespuesta'=> $datoRespuesta,
													] 
										),
					'contentOptions'=> [],
					'headerOptions' => ['style' => "background-color: $arrayColores[$contador]"],
				];			
	
}


// echo Collapse::widget([
    // 'items' => $items, 
// ]);

echo Tabs::widget([
    'items' => $items,
]);

$this->registerCss(".nav-tabs > li 
					{
						
						width: 50%;
					}
					");