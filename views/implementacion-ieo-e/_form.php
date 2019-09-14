<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\ImplementacionIeo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="implementacion-ieo-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'zona_educativa')->textInput() ?>
        <?= $form->field($model, 'comuna')->textInput() ?>
        <?= $form->field($model, 'barrio')->textInput() ?>
        <?= $form->field($model, 'profesional_cargo')->textInput() ?>
        <?= $form->field($model, 'horario_trabajo')->textInput() ?>


        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse1">Acompañamiento a la ejecución de la ruta diseñada en el plan de acción</a>
                </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        
                        <!--- Inicio actividad 1-->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-1">Actividad 1. Socialización de plan de acción</a>
                                </h4>
                                </div>
                                <div id="collapse1-1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[0]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[0]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[0]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[0]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[0]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[0]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[0]directivos')->textInput() ?>
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
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[0]tipo_actividad')->hiddenInput( [ 'value' => '4' ] )->label( '' ) ?>
                                    </div>
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
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[0]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[0]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[0]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[0]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[0]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--- Fina actividad 1-->
                        

                        <!--- Inicio Actividad general. MCEE Encuentro-->  
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-2">Actividad general. MCEE Encuentro</a>
                                </h4>
                                </div>
                                <div id="collapse1-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[1]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[1]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[1]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[1]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[1]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[1]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[1]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[1]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[1]tipo_actividad')->hiddenInput( [ 'value' => '5' ] )->label( '' ) ?>
                                    </div>
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
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[1]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[1]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[1]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[1]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[1]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>                
                        <!--- Fina Actividad general. MCEE Encuentro-->
                        
                        <!--- Inicio Actividad 2. Mesa de trabajo-->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-3">Actividad 2. Mesa de trabajo</a>
                                </h4>
                                </div>
                                <div id="collapse1-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[2]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[2]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[2]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[2]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[2]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[2]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[2]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[2]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[2]tipo_actividad')->hiddenInput( [ 'value' => '6' ] )->label( '' ) ?>
                                    </div>
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
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[2]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[2]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[2]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[2]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[2]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--- Fin Actividad 2. Mesa de trabajo-->
                        
                        <!--- Inicio Actividad 3. Acompañamiento a la práctica-->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-4">Actividad 3. Acompañamiento a la práctica</a>
                                </h4>
                                </div>
                                <div id="collapse1-4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[3]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[3]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[3]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[3]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[3]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[3]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[3]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[3]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[3]tipo_actividad')->hiddenInput( [ 'value' => '7' ] )->label( '' ) ?>
                                    </div>
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
                                        <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_0', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_1', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_2', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_3', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_4', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_5', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_6', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_7', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_8', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_9', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_10', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[3]grado_11', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[3]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[3]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[3]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[3]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[3]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--- Fin Actividad 3. Acompañamiento a la práctica-->

                        <!--- Inicio Actividad 4. Mesa de trabajo-->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-5">Actividad 4. Mesa de trabajo</a>
                                </h4>
                                </div>
                                <div id="collapse1-5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[4]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[4]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[4]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[4]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[4]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[4]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[4]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[4]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[4]tipo_actividad')->hiddenInput( [ 'value' => '8' ] )->label( '' ) ?>
                                    </div>
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
                                        <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_0', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_1', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_2', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_3', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_4', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_5', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_6', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_7', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_8', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_9', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_10', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[4]grado_11', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[4]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[4]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[4]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[4]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[4]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--- Fin Actividad 4. Mesa de trabajo-->  

                        <!--- Inicio Actividad 5. Acompañamiento a la práctica-->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-6">Actividad 5. Acompañamiento a la práctica</a>
                                </h4>
                                </div>
                                <div id="collapse1-6" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[5]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[5]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[5]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[5]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[5]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[5]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[5]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[5]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[5]tipo_actividad')->hiddenInput( [ 'value' => '9' ] )->label( '' ) ?>
                                    </div>
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
                                        <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_0', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_1', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_2', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_3', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_4', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_5', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_6', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_7', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_8', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_9', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_10', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[5]grado_11', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[5]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[5]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[5]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[5]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[5]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>                   
                        <!--- Fin Actividad 5. Acompañamiento a la práctica-->                 
                        

                        <!--- Inicio Actividad Especial. Taller-->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-7">Actividad Especial. Taller</a>
                                </h4>
                                </div>
                                <div id="collapse1-7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[6]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[6]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[6]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[6]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[6]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[6]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[6]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[6]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[6]tipo_actividad')->hiddenInput( [ 'value' => '10' ] )->label( '' ) ?>
                                    </div>
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
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[6]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[6]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[6]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[6]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[6]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--- Fin Actividad Especial. Taller-->
                        
                        <!--- Inicio Actividad Especial.  Salida pedagógica -->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-8">Actividad Especial. Salida pedagógica</a>
                                </h4>
                                </div>
                                <div id="collapse1-8" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[7]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[7]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[7]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[7]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[7]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[7]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[7]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[7]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[7]tipo_actividad')->hiddenInput( [ 'value' => '11' ] )->label( '' ) ?>
                                    </div>
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
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[7]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[7]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[7]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[7]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[7]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>                     
                        <!--- Fin Actividad Especial.  Salida pedagógica -->

                        <!--- Inicio Actividad 6. Mesa de Trabajo -->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-9">Actividad 6. Mesa de Trabajo</a>
                                </h4>
                                </div>
                                <div id="collapse1-9" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[8]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[8]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[8]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[8]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[8]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[8]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[8]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[8]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[8]tipo_actividad')->hiddenInput( [ 'value' => '12' ] )->label( '' ) ?>
                                    </div>
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
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[8]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[8]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[8]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[8]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[8]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                      
                                </div>
                                </div>
                            </div>
                        </div>                    
                        <!--- Fin Actividad 6. Mesa de Trabajo -->
                        
                        <!--- Inicio Actividad 7. Acompañamiento a la Práctica -->
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1-10">Actividad 7. Acompañamiento a la Práctica</a>
                                </h4>
                                </div>
                                <div id="collapse1-10" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>
                                    <?= $form->field($tiposCantidadPoblacion, '[9]tiempo_libre')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[9]edu_derechos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[9]sexualidad')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[9]ciudadania')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[9]medio_ambiente')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[9]familia')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[9]directivos')->textInput() ?>
                                    <?= $form->field($tiposCantidadPoblacion, '[9]fecha_creacion')->widget(
                                    DatePicker::className(), [
                                        // modify template for custom rendering
                                        'template' => '{addon}{input}',
                                        'language' => 'es',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format'    => 'yyyy-mm-dd',
                                        ],
                                    ]);  ?>
                                    <div class=cell style='display:none'>
                                        <?= $form->field($tiposCantidadPoblacion, '[9]tipo_actividad')->hiddenInput( [ 'value' => '13' ] )->label( '' ) ?>
                                    </div>
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
                                        <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_0', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_1', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_2', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_3', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_4', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_5', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_6', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_7', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_8', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_9', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_10', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                        <div class="col-sm-1" style='padding:0px;'>
                                            <?=  Html::activeTextInput($estudiantesGrado, '[13]grado_11', [ 'class' => 'form-control'] ) ?>
                                        </div>
                                    </div>

                                    <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>
                                    <div class=cell>
                                        <?= $form->field($model, '[13]producto_acuerdo')->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>    
                                        <?= $form->field($model, '[13]resultado_actividad')->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[13]acta')->label('ACTA')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[13]listado')->label('LISTADO')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>
                                    <div class=cell>
                                        <?= $form->field($model, '[13]fotografias')->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                                    </div>  
                                </div>
                                </div>
                            </div>
                        </div>
                        <!--- Fin Actividad 7. Acompañamiento a la Práctica -->

                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
