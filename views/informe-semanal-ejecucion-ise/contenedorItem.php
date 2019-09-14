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

?>
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
            <?=  Html::activeTextInput($tipo_poblacion, "[$index]tiempo_libre", [ 'type' => 'number', 'class' => "form-control docentes-$index-cantidad", 'value' => isset($datos[$index]['tiempo_libre']) ? $datos[$index]['tiempo_libre'] : ''] ) ?>
        </div>
        <div class="col-sm-2" style='padding:0px;'>
            <?=  Html::activeTextInput($tipo_poblacion, "[$index]edu_derechos", [ 'type' => 'number', 'class' =>  "form-control docentes-$index-cantidad", 'value' => isset($datos[$index]['edu_derechos']) ? $datos[$index]['edu_derechos'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($tipo_poblacion, "[$index]sexualidad_ciudadania", [ 'type' => 'number', 'class' =>  "form-control docentes-$index-cantidad", 'value' => isset($datos[$index]['sexualidad']) ? $datos[$index]['sexualidad'] : ''] ) ?>
        </div>        
        <div class="col-sm-2" style='padding:0px;'>
            <?=  Html::activeTextInput($tipo_poblacion, "[$index]medio_ambiente", [ 'type' => 'number', 'class' =>  "form-control docentes-$index-cantidad", 'value' => isset($datos[$index]['medio_ambiente']) ? $datos[$index]['medio_ambiente'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($tipo_poblacion, "[$index]familia", [ 'type' => 'number', 'class' =>  "form-control docentes-$index-cantidad", 'value' => isset($datos[$index]['familia']) ? $datos[$index]['familia'] : ''] ) ?>
        </div>
        <div class="col-sm-2" style='padding:0px;'>
            <?=  Html::activeTextInput($tipo_poblacion, "[$index]directivos", [ 'type' => 'number', 'class' =>  "form-control docentes-$index-cantidad", 'value' => isset($datos[$index]['directivos']) ? $datos[$index]['directivos'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($tipo_poblacion, "[$index]total", [ 'type' => 'number', 'class' => 'form-control', 'value' => isset($datos[$index]['total']) ? $datos[$index]['total'] : ''] ) ?>
        </div>
    </div>

    <?= $form->field($tipo_poblacion, "[$index]id_tip")->hiddenInput( [ 'value' => isset($datos[$index]['id_tip']) ? $datos[$index]['id_tip'] : ''  ] )->label(false ) ?>
    
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
        <?=  Html::activeTextInput($estudiasntes, "[$index]grado_0", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_0']) ? $datos[$index]['grado_0'] : '' ] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_1", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_1']) ? $datos[$index]['grado_1'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_2", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_2']) ? $datos[$index]['grado_2'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_3", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_3']) ? $datos[$index]['grado_3'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_4", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_4']) ? $datos[$index]['grado_4'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_5", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_5']) ? $datos[$index]['grado_5'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_6", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_6']) ? $datos[$index]['grado_6'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_7", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_7']) ? $datos[$index]['grado_7'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_8", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_8']) ? $datos[$index]['grado_8'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_9", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_9']) ? $datos[$index]['grado_9'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_10", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_10']) ? $datos[$index]['grado_10'] : ''] ) ?>
        </div>
        <div class="col-sm-1" style='padding:0px;'>
            <?=  Html::activeTextInput($estudiasntes, "[$index]grado_11", [ 'type' => 'number', 'class' => 'form-control','value' => isset($datos[$index]['grado_11']) ? $datos[$index]['grado_11'] : ''] ) ?>
        </div>
        <?= $form->field($estudiasntes, "[$index]total")->textInput([ 'value' => isset($datos[$index]['total']) ? $datos[$index]['total'] : '' ]) ?>
        <?= $form->field($estudiasntes, "[$index]est_id")->hiddenInput( [ 'value' => isset($datos[$index]['est_id']) ? $datos[$index]['est_id'] : ''  ] )->label(false ) ?>
       
        <div class=cell style='display:none'>
            <?= $form->field($estudiasntes, "[$index]id_proyecto")->textInput(["value" => $index+1]) ?>
        </div> 
    </div>
