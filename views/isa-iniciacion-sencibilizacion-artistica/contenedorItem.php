<?php
/********************
Modificaciones:
Fecha: 11-04-2019
Persona encargada: Viviana Rodas
Cambios realizados: Se agrega bootstrap al formulario
----------------------------------------
**********/

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\web\helpers\CHtml;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\IsaActividadesIsa;
use app\models\IsaIntervencionIeo;
use yii\helpers\ArrayHelper;
use nex\chosen\Chosen; 
use yii\helpers\Url;




//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	//traer el id de la tabla isa.actividades_isa para luego traer el modelo con los datos correspondintes
	$isa = new IsaActividadesIsa();
	$isa = $isa->find()->where("id_procesos_generales = $idProceso and id_iniciacion_sencibilizacion_artistica=". $model->id)->all();
	$isa = ArrayHelper::map($isa,'id','id_procesos_generales');
	
	//traer el modelo con los datos de cada actividad
	$actividades_isa = IsaActividadesIsa::findOne(key($isa));
	
	//trae la informacion del modelo IsaIntervencionIeo (esto es temporal mientras se adecua para hacerlo multiple)
	$intervencionIEO = IsaIntervencionIeo::findOne(key($isa));
}


?>

<style>
.modal {
  overflow-y:auto;
}
</style>

<script>

</script>
    <h3 style='background-color: #ccc;padding:5px;'>Fecha prevista para realizar la actividad</h3>
	<div class="row">
	  <div class="col-md-6">
	  
	  
	  <?= $form->field($actividades_isa, "[$idProceso]fecha_prevista_desde")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?></div>
	  <div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]fecha_prevista_hasta")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> </div>
	</div>
     

<div class="intervencion" style="border:1px solid #46a3dc;padding:1%;border-radius:1%;margin-bottom:3%" id="intervencion-0">  
   <h3 style='background-color: #ccc;padding:5px;'>Equipo o equipos de intervención encargado(s) </h3>
   <div class="row">
	  <div class="col-md-8">
	  
	  <?= $form->field($intervencionIEO, "[$idProceso]id_equipo_campos")->widget(
		Chosen::className(), [
			'items' => $equiposCampo,
			'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
            'multiple' => false,
			'placeholder' => 'Seleccione...',
            'clientOptions' => [
                'search_contains' => true,
                'single_backstroke_delete' => false,
            ],
	])->label("Equipos Campo"); ?></div>
	  <div class="col-md-4">
        <?=  Html::button('Agregar Equipo Campo',['value'=> "index.php?r=isa-equipos-campo%2Fcreate" ,'class'=>'btn btn-success','id'=>'modalEquipo']) ?>
		
		</div>
	</div>
	
	<div id="modalCampo" class="fade modal" role="dialog" tabindex="-1" >
		<div class="modal-dialog modal-md">
			<div class="modal-content" style="margin-top:138%; margin-left:0%">
				<div class="modal-header">
					<h3>Agregar Equipo Campo</h3>
				</div>
				<div class="modal-body">
					<div id='modalContenido'></div>
				</div>
			</div>
		</div>
	</div>
	
	
	
   <div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIEO, "[$idProceso]perfiles")->textInput(['title'=>'Seleccione el perfil y cantidad por perfiles de profesionales en campo', 'data-toggle'=>'tooltip']) ?></div>
	  <div class="col-md-6">
	  
	  <?= $form->field($intervencionIEO, "[$idProceso]docente_orientador")->widget(
						Chosen::className(), [
							'items' => $docenteOrientador,
							'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
							'multiple' => true,
							'clientOptions' => [
								'search_contains' => true,
								'single_backstroke_delete' => false,
							],
                            'placeholder' => 'Seleccione..',
					])->label("Lider técnico pedagógico")?></div>
	</div>


	<div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIEO, "[$idProceso]fases")->textInput( ['title'=>'Indique la fase del Proyecto MCEE desde las Artes y las Culturas en el que se encuentra la actividad', 'data-toggle'=>'tooltip']) ?></div>
	  <div class="col-md-6"><?= $form->field($intervencionIEO, "[$idProceso]num_encuentro")->textInput([ 'type' => 'number' , 'title'=>'Indique el número del encuentro según la propuesta metodológica ', 'data-toggle'=>'tooltip']) ?></div>
	</div>
   
	<div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIEO, "[$idProceso]nombre_actividad")->textInput() ?></div>
	  <div class="col-md-6"> <?= $form->field($intervencionIEO, "[$idProceso]actividad_desarrollar")->textArea(['title'=>'Didácticas que estructuran el encuentro', 'data-toggle'=>'tooltip']) ?></div>
	</div>
   
   <div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIEO, "[$idProceso]lugares_recorrer")->textArea() ?></div>
	  <div class="col-md-6"><?= $form->field($intervencionIEO, "[$idProceso]tematicas_abordadas")->textArea() ?></div>
	</div>
  
	<div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIEO, "[$idProceso]objetivos_especificos")->textArea(['title'=>'Especifique cómo se espera lograr, con cada una de las actividades, sensibilizar a la comunidad sobre la importancia del arte y la cultura a través de la oferta cultural del municipio para fortalecer el vínculo comunidad-escuela mediante el mejoramiento de la oferta en artes y cultura desde las instituciones educativas oficiales para la ocupación del tiempo libre en las comunas y corregimientos de Santiago de Cali.', 'data-toggle'=>'tooltip']) ?></div>
	  <div class="col-md-6"><?= $form->field($intervencionIEO, "[$idProceso]tiempo_previsto")->textInput([ 'type' => 'number']) ?></div>
	</div>
	
    <div class="row">
	  <div class="col-md-6"> <?= $form->field($intervencionIEO, "[$idProceso]productos")->textArea(['title'=>'Describa los resultados o productos esperados.', 'data-toggle'=>'tooltip']) ?></div>
	</div> 

  
