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
use nex\chosen\Chosen;
use app\models\CbacPmoActividades;
use app\models\CbacIntervencionIeo;
use yii\helpers\ArrayHelper;

//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	// traer el id de la tabla cbac.pmo_actividades para luego traer el modelo con los datos correspondintes
	$pmo = new CbacPmoActividades();
	$pmo = $pmo->find()->where("id_actividad = $index and id_pmo =". $model->id)->all();
	$pmo = ArrayHelper::getColumn($pmo,'id');
	echo "aaaaa";
	echo "<pre>"; print_r($pmo); echo "</pre>"; 
	
	
	// echo $pmo[key($pmo)];
	// die;
	
	// traer el modelo con los datos de cada actividad
	$actividades_pom = CbacPmoActividades::findOne($pmo[key($pmo)]);
	//traer el modelo con los datos de cada actividad
	
	// $actividades_isa = IsaActividadesIsa::findOne(key($isa));
	
	
	$intervencionIeo = CbacIntervencionIeo::find()->Where("id_pmo_actividades=".$pmo[key($pmo)])->all();
	$intervencionIeo = ArrayHelper::map($intervencionIeo,'id','estado');
	
	
	// echo "<pre>"; print_r($intervencionIeo); echo "</pre>"; 
	

	$intervencionIeo = CbacIntervencionIeo::findOne(key($intervencionIeo));
	$intervencionIeo->perfiles =  explode(",", $intervencionIeo->perfiles);
}
?>

