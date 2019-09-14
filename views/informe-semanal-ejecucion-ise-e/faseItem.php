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
                <?= $form->field($actividades, "[$index]actividad_1")->textInput() ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_1_porcentaje")->textInput() ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_2")->textInput() ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_2_porcentaje")->textInput() ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_3")->textInput() ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]actividad_3_porcentaje")->textInput() ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]avance_sede")->textInput() ?>
            </div>
            <div class=cell>
                <?= $form->field($actividades, "[$index]avance_ieo")->textInput() ?>
            </div>
            <div class=cell style='display:none'>
                <?= $form->field($actividades, "[$index]id_proyecto")->textInput(["value" => $index+1]) ?>
            </div>
   
    <?php

    echo Collapse::widget([
        'items' => $contenedores,
    ]);
    ?>
        <h3 style='background-color: #ccc;padding:5px;'>Visitas</h3>
        <div class=cell>
            <?= $form->field($visitas, "[$index]cantidad_visitas_realizadas")->textInput() ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]canceladas")->textInput() ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]visitas_fallidas")->textInput() ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]observaciones_evidencias")->textInput() ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]alarmas")->textInput() ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]logros")->textInput() ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$index]dificultades")->textInput() ?>
        </div>
        <div class=cell style='display:none'>
                <?= $form->field($visitas, "[$index]id_proyecto")->textInput(["value" => $index+1]) ?>
            </div>
    <?php
    
?>  
   



	

