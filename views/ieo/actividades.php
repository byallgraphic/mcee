<?php
use yii\helpers\Html;
use app\models\EcActividadesGenerales;
use app\models\EcProcesosGenerales;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;


$colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];


$procesos = new EcProcesosGenerales();
$procesos = $procesos->find()->AndWhere("id_proyectos_generales = $idProyecto")->orderby("id")->all();
$procesos = ArrayHelper::map($procesos,'id','descripcion');

foreach( $procesos as $idprocesos => $proceso )
{
	$actividades = new EcActividadesGenerales();
	$actividades = $actividades->find()->AndWhere("id_procesos_generales = $idprocesos")->orderby("id")->all();
	$actividades = ArrayHelper::map($actividades,'id','descripcion');

	$items = [];
	$keyFase = 0;

	$items[] = 	
		[
			'label' 		=>  "Reconocimiento previo y documentos a desarrollar por el profesional de apoyo",
			'content' 		=>  $this->render( 'formReconocimiento', 
											[  
												'form' => $form,
												'datos'=> $datos,
												"persona" => $persona,
												"nombres" => $nombres,
												'idprocesos' => $idprocesos,
												'model' => $model,
												'datos'=>$datos,
											] 
								),
			
			'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$keyFase];"],
			'contentOptions'=> []
		];
		
	
	foreach( $actividades as $idactividad => $proceso )
	{
		
		if( $proceso == "Productos" )
			$formulario = "formProductos";
		else
			$formulario = "formActividades";
		$items[] = 	
		[
			'label' 		=>  $proceso,
			'content' 		=>  $this->render( $formulario, 
											[  
												'form' => $form,
												'datos'=> $datos,
												"persona" => $persona,
												"nombres" => $nombres,
												"idactividad" => $idactividad,
												'proyecto' =>  $proyecto,
												'model' => $model
											] 
								),
			
			'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$keyFase];"],
			'contentOptions'=> []
		];
		$keyFase++;
	}
	
}

/*echo Collapse::widget([
    'items' => $items,
]);*/
echo Tabs::widget([
    'items' => $items,
]);

$this->registerJs("$('.tab1').removeClass('active');");

$this->registerCss(".nav-tabs > li {
						
						width: 419px;
						height: 80px;
					}
					
					.row {
						margin-left: 2px;
					}");

