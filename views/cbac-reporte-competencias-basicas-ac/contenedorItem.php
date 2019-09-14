<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;

// echo "<pre>"; print_r($datos); echo "</pre>"; 
// die;

    if($index == 1 || $index == 2 || $index == 3){?>
        <div style ="display : none">
            <?= $form->field($actividades_rom, "[$index]id_componente")->textInput(["value" => 1]) ?>
            <?= $form->field($actividades_rom, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }else{ ?>
        <div style ="display : none">
            <?= $form->field($actividades_rom, "[$index]id_componente")->textInput(["value" => 2]) ?>
            <?= $form->field($actividades_rom, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }
?>
    
    <h3 style='background-color: #ccc;padding:5px;'>Fecha de realización de la o las actividades</h3>
    <?php 
	$actividades_rom->fehca_desde = $datos['actividades'][$index]['fehca_desde'] ;
	echo $form->field($actividades_rom, "[$index]fehca_desde")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
				
        ],
    ]);  ?> 

	
    <?php 
	$actividades_rom->fecha_hasta = $datos['actividades'][$index]['fecha_hasta'] ;
	echo $form->field($actividades_rom, "[$index]fecha_hasta")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> 

    <h3 style='background-color: #ccc;padding:5px;'>Estado de la actividad</h3>
    <?= $form->field($actividades_rom, "[$index]estado")->dropDownList($estados,[ 'prompt' => 'Seleccione...','value' => $datos['actividades'][$index]['estado']] ) ?>
    
    <h3 style='background-color: #ccc;padding:5px;'>Equipo o equipos que hicieron la intervención</h3>
    <?= $form->field($actividades_rom, "[$index]num_equipos")->textInput(['value' => $datos['actividades'][$index]['num_equipos']]) ?>
    <?= $form->field($actividades_rom, "[$index]perfiles")->textInput(['value' => $datos['actividades'][$index]['perfiles']]) ?>

    <?= $form->field($actividades_rom, "[$index]docente_orientador")->textInput(['value' => $datos['actividades'][$index]['docente_orientador']]) ?>
    <?= $form->field($actividades_rom, "[$index]nombre_actividad")->textInput(['value' => $datos['actividades'][$index]['nombre_actividad']]) ?>

     <h2 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h2>
     <h3 style='background-color: #ccc;padding:5px;'>Número de participantes por actividad comunitaria por sede educativa (Se deben revisar los nombres y datos de  la lista de asistencia para no repetir personas): </h3>
     <?= $form->field($tipo_poblacion_rom, "[$index]vecinos")->textInput(['value' => $datos['tipoCantidadPoblacion'][$index]['vecinos'] ]) ?>
     <?= $form->field($tipo_poblacion_rom, "[$index]lideres_comunitarios")->textInput(['value' => $datos['tipoCantidadPoblacion'][$index]['lideres_comunitarios']]) ?>
     <?= $form->field($tipo_poblacion_rom, "[$index]empresarios_comerciantes")->textInput(['value' => $datos['tipoCantidadPoblacion'][$index]['empresarios_comerciantes']]) ?>
     <?= $form->field($tipo_poblacion_rom, "[$index]organizaciones_locales")->textInput(['value' => $datos['tipoCantidadPoblacion'][$index]['organizaciones_locales']]) ?>
     <?= $form->field($tipo_poblacion_rom, "[$index]grupos_comunitarios")->textInput(['value' => $datos['tipoCantidadPoblacion'][$index]['grupos_comunitarios']]) ?>
     <?= $form->field($tipo_poblacion_rom, "[$index]otos_actores")->textInput(['value' => $datos['tipoCantidadPoblacion'][$index]['otos_actores']]) ?>
     <?= $form->field($tipo_poblacion_rom, "[$index]total_participantes")->textInput(['value' => $datos['tipoCantidadPoblacion'][$index]['total_participantes']]) ?>
	 
     <h3 style='background-color: #ccc;padding:5px;'>Evidencias (Indique la cantidad y destino de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
     <?= $form->field($evidencias_rom, "[$index]actas")->label('ACTAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]reportes")->label('REPORTES  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]listados")->label('LISTADOS  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]plan_trabajo")->label('PLAN DE TRABAJO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]formato_seguimiento")->label('FORMATOS DE SEGUIMIENTO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]formato_evaluacion")->label('FORMATOS DE EVALUACIÓN (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]fotografias")->label('FOTOGRAFÍAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]vidoes")->label('VIDEOS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]otros_productos")->label('Otros productos  de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
     <?= $form->field($evidencias_rom, "[$index]cantidad")->textInput() ?>
     <?= $form->field($evidencias_rom, "[$index]archivos_enviados_entregados")->textInput() ?>
     <?= $form->field($evidencias_rom, "[$index]fecha_entrega_envio")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?>

    <?= $form->field($actividades_rom, "[$index]observaciones_generales")->textInput(['value' => $datos['actividades'][$index]['observaciones_generales'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]duracion_sesion")->textInput(['value' => $datos['actividades'][$index]['duracion_sesion'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]logros")->textInput(['value' => $datos['actividades'][$index]['logros'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]fortalezas")->textInput(['value' => $datos['actividades'][$index]['fortalezas'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]debilidades")->textInput(['value' => $datos['actividades'][$index]['debilidades'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]alternativas")->textInput(['value' => $datos['actividades'][$index]['alternativas'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]retos")->textInput(['value' => $datos['actividades'][$index]['retos'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]articulacion")->textInput(['value' => $datos['actividades'][$index]['articulacion'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]evaluacion")->textInput(['value' => $datos['actividades'][$index]['evaluacion'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]alarmas")->textInput(['value' => $datos['actividades'][$index]['alarmas'] ]) ?>
    <?= $form->field($actividades_rom, "[$index]justificacion_activiad_no_realizada")->textInput(['value' => $datos['actividades'][$index]['justificacion_activiad_no_realizada'] ]) ?>

    <?php
	$actividades_rom->fecha_reprogramacion = $datos['actividades'][$index]['fecha_reprogramacion'] ;
	echo $form->field($actividades_rom, "[$index]fecha_reprogramacion")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?>

    <h3 style='background-color: #ccc;padding:5px;'>Diligenciamiento del Reporte</h3>
    <?= $form->field($actividades_rom, "[$index]diligencia")->textInput(['value' => $datos['actividades'][$index]['alarmas']]) ?>
    <?= $form->field($actividades_rom, "[$index]rol")->textInput(['value' => $datos['actividades'][$index]['alarmas']]) ?>
   
   <?php
		$actividades_rom->fecha_diligencia = $datos['actividades'][$index]['fecha_diligencia'] ;
		$form->field($actividades_rom, "[$index]fecha_diligencia")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  
    
    ?>