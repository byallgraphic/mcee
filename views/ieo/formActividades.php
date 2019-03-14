<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Evidencias;
use app\models\EstudiantesIeo;
use app\models\TiposCantidadPoblacion;
use dosamigos\datepicker\DatePicker;

$evidencias = new Evidencias();
$estudiantesGrado = new EstudiantesIeo();
$tiposCantidadPoblacion = new TiposCantidadPoblacion();

$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);


$idTipoInforme = (isset($_GET['idTipoInforme'])) ?  $_GET['idTipoInforme'] :  $model->id_tipo_informe;

?>



		<?php 
		
		$tiposCantidadPoblacion->fecha_creacion = $datos['cantidadPoblacion'][$idactividad]['fecha_creacion'] ;
		echo $form->field($tiposCantidadPoblacion, "[$idactividad]fecha_creacion")->widget(
            DatePicker::className(), [
                // modify template for custom rendering
                'template' => '{addon}{input}',
                'language' => 'es',
                'clientOptions' => [
                    'autoclose' => true,
                    'format'    => 'yyyy-mm-dd',
            ],
        ]);  ?> 
         <?= $form->field($tiposCantidadPoblacion, "[$idactividad]tipo_actividad")->textInput([ 'value' =>$datos['cantidadPoblacion'][$idactividad]['tipo_actividad']  ]) ?>


  <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                
            <div class="row" style='text-align:center;'>
                
                <?php
                    if($idTipoInforme == 14)
					{
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
                    if($idTipoInforme == 26)
					{
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
                    }
						if($idTipoInforme == 2)
					{
                        ?>
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
                    <?php
                    } 
                    ?>
            </div>
            <div class=row>

                <?php
                    if($idTipoInforme == 14)
					{
                    ?>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]docentes", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' =>$datos['cantidadPoblacion'][$idactividad]['docentes']  ] ) ?>
                        </div>																																																																					
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['familia'] ]) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' =>$datos['cantidadPoblacion'][$idactividad]['directivos'] ] ) ?>
                        </div>
                    <?php
                    }
                    if($idTipoInforme == 26)
					{
                        ?>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]docentes", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' =>$datos['cantidadPoblacion'][$idactividad]['docentes'] ] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]psicoorientador", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' =>$datos['cantidadPoblacion'][$idactividad]['psicoorientador'] ] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['familia']] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['directivos']] ) ?>
                        </div>
                    
                    <?php
                    }if($idTipoInforme == 2)
					{
                        ?>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]tiempo_libre", [ 'type' => 'number', 'class' => "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['tiempo_libre']] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]edu_derechos", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['edu_derechos'] ] ) ?>
						</div>
						<div class="col-sm-1" style='padding:0px;'>
							<?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]sexualidad", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['sexualidad']] ) ?>
						</div>
						<div class="col-sm-1" style='padding:0px;'>
							<?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]ciudadania", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['ciudadania']] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]medio_ambiente", [ 'type' => 'number', 'class' => "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['medio_ambiente']] ) ?>
						</div>
						
						<div class="col-sm-1" style='padding:0px;'>
							<?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['familia']] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$idactividad-cantidad", 'value' => $datos['cantidadPoblacion'][$idactividad]['directivos']] ) ?>
						</div>
                    <?php
                    } 
                    ?>
                    <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($tiposCantidadPoblacion, "[$idactividad]total", [ 'readOnly' => true, 'class' => 'form-control' ] ) ?>
                    </div>
            </div>




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
                        <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_0", [ 'type' => 'number', 'class' => 'form-control est', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_0'] ] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_1", [ 'type' => 'number', 'class' => 'form-control est', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_1']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_2", [ 'type' => 'number', 'class' => 'form-control', 'value' =>$datos['estudiantesIeo'][$idactividad]['grado_2']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_3", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_3']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_4", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_4']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_5", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_5']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_6", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_6'] ] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_7", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_7']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_8", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_8']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_9", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_9']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_10", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_10']] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_11", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_11']] ) ?>
                        </div>
                        <?= $form->field($estudiantesGrado, "[$idactividad]total")->textInput(['readOnly' => true]) ?>
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
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_9", [ 'type' => 'number', 'class' => 'form-control', 'value' => $datos['estudiantesIeo'][$idactividad]['grado_9']] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_10", [ 'type' => 'number', 'class' => 'form-control', 'value' =>  $datos['estudiantesIeo'][$idactividad]['grado_10']] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]grado_11", [ 'type' => 'number', 'class' => 'form-control', 'value' =>  $datos['estudiantesIeo'][$idactividad]['grado_11']] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$idactividad]total", [ 'readOnly' => true, 'class' => 'form-control'] ) ?>
                        </div>
                    </div>
				<?php 
				}
                ?>
        <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
            
            <div class=row style=''>
                <div class="col-sm-6" style='padding:0px;'>
                    <?= $form->field($evidencias, "[$idactividad]producto_ruta[]")->label('Producto: mapa puntos de partida y llegada')->fileInput(['multiple' => true,  'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    <?= $form->field($evidencias, "[$idactividad]resultados_actividad_ruta[]")->label('Resultados de la actividad')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    <?= $form->field($evidencias, "[$idactividad]acta_ruta[]")->label('ACTA')->fileInput(['multiple' => true,  'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                </div>
                <div class="col-sm-6" style='padding:0px;'>
                    <?= $form->field($evidencias, "[$idactividad]listado_ruta[]")->label('LISTADO')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    <?= $form->field($evidencias, "[$idactividad]fotografias_ruta[]")->label('FOTOGRAFÍAS')->fileInput([ 'multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                    <?= $form->field($evidencias, "[$idactividad]actividad_id")->hiddenInput(['value'=> $idactividad])->label(false); ?>
                </div>
            </div>
            
           
 