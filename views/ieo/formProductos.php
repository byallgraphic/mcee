<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */




$index =1;
$numProyecto =2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\DocumentosReconocimiento;
use app\models\TiposCantidadPoblacion;
use app\models\RequerimientoExtraIeo;
use app\models\Evidencias;
use app\models\Producto;
use app\models\EstudiantesIeo;

$documentosReconocimiento = new DocumentosReconocimiento();
$tiposCantidadPoblacion = new TiposCantidadPoblacion();
$requerimientoExtra = new RequerimientoExtraIeo();
$evidencias = new Evidencias();
$producto = new Producto();
$estudiantesGrado = new EstudiantesIeo();

use dosamigos\datepicker\DatePicker;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
    $contador = $index +  $numProyecto;
    
?>    
        <?= $form->field($requerimientoExtra, "[$numProyecto]socializacion_ruta[]")->label('Socialización')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($requerimientoExtra, "[$numProyecto]soporte_necesidad[]")->label('ANEXO SOPORTE DE NECESIDAD DE HACER SOCIALIZACIÓN SI APLICA')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($requerimientoExtra, "[$numProyecto]proyecto_ieo_id")->hiddenInput(['value'=> $numProyecto])->label(false); ?>
        <?= $form->field($requerimientoExtra, "[$numProyecto]actividad_id")->hiddenInput(['value'=> $numProyecto])->label(false); ?>
    
        <div class="" style=''>
            <div class="col-sm-6" style='padding:0px;'>
                <?= $form->field($documentosReconocimiento, "[$numProyecto]informe_caracterizacion[]")->label('Informe Caracterización')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                <?= $form->field($documentosReconocimiento, "[$numProyecto]matriz_caracterizacion[]")->label('Matriz de Trazabilidad ')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                <?= $form->field($documentosReconocimiento, "[$numProyecto]revision_pei[]")->label('Revisión Pei')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            </div>
            <div class="col-sm-6" style='padding:0px;'>
            <?= $form->field($documentosReconocimiento, "[$numProyecto]revision_autoevaluacion[]")->label('Revisión Autoevaluación')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($documentosReconocimiento, "[$numProyecto]revision_pmi[]")->label('Revisión Pmi')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($documentosReconocimiento, "[$numProyecto]resultados_caracterizacion[]")->label('Resultados Caracterización')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            </div>
        </div>     

        
        <?= $form->field($documentosReconocimiento, "[$numProyecto]horario_trabajo")->label('Horario Trabajo')->textArea() ?>
        <?= $form->field($documentosReconocimiento, "[$numProyecto]proyecto_ieo_id")->hiddenInput(['value'=> $numProyecto])->label(false); ?>
        <?= $form->field($documentosReconocimiento, "[$numProyecto]actividad_id")->hiddenInput(['value'=> $numProyecto])->label(false); ?>
   
        <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]fecha_creacion")->widget(
            DatePicker::className(), [
                // modify template for custom rendering
                'template' => '{addon}{input}',
                'language' => 'es',
                'clientOptions' => [
                    'autoclose' => true,
                    'format'    => 'yyyy-mm-dd',
            ],
        ]);  ?> 
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]tipo_actividad")->textInput([ 'value' => isset($datos[$index."".$numProyecto]['tipo_actividad']) ? $datos[$index."".$numProyecto]['tipo_actividad'] : '' ]) ?>
            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                
            <div class="row" style='text-align:center;'>
                
                
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
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]docentes", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['docentes']) ? $datos[$index."".$numProyecto]['docentes'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['familia']) ? $datos[$index."".$numProyecto]['familia'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['directivos']) ? $datos[$index."".$numProyecto]['directivos'] : ''] ) ?>
                        </div>
                   

                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]docentes", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['docentes']) ? $datos[$index."".$numProyecto]['docentes'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]psicoorientador", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['psicoorientador']) ? $datos[$index."".$numProyecto]['psicoorientador'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['familia']) ? $datos[$index."".$numProyecto]['familia'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['directivos']) ? $datos[$index."".$numProyecto]['directivos'] : ''] ) ?>
                        </div>
                    
                   
                    <div class="col-sm-2" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]tiempo_libre", [ 'type' => 'number', 'class' => "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['tiempo_libre']) ? $datos[$index."".$numProyecto]['tiempo_libre'] : ''] ) ?>
                    </div>
                    <div class="col-sm-2" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]edu_derechos", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['edu_derechos']) ? $datos[$index."".$numProyecto]['edu_derechos'] : ''] ) ?>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]sexualidad", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['sexualidad']) ? $datos[$index."".$numProyecto]['sexualidad'] : ''] ) ?>
                    </div>
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]ciudadania", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['ciudadania']) ? $datos[$index."".$numProyecto]['ciudadania'] : ''] ) ?>
                    </div>
                    <div class="col-sm-2" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]medio_ambiente", [ 'type' => 'number', 'class' => "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['medio_ambiente']) ? $datos[$index."".$numProyecto]['medio_ambiente'] : ''] ) ?>
                    </div>
                    
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['familia']) ? $datos[$index."".$numProyecto]['familia'] : ''] ) ?>
                    </div>
                    <div class="col-sm-2" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$index$numProyecto-cantidad", 'value' => isset($datos[$index."".$numProyecto]['directivos']) ? $datos[$index."".$numProyecto]['directivos'] : ''] ) ?>
                    </div>
                    
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$index$numProyecto]total", [ 'readOnly' => true, 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['total']) ? $datos[$index."".$numProyecto]['total'] : ''] ) ?>
                    </div>
                </div>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]actividad_id")->hiddenInput(['value'=> $index])->label(false); ?>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]proyecto_ieo_id")->hiddenInput(['value'=> $numProyecto])->label(false); ?>
        
        <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
           
                     <div class=row style='text-align:center;'>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px;'>Est.Gra.9</span>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.10</span>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.11</span>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Total</span>
                        </div>
                    </div>
                    <div class=row>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_9", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_9']) ? $datos[$index."".$numProyecto]['grado_9'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_10", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_10']) ? $datos[$index."".$numProyecto]['grado_10'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_11", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_11']) ? $datos[$index."".$numProyecto]['grado_11'] : ''] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]total", [ 'readOnly' => true, 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['total']) ? $datos[$index."".$numProyecto]['total'] : ''] ) ?>
                        </div>
                    </div>
                
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
                        <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_0", [ 'type' => 'number', 'class' => 'form-control est', 'value' => isset($datos[$index."".$numProyecto]['grado_0']) ? $datos[$index."".$numProyecto]['grado_0'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_1", [ 'type' => 'number', 'class' => 'form-control est', 'value' => isset($datos[$index."".$numProyecto]['grado_1']) ? $datos[$index."".$numProyecto]['grado_1'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_2", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_2']) ? $datos[$index."".$numProyecto]['grado_2'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_3", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_3']) ? $datos[$index."".$numProyecto]['grado_3'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_4", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_4']) ? $datos[$index."".$numProyecto]['grado_4'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_5", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_5']) ? $datos[$index."".$numProyecto]['grado_5'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_6", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_6']) ? $datos[$index."".$numProyecto]['grado_6'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_7", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_7']) ? $datos[$index."".$numProyecto]['grado_7'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_8", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_8']) ? $datos[$index."".$numProyecto]['grado_8'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_9", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_9']) ? $datos[$index."".$numProyecto]['grado_9'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_10", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_10']) ? $datos[$index."".$numProyecto]['grado_10'] : ''] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_11", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index."".$numProyecto]['grado_11']) ? $datos[$index."".$numProyecto]['grado_11'] : ''] ) ?>
                        </div>
                        <?= $form->field($estudiantesGrado, "[$index$numProyecto]total")->textInput(['readOnly' => true, 'value' => isset($datos[$index."".$numProyecto]['total']) ? $datos[$index."".$numProyecto]['total'] : '' ]) ?>
                    </div>
                
        <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
            
            <div class=row style=''>
                <div class="col-sm-6" style='padding:0px;'>
                    <?= $form->field($evidencias, "[$numProyecto]producto_ruta[]")->label('Producto: mapa puntos de partida y llegada')->fileInput(['multiple' => true,  'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    <?= $form->field($evidencias, "[$numProyecto]resultados_actividad_ruta[]")->label('Resultados de la actividad')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    <?= $form->field($evidencias, "[$numProyecto]acta_ruta[]")->label('ACTA')->fileInput(['multiple' => true,  'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                </div>
                <div class="col-sm-6" style='padding:0px;'>
                    <?= $form->field($evidencias, "[$numProyecto]listado_ruta[]")->label('LISTADO')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    <?= $form->field($evidencias, "[$numProyecto]fotografias_ruta[]")->label('FOTOGRAFÍAS')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    <?= $form->field($evidencias, "[$numProyecto]actividad_id")->hiddenInput(['value'=> $index])->label(false); ?>
                    <?= $form->field($evidencias, "[$numProyecto]proyecto_id")->hiddenInput(['value'=> $numProyecto])->label(false); ?>
                </div>
            </div>
            
           
        <?= $form->field($producto, "[$numProyecto]imforme_ruta[]")->label('Informe de rutas de cualificación ')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($producto, "[$numProyecto]plan_accion_ruta[]")->label('Plan de acción')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($producto, "[$numProyecto]id_actividad")->hiddenInput(['value'=> $index])->label(false); ?>
        <?= $form->field($producto, "[$numProyecto]id_proyecto")->hiddenInput(['value'=> $numProyecto])->label(false); ?>