<style>
.modal {
  overflow-y:auto;
}
</style>
	<?= $form->field($actividades_pom, "[$index]id_actividad")->hiddenInput(["value" => $index])->label(false) ?>
	
    <h3 style='background-color: #ccc;padding:5px;'>Fecha prevista para realizar la actividad</h3>
    <div class="row">
	  <div class="col-md-4"><?= $form->field($actividades_pom, "[$index]desde")->widget(
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
	
    	<div id="modalCampo_<?=$index;?>" class="fade modal" role="dialog" tabindex="-1" >
		<div class="modal-dialog modal-md">
			<div class="modal-content" style="margin-top:138%; margin-left:0%">
				<div class="modal-header">
					<h3>Agregar Equipo Campo</h3>
				</div>
				<div class="modal-body">
					<div id='modalContenido_<?=$index;?>'></div>
				</div>
			</div>
		</div>
	</div>
	
<div class="intervencion" style="border:1px solid #46a3dc;padding:1%;border-radius:1%;margin-bottom:3%" id="intervencion-0">  
    <h3 style='background-color: #ccc;padding:5px;'>Equipo o equipos de intervención encargado(s)</h3>
    <div class="row">
	  <div class="col-md-8">
	  
	 
	  <?= $form->field($intervencionIeo, "[$index]id_equipo_campos")->widget(
						Chosen::className(), [
							'items' => $equiposCampo,
							'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
							'multiple' => false,
							'clientOptions' => [
								'search_contains' => true,
								'single_backstroke_delete' => false,
								'data-toggle'=>'tooltip'
							],
							'placeholder' => 'Seleccione',
					])?>
	  
	  </div>
	    <div class="col-md-4">
        <?=  Html::button('Agregar Equipo Campo',['value'=> "index.php?r=cbac-equipos-campo%2Fcrear-equipo" ,'class'=>'btn btn-success modalEquipo','id'=>"modalEquipo_$index"]) ?>
		
		</div>
	</div>
	
	
		  
	  
	<div class="row">
	  <div class="col-md-6">
	  
	  <?= 
	  
	  
	   $form->field($intervencionIeo, "[$index]perfiles")->widget(
						Chosen::className(), [
							'items' => $perfiles,
							'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
							'multiple' => true,
							'clientOptions' => [
								'search_contains' => true,
								'single_backstroke_delete' => false,
								'title'=>'Seleccione el perfil y cantidad por perfiles de profesionales en campo',
							'data-toggle'=>'tooltip',
							],
                            'placeholder' => 'Seleccione..',
					])?>
	  
	  </div>
	  
	  
	  
	  
	  <div class="col-md-6"><?= $form->field($intervencionIeo, "[$index]docente_orientador")->textInput([ 'value' => isset($datos[$index]['docentes']) ? $datos[$index]['docentes'] : '' ]) ?></div>
	</div>
	<div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIeo, "[$index]fases")->textInput([ 'title'=>'Indique la fase del Proyecto MCEE desde las Artes y las Culturas en el que se encuentra la actividad', 'data-toggle'=>'tooltip']) ?></div>
	  <div class="col-md-6"><?= $form->field($intervencionIeo, "[$index]num_encuentro")->textInput([ 'title'=>'Indique el número del encuentro según la propuesta metodológica ', 'data-toggle'=>'tooltip']) ?></div>
	</div>
    <div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIeo, "[$index]nombre_actividad")->textInput([ 'value' => isset($datos[$index]['nombre_actividad']) ? $datos[$index]['nombre_actividad'] : '' ]) ?></div>
	  <?php
        if($index == 7){
			echo '<div class="col-md-6">';
				echo  $form->field($intervencionIeo, "[$index]lugares_visitados")->textInput([ 'value' => isset($datos[$index]['lugares_visitados']) ? $datos[$index]['lugares_visitados'] : '' ]);
			echo '</div>';
		}else if($index == 2){
            echo '<div class="col-md-6">';
				echo  $form->field($actividades_pom, "[$index]penalistas_invitados")->textInput([ 'value' => isset($datos[$index]['penalistas_invitados']) ? $datos[$index]['penalistas_invitados'] : '' ]);
			echo '</div>';
		}
    ?>
	</div>
	
	<div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIeo, "[$index]actividad_desarrollar")->textArea([ 'rows'=>3,'cols'=>10,'title'=>'Didácticas que estructuran el encuentro', 'data-toggle'=>'tooltip' ]) ?></div>
	  <div class="col-md-6"><?= $form->field($intervencionIeo, "[$index]tematicas_abordadas")->textArea([ 'rows'=>3,'cols'=>10,'value' => isset($datos[$index]['tematicas']) ? $datos[$index]['tematicas'] : '' ]) ?></div>
	</div>
    
    <div class="row">
	  <div class="col-md-6"><?= $form->field($intervencionIeo, "[$index]objetivos_especificos")->textArea([ 'rows'=>3,'cols'=>10,'title'=>'Especifique cómo se espera lograr, con cada una de las actividades, sensibilizar a la comunidad sobre la importancia del arte y la cultura a través de la oferta cultural del municipio para fortalecer el vínculo comunidad-escuela mediante el mejoramiento de la oferta en artes y cultura desde las instituciones educativas oficiales para la ocupación del tiempo libre en las comunas y corregimientos de Santiago de Cali.', 'data-toggle'=>'tooltip' ]) ?></div>
	  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]productos")->textArea([ 'rows'=>3,'cols'=>10,'value' => isset($datos[$index]['productos']) ? $datos[$index]['productos'] : '' ]) ?></div>
	</div>

    <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]tiempo_previsto")->textInput() ?></div>
	  <div class="col-md-6"></div>
	</div>
        </div>

    <h3 style='background-color: #ccc;padding:5px;'>¿El contenido de esta actividad  responde al plan de acción construido colectivamente para la institución desde la articulación de la estrategia MCEE?</h3>
    <div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
			  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]contenido_si_no")->dropDownList( $arraySiNo ) ?></div>
			  <div class="col-md-6"></div>
			</div>
			<div class="row">
			  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]contenido_nombre")->textInput([ 'value' => isset($datos[$index]['contenido_nombre']) ? $datos[$index]['contenido_nombre'] : '' ]) ?></div>
			  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]contenido_fecha")->widget(
				DatePicker::className(), [
					// modify template for custom rendering
					'template' => '{addon}{input}',
					'language' => 'es',
					'clientOptions' => [
						'autoclose' => true,
						'format'    => 'yyyy-mm-dd',
				],
			]);  ?></div>
			</div>
		
			<div class="row">
			  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]contenido_justificacion")->textArea(['rows'=>3,'cols'=>10, 'value' => isset($datos[$index]['contenido_justificacion']) ? $datos[$index]['contenido_justificacion'] : '' ]) ?></div>
			  <div class="col-md-6"></div>
			</div>
		</div>
	</div>
    
	<div class="panel panel-info">
		<div class="panel-body">
			<div class="row">
			  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]acticulacion")->textInput([ 'value' => isset($datos[$index]['acticulacion']) ? $datos[$index]['acticulacion'] : '' ]) ?></div>
			  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]cantidad_participantes")->textInput([ 'type'=>'number','value' => isset($datos[$index]['cantidad_participantes']) ? $datos[$index]['cantidad_participantes'] : '' ]) ?></div>
			</div>
		</div>
	</div>
   
    <h3 style='background-color: #ccc;padding:5px;'>Recursos previstos para realizar la actividad</h3>
    <div class="row">
	  <div class="col-md-6">
	  
	  
	  <?= $form->field($actividades_pom, "[$index]requerimientos_tecnicos")->widget(
						Chosen::className(), [
							'items' => $reqTecnicos,
							'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
							'multiple' => false,
							'clientOptions' => [
								'search_contains' => true,
								'single_backstroke_delete' => false,
								'title'=>'Indique los requerimientos  logísticos, No. de refrigerios, No. de vehículos y capacidad de transporte, etc.', 
								'data-toggle'=>'tooltip'
							],
							'placeholder' => 'Seleccione',
					])?>

	  
	  <div class="chosen-container-multi" title="" id="reqTecnicos-<?php echo $index; ?>">
			<ul class="chosen-choices">
			</ul>
		</div>
	  
	  
	  
	  </div>
	  
	  
	  
	  <div class="col-md-6">
	  
	  
	  
	   <?= $form->field($actividades_pom, "[$index]requerimientos_logoisticos")->widget(
						Chosen::className(), [
							'items' => $reqLogisticos,
							'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
							'multiple' => false,
							'clientOptions' => [
								'search_contains' => true,
								'single_backstroke_delete' => false,
								'title'=>'Indique los requerimientos  logísticos, No. de refrigerios, No. de vehículos y capacidad de transporte, etc.', 
								'data-toggle'=>'tooltip'
							],
							'placeholder' => 'Seleccione',
					])?>
	  <div class="chosen-container-multi" title="" id="reqLogisticos-<?php echo $index; ?>">
			<ul class="chosen-choices">
			</ul>
		</div>
	  
	  </div>
	</div>

   <h3 style='background-color: #ccc;padding:5px;'>Programación: Entrega o envío de la programación de la actividad a las directivas o representantes de la institución</h3>
    <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]destinatarios")->textInput([ 'value' => isset($datos[$index]['destinatarios']) ? $datos[$index]['destinatarios'] : '' ]) ?></div>
	  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]fehca_entrega")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?></div>
	</div>
	
    <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]observaciones_generales")->textArea([ 'value' => isset($datos[$index]['observaciones_generales']) ? $datos[$index]['observaciones_generales'] : '' ]) ?></div>
	  <div class="col-md-6"></div>
	</div>
    
    <h3 style='background-color: #ccc;padding:5px;'>Diligenciamiento del Plan de Actividades</h3>
    <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]nombre_dilegencia")->textInput(["value" => $_SESSION['nombres']." ".$_SESSION['apellidos'],'disabled' => 'disabled']) ?></div>
	  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]rol")->DropDownList($rol,['disabled' => 'disabled']) ?></div>
	</div>
	
    <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_pom, "[$index]fehca")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?></div>
	  <div class="col-md-6"></div>
	</div>
    
    
