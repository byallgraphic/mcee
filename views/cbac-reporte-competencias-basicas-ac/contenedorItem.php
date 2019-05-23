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


    if($index <= 2){?>
        <div style ="display : none">
            <?= $form->field($actividades_rom, "[$index]id_componente")->textInput(["value" => 6]) ?>
            <?= $form->field($actividades_rom, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }else if($index > 2 && $index <= 7){ ?>
        <div style ="display : none">
            <?= $form->field($actividades_rom, "[$index]id_componente")->textInput(["value" => 4]) ?>
            <?= $form->field($actividades_rom, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }else if($index > 7){ ?>
        <div style ="display : none">
            <?= $form->field($actividades_rom, "[$index]id_componente")->textInput(["value" => 5]) ?>
            <?= $form->field($actividades_rom, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }
?>
    
    <h3 style='background-color: #ccc;padding:5px;'>Fecha de realización de la o las actividades</h3>
	
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]fehca_desde")->widget(
					DatePicker::className(), [
						// modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format'    => 'yyyy-mm-dd',
					],
				]);  ?> 
			</div>
		
			<div class="col-md-6">
				 <?= $form->field($actividades_rom, "[$index]fecha_hasta")->widget(
					DatePicker::className(), [
						// modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format'    => 'yyyy-mm-dd',
					],
				]);  ?> 
			</div>
		</div>

    <h3 style='background-color: #ccc;padding:5px;'>Estado de la actividad</h3>
	<?= $form->field($actividades_rom, "[$index]estado")->dropDownList([ 'prompt' => 'Seleccione...' , 'Se realizó', 'Se aplazó', 'Se canceló' ] ) ?>
    
    <h3 style='background-color: #ccc;padding:5px;'>Equipo o equipos que hicieron la intervención</h3>
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]num_equipos")->textInput([ 'value' => isset($datos[$index]['num_equipos']) ? $datos[$index]['num_equipos'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]perfiles")->textInput([ 'value' => isset($datos[$index]['perfiles']) ? $datos[$index]['perfiles'] : '' ]) ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]docente_orientador")->textInput([ 'value' => isset($datos[$index]['docente_orientador']) ? $datos[$index]['docente_orientador'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]nombre_actividad")->textInput([ 'value' => isset($datos[$index]['docente_orientador']) ? $datos[$index]['docente_orientador'] : '' ]) ?>
			</div>
		</div>

	<h2 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h2>
	<h3 style='background-color: #ccc;padding:5px;'>Número de docentes participantes por áreas por sede educativa en la actividad (Se deben revisar los nombres y datos de  la lista de asistencia para no repetir personas)::</h3>
		<div class="row">
			<div class="col-md-6">		
				<?= $form->field($tipo_poblacion_rom, "[$index]ciencias_naturales")->textInput([ 'value' => isset($datos[$index]['ciencias_naturales']) ? $datos[$index]['ciencias_naturales'] : '' ]) ?>
			</div>
			<div class="col-md-6">		
				<?= $form->field($tipo_poblacion_rom, "[$index]ciencias_sociales")->textInput([ 'value' => isset($datos[$index]['ciencias_sociales']) ? $datos[$index]['ciencias_sociales'] : '' ]) ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">		
				<?= $form->field($tipo_poblacion_rom, "[$index]educacion_artistica")->textInput([ 'value' => isset($datos[$index]['educacion_artistica']) ? $datos[$index]['educacion_artistica'] : '' ]) ?>
			</div>
			<div class="col-md-6">		
				<?= $form->field($tipo_poblacion_rom, "[$index]educacion_etica")->textInput([ 'value' => isset($datos[$index]['educacion_etica']) ? $datos[$index]['educacion_etica'] : '' ]) ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]educacion_fisica")->textInput([ 'value' => isset($datos[$index]['educacion_fisica']) ? $datos[$index]['educacion_fisica'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]educacion_religiosa")->textInput([ 'value' => isset($datos[$index]['educacion_religiosa']) ? $datos[$index]['educacion_religiosa'] : '' ]) ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]estadistica")->textInput([ 'value' => isset($datos[$index]['estadistica']) ? $datos[$index]['estadistica'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]humanidades")->textInput([ 'value' => isset($datos[$index]['humanidades']) ? $datos[$index]['humanidades'] : '' ]) ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]idiomas_extranjeros")->textInput([ 'value' => isset($datos[$index]['idiomas_extranjeros']) ? $datos[$index]['idiomas_extranjeros'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]lengua_castellana")->textInput([ 'value' => isset($datos[$index]['lengua_castellana']) ? $datos[$index]['lengua_castellana'] : '' ]) ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]matematicas")->textInput([ 'value' => isset($datos[$index]['matematicas']) ? $datos[$index]['matematicas'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]tecnologia")->textInput([ 'value' => isset($datos[$index]['tecnologia']) ? $datos[$index]['tecnologia'] : '' ]) ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]otras")->textInput([ 'value' => isset($datos[$index]['otras']) ? $datos[$index]['otras'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($tipo_poblacion_rom, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>
			</div>
		</div>
     
	<h3 style='background-color: #ccc;padding:5px;'>Evidencias (Indique la cantidad y destino de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]actas")->label('ACTAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]reportes")->label('REPORTES  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
		</div>
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]listados")->label('LISTADOS  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]plan_trabajo")->label('PLAN DE TRABAJO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
		</div>
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]formato_seguimiento")->label('FORMATOS DE SEGUIMIENTO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]formato_evaluacion")->label('FORMATOS DE EVALUACIÓN (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
		</div>
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]fotografias")->label('FOTOGRAFÍAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]vidoes")->label('VIDEOS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
		</div>
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($evidencias_rom, "[$index]otros_productos")->label('Otros productos  de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>
		</div>
				
				
		<div class="row">
			<div class="col-md-4">
				<?= $form->field($evidencias_rom, "[$index]cantidad")->textInput() ?>
			</div>
			<div class="col-md-4">
				<?= $form->field($evidencias_rom, "[$index]archivos_enviados_entregados")->textInput() ?>
			</div>
			<div class="col-md-4">
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
			</div>
		</div>
			
			
			

		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]observaciones_generales")->textInput([ 'value' => isset($datos[$index]['observaciones_generales']) ? $datos[$index]['observaciones_generales'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]duracion_sesion")->textInput([ 'value' => isset($datos[$index]['duracion_sesion']) ? $datos[$index]['duracion_sesion'] : '' ]) ?>
			</div>
		</div>
				
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]logros")->textInput([ 'value' => isset($datos[$index]['logros']) ? $datos[$index]['logros'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]fortalezas")->textInput([ 'value' => isset($datos[$index]['fortalezas']) ? $datos[$index]['fortalezas'] : '' ]) ?>
			</div>
		</div>
				
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]debilidades")->textInput([ 'value' => isset($datos[$index]['debilidades']) ? $datos[$index]['debilidades'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]alternativas")->textInput([ 'value' => isset($datos[$index]['alternativas']) ? $datos[$index]['alternativas'] : '' ]) ?>
			</div>
		</div>
				
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]retos")->textInput([ 'value' => isset($datos[$index]['retos']) ? $datos[$index]['retos'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]articulacion")->textInput([ 'value' => isset($datos[$index]['articulacion']) ? $datos[$index]['articulacion'] : '' ]) ?>
			</div>
		</div>
				
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]evaluacion")->textInput([ 'value' => isset($datos[$index]['evaluacion']) ? $datos[$index]['evaluacion'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]alarmas")->textInput([ 'value' => isset($datos[$index]['alarmas']) ? $datos[$index]['alarmas'] : '' ]) ?>
			</div>
		</div>
				
				
				
		<div class="row">
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]justificacion_activiad_no_realizada")->textInput([ 'value' => isset($datos[$index]['justificacion_activiad_no_realizada']) ? $datos[$index]['justificacion_activiad_no_realizada'] : '' ]) ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($actividades_rom, "[$index]fecha_reprogramacion")->widget(
					DatePicker::className(), [
						// modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format'    => 'yyyy-mm-dd',
					],
				]);  ?>
			</div>
		</div>

    <h3 style='background-color: #ccc;padding:5px;'>Diligenciamiento del Reporte</h3>
	
	
		<div class="row">
			<div class="col-md-4">
				<?= $form->field($actividades_rom, "[$index]diligencia")->textInput([ 'value' => isset($datos[$index]['diligencia']) ? $datos[$index]['diligencia'] : '' ]) ?>
			</div>
			<div class="col-md-4">
				<?= $form->field($actividades_rom, "[$index]rol")->textInput([ 'value' => isset($datos[$index]['rol']) ? $datos[$index]['rol'] : '' ]) ?>
			</div>
			<div class="col-md-4">
				<?= $form->field($actividades_rom, "[$index]fecha_diligencia")->widget(
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
			</div>
		</div>