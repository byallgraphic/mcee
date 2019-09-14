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
        2 =>    "Actividad 2. Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas.",
        3 =>    "Actividad 3:  Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes.",
        4 =>    "Actividad 4. Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales.",
        5 =>    "Actividad No. 5: Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias.",
        6 =>    "Actividad No. 6: Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas.",
        7 =>    "Actividad 7. Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida.",
        8 =>    "Actividad 8.  Realizar talleres de promoción de lectura, escritura y oralidad a familias. .",
        9 =>    "Actividad 9. Apoyar el desarrollo de los proyectos institucionales.",
        10 =>    "Actividad 10. Divulgar las experiencias de vínculo de las familias a la escuela. ",
        11 =>    "Actividad 11. Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas.",
        12 =>    "",
    ];

    foreach( $actividades as $keyFase => $actividad ){ 

            if($proyecto ==  1 && $keyFase <= 2){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'imp_cbac' => $imp_cbac,
                                                        'actividade_cbac' => $actividade_cbac,
                                                        'tipo_poblacion_cbac' => $tipo_poblacion_cbac,
                                                        'evidencias_cbac' => $evidencias_cbac,
                                                        'index' => $keyFase,
                                                        'datos' => $datos
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
                                                        'imp_cbac' => $imp_cbac,
                                                        'actividade_cbac' => $actividade_cbac,
                                                        'tipo_poblacion_cbac' => $tipo_poblacion_cbac,
                                                        'evidencias_cbac' => $evidencias_cbac,
                                                        'index' => $keyFase,
                                                        'datos' => $datos
													] 
										),
					'contentOptions'=> []
                ];
                
            }
            else if($proyecto ==  3 && $keyFase == 12){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'imp_cbac' => $imp_cbac,
                                                        'actividade_cbac' => $actividade_cbac,
                                                        'tipo_poblacion_cbac' => $tipo_poblacion_cbac,
                                                        'evidencias_cbac' => $evidencias_cbac,
                                                        'index' => $keyFase,
                                                        'datos' => $datos
													] 
                                        ),
                    'options' => ['style' => 'display: none;'],
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
                                                        'imp_cbac' => $imp_cbac,
                                                        'actividade_cbac' => $actividade_cbac,
                                                        'tipo_poblacion_cbac' => $tipo_poblacion_cbac,
                                                        'evidencias_cbac' => $evidencias_cbac,
                                                        'index' => $keyFase,
                                                        'datos' => $datos
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
    <h3 style='background-color: #ccc;padding:5px;'>Cuál es el % del estado general  del desarrollo de herramientas en docentes y directivos docentes de las IEO que implementen componentes artísticos y culturales</h3>
    <?php
    
    echo $form->field($imp_cbac, "[$proyecto]avance_sede")->textInput([ 'value' => isset($datos[$proyecto]['avance_sede']) ? $datos[$proyecto]['avance_sede'] : '' ]);
    echo $form->field($imp_cbac, "[$proyecto]avance_ieo")->textInput([ 'value' => isset($datos[$proyecto]['avance_ieo']) ? $datos[$proyecto]['avance_ieo'] : '' ]);
    echo $form->field($imp_cbac, "[$proyecto]id_componente")->hiddenInput(["value" => $proyecto])->label(false);
?>