<?php

/**********
Versión: 001
Fecha: 13-03-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud IEO
---------------------------------------
Modificaciones:
Fecha: 13-03-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: Se ajusta la funcion actionCreate para subir archivos y guardar la ruta 
Cambios realizados: Se ajusta la funcion actionUpdate para borrar los archivos subidor y subir archivos y guardar la ruta 
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
use app\models\Ieo;
use app\models\DocumentosReconocimiento;
use app\models\TiposCantidadPoblacion;
use app\models\Evidencias;
use app\models\TipoDocumentos;
use app\models\Producto;
use yii\bootstrap\Collapse;

use app\models\ZonasEducativas;
use app\models\PerfilesXPersonasInstitucion;
use app\models\PerfilesXPersonas;
use app\models\Personas;
use app\models\ComunasCorregimientos;
use app\models\BarriosVeredas;
use app\models\EcProyectosGenerales;

use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Instituciones;
use app\models\EstudiantesIeo;

/**
 * IeoController implements the CRUD actions for Ieo model.
 */
class IeoController extends Controller
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

    function actionViewFases($model, $form, $datos, $persona, $idTipoInforme)
	{
        
        // $model = new Ieo();
		
		$idInstitucion = $_SESSION['instituciones'][0];

        $idPerfilesXpersonas	= PerfilesXPersonasInstitucion::find()->where( "id_institucion = $idInstitucion" )->all();
		$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
        $nombres1 				= Personas::find($perfiles_x_persona)->all();
        $nombres	 = ArrayHelper::map( $nombres1, 'id', 'nombres');
        
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand(
		"
			select 
				p.descripcion,p.id
			from 
				ec.tipo_informe as ti, 
				ec.componentes as c, 
				ec.proyectos as p
			where 
				ti.id = $idTipoInforme
			and 
				ti.id_componente = c.id
			and 
				c.descripcion = p.descripcion
			
		");
		$ecProyectos = $command->queryAll();
		
		$descripcionProyecto = $ecProyectos[0]['descripcion'];
		
		$proyectos = new EcProyectosGenerales();
		$proyectos = $proyectos->find()->AndWhere("descripcion ='$descripcionProyecto' and tipo_proyecto = 1")->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		//colores del acordeon
		$arrayColores = array
		(
			"Proyectos Pedagógicos Transversales"=>"panel panel-danger",
			"Articulación Familiar" =>"panel panel-info",
			"Proyecto de Servicio Social Estudiantil"=>"panel panel-success",
			"Proyecto Fortalecimiento de Competencias Básicas desde la Transversalidad"=>"panel-warning"
		);
		
		$contenedores = array();
		// $ecProyectos = ArrayHelper::map($ecProyectos,'id','descripcion');
		foreach ($proyectos as $idProyecto => $proyecto)
		{
			 $contenedores[] = 	
				[
					'label' 		=>  $proyecto,
					'content' 		=>  $this->renderPartial( 'actividades', 
													[  
                                                        'idProyecto' => $idProyecto,
														'form' => $form,
														'datos'=>$datos,
														"persona" => $persona,
														"nombres" => $nombres,
														"idTipoInforme" => $idTipoInforme,
														'proyecto' =>  $proyecto,
														'model' => $model
													] 
										),
					 'contentOptions' => ['class' => 'in'],
					 'options' => ['class' => $arrayColores[$proyecto] ]
				];
	
		}
		
		 echo Collapse::widget([
			'items' => $contenedores,
		]);
		
	
	}

    /**
     * Lists all Ieo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0, $idTipoInforme = 0)
    {

        $query = Ieo::find()->where(['estado' => 1,'id_tipo_informe' => $idTipoInforme]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'idTipoInforme' => $idTipoInforme,
            'guardado' => $guardado,
        ]);
    }

    /**
     * Displays a single Ieo model.
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
     * Creates a new Ieo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idTipoInforme)
    {
        /**
         * Se realiza registro del modelo base IEO
         * Obtenemos el id de iserción para usarlo como llave foranea en los demas modelos 
         */
        
        $idInstitucion = $_SESSION['instituciones'][0];
        $data = [];
        $institucion = Instituciones::findOne( $idInstitucion );
      
        $ieo_model = new Ieo();
       
        if ($ieo_model->load(Yii::$app->request->post())) 
		{
            
			$ieo_model->institucion_id = $idInstitucion;
            $ieo_model->estado = 1;
            $ieo_model->sede_id = $_SESSION["sede"][0] != "-1" ? $_SESSION["sede"][0] : 2;
			
            
            /**Registro de Modelo Base y todos los modelos realacionados con documentación */
            if($ieo_model->save())
			{
                $id_ieo = $ieo_model->id;

                /**Carga de archivos multiples */
                // if($arrayDatosRequerimientos = Yii::$app->request->post('RequerimientoExtraIeo'))
				// {
                    
                    // $modelRequerimiento = [];

                    // for( $i = 0; $i < 8; $i++ )
					// {
                        // $modelRequerimiento[] = new RequerimientoExtraIeo();
                    // }
                    // if (RequerimientoExtraIeo::loadMultiple($modelRequerimiento, Yii::$app->request->post() )) {
                       
                        // // se guarda la informacion en una carpeta con el nombre del codigo dane de la institucion seleccionada
						// $idInstitucion 	= $_SESSION['instituciones'][0];
                        // $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                        // $carpeta = "../documentos/documentosIeo/requerimientoExtra/".$institucion;
						// if (!file_exists($carpeta)) 
						// {
							// mkdir($carpeta, 0777, true);
                        // }

                        // $propiedades = array( "socializacion_ruta", "soporte_necesidad");
                        
                        // // recorre el array $modelRequerimiento con cada modelo creado dinamicamente
						// foreach( $modelRequerimiento as $key => $model) 
						// {

                            // $key +=1;
							
							// // recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
							// // para posteriormente guardar en la base de datos
							// foreach($propiedades as $propiedad)
							// {
                                // $arrayRutasFisicas = array();
								// // se guarda el archivo en file
								
								// // se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
								// $files = UploadedFile::getInstances( $model, "[$key]$propiedad" );
								
								// if( $files )
								// {
									// // se suben todos los archivos uno por uno
									// foreach($files as $file)
									// {
										// // se usan microsegundos para evitar un nombre de archivo repetido
										// $t = microtime(true);
										// $micro = sprintf("%06d",($t - floor($t)) * 1000000);
										// $d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
										
										// // Construyo la ruta completa del archivo a guardar
										// $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/requerimientoExtra/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
										// $save = $file->saveAs( $rutaFisicaDirectoriaUploads );
										// // rutas de todos los archivos
										// $arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
									// }
                                    
									// // asignacion de la ruta al campo de la db
                                    // $model->$propiedad = implode(",", $arrayRutasFisicas);
                                    
									// // $model->$propiedad =  $var;
									// $arrayRutasFisicas = null;
								// }
								// else
								// {
									// echo "No hay archivo cargado";
								// }
                            // }

                            // // se deben asignar los valores ya que se crean los modelos dinamicamente, yii no los agrega
							// // los datos que vienen por post
                            // $model->ieo_id = $id_ieo;
                            // $model->proyecto_ieo_id = isset($arrayDatosRequerimientos[$key]['proyecto_ieo_id']) ? $arrayDatosRequerimientos[$key]['proyecto_ieo_id'] : 0;
                            // $model->actividad_id = isset($arrayDatosRequerimientos[$key]['proyecto_ieo_id']) ? $arrayDatosRequerimientos[$key]['proyecto_ieo_id'] : 0;
                            
                            // // Guarda la informacion que tiene $model en la base de datos
							// foreach( $modelRequerimiento as $key => $model) 
							// {
                                // if($model->socializacion_ruta){
                                    // $model->save();
                                // }								
							// }
							
                        // }
                        
                    // }
                // }
                /**Carga de archivos multiples */
                if($arrayDatosDocumentos = Yii::$app->request->post('DocumentosReconocimiento'))
				{
                    $modelDocumentos = [];
					
                    for( $i = 0; $i < 2 ; $i++ )
					{
                        $modelDocumentos[] = new DocumentosReconocimiento();
                    }                    
                    if (DocumentosReconocimiento::loadMultiple($modelDocumentos, Yii::$app->request->post() )) 
					{
                     
                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                        $carpeta = "../documentos/documentosIeo/documentosReconocimiento/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
                        }
                        $propiedades = array( "informe_caracterizacion", "matriz_caracterizacion", "revision_pei", "revision_autoevaluacion", "revision_pmi", "resultados_caracterizacion");
                        
                        foreach( $modelDocumentos as $key => $model) 
                        {
                            $key +=1;
                            //recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
                            //para posteriormente guardar en la base de datos
                            foreach($propiedades as $propiedad)
                            {
								 
                                $arrayRutasFisicas = array();
                                // se guarda el archivo en file
                                
                                // se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
                                $files = UploadedFile::getInstances( $model, "[$key]$propiedad" );
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
                                        $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/documentosReconocimiento/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
                                        $save = $file->saveAs( $rutaFisicaDirectoriaUploads );
                                        //rutas de todos los archivos
                                        $arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
                                    }
                                    
                                    // asignacion de la ruta al campo de la db
                                    $model->$propiedad = implode(",", $arrayRutasFisicas);
                                    
                                    // $model->$propiedad =  $var;
                                    $arrayRutasFisicas = null;
                                }
                                else
                                {
                                    echo "No hay archivo cargado";
                                }
							}

                 
                            $model->ieo_id = $id_ieo;
                            $model->proyecto_ieo_id = isset($arrayDatosDocumentos[$key]['proyecto_ieo_id']) ? $arrayDatosDocumentos[$key]['proyecto_ieo_id'] : 0;
                            $model->actividad_id = isset($arrayDatosDocumentos[$key]['actividad_id']) ? $arrayDatosDocumentos[$key]['actividad_id'] : 0;
                            $model->horario_trabajo = isset($arrayDatosDocumentos[$key]['horario_trabajo']) ? $arrayDatosDocumentos[$key]['horario_trabajo'] : 0;

							
							
                            //Guarda la informacion que tiene $model en la base de datos
                            foreach( $modelDocumentos as $key => $model) 
                            {
                                if($model->informe_caracterizacion)
								{

                                    $model->save();
                                }								
                            }

                        }
                    
                    }
                }
                 /**Carga de archivos multiples */
                if($arrayDatosEvidencias = Yii::$app->request->post('Evidencias'))
				{
                    $modelEvidencias = [];

                    for( $i = 0; $i < 8; $i++ ){
                        $modelEvidencias[] = new Evidencias();
                    }  

                    if (Evidencias::loadMultiple($modelEvidencias, Yii::$app->request->post() )) {
                        
                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                        $carpeta = "../documentos/documentosIeo/actividades/evidencias/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
                        }

                        $propiedades = array( "producto_ruta", "resultados_actividad_ruta", "acta_ruta", "listado_ruta", "fotografias_ruta");
                        
                        foreach( $modelEvidencias as $key => $model) 
                        {
                            $key +=1;
                            //recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
                            //para posteriormente guardar en la base de datos
                            foreach($propiedades as $propiedad)
                            {
                                $arrayRutasFisicas = array();
                                // se guarda el archivo en file
                                
                                // se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
                                $files = UploadedFile::getInstances( $model, "[$key]$propiedad" );
                                
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
                                        $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/actividades/evidencias/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
                                        $save = $file->saveAs( $rutaFisicaDirectoriaUploads );
                                        //rutas de todos los archivos
                                        $arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
                                    }
                                    
                                
                                    // asignacion de la ruta al campo de la db
                                    $model->$propiedad = implode(",", $arrayRutasFisicas);
                                    
                                    // $model->$propiedad =  $var;
                                    $arrayRutasFisicas = null;
                                }
                                else
                                {
                                    echo "No hay archivo cargado";
                                }
                            }

                            $model->ieo_id = $id_ieo;
                            $model->proyecto_id = isset($arrayDatosEvidencias[$key-1]['proyecto_id']) ? $arrayDatosEvidencias[$key-1]['proyecto_id'] : 0;
                            $model->actividad_id = isset($arrayDatosEvidencias[$key-1]['actividad_id']) ? $arrayDatosEvidencias[$key-1]['actividad_id'] : 0;

                            foreach( $modelEvidencias as $key => $model) 
                            {
                                if($model->producto_ruta){

                                    $model->save();
                                }								
                            }
                        }
                    }
                }

                /**Carga de archivos multiples */
                if($arrayDatosProducto = Yii::$app->request->post('Producto'))
				{ 
				
					$modelProductos = [];
					$cantProductos  = count($arrayDatosProducto);
				   
                    for( $i = 0; $i < $cantProductos; $i++ )
					{
                        $modelProductos[] = new Producto();
                    }
						
                    if (Producto::loadMultiple( $modelProductos, Yii::$app->request->post())) 
					{
						
                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;
					
                        $carpeta = "../documentos/documentosIeo/producto/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
                        }

                        $propiedades = array( "informe_ruta", "plan_accion_ruta","presentacion_plan");
						
                        foreach( $modelProductos  as $key => $model) 
                        {
                            
                            //recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
                            //para posteriormente guardar en la base de datos
                            foreach($propiedades as $propiedad)
                            {
                                $arrayRutasFisicas = array();
                                // se guarda el archivo en file
                              
                                // se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
                                $files = UploadedFile::getInstances( $model, "[$key]$propiedad" );
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
                                        $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/producto/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
                                        $save = $file->saveAs( $rutaFisicaDirectoriaUploads );
                                        //rutas de todos los archivos
                                        $arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
                                    }
                                    
                                    // asignacion de la ruta al campo de la db
                                    $model->$propiedad = implode(",", $arrayRutasFisicas);
                                    
                                    // $model->$propiedad =  $var;
                                    $arrayRutasFisicas = null;
                                }
                                else
                                {
                                    echo "No hay archivo cargado";
                                }
							}

                            $model->id_ieo = $id_ieo;
                            
                            foreach( $modelProductos as $key => $model) 
                            {
                                if($model->informe_ruta)
								{
                                    $model->save();
                                }								
                            }
                        }
                    }

                }

			//si el tipo de informe es 14 se hace un insert diferente
			if($idTipoInforme == 14 )
			{
				$arrayDatos = Yii::$app->request->post('TiposCantidadPoblacion');
			
				foreach($arrayDatos as $datos => $valores)
				{
					$arrayDatos[$datos]['actividad_id']=$datos;
					$arrayDatos[$datos]['ieo_id']=$id_ieo;
					unset($arrayDatos[$datos]['total']);
				}
		
				
				//se agrega el id del informe despues de haber sido creado 
									
				$columnName=['fecha_creacion', 'tipo_actividad', 'docentes', 'familia','directivos','actividad_id','ieo_id'];
				// inserta todos los datos que trae el array 
				
				$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert(
							 'ec.tipos_cantidad_poblacion', $columnName, $arrayDatos
						 )->execute();
						 
				// insert de los grados -> ecEstudiantesIeo
				
				$arrayDatos = Yii::$app->request->post('EstudiantesIeo');
				//se agrega el id del informe despues de haber sido creado 
				foreach($arrayDatos as $datos => $valores)
				{
					$arrayDatos[$datos]['actividad_id']=$datos;
					$arrayDatos[$datos]['ieo_id']=$id_ieo;
					unset($arrayDatos[$datos]['total']);
				}
				
				$columnName=['grado_9','grado_10','grado_11','id_actividad','id_ieo'];
				// inserta todos los datos que trae el array
				
				
				$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert(
							 'ec.estudiantes_ieo', $columnName, $arrayDatos
						 )->execute();
				
			}
			else
			{
			
				$arrayDatos = Yii::$app->request->post('TiposCantidadPoblacion');
				
				foreach($arrayDatos as $datos => $valores)
				{
					$arrayDatos[$datos]['actividad_id']=$datos;
					$arrayDatos[$datos]['ieo_id']=$id_ieo;
					unset($arrayDatos[$datos]['total']);
				}
				
				//se agrega el id del informe despues de haber sido creado 
				
							
				$columnName=['fecha_creacion', 'tipo_actividad', 'tiempo_libre', 'edu_derechos', 'sexualidad', 'ciudadania', 'medio_ambiente', 'familia','directivos','actividad_id','ieo_id'];
				// inserta todos los datos que trae el array 
				
				$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert(
							 'ec.tipos_cantidad_poblacion', $columnName, $arrayDatos
						 )->execute();
						 
						 
						 
				//insert de los grados -> ecEstudiantesIeo
				
				$arrayDatos = Yii::$app->request->post('EstudiantesIeo');
				//se agrega el id del informe despues de haber sido creado 
				foreach($arrayDatos as $datos => $valores)
				{
					$arrayDatos[$datos]['actividad_id']=$datos;
					$arrayDatos[$datos]['ieo_id']=$id_ieo;
					unset($arrayDatos[$datos]['total']);
				}

				$columnName=['grado_0', 'grado_1', 'grado_2', 'grado_3', 'grado_4', 'grado_5', 'grado_6', 'grado_7','grado_8','grado_9','grado_10','grado_11','id_actividad','id_ieo'];
				// inserta todos los datos que trae el array
				
				
				$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert(
							 'ec.estudiantes_ieo', $columnName, $arrayDatos
						 )->execute();
				} 
			}
			return $this->redirect(['index', 'guardado' => 1, 'idTipoInforme' => $idTipoInforme ]);
        }
		
		$idZonaEducativa = Instituciones::findOne( $idInstitucion )->id_zona_educativa;
        
		$ZonasEducatibas  = ZonasEducativas::find()->where(" estado=1 and id = $idZonaEducativa " )->all();
        $zonasEducativas  = ArrayHelper::map( $ZonasEducatibas, 'id', 'descripcion' );

        $comunas  = ComunasCorregimientos::find()->where( 'estado=1' )->all();
        $comunas	 = ArrayHelper::map( $comunas, 'id', 'descripcion' );
        
        
        return $this->renderAjax('create', [
            'model' => $ieo_model,
            'zonasEducativas' => $zonasEducativas,
            'comunas' => $comunas
        ]);
    }


    public function actionLists($id)
    {
        
        $countBarrios = BarriosVeredas::find()
                ->where(['id_comunas_corregimientos' => $id, 'estado'  => '1'])
                ->count();

        $barrios = BarriosVeredas::find()
                ->where(['id_comunas_corregimientos' => $id, 'estado'  => '1'])
                ->orderBy('id DESC')
                ->all();

        if($countBarrios>0)
		{
            foreach($barrios as $barrio)
			{
                echo "<option value='".$barrio->id."'>".$barrio->descripcion."</option>";
            }
        }
        else
		{
            // echo "<option value ='0'>-</option>";
        }
        
        //echo "<option>-</option>";

    }
    
    /**
     * Updates an existing Ieo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$datos = array();
		
	
		$documentosRe = new DocumentosReconocimiento();
		$documentosRe = $documentosRe->find()->where("ieo_id =  $id")->all();
		$documentosRe = ArrayHelper::map($documentosRe,'id','horario_trabajo');
		
        // if ($model->load(Yii::$app->request->post()) && $model->save()) 
        if ($model->load(Yii::$app->request->post())) 
		{
			
			$connection = Yii::$app->getDb();		
			//se actualiza la tabla tipos_cantidad_poblacion 
			foreach(Yii::$app->request->post('TiposCantidadPoblacion') as $actividad_id => $poblacion )
			{
				
				$tiempo_libre	=  isset($poblacion['tiempo_libre']) ? $poblacion['tiempo_libre']: 'null' ;
				$edu_derechos 	=  isset($poblacion['edu_derechos']) ? $poblacion['edu_derechos']: 'null' ;
				$sexualidad 	=  isset($poblacion['sexualidad']) ? $poblacion['sexualidad']: 'null' ;
				$ciudadania 	=  isset($poblacion['ciudadania']) ? $poblacion['ciudadania']: 'null' ;
				$medio_ambiente	=  isset($poblacion['medio_ambiente']) ? $poblacion['medio_ambiente']: 'null' ;
				$familia 		=  isset($poblacion['familia']) ? $poblacion['familia']: 'null' ;
				$directivos 	=  isset($poblacion['directivos']) ? $poblacion['directivos']: 'null' ;
				$fecha_creacion =  isset($poblacion['fecha_creacion']) ? $poblacion['fecha_creacion']: 'null' ;
				$tipo_actividad =  isset($poblacion['tipo_actividad']) ? $poblacion['tipo_actividad']: 'null' ;
				$docentes 		=  isset($poblacion['docentes']) ? $poblacion['docentes']: 'null' ;
				
				
				$command = $connection->createCommand(
				"
					UPDATE ec.tipos_cantidad_poblacion
					SET  
						
						tiempo_libre 	= $tiempo_libre ,
						edu_derechos	= $edu_derechos,
						sexualidad		= $sexualidad,
						ciudadania		= $ciudadania,
						medio_ambiente	= $medio_ambiente ,
						familia			= $familia,
						directivos		= $directivos, 
						fecha_creacion	= '$fecha_creacion',
						tipo_actividad	= $tipo_actividad,
						docentes		= $docentes
						
					WHERE 
						ieo_id = $id
					AND 
						actividad_id = $actividad_id
				");
				$result = $command->queryAll();
			}
			
			foreach(Yii::$app->request->post('EstudiantesIeo') as $actividad_id => $estudiantes )
			{
				
				$grado_0	=  isset($estudiantes['grado_0']) ? $estudiantes['grado_0']: 'null' ;
				$grado_1	=  isset($estudiantes['grado_1']) ? $estudiantes['grado_1']: 'null' ;
				$grado_2	=  isset($estudiantes['grado_2']) ? $estudiantes['grado_2']: 'null' ;
				$grado_3	=  isset($estudiantes['grado_3']) ? $estudiantes['grado_3']: 'null' ;
				$grado_4	=  isset($estudiantes['grado_4']) ? $estudiantes['grado_4']: 'null' ;
				$grado_5	=  isset($estudiantes['grado_5']) ? $estudiantes['grado_5']: 'null' ;
				$grado_6	=  isset($estudiantes['grado_6']) ? $estudiantes['grado_6']: 'null' ;
				$grado_7	=  isset($estudiantes['grado_7']) ? $estudiantes['grado_7']: 'null' ;
				$grado_8	=  isset($estudiantes['grado_8']) ? $estudiantes['grado_8']: 'null' ;
				$grado_9	=  isset($estudiantes['grado_9']) ? $estudiantes['grado_9']: 'null' ;
				$grado_10	=  isset($estudiantes['grado_10']) ? $estudiantes['grado_10']: 'null' ;
				$grado_11	=  isset($estudiantes['grado_11']) ? $estudiantes['grado_11']: 'null' ;
				
				$command = $connection->createCommand(
				"
				
				UPDATE 
					ec.estudiantes_ieo
				SET 
					grado_0 = $grado_0, 
					grado_1 = $grado_1, 
					grado_2 = $grado_2, 
					grado_3 = $grado_3, 
					grado_4 = $grado_4, 
					grado_5 = $grado_5,
					grado_6 = $grado_6,
					grado_7 = $grado_7,
					grado_8 = $grado_8,
					grado_9 = $grado_9,
					grado_10 = $grado_10,
					grado_11 = $grado_11
				WHERE 
					id_ieo = $id
				AND 
					id_actividad = $actividad_id
				");
				$result = $command->queryAll();
			}
				

				$datosDocumentos = Yii::$app->request->post('DocumentosReconocimiento');
				//actualizar el campo horario_trabajo de la tabla ec.documentos_reconocimiento
				//id del registro para actualizarlo key($documentosRe)
				$documentoR = DocumentosReconocimiento::findOne(key($documentosRe));
				$documentoR->horario_trabajo =	$datosDocumentos[1]['horario_trabajo'];
				$documentoR->save(false);
				
				
				/**Carga de archivos multiples */
                if($arrayDatosDocumentos = Yii::$app->request->post('DocumentosReconocimiento'))
				{
						
					$modelDocumentos = [];
					// se deben crear modelos igual al valor maximo del indice que tenga  Yii::$app->request->post('DocumentosReconocimiento') en esta caso es 2
                    for( $i = 0; $i <= 1 ; $i++ )
					{
                        $modelDocumentos[] = new DocumentosReconocimiento();
                    } 
					
                    if (DocumentosReconocimiento::loadMultiple($modelDocumentos, Yii::$app->request->post())) 
					{
                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                        $carpeta = "../documentos/documentosIeo/documentosReconocimiento/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
							
                        }
						
						$connection = Yii::$app->getDb();
						$command = $connection->createCommand("
							SELECT * FROM ec.documentos_reconocimiento
							WHERE ieo_id = $id
						");
						$resul = $command->queryAll();
						
						$informe_caracterizacion	= $resul[0]['informe_caracterizacion']; 
						$matriz_caracterizacion 	= $resul[0]['matriz_caracterizacion']; 
						$revision_pei 				= $resul[0]['revision_pei']; 
						$revision_autoevaluacion 	= $resul[0]['revision_autoevaluacion']; 
						$revision_pmi 				= $resul[0]['revision_pmi']; 
						$resultados_caracterizacion	= $resul[0]['resultados_caracterizacion']; 
						
                        $propiedades = array( "informe_caracterizacion", "matriz_caracterizacion", "revision_pei", "revision_autoevaluacion", "revision_pmi", "resultados_caracterizacion");
                        
					
                        foreach( $modelDocumentos as $key => $model1) 
                        {
                            // $key +=1;
                            //recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
                            //para posteriormente guardar en la base de datos
                            foreach($propiedades as $propiedad)
                            {
								
                                $arrayRutasFisicas = array();
                                // se guarda el archivo en file
                              
                                // se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
                                $files = UploadedFile::getInstances( $model1, "[$key]$propiedad" );
								
                                if( $files )
                                {
                                    //se suben todos los archivos uno por uno
                                    foreach($files as $file)
                                    {
										
										//se usan microsegundos para evitar un nombre de archivo repetido
										// Construyo la ruta completa del archivo a guardar
                                        $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/documentosReconocimiento/".$institucion."/".$file->baseName . $this->microSegundos() . '.' . $file->extension;
										
										//saber si el archivo ya existe
										$nombreArchivo = $file->name;
										$extensionArchivo =  pathinfo($nombreArchivo, PATHINFO_EXTENSION );
										$nombre_base = basename($nombreArchivo, '.'.$extensionArchivo);
										
										//la extencion debe estar en minuisculas para la combrobacion
										$extensionArchivo = strtolower($extensionArchivo);
										
										//se pasan las rutas que estan en la db en el campo $$propiedad para saber en que parte esta el archivo y sobreescribirlo
										$arrayRuta = explode(",",$$propiedad);	
										//saber si el nombre y la extencion del archivo ya existe en la base de datos / saber si ya existe el archivo se y se sobreescribe sin cambios en la db
										if (strpos ($$propiedad,$nombre_base) > 0 and strpos($$propiedad,$extensionArchivo ) > 0 )
										{
											//si archivo ya existe se sobreescribe sobreescribiendo la ruta de guardado
											// Construyo la ruta completa del archivo a guardar
											foreach ($arrayRuta as $ar)
											{
												if (strpos ($ar,$nombre_base) > 0 and strpos($ar,$extensionArchivo) > 0 )
												{
													$rutaFisicaDirectoriaUploads  = $ar;
												}
											}
										}
										
									
										//guardar el archivo fisicamente en el servidor
                                        $save = $file->saveAs( $rutaFisicaDirectoriaUploads );
                                        //rutas de todos los archivos
                                        $arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
                                    }
                                }
                                else
                                {
                                    // echo "No hay archivo cargado";
                                }
								
								//se actualiza el campo en la base de datos con las rutas; cuando se agregar un archivo nuevo se agrega esta ruta a las ya existentes
								$command = $connection->createCommand("
								UPDATE ec.documentos_reconocimiento
								set $propiedad = '". implode(",", $arrayRutasFisicas)."'
								WHERE ieo_id = $id
								");
								$resul = $command->queryAll();
								$arrayRutasFisicas = null;
							}
                        }
                    
                    }
                }
			
			
				
			   /**Carga de archivos multiples evidencias -> actividades */ 
                if($arrayDatosEvidencias = Yii::$app->request->post('Evidencias'))
				{
                    $modelEvidencias = [];
					
					
					foreach ($arrayDatosEvidencias as $llave => $valor)
					{
						 $modelEvidencias[$llave] = new Evidencias();
					}
                       
                    if (Evidencias::loadMultiple($modelEvidencias, Yii::$app->request->post() )) 
					{
                        
						
						$connection = Yii::$app->getDb();
						$command = $connection->createCommand("
							SELECT 
								id,
								producto_ruta,
								resultados_actividad_ruta, 
								acta_ruta, listado_ruta, 
								fotografias_ruta, 
								actividad_id
							FROM 
								ec.evidencias
							WHERE 
								ieo_id = $id
						");
						$resul = $command->queryAll();
						
                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;
						
						
						$producto_ruta				= $resul[0]['producto_ruta'];
						$resultados_actividad_ruta 	= $resul[0]['resultados_actividad_ruta'];
						$acta_ruta 					= $resul[0]['acta_ruta'];
						$listado_ruta				= $resul[0]['listado_ruta'];
						$fotografias_ruta			= $resul[0]['fotografias_ruta'];
						
						
                        $propiedades = array( "producto_ruta", "resultados_actividad_ruta", "acta_ruta", "listado_ruta", "fotografias_ruta");
                        $llave =0;
                        foreach( $modelEvidencias as $key => $model1) 
                        {
							$llave++;
							echo "<pre>"; print_r($key); echo "</pre>"; 
							echo "<br>";
                            //recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
                            //para posteriormente guardar en la base de datos
                            foreach($propiedades as $propiedad)
                            {
                                $arrayRutasFisicas = array();
                                // se guarda el archivo en file
                                
                                // se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
                                $files = UploadedFile::getInstances( $model1, "[$llave]$propiedad" );
                                
								echo "<pre>"; print_r($files); echo "</pre>"; 
                                if( $files )
                                {
                                    //se suben todos los archivos uno por uno
                                    foreach($files as $file)
                                    {
                                        //se usan microsegundos para evitar un nombre de archivo repetido
										// Construyo la ruta completa del archivo a guardar
                                        $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/documentosReconocimiento/".$institucion."/".$file->baseName . $this->microSegundos() . '.' . $file->extension;
										
										//saber si el archivo ya existe
										$nombreArchivo = $file->name;
										$extensionArchivo =  pathinfo($nombreArchivo, PATHINFO_EXTENSION );
										$nombre_base = basename($nombreArchivo, '.'.$extensionArchivo);
										
										//la extencion debe estar en minuisculas para la combrobacion
										$extensionArchivo = strtolower($extensionArchivo);
										
										//se pasan las rutas que estan en la db en el campo $$propiedad para saber en que parte esta el archivo y sobreescribirlo
										$arrayRuta = explode(",",$$propiedad);	
										//saber si el nombre y la extencion del archivo ya existe en la base de datos / saber si ya existe el archivo se y se sobreescribe sin cambios en la db
										if (strpos ($$propiedad,$nombre_base) > 0 and strpos($$propiedad,$extensionArchivo ) > 0 )
										{
											//si archivo ya existe se sobreescribe sobreescribiendo la ruta de guardado
											// Construyo la ruta completa del archivo a guardar
											foreach ($arrayRuta as $ar)
											{
												if (strpos ($ar,$nombre_base) > 0 and strpos($ar,$extensionArchivo) > 0 )
												{
													$rutaFisicaDirectoriaUploads  = $ar;
												}
											}
										}
										
										//guardar el archivo fisicamente en el servidor
                                        $save = $file->saveAs( $rutaFisicaDirectoriaUploads );
                                        //rutas de todos los archivos
                                        $arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
                                    }
                                    
                                    
                                $command = $connection->createCommand("
								UPDATE ec.evidencias
								set $propiedad = '". implode(",", $arrayRutasFisicas)."'
								WHERE 
									ieo_id = $id
								AND
									actividad_id = $key
								");
								$resul = $command->queryAll();
								$arrayRutasFisicas = null;
                                }
                                else
                                {
                                    echo "No hay archivo cargado";
                                }
                            }
                        }
                    }
                }
				die;
			
				 /**Carga de archivos multiples */
                if($arrayDatosProducto = Yii::$app->request->post('Producto'))
				{ 
					
					$modelProductos = [];
					$cantProductos  = count($arrayDatosProducto);
				   
                    for( $i = 0; $i < $cantProductos; $i++ )
					{
                        $modelProductos[] = new Producto();
                    }
						
                    if (Producto::loadMultiple( $modelProductos, Yii::$app->request->post())) 
					{
						
                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;
					
					
                        $carpeta = "../documentos/documentosIeo/producto/".$institucion;
						
						
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
                        }
						else
						{
							$this->borrarDirectorio($carpeta);
							$command = $connection->createCommand(
							"
							DELETE FROM ec.producto
							WHERE 
								id_ieo = $id
							");
							$result = $command->queryAll();
							mkdir($carpeta, 0777, true);
						}

                        $propiedades = array( "informe_ruta", "plan_accion_ruta","presentacion_plan");
						
                        foreach( $modelProductos  as $key => $model1) 
                        {
                            
                            //recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
                            //para posteriormente guardar en la base de datos
                            foreach($propiedades as $propiedad)
                            {
                                $arrayRutasFisicas = array();
                                // se guarda el archivo en file
                              
                                // se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
                                $files = UploadedFile::getInstances( $model1, "[$key]$propiedad" );
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
                                        $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/producto/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
                                        $save = $file->saveAs( $rutaFisicaDirectoriaUploads );
                                        //rutas de todos los archivos
                                        $arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
                                    }
                                    
                                    // asignacion de la ruta al campo de la db
                                    $model1->$propiedad = implode(",", $arrayRutasFisicas);
                                    
                                    // $model->$propiedad =  $var;
                                    $arrayRutasFisicas = null;
                                }
                                else
                                {
                                    echo "No hay archivo cargado";
                                }
							}

                            $model1->id_ieo = $id;
                            
                            foreach( $modelProductos as $key => $model1) 
                            {
                                if($model1->informe_ruta)
								{
                                    $model1->save();
                                }								
                            }
                        }
                    }

                }
				
				return $this->redirect(['index', 'idTipoInforme' => $model->id_tipo_informe]);
			}
		
		
            
        

		//se trae la informacion correspondiente y se agrupa en el array datos
		$cantidadPoblacion = new TiposCantidadPoblacion();
		$cantidadPoblacion = $cantidadPoblacion->find()->andWhere("ieo_id=$id")->all();
	       
		$resultCantidadPoblacion = ArrayHelper::getColumn($cantidadPoblacion, function ($element) 
        {
			
            $index = $element['actividad_id'];
            $dato[$index]['ieo_id']	= $element['ieo_id'];
            $dato[$index]['tiempo_libre']= $element['tiempo_libre'];
            $dato[$index]['edu_derechos']= $element['edu_derechos'];
            $dato[$index]['sexualidad']= $element['sexualidad'];
            $dato[$index]['ciudadania']= $element['ciudadania'];
            $dato[$index]['medio_ambiente']= $element['medio_ambiente'];
            $dato[$index]['familia']= $element['familia'];
            $dato[$index]['directivos']= $element['directivos'];
            $dato[$index]['fecha_creacion']= $element['fecha_creacion'];
            $dato[$index]['tipo_actividad']= $element['tipo_actividad'];
            $dato[$index]['docentes']= $element['docentes'];
           
            return $dato;
        });
									   
									   
        foreach	($resultCantidadPoblacion as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
                
                $datos['cantidadPoblacion'][$ids] = $valores;
        }

		
		$estudiantesIeo = new EstudiantesIeo();
		$estudiantesIeo = $estudiantesIeo->find()->andWhere("id_ieo=$id")->all();
	       
		$resultEstudiantesIeo = ArrayHelper::getColumn($estudiantesIeo, function ($element) 
        {
			
            $index = $element['id_actividad'];
            $dato[$index]['id_ieo']	= $element['id_ieo'];
            $dato[$index]['grado_0']= $element['grado_0'];
            $dato[$index]['grado_1']= $element['grado_1'];
            $dato[$index]['grado_2']= $element['grado_2'];
            $dato[$index]['grado_3']= $element['grado_3'];
            $dato[$index]['grado_4']= $element['grado_4'];
            $dato[$index]['grado_5']= $element['grado_5'];
            $dato[$index]['grado_6']= $element['grado_6'];
            $dato[$index]['grado_7']= $element['grado_7'];
            $dato[$index]['grado_8']= $element['grado_8'];
            $dato[$index]['grado_9']= $element['grado_9'];
            $dato[$index]['grado_10']= $element['grado_10'];
            $dato[$index]['grado_11']= $element['grado_11'];
           
            return $dato;
        });
		
		
        foreach	($resultEstudiantesIeo as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
                
                $datos['estudiantesIeo'][$ids] = $valores;
        }
		//llener el campo horario_trabajo de la tabla ec.documentos_reconocimiento
		$datos['DocumentosReconocimiento'] = $documentosRe[key($documentosRe)];

        $ZonasEducatibas  = ZonasEducativas::find()->where( 'estado=1' )->all();
		$zonasEducativas	 = ArrayHelper::map( $ZonasEducatibas, 'id', 'descripcion' );

		$comunas  = ComunasCorregimientos::find()->where( 'estado=1' )->all();
        $comunas	 = ArrayHelper::map( $comunas, 'id', 'descripcion' );


        return $this->renderAjax('update', [
            'model' => $model,
            'zonasEducativas' => $zonasEducativas,
            'datos'=> $datos,
            'comunas'=> $comunas,
        ]);
    }

    /**
     * Deletes an existing Ieo model.
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
       
        return $this->redirect(['index', 'idTipoInforme' => $model->id_tipo_informe]);
    }

	
	public function microSegundos()
	{
	
		$t = microtime(true);
		$micro = sprintf("%06d",($t - floor($t)) * 1000000);
		$d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
		
		return $d->format("Y_m_d_H_i_s.u");
	}
	
	
	public function borrarDirectorio($src) 
	{
		$dir = opendir($src);
		while(false !== ( $file = readdir($dir)) ) 
		{
			if (( $file != '.' ) && ( $file != '..' )) 
			{
				$full = $src . '/' . $file;
				if ( is_dir($full) ) 
				{
					rrmdir($full);
				}
				else 
				{
					unlink($full);
				}
			}
		}
		closedir($dir);
		rmdir($src);
	}
    /**
     * Finds the Ieo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ieo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ieo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
