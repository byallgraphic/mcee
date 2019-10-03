<?php

// use yii\bootstrap\Html;
// use yii\bootstrap\ActiveForm;

// use dosamigos\datepicker\DatePicker;



















































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
use app\models\PerfilesXPersonasInstitucion;
use app\models\PerfilesXPersonas;
use app\models\IsaEquiposCampo;
use yii\helpers\ArrayHelper;

use yii\helpers\Json;

//comenzando a calcular datos

$nroSemana 		= empty( $_POST['nroSemana'] ) ? 1 : $_POST['nroSemana'];
// $fecha_desde 	= empty( $_POST['fecha_desde'] ) ? date( "Y-m-d" ) : $_POST['fecha_desde'];
// $fecha_hasta 	= empty( $_POST['fecha_hasta'] ) ? date( "Y-m-d" ) : $_POST['fecha_hasta'];

$fecha_desde 	= empty( $_POST['fecha_desde'] ) ? '' : $_POST['fecha_desde']."-01";
$fecha_hasta 	= empty( $_POST['fecha_desde'] ) ? '' : date( "Y-m-t", strtotime( $_POST['fecha_desde'] ) );

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


$idsEvidencias				= [];
$equipos 					= [];
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
$total_actividades			= 0;
$porcetaje_actividades		= 0;

	$id_perfil_persona = $_SESSION['id'];


	$idInstitucion 	= $_SESSION['instituciones'][0];
	$id_sede 		= $_SESSION['sede'][0];



	if( !empty($fecha_desde) && !empty($fecha_hasta) )
	{
		// $rom = IsaReporteOperativoMisional::findOne([
							// 'estado'			=> 1,
							// 'id_institucion' 	=> $idInstitucion,
							// 'id_sedes' 			=> $id_sede,
						// ]);
						
		$roms = IsaActividadesRom::find()
						->where( 'id_rom_actividad='.$index )
						->andWhere( 'estado=1' )
						// ->andWhere( "fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' OR fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' " )
						->andWhere( "fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'" )
						->all();
						
		foreach( $roms as $rom )
		{
			$id = $rom->id_reporte_operativo_misional;

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
				// $proy = [
							// 'id' 				=> $idProyecto,
							// 'descripcion' 		=> $descripcionProyecto,
							// 'actividades_rom2'	=> IsaActividadesRom::findOne([ 
																		// 'id_reporte_operativo_misional' => $id,
																		// 'estado' 						=> 1,
																		// 'nro_semana' 					=> $nroSemana,
																		// 'id_rom_actividad' 				=> $index,
																	// ]),
							// 'procesos'			=> [],
						// ];
				
				$dataProcesos = IsaRomProcesos::find()
									->alias( 'p' )
									->innerJoin( 'isa.rom_actividades a', 'a.id_rom_procesos=p.id' )
									->innerJoin( 'isa.evidencias_rom er', 'er.id_rom_actividad = a.id' )
									->where( "p.id_rom_proyectos=".$idProyecto )
									->andWhere('a.estado=1')
									->andWhere('p.estado=1')
									->andWhere( 'er.id_reporte_operativo_misional='.$id )
									->andWhere( 'er.id_rom_actividad='.$index )
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
											->andWhere( 'a.id='.$index )
											->all();
					// $evidencias = ArrayHelper::map($evidencias,'id','descripcion');
					
					foreach( $evidencias as $evidencia )
					{
						$propiedades = array( "actas", "reportes", "listados", "plan_trabajo", "formato_seguimiento", "formato_evaluacion", "fotografias", "vidoes", "otros_productos");
							$actas 				+= empty( $evidencia->actas ) ? 0 : count( explode( ',', $evidencia->actas ) );
							$reportes 			+= empty( $evidencia->reportes ) ? 0 : count( explode( ',', $evidencia->reportes ) );
							$listados 			+= empty( $evidencia->listados ) ? 0 : count( explode( ',', $evidencia->listados ) );
							$plan_trabajo 		+= empty( $evidencia->plan_trabajo ) ? 0 : count( explode( ',', $evidencia->plan_trabajo ) );
							$formato_seguimiento+= empty( $evidencia->formato_seguimiento ) ? 0 : count( explode( ',', $evidencia->formato_seguimiento ) );
							$formato_evaluacion += empty( $evidencia->formato_evaluacion ) ? 0 : count( explode( ',', $evidencia->formato_evaluacion ) );
							$fotografias 		+= empty( $evidencia->fotografias ) ? 0 : count( explode( ',', $evidencia->fotografias ) );
							$vidoes 			+= empty( $evidencia->vidoes ) ? 0 : count( explode( ',', $evidencia->vidoes ) );
							$otros_productos 	+= empty( $evidencia->otros_productos ) ? 0 : count( explode( ',', $evidencia->otros_productos ) );
							
							$idsEvidencias[] = $evidencia->id;
					}
														
					$actividades_rom_upts = IsaActividadesRom::find()
												->where( 'id_reporte_operativo_misional='.$id )
												->andWhere( 'id_rom_actividad='.$index )
												->andWhere( 'estado=1' )
												// ->andWhere( 'nro_semana='.$nroSemana )
												->andWhere( "fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' OR fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' " )
												// ->andWhere( 'nro_semana=1' )
												->all();
					
					// if( $actividades_rom_upt )
					foreach( $actividades_rom_upts as $actividades_rom_upt )
					{
						$dataActividadesParticipadas= IsaIntervencionIeo::findOne( $actividades_rom_upt->sesion_actividad );
											
						$actividadesParticipadas 	= [ $dataActividadesParticipadas->id => $dataActividadesParticipadas->nombre_actividad ];
						
						/***************************************************************************************************************************************
						 * Calculando
						 *
						 * ============================++++++++++++++++++++++??????????????++++++++++++++++
						 ***************************************************************************************************************************************/
						
						$perfilXPesonaInstitucion 	= PerfilesXPersonasInstitucion::findOne( $dataActividadesParticipadas->docente_orientador );
						if( $perfilXPesonaInstitucion )
						{	
							$perfilXPesona			  	= PerfilesXPersonas::findOne( $perfilXPesonaInstitucion->id_perfiles_x_persona );
							$coordinadoresTecnico[]   	= Personas::findOne( $perfilXPesona->id_personas );
						}
						$eq 						= IsaEquiposCampo::findOne( $dataActividadesParticipadas->id_equipo_campos );
						if( $eq )
							$equipos[] 				= $eq;
						 
						$sesiones_realizadas 	+= $actividades_rom_upt->estado_actividad == 179;
						$sesiones_aplazadas 	+= $actividades_rom_upt->estado_actividad == 180;
						$sesiones_canceladas 	+= $actividades_rom_upt->estado_actividad == 181;
						$total_actividades++;
						
						$porcetaje_actividades = $sesiones_realizadas/$total_actividades;
						
						
						/****************************************************************************************************************************************/
					
					}
					
					$modelIntegrante 			= IsaActividadesRomXIntegranteGrupo::find()
																->where( 'estado=1' )
																// ->andWhere( 'diligencia=$id_perfil_persona' )
																->andWhere( 'id_rom_actividad='.$index /*$evidencia->id_rom_actividad*/ )
																->andWhere( 'id_reporte_operativo_misional='.$id )
																->all();
					
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
						$duracion					+= strtotime( $integrante->duracion_sesion." UTC"  );
						$totalSesiones++;
					}
					
					$poblaciones = IsaTipoCantidadPoblacionRom::find()
										->where('estado=1')
										->andWhere( 'id_rom_actividades='.$index )
										->andWhere( 'id_reporte_operativo_misional='.$id )
										->all();
					
					foreach( $poblaciones as $poblacion ){
						if( !empty($poblacion->vecinos ) )
							$total += $vecinos 					+= $poblacion->vecinos;
						
						if( !empty($poblacion->lideres_comunitarios ) )
							$total += $lideres_comunitarios 	+= $poblacion->lideres_comunitarios;
						
						if( !empty($poblacion->empresarios_comerciantes ) )
							$total += $empresarios_comerciantes	+= $poblacion->empresarios_comerciantes;
						
						if( !empty($poblacion->organizaciones_locales ) )
							$total += $organizaciones_locales 	+= $poblacion->organizaciones_locales;
							
						if( !empty($poblacion->grupos_comunitarios ) )
							$total += $grupos_comunitarios 		+= $poblacion->grupos_comunitarios;
							
						if( !empty($poblacion->otos_actores ) )
							$total += $otos_actores 			+= $poblacion->otos_actores;
					}
				}
				
				// $datos[] = $proy;
			}
		}
	}
	
	
	
	
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	





















