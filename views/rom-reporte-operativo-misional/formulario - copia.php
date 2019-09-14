<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\IsaActividadesRom;
use app\models\IsaEvidenciasRom;
use app\models\IsaTipoCantidadPoblacionRom;

// echo "<pre>"; print_r($datos); echo "</pre>"; 
// die;
$actividades_rom = new IsaActividadesRom();
$evidencias_rom = new IsaEvidenciasRom();
$tipo_poblacion_rom = new IsaTipoCantidadPoblacionRom();
 
 
?>
    <h3 style='background-color: #ccc;padding:5px;'>Fecha de realización de la o las actividades</h3>
    <?php 
	// $actividades_rom->fehca_desde = $datos['actividades'][$idActividad]['fehca_desde'] ;
	echo $form->field($actividades_rom, "[$idActividad]fecha_desde")->widget(
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
	// $actividades_rom->fecha_hasta = $datos['actividades'][$idActividad]['fecha_hasta'] ;
	echo $form->field($actividades_rom, "[$idActividad]fecha_hasta")->widget(
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
    <?= $form->field($actividades_rom, "[$idActividad]estado")->dropDownList($estados,[ 'prompt' => 'Seleccione...','value' => $datos['actividades'][$idActividad]['estado']] ) ?>
    
    <h3 style='background-color: #ccc;padding:5px;'>Equipo o equipos que hicieron la intervención</h3>
    <?= $form->field($actividades_rom, "[$idActividad]num_equipos")->textInput(['value' => $datos['actividades'][$idActividad]['num_equipos']]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]perfiles")->textInput(['value' => $datos['actividades'][$idActividad]['perfiles']]) ?>

    <?= $form->field($actividades_rom, "[$idActividad]docente_orientador")->textInput(['value' => $datos['actividades'][$idActividad]['docente_orientador']]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]nombre_actividad")->textInput(['value' => $datos['actividades'][$idActividad]['nombre_actividad']]) ?>

	<h2 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h2>
	<h3 style='background-color: #ccc;padding:5px;'>Número de participantes por actividad comunitaria por sede educativa (Se deben revisar los nombres y datos de  la lista de asistencia para no repetir personas): </h3>
	<?= $form->field($tipo_poblacion_rom, "[$idActividad]vecinos")->textInput(['value' => $datos['tipoCantidadPoblacion'][$idActividad]['vecinos'] ]) ?>
	<?= $form->field($tipo_poblacion_rom, "[$idActividad]lideres_comunitarios")->textInput(['value' => $datos['tipoCantidadPoblacion'][$idActividad]['lideres_comunitarios']]) ?>
	<?= $form->field($tipo_poblacion_rom, "[$idActividad]empresarios_comerciantes")->textInput(['value' => $datos['tipoCantidadPoblacion'][$idActividad]['empresarios_comerciantes']]) ?>
	<?= $form->field($tipo_poblacion_rom, "[$idActividad]organizaciones_locales")->textInput(['value' => $datos['tipoCantidadPoblacion'][$idActividad]['organizaciones_locales']]) ?>
	<?= $form->field($tipo_poblacion_rom, "[$idActividad]grupos_comunitarios")->textInput(['value' => $datos['tipoCantidadPoblacion'][$idActividad]['grupos_comunitarios']]) ?>
	<?= $form->field($tipo_poblacion_rom, "[$idActividad]otos_actores")->textInput(['value' => $datos['tipoCantidadPoblacion'][$idActividad]['otos_actores']]) ?>
	<?= $form->field($tipo_poblacion_rom, "[$idActividad]total_participantes")->textInput(['value' => $datos['tipoCantidadPoblacion'][$idActividad]['total_participantes']]) ?>
	<?= $form->field($tipo_poblacion_rom, "[$idActividad]id_rom_actividad")->hiddenInput(['value' => $idActividad])->label(false) ?>

	  
	<h3 style='background-color: #ccc;padding:5px;'>Evidencias (Indique la cantidad y destino de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
	<?= $form->field($evidencias_rom, "[$idActividad]actas")->label('ACTAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]reportes")->label('REPORTES  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]listados")->label('LISTADOS  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]plan_trabajo")->label('PLAN DE TRABAJO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]formato_seguimiento")->label('FORMATOS DE SEGUIMIENTO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]formato_evaluacion")->label('FORMATOS DE EVALUACIÓN (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]fotografias")->label('FOTOGRAFÍAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]vidoes")->label('VIDEOS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]otros_productos")->label('Otros productos  de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]cantidad")->textInput() ?>
	<?= $form->field($evidencias_rom, "[$idActividad]archivos_enviados_entregados")->textInput() ?>
	<?= $form->field($evidencias_rom, "[$idActividad]id_rom_actividad")->hiddenInput(['value' => $idActividad])->label(false) ?>
	<?= $form->field($evidencias_rom, "[$idActividad]fecha_entrega_envio")->widget(
	DatePicker::className(), [
		// modify template for custom rendering
		'template' => '{addon}{input}',
		'language' => 'es',
		'clientOptions' => [
			'autoclose' => true,
			'format'    => 'yyyy-mm-dd',
	],
	]);  ?>

    <?= $form->field($actividades_rom, "[$idActividad]observaciones_generales")->textInput(['value' => $datos['actividades'][$idActividad]['observaciones_generales'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]duracion_sesion")->textInput(['value' => $datos['actividades'][$idActividad]['duracion_sesion'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]logros")->textInput(['value' => $datos['actividades'][$idActividad]['logros'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]fortalezas")->textInput(['value' => $datos['actividades'][$idActividad]['fortalezas'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]debilidades")->textInput(['value' => $datos['actividades'][$idActividad]['debilidades'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]alternativas")->textInput(['value' => $datos['actividades'][$idActividad]['alternativas'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]retos")->textInput(['value' => $datos['actividades'][$idActividad]['retos'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]articulacion")->textInput(['value' => $datos['actividades'][$idActividad]['articulacion'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]evaluacion")->textInput(['value' => $datos['actividades'][$idActividad]['evaluacion'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]alarmas")->textInput(['value' => $datos['actividades'][$idActividad]['alarmas'] ]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]justificacion_activiad_no_realizada")->textInput(['value' => $datos['actividades'][$idActividad]['justificacion_activiad_no_realizada'] ]) ?>

    <?php
	$actividades_rom->fecha_reprogramacion = $datos['actividades'][$idActividad]['fecha_reprogramacion'] ;
	echo $form->field($actividades_rom, "[$idActividad]fecha_reprogramacion")->widget(
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
    <?= $form->field($actividades_rom, "[$idActividad]diligencia")->textInput(['value' => $datos['actividades'][$idActividad]['alarmas']]) ?>
    <?= $form->field($actividades_rom, "[$idActividad]rol")->textInput(['value' => $datos['actividades'][$idActividad]['alarmas']]) ?>
    
   
    <?php
	$actividades_rom->fecha_reprogramacion = $datos['actividades'][$idActividad]['fecha_reprogramacion'] ;
	echo $form->field($actividades_rom, "[$idActividad]fecha_diligencia")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?>
	<?= $form->field($actividades_rom, "[$idActividad]id_rom_actividad")->hiddenInput(['value' => $idActividad])->label(false) ?>