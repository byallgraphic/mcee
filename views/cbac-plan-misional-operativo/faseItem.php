<?php
use yii\helpers\Html;
//$id_sede 		= $_SESSION['sede'][0];
$id_sede 		= 1;
$id_institucion	= $_SESSION['instituciones'][0];
$contenedores = [];
$index = 0;
?>

<?php
    
     $actividades =[
        1 =>    "Actividad 1: Aplicar en campo la propuesta didáctica en arte y cultura con docentes y directivos docentes",
        2 =>    "Actividad 2: Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas.",
       // 3 =>    "Actividad 3:  Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes.",
      //  4 =>    "Actividad 4. Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales.",
        3 =>    "Actividad 3: Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias.",
        4 =>    "Actividad 4: Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas.",
        5 =>    "Actividad 5: Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida.",
        6 =>    "Actividad 6:  Realizar talleres de promoción de lectura, escritura y oralidad a familias. ",
        // 9 =>    "Actividad 9. Apoyar el desarrollo de los proyectos institucionales.",
        // 10 =>   "Actividad 10. Divulgar las experiencias de vínculo de las familias a la escuela. ",
        // 11 =>   "Actividad 11. Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas.",
    ];
    
    foreach( $actividades as $keyFase => $actividad ){ 

            if($proyecto ==  1 && $keyFase <= 2){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividades_pom' => $actividades_pom,
                                                        'index' => $keyFase,
                                                        'datos' => $datos,
														'arraySiNo' => $arraySiNo,
													] 
										),
					'contentOptions'=> []
				];
            }else if($proyecto ==  2 && $keyFase > 2 && $keyFase <= 7){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividades_pom' => $actividades_pom,
                                                        'index' => $keyFase,
                                                        'datos' => $datos,
														'arraySiNo' => $arraySiNo,
													] 
										),
					'contentOptions'=> []
				];
            } 
            else if($proyecto ==  3 && $keyFase > 7){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividades_pom' => $actividades_pom,
                                                        'index' => $keyFase,
                                                        'datos' => $datos,
														'arraySiNo' => $arraySiNo,
													] 
										),
					'contentOptions'=> []
				];
            }    
        
            

    $index ++;
    }
    
    use yii\bootstrap\Collapse;
    echo Collapse::widget([
        'items' => $contenedores,
    ]);

?>




	

