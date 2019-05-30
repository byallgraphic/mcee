<?php
/**********
Versión: 001
Fecha: 02-01-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud orientacion proceseso 
---------------------------------------
Modificaciones:
Fecha:	07-05-2019
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se hacen cambios varios
					- Se agregan campos faltantes
					- Se carga los datos correspondientes según actividades ingresadas anteriormente 
					- Los datos correspondientes a logros son individuales según el grupo que conforma la actividad
----------------------------------------
Modificaciones:
Fecha: 15-04-2019
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se hacen cambios varios para permitir al usuario subir más de un archivo por opción y se filtra los datos de acuerdo a la sede e institución seleccionada y se muestra los datos a más de un columna
----------------------------------------
Modificaciones:
Fecha: 25-01-2019
Fecha: 01-02-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: Se reestructura completamente la funcion actionCreate,
					Se implementa la subida de archivos multiples sobre multiples formularios
					Se elimina la funcion actionViewFaces y se reemplaza por actionFormulario donde se reestructura completamente
----------------------------------------
**********/




namespace app\controllers;

if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}

use Yii;
use yii\web\UploadedFile;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\Parametro;
use app\models\IsaRomProyectos;
use app\models\IsaActividadesRom;
use app\models\RomReporteOperativoMisional;
use app\models\IsaTipoCantidadPoblacionRom;
use app\models\IsaEvidenciasRom;
use app\models\RomActividadesRom;
use app\models\RomTipoCantidadPoblacionRom;
use app\models\IsaRomProcesos;
use app\models\IsaRomActividades;
use app\models\IsaActividadesIsa;
use app\models\IsaActividadesRomXIntegranteGrupo;
use app\models\IsaIntervencionIeo;
use app\models\IsaEquiposCampo;
use yii\bootstrap\Collapse;
use app\models\UploadForm;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\DateTime;
use yii\helpers\Json;

/**
 * RomReporteOperativoMisionalController implements the CRUD actions for RomReporteOperativoMisional model.
 */
