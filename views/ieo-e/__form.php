<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ieo-form">

    <?php $form = ActiveForm::begin(); ?>

       
        <?= $form->field($model, 'comuna')->textInput([ 'value' => 'No asignado' , 'readonly' => true]) ?>
        <?= $form->field($model, 'barrio')->textInput([ 'value' => 'No asignado' , 'readonly' => true]) ?>  
        
        <!--- Inicio contenedor padre Proyectos Pedagógicos Transversales-->
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse1">Proyectos Pedagógicos Transversales</a>
                </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    <?= $form->field($model, 'persona_acargo')->textInput() ?>        
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1-1">Requerimientos extras I.E.O</a>
                            </h4>
                            </div>
                            <div id="collapse1-1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_socializacion_ruta')->label('Socialización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_soporte_necesidad')->label('ANEXO SOPORTE DE NECESIDAD DE HACER SOCIALIZACIÓN SI APLICA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1-2">Reconocimiento previo y documentos a desarrollar por el profesional de apoyo</a>
                            </h4>
                            </div>
                            <div id="collapse1-2" class="panel-collapse collapse">
                            <div class="panel-body">

                                <div class=cell>
                                    <?= $form->field($model, '[0]file_informe_caracterizacion')->label('Informe Caracterización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_matriz_caracterizacion')->label('Matriz de Trazabilidad ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_revision_pei')->label('Revisión Pei')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_revision_autoevaluacion')->label('Revisión Autoevaluación')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_revision_pmi')->label('Revisión Pmi')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_resultados_caracterizacion')->label('Resultados Caracterización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_horario_trabajo')->label('Horario Trabajo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>          

                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--- Inicio actividad 1-->
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1-3">Actividad 1.Mesa de trabajo para la presentación de resultados de la caracterización y mapeo (puntos de partida y llegada)</a>
                            </h4>
                            </div>
                            <div id="collapse1-3" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[0]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[0]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Tipo y cantidad de población</div>
                                        <div class="panel-body">
                                            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                            <?= $form->field($tiposCantidadPoblacion, '[0]tiempo_libre')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[0]edu_derechos')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[0]sexualidad')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[0]ciudadania')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[0]medio_ambiente')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[0]familia')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[0]directivos')->textInput() ?>
                                            

                                            <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
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
                                                <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_0', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_1', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_2', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_3', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_4', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_5', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_6', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_7', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_8', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_9', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_10', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[0]grado_11', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <?= $form->field($estudiantesGrado, '[0]total')->textInput() ?>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                
                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[0]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 
                                    
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--- Fina actividad 1-->
                    

                    <!--- Inicio actividad 2-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1-4">Actividad 2. Acompañamiento en práctica</a>
                            </h4>
                            </div>
                            <div id="collapse1-4" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[1]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[1]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Tipo y cantidad de población</div>
                                        <div class="panel-body">
                                            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                            <?= $form->field($tiposCantidadPoblacion, '[1]tiempo_libre')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[1]edu_derechos')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[1]sexualidad')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[1]ciudadania')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[1]medio_ambiente')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[1]familia')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[1]directivos')->textInput() ?>
                                            
                                            <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
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
                                                <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_0', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_1', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_2', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_3', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_4', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_5', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_6', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_7', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_8', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_9', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_10', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[1]grado_11', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <?= $form->field($estudiantesGrado, '[0]total')->textInput() ?>
                                            </div>
                                        <div>
                                    </div>
                                </div>
                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[1]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[1]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[1]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[1]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[1]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                
                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[1]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 
                                    
                            </div>
                        </div>
                    </div>
                    <!--- Fin actividad 2-->

                    <!--- Inicio actividad 3-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1-5">Actividad 3. Mesa de trabajo: contrucción del plan de acción</a>
                            </h4>
                            </div>
                            <div id="collapse1-5" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[2]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[2]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel-body">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Tipo y cantidad de población</div>
                                            <div class="panel-body">
                                                <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                                <?= $form->field($tiposCantidadPoblacion, '[2]tiempo_libre')->textInput() ?>
                                                <?= $form->field($tiposCantidadPoblacion, '[2]edu_derechos')->textInput() ?>
                                                <?= $form->field($tiposCantidadPoblacion, '[2]sexualidad')->textInput() ?>
                                                <?= $form->field($tiposCantidadPoblacion, '[2]ciudadania')->textInput() ?>
                                                <?= $form->field($tiposCantidadPoblacion, '[2]medio_ambiente')->textInput() ?>
                                                <?= $form->field($tiposCantidadPoblacion, '[2]familia')->textInput() ?>
                                                <?= $form->field($tiposCantidadPoblacion, '[2]directivos')->textInput() ?>
                                               
                                                <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
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
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_0', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_1', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_2', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_3', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_4', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_5', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_6', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_7', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_8', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_9', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_10', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <div class="col-sm-1" style='padding:0px;'>
                                                        <?=  Html::activeTextInput($estudiantesGrado, '[2]grado_11', [ 'class' => 'form-control'] ) ?>
                                                    </div>
                                                    <?= $form->field($estudiantesGrado, '[0]total')->textInput() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[2]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[2]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[2]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[2]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[2]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                
                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[2]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 
                                    
                            </div>
                        </div>
                    </div>
                    <!--- Fin actividad 3-->

                    <!--- Inicio Producto-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1-6">Productos</a>
                            </h4>
                            </div>
                            <div id="collapse1-6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_producto_imforme_ruta')->label('Informe Ruta Cualificación')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[0]file_plan_accion')->label('Presentación Plan Acción Ieo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_plan_accion')->label('Presentación del plan de acción para la I.E.O ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--- Fin Producto-->                    

                    </div>
                </div>
                </div>
            </div>
        </div>
        <!--- Fin contenedor padre Proyectos Pedagógicos Transversales-->
        
        <!--- Inicio contenedor padre Proyectos de Servicio Social Estudiantil-->
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse2">Proyectos de Servicio Social Estudiantil</a>
                </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                    <?= $form->field($model, '[3]persona_acargo')->textInput() ?>        
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2-1">Requerimientos extras I.E.O</a>
                            </h4>
                            </div>
                            <div id="collapse2-1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_socializacion_ruta')->label('Socialización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_soporte_necesidad')->label('ANEXO SOPORTE DE NECESIDAD DE HACER SOCIALIZACIÓN SI APLICA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                            </div>
                            </div>
                        </div>
                    </div>

                     <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2-2">Reconocimiento previo y documentos a desarrollar por el profesional de apoyo</a>
                            </h4>
                            </div>
                            <div id="collapse2-2" class="panel-collapse collapse">
                            <div class="panel-body">

                                <div class=cell>
                                    <?= $form->field($model, '[3]file_informe_caracterizacion')->label('Informe Caracterización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_matriz_caracterizacion')->label('Matriz de Trazabilidad ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_revision_pei')->label('Revisión Pei')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_revision_autoevaluacion')->label('Revisión Autoevaluación')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_revision_pmi')->label('Revisión Pmi')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_resultados_caracterizacion')->label('Resultados Caracterización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_horario_trabajo')->label('Horario Trabajo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>          

                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Inicio Actividad 1-->
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2-3">Actividad 1.Mesa de trabajo para la presentación de resultados de la caracterización y mapeo (puntos de partida y llegada)</a>
                            </h4>
                            </div>
                            <div id="collapse2-3" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[3]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[3]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Tipo y cantidad de población</div>
                                        <div class="panel-body">
                                            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                            <?= $form->field($tiposCantidadPoblacion, '[3]tiempo_libre')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[3]edu_derechos')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[3]sexualidad')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[3]ciudadania')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[3]medio_ambiente')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[3]familia')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[3]directivos')->textInput() ?>
                                            
                                            <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
                                            <div class=row style='text-align:center;'>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.9</span>
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
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_9', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_10', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_11', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[3]total', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>                    
                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[1]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 


                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin actividad 1 -->
                    
                    <!--- Inicio actividad 2-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2-4">Actividad 2. Acompañamiento en práctica</a>
                            </h4>
                            </div>
                            <div id="collapse2-4" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[4]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[4]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Tipo y cantidad de población</div>
                                        <div class="panel-body">
                                            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                            <?= $form->field($tiposCantidadPoblacion, '[4]tiempo_libre')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[4]edu_derechos')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[4]sexualidad')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[4]ciudadania')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[4]medio_ambiente')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[4]familia')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[4]directivos')->textInput() ?>
                                            
                                            <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
                                            <div class=row style='text-align:center;'>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.9</span>
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
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_9', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_10', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_11', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[4]total', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                    
                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[4]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[4]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[4]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[4]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[4]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                
                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[4]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 
                                    
                            </div>
                        </div>
                    </div>
                    <!--- Fin actividad 2-->
                    
                    <!--- Inicio actividad 3-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2-5">Actividad 3. Mesa de trabajo: contrucción del plan de acción</a>
                            </h4>
                            </div>
                            <div id="collapse2-5" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[5]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[5]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Tipo y cantidad de población</div>
                                        <div class="panel-body">
                                            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                            <?= $form->field($tiposCantidadPoblacion, '[5]tiempo_libre')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[5]edu_derechos')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[5]sexualidad')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[5]ciudadania')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[5]medio_ambiente')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[5]familia')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[5]directivos')->textInput() ?>
                                            
                                            <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
                                            <div class=row style='text-align:center;'>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <span total class='form-control' style='background-color:#ccc;height:70px'>Est.Gra.9</span>
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
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_9', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_10', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_11', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-2" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[5]total', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[5]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[5]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[5]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[5]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[5]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                
                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[5]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 
                                    
                            </div>
                        </div>
                    </div>
                    <!--- Fin actividad 3-->

                    <!--- Inicio Producto-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2-6">Productos</a>
                            </h4>
                            </div>
                            <div id="collapse2-6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_producto_imforme_ruta')->label('Informe Ruta Cualificación')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[3]file_plan_accion')->label('Presentación Plan Acción Ieo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_plan_accion')->label('Presentación del plan de acción para la I.E.O ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--- Fin Producto-->                     

                </div>
                </div>
            </div>
        </div>
        </div>
        <!--- Fin contenedor padre  Proyectos de Servicio Social Estudiantil-->
        
        <!--- Inicio contenedor padre Articulación Familiar-->
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse3">Articulación Familiar</a>
                </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">
                    <?= $form->field($model, '[6]persona_acargo')->textInput() ?>       
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse3-1">Requerimientos extras I.E.O</a>
                            </h4>
                            </div>
                            <div id="collapse3-1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_socializacion_ruta')->label('Socialización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_soporte_necesidad')->label('ANEXO SOPORTE DE NECESIDAD DE HACER SOCIALIZACIÓN SI APLICA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                            </div>
                            </div>
                        </div>
                    </div>

                     <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse3-2">Reconocimiento previo y documentos a desarrollar por el profesional de apoyo</a>
                            </h4>
                            </div>
                            <div id="collapse3-2" class="panel-collapse collapse">
                            <div class="panel-body">

                                <div class=cell>
                                    <?= $form->field($model, '[6]file_informe_caracterizacion')->label('Informe Caracterización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_matriz_caracterizacion')->label('Matriz de Trazabilidad ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_revision_pei')->label('Revisión Pei')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_revision_autoevaluacion')->label('Revisión Autoevaluación')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_revision_pmi')->label('Revisión Pmi')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_resultados_caracterizacion')->label('Resultados Caracterización')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_horario_trabajo')->label('Horario Trabajo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>          

                            </div>
                            </div>
                        </div>
                    </div>

                    <!--Inicio acntividad 1 -->
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse3-3">Actividad 1.Mesa de trabajo para la presentación de resultados de la caracterización y mapeo (puntos de partida y llegada)</a>
                            </h4>
                            </div>
                            <div id="collapse3-3" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[6]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[6]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Tipo y cantidad de población</div>
                                        <div class="panel-body">
                                            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                            <?= $form->field($tiposCantidadPoblacion, '[6]tiempo_libre')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[6]edu_derechos')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[6]sexualidad')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[6]ciudadania')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[6]medio_ambiente')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[6]familia')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[6]directivos')->textInput() ?>
                                           
                                            <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>        
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
                                                <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_0', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_1', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_2', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_3', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_4', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_5', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_6', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_7', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_8', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_9', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_10', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[6]grado_11', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <?= $form->field($estudiantesGrado, '[0]total')->textInput() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[6]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--Fin actividad 1-->
                    
                    <!--- Inicio actividad 2-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse3-4">Actividad 2. Acompañamiento en práctica</a>
                            </h4>
                            </div>
                            <div id="collapse3-4" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[7]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[7]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Tipo y cantidad de población</div>
                                        <div class="panel-body">
                                            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                            <?= $form->field($tiposCantidadPoblacion, '[7]tiempo_libre')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[7]edu_derechos')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[7]sexualidad')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[7]ciudadania')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[7]medio_ambiente')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[7]familia')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[7]directivos')->textInput() ?>

                                            <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
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
                                                <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_0', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_1', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_2', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_3', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_4', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_5', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_6', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_7', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_8', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_9', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_10', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[7]grado_11', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <?= $form->field($estudiantesGrado, '[0]total')->textInput() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                    
                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[7]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[7]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[7]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[7]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[7]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                
                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[7]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 
                                    
                            </div>
                        </div>
                    </div>
                    <!--- Fin actividad 2-->
                    
                    <!--- Inicio actividad 3-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse3-5">Actividad 3. Mesa de trabajo: contrucción del plan de acción</a>
                            </h4>
                            </div>
                            <div id="collapse3-5" class="panel-collapse collapse">
                            <?= $form->field($tiposCantidadPoblacion, '[8]fecha_creacion')->widget(
                                DatePicker::className(), [
                                    // modify template for custom rendering
                                    'template' => '{addon}{input}',
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' 	=> 'yyyy-mm-dd',
                                ],
                            ]);  ?>
                            <?= $form->field($tiposCantidadPoblacion, '[8]tipo_actividad')->textInput() ?>
                            <div class="panel-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Tipo y cantidad de población</div>
                                        <div class="panel-body">
                                            <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
                                            <?= $form->field($tiposCantidadPoblacion, '[8]tiempo_libre')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[8]edu_derechos')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[8]sexualidad')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[8]ciudadania')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[8]medio_ambiente')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[8]familia')->textInput() ?>
                                            <?= $form->field($tiposCantidadPoblacion, '[8]directivos')->textInput() ?>
                                            
                                            <h3 style='background-color: #ccc;padding:5px;'>Estudiantes</h3>
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
                                                <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_0', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_1', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_2', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_3', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_4', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_5', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_6', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_7', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_8', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_9', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_10', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <div class="col-sm-1" style='padding:0px;'>
                                                    <?=  Html::activeTextInput($estudiantesGrado, '[8]grado_11', [ 'class' => 'form-control'] ) ?>
                                                </div>
                                                <?= $form->field($estudiantesGrado, '[0]total')->textInput() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                <div class=cell>
                                    <?= $form->field($model, '[8]file_producto_ruta')->label('Producto: mapa puntos de partida y llegada')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[8]file_resultados_actividad_ruta')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[8]file_acta_ruta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[8]file_listado_ruta')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[8]file_fotografias_ruta')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                                                
                                <div class=cell style='display:none'>
                                    <?= $form->field($model, '[8]tipo_actividad')->hiddenInput( [ 'value' => 'asdsadasdsa' ] ) ?>
                                </div> 
                                    
                            </div>
                        </div>
                    </div>
                    <!--- Fin actividad 3-->
                    <!--- Inicio Producto-->
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse3-6">Productos</a>
                            </h4>
                            </div>
                            <div id="collapse3-6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_producto_imforme_ruta')->label('Informe Ruta Cualificación')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_plan_accion')->label('Presentación Plan Acción Ieo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                                <div class=cell>
                                    <?= $form->field($model, '[6]file_plan_accion')->label('Presentación del plan de acción para la I.E.O ')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--- Fin Producto-->  

                </div>
               
                </div>
                </div>
            </div>
        </div>
        <!--- Fin contenedor padre Articulación Familiar-->                            


        <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>  
        </div>
        <!--- Fin contenedor padre Articulación Familiar-->

       
        <!--- Fin contenedor padre Proyectos Proyectos de Servicio Social Estudiantil-->
 
    <?php ActiveForm::end(); ?>

</div>
