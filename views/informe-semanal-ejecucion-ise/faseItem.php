<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//$id_sede 		= $_SESSION['sede'][0];
$id_sede 		= 1;
$id_institucion	= $_SESSION['instituciones'][0];
$contenedores = [];

?>
   
<?php
    foreach( $items as $keyFase => $item ){ 

                $contenedores[] = 	[
					'label' 		=>  $item,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'idPE' 		=> "", 
														'index' 	=> $index,
                                                        'item' 		=> $item,
                                                        "tipo_poblacion" => $tipo_poblacion,
                                                        "estudiasntes" => $estudiasntes,
                                                        "visitas"  => $visitas,
                                                        "form" => $form,
													] 
										),
					'contentOptions'=> []
				];
    }
    
    use yii\bootstrap\Collapse;

    ?>
     
            <h3 style='background-color: #ccc;padding:5px;'>Actividades</h3>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_1")->textInput([ 'value' => isset($datos[$index]['actividad_1']) ? $datos[$index]['actividad_1'] : '' ]) ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_1_porcentaje")->textInput([ 'value' => isset($datos[$index]['actividad_1_porcentaje']) ? $datos[$index]['actividad_1_porcentaje'] : '' ]) ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_2")->textInput([ 'value' => isset($datos[$index]['actividad_2']) ? $datos[$index]['actividad_2'] : '' ]) ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_2_porcentaje")->textInput([ 'value' => isset($datos[$index]['actividad_2_porcentaje']) ? $datos[$index]['actividad_2_porcentaje'] : '' ]) ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_3")->textInput([ 'value' => isset($datos[$index]['actividad_3']) ? $datos[$index]['actividad_3'] : '' ]) ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_3_porcentaje")->textInput([ 'value' => isset($datos[$index]['actividad_3_porcentaje']) ? $datos[$index]['actividad_3_porcentaje'] : '' ]) ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]avance_sede")->textInput([ 'value' => isset($datos[$index]['avance_sede']) ? $datos[$index]['avance_sede'] : '' ]) ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]avance_ieo")->textInput([ 'value' => isset($datos[$index]['avance_ieo']) ? $datos[$index]['avance_ieo'] : '' ]) ?>
            </div>
            <?= $form->field($actividades, "[$index]id_proyecto")->hiddenInput(['value'=> $index+1])->label(false); ?>
           
   
    <?php

    echo Collapse::widget([
        'items' => $contenedores,
    ]);
    ?>
        <h3 style='background-color: #ccc;padding:5px;'>Visitas</h3>
        <div class=cell>
            <?= $form->field($visitas, "[$index]cantidad_visitas_realizadas")->textInput([ 'value' => isset($datos2[$index]['cantidad_visitas_realizadas']) ? $datos2[$index]['cantidad_visitas_realizadas'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]canceladas")->textInput([ 'value' => isset($datos2[$index]['canceladas']) ? $datos2[$index]['canceladas'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]visitas_fallidas")->textInput([ 'value' => isset($datos2[$index]['visitas_fallidas']) ? $datos2[$index]['visitas_fallidas'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]observaciones_evidencias")->textInput([ 'value' => isset($datos2[$index]['observaciones_evidencias']) ? $datos2[$index]['observaciones_evidencias'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]alarmas")->textInput([ 'value' => isset($datos2[$index]['alarmas']) ? $datos2[$index]['alarmas'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]logros")->textInput([ 'value' => isset($datos2[$index]['logros']) ? $datos2[$index]['logros'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]dificultades")->textInput([ 'value' => isset($datos2[$index]['dificultades']) ? $datos2[$index]['dificultades'] : '' ]) ?>
        </div>
        <div class=cell style='display:none'>
                <?= $form->field($visitas, "[$index]id_proyecto")->textInput(["value" => $index+1]) ?>
            </div>
    <?php
    
?>  
   



	