class RomReporteOperativoMisionalController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
	
	public function actionConsultarMision()
	{
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$val 			= '';
		$romActividad 	= Yii::$app->request->post('rom_actividades');
		$sesionActividad= Yii::$app->request->post('sesion_actividad');
		$nro_semana		= Yii::$app->request->post('nro_semana');
		
		$modelReporteMisional = RomReporteOperativoMisional::findOne([
											'estado' 		=> 1,
											'id_sedes' 		=> $id_sede,
											'id_institucion'=> $id_institucion,
										]);
		
		if( $modelReporteMisional )		
		{
			$id_reporte = $modelReporteMisional->id;
			
			$model = IsaActividadesRom::findOne([
								'estado' => 1,
								'id_rom_actividad' 				=> $romActividad,
								'sesion_actividad' 				=> $sesionActividad,
								'id_reporte_operativo_misional' => $id_reporte,
								'nro_semana' 					=> $nro_semana,
							]);
			
			if( $model ){
				// $val = $this->actionUpdate( $model->id_reporte_operativo_misional );
				$val = $id_reporte;
			}
		}
		
		return $val;
	}
	
	public function actionConsultarIntervencionIeo( $id )
	{
		$val = [];
		
		$modelIntervencion = IsaIntervencionIeo::findOne( $id );
		
		foreach( $modelIntervencion as $key => $value ){
			$val[$key] = $value;
		}
		
		$val['equipo_nombre'] = IsaEquiposCampo::findOne( $modelIntervencion->id_equipo_campos )->nombre;
		
		return Json::encode($val);
	}

    /**
     * Lists all RomReporteOperativoMisional models.
     * @return mixed
     */
    public function actionIndex()
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
		
        $dataProvider = new ActiveDataProvider([
            'query' => RomReporteOperativoMisional::find()->where(['estado' => 1]),
        ]);
		$dataProvider->query->andWhere( 'id_institucion='.$id_institucion );
		$dataProvider->query->andWhere( 'id_sedes='.$id_sede );

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sede' 			=> $sede,
            'guardado' 		=> Yii::$app->request->get('guardado'),
        ]);
    }

	public function obtenerParametros($idTipoParametro)
	{
		//parametros de Fases informe planeación IEO
		$dataParametros = Parametro::find()
						->where( "id_tipo_parametro=$idTipoParametro" )
						->andWhere( 'estado=1' )
						->orderby( 'id' )
						->all();
						
		$parametros		= ArrayHelper::map( $dataParametros, 'id', 'descripcion' );
		
		return $parametros;
	
	}
		
	//funcion que se encarga de crear el formulario dinamicamente sin contar los campos de guardado que estan en la vista formulario
    function actionFormulario($model, $form, $datos = 0, $actividadesParticipadas )
	{	
		$estados= $this->obtenerParametros(45);
		// $ecProyectos = EcProyectos::find()->where( 'estado=1' )->orderby('id ASC')->all();
		
		$index = 0;
		
		//acordeon de los proyecto 
		foreach ($datos as $idProyecto => $v)
		{
			$contenedores[] = 	
				[
					'label' 		=>  $v['descripcion'],
					'content' 		=>  $this->renderPartial( 'procesos', 
													[  
                                                        'idProyecto'=> $v['id'],
														'form' 		=> $form,
														'procesos'	=>$v['procesos'],
														'estados'	=>$estados,
														'actividadesParticipadas'	=>$actividadesParticipadas,
														'actividades_rom2' => $v['actividades_rom2'],
														'idActividad' => $index++,
													] 
										),
					'contentOptions'=> ['class' => 'in'],
					'options' 		=> ['class' => 'panel-primary']
					
				];
				
	
		}
		
		 echo Collapse::widget([
			'items' => $contenedores,
		]);
		
		
		// $proyectos = new IsaRomProyectos();
		// $proyectos = $proyectos->find()->orderby("id")->all();
		// $proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		// $estados= $this->obtenerParametros(45);
		// // $ecProyectos = EcProyectos::find()->where( 'estado=1' )->orderby('id ASC')->all();
		
		
		// //acordeon de los proyecto 
		// foreach ($proyectos as $idProyecto => $v)
		// {
			
			 // $contenedores[] = 	
				// [
					// 'label' 		=>  $v,
					// 'content' 		=>  $this->renderPartial( 'procesos', 
													// [  
                                                        // 'idProyecto' => $idProyecto,
														// 'form' => $form,
														// //'modelProyectos' =>  $modelProyectos,
														// 'datos'=>$datos,
														// 'estados'=>$estados,
													// ] 
										// ),
					// 'contentOptions'=> ['class' => 'in'],
					// 'options' => ['class' => ' panel-primary']
					
				// ];
				
	
		// }
		
		 // echo Collapse::widget([
			// 'items' => $contenedores,
			
		// ]);
		
	}

    /**
     * Displays a single RomReporteOperativoMisional model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RomReporteOperativoMisional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$id_perfil_persona = $_SESSION['perfilesxpersonas'];
		
		
		$model = RomReporteOperativoMisional::findOne([
							'estado'			=> 1,
							'id_institucion' 	=> $id_institucion,
							'id_sedes' 			=> $id_sede,
						]);
		
		if( !$model ){
			$model = new RomReporteOperativoMisional();
		}
		
		$idInstitucion = $_SESSION['instituciones'][0];
		
        $institucion = Instituciones::findOne($idInstitucion);
        if ($model->load(Yii::$app->request->post())) 
		{
            if($model->save())
			{
                $rom_id = $model->id;
				
				if($arrayDatosActividades = Yii::$app->request->post('IsaActividadesRom'))
				{
				
					// se agrega el id del reporte despues de haber sido creado 
					foreach($arrayDatosActividades as $datos => $valores)
					{
						$arrayDatosActividades[$datos]['id_reporte_operativo_misional']= $rom_id;
						$arrayDatosActividades[$datos]['estado']= 1;
						$arrayDatosActividades[$datos]['id_rom_actividad']= $datos;
					}
					
					//guarda la informa en la tabla isa.actividades segun como vienen los datos en el post
					$columnNameArrayActividades=['nro_semana','fecha_desde','fecha_hasta','sesion_actividad','estado_actividad','id_reporte_operativo_misional','estado','id_rom_actividad'];
					// $columnNameArrayActividades=['fecha_desde','fecha_hasta','sesion_actividad','estado_actividad','id_reporte_operativo_misional','estado'];
					// inserta todos los datos que trae el array arrayDatosActividades
					$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert('isa.actividades_rom', $columnNameArrayActividades, $arrayDatosActividades) ->execute();
				}
				
				// if($arrayDatosPoblacion = Yii::$app->request->post('IsaTipoCantidadPoblacionRom'))
				// {
					
					// // se agrega el id del reporte despues de haber sido creado 
					// foreach($arrayDatosPoblacion as $datos => $valores)
					// {
						// $arrayDatosPoblacion[$datos]['id_reporte_operativo_misional'] = $rom_id;
						// $arrayDatosActividades[$datos]['estado']= 1;
						// $arrayDatosPoblacion[$datos]['id_rom_actividades'] = $datos;
					// }
					
					// //guarda la informa en la tabla isa.tipo_cantidad_poblacion_rom segun como vienen los datos en el post
					// $columnNameArrayPoblacion=['vecinos','lideres_comunitarios','empresarios_comerciantes','organizaciones_locales','grupos_comunitarios','otos_actores','total_participantes','id_rom_actividades','id_reporte_operativo_misional'];
					// // inserta todos los datos que trae el array arrayDatosActividades
					// $insertCount = Yii::$app->db->createCommand()
					   // ->batchInsert('isa.tipo_cantidad_poblacion_rom', $columnNameArrayPoblacion, $arrayDatosPoblacion)->execute(); 
				// }
				
				//guarda todos los archivos en el servidor y la url en la base de datos
				//valida que el post tenga IsaEvidenciasRom y lo asigan a la variable $arrayDatosEvidencias
				if($arrayDatosEvidencias = Yii::$app->request->post('IsaEvidenciasRom'))
				{
					
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloEvidencias = [];
					$cantidad = count($arrayDatosEvidencias);
					// for( $i = 0; $i < $cantidad; $i++ )
					foreach( $arrayDatosEvidencias as $key => $value )
					{
						$modeloEvidencias[$key] = new IsaEvidenciasRom();
					}
					
					//carga la informacion 
					if (IsaEvidenciasRom::loadMultiple($modeloEvidencias,  Yii::$app->request->post() )) 
					{	
						//se guarda la informacion en una carpeta con el nombre del codigo dane de la institucion seleccionada
						$idInstitucion 	= $_SESSION['instituciones'][0];
						$institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;
						
						//Si no existe la carpeta se crea
						$carpeta = "../documentos/reporteOperativo/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
						}
						
						//array con los nombres de los campos de la tabla isa.evidencias_rom
						$propiedades = array( "actas", "reportes", "listados", "plan_trabajo", "formato_seguimiento", "formato_evaluacion", "fotografias", "vidoes", "otros_productos");
						
						//recorre el array $modeloEvidencias con cada modelo creado dinamicamente
						foreach( $modeloEvidencias as $key => $model) 
						{
							// $k = $key+1;
							$k = $key;
							
							if( empty( $arrayDatosEvidencias[$k] ) )
								continue;
							
							//recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
							//para posteriormente guardar en la base de datos
							foreach($propiedades as $propiedad)
							{
								$arrayRutasFisicas = array();
								// se guarda el archivo en file
								
								// se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
								$files = UploadedFile::getInstances( $modeloEvidencias[$key], "[$k]$propiedad" );
								
								if( $files )
								{
									//se suben todos los archivos uno por uno
									foreach($files as $file)
									{
										//se usan microsegundos para evitar un nombre de archivo repetido
										$t = microtime(true);
										$micro = sprintf("%06d",($t - floor($t)) * 1000000);
										$d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
										
										// Construyo la ruta completa del archivo a guardar
										$rutaFisicaDirectoriaUploads  = "../documentos/reporteOperativo/".$institucion."/".$file->baseName . $d->format("_Y_m_d_H_i_s.u") . '.' . $file->extension;
										$save = $file->saveAs( $rutaFisicaDirectoriaUploads );
										//rutas de todos los archivos
										$arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
									}
									
									// asignacion de la ruta al campo de la db
									$modeloEvidencias[$key]->$propiedad = implode(",", $arrayRutasFisicas);
									// $model->$propiedad =  $var;
									$arrayRutasFisicas = null;
								}
								else
								{
									$modeloEvidencias[$key]->$propiedad = '';
								}
							}
							
							//se deben asignar los valores ya que se crean los modelos dinamicamente, yii no los agrega
							//los datos que vienen por post
							$modeloEvidencias[$key]->cantidad  						= $arrayDatosEvidencias[$k]['cantidad'];
							$modeloEvidencias[$key]->archivos_enviados_entregados 	= $arrayDatosEvidencias[$k]['archivos_enviados_entregados'];
							$modeloEvidencias[$key]->fecha_entrega_envio			= $arrayDatosEvidencias[$k]['fecha_entrega_envio'];
							$modeloEvidencias[$key]->id_rom_actividad				= $arrayDatosEvidencias[$k]['id_rom_actividad'];
							$modeloEvidencias[$key]->id_reporte_operativo_misional 	= $rom_id;
							
							if( empty($modeloEvidencias[$key]->fecha_entrega_envio) )
							{
								$modeloEvidencias[$key]->fecha_entrega_envio = gmdate( "Y-m-d", 0 );
							}
							
							//Siempre activo
							$modeloEvidencias[$key]->estado = 1;
						}
						
						//Guarda la informacion que tiene $model en la base de datos
						foreach( $modeloEvidencias as $key => $model) 
						{
							// $k = $key+1;
							$k = $key;
							
							if( empty( $arrayDatosEvidencias[$k] ) )
								continue;
							
							$model->save(false);
						}
						
						// return $this->redirect(['index', 'guardado' => true ]);
					}
							 
				}
				
				if($arrayDatosTipos = Yii::$app->request->post('IsaTipoCantidadPoblacionRom'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloTipos 	= [];
					$cantidad 		= count( $arrayDatosTipos );
					foreach( $arrayDatosTipos as $k => $v )
					{
						$modeloTipos[$k] = new IsaTipoCantidadPoblacionRom();
					}
					
					if(IsaTipoCantidadPoblacionRom::loadMultiple($modeloTipos,  Yii::$app->request->post() )) 
					{
						foreach( $modeloTipos as $key => $model )
						{
							$model->id_rom_actividades 				= $key;
							$model->id_reporte_operativo_misional 	= $rom_id;
							$model->total_participantes 			= "0";
							$model->estado 							= 1;
							$save = $model->save();
							
							// if( !$save ) exit( "error IsaTipoCantidadPoblacionRom 385" );
						}
					}
					// else{
						// exit( "error no carga IsaTipoCantidadPoblacionRom 385" );
					// }
				}
				// else{
					// exit( "error no array IsaTipoCantidadPoblacionRom 385" );
				// }
				
				if($arrayDatosIntegrante = Yii::$app->request->post('IsaActividadesRomXIntegranteGrupo'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloIntegrante 	= [];
					$cantidad 			= count( $arrayDatosIntegrante );
					foreach( $arrayDatosIntegrante as $k => $v )
					{
						$modeloIntegrante[$k] = new IsaActividadesRomXIntegranteGrupo();
					}
					
					if(IsaActividadesRomXIntegranteGrupo::loadMultiple($modeloIntegrante,  Yii::$app->request->post() )) 
					{
						foreach( $modeloIntegrante as $key => $model )
						{
							$model->diligencia 						= $id_perfil_persona;
							$model->rol 							= "$id_perfil_persona";
							$model->id_rom_actividad 				= $key;
							$model->id_reporte_operativo_misional 	= $rom_id;
							$model->estado 							= 1;
							
							if( empty($model->fecha_reprogramacion) )
							{
								$model->fecha_reprogramacion = gmdate( "Y-m-d", 0 );
							}
							
							$save = $model->save();
							// echo "<pre>"; var_dump( $key ); echo "</pre>";
							// echo "<pre>"; var_dump( $arrayDatosIntegrante ); echo "</pre>";
							// echo "<pre>"; var_dump( $model ); echo "</pre>";
							// if( !$save ) exit( "error IsaActividadesRomXIntegranteGrupo 414" );
						}
					}
					// else{
						// exit( "error no carga IsaActividadesRomXIntegranteGrupo 414" );
					// }
				}
				// else{
					// exit( "error no array IsaActividadesRomXIntegranteGrupo 414" );
				// }
				
				return $this->redirect(['index', 'guardado' => 1 ]);
			}
			
		}	
			
		$Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->andWhere('id='.$id_sede)->all();
		$sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );
		
		
		
		/************************************************************************************
		 * Un proyecto tiene uno o más procesos
		 * Un procesos tiene una o más actividades
		 * Por actividad es una evidencia y la evidencia es la vista formulario
		 ***********************************************************************************/
		 
		/******************************************
		
			datos[] =>	[
								id del proyecto
								descripcion del proyecto
								procesos[] 	= 	[
													id
													descripcion
													actividades[] =	[
																		id
																		descripcion
																		evidencia
																	]
												]
							]
			
		 ******************************************/
		
		$proyectos = new IsaRomProyectos();
		$proyectos = $proyectos->find()->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		$estados= $this->obtenerParametros(45);
		
		$datos = [];
		
		// $dataActividadesParticipadas = IsaActividadesIsa::find()
										// ->alias('a')
										// ->innerJoin('isa.equipos_campo ec', 'ec.id=a.num_equipo_campo')
										// ->innerJoin('isa.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
										// ->where( 'a.estado=1' )
										// ->andWhere( 'ie.estado=1' )
										// ->andWhere( 'ec.estado=1' )
										// ->andWhere( 'ie.id_perfil_persona_institucion='.$_SESSION['id'] )
										// ->all();
										
		// $dataActividadesParticipadas = IsaIntervencionIeo::find()
										// ->alias('i')
										// ->innerJoin('isa.actividades_isa a', 'a.id=i.id_actividades_isa')
										// ->innerJoin('isa.equipos_campo ec', 'ec.id=a.num_equipo_campo')
										// ->innerJoin('isa.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
										// ->where( 'a.estado=1' )
										// ->andWhere( 'ie.estado=1' )
										// ->andWhere( 'ec.estado=1' )
										// ->andWhere( 'ie.id_perfil_persona_institucion='.$_SESSION['id'] )
										// ->all();
										
		$dataActividadesParticipadas = IsaIntervencionIeo::find()
										->alias('i')
										->innerJoin('isa.equipos_campo ec', 'ec.id=i.id_equipo_campos')
										->innerJoin('isa.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
										->where( 'ie.estado=1' )
										->andWhere( 'ec.estado=1' )
										->andWhere( 'ie.id_perfil_persona_institucion='.$_SESSION['id'] )
										->all();
										
		$actividadesParticipadas = ArrayHelper::map( $dataActividadesParticipadas,'id','nombre_actividad' );
		
		foreach( $proyectos as $idProyecto => $descripcionProyecto )
		{
			$proy = [
						'id' 			=> $idProyecto,
						'descripcion' 	=> $descripcionProyecto,
						'actividades_rom2' 	=> new IsaActividadesRom(),
						'procesos'		=> [],
					];
			
			$dataProcesos = IsaRomProcesos::find()
								->where( "estado=1 and id_rom_proyectos=$idProyecto" )
								->all();
								
			$procesos = ArrayHelper::map($dataProcesos,'id','descripcion');
			
			foreach( $procesos as $idProceso => $descripcionProceso )
			{
				$procs = 	[
								'id' 			=> $idProceso,
								'descripcion' 	=> $descripcionProceso,
								'actividades'	=> [],
							];
							
				$actividades = IsaRomActividades::find()->where( "estado=1 and id_rom_procesos=$idProceso" )->all();
				$actividades = ArrayHelper::map($actividades,'id','descripcion');
				
					   
				foreach( $actividades as $idActividad => $descripcionActividad )
				{
					//Array de actividades
					$act =  [
								'id' 						=> $idActividad,
								'descripcion' 				=> $descripcionActividad,
								'actividades_rom' 			=> new IsaActividadesRom(),
								'evidencia'					=> new IsaEvidenciasRom(),
								'poblacion'					=> new IsaTipoCantidadPoblacionRom(),
								'integrante'				=> new IsaActividadesRomXIntegranteGrupo(),
								'actividadesParticipadas' 	=> $actividadesParticipadas,
								'datos_adicionales' 		=> [ 'equipo_nombre' => '', 'perfiles' => '', 'docente_orientador' => '' ],
							];
					
					//Adiciono la actividad al proceso
					$procs[ 'actividades' ][] = $act;
				}
				
				$proy['procesos'][] = $procs;
				
			}
			
			
			$datos[] = $proy;
		}
		
		/************************************************************************************************************/

		return $this->renderAjax( 'create', [
			'model' 					=> $model,
			'sedes'						=> $sedes,
			'institucion'				=> $this->obtenerInstitucion(),
			'datos'						=> $datos,
			'actividadesParticipadas'	=> $actividadesParticipadas,
		]);
	}

	
	public function obtenerInstitucion()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$instituciones = new Instituciones();
		$instituciones = $instituciones->find()->where("id = $idInstitucion")->all();
		$instituciones = ArrayHelper::map($instituciones,'id','descripcion');
		
		return $instituciones;
	}
	

	
    /**
     * Updates an existing RomReporteOperativoMisional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$id_perfil_persona = $_SESSION['perfilesxpersonas'];
		
        $model = RomReporteOperativoMisional::findOne( $id );
		
		$idInstitucion = $_SESSION['instituciones'][0];
		
        $institucion = Instituciones::findOne($idInstitucion);
	
        if ($model->load(Yii::$app->request->post())) 
		{
            if($model->save())
			{
                $rom_id = $model->id;
				
				if($arrayDatosActividades = Yii::$app->request->post('IsaActividadesRom'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloActividades 	= [];
					$cantidad 		= count( $arrayDatosActividades );
					foreach( $arrayDatosActividades as $k => $v )
					{
						$modeloActividades[$k] = IsaActividadesRom::findOne([ 
																	'estado' 						=> 1, 
																	'id_reporte_operativo_misional' => $rom_id,
																	'id_rom_actividad' 				=> $k,
																]);
					}
					
					if(IsaTipoCantidadPoblacionRom::loadMultiple($modeloActividades,  Yii::$app->request->post() )) 
					{
						foreach( $modeloActividades as $key => $model )
						{
							// $model->id_reporte_operativo_misional 	= $rom_id;
							// $model->estado 							= 1;
							$save = $model->save();
							
							if( !$save ) exit( "error IsaTipoCantidadPoblacionRom 781" );
						}
					}
					
					
				
					// // se agrega el id del reporte despues de haber sido creado 
					// foreach($arrayDatosActividades as $datos => $valores)
					// {
						// $arrayDatosActividades[$datos]['id_reporte_operativo_misional']= $rom_id;
						// $arrayDatosActividades[$datos]['estado']= 1;
						// // $arrayDatosActividades[$datos]['id_rom_actividad']= $datos;
					// }
					
					// //guarda la informa en la tabla isa.actividades segun como vienen los datos en el post
					// // $columnNameArrayActividades=['fecha_desde','fecha_hasta','sesion_actividad','estado_actividad','id_reporte_operativo_misional','estado','id_rom_actividad'];
					// $columnNameArrayActividades=['fecha_desde','fecha_hasta','sesion_actividad','estado_actividad','id_reporte_operativo_misional','estado'];
					// // inserta todos los datos que trae el array arrayDatosActividades
					// $insertCount = Yii::$app->db->createCommand()
					   // ->batchInsert('isa.actividades_rom', $columnNameArrayActividades, $arrayDatosActividades) ->execute();
				}
				
				// if($arrayDatosPoblacion = Yii::$app->request->post('IsaTipoCantidadPoblacionRom'))
				// {
					
					// // se agrega el id del reporte despues de haber sido creado 
					// foreach($arrayDatosPoblacion as $datos => $valores)
					// {
						// $arrayDatosPoblacion[$datos]['id_reporte_operativo_misional'] = $rom_id;
					// }
					
					// //guarda la informa en la tabla isa.tipo_cantidad_poblacion_rom segun como vienen los datos en el post
					// $columnNameArrayPoblacion=['vecinos','lideres_comunitarios','empresarios_comerciantes','organizaciones_locales','grupos_comunitarios','otos_actores','total_participantes','id_rom_actividades','id_reporte_operativo_misional'];
					// // inserta todos los datos que trae el array arrayDatosActividades
					// $insertCount = Yii::$app->db->createCommand()
					   // ->batchInsert('isa.tipo_cantidad_poblacion_rom', $columnNameArrayPoblacion, $arrayDatosPoblacion)->execute(); 
				// }
				
				//guarda todos los archivos en el servidor y la url en la base de datos
				//valida que el post tenga IsaEvidenciasRom y lo asigan a la variable $arrayDatosEvidencias
				if($arrayDatosEvidencias = Yii::$app->request->post('IsaEvidenciasRom'))
				{
					
					// //se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					// $modeloEvidencias = [];
					// $cantidad = count($arrayDatosEvidencias);
					// for( $i = 0; $i < $cantidad; $i++ )
					// {
						// $modeloEvidencias[] = new IsaEvidenciasRom();
					// }
					
					$modeloEvidencias = IsaEvidenciasRom::find()
												->where('estado=1')
												->andWhere('id_reporte_operativo_misional='.$id)
												->all();
					
					//carga la informacion 
					if (IsaEvidenciasRom::loadMultiple($modeloEvidencias,  Yii::$app->request->post() )) 
					{	
						//se guarda la informacion en una carpeta con el nombre del codigo dane de la institucion seleccionada
						$idInstitucion 	= $_SESSION['instituciones'][0];
						$institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;
						
						//Si no existe la carpeta se crea
						$carpeta = "../documentos/reporteOperativo/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
						}
						
						//array con los nombres de los campos de la tabla isa.evidencias_rom
						$propiedades = array( "actas", "reportes", "listados", "plan_trabajo", "formato_seguimiento", "formato_evaluacion", "fotografias", "vidoes", "otros_productos");
						
						//recorre el array $modeloEvidencias con cada modelo creado dinamicamente
						foreach( $modeloEvidencias as $key => $model) 
						{	
							$k = $key+1;
							
							if( empty($arrayDatosEvidencias[$k]) )
								continue;
							
							//recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
							//para posteriormente guardar en la base de datos
							foreach( $propiedades as $propiedad )
							{
								$arrayRutasFisicas = array();
								// se guarda el archivo en file
								
								// se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
								$files = UploadedFile::getInstances( $modeloEvidencias[$key], "[$k]$propiedad" );
								
								if( $files )
								{
									$archivosGuardados = [];
									
									//Como se trabajo en competencias basicas fue si es el mismo nombre de archivo que se sube lo sobre escribe, si es otro si se toma como nuevo
									if( $model->getOldAttribute( $propiedad ) != '' )
									{
										$arrayRutasFisicas = $archivos = explode( ",", $model->getOldAttribute( $propiedad ) );
										
										foreach( $archivos as $value )
										{
											//Obteniendo la extensión del archivo ya guardado
											$ext					= explode( ".", $value );
											
											//La extension del archivo es la última despues de separar por puntos
											$ext = $ext[ count($ext)-1 ];
											
											//Obteniendo el nombre del archivo
											$archivo 	= explode( "/", $value );
											$archivo 	= $archivo[ count($archivo)-1 ];
											$archivo 	= explode( "_", $archivo );
											array_splice( $archivo, -6 );
											
											//Nombre del archivo 
											$archivo	= implode( "_", $archivo );
											
											//Asigno el nombre del archivo al array
											$archivosGuardados[] = $archivo.'.'.$ext;
										}
									}
									
									//se suben todos los archivos uno por uno
									foreach( $files as $file )
									{
										//se usan microsegundos para evitar un nombre de archivo repetido
										$t = microtime(true);
										$micro = sprintf("%06d",($t - floor($t)) * 1000000);
										$d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
										
										// Construyo la ruta completa del archivo a guardar
										$rutaFisicaDirectoriaUploads  = "../documentos/reporteOperativo/".$institucion."/".$file->baseName . $d->format("_Y_m_d_H_i_s.u") . '.' . $file->extension;
										
										if( in_array( $file->baseName.'.'.$file->extension, $archivosGuardados ) )
										{ 
											$arrayRutasFisicas[ array_search( $file->baseName.'.'.$file->extension, $archivosGuardados ) ] = $rutaFisicaDirectoriaUploads;
										}
										else
										{
											//rutas de todos los archivos
											$arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
										}
										
										$save = $file->saveAs( $rutaFisicaDirectoriaUploads );
									}
									

									// asignacion de la ruta al campo de la db
									$modeloEvidencias[$key]->$propiedad = implode(",", $arrayRutasFisicas);
									
									$arrayRutasFisicas = [];
								}
								else
								{
									//Si no hay archivo cargado lo dejo igual a como está en la base de datos
									$modeloEvidencias[$key]->$propiedad = $model->getOldAttribute( $propiedad );
								}
							}
							
							
							
							//se deben asignar los valores ya que se crean los modelos dinamicamente, yii no los agrega
							//los datos que vienen por post
							$modeloEvidencias[$key]->cantidad  						= $arrayDatosEvidencias[$k]['cantidad'];
							$modeloEvidencias[$key]->archivos_enviados_entregados 	= $arrayDatosEvidencias[$k]['archivos_enviados_entregados'];
							$modeloEvidencias[$key]->fecha_entrega_envio			= $arrayDatosEvidencias[$k]['fecha_entrega_envio'];
							$modeloEvidencias[$key]->id_rom_actividad				= $arrayDatosEvidencias[$k]['id_rom_actividad'];
							$modeloEvidencias[$key]->id_reporte_operativo_misional 	= $rom_id;
							
							if( empty($modeloEvidencias[$key]->fecha_entrega_envio) )
							{
								$modeloEvidencias[$key]->fecha_entrega_envio = gmdate( "Y-m-d", 0 );
							}
							
							//Siempre activo
							$modeloEvidencias[$key]->estado = 1;
						}
						
						//Guarda la informacion que tiene $model en la base de datos
						foreach( $modeloEvidencias as $key => $m) 
						{
							$k = $key+1;
							
							if( empty($arrayDatosEvidencias[$k]) )
								continue;
							
							$m->save(false);
						}
						
						// return $this->redirect(['index', 'guardado' => true ]);
					}		 
				}
				
				if($arrayDatosTipos = Yii::$app->request->post('IsaTipoCantidadPoblacionRom'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloTipos 	= [];
					$cantidad 		= count( $arrayDatosTipos );
					foreach( $arrayDatosTipos as $k => $v )
					{
						$modeloTipos[$k] = IsaTipoCantidadPoblacionRom::findOne([ 
																	'estado' 						=> 1, 
																	'id_rom_actividades' 			=> $k,
																	'id_reporte_operativo_misional' => $id,
																]);
					}
					
					if(IsaTipoCantidadPoblacionRom::loadMultiple($modeloTipos,  Yii::$app->request->post() )) 
					{
						foreach( $modeloTipos as $key => $model )
						{
							$model->id_rom_actividades 				= $key;
							$model->id_reporte_operativo_misional 	= $rom_id;
							$model->total_participantes 			= "0";
							$model->estado 							= 1;
							$save = $model->save();
							
							if( !$save ) exit( "error IsaTipoCantidadPoblacionRom 781" );
						}
					}
					else{
						exit( "error no carga IsaTipoCantidadPoblacionRom 781" );
					}
				}
				else{
					exit( "error no array IsaTipoCantidadPoblacionRom 781" );
				}
				
				if($arrayDatosIntegrante = Yii::$app->request->post('IsaActividadesRomXIntegranteGrupo'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloIntegrante 	= [];
					$cantidad 			= count( $arrayDatosIntegrante );
					foreach( $arrayDatosIntegrante as $k => $v )
					{
						$modeloIntegrante[$k] = IsaActividadesRomXIntegranteGrupo::findOne([ 
																	'estado' 						=> 1, 
																	'diligencia' 					=> $id_perfil_persona,
																	'id_rom_actividad' 				=> $k,
																	'id_reporte_operativo_misional' => $id,
																]);
						
						//Si no encuentra el registro signifca que debe ser nuevo ya que esta parte es individual por persona
						if( !$modeloIntegrante[$k] ){
							$modeloIntegrante[$k] = new IsaActividadesRomXIntegranteGrupo();
						}
					}
					
					if(IsaActividadesRomXIntegranteGrupo::loadMultiple($modeloIntegrante,  Yii::$app->request->post() )) 
					{
						foreach( $modeloIntegrante as $key => $model )
						{
							$model->diligencia 						= $id_perfil_persona;
							$model->rol 							= "$id_perfil_persona";
							$model->id_rom_actividad 				= $key;
							$model->id_reporte_operativo_misional 	= $rom_id;
							$model->estado 							= 1;
							
							if( empty($model->fecha_reprogramacion) )
							{
								$model->fecha_reprogramacion = gmdate( "Y-m-d", 0 );
							}
							
							$save = $model->save();
							// echo "<pre>"; var_dump( $key ); echo "</pre>";
							// echo "<pre>"; var_dump( $arrayDatosIntegrante ); echo "</pre>";
							// echo "<pre>"; var_dump( $model ); echo "</pre>";
							if( !$save ) exit( "error IsaActividadesRomXIntegranteGrupo 830" );
						}
					}
					else{
						exit( "error no carga IsaActividadesRomXIntegranteGrupo 830" );
					}
				}
				else{
					exit( "error no array IsaActividadesRomXIntegranteGrupo 830" );
				}
				
				return $this->redirect(['index', 'guardado' => 1 ]);
			}
		}	
		
		$Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->andWhere('id='.$id_sede)->all();
		$sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );
		
		/************************************************************************************
		 * Un proyecto tiene uno o más procesos
		 * Un procesos tiene una o más actividades
		 * Por actividad es una evidencia y la evidencia es la vista formulario
		 ***********************************************************************************/
		 
		/******************************************
		
			datos[] =>	[
								id del proyecto
								descripcion del proyecto
								procesos[] 	= 	[
													id
													descripcion
													actividades[] =	[
																		id
																		descripcion
																		evidencia
																	]
												]
							]
			
		 ******************************************/
		
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
		
		$estados= $this->obtenerParametros(45);
		
		$datos = [];
		
		foreach( $proyectos as $idProyecto => $descripcionProyecto )
		{
			$proy = [
						'id' 				=> $idProyecto,
						'descripcion' 		=> $descripcionProyecto,
						'actividades_rom2'	=> IsaActividadesRom::findOne([ 
																	'id_reporte_operativo_misional' => $id,
																	'estado' 						=> 1,
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
					
					$modelIntegrante 			= IsaActividadesRomXIntegranteGrupo::findOne([ 
																	'estado' 						=> 1, 
																	'diligencia' 					=> $id_perfil_persona,
																	'id_rom_actividad' 				=> $evidencia->id_rom_actividad,
																	'id_reporte_operativo_misional' => $id,
																]);
																
					if( !$modelIntegrante ){
						$modelIntegrante = new IsaActividadesRomXIntegranteGrupo();
					}
					
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
								'integrante'				=> $modelIntegrante,
								'datosSoloLectura' 			=> IsaIntervencionIeo::findOne([
																	'id' 		=> $actividades_rom_upt->sesion_actividad,
																	'estado' 	=> 1,
																]),
																
								'actividadesParticipadas' 	=> $actividadesParticipadas,
								'datos_adicionales' 		=> Json::decode( $this->actionConsultarIntervencionIeo( $dataActividadesParticipadas->id ) ),
							];
					
					//Adiciono la actividad al proceso
					$procs[ 'actividades' ][] = $act;
				}
				
				$proy['procesos'][] = $procs;
			}
			
			$datos[] = $proy;
		}
		
		// $dataActividadesParticipadas = IsaActividadesIsa::find()
											// ->alias('a')
											// ->innerJoin('isa.equipos_campo ec', 'ec.id=a.num_equipo_campo')
											// ->innerJoin('isa.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
											// ->where( 'a.estado=1' )
											// ->andWhere( 'ie.estado=1' )
											// ->andWhere( 'ec.estado=1' )
											// ->andWhere( 'ie.id_perfil_persona_institucion='.$id_perfil_persona )
											// ->all();
										
		// $actividadesParticipadas = ArrayHelper::map( $dataActividadesParticipadas,'id','descripcion' );
		
		$dataActividadesParticipadas = IsaIntervencionIeo::find()
										->alias('i')
										->innerJoin('isa.actividades_isa a', 'a.id=i.id_actividades_isa')
										->innerJoin('isa.equipos_campo ec', 'ec.id=a.num_equipo_campo')
										->innerJoin('isa.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
										->where( 'a.estado=1' )
										->andWhere( 'ie.estado=1' )
										->andWhere( 'ec.estado=1' )
										->andWhere( 'ie.id_perfil_persona_institucion='.$_SESSION['id'] )
										->all();
										
		$actividadesParticipadas = ArrayHelper::map( $dataActividadesParticipadas,'id','nombre_actividad' );
		/************************************************************************************************************/

		return $this->renderAjax( 'create', [
			'model' 					=> $model,
			'sedes'						=> $sedes,
			'institucion'				=> $this->obtenerInstitucion(),
			'datos'						=> $datos,
			'actividadesParticipadas' 	=> $actividadesParticipadas,
		]);
    }

    /**
     * Deletes an existing RomReporteOperativoMisional model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
		$model->estado = 2;
		$model->update(false);
        return $this->redirect(['index']);
    }

    /**
     * Finds the RomReporteOperativoMisional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RomReporteOperativoMisional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RomReporteOperativoMisional::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
