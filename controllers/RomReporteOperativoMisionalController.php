<?php
/**********
Versión: 001
Fecha: 02-01-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud orientacion proceseso 
---------------------------------------
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
use yii\bootstrap\Collapse;
use app\models\UploadForm;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\DateTime;

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

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sede' 			=> $sede,
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
    function actionFormulario($model, $form, $datos = 0 )
	{	
		$estados= $this->obtenerParametros(45);
		// $ecProyectos = EcProyectos::find()->where( 'estado=1' )->orderby('id ASC')->all();
		
		
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
		
        $model = new RomReporteOperativoMisional();
		
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
					}
					
					//guarda la informa en la tabla isa.actividades segun como vienen los datos en el post
					$columnNameArrayActividades=['alarmas','alternativas','articulacion','debilidades','diligencia','docente_orientador','duracion_sesion','estado','evaluacion','fecha_desde','fecha_diligencia','fecha_hasta','fecha_reprogramacion','fortalezas','id_rom_actividad','justificacion_activiad_no_realizada','logros','nombre_actividad','num_equipos','observaciones_generales','perfiles','retos','rol','id_reporte_operativo_misional'];
					// inserta todos los datos que trae el array arrayDatosActividades
					$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert('isa.actividades_rom', $columnNameArrayActividades, $arrayDatosActividades) ->execute();
				}
				
				if($arrayDatosPoblacion = Yii::$app->request->post('IsaTipoCantidadPoblacionRom'))
				{
					
					// se agrega el id del reporte despues de haber sido creado 
					foreach($arrayDatosPoblacion as $datos => $valores)
					{
						$arrayDatosPoblacion[$datos]['id_reporte_operativo_misional'] = $rom_id;
					}
					
					//guarda la informa en la tabla isa.tipo_cantidad_poblacion_rom segun como vienen los datos en el post
					$columnNameArrayPoblacion=['vecinos','lideres_comunitarios','empresarios_comerciantes','organizaciones_locales','grupos_comunitarios','otos_actores','total_participantes','id_rom_actividades','id_reporte_operativo_misional'];
					// inserta todos los datos que trae el array arrayDatosActividades
					$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert('isa.tipo_cantidad_poblacion_rom', $columnNameArrayPoblacion, $arrayDatosPoblacion)->execute(); 
				}
				
				//guarda todos los archivos en el servidor y la url en la base de datos
				//valida que el post tenga IsaEvidenciasRom y lo asigan a la variable $arrayDatosEvidencias
				if($arrayDatosEvidencias = Yii::$app->request->post('IsaEvidenciasRom'))
				{
					
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloEvidencias = [];
					$cantidad = count($arrayDatosEvidencias);
					for( $i = 0; $i < $cantidad; $i++ )
					{
						$modeloEvidencias[] = new IsaEvidenciasRom();
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
							$k = $key+1;
							
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
							//Siempre activo
							$modeloEvidencias[$key]->estado = 1;
						}
						
						//Guarda la informacion que tiene $model en la base de datos
						foreach( $modeloEvidencias as $key => $model) 
						{	
							$model->save(false);
						}
						
						return $this->redirect(['index', 'guardado' => true ]);
					}
							 
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
		$proyectos = $proyectos->find()->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		$estados= $this->obtenerParametros(45);
		
		$datos = [];
		
		foreach( $proyectos as $idProyecto => $descripcionProyecto )
		{
			$proy = [
						'id' 			=> $idProyecto,
						'descripcion' 	=> $descripcionProyecto,
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
								'id' 			=> $idActividad,
								'descripcion' 	=> $descripcionActividad,
								'evidencia'		=> new IsaEvidenciasRom(),
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
			'model' 		=> $model,
			'sedes'			=> $sedes,
			'institucion'	=> $this->obtenerInstitucion(),
			'datos'			=> $datos,
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
				
					// se agrega el id del reporte despues de haber sido creado 
					foreach($arrayDatosActividades as $datos => $valores)
					{
						$arrayDatosActividades[$datos]['id_reporte_operativo_misional']= $rom_id;
					}
					
					//guarda la informa en la tabla isa.actividades segun como vienen los datos en el post
					$columnNameArrayActividades=['alarmas','alternativas','articulacion','debilidades','diligencia','docente_orientador','duracion_sesion','estado','evaluacion','fecha_desde','fecha_diligencia','fecha_hasta','fecha_reprogramacion','fortalezas','id_rom_actividad','justificacion_activiad_no_realizada','logros','nombre_actividad','num_equipos','observaciones_generales','perfiles','retos','rol','id_reporte_operativo_misional'];
					// inserta todos los datos que trae el array arrayDatosActividades
					$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert('isa.actividades_rom', $columnNameArrayActividades, $arrayDatosActividades) ->execute();
				}
				
				if($arrayDatosPoblacion = Yii::$app->request->post('IsaTipoCantidadPoblacionRom'))
				{
					
					// se agrega el id del reporte despues de haber sido creado 
					foreach($arrayDatosPoblacion as $datos => $valores)
					{
						$arrayDatosPoblacion[$datos]['id_reporte_operativo_misional'] = $rom_id;
					}
					
					//guarda la informa en la tabla isa.tipo_cantidad_poblacion_rom segun como vienen los datos en el post
					$columnNameArrayPoblacion=['vecinos','lideres_comunitarios','empresarios_comerciantes','organizaciones_locales','grupos_comunitarios','otos_actores','total_participantes','id_rom_actividades','id_reporte_operativo_misional'];
					// inserta todos los datos que trae el array arrayDatosActividades
					$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert('isa.tipo_cantidad_poblacion_rom', $columnNameArrayPoblacion, $arrayDatosPoblacion)->execute(); 
				}
				
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
							//Siempre activo
							$modeloEvidencias[$key]->estado = 1;
						}
						
						//Guarda la informacion que tiene $model en la base de datos
						foreach( $modeloEvidencias as $key => $m) 
						{
							$m->save(false);
						}
						
						return $this->redirect(['index', 'guardado' => true ]);
					}		 
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
						'id' 			=> $idProyecto,
						'descripcion' 	=> $descripcionProyecto,
						'procesos'		=> [],
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
					//Array de actividades
					$act =  [
								'id' 			=> $evidencia->id_rom_actividad,
								'descripcion' 	=> IsaRomActividades::findOne( $evidencia->id_rom_actividad )->descripcion,
								'evidencia'		=> $evidencia,
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
			'model' 		=> $model,
			'sedes'			=> $sedes,
			'institucion'	=> $this->obtenerInstitucion(),
			'datos'			=> $datos,
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
