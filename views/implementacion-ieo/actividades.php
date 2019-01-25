<?php

   use yii\widgets\ActiveForm;
   use yii\helpers\Html;
   use dosamigos\datepicker\DatePicker;

   if($numActividad != 17){
?>

        <h2 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h2>

        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]fecha_creacion")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'value' => isset($datos[$numActividad]['fecha_creacion']) ? $datos[$numActividad]['fecha_creacion'] : '',
            'clientOptions' => [
                'autoclose' => true,
                'format' 	=> 'yyyy-mm-dd',
            ],
        ]);  ?>

        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]id_actividad")->hiddenInput(['value'=> $numActividad])->label(false); ?>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]tipo_actividad")->hiddenInput(['value'=> 1])->label(false); ?>
        <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
        
        <div class=row style='text-align:center;'>
            <div class="col-sm-2" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px;'>Tiempo Libre</span>
            </div>
            <div class="col-sm-2" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Edu derechos</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Sexualidad</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Ciudadanía</span>
            </div>
            <div class="col-sm-2" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Medio Ambiente</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Familia</span>
            </div>
            <div class="col-sm-2" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Directivos</span>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <span total class='form-control' style='background-color:#ccc;height:70px'>Total</span>
            </div>
        </div>
        <div class=row>
            <div class="col-sm-2" style='padding:0px;'>
                <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$numActividad]tiempo_libre", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$numActividad]['tiempo_libre']) ? $datos[$numActividad]['tiempo_libre'] : ''] ) ?>
            </div>
            <div class="col-sm-2" style='padding:0px;'>
                <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$numActividad]edu_derechos", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$numActividad]['edu_derechos']) ? $datos[$numActividad]['edu_derechos'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$numActividad]sexualidad", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$numActividad]['sexualidad']) ? $datos[$numActividad]['sexualidad'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$numActividad]ciudadania", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$numActividad]['ciudadania']) ? $datos[$numActividad]['ciudadania'] : ''] ) ?>
            </div>
            <div class="col-sm-2" style='padding:0px;'>
                <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$numActividad]medio_ambiente", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$numActividad]['medio_ambiente']) ? $datos[$numActividad]['medio_ambiente'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$numActividad]familia", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$numActividad]['familia']) ? $datos[$numActividad]['familia'] : ''] ) ?>
            </div>
            <div class="col-sm-2" style='padding:0px;'>
                <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$numActividad]directivos", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$numActividad]['directivos']) ? $datos[$numActividad]['directivos'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$numActividad]total", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$numActividad]['total']) ? $datos[$numActividad]['total'] : ''] ) ?>
            </div>
        </div>
        
        <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
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
            <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_0", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_0']) ? $datos[$numActividad]['grado_0'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_1", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_1']) ? $datos[$numActividad]['grado_1'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_2", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_2']) ? $datos[$numActividad]['grado_2'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_3", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_3']) ? $datos[$numActividad]['grado_3'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_4", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_4']) ? $datos[$numActividad]['grado_4'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_5", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_5']) ? $datos[$numActividad]['grado_5'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_6", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_6']) ? $datos[$numActividad]['grado_6'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_7", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_7']) ? $datos[$numActividad]['grado_7'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_8", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_8']) ? $datos[$numActividad]['grado_8'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_9", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_9']) ? $datos[$numActividad]['grado_9'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_10", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_10']) ? $datos[$numActividad]['grado_10'] : ''] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_11", [ 'type' => 'number','class' => 'form-control', 'value' => isset($datos[$numActividad]['grado_11']) ? $datos[$numActividad]['grado_11'] : ''] ) ?>
            </div>
            <?= $form->field($estudiantesGrado, "[$numActividad]total")->textInput([ 'value' => isset($datos[$numActividad]['total']) ? $datos[$numActividad]['total'] : '' ]) ?>
        </div>
        <h3 style='background-color: #ccc;padding:5px;'>Evidencias </h3>    
        <?php
            if($numActividad != 3 && $numActividad != 5 && $numActividad != 9 && $numActividad != 11){ ?>
                <div class=row style=''>
                    <div class="col-sm-6" style='padding:0px;'>
                        <?= $form->field($evidencias, "[$numActividad]producto_acuerdo")->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
               
            <?php
            }else{ ?>
                <div class=row style=''>
                    <div class="col-sm-6" style='padding:0px;'>
                        <?= $form->field($evidencias, "[$numActividad]producto_acuerdo")->label('Producto: avance a la trazabilidad del plan de acción')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                        <?= $form->field($evidencias, "[$numActividad]avance_formula")->label('Avance de la formulación y sistematización de la iniciativa')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                        <?= $form->field($evidencias, "[$numActividad]avance_ruta_gestion")->label('Avance a la ruta de gestión')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>

                <?php
            }?>
            
                        <?= $form->field($evidencias, "[$numActividad]resultado_actividad")->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                        <?= $form->field($evidencias, "[$numActividad]acta")->label("ACTA")->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    </div>
                    <div class="col-sm-6" style='padding:0px;'>
                        <?= $form->field($evidencias, "[$numActividad]listado")->label("LISTADO")->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                        <?= $form->field($evidencias, "[$numActividad]fotografias")->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    </div>
                </div>

    <?php
        }
        
        if($numActividad == 16){ ?>
            <div style="display: none;">
                <?= $form->field($producto, "[$numActividad]informe_acompanamiento")->label('Informe de acompañamiento')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                <?= $form->field($producto, "[$numActividad]trazabilidad_plan_accion")->label('Trazabilidad al plan de acción')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                <?= $form->field($producto, "[$numActividad]formulacion")->label('Formulación y sistematización de la iniciativa')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                <?= $form->field($producto, "[$numActividad]ruta_gestion")->label('Ruta de gestión')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                <?= $form->field($producto, "[$numActividad]resultados_procesos")->label('Presentación de los resultados del proceso')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            </div>
        <?php
        }if($numActividad == 17){ ?>
            <div style="">
                <div class=row style=''>
                        <div class="col-sm-6" style='padding:0px;'>
                            <?= $form->field($producto, "[$numActividad]informe_acompanamiento")->label('Informe de acompañamiento')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                            <?= $form->field($producto, "[$numActividad]trazabilidad_plan_accion")->label('Trazabilidad al plan de acción')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                            <?= $form->field($producto, "[$numActividad]formulacion")->label('Formulación y sistematización de la iniciativa')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                        </div>
                        <div class="col-sm-6" style='padding:0px;'>
                            <?= $form->field($producto, "[$numActividad]ruta_gestion")->label('Ruta de gestión')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                            <?= $form->field($producto, "[$numActividad]resultados_procesos")->label('Presentación de los resultados del proceso')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                        </div>
                </div>        
            </div>
        <?php
        }
        
    ?>