<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */




$index =1;
$numProyecto =2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Evidencias;
use app\models\EstudiantesIeo;

$evidencias = new Evidencias();
$estudiantesGrado = new EstudiantesIeo();

use dosamigos\datepicker\DatePicker;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
    $contador = $index +  $numProyecto;
   
echo $proyecto;
?>


			<h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
				<?php 
                if($proyecto == "Proyectos Pedagógicos Transversales"  or $proyecto ==  "Articulación Familiar")
				{
                ?>
				
				
				
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
				
                    
                <?php 
				}
                else
				{
                ?>
				
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
                
				<?php 
				}
                ?>
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
            
           
 