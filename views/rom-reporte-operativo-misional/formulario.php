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

if( $integrante->fecha_reprogramacion == gmdate( "Y-m-d", 0 )){
	$integrante->fecha_reprogramacion = '';
}


$array1 = [];
$array2 = [];

if( $actividades_rom->estado_actividad !== 179 ){
	$array1 = ['readonly' => 'readonly'];
	$array2 = [ 'readonly' => 'readonly', 'disabled' => 'disabled' ];
	
	if( empty( $integrante->justificacion_activiad_no_realizada ) )
		$integrante->justificacion_activiad_no_realizada = 'No Aplica';
}

$integrante->fecha_diligencia = date( "Y-m-d" );

$actividades_rom->fecha_hasta = date( "Y-m-d" );
?>

<!-- ACTIVIDADES ROM -->

<div class="row">
	
	<div class="col-md-4" style='display:none;'>
		<?= $form->field($actividades_rom, "[$idActividad]nro_semana")->label('Número de semana')->textInput([ 'value' => 1 ]) ?>
	</div>

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
				])->label('Fecha'); ?>
	</div>

	<div class="col-md-6" style='display:none;'>
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
		
	<div class="col-md-6 nro_equipo-<?=$idActividad ?>" style='display:<?= empty( $datos_adicionales['equipo_nombre'] ) ? 'none;': ';' ?>'>
		<div class="form-group" style='margin-bottom: 0px;'>
			<label class="control-label" for="">No. del Equipo o equipos en campo</label>
		</div>	
	</div>
			
	<!-- <div class="col-md-6">
		<div class="form-group" style='margin-bottom: 0px;'>
			<label class="control-label" for="">Perfiles (Seleccione el perfil y cantidad por perfiles de profesionales en campo)</label>
		</div>	
	</div> -->
	
	<div class="col-md-6">
		<div class="form-group" style='margin-bottom: 0px;'>
			<label class="control-label" for="">Coordinador técnico pedagógico (Nombre del o la profesional)</label>
		</div>	
	</div>

</div>

<div class="row">
		
	<div class="col-md-6 nro_equipo-<?=$idActividad ?>" style='display:<?= empty( $datos_adicionales['equipo_nombre'] ) ? 'none;': ';' ?>'>
		<div class="form-group">
			<input id="nro_equipo-<?=$idActividad ?>" class="form-control" readonly value='<?= $datos_adicionales['equipo_nombre']?>'>
		</div>	
	</div>
			
	<!-- <div class="col-md-6">
		<div class="form-group">
			<input id="perfiles-<?=$idActividad ?>" class="form-control" readonly value='<?= $datos_adicionales['perfiles']?>'>
		</div>	
	</div> -->
	
	<div class="col-md-6">
		<div class="form-group">
			<input id="docente_orientador-<?=$idActividad ?>" class="form-control" readonly value='<?= $datos_adicionales['docente_orientador']?>'>
		</div>	
	</div>

</div>

<!--
<div class="row">
		
	<div class="col-md-6">
		<div class="form-group" style='margin-bottom: 0px;'>
			<label class="control-label" for="">Docente orientador(a)  (Nombre del o la profesional)</label>
		</div>	
	</div>

</div>
-->

<!-- <div class="row">
		
	<div class="col-md-6">
		<div class="form-group">
			<input id="docente_orientador-<?=$idActividad ?>" class="form-control" readonly value='<?= $datos_adicionales['docente_orientador']?>'>
		</div>	
	</div>

</div> -->

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
	
		<div class="col-md-6">
			<?= $form->field($evidencias_rom, "[$idActividad]cantidad")->textInput([ 'value' => 0, 'readonly' => 'readonly' ]) ?>
		</div>
		
		<div class="col-md-4" style='display:none;'>
			<?= $form->field($evidencias_rom, "[$idActividad]archivos_enviados_entregados")->textInput([ 'value' => '' ]) ?>
		</div>
		
		<div class="col-md-4" style='display:none;'>
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
		
		<div class="col-md-4" style='display: <?= !$id_evidencia ? 'none' : ''?>' >
			<?=  Html::button('Ver archivos',['value' => "index.php?r=rom-reporte-operativo-misional/archivos-evidencias&id_evidencia=".$id_evidencia ,'data-evidencia'=> "$id_evidencia" ,'class'=>'btn btn-success modalEquipo']) ?>
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
		<?= $form->field($integrante, "[$idActividad]logros")
					->label('Logros')
					->textarea([ 'title' => 'Indique los resultados de avance que permitan constatar que, por medio de las actividades realizadas, se está logrando sensibilizar a la comunidad sobre la importancia del arte y la cultura a través de la oferta cultural del municipio para fortalecer el vínculo comunidad-escuela mediante el mejoramiento de la oferta en artes y cultura desde las instituciones educativas oficiales para la ocupación del tiempo libre en las comunas y corregimientos de Santiago de Cali' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]fortalezas")
					->label( 'Fortalezas' )
					->textarea([ 'title' => 'Describa las fortalezas que se detectaron en el desarrollo de la actividad para potenciar los objetivos del proyecto.' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]debilidades")
					->label( 'Debilidades' )
					->textarea([ 'title' => 'Describa las debilidades, dificultades, problemas que se le presentaron en el desarrollo de la actividad y que pueden afectar negativamente el  cumplimiento de los objetivos del proyecto' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]alternativas")
					->label('Alternativas')
					->textarea([ 'title' => 'Describa las decisiones y acciones adoptadas por su equipo para superar las dificultades presentadas.' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]retos")
					->label('Retos')
					->textarea([ 'title' => 'Condiciones externas a tener en cuenta y que pueden afectar o beneficiar el logro de  los objetivos del proyecto.' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]articulacion")
					->label('Articulación')
					->textarea([ 'title' => 'Resultado de la articulación con otros proyectos de la iniciativa MCEE (Si aplica)' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]evaluacion")
					->label('Evaluación')
					->textarea([ 'title' => 'Si se realizó evaluación de las actividades desarrolladas, describa el método y nombre del documento' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]observaciones_generales")
					->label('Observaciones generales')
					->textarea([ 'title' => 'Mencione temas identificados y aspectos adicionales que deban considerarse en el proceso que se sigue en esta sede' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]alarmas")
					->label('Alarmas')
					->textarea([ 'title' => 'Situaciones emergentes que pueden impedir el desarrollo de actividades y/o el logro de objetivos' , 'data-toggle' => 'tooltip' ]) ?>
	</div>
	
</div>

<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]justificacion_activiad_no_realizada")
				->label('Si la actividad no se realizó explique por qué')
				->textarea($array1) ?>
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
								'options' => $array2,
						]); ?>
	</div>
	
</div>


<div class="row">

	<div class="col-md-6">
		<?= $form->field($integrante, "[$idActividad]fecha_diligencia")->textInput( ['readonly' => true] ) ?>
	</div>
	
</div>


<!-- ----------------- FIN IsaActividadesRomXIntegranteGrupo -------------------------------- -->


