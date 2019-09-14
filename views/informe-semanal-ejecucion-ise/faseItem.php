<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//$id_sede 		= $_SESSION['sede'][0];
$id_sede 		= 1;
$id_institucion	= $_SESSION['instituciones'][0];
$contenedores = [];

?>
   
<?php
    /*foreach( $items as $keyFase => $item ){ 

                $contenedores[] = 	[
					'label' 		=>  $item,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'idPE' 		=> "", 
														'index' 	=> $index,
                                                        'item' 		=> $item,
                                                        "tipo_poblacion" => $fases,
                                                        "estudiasntes" => $estudiasntes,
                                                        "visitas"  => $visitas,
                                                        "form" => $form,
                                                        "datos" => $datos
													] 
										),
					'contentOptions'=> []
				];
    }
    
    use yii\bootstrap\Collapse;*/

    if($index == 0){
        $i = 0;
        ?>
            <h3 style='background-color: #ccc;padding:5px;'>Actividades</h3>
        <?php
        foreach ($sedes as $key => $value) {
            
    ?>

            
     
            <h3 style='background-color: #ccc;padding:5px;'>Sede <?=$value?> </h3>
            
            <div class=row style='text-align:center;'>
                <div class="col-sm-1" style='padding:0px;'>
                    <span total class='form-control' style='background-color:#ccc;height:70px;'>Actividad 1</span>
                </div>
                <div class="col-sm-2" style='padding:0px;'>
                    <span total class='form-control' style='background-color:#ccc;height:70px'>Actividad 1 %</span>
                </div>
                <div class="col-sm-1" style='padding:0px;'>
                    <span total class='form-control' style='background-color:#ccc;height:70px'>Actividad 2</span>
                </div>       
                <div class="col-sm-2" style='padding:0px;'>
                    <span total class='form-control' style='background-color:#ccc;height:70px'>Actividad 2 %</span>
                </div>
                <div class="col-sm-1" style='padding:0px;'>
                    <span total class='form-control' style='background-color:#ccc;height:70px'>Actividad 3</span>
                </div>
                <div class="col-sm-2" style='padding:0px;'>
                    <span total class='form-control' style='background-color:#ccc;height:70px'>Actividad 3 %</span>
                </div>
                <div class="col-sm-2" style='padding:0px;'>
                    <span total class='form-control' style='background-color:#ccc;height:70px'>Avance sede %</span>
                </div>
                <div class="col-sm-1" style='padding:0px;'>
                    <span total class='form-control' style='background-color:#ccc;height:70px'>Avance IEO %</span>
                </div>
            </div>

            <div class=row>
                <div class="col-sm-1" style='padding:0px;'>
                    <?= $form->field($actividades, "[$i]actividad_1")->dropDownList( [ '0', '1', '2', '3', '4'],['options' => [$datos[$i]['actividad_1'] => ['selected'=>true]]] )->label(false); ?>
                </div>

                <div class="col-sm-2" style='padding:0px;'>
                <?= $form->field($actividades, "[$i]actividad_1_porcentaje")->textInput([ 'class' => "form-control avance-$i-sede", 'value' => isset($datos[$i]['actividad_1_porcentaje']) ? $datos[$i]['actividad_1_porcentaje'].'%' : '' ])->label(false); ?>
                </div>
                <div class="col-sm-1" style='padding:0px;'>
                    <?= $form->field($actividades, "[$i]actividad_2")->dropDownList( [ '0', '1', '2', '3', '4' ], ['options' => [$datos[$i]['actividad_2'] => ['selected'=>true]]] )->label(false); ?>
                </div>        
                <div class="col-sm-2" style='padding:0px;'>
                    <?= $form->field($actividades, "[$i]actividad_2_porcentaje")->textInput([ 'class' => "form-control avance-$i-sede", 'value' => isset($datos[$i]['actividad_2_porcentaje']) ? $datos[$i]['actividad_2_porcentaje'].'%' : '' ])->label(false); ?>
                </div>
                <div class="col-sm-1" style='padding:0px;'> 
                    <?= $form->field($actividades, "[$i]actividad_3")->dropDownList( [ '0', '1', '2', '3', '4' ] , ['options' => [$datos[$i]['actividad_3'] => ['selected'=>true]]] )->label(false); ?>
                </div>
                <div class="col-sm-2" style='padding:0px;'>
                    <?= $form->field($actividades, "[$i]actividad_3_porcentaje")->textInput([ 'class' => "form-control avance-$i-sede", 'value' => isset($datos[$i]['actividad_3_porcentaje']) ? $datos[$i]['actividad_3_porcentaje'].'%' : '' ])->label(false); ?>
                </div>
                <div class="col-sm-2" style='padding:0px;'>
                    <?= $form->field($actividades, "[$i]avance_sede")->textInput([ 'class' => "form-control avance-sede", 'value' => isset($datos[$i]['avance_sede']) ? $datos[$i]['avance_sede'].'%' : '' ])->label(false); ?>
                </div>
                <div class="col-sm-1" style='padding:0px;'>
                    <?= $form->field($actividades, "[$i]avance_ieo")->textInput(['class' => "form-control avance-ieo",  'value' => isset($datos[$i]['avance_ieo']) ? $datos[$i]['avance_ieo'].'%' : '' ])->label(false); ?>
                </div>
            </div>

            <?= $form->field($actividades, "[$i]id_proyecto")->hiddenInput(['value'=> $i+1])->label(false); ?>
            <?= $form->field($actividades, "[$i]id_sede")->hiddenInput(['value'=> $key])->label(false); ?>
    <?php
            $i++;
        }
    }   
    /*echo Collapse::widget([
        'items' => $contenedores,
    ]);*/

    if($index == 2){
        $i = 0;
        ?>
            <h3 style='background-color: #ccc;padding:5px;'>Visitas</h3>
        <?php
        foreach ($sedes as $key => $value) {
    ?>
        <h3 style='background-color: #ccc;padding:5px;'>Sede <?=$value?></h3>
        <div class=cell>
            <?= $form->field($visitas, "[$i]cantidad_visitas_realizadas")->textInput([ 'value' => isset($datos2[$i]['cantidad_visitas_realizadas']) ? $datos2[$i]['cantidad_visitas_realizadas'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$i]canceladas")->textInput([ 'value' => isset($datos2[$i]['canceladas']) ? $datos2[$i]['canceladas'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$i]visitas_fallidas")->textInput([ 'value' => isset($datos2[$i]['visitas_fallidas']) ? $datos2[$i]['visitas_fallidas'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$i]observaciones_evidencias")->textInput([ 'value' => isset($datos2[$i]['observaciones_evidencias']) ? $datos2[$i]['observaciones_evidencias'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$i]alarmas")->textInput([ 'value' => isset($datos2[$i]['alarmas']) ? $datos2[$i]['alarmas'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$i]logros")->textInput([ 'value' => isset($datos2[$i]['logros']) ? $datos2[$i]['logros'] : '' ]) ?>
        </div>
        <div class=cell>
            <?= $form->field($visitas, "[$i]dificultades")->textInput([ 'value' => isset($datos2[$i]['dificultades']) ? $datos2[$i]['dificultades'] : '' ]) ?>
        </div>
        <div class=cell style='display:none'>
                <?= $form->field($visitas, "[$i]id_proyecto")->textInput(["value" => $i+1]) ?>
                <?= $form->field($visitas, "[$i]id_sede")->textInput(["value" => $key]) ?>
        </div>

    <?php
        $i ++;
        }
    }
    if($index == 1){
        $i = 0;
        foreach ($sedes as $key => $value) {
    ?>

        <h3 style='background-color: #ccc;padding:5px;'>Docentes <?=$value?></h3>
        <div class=row style='text-align:center;'>
            <?php
                if($idTipoInforme == 7){
                    ?>
       
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Docentes</span>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Familia</span>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Directivos</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Total</span>
                        </div>
                    <?php
                }
                if($idTipoInforme == 31){
                ?>

                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Docentes</span>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Psicoorientador</span>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Familia</span>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Directivos</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Total</span>
                        </div>
                    <?php
                }if($idTipoInforme == 19){
                    ?>
                    <div class="col-sm-2" style='padding:0px;'>
                        <span total class='form-control' style='background-color:#ccc;height:70px;'>Tiempo Libre</span>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <span total class='form-control' style='background-color:#ccc;height:70px'>Edu derechos</span>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <span total class='form-control' style='background-color:#ccc;height:70px'>Sexualidad</span>
                    </div>
                    <div class="col-sm-2" style='padding:0px;'>
                        <span total class='form-control' style='background-color:#ccc;height:70px'>Medio Ambiente</span>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <span total class='form-control' style='background-color:#ccc;height:70px'>Familia</span>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <span total class='form-control' style='background-color:#ccc;height:70px'>Directivos</span>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <span total class='form-control' style='background-color:#ccc;height:70px'>Total</span>
                    </div>
                <?php
                    } 
                ?>
        </div>
        <div class=row>
                <?php
                    if($idTipoInforme == 7){
                    ?>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tipo_poblacion, "[$i]docentes", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['docentes']) ? $datos[$i]['docentes'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tipo_poblacion, "[$i]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['familia']) ? $datos[$i]['familia'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tipo_poblacion, "[$i]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['directivos']) ? $datos[$i]['directivos'] : ''] ) ?>
                        </div>
                    <?php
                    }
                    if($idTipoInforme == 31){
                    ?>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tipo_poblacion, "[$i]docentes", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['docentes']) ? $datos[$i]['docentes'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tipo_poblacion, "[$i]psicoorientador", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['psicoorientador']) ? $datos[$i]['psicoorientador'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tipo_poblacion, "[$i]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['familia']) ? $datos[$i]['familia'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tipo_poblacion, "[$i]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['directivos']) ? $datos[$i]['directivos'] : ''] ) ?>
                        </div>
                        <?php
                    }if($idTipoInforme == 19){
                        ?>
                    <div class="col-sm-2" style='padding:0px;'>
                        <?=  Html::activeTextInput($tipo_poblacion, "[$i]tiempo_libre", [ 'type' => 'number', 'class' => "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['tiempo_libre']) ? $datos[$i]['tiempo_libre'] : ''] ) ?>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tipo_poblacion, "[$i]edu_derechos", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['edu_derechos']) ? $datos[$i]['edu_derechos'] : ''] ) ?>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tipo_poblacion, "[$i]sexualidad_ciudadania", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['sexualidad_ciudadania']) ? $datos[$i]['sexualidad_ciudadania'] : ''] ) ?>
                    </div>
                    <div class="col-sm-2" style='padding:0px;'>
                        <?=  Html::activeTextInput($tipo_poblacion, "[$i]medio_ambiente", [ 'type' => 'number', 'class' => "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['medio_ambiente']) ? $datos[$i]['medio_ambiente'] : ''] ) ?>
                    </div>
                    
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tipo_poblacion, "[$i]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['familia']) ? $datos[$i]['familia'] : ''] ) ?>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tipo_poblacion, "[$i]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$i-cantidad", 'value' => isset($datos[$i]['directivos']) ? $datos[$i]['directivos'] : ''] ) ?>
                    </div>
                                       
                    <?php
                    } 
                    ?>


                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tipo_poblacion, "[$i]total", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$i]['total_poblacion']) ? $datos[$i]['total_poblacion'] : ''] ) ?>
                    </div>
        </div>

        <?= $form->field($tipo_poblacion, "[$i]id_tip")->hiddenInput( [ 'value' => isset($datos[$i]['id_tip']) ? $datos[$i]['id_tip'] : ''  ] )->label(false ) ?>
        <?= $form->field($tipo_poblacion, "[$i]id_sede")->hiddenInput( [ 'value' => $key] )->label(false ) ?>
        
        <h3 style='background-color: #ccc;padding:5px;'>Estudiantes <?=$value?></h3>
        <div class=row style='text-align:center;'>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px;'>Gra.0</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.1</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.2</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.3</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.4</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.5</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.6</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.7</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.8</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.9</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.10</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Gra.11</span>
            </div>
        </div>
        <div class=row>
            <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$i]grado_0", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_0']) ? $datos[$i]['grado_0'] : '' ] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_1", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_1']) ? $datos[$i]['grado_1'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_2", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_2']) ? $datos[$i]['grado_2'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_3", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_3']) ? $datos[$i]['grado_3'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_4", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_4']) ? $datos[$i]['grado_4'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_5", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_5']) ? $datos[$i]['grado_5'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_6", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_6']) ? $datos[$i]['grado_6'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_7", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_7']) ? $datos[$i]['grado_7'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_8", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_8']) ? $datos[$i]['grado_8'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_9", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_9']) ? $datos[$i]['grado_9'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_10", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_10']) ? $datos[$i]['grado_10'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiasntes, "[$i]grado_11", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$i]['grado_11']) ? $datos[$i]['grado_11'] : ''] ) ?>
            </div>
            <?= $form->field($estudiasntes, "[$i]total")->textInput([ 'value' => isset($datos[$i]['total_estudiantes']) ? $datos[$i]['total_estudiantes'] : '' ]) ?>
            <?= $form->field($estudiasntes, "[$i]est_id")->hiddenInput( [ 'value' => isset($datos[$i]['est_id']) ? $datos[$i]['est_id'] : ''  ] )->label(false ) ?>
        
            <div class=cell style='display:none'>
                <?= $form->field($estudiasntes, "[$i]id_proyecto")->textInput(["value" => $i+1]) ?>
                <?= $form->field($estudiasntes, "[$i]id_sede")->textInput(["value" => $key]) ?>
            </div> 
        </div>
    <?php
        $i++;
        }
    }                                   
?>  
   



	

