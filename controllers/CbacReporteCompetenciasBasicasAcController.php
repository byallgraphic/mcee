<?php
/**********
Versión: 001
Fecha: 02-01-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud orientacion proceseso 
---------------------------------------
Modificaciones:
Fecha:	10-06-2019
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se hacen cambios varios
					- Campo perfiles ya no va
					- Campo equipo se muestra si tiene información y si no en blanco (a veces no se selecciona equipo en el 1)
					- Docente orientador cambiarlo a coordinador técnico pedagógico
					- Obligar a llenar al menos un tipo y cantidad de población
					- Nos dicen que evidencias son obligatorias
					- Archivos enviados, fecha de entrega ya no van
					- Duración en horas
					- Fecha diligencia, es la fecha actual
					- Duración es el promedio de duración de las sesiones
----------------------------------------
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
use app\models\CbacRomProyectos;
use app\models\CbacActividadesRom;
use app\models\CbacReporteOperativoMisional;
use app\models\CbacTipoCantidadPoblacionRom;
use app\models\CbacEvidenciasRom;
use app\models\RomActividadesRom;
use app\models\RomTipoCantidadPoblacionRom;
use app\models\CbacRomProcesos;
use app\models\CbacRomActividades;
use app\models\CbacActividadesIsa;
use app\models\CbacActividadesRomXIntegranteGrupo;
use app\models\CbacIntervencionIeo;
use app\models\CbacEquiposCampo;
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
 * RomReporteOperativoMisionalController implements the CRUD actions for CbacReporteOperativoMisional model.
 */
