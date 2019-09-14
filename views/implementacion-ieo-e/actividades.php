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
            'clientOptions' => [
                'autoclose' => true,
                'format' 	=> 'yyyy-mm-dd',
            ],
        ]);  ?>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]tipo_actividad")->textInput() ?>
        <h3 style='background-color: #ccc;padding:5px;'>Docentes</h3>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]tiempo_libre")->textInput() ?>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]edu_derechos")->textInput() ?>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]sexualidad")->textInput() ?>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]ciudadania")->textInput() ?>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]medio_ambiente")->textInput() ?>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]familia")->textInput() ?>
        <?= $form->field($tiposCantidadPoblacion, "[$numActividad]directivos")->textInput() ?>
        
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
            <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_0", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_1", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_2", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_3", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_4", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_5", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_6", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_7", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_8", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_9", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_10", [ 'class' => 'form-control'] ) ?>
            </div>
            <div class="col-sm-1" style='padding:0px;'>
                <?=  Html::activeTextInput($estudiantesGrado, "[$numActividad]grado_11", [ 'class' => 'form-control'] ) ?>
            </div>
        </div>
        <h3 style='background-color: #ccc;padding:5px;'>Evidencias</h3>    
        <?php
            if($numActividad != 3 && $numActividad != 5 && $numActividad != 9 && $numActividad != 11 && $numActividad != 15){ ?>
                <?= $form->field($model, "[$numActividad]producto_acuerdo")->label('Producto: acta de acuerdos y compromisos')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
               
            <?php
            }else{ ?>
                <?= $form->field($model, "[$numActividad]producto_acuerdo")->label('Producto: avance a la trazabilidad del plan de acción')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                <?= $form->field($model, "[$numActividad]avance_formula")->label('Avance de la formulación y sistematización de la iniciativa')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
                <?= $form->field($model, "[$numActividad]avance_ruta_gestion")->label('Avance a la ruta de gestión')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>

                <?php
            }?>
             <?= $form->field($model, "[$numActividad]resultado_actividad")->label('Resultados de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
             <?= $form->field($model, "[$numActividad]acta")->label("ACTA")->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
             <?= $form->field($model, "[$numActividad]listado")->label("LISTADO")->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
             <?= $form->field($model, "[$numActividad]fotografias")->label('FOTOGRAFÍAS')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>

    <?php
        }else{
        ?>
            <?= $form->field($model, "[$numActividad]producto_informe_acompañamiento")->label('Informe de acompañamiento')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            <?= $form->field($model, "[$numActividad]producto_trazabilidad")->label('Trazabilidad al plan de acción')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            <?= $form->field($model, "[$numActividad]producto_formnulacion_sistemactizacion")->label('Formulación y sistematización de la iniciativa')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            <?= $form->field($model, "[$numActividad]producto_ruta_gestion")->label('Ruta de gestión')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
            <?= $form->field($model, "[$numActividad]producto_presentacion_resultados")->label('Presentación de los resultados del proceso')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
        <?php

        }
    ?>