$id_evidencia = 25;

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSensibilizacionArtisticaConsolidado */
/* @var $form yii\widgets\ActiveForm */
?>


    <?= Html::activeHiddenInput($actividad, '['.$index.']id') ?>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']total_sesiones_realizadas')->textInput(['readonly' => true, 'value' => $sesiones_realizadas]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;<?= $form->field($actividad, '['.$index.']avance_por_mes')->textInput(['readonly' => true, 'data-porcentaje' => $index, 'value' => $porcetaje_actividades ]) ?> </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']total_sesiones_aplazadas')->textInput(['readonly' => true, 'value' => $sesiones_aplazadas ]) ?> </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']total_sesiones_canceladas')->textInput(['readonly' => true, 'value' => $sesiones_canceladas ]) ?> </div>
	</div>
  
	
	<h3 style='background-color:#ccc;padding:5px;'><?="Número de participantes por actividad comunitaria por sede educativa." ?></h3>

	<div class="row">
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']vecinos')->textInput([ "data-participante" => $index, 'value' => $vecinos ]) ?></div>
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']lideres_comunitarios')->textInput([ "data-participante" => $index, 'value' => $lideres_comunitarios ]) ?></div>
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']empresarios_comerciantes_microempresas')->textInput([ "data-participante" => $index, 'value' => $empresarios_comerciantes ]) ?></div>
	</div>
	
	<div class="row">
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']representantes_organizaciones_locales')->textInput([ "data-participante" => $index, 'value' => $organizaciones_locales ]) ?></div>
	  <div class="col-md-4"><?= $form->field($actividad, '['.$index.']asociaciones_grupos_comunitarios')->textInput([ "data-participante" => $index, 'value' => $grupos_comunitarios ]) ?></div>
	  <div class="col-md-4">&nbsp;<?= $form->field($actividad, '['.$index.']otros_actores')->textInput([ "data-participante" => $index, 'value' => $otos_actores ]) ?></div>
	</div>
	
	<div class="row">
	  <div class="col-md-4"><?= Html::label( "Total de Participantes en la actividad." ) ?>
		
		<?= Html::textInput( $index."-total_participantes", "", [ 
					"class" 		=> "form-control", 
					"style" 		=> "background-color:#eee",
					"disabled" 		=> true, 
					"id" 			=> $index."-total_participantes", 
				] ) ?></div>
	  <div class="col-md-4"></div>
	  <div class="col-md-4"></div>
	</div>
	<div class="form-group">
	
		
		
	</div>

	<h3 style='background-color:#ccc;padding:5px;'><?="Evidencias (Indique la cantidad y destino de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )" ?></h3>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']actas')->textInput(['value' => $actas]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']reportes')->textInput(['value' => $reportes]) ?> </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']listados')->textInput(['value' => $listados]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']plan_trabajo')->textInput(['value' => $plan_trabajo]) ?></div>
	</div>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']formato_seguimiento')->textInput(['value' => $formato_seguimiento]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']formato_evaluacion')->textInput(['value' => $formato_evaluacion]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']fotografias')->textInput(['value' => $fotografias]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;<?= $form->field($actividad, '['.$index.']videos')->textInput(['value' => $vidoes]) ?></div>
	</div>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividad, '['.$index.']otros_productos')->textInput(['value' => $otros_productos]) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
	</div>
    

	<div class="col-md-12 text-right" style='display: <?= count( $idsEvidencias ) > 0 ? '' : 'none'?>' >
		<?=  Html::button('Ver archivos',['value' => "index.php?r=isa-iniciacion-sensibilizacion-artistica-consolidado/archivos-evidencias&id_evidencia=".implode( ",", $idsEvidencias)  ,'data-evidencia'=> "$id_evidencia" ,'class'=>'btn btn-success modalEquipo']) ?>
	</div>
    

    

    

    

    

    

    