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
            <?= $form->field($actividades_is_isa, "[$index]id_componente")->textInput(["value" => 6]) ?>
            <?= $form->field($actividades_is_isa, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }else if($index >= 3 && $index <= 7){ ?>
        <div style ="display : none">
            <?= $form->field($actividades_is_isa, "[$index]id_componente")->textInput(["value" => 4]) ?>
            <?= $form->field($actividades_is_isa, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }
    else if($index > 7){ ?>
        <div style ="display : none">
            <?= $form->field($actividades_is_isa, "[$index]id_componente")->textInput(["value" => 5]) ?>
            <?= $form->field($actividades_is_isa, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }

    if($index == 1){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 1. Aplicar en campo la propuesta didáctica en arte y cultura con docentes y directivos docentes </h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 1. Aplicar en campo la propuesta didáctica en arte y cultura con docentes y directivos docentes "])->label(false); ?>
    <?php
    }
    if($index == 2){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 2. Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 2. Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas."])->label(false); ?>
    <?php
    }
    if($index == 3){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 3:  Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 3:  Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes."])->label(false); ?>
    <?php
    }
    if($index == 4){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 4. Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 4. Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales."])->label(false); ?>
    <?php
    }
    if($index == 5){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 5: Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 5: Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias."])->label(false); ?>
    <?php
    }
    if($index == 6){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 6: Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 6: Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas."])->label(false); ?>
    <?php
    }
    if($index == 7){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 7. Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 7. Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida."])->label(false); ?>
    <?php
    }
    if($index == 8){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 8. Realizar talleres de promoción de lectura, escritura y oralidad a familias. </h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 8. Realizar talleres de promoción de lectura, escritura y oralidad a familias."])->label(false); ?>
    <?php
    }
    if($index == 9){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 9. Apoyar el desarrollo de los proyectos institucionales.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 9. Apoyar el desarrollo de los proyectos institucionales."])->label(false); ?>
    <?php
    }
    if($index == 10){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 10. Divulgar las experiencias de vínculo de las familias a la escuela. </h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 10. Divulgar las experiencias de vínculo de las familias a la escuela."])->label(false); ?>
    <?php
    }
    if($index == 11){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 11. Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 11. Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas."])->label(false); ?>
    <?php
    }
?>
    <?= $form->field($actividade_is_isa, "[$index]sesiones_realizadas")->textInput([ 'value' => isset($datos[$index]['sesiones_realizadas']) ? $datos[$index]['sesiones_realizadas'] : '' ]) ?>
    <?= $form->field($actividade_is_isa, "[$index]porcentaje")->textInput([ 'value' => isset($datos[$index]['porcentaje']) ? $datos[$index]['porcentaje'] : '' ]) ?>
    <?= $form->field($actividade_is_isa, "[$index]sesiones_aplazadas")->textInput([ 'value' => isset($datos[$index]['sesiones_aplazadas']) ? $datos[$index]['sesiones_aplazadas'] : '' ]) ?>
    <?= $form->field($actividade_is_isa, "[$index]sesiones_canceladas")->textInput([ 'value' => isset($datos[$index]['sesiones_canceladas']) ? $datos[$index]['sesiones_canceladas'] : '' ]) ?>
    <?= $form->field($actividade_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>

    <?= $form->field($actividades_is_isa, "[$index]duracion")->textInput([ 'value' => isset($datos[$index]['duracion']) ? $datos[$index]['duracion'] : '' ]) ?>
    <?= $form->field($actividades_is_isa, "[$index]docente")->textInput([ 'value' => isset($datos[$index]['docente']) ? $datos[$index]['docente'] : '' ]) ?>
    <?= $form->field($actividades_is_isa, "[$index]equipos")->textInput([ 'value' => isset($datos[$index]['equipos']) ? $datos[$index]['equipos'] : '' ]) ?>

    <h2 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h2>
    <h3 style='background-color: #ccc;padding:5px;'>Número de participantes por filiación por sede educativa en la actividad</h3>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]ciencias_naturales")->textInput([ 'value' => isset($datos[$index]['ciencias_naturales']) ? $datos[$index]['ciencias_naturales'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]ciencias_sociales")->textInput([ 'value' => isset($datos[$index]['ciencias_sociales']) ? $datos[$index]['ciencias_sociales'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]educacion_artistica")->textInput([ 'value' => isset($datos[$index]['educacion_artistica']) ? $datos[$index]['educacion_artistica'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]educacion_etica")->textInput([ 'value' => isset($datos[$index]['educacion_etica']) ? $datos[$index]['educacion_etica'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]educacion_fisica")->textInput([ 'value' => isset($datos[$index]['educacion_fisica']) ? $datos[$index]['educacion_fisica'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]educacion_religiosa")->textInput([ 'value' => isset($datos[$index]['educacion_religiosa']) ? $datos[$index]['educacion_religiosa'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]estadistica")->textInput([ 'value' => isset($datos[$index]['estadistica']) ? $datos[$index]['estadistica'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]humanidades")->textInput([ 'value' => isset($datos[$index]['humanidades']) ? $datos[$index]['humanidades'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]idiomas_extranjeros")->textInput([ 'value' => isset($datos[$index]['idiomas_extranjeros']) ? $datos[$index]['idiomas_extranjeros'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]lengua_castellana")->textInput([ 'value' => isset($datos[$index]['lengua_castellana']) ? $datos[$index]['lengua_castellana'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]matematicas")->textInput([ 'value' => isset($datos[$index]['matematicas']) ? $datos[$index]['matematicas'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]tecnologia")->textInput([ 'value' => isset($datos[$index]['tecnologia']) ? $datos[$index]['tecnologia'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]otras")->textInput([ 'value' => isset($datos[$index]['otras']) ? $datos[$index]['otras'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]docentes_partipantes_sede")->textInput([ 'value' => isset($datos[$index]['docentes_partipantes_sede']) ? $datos[$index]['docentes_partipantes_sede'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]rectora")->textInput([ 'value' => isset($datos[$index]['rectora']) ? $datos[$index]['rectora'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]coordinadores")->textInput([ 'value' => isset($datos[$index]['coordinadores']) ? $datos[$index]['coordinadores'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]directivos_partipantes_sede")->textInput([ 'value' => isset($datos[$index]['directivos_partipantes_sede']) ? $datos[$index]['directivos_partipantes_sede'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>


    <h3 style='background-color: #ccc;padding:5px;'>Evidencias (Cantidad  de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
    <?= $form->field($evidencias_is_isa, "[$index]actas")->label('ACTAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]reportes")->label('REPORTES  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]listados")->label('LISTADOS  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]plan_trabajo")->label('PLAN DE TRABAJO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]formato_seguimiento")->label('FORMATOS DE SEGUIMIENTO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]formato_evaluacion")->label('FORMATOS DE EVALUACIÓN (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]fotografias")->label('FOTOGRAFÍAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]vidoes")->label('VIDEOS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]otros_productos")->label('Otros productos  de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>

     <?= $form->field($actividades_is_isa, "[$index]logros")->textInput([ 'value' => isset($datos[$index]['grado_6']) ? $datos[$index]['grado_6'] : '' ]) ?>
    <h3 style='background-color: #ccc;padding:5px;'>Variaciones en la implementación del proyecto:</h3>
    <h3 style='background-color: #ccc;padding:5px;'>Situaciones de dificultad y/o ventaja, surgidos o presentes durante el periodo,  que influyen en el cumplimiento de los objetivos.</h3>
    <?= $form->field($actividades_is_isa, "[$index]variaciones_devilidades")->textInput([ 'value' => isset($datos[$index]['variaciones_devilidades']) ? $datos[$index]['variaciones_devilidades'] : '' ]) ?>
    <?= $form->field($actividades_is_isa, "[$index]variaciones_fortalezas")->textInput([ 'value' => isset($datos[$index]['variaciones_fortalezas']) ? $datos[$index]['variaciones_fortalezas'] : '' ]) ?>
    <?= $form->field($actividades_is_isa, "[$index]retos")->textInput([ 'value' => isset($datos[$index]['retos']) ? $datos[$index]['retos'] : '' ]) ?>
    <?= $form->field($actividades_is_isa, "[$index]articulacion")->textInput([ 'value' => isset($datos[$index]['articulacion']) ? $datos[$index]['articulacion'] : '' ]) ?>
    <?= $form->field($actividades_is_isa, "[$index]alrmas")->textInput([ 'value' => isset($datos[$index]['alrmas']) ? $datos[$index]['alrmas'] : '' ]) ?>
    <?= $form->field($actividades_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>

