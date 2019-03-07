<?php
use yii\helpers\Html;

use app\models\IsaProcesosGenerales;
use yii\helpers\ArrayHelper;



$procesos = new IsaProcesosGenerales();
$procesos = $procesos->find()->AndWhere("id_proyectos_generales = ". $idProyecto)->orderby("id")->all();
$procesos = ArrayHelper::map($procesos,'id','descripcion');
?>

<?php
    $contenedores = [];
    foreach( $procesos as $idProceso => $actividad )
	{ 
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividades_isa' => $actividades_isa,
                                                        'idProceso' => $idProceso
													] 
										),
					'contentOptions'=> []
				];
    }
    
    use yii\bootstrap\Collapse;
    echo Collapse::widget([
        'items' => $contenedores,
    ]);

?>




	

