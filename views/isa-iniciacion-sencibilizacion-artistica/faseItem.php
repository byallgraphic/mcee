<?php
use yii\helpers\Html;

use app\models\IsaProcesosGenerales;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Tabs;



$procesos = new IsaProcesosGenerales();
$procesos = $procesos->find()->AndWhere("id_proyectos_generales = ". $idProyecto)->orderby("id")->all();
$procesos = ArrayHelper::map($procesos,'id','descripcion');
?>

<?php
	$arrayColores = array('#F2F3F4','#EBDEF0','#F9EBEA','#FDF2E9','#F6DDCC','LIGHTCYAN');	
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




	