</div>

<!-- <button id="btnAgregarObj" type="button" class="btn btn-primary" value="0" >Agregar Actividades</button>   -->

   <h3 style='background-color: #ccc;padding:5px;'>¿El contenido de esta actividad  responde al plan de acción construido colectivamente para la institución desde la articulación de la estrategia MCEE?</h3>
   
   
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6"> <?= $form->field($actividades_isa, "[$idProceso]contenido_si_no")->dropDownList($arraySiNo ) ?></div>
		</div>

		<div class="row">
			<div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]contenido_nombre")->textInput() ?></div>
			<div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]contenido_fecha")->widget(
			DatePicker::className(), [
				// modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
				'autoclose' => true,
				'format'    => 'yyyy-mm-dd',
				],
			]);  ?> </div>
		</div>
		<div class="row">
			<div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]contenido_justificacion")->textInput() ?></div>
			<div class="col-md-6"></div>
		</div>
	</div>
</div>   

<div class="panel panel-info">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]articulacion")->textInput(['title'=>'Si es el caso, describa cómo la actividad o actividades planeadas se articulan con las actividades de otros proyectos de la iniciativa MCEE', 'data-toggle'=>'tooltip']) ?></div>
			<div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]cantidad_participantes")->textInput(['title'=>'Indique el número de personas que espera que participen de la actividad, considerando la convocatoria realizada por su equipo', 'data-toggle'=>'tooltip']) ?></div>
		</div>
	</div>
</div>
  
   
   <h3 style='background-color: #ccc;padding:5px;'>Recursos previstos para realizar la actividad</h3>
   <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]requerimientos_tecnicos")->textInput(['title'=>'Indique los requerimientos  técnicos,  materiales y de espacio', 'data-toggle'=>'tooltip']) ?></div>
	  <div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]requerimientos_logisticos")->textInput(['title'=>'Indique los requerimientos  logísticos, No. de refrigerios, No. de vehículos y capacidad de transporte, etc.', 'data-toggle'=>'tooltip']) ?></div>
   </div>
   
   
   <h3 style='background-color: #ccc;padding:5px;'>Programación: Entrega o envío de la programación de la actividad a los participantes,  líderes comunitarios o directivas de la institución</h3>
   <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]destinatarios")->textInput() ?></div>
	  <div class="col-md-6"> <?= $form->field($actividades_isa, "[$idProceso]fecha_entrega_envio")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> </div>
   </div>
   
  <div class="row">
	  <div class="col-md-6"> <?= $form->field($actividades_isa, "[$idProceso]observaciones_generales")->textArea(['title'=>'Mencione aspectos adicionales que deban considerarse en la planeación de la actividad', 'data-toggle'=>'tooltip']) ?></div>
	  <div class="col-md-6"></div>
  </div>
  
   <h3 style='background-color: #ccc;padding:5px;'>Diligenciamiento del Plan de Actividades</h3>
   <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]nombre_diligencia")->textInput(["value" => $_SESSION['nombres']." ".$_SESSION['apellidos'],'disabled' => 'disabled']) ?></div>
	  <div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]rol")->textInput() ?></div>
	</div>
   
  <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]fecha")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> </div>
	  <div class="col-md-6"><?= $form->field($actividades_isa, "[$idProceso]id_procesos_generales")->hiddenInput(["value" => $idProceso])->label(false);?></div>
  </div>
   
	
	 