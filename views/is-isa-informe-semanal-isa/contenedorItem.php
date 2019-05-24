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

use app\models\IsaRomActividades;
use app\models\IsaReporteOperativoMisional;
use app\models\IsaRomProyectos;
use app\models\Parametro;
use app\models\IsaActividadesRom;
use app\models\IsaRomProcesos;
use app\models\IsaEvidenciasRom;
use app\models\IsaIntervencionIeo;
use app\models\IsaActividadesRomXIntegranteGrupo;
use app\models\IsaTipoCantidadPoblacionRom;
use app\models\Personas;
use app\models\IsaEquiposCampo;
use yii\helpers\ArrayHelper;

use yii\helpers\Json;


















$nroSemana = empty( $_POST['nroSemana'] ) ? 0 : $_POST['nroSemana'];

$coordinadoresTecnico = [];

$sesiones_realizadas 	= 0;
$sesiones_aplazadas 	= 0;
$sesiones_canceladas 	= 0;

$total = 0;
$total += $vecinos 					= 0;
$total += $lideres_comunitarios 	= 0;
$total += $empresarios_comerciantes = 0;
$total += $organizaciones_locales 	= 0;
$total += $grupos_comunitarios 		= 0;
$total += $otos_actores 			= 0;

$actas 				= 0;
$reportes 			= 0;
$listados 			= 0;
$plan_trabajo 		= 0;
$formato_seguimiento= 0;
$formato_evaluacion = 0;
$fotografias 		= 0;
$vidoes 			= 0;
$otros_productos 	= 0;


$equipos 				= [];
$fortalezas 				= [];
$debilidades 				= [];
$alternativas 				= [];
$retos 						= [];
$articulacion 				= [];
$evaluacion 				= [];
$observaciones_generales 	= [];
$alarmas 					= [];
$logros 					= [];
$duracion 					= 0;
$totalSesiones				= 0;