class CbacReporteCompetenciasBasicasAcController extends Controller
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
	
	public static function crearReporteOperativoMisional( $id_planeacion )
	{	
		$respuesta = [ 'error' => false, 'msg' => '' ];
		
		$intervencion = CbacIntervencionIeo::findOne( $id_planeacion );
		
		if( $intervencion )
		{
			$romisional = new CbacReporteOperativoMisional();
			$romisional->id_institucion = $_SESSION['instituciones'][0];
			$romisional->id_sedes		= $_SESSION['sede'][0];
			$romisional->estado			= 1;
			$romisional->save( false );
			
			$id_rom = $romisional->id;
			
			if( $id_rom )
			{
				$actividad = CbacActividadesIsa::findOne( $intervencion->id_actividades_isa );
				
				if( $actividad )
				{	
					$actividades_rom 								= new CbacActividadesRom();
					$actividades_rom->id_reporte_operativo_misional = $id_rom;
					$actividades_rom->id_rom_actividad 				= $actividad->id_procesos_generales;
					$actividades_rom->estado 						= 1; 
					$actividades_rom->nro_semana 					= 1;
					$actividades_rom->fecha_desde 					= date( "Y-m-d", 0 );
					$actividades_rom->fecha_hasta 					= date( "Y-m-d", 0 );
					$actividades_rom->estado_actividad 				= 1;
					$actividades_rom->sesion_actividad 				= $intervencion->id;
					$res_actividades_rom 							= $actividades_rom->save( false );
					
					
					$evidencias 								= new CbacEvidenciasRom();
					$evidencias->id_rom_actividad 				= $actividad->id_procesos_generales;
					$evidencias->cantidad						= 0;
					$evidencias->estado							= 1;
					$evidencias->id_reporte_operativo_misional 	= $id_rom;
					$evidencias->fecha_entrega_envio			= date( "Y-m-d" );
					$evidencias->archivos_enviados_entregados	= 0;
					$res_evidencias 							= $evidencias->save( false );
					
					$tipo =  new CbacTipoCantidadPoblacionRom();
					$tipo->estado							= 1;
					$tipo->id_rom_actividades 				= $actividad->id_procesos_generales;
					$tipo->id_reporte_operativo_misional	= $id_rom;
					$tipo->vecinos							= '';
					$tipo->lideres_comunitarios				= '';
					$tipo->empresarios_comerciantes			= '';
					$tipo->organizaciones_locales			= '';
					$tipo->grupos_comunitarios				= '';
					$tipo->otos_actores						= '';
					$tipo->total_participantes				= '';
					$res_tipo 								= $tipo->save( false );
				}
			}
			else
			{
				$respuesta = [ 'error' => true, 'msg' => 'No se creó: '.$id_planeacion ];
			}
		}
		else
		{
			$respuesta = [ 'error' => true, 'msg' => 'No se encuentra intervención con id: '.$id_planeacion ];
		}
		
		return $respuesta;
	}
	
	public function actionEliminarArchivo()
	{
		$val = 	[ 'resultado' => false ];
		
		$id 		= Yii::$app->request->post('id_evidencia');
		$campo 		= Yii::$app->request->post('campo');
		$eliminar	= Yii::$app->request->post('archivo');		//archivo a elminar
		
		$model = CbacEvidenciasRom::findOne( $id );
		
		if( $model )
		{
			//Todos los archvios están separados por coma (,)
			$archivos = explode( ",", $model->$campo );
			
			$guardar = [];
			
			//todo lo que sea diferente al archivo a elminar lo dejo intacto
			foreach( $archivos as $archivo )
			{
				if( $archivo != $eliminar )
				{
					$guardar[] = $archivo;
				}
			}
			
			//Dejo el campo a guardar vació por defecto
			$model->$campo = "";
			if( count($guardar) > 0 )
			{
				$model->$campo = implode( ",", $guardar );
			}
			
			//Guardo el resultado
			if( $model->save( false ) )
			{
				//Si guardo no hubo problemas marco el resultado como verdadero
				$val[ 'resultado' ] = true;
			}
		}
		
		return Json::encode( $val );
	}
	
	public function actionArchivosEvidencias(){
		
		$id = Yii::$app->request->get('id_evidencia');
		
		$model = CbacEvidenciasRom::findOne( $id );
		
		$datos = [];
		
		if( $model )
		{
			$atributos = [
							'actas' 				=> 'ACTAS', 
							'reportes'				=> 'REPORTES', 
							'listados'				=> 'LISTADOS', 
							'plan_trabajo'			=> 'PLAN DE TRABAJO', 
							'formato_seguimiento'	=> 'FORMATOS DE SEGUIMIENTO', 
							'formato_evaluacion'	=> 'FORMATOS DE EVALUACIÓN', 
							'fotografias'			=> 'FOTOGRAFÍAS', 
							'vidoes'				=> 'VIDEOS', 
							'otros_productos'		=> 'OTROS PRODUCTOS DE LA ACTIVIDAD', 
						];
						
			
			foreach( $atributos as $key => $value )
			{
				if( !empty( $model->$key ) )
				{
					$files = explode( ",", $model->$key );
					
					$archivos = [];
					
					foreach( $files as $file ){
						
						$descripcion = explode( "/", $file );
						$descripcion = end( $descripcion );
						
						$archivos[] = 	[ 
											'archivo'		=> $file,
											'descripcion'	=> $descripcion,
										];
					}
					
					$datos[ $key ] = [ 
											'title' 	=> $value,
											'campo' 	=> $key,
											'archivos' 	=> $archivos,
										];
				}
			}
		}
		
		return $this->renderAjax('viewFiles', [
            'datos' 	=> $datos,
            'id' 		=> $id,
        ]);
	}
	
	public function actionConsultarMision()
	{
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$val 			= '';
		$romActividad 	= Yii::$app->request->post('rom_actividades');
		$sesionActividad= Yii::$app->request->post('sesion_actividad');
		$nro_semana		= Yii::$app->request->post('nro_semana');
		
		$modelReporteMisional = CbacReporteOperativoMisional::findOne([
											'estado' 		=> 1,
											'id_sedes' 		=> $id_sede,
											'id_institucion'=> $id_institucion,
										]);
		
		if( $modelReporteMisional )		
		{
			$id_reporte = $modelReporteMisional->id;
			
			$model = CbacActividadesRom::findOne([
								'estado' 						=> 1,
								'id_rom_actividad' 				=> $romActividad,
								'sesion_actividad' 				=> $sesionActividad,
								// 'id_reporte_operativo_misional' => $id_reporte,
								'nro_semana' 					=> $nro_semana,
							]);
			
			if( $model ){
				// $val = $this->actionUpdate( $model->id_reporte_operativo_misional );
				$val = $model->id_reporte_operativo_misional;
			}
		}
		
		return $val;
	}
	
	public function actionConsultarIntervencionIeo( $id )
	{
		$val = [];
		
		$modelIntervencion = CbacIntervencionIeo::findOne( $id );
		
		foreach( $modelIntervencion as $key => $value ){
			$val[$key] = $value;
		}
		
		$equipo = CbacEquiposCampo::findOne( $modelIntervencion->id_equipo_campos );
		
		$val['equipo_nombre'] = '';
		if( $equipo && $equipo->nombre )
			$val['equipo_nombre'] = $equipo->nombre;
		
		return Json::encode($val);
	}

    /**
     * Lists all CbacReporteOperativoMisional models.
     * @return mixed
     */
    public function actionIndex()
    {
		// self::crearReporteOperativoMisional(5);
		
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
		
        $dataProvider = new ActiveDataProvider([
            'query' => CbacReporteOperativoMisional::find()->where(['estado' => 1]),
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
		
		$contenedores = [];
		
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
		
		if( count($contenedores) > 0 )
		{	
			echo Collapse::widget([
				'items' => $contenedores,
			]);
		}
		
		
		// $proyectos = new CbacRomProyectos();
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
     * Displays a single CbacReporteOperativoMisional model.
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
     * Creates a new CbacReporteOperativoMisional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$id_perfil_persona = $_SESSION['perfilesxpersonas'];
		
		// $model = CbacReporteOperativoMisional::findOne([
							// 'estado'			=> 1,
							// 'id_institucion' 	=> $id_institucion,
							// 'id_sedes' 			=> $id_sede,
						// ]);
		
		// if( !$model ){
			// $model = new CbacReporteOperativoMisional();
		// }
		
		$model = new CbacReporteOperativoMisional();
		
		$idInstitucion = $_SESSION['instituciones'][0];
		
        $institucion = Instituciones::findOne($idInstitucion);
        if ($model->load(Yii::$app->request->post())) 
		{
            if($model->save())
			{
                $rom_id = $model->id;
				
				$insertar = [];
				
				if($arrayDatosActividades = Yii::$app->request->post('CbacActividadesRom'))
				{
				
					// se agrega el id del reporte despues de haber sido creado 
					foreach($arrayDatosActividades as $datos => $valores)
					{
						$insertar[$datos] = 	!empty( $arrayDatosActividades[$datos]['fecha_desde'] ) 
											 && !empty( $arrayDatosActividades[$datos]['sesion_actividad'] )
											 && !empty( $arrayDatosActividades[$datos]['estado_actividad'] );
						
						$arrayDatosActividades[$datos]['id_reporte_operativo_misional']= $rom_id;
						$arrayDatosActividades[$datos]['estado']= 1;
						$arrayDatosActividades[$datos]['id_rom_actividad']= $datos;
					}
					
					$arrayDatosActividades2 = [];
					foreach( $insertar as $k => $v ){
						if( $v ){
							$arrayDatosActividades2[] = $arrayDatosActividades[$k];
						}
					}
					
					//guarda la informa en la tabla cbac.actividades segun como vienen los datos en el post
					$columnNameArrayActividades=['nro_semana','fecha_desde','fecha_hasta','sesion_actividad','estado_actividad','id_reporte_operativo_misional','estado','id_rom_actividad'];
					// $columnNameArrayActividades=['fecha_desde','fecha_hasta','sesion_actividad','estado_actividad','id_reporte_operativo_misional','estado'];
					// inserta todos los datos que trae el array arrayDatosActividades
					$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert('cbac.actividades_rom', $columnNameArrayActividades, $arrayDatosActividades2) ->execute();
				}
				
				//guarda todos los archivos en el servidor y la url en la base de datos
				//valida que el post tenga CbacEvidenciasRom y lo asigan a la variable $arrayDatosEvidencias
				if($arrayDatosEvidencias = Yii::$app->request->post('CbacEvidenciasRom'))
				{
					
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloEvidencias = [];
					$cantidad = count($arrayDatosEvidencias);
					// for( $i = 0; $i < $cantidad; $i++ )
					foreach( $arrayDatosEvidencias as $key => $value )
					{
						if( $insertar[$key] )
							$modeloEvidencias[$key] = new CbacEvidenciasRom();
					}
					
					//carga la informacion 
					if (CbacEvidenciasRom::loadMultiple($modeloEvidencias,  Yii::$app->request->post() )) 
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
						
						//array con los nombres de los campos de la tabla cbac.evidencias_rom
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
				
				if($arrayDatosTipos = Yii::$app->request->post('CbacTipoCantidadPoblacionRom'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloTipos 	= [];
					$cantidad 		= count( $arrayDatosTipos );
					foreach( $arrayDatosTipos as $k => $v )
					{
						if( $insertar[$k] )
							$modeloTipos[$k] = new CbacTipoCantidadPoblacionRom();
					}
					
					if(CbacTipoCantidadPoblacionRom::loadMultiple($modeloTipos,  Yii::$app->request->post() )) 
					{
						foreach( $modeloTipos as $key => $model )
						{
							$model->id_rom_actividades 				= $key;
							$model->id_reporte_operativo_misional 	= $rom_id;
							$model->total_participantes 			= "0";
							$model->estado 							= 1;
							$save = $model->save();
							
							// if( !$save ) exit( "error CbacTipoCantidadPoblacionRom 385" );
						}
					}
					// else{
						// exit( "error no carga CbacTipoCantidadPoblacionRom 385" );
					// }
				}
				// else{
					// exit( "error no array CbacTipoCantidadPoblacionRom 385" );
				// }
				
				if($arrayDatosIntegrante = Yii::$app->request->post('CbacActividadesRomXIntegranteGrupo'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloIntegrante 	= [];
					$cantidad 			= count( $arrayDatosIntegrante );
					foreach( $arrayDatosIntegrante as $k => $v )
					{
						if( $insertar[$k] )
							$modeloIntegrante[$k] = new CbacActividadesRomXIntegranteGrupo();
					}
					
					if(CbacActividadesRomXIntegranteGrupo::loadMultiple($modeloIntegrante,  Yii::$app->request->post() )) 
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
							// if( !$save ) exit( "error CbacActividadesRomXIntegranteGrupo 414" );
						}
					}
					// else{
						// exit( "error no carga CbacActividadesRomXIntegranteGrupo 414" );
					// }
				}
				// else{
					// exit( "error no array CbacActividadesRomXIntegranteGrupo 414" );
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
		
		$proyectos = new CbacRomProyectos();
		$proyectos = $proyectos->find()->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		$estados= $this->obtenerParametros(45);
		
		$datos = [];
		
		// $dataActividadesParticipadas = CbacActividadesIsa::find()
										// ->alias('a')
										// ->innerJoin('cbac.equipos_campo ec', 'ec.id=a.num_equipo_campo')
										// ->innerJoin('cbac.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
										// ->where( 'a.estado=1' )
										// ->andWhere( 'ie.estado=1' )
										// ->andWhere( 'ec.estado=1' )
										// ->andWhere( 'ie.id_perfil_persona_institucion='.$_SESSION['id'] )
										// ->all();
										
		// $dataActividadesParticipadas = CbacIntervencionIeo::find()
										// ->alias('i')
										// ->innerJoin('cbac.actividades_isa a', 'a.id=i.id_actividades_isa')
										// ->innerJoin('cbac.equipos_campo ec', 'ec.id=a.num_equipo_campo')
										// ->innerJoin('cbac.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
										// ->where( 'a.estado=1' )
										// ->andWhere( 'ie.estado=1' )
										// ->andWhere( 'ec.estado=1' )
										// ->andWhere( 'ie.id_perfil_persona_institucion='.$_SESSION['id'] )
										// ->all();
										
		// $dataActividadesParticipadas = CbacIntervencionIeo::find()
										// ->alias('i')
										// ->innerJoin('cbac.equipos_campo ec', 'ec.id=i.id_equipo_campos')
										// ->innerJoin('cbac.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
										// ->where( 'ie.estado=1' )
										// ->andWhere( 'ec.estado=1' )
										// ->andWhere( 'ie.id_perfil_persona_institucion='.$_SESSION['id'] )
										// ->all();
										
		// $actividadesParticipadas = ArrayHelper::map( $dataActividadesParticipadas,'id','nombre_actividad' );
		
		foreach( $proyectos as $idProyecto => $descripcionProyecto )
		{
			$proy = [
						'id' 			=> $idProyecto,
						'descripcion' 	=> $descripcionProyecto,
						'actividades_rom2' 	=> new CbacActividadesRom(),
						'procesos'		=> [],
					];
			
			$dataProcesos = CbacRomProcesos::find()
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
							
				$actividades = CbacRomActividades::find()
									->where( "estado=1 and id_rom_procesos=$idProceso" )
									->all();
									
				$actividades = ArrayHelper::map($actividades,'id','descripcion');
				
					   
				foreach( $actividades as $idActividad => $descripcionActividad )
				{
					// $dataActividadesParticipadas = CbacIntervencionIeo::find()
										// ->alias('i')
										// ->innerJoin('cbac.equipos_campo ec', 'ec.id=i.id_equipo_campos')
										// ->innerJoin('cbac.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
										// ->innerJoin('cbac.actividades_isa ai', 'ai.id=i.id_actividades_isa')
										// ->innerJoin('cbac.procesos_generales pg', 'pg.id=ai.id_procesos_generales')
										// ->where( 'ie.estado=1' )
										// ->andWhere( 'ec.estado=1' )
										// ->andWhere( 'ie.id_perfil_persona_institucion='.$_SESSION['id'] )
										// ->andWhere( 'pg.id='.$idActividad )
										// ->all();
										
					// $actividadesParticipadas = ArrayHelper::map( $dataActividadesParticipadas,'id','nombre_actividad' );
					
					// $dataActividadesParticipadas = CbacIntervencionIeo::find()
										// ->alias('i')
										// ->innerJoin('cbac.actividades_isa ai', 'ai.id=i.id_actividades_isa')
										// ->innerJoin('cbac.procesos_generales pg', 'pg.id=ai.id_procesos_generales')
										// ->where( 'i.estado=1' )
										// ->andWhere( 'pg.estado=1' )
										// ->andWhere('i.id_equipo_campos IS NULL')
										// ->andWhere( 'pg.id='.$idActividad )
										// ->all();
					
					// $actividadesParticipadas += ArrayHelper::map( $dataActividadesParticipadas,'id','nombre_actividad' );
					
					$dataActividadesParticipadas = CbacIntervencionIeo::find()
										->alias('i')
										->innerJoin('cbac.actividades_isa ai', 'ai.id=i.id_actividades_isa')
										->innerJoin('cbac.procesos_generales pg', 'pg.id=ai.id_procesos_generales')
										->where( 'i.estado=1' )
										->andWhere( 'pg.estado=1' )
										->andWhere( "i.nombre_actividad != ''" )
										->andWhere( "'".$_SESSION['id']."' = ANY(string_to_array( i.perfiles, ',' ) )" )
										// ->andWhere('i.id_equipo_campos IS NULL')
										->andWhere( 'pg.id='.$idActividad )
										->all();
					
					$actividadesParticipadas = ArrayHelper::map( $dataActividadesParticipadas,'id','nombre_actividad' );
					
					//Array de actividades
					$act =  [
								'id' 						=> $idActividad,
								'descripcion' 				=> $descripcionActividad,
								'actividades_rom' 			=> new CbacActividadesRom(),
								'evidencia'					=> new CbacEvidenciasRom(),
								'id_evidencia'				=> null,
								'poblacion'					=> new CbacTipoCantidadPoblacionRom(),
								'integrante'				=> new CbacActividadesRomXIntegranteGrupo(),
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
     * Updates an existing CbacReporteOperativoMisional model.
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
		
        $model = CbacReporteOperativoMisional::findOne( $id );
		
		$idInstitucion = $_SESSION['instituciones'][0];
		
        $institucion = Instituciones::findOne($idInstitucion);
	
        if ($model->load(Yii::$app->request->post())) 
		{
            if($model->save())
			{
                $rom_id = $model->id;
				
				if($arrayDatosActividades = Yii::$app->request->post('CbacActividadesRom'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloActividades 	= [];
					$cantidad 		= count( $arrayDatosActividades );
					foreach( $arrayDatosActividades as $k => $v )
					{
						$modeloActividades[$k] = CbacActividadesRom::findOne([ 
																	'estado' 						=> 1, 
																	'id_reporte_operativo_misional' => $rom_id,
																	'id_rom_actividad' 				=> $k,
																]);
					}
					
					if(CbacTipoCantidadPoblacionRom::loadMultiple($modeloActividades,  Yii::$app->request->post() )) 
					{
						foreach( $modeloActividades as $key => $model )
						{
							// $model->id_reporte_operativo_misional 	= $rom_id;
							// $model->estado 							= 1;
							$save = $model->save();
							
							if( !$save ) exit( "error CbacTipoCantidadPoblacionRom 781" );
						}
					}
					
					
				
					// // se agrega el id del reporte despues de haber sido creado 
					// foreach($arrayDatosActividades as $datos => $valores)
					// {
						// $arrayDatosActividades[$datos]['id_reporte_operativo_misional']= $rom_id;
						// $arrayDatosActividades[$datos]['estado']= 1;
						// // $arrayDatosActividades[$datos]['id_rom_actividad']= $datos;
					// }
					
					// //guarda la informa en la tabla cbac.actividades segun como vienen los datos en el post
					// // $columnNameArrayActividades=['fecha_desde','fecha_hasta','sesion_actividad','estado_actividad','id_reporte_operativo_misional','estado','id_rom_actividad'];
					// $columnNameArrayActividades=['fecha_desde','fecha_hasta','sesion_actividad','estado_actividad','id_reporte_operativo_misional','estado'];
					// // inserta todos los datos que trae el array arrayDatosActividades
					// $insertCount = Yii::$app->db->createCommand()
					   // ->batchInsert('cbac.actividades_rom', $columnNameArrayActividades, $arrayDatosActividades) ->execute();
				}
				
				// if($arrayDatosPoblacion = Yii::$app->request->post('CbacTipoCantidadPoblacionRom'))
				// {
					
					// // se agrega el id del reporte despues de haber sido creado 
					// foreach($arrayDatosPoblacion as $datos => $valores)
					// {
						// $arrayDatosPoblacion[$datos]['id_reporte_operativo_misional'] = $rom_id;
					// }
					
					// //guarda la informa en la tabla cbac.tipo_cantidad_poblacion_rom segun como vienen los datos en el post
					// $columnNameArrayPoblacion=['vecinos','lideres_comunitarios','empresarios_comerciantes','organizaciones_locales','grupos_comunitarios','otos_actores','total_participantes','id_rom_actividades','id_reporte_operativo_misional'];
					// // inserta todos los datos que trae el array arrayDatosActividades
					// $insertCount = Yii::$app->db->createCommand()
					   // ->batchInsert('cbac.tipo_cantidad_poblacion_rom', $columnNameArrayPoblacion, $arrayDatosPoblacion)->execute(); 
				// }
				
				//guarda todos los archivos en el servidor y la url en la base de datos
				//valida que el post tenga CbacEvidenciasRom y lo asigan a la variable $arrayDatosEvidencias
				if($arrayDatosEvidencias = Yii::$app->request->post('CbacEvidenciasRom'))
				{
					
					// //se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					// $modeloEvidencias = [];
					// $cantidad = count($arrayDatosEvidencias);
					// for( $i = 0; $i < $cantidad; $i++ )
					// {
						// $modeloEvidencias[] = new CbacEvidenciasRom();
					// }
					$modeloEvidencias = [];
					foreach( $arrayDatosEvidencias as $idRomActividad => $v )
					{
						$modeloEvidencias[ $idRomActividad ] = CbacEvidenciasRom::findOne([
																			'estado' 						=> 1,
																			'id_reporte_operativo_misional' => $id,
																			'id_rom_actividad' 				=> $idRomActividad,
																		]);
					}
					
					// $modeloEvidencias = CbacEvidenciasRom::find()
												// ->where('estado=1')
												// ->andWhere('id_reporte_operativo_misional='.$id)
												// ->all();
					// echo "<pre>"; var_dump( $modeloEvidencias ); echo "</pre>"; exit();
					//carga la informacion 
					if (CbacEvidenciasRom::loadMultiple($modeloEvidencias,  Yii::$app->request->post() )) 
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
						
						//array con los nombres de los campos de la tabla cbac.evidencias_rom
						$propiedades = array( "actas", "reportes", "listados", "plan_trabajo", "formato_seguimiento", "formato_evaluacion", "fotografias", "vidoes", "otros_productos");
						
						//recorre el array $modeloEvidencias con cada modelo creado dinamicamente
						foreach( $modeloEvidencias as $key => $model) 
						{	
							$k = $key;
							
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
							$k = $key;
							
							if( empty($arrayDatosEvidencias[$k]) )
								continue;
							
							$m->save(false);
						}
						
						// return $this->redirect(['index', 'guardado' => true ]);
					}
					// else{
						// exit("aaaaaaaaaaa");
					// }
					
				}
				
				if($arrayDatosTipos = Yii::$app->request->post('CbacTipoCantidadPoblacionRom'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloTipos 	= [];
					$cantidad 		= count( $arrayDatosTipos );
					foreach( $arrayDatosTipos as $k => $v )
					{
						$modeloTipos[$k] = CbacTipoCantidadPoblacionRom::findOne([ 
																	'estado' 						=> 1, 
																	'id_rom_actividades' 			=> $k,
																	'id_reporte_operativo_misional' => $id,
																]);
					}
					
					if(CbacTipoCantidadPoblacionRom::loadMultiple($modeloTipos,  Yii::$app->request->post() )) 
					{
						foreach( $modeloTipos as $key => $model )
						{
							$model->id_rom_actividades 				= $key;
							$model->id_reporte_operativo_misional 	= $rom_id;
							$model->total_participantes 			= "0";
							$model->estado 							= 1;
							$save = $model->save();
							
							if( !$save ) exit( "error CbacTipoCantidadPoblacionRom 781" );
						}
					}
					else{
						exit( "error no carga CbacTipoCantidadPoblacionRom 781" );
					}
				}
				else{
					exit( "error no array CbacTipoCantidadPoblacionRom 781" );
				}
				
				if($arrayDatosIntegrante = Yii::$app->request->post('CbacActividadesRomXIntegranteGrupo'))
				{
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloIntegrante 	= [];
					$cantidad 			= count( $arrayDatosIntegrante );
					foreach( $arrayDatosIntegrante as $k => $v )
					{
						$modeloIntegrante[$k] = CbacActividadesRomXIntegranteGrupo::findOne([ 
																	'estado' 						=> 1, 
																	'diligencia' 					=> $id_perfil_persona,
																	'id_rom_actividad' 				=> $k,
																	'id_reporte_operativo_misional' => $id,
																]);
						
						//Si no encuentra el registro signifca que debe ser nuevo ya que esta parte es individual por persona
						if( !$modeloIntegrante[$k] ){
							$modeloIntegrante[$k] = new CbacActividadesRomXIntegranteGrupo();
						}
					}
					
					if(CbacActividadesRomXIntegranteGrupo::loadMultiple($modeloIntegrante,  Yii::$app->request->post() )) 
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
							if( !$save ) exit( "error CbacActividadesRomXIntegranteGrupo 830" );
						}
					}
					else{
						exit( "error no carga CbacActividadesRomXIntegranteGrupo 830" );
					}
				}
				else{
					exit( "error no array CbacActividadesRomXIntegranteGrupo 830" );
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
		
		$proyectos = new CbacRomProyectos();
		$proyectos = $proyectos->find()
							->alias( 'py' )
							->innerJoin( 'cbac.rom_procesos p', 'p.id_rom_proyectos=py.id' )
							->innerJoin( 'cbac.rom_actividades a', 'a.id_rom_procesos=p.id' )
							->innerJoin( 'cbac.evidencias_rom er', 'er.id_rom_actividad = a.id' )
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
						'actividades_rom2'	=> CbacActividadesRom::findOne([ 
																	'id_reporte_operativo_misional' => $id,
																	'estado' 						=> 1,
																]),
						'procesos'			=> [],
					];
			
			$dataProcesos = CbacRomProcesos::find()
								->alias( 'p' )
								->innerJoin( 'cbac.rom_actividades a', 'a.id_rom_procesos=p.id' )
								->innerJoin( 'cbac.evidencias_rom er', 'er.id_rom_actividad = a.id' )
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
							
				$evidencias = CbacEvidenciasRom::find()
										->alias('er')
										->innerJoin( 'cbac.rom_actividades a', 'a.id=er.id_rom_actividad' )
										->where('er.estado=1')
										->andWhere('a.estado=1')
										->andWhere('a.id_rom_procesos='.$idProceso)
										->andWhere( 'er.id_reporte_operativo_misional='.$id )
										->all();
				// $evidencias = ArrayHelper::map($evidencias,'id','descripcion');
				
				$actividades = CbacRomActividades::find()
									->where( "estado=1 and id_rom_procesos=$idProceso" )
									->all();
				
					   
				foreach( $actividades as $actividad )
				{
					$actividades_rom_upt = CbacActividadesRom::findOne([ 
															'id_reporte_operativo_misional' => $id,
															'id_rom_actividad' 				=> $actividad->id,
															'estado' 						=> 1,
														]);
							
					if( !$actividades_rom_upt )
						continue;
							
					$dataActividadesParticipadas= CbacIntervencionIeo::findOne( $actividades_rom_upt->sesion_actividad );
										
					$actividadesParticipadas 	= [ $dataActividadesParticipadas->id => $dataActividadesParticipadas->nombre_actividad ];
					
					$modelIntegrante 			= CbacActividadesRomXIntegranteGrupo::findOne([ 
																	'estado' 						=> 1, 
																	'diligencia' 					=> $id_perfil_persona,
																	'id_rom_actividad' 				=> $actividad->id,
																	'id_reporte_operativo_misional' => $id,
																]);
																
					if( !$modelIntegrante ){
						$modelIntegrante = new CbacActividadesRomXIntegranteGrupo();
					}
					
					//Array de actividades
					$act =  [
								'id' 						=> $actividad->id,
								'descripcion' 				=> CbacRomActividades::findOne( $actividad->id )->descripcion,
								'actividades_rom'			=> $actividades_rom_upt,
								'evidencia'					=> new CbacEvidenciasRom(),
								'id_evidencia'				=> CbacEvidenciasRom::findOne([
																			'estado' => 1,
																			'id_rom_actividad' => $actividad->id,
																			'id_reporte_operativo_misional' => $id,
																		])->id,
								'poblacion'					=> CbacTipoCantidadPoblacionRom::findOne([ 
																	'estado' 						=> 1, 
																	'id_rom_actividades' 			=> $actividad->id,
																	'id_reporte_operativo_misional' => $id,
																]),
								'integrante'				=> $modelIntegrante,
								'datosSoloLectura' 			=> CbacIntervencionIeo::findOne([
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
		
		// $dataActividadesParticipadas = CbacActividadesIsa::find()
											// ->alias('a')
											// ->innerJoin('cbac.equipos_campo ec', 'ec.id=a.num_equipo_campo')
											// ->innerJoin('cbac.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
											// ->where( 'a.estado=1' )
											// ->andWhere( 'ie.estado=1' )
											// ->andWhere( 'ec.estado=1' )
											// ->andWhere( 'ie.id_perfil_persona_institucion='.$id_perfil_persona )
											// ->all();
										
		// $actividadesParticipadas = ArrayHelper::map( $dataActividadesParticipadas,'id','descripcion' );
		
		$dataActividadesParticipadas = CbacIntervencionIeo::find()
										->alias('i')
										->innerJoin('cbac.actividades_isa a', 'a.id=i.id_actividades_isa')
										->innerJoin('cbac.equipos_campo ec', 'ec.id=a.num_equipo_campo')
										->innerJoin('cbac.integrantes_x_equipo ie', 'ie.id_equipo_campo=ec.id')
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
     * Deletes an existing CbacReporteOperativoMisional model.
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
     * Finds the CbacReporteOperativoMisional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacReporteOperativoMisional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacReporteOperativoMisional::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
