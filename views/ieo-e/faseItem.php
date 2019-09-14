<?php
use yii\helpers\Html;
//$id_sede 		= $_SESSION['sede'][0];
$id_sede 		= 1;
$id_institucion	= $_SESSION['instituciones'][0];
$contenedores = [];
$index = 0;
?>

<?php
    echo $form->field($model, "[$numProyecto]persona_acargo")->textInput();
     $actividades =[
        1 =>    "Requerimientos extras I.E.O",
        2 =>    "Reconocimiento previo y documentos a desarrollar por el profesional de apoyo",
        3 =>    "Actividad 1.Mesa de trabajo para la presentación de resultados de la caracterización y mapeo (puntos de partida y llegada)",
        4 =>    "Actividad 2. Acompañamiento en práctica",
        5 =>    "Actividad 3. Mesa de trabajo: contrucción del plan de acción",
        6 =>    "Productos"
    ];
    
    foreach( $actividades as $keyFase => $actividad ){ 

                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        'index' 	=> $keyFase,
                                                        'numProyecto' 	=> $numProyecto,
                                                        'item' 		=> $actividad,

                                                        'documentosReconocimiento' => $documentosReconocimiento,
                                                        'tiposCantidadPoblacion' => $tiposCantidadPoblacion,
                                                        'evidencias' => $evidencias,
                                                        'producto' => $producto,
                                                        'requerimientoExtra' => $requerimientoExtra,
                                                        "model" => $model,
                                                        "estudiantesGrado" =>  $estudiantesGrado
													] 
										),
					'contentOptions'=> []
				];

    $index ++;
    }
    
    use yii\bootstrap\Collapse;
    echo Collapse::widget([
        'items' => $contenedores,
    ]);

?>




	