// $model = IsaActividadesRom::findOne([
								// 'estado' => 1,
								// 'id_rom_actividad' 				=> $romActividad,
								// 'sesion_actividad' 				=> $sesionActividad,
								// 'id_reporte_operativo_misional' => $id_reporte,
								// 'nro_semana' 					=> $nro_semana,
							// ]);



	$id_perfil_persona = $_SESSION['id'];


	$idInstitucion 	= $_SESSION['instituciones'][0];
	$id_sede 		= $_SESSION['sede'][0];


	$rom = IsaReporteOperativoMisional::findOne([
						'estado'			=> 3,
						'id_institucion' 	=> $idInstitucion,
						'id_sedes' 			=> $id_sede,
					]);

	if( $rom ){

		$id = $rom->id;

		$proyectos = new IsaRomProyectos();
		$proyectos = $proyectos->find()
							->alias( 'py' )
							->innerJoin( 'isa.rom_procesos p', 'p.id_rom_proyectos=py.id' )
							->innerJoin( 'isa.rom_actividades a', 'a.id_rom_procesos=p.id' )
							->innerJoin( 'isa.evidencias_rom er', 'er.id_rom_actividad = a.id' )
							->where('py.estado=1')
							->andWhere('a.estado=1')
							->andWhere('p.estado=1')
							->andWhere( 'er.id_reporte_operativo_misional='.$id )
							->groupby("py.id")
							->orderby("py.id")
							->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		$dataParametros = Parametro::find()
							// ->where( "id_tipo_parametro=$idTipoParametro" )
							->where( 'estado=1' )
							->orderby( 'id' )
							->all();
							
		$parametros		= ArrayHelper::map( $dataParametros, 'id', 'descripcion' );
		
		$datos = [];
		
		foreach( $proyectos as $idProyecto => $descripcionProyecto )
		{
			$proy = [
						'id' 				=> $idProyecto,
						'descripcion' 		=> $descripcionProyecto,
						'actividades_rom2'	=> IsaActividadesRom::findOne([ 
																	'id_reporte_operativo_misional' => $id,
																	'estado' 						=> 1,
																	'nro_semana' 					=> $nroSemana,
																	'id_rom_actividad' 				=> $index,
																]),
						'procesos'			=> [],
					];
			
			$dataProcesos = IsaRomProcesos::find()
								->alias( 'p' )
								->innerJoin( 'isa.rom_actividades a', 'a.id_rom_procesos=p.id' )
								->innerJoin( 'isa.evidencias_rom er', 'er.id_rom_actividad = a.id' )
								->where( "p.id_rom_proyectos=".$idProyecto )
								->andWhere('a.estado=1')
								->andWhere('p.estado=1')
								->andWhere( 'er.id_reporte_operativo_misional='.$id )
								->groupby("p.id")
								->all();
								
			$procesos = ArrayHelper::map($dataProcesos,'id','descripcion');
			
			foreach( $procesos as $idProceso => $descripcionProceso )
			{
				$procs = 	[
								'id' 			=> $idProceso,
								'descripcion' 	=> $descripcionProceso,
								'actividades'	=> [],
							];
							
				$evidencias = IsaEvidenciasRom::find()
										->alias('er')
										->innerJoin( 'isa.rom_actividades a', 'a.id=er.id_rom_actividad' )
										->where('er.estado=1')
										->andWhere('a.estado=1')
										->andWhere('a.id_rom_procesos='.$idProceso)
										->andWhere( 'er.id_reporte_operativo_misional='.$id )
										->all();
				// $evidencias = ArrayHelper::map($evidencias,'id','descripcion');
				
				
					   
				foreach( $evidencias as $evidencia )
				{
					$actividades_rom_upt = IsaActividadesRom::findOne([ 
															'id_reporte_operativo_misional' => $id,
															'id_rom_actividad' 				=> $evidencia->id_rom_actividad,
															'estado' 						=> 1,
														]);
														
					$dataActividadesParticipadas= IsaIntervencionIeo::findOne( $actividades_rom_upt->sesion_actividad );
										
					$actividadesParticipadas 	= [ $dataActividadesParticipadas->id => $dataActividadesParticipadas->nombre_actividad ];
					
					$modelIntegrante 			= IsaActividadesRomXIntegranteGrupo::find()
															->where( 'estado=1' )
															// ->andWhere( 'diligencia=$id_perfil_persona' )
															->andWhere( 'id_rom_actividad='.$index /*$evidencia->id_rom_actividad*/ )
															->andWhere( 'id_reporte_operativo_misional='.$id )
															->all();
																
					// if( !$modelIntegrante ){
						// $modelIntegrante = new IsaActividadesRomXIntegranteGrupo();
					// }
					
					//Array de actividades
					$act =  [
								'id' 						=> $evidencia->id_rom_actividad,
								'descripcion' 				=> IsaRomActividades::findOne( $evidencia->id_rom_actividad )->descripcion,
								'actividades_rom'			=> $actividades_rom_upt,
								'evidencia'					=> $evidencia,
								'poblacion'					=> IsaTipoCantidadPoblacionRom::findOne([ 
																	'estado' 						=> 1, 
																	'id_rom_actividades' 			=> $evidencia->id_rom_actividad,
																	'id_reporte_operativo_misional' => $id,
																]),
								// 'integrante'				=> $modelIntegrante,
								'datosSoloLectura' 			=> IsaIntervencionIeo::findOne([
																	'id' 		=> $actividades_rom_upt->sesion_actividad,
																	'estado' 	=> 1,
																]),
																
								'actividadesParticipadas' 	=> $actividadesParticipadas,
								// 'datos_adicionales' 		=> Json::decode( $this->actionConsultarIntervencionIeo( $dataActividadesParticipadas->id ) ),
							];
					
					//Adiciono la actividad al proceso
					$procs[ 'actividades' ][] = $act;
					
					
					
					
					
					/***************************************************************************************************************************************
					 * Calculando
					 *
					 * ============================++++++++++++++++++++++??????????????++++++++++++++++
					 ***************************************************************************************************************************************/
					 
					$coordinadoresTecnico[] = Personas::findOne( $dataActividadesParticipadas->docente_orientador );
					$equipos[] 				= IsaEquiposCampo::findOne( $dataActividadesParticipadas->id_equipo_campos );
					 
					$sesiones_realizadas 	+= $actividades_rom_upt->estado_actividad == 179;
					$sesiones_aplazadas 	+= $actividades_rom_upt->estado_actividad == 180;
					$sesiones_canceladas 	+= $actividades_rom_upt->estado_actividad == 181;
					
					
					
					
					$propiedades = array( "actas", "reportes", "listados", "plan_trabajo", "formato_seguimiento", "formato_evaluacion", "fotografias", "vidoes", "otros_productos");
					$actas 				+= count( explode( ',', $evidencia->actas ) );
					$reportes 			+= count( explode( ',', $evidencia->reportes ) );
					$listados 			+= count( explode( ',', $evidencia->listados ) );
					$plan_trabajo 		+= count( explode( ',', $evidencia->plan_trabajo ) );
					$formato_seguimiento+= count( explode( ',', $evidencia->formato_seguimiento ) );
					$formato_evaluacion += count( explode( ',', $evidencia->formato_evaluacion ) );
					$fotografias 		+= count( explode( ',', $evidencia->fotografias ) );
					$vidoes 			+= count( explode( ',', $evidencia->vidoes ) );
					$otros_productos 	+= count( explode( ',', $evidencia->otros_productos ) );
					
					
					
					$total += $vecinos 					+= $act[ 'poblacion' ]->vecinos;
					$total += $lideres_comunitarios 	+= $act[ 'poblacion' ]->lideres_comunitarios;
					$total += $empresarios_comerciantes	+= $act[ 'poblacion' ]->empresarios_comerciantes;
					$total += $organizaciones_locales 	+= $act[ 'poblacion' ]->organizaciones_locales;
					$total += $grupos_comunitarios 		+= $act[ 'poblacion' ]->grupos_comunitarios;
					$total += $otos_actores 			+= $act[ 'poblacion' ]->otos_actores;
					
					foreach( $modelIntegrante as $key => $integrante ){
						
						$fortalezas[] 				= $integrante->fortalezas;
						$debilidades[] 				= $integrante->debilidades;
						$alternativas[] 			= $integrante->alternativas;
						$retos[] 					= $integrante->retos;
						$articulacion[] 			= $integrante->articulacion;
						$evaluacion[] 				= $integrante->evaluacion;
						$observaciones_generales[] 	= $integrante->observaciones_generales;
						$alarmas[] 					= $integrante->alarmas;
						$logros[] 					= $integrante->logros;
						$duracion					+=$integrante->duracion_sesion;
						$totalSesiones++;
					}
					/****************************************************************************************************************************************/
					
					
					
					
				}
				
				$proy['procesos'][] = $procs;
			}
			
			$datos[] = $proy;
		}
	}










































    if($index == 1 || $index == 2 || $index == 3){?>
        <div style ="display : none">
            <?= $form->field($actividades_is_isa, "[$index]id_componente")->textInput(["value" => 1]) ?>
            <?= $form->field($actividades_is_isa, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }else{ ?>
        <div style ="display : none">
            <?= $form->field($actividades_is_isa, "[$index]id_componente")->textInput(["value" => 2]) ?>
            <?= $form->field($actividades_is_isa, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }

    if($index == 1){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 1. Realizar encuentros de sensibilización sobre el valor del arte y la cultura en la comunidad, desde las instituciones educativas oficiales.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 1. Realizar encuentros de sensibilización sobre el valor del arte y la cultura en la comunidad, desde las instituciones educativas oficiales."])->label(false); ?>
    <?php
    }
    if($index == 2){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 2: Realizar visitas eventos culturales de la ciudad para sensibilizar en torno a la importancia de la iniciación artística.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 2: Realizar visitas eventos culturales de la ciudad para sensibilizar en torno a la importancia de la iniciación artística."])->label(false); ?>
    <?php
    }
    if($index == 3){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 3: Promover la oferta cultural del municipio para sensibilización e iniciación artística.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 3: Promover la oferta cultural del municipio para sensibilización e iniciación artística."])->label(false); ?>
    <?php
    }
    if($index == 4){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 4: Realizar talleres de iniciación y sensibilización artística con la comunidad.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 4: Realizar talleres de iniciación y sensibilización artística con la comunidad."])->label(false); ?>
    <?php
    }
?>
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividade_is_isa, "[$index]sesiones_realizadas")->textInput([ 'value' => $sesiones_realizadas ]) ?> </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividade_is_isa, "[$index]porcentaje")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividade_is_isa, "[$index]sesiones_aplazadas")->textInput([ 'value' => $sesiones_aplazadas ]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividade_is_isa, "[$index]sesiones_canceladas")->textInput([ 'value' => $sesiones_canceladas ]) ?></div>
	</div>
    
    
    <?= $form->field($actividade_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>
	
	<div class="row">
		<div class="col-md-4"><?= $form->field($actividades_is_isa, "[$index]duracion")->textInput([ 'value' =>  $totalSesiones ? $duracion/$totalSesiones : 0 ]) ?></div>
		<div class="col-md-4">
			<label>Coordinador técnico pedagógico</label>
			<?php 
				// if( $coordinadoresTecnico )
					// foreach( $coordinadoresTecnico as $key => $value ){
						// echo $form->field($actividades_is_isa, "[$index]docente")->textInput([ 'value'=> $value->nombres." ".$value->apellidos ])->label(false);
					// }
			?>
		</div>
		<div class="col-md-4">
			<label>Equipos</label>
			<?php 
				if( count( $equipos ) > 0 )
				{
					foreach( $equipos as $key => $value ){
						echo $form->field($actividades_is_isa, "[$index]docente")->textInput([ 'value'=> $value->nombre ])->label(false);
					}
				}
			?>
		</div>
	</div>


    <h2 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h2>
    <h3 style='background-color: #ccc;padding:5px;'>Número de participantes por actividad comunitaria por sede educativa.</h3>
    
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;<?= $form->field($tipo_poblacion_is_isa, "[$index]vecinos")->textInput([ 'value' => $vecinos]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;<?= $form->field($tipo_poblacion_is_isa, "[$index]lider_comunitario")->textInput([ 'value' => $lideres_comunitarios]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($tipo_poblacion_is_isa, "[$index]empresarios_comerciantes")->textInput([ 'value' => $empresarios_comerciantes]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;<?= $form->field($tipo_poblacion_is_isa, "[$index]representantes")->textInput([ 'value' => $organizaciones_locales]) ?></div>
	</div>
	
    
    <div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($tipo_poblacion_is_isa, "[$index]miembros_asociados")->textInput([ 'value' => $grupos_comunitarios]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($tipo_poblacion_is_isa, "[$index]otros_actores")->textInput([ 'value' => $otos_actores]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($tipo_poblacion_is_isa, "[$index]total")->textInput([ 'value' => $total]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
	</div>
   
    
    
    
    <?= $form->field($tipo_poblacion_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>


    <h3 style='background-color: #ccc;padding:5px;'>Evidencias (Cantidad  de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
    <div class="row">
		<div class="col-md-6"><label>ACTAS (Cantidad)</label></div>
		<div class="col-md-6"><label>REPORTES (Cantidad)</label></div>
	</div>
	
	<div class="row">
		<div class="col-md-6"><label><?=$actas?></label></div>
		<div class="col-md-6"><label><?=$reportes?></label></div>
	</div>
	
	<div class="row">
		<div class="col-md-6"><label>LISTADOS (Cantidad)</label></div>
		<div class="col-md-6"><label>PLAN DE TRABAJO (Cantidad)</label></div>
	</div>
	
		<div class="row">
		<div class="col-md-6"><label><?=$listados?></label></div>
		<div class="col-md-6"><label><?=$plan_trabajo?></label></div>
	</div>
	<div class="row">
		<div class="col-md-6"><label>FORMATOS DE SEGUIMIENTO (Cantidad)</label></div>
		<div class="col-md-6"><label>FORMATOS DE EVALUACIÓN (Cantidad)</label></div>
	</div>
	
		<div class="row">
		<div class="col-md-6"><label><?=$formato_seguimiento?></label></div>
		<div class="col-md-6"><label><?=$formato_evaluacion?></label></div>
	</div>
   
    <div class="row">
			<div class="col-md-6"><label>FOTOGRAFÍAS (Cantidad)</label></div>
			<div class="col-md-6"><label>VIDEOS (Cantidad)</label></div>
	</div>
		<div class="row">
		<div class="col-md-6"><label><?=$fotografias?></label></div>
		<div class="col-md-6"><label><?=$vidoes?></label></div>
	</div>
    
	<div class="row">
		<div class="col-md-6"><label>Otros productos  de la actividad</label></div>
		<div class="col-md-6"><?=$otros_productos?></div>
	</div>
    
	

     
	<div class="row">
		<div class="col-md-6">
			<label class="control-label" for="isisaactividadesisisa-1-retos">Logros</label>
			<?php 
				foreach( $logros as $key => $value ){
					
					echo $form->field($actividades_is_isa, "[$index]logros")->textarea(['value' => $value])->label(false);
				} 
			?>
		</div>
	</div>
    <h3 style='background-color: #ccc;padding:5px;'>Variaciones en la implementación del proyecto:</h3>
    <h3 style='background-color: #ccc;padding:5px;'>Situaciones de dificultad y/o ventaja, surgidos o presentes durante el periodo,  que influyen en el cumplimiento de los objetivos.</h3>
    <div class="row">
	  <div class="col-md-6">
		<label class="control-label" for="isisaactividadesisisa-1-retos">Debilidades</label>
			<?php 
				if( count( $debilidades ) > 0 )
				{
					foreach( $debilidades as $key => $value ){
						
						echo $form->field($actividades_is_isa, "[$index]variaciones_devilidades")->textarea(['value' => $value])->label(false);
					} 
				}
			?>
		</div>
	  
	   <div class="col-md-6">
		<label class="control-label" for="isisaactividadesisisa-1-retos">Fortalezas</label>
			<?php 
				if( count( $fortalezas ) > 0 )
				{	
					foreach( $fortalezas as $key => $value ){
						
						echo $form->field($actividades_is_isa, "[$index]variaciones_fortalezas")->textarea(['value' => $value])->label(false);
					} 
				}
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
		<label class="control-label" for="isisaactividadesisisa-1-retos">Retos</label>
			<?php 
				if( count( $retos ) > 0 )
				{
					foreach( $retos as $key => $value ){
						
						echo $form->field($actividades_is_isa, "[$index]retos")->textarea(['value' => $value])->label(false);
					} 
				} 
			?>
		</div>
	  
	  <div class="col-md-6">
		<label class="control-label" for="isisaactividadesisisa-1-retos">Retos</label>
			<?php 
				if( count( $articulacion ) > 0 )
				{	
					foreach( $articulacion as $key => $value ){
						
						echo $form->field($actividades_is_isa, "[$index]articulacion")->textarea(['value' => $value])->label(false);
					} 
				}
			?>
		</div>
	</div>
    
    <div class="row">
		<div class="col-md-6">
			<label class="control-label" for="isisaactividadesisisa-1-alrmas">Logros</label>
			<?php 
				if( count( $alarmas ) > 0 )
				{
					foreach( $alarmas as $key => $value ){
						
						echo $form->field($actividades_is_isa, "[$index]alrmas")->textarea(['value' => $value])->label(false);
					} 
				} 
			?>
		</div>
	  <div class="col-md-6"><?= $form->field($actividades_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?></div>
	</div>
    
    
    

