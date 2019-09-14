<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion | redirecciona al login
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


    if($index < 3){?>
        <div style ="display : none">
            <?= $form->field($actividades_isa, "[$index]id_componente")->textInput(["value" => 6]) ?>
            <?= $form->field($actividades_isa, "[$index]id_actividad_c")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }else if($index >= 3 && $index <= 7){ ?>
        <div style ="display : none">
            <?= $form->field($actividades_isa, "[$index]id_componente")->textInput(["value" => 4]) ?>
            <?= $form->field($actividades_isa, "[$index]id_actividad_c")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }
    else if($index > 7){ ?>
        <div style ="display : none">
            <?= $form->field($actividades_isa, "[$index]id_componente")->textInput(["value" => 5]) ?>
            <?= $form->field($actividades_isa, "[$index]id_actividad_c")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }
    ?>
    <?= $form->field($actividades_isa, "[$index]logors")->textInput([ 'value' => isset($datos[$index]['logors']) ? $datos[$index]['logors'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]fortalezas")->textInput([ 'value' => isset($datos[$index]['fortalezas']) ? $datos[$index]['fortalezas'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]debilidades")->textInput([ 'value' => isset($datos[$index]['debilidades']) ? $datos[$index]['debilidades'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]alternativas")->textInput([ 'value' => isset($datos[$index]['alternativas']) ? $datos[$index]['alternativas'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]retos")->textInput([ 'value' => isset($datos[$index]['retos']) ? $datos[$index]['retos'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]observaciones")->textInput([ 'value' => isset($datos[$index]['observaciones']) ? $datos[$index]['observaciones'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]alarmas")->textInput([ 'value' => isset($datos[$index]['alarmas']) ? $datos[$index]['alarmas'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]necesidades")->textInput([ 'value' => isset($datos[$index]['necesidades']) ? $datos[$index]['necesidades'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]estrategias_aprovechar")->textInput([ 'value' => isset($datos[$index]['estrategias_aprovechar']) ? $datos[$index]['estrategias_aprovechar'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]estrategias_enfrentar")->textInput([ 'value' => isset($datos[$index]['estrategias_enfrentar']) ? $datos[$index]['estrategias_enfrentar'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]ajustes")->textInput([ 'value' => isset($datos[$index]['ajustes']) ? $datos[$index]['ajustes'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]temas")->textInput([ 'value' => isset($datos[$index]['temas']) ? $datos[$index]['temas'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]articulacion")->textInput([ 'value' => isset($datos[$index]['articulacion']) ? $datos[$index]['articulacion'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]necesidades_articulacion")->textInput([ 'value' => isset($datos[$index]['necesidades_articulacion']) ? $datos[$index]['necesidades_articulacion'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]cumplimiento_objetivos")->textInput([ 'value' => isset($datos[$index]['cumplimiento_objetivos']) ? $datos[$index]['cumplimiento_objetivos'] : '' ]) ?>
    <?= $form->field($actividades_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>