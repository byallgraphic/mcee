<?php
use yii\helpers\Html;

use app\models\IsaProcesosGenerales;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Tabs;



$procesos = new IsaProcesosGenerales();
$procesos = $procesos->find()->AndWhere("id_proyectos_generales = $idProyecto and estado = 1")->orderby("id")->all();
$procesos = ArrayHelper::map($procesos,'id','descripcion');
?>

<?php
	$arrayColores = array('#F9EBEA','#EBDEF0','#F9EBEA','#FDF2E9','#F6DDCC','LIGHTCYAN');	
    $contenedores = [];
	$contador = 0;
    foreach( $procesos as $idProceso => $actividad )
	{ 
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividades_isa' => $actividades_isa,
                                                        'idProceso' => $idProceso,
														'arraySiNo' => $arraySiNo,
														'equiposCampo' => $equiposCampo,
														'docenteOrientador'=> $docenteOrientador,
														'intervencionIEO' => $intervencionIEO,
														'ciclos' => $ciclos,
														'perfiles' => $perfiles,
														'reqTecnicos' => $reqTecnicos,
														'nombreDiligencia'=> $nombreDiligencia,
														'rol'			  => $rol,
													] 
										),
					'contentOptions'=> [],
					'headerOptions' => ['style' => "background-color: $arrayColores[$contador]"],
				];
				$contador++;	
    }
    
    // use yii\bootstrap\Collapse;
    // echo Collapse::widget([
        // 'items' => $contenedores,
    // ]);
	
	echo tabs::widget([
			'items' => $contenedores,
		]);
		

?>




	

