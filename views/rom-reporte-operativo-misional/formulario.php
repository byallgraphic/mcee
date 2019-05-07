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
use app\models\IsaActividadesRomXIntegranteGrupo;
use app\models\Parametro;
use yii\helpers\ArrayHelper;

// echo "<pre>"; print_r($datos); echo "</pre>"; 
// die;
// $actividades_rom 	= new IsaActividadesRom();
// $evidencias_rom 	= new IsaEvidenciasRom();
// $tipo_poblacion_rom = new IsaTipoCantidadPoblacionRom();
// $integrante 		= new IsaActividadesRomXIntegranteGrupo();
 
$estados_actividad = Parametro::find()
							->alias('p')
							->innerJoin( 'tipo_parametro tp','tp.id=p.id_tipo_parametro' )
							->where( 'p.estado=1' )
							->andWhere( "tp.estado=1" )
							->andWhere( [ 'tp.descripcion' => '2 Reporte Iniciación - estados' ] )
							->all();
							
$estados_actividad = ArrayHelper::map( $estados_actividad,'id','descripcion' );

$total = 0;

$evidencias_rom->fecha_entrega_envio = '';
?>

<!-- ACTIVIDADES ROM -->

<div class="row">
	<div class="col-md-6">
		<?= $form->field($actividades_rom, "[$idActividad]fecha_desde")->widget(
					DatePicker::className(), [
						// modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format'    => 'yyyy-mm-dd',
					],
				]); ?>
	</div>

	<div class="col-md-6">
		<?= $form->field($actividades_rom, "[$idActividad]fecha_hasta")->label('Hasta')->widget(
					DatePicker::className(), [
						// modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format'    => 'yyyy-mm-dd',
					],
				]); ?>
	</div>
</div>

<div class="row">
		
	<div class="col-md-6">
		<?= $form->field($actividades_rom, "[$idActividad]sesion_actividad")->label('Nombre o título de la actividad o encuentro')->dropDownList($actividadesParticipadas, ['prompt' => 'Seleccione...']) ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($actividades_rom, "[$idActividad]estado_actividad")->label('Estado de la actividad')->dropDownList( $estados_actividad, ['prompt' => 'Seleccione...'] ) ?>
	</div>

</div>


<div class="row">
		
	<div class="col-md-6">
		<div class="form-group" style='margin-bottom: 0px;'>
			<label class="control-label" for="">No. del Equipo o equipos en campo</label>
		</div>	
	</div>
			
	<div class="col-md-6">
		<div class="form-group" style='margin-bottom: 0px;'>
			<label class="control-label" for="">Perfiles (Seleccione el perfil y cantidad por perfiles de profesionales en campo)</label>
		</div>	
	</div>

</div>

<div class="row">
		
	<div class="col-md-6">
		<div class="form-group">
			<input id="nro_equipo-<?=$idActividad ?>" class="form-control" readonly value='<?= $datos_adicionales['equipo_nombre']?>'>
		</div>	
	</div>
			
	<div class="col-md-6">
		<div class="form-group">
			<input id="perfiles-<?=$idActividad ?>" class="form-control" readonly value='<?= $datos_adicionales['perfiles']?>'>
		</div>	
	</div>

</div>

<div class="row">
		
	<div class="col-md-6">
		<div class="form-group" style='margin-bottom: 0px;'>
			<label class="control-label" for="">Docente orientador(a)  (Nombre del o la profesional)</label>
		</div>	
	</div>

</div>

<div class="row">
		
	<div class="col-md-6">
		<div class="form-group">
			<input id="docente_orientador-<?=$idActividad ?>" class="form-control" readonly value='<?= $datos_adicionales['docente_orientador']?>'>
		</div>	
	</div>

</div>

<!-- --------------------------------------- FIN ACTIVIDADES ROM --------------------------------------------------------------------- -->



<!-- ----------------- TIPO Y CANTIDAD DE POBLACION -------------------------------- -->
<h3 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h3>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($tipo_poblacion_rom, "[$idActividad]vecinos")->label()->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($tipo_poblacion_rom, "[$idActividad]lideres_comunitarios")->label()->textInput() ?>
	</div>
	
</div>


<div class="row">

	<div class="col-md-6">
		<?= $form->field($tipo_poblacion_rom, "[$idActividad]empresarios_comerciantes")->label()->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($tipo_poblacion_rom, "[$idActividad]organizaciones_locales")->label()->textInput() ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($tipo_poblacion_rom, "[$idActividad]grupos_comunitarios")->label()->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($tipo_poblacion_rom, "[$idActividad]otos_actores")->label()->textInput() ?>
	</div>
	
</div>
<!-- ----------------- FIN TIPO Y CANTIDAD DE POBLACION -------------------------------- -->


 <h3 style='background-color: #ccc;padding:5px;'>Evidencias (Indique la cantidad y destino de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
	
	<div class="row">
		
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]actas[]")->label('ACTAS (Cantidad)')->fileInput(['multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]reportes[]")->label('REPORTES  (Cantidad)')->fileInput(['multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
	
	</div>
	
	<div class="row">
	
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]listados[]")->label('LISTADOS  (Cantidad)')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]plan_trabajo[]")->label('PLAN DE TRABAJO (Cantidad)')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		
	</div>
	
	<div class="row">
	
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]formato_seguimiento[]")->label('FORMATOS DE SEGUIMIENTO (Cantidad)')->fileInput([ 'multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]formato_evaluacion[]")->label('FORMATOS DE EVALUACIÓN (Cantidad)')->fileInput(['multiple' => true, 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		
	</div>
	
	<div class="row">
	
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]fotografias[]")->label('FOTOGRAFÍAS (Cantidad)')->fileInput([ 'multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]vidoes[]")->label('VIDEOS (Cantidad)')->fileInput([ 'multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		
	</div>
	
	<div class="row">
	
		<div class="col-md-12">
			<?= $form->field($evidencias_rom, "[$idActividad]otros_productos[]")->label('Otros productos  de la actividad')->fileInput([ 'multiple' => true,'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
		</div>
		
	</div>
			
	<div class="row">
	
		<div class="col-md-4">
			<?= $form->field($evidencias_rom, "[$idActividad]cantidad")->textInput([ 'value' => 0, 'readonly' => 'readonly' ]) ?>
		</div>
		
		<div class="col-md-4">
			<?= $form->field($evidencias_rom, "[$idActividad]archivos_enviados_entregados")->textInput([ 'value' => '' ]) ?>
		</div>
		
		<div class="col-md-4">
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
		</div>
	
	</div>
	
	<?= $form->field($evidencias_rom, "[$idActividad]id_rom_actividad")->hiddenInput(['value' => $idActividad])->label(false) ?>
	
	
	
<!-- IsaActividadesRomXIntegranteGrupo -->

<h3 style='background-color: #ccc;padding:5px;'>Logros</h3>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]duracion_sesion")->label('Duración')->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]logros")->label()->textInput() ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]fortalezas")->label()->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]debilidades")->label()->textInput() ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]alternativas")->label()->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]retos")->label()->textInput() ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]articulacion")->label()->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]evaluacion")->label()->textInput() ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]observaciones_generales")->label()->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]alarmas")->label()->textInput() ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]justificacion_activiad_no_realizada")->label()->textInput() ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]fecha_reprogramacion")->label()->widget(
					DatePicker::className(), [
						// modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format'    => 'yyyy-mm-dd',
					],
				]); ?>
	</div>
	
</div>


<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]fecha_diligencia")->label()->widget(
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


<!-- ----------------- FIN IsaActividadesRomXIntegranteGrupo -------------------------------- -->


