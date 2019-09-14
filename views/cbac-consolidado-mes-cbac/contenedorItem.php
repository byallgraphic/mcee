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
            <?= $form->field($actividade_cbac, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }else if($index >= 3 && $index <= 7){ ?>
        <div style ="display : none">
            
            <?= $form->field($actividade_cbac, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }
    else if($index > 7){ ?>
        <div style ="display : none">
            <?= $form->field($actividade_cbac, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }

    if($index == 1){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 1. Aplicar en campo la propuesta didáctica en arte y cultura con docentes y directivos docentes </h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 1. Aplicar en campo la propuesta didáctica en arte y cultura con docentes y directivos docentes "])->label(false); ?>
    <?php
    }
    if($index == 2){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 2. Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas.</h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 2. Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas."])->label(false); ?>
    <?php
    }
    if($index == 3){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 3:  Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes.</h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 3:  Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes."])->label(false); ?>
    <?php
    }
    if($index == 4){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 4. Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales.</h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 4. Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales."])->label(false); ?>
    <?php
    }
    if($index == 5){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 5: Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias.</h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 5: Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias."])->label(false); ?>
    <?php
    }
    if($index == 6){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 6: Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas.</h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 6: Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas."])->label(false); ?>
    <?php
    }
    if($index == 7){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 7. Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida.</h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 7. Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida."])->label(false); ?>
    <?php
    }
    if($index == 8){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 8. Realizar talleres de promoción de lectura, escritura y oralidad a familias. </h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 8. Realizar talleres de promoción de lectura, escritura y oralidad a familias."])->label(false); ?>
    <?php
    }
    if($index == 9){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 9. Apoyar el desarrollo de los proyectos institucionales.</h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 9. Apoyar el desarrollo de los proyectos institucionales."])->label(false); ?>
    <?php
    }
    if($index == 10){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 10. Divulgar las experiencias de vínculo de las familias a la escuela. </h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 10. Divulgar las experiencias de vínculo de las familias a la escuela."])->label(false); ?>
    <?php
    }
    if($index == 11){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 11. Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas.</h3>
        <?= $form->field($actividade_cbac, "[$index]nombre")->hiddenInput(['value'=> "Actividad 11. Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas."])->label(false); ?>
    <?php
    }
    //var_dump($datos);
    //die();
?>
    <?= $form->field($actividade_cbac, "[$index]avance_sede_actividad")->textInput([ 'value' => isset($datos[$index]['avance_sede_actividad']) ? $datos[$index]['avance_sede_actividad'] : '' ]) ?>
    <?= $form->field($actividade_cbac, "[$index]avance_ieo_actividad")->textInput([ 'value' => isset($datos[$index]['avance_ieo_actividad']) ? $datos[$index]['avance_ieo_actividad'] : '' ]) ?>
    <?= $form->field($actividade_cbac, "[$index]sesiones_realizadas")->textInput([ 'value' => isset($datos[$index]['sesiones_realizadas']) ? $datos[$index]['sesiones_realizadas'] : '' ]) ?>
    <?= $form->field($actividade_cbac, "[$index]sesiones_canceladas")->textInput([ 'value' => isset($datos[$index]['sesiones_canceladas']) ? $datos[$index]['sesiones_canceladas'] : '' ]) ?>
    

    <h2 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h2>
    <h3 style='background-color: #ccc;padding:5px;'>Número de participantes por filiación por sede educativa en la actividad</h3>
    
    <?php
        if($index <= 2){
    ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]ciencias_naturales")->textInput([ 'value' => isset($datos[$index]['ciencias_naturales']) ? $datos[$index]['ciencias_naturales'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]ciencias_sociales")->textInput([ 'value' => isset($datos[$index]['ciencias_sociales']) ? $datos[$index]['ciencias_sociales'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]educacion_artisticas")->textInput([ 'value' => isset($datos[$index]['educacion_artisticas']) ? $datos[$index]['educacion_artisticas'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]educacion_etica")->textInput([ 'value' => isset($datos[$index]['educacion_etica']) ? $datos[$index]['educacion_etica'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]educacion_fisica")->textInput([ 'value' => isset($datos[$index]['educacion_fisica']) ? $datos[$index]['educacion_fisica'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]educacion_religiosa")->textInput([ 'value' => isset($datos[$index]['educacion_religiosa']) ? $datos[$index]['educacion_religiosa'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]estadistica")->textInput([ 'value' => isset($datos[$index]['estadistica']) ? $datos[$index]['estadistica'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]humanidasdes")->textInput([ 'value' => isset($datos[$index]['humanidasdes']) ? $datos[$index]['humanidasdes'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]idiomas_extranjeros")->textInput([ 'value' => isset($datos[$index]['idiomas_extranjeros']) ? $datos[$index]['idiomas_extranjeros'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]lengua_castellana")->textInput([ 'value' => isset($datos[$index]['lengua_castellana']) ? $datos[$index]['lengua_castellana'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]matematicas")->textInput([ 'value' => isset($datos[$index]['matematicas']) ? $datos[$index]['matematicas'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]tecnologia")->textInput([ 'value' => isset($datos[$index]['tecnologia']) ? $datos[$index]['tecnologia'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]otras")->textInput([ 'value' => isset($datos[$index]['otras']) ? $datos[$index]['otras'] : '' ]) ?>

    <?= $form->field($tipo_poblacion_cbac, "[$index]numero_participantes")->textInput([ 'value' => isset($datos[$index]['numero_participantes']) ? $datos[$index]['numero_participantes'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]rectora")->textInput([ 'value' => isset($datos[$index]['rectora']) ? $datos[$index]['rectora'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]coordinadora")->textInput([ 'value' => isset($datos[$index]['coordinadora']) ? $datos[$index]['coordinadora'] : '' ]) ?>
    <?= $form->field($tipo_poblacion_cbac, "[$index]directivos")->textInput([ 'value' => isset($datos[$index]['directivos']) ? $datos[$index]['directivos'] : '' ]) ?>
    <?php
        }else if($index > 2 && $index <= 7)
            { ?>
                <table>
                  <tr>
                    <th>grado_6</th>
                    <th>grado_7</th>
                    <th>grado_8</th>
                    <th>grado_9</th>
                    <th>grado_10</th>
                    <th>grado_11</th>

                  </tr>
                  <tr>
                    <td><?= $form->field($tipo_poblacion_cbac, "[$index]grado_6")->textInput([ 'value' => isset($datos[$index]['grado_6']) ? $datos[$index]['grado_6'] : '' ]) ?></td>
                    <td><?= $form->field($tipo_poblacion_cbac, "[$index]grado_7")->textInput([ 'value' => isset($datos[$index]['grado_7']) ? $datos[$index]['grado_7'] : '' ]) ?></td>
                    <td><?= $form->field($tipo_poblacion_cbac, "[$index]grado_8")->textInput([ 'value' => isset($datos[$index]['grado_8']) ? $datos[$index]['grado_8'] : '' ]) ?></td>
                    <td><?= $form->field($tipo_poblacion_cbac, "[$index]grado_9")->textInput([ 'value' => isset($datos[$index]['grado_9']) ? $datos[$index]['grado_9'] : '' ]) ?></td>
                    <td><?= $form->field($tipo_poblacion_cbac, "[$index]grado_10")->textInput([ 'value' => isset($datos[$index]['grado_10']) ? $datos[$index]['grado_10'] : '' ]) ?></td>
                    <td><?= $form->field($tipo_poblacion_cbac, "[$index]grado_11")->textInput([ 'value' => isset($datos[$index]['grado_11']) ? $datos[$index]['grado_11'] : '' ]) ?></td>
                  </tr>
                </table>
                <?= $form->field($tipo_poblacion_cbac, "[$index]numero_participantes")->textInput([ 'value' => isset($datos[$index]['numero_participantes']) ? $datos[$index]['numero_participantes'] : '' ]) ?>
            <?php
        }else if($index > 7){
            ?>
                <?= $form->field($tipo_poblacion_cbac, "[$index]cuidadores")->textInput([ 'value' => isset($datos[$index]['cuidadores']) ? $datos[$index]['cuidadores'] : '' ]) ?>
                <?= $form->field($tipo_poblacion_cbac, "[$index]madres")->textInput([ 'value' => isset($datos[$index]['madres']) ? $datos[$index]['madres'] : '' ]) ?>
                <?= $form->field($tipo_poblacion_cbac, "[$index]padres")->textInput([ 'value' => isset($datos[$index]['padres']) ? $datos[$index]['padres'] : '' ]) ?>
                <?= $form->field($tipo_poblacion_cbac, "[$index]hermanos")->textInput([ 'value' => isset($datos[$index]['hermanos']) ? $datos[$index]['hermanos'] : '' ]) ?>
                <?= $form->field($tipo_poblacion_cbac, "[$index]otros_parientes")->textInput([ 'value' => isset($datos[$index]['otros_parientes']) ? $datos[$index]['otros_parientes'] : '' ]) ?>
                <?= $form->field($tipo_poblacion_cbac, "[$index]numero_participantes")->textInput([ 'value' => isset($datos[$index]['numero_participantes']) ? $datos[$index]['numero_participantes'] : '' ]) ?>
            <?php
        }
    ?>


    <h3 style='background-color: #ccc;padding:5px;'>Evidencias (Cantidad  de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
    <?= $form->field($evidencias_cbac, "[$index]actas")->label('ACTAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls"]) ?>
    <?= $form->field($evidencias_cbac, "[$index]reportes")->label('REPORTES  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_cbac, "[$index]listados")->label('LISTADOS  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_cbac, "[$index]plan_trabajo")->label('PLAN DE TRABAJO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_cbac, "[$index]formato_seguimiento")->label('FORMATOS DE SEGUIMIENTO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_cbac, "[$index]formato_evaluacion")->label('FORMATOS DE EVALUACIÓN (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_cbac, "[$index]fotografias")->label('FOTOGRAFÍAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_cbac, "[$index]vidoes")->label('VIDEOS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    <?= $form->field($evidencias_cbac, "[$index]otros_productos")->label('Otros productos  de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
    


