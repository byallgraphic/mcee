<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
    $contador = $index +  $numProyecto;
    
    if ($index == 1){
    ?>
        <?= $form->field($model, "[$index$numProyecto]file_socializacion_ruta")->label('Socialización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_soporte_necesidad")->label('ANEXO SOPORTE DE NECESIDAD DE HACER SOCIALIZACIÓN SI APLICA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>

    <?php
    }
    if($index == 2){
    ?>
        <?= $form->field($model, "[$index$numProyecto]file_informe_caracterizacion")->label('Informe Caracterización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_matriz_caracterizacion")->label('Matriz de Trazabilidad ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_revision_pei")->label('Revisión Pei')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_revision_autoevaluacion")->label('Revisión Autoevaluación')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_revision_pmi")->label('Revisión Pmi')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_resultados_caracterizacion")->label('Resultados Caracterización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_horario_trabajo")->label('Horario Trabajo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?php
    }
    if($index == 3 || $index == 4 || $index == 5){?>
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
        <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]tipo_actividad")->textInput() ?>
        <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]tiempo_libre")->textInput() ?>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]edu_derechos")->textInput() ?>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]sexualidad")->textInput() ?>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]ciudadania")->textInput() ?>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]medio_ambiente")->textInput() ?>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]familia")->textInput() ?>
            <?= $form->field($tiposCantidadPoblacion, "[$index$numProyecto]directivos")->textInput() ?>
        <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
            <?php 
                if($numProyecto == 2){
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
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_9", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_10", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_11", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-2" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]total", [ 'class' => 'form-control'] ) ?>
                        </div>
                    </div>
                <?php
                }else{
            ?>
                    <div class=row style='text-align:center;'>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px;'>Est.Gra.0</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.1</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.2</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.3</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.4</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.5</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.6</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.7</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.8</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.9</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.10</span>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.11</span>
                        </div>
                    </div>
                    <div class=row>
                        <div class="col-sm-1" style='padding:0px;'>
                        <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_0", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_1", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_2", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_3", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_4", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_5", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_6", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_7", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_8", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_9", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_10", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <div class="col-sm-1" style='padding:0px;'>
                            <?=  Html::activeTextInput($estudiantesGrado, "[$index$numProyecto]grado_11", [ 'class' => 'form-control'] ) ?>
                        </div>
                        <?= $form->field($estudiantesGrado, "[$index$numProyecto]total")->textInput() ?>
                    </div>
                <?php 
                } 
                ?>
        <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
            <?= $form->field($model, "[$index$numProyecto]file_producto_ruta")->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            <?= $form->field($model, "[$index$numProyecto]file_resultados_actividad_ruta")->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            <?= $form->field($model, "[$index$numProyecto]file_acta_ruta")->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            <?= $form->field($model, "[$index$numProyecto]file_listado_ruta")->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            <?= $form->field($model, "[$index$numProyecto]file_fotografias_ruta")->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?php
    }if($index == 6){ ?>
    
        <?= $form->field($model, "[$index$numProyecto]file_producto_imforme_ruta")->label('Informe de rutas de cualificación ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_producto_plan_accion")->label('Plan de acción')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?= $form->field($model, "[$index$numProyecto]file_producto_presentacion")->label('Presentación del plan de acción para la I.E.O ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>

    <?php
    }
    
?>

