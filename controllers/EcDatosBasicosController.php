<?php
/**********
Modificación: 
Fecha: 16-01-2019
Desarrollador: Edwin Molina G
Descripción: - Se modfica la vista
			 - Se quita la opción de editar
			 - Se agrega boton de volver en la vista index
			 - Los botones de volver en la vista index y create regresan al index
---------------------------------------
Fecha: 14-01-2019
Desarrollador: Edwin Molina G
Descripción: - Se corrige guardado agregando campo faltante en el modelo EcDatosBasicos
			 - Se agregan corrigen titulos en el model EcDatosBasicos
			 - Se agrega un swithc para que el botón volver regrese al menu correspondiente
---------------------------------------
*/


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
use app\models\EcDatosBasicos;
use app\models\EcDatosBasicosBuscar;
use app\models\Instituciones;
use app\models\EcPlaneacion;
use app\models\EcReportes;
use app\models\EcVerificacion;
use app\models\Parametro;

use app\models\Personas;
use app\models\Sedes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * EcDatosBasicosController implements the CRUD actions for EcDatosBasicos model.
 */
class EcDatosBasicosController extends Controller
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
     * Lists all EcDatosBasicos models.
     * @return mixed
     */
    public function actionIndex($guardado = 0, $idTipoInforme = 0)
    {
        $searchModel = new EcDatosBasicosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere( 'id_tipo_informe='.Yii::$app->request->get('idTipoInforme') )->andWhere( 'estado=1' );
		
		$urlVolver = "";

		switch( intval($_GET['idTipoInforme']) ){
			
			case 1: 
				$urlVolver = 'ec-competencias-basicas-proyectos/index';
				break;
				
			case 13: 
				$urlVolver = 'ec-competencias-basicas-proyectos-obligatorio/index';
				break;
				
			case 25: 
				$urlVolver = 'ec-competencias-basicas-proyectos-articulacion/index';
				break;
			
		}

        return $this->render('index', [
            'searchModel' 	=> $searchModel,
            'dataProvider' 	=> $dataProvider,
            'urlVolver' 	=> $urlVolver,
            'idTipoInforme' => $idTipoInforme,
            'guardado' => $guardado,
        ]);
    }

    /**
     * Displays a single EcDatosBasicos model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $guardado = 1, $urlVolver = '' )
    {
		$modelDatosBasico 	= $this->findModel($id);
        $modelPlaneacion	= EcPlaneacion::findOne(['id_datos_basicos' => $id ]);
        $modelVerificacion	= EcVerificacion::findOne(['id_planeacion' => $modelPlaneacion->id ]);
        $modelReportes		= EcReportes::findOne(['id_planeacion' => $modelPlaneacion->id ]);
		
        return $this->render('view', [
            'model' 			=> $modelDatosBasico,
            'modelPlaneacion' 	=> $modelPlaneacion,
            'modelVerificacion' => $modelVerificacion,
            'modelReportes' 	=> $modelReportes,
            'guardado' 	=> $guardado,
            'urlVolver' => $urlVolver,
        ]);
    }

    /**
     * Creates a new EcDatosBasicos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {	
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
        $modelDatosBasico 	= new EcDatosBasicos();
        $modelPlaneacion	= new EcPlaneacion();

        $modelReportes		= new EcReportes();
		
		$urlVolver = "";

		switch( intval($_SESSION["idTipoInforme"]) ){
			
			case 1: 
				$urlVolver = 'ec-competencias-basicas-proyectos/index';
				break;
				
			case 13: 
				$urlVolver = 'ec-competencias-basicas-proyectos-obligatorio/index';
				break;
				
			case 25: 
				$urlVolver = 'ec-competencias-basicas-proyectos-articulacion/index';
				break;
			
		}

        if ($modelDatosBasico->load(Yii::$app->request->post())) {
            $modelDatosBasico->id_institucion = $_SESSION['instituciones'][0];
            $modelDatosBasico->id_sede = $id_sede;
            $modelDatosBasico->estado = 1;
            $modelDatosBasico->id_tipo_informe = intval($_SESSION["idTipoInforme"]);

            if($modelDatosBasico->save()){
            
                if ($modelPlaneacion->load(Yii::$app->request->post())){
                    
                    $modelPlaneacion->id_datos_basicos = $modelDatosBasico->id;
                    $modelPlaneacion->estado = 1;

                    var_dump($modelPlaneacion->id_datos_basicos);
                    var_dump($modelPlaneacion->tipo_actividad);
                    var_dump($modelPlaneacion->fecha);
                    var_dump($modelPlaneacion->objetivo);
                    var_dump($modelPlaneacion->responsable);
                    var_dump($modelPlaneacion->rol);
                    var_dump($modelPlaneacion->descripcion_actividad);
                    var_dump($modelPlaneacion->estado);
                    var_dump($modelPlaneacion->estudiantes);
                    var_dump($modelPlaneacion->familias);
                    var_dump($modelPlaneacion->docentes);
                    var_dump($modelPlaneacion->directivos);
                    var_dump($modelPlaneacion->otros);
                    die();
                    
                    

                    if($modelPlaneacion->save()){

                        /*if ($modelVerificacion->load(Yii::$app->request->post())){

                            $ruta_archivo = UploadedFile::getInstance( $modelVerificacion, "ruta_archivo" );
            
                            if($ruta_archivo){
                                $institucion = Instituciones::findOne($_SESSION['instituciones'][0]);
                                $carpetaVerificacion = "../documentos/documentosPlaneacionReporteActividad/".$institucion->codigo_dane;
                                if (!file_exists($carpetaVerificacion)) {
                                    mkdir($carpetaVerificacion, 0777, true);
                                }
            
                                $rutaFisicaDirectoriaUploadVerificacion  = "../documentos/documentosPlaneacionReporteActividad/".$institucion->codigo_dane."/";
                                $rutaFisicaDirectoriaUploadVerificacion .= $ruta_archivo->baseName;
                                $rutaFisicaDirectoriaUploadVerificacion .= date( "_Y_m_d_His" ) . '.' . $ruta_archivo->extension;
                                $saveVerificacion = $ruta_archivo->saveAs( $rutaFisicaDirectoriaUploadVerificacion );
            
                                if($saveVerificacion){
                                    $modelVerificacion->id_planeacion = $modelPlaneacion->id;
                                    $modelVerificacion->ruta_archivo = $rutaFisicaDirectoriaUploadVerificacion;
                                    $modelVerificacion->estado = 1;            
                                    $modelVerificacion->save();
            
                                }
            
                            }
                        }*/
                        
                        if($arrayVerificacion = Yii::$app->request->post('EcVerificacion')){

                            $modelVerificacion = [];

                            for( $i = 0; $i < 6; $i++ ){
                                $modelVerificacion[] = new EcVerificacion();
                            }

                            //var_dump(count());
                            var_dump(count(Yii::$app->request->post()));
                            die();

                            if (EcVerificacion::loadMultiple($modelVerificacion, Yii::$app->request->post() )) {
                                die();
                                $idInstitucion 	= $_SESSION['instituciones'][0];
                                $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                                $carpeta = "../documentos/documentosPlaneacionReporteActividad/".$institucion;
                                if (!file_exists($carpeta)) 
                                {
                                    mkdir($carpeta, 0777, true);
                                }
                                
                                $propiedades = array("ruta_archivo");

                                    foreach( $modelVerificacion as $key => $model) 
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
                                                    $rutaFisicaDirectoriaUploads  = "../documentos/documentosPlaneacionReporteActividad/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
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
                                    
                                    $model->implementacion_ieo_id = $modelPlaneacion->id;
                                    $model->estado = 1;

                                    foreach( $modelVerificacion as $key => $model) 
                                    {
                                        if($model->ruta_archivo){

                                            $model->save();
                                        }								
                                    }
                                }

                            }
                        }

                       if ($modelReportes->load(Yii::$app->request->post())){
                            $modelReportes->id_planeacion = $modelPlaneacion->id;
                            $modelReportes->estado = 1;
                            $modelReportes->save();
                        }                        
                    }
                }
            }
            
            return $this->redirect(['index', 'guardado' => 1 , 'idTipoInforme' => $_SESSION["idTipoInforme"] ]);
        }


        $modelVerificacion	= new EcVerificacion();
        
		$dataTiposVerificacion = Parametro::find()
									->where( 'id_tipo_parametro=12' )
									->andWhere( 'estado=1' )
									->all();
									
		$tiposVerificacion = ArrayHelper::map( $dataTiposVerificacion, 'id', 'descripcion' );
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		
		$profesional		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		$sede = Sedes::findOne( $id_sede );
		$institucion = Instituciones::findOne( $id_institucion );

        return $this->renderAjax('create', [
            'modelDatosBasico' 	=> $modelDatosBasico,
            'modelPlaneacion' 	=> $modelPlaneacion,
            'modelVerificacion' => $modelVerificacion,
            'modelReportes' 	=> $modelReportes,
            'tiposVerificacion'	=> $tiposVerificacion,
            'profesional'		=> $profesional,
            'sede'				=> $sede,
            'institucion'		=> $institucion,
            'urlVolver'			=> $urlVolver,
        ]);
    }

    /**
     * Updates an existing EcDatosBasicos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {	
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$urlVolver = "";

		
		$modelDatosBasico 	= EcDatosBasicos::findOne($id);
        $modelPlaneacion	= EcPlaneacion::findOne(['id_datos_basicos' => $id ]);
        $modelVerificacion	= EcVerificacion::findOne(['id_planeacion' => $modelPlaneacion->id ]);
        $modelReportes		= EcReportes::findOne(['id_planeacion' => $modelPlaneacion->id ]);
		
		switch( $modelDatosBasico->id_tipo_informe ){
			
			case 1: 
				$urlVolver = 'ec-competencias-basicas-proyectos/index';
				break;
				
			case 13: 
				$urlVolver = 'ec-competencias-basicas-proyectos-obligatorio/index';
				break;
				
			case 25: 
				$urlVolver = 'ec-competencias-basicas-proyectos-articulacion/index';
				break;
			
		}

        if($modelDatosBasico->load(Yii::$app->request->post()) && $modelDatosBasico->save())
		{
			if($modelPlaneacion->load(Yii::$app->request->post()) && $modelPlaneacion->save())
			{
				if($modelVerificacion->load(Yii::$app->request->post()) /*&& $modelVerificacion->save()*/ )
				{	
					$ruta_archivo = UploadedFile::getInstance( $modelVerificacion, "ruta_archivo" );
            
					if($ruta_archivo)
					{
						$institucion = Instituciones::findOne($_SESSION['instituciones'][0]);
						$carpetaVerificacion = "../documentos/documentosPlaneacionReporteActividad/".$institucion->codigo_dane;
						if (!file_exists($carpetaVerificacion)) {
							mkdir($carpetaVerificacion, 0777, true);
						}
	
						$rutaFisicaDirectoriaUploadVerificacion  = "../documentos/documentosPlaneacionReporteActividad/".$institucion->codigo_dane."/";
						$rutaFisicaDirectoriaUploadVerificacion .= $ruta_archivo->baseName;
						$rutaFisicaDirectoriaUploadVerificacion .= date( "_Y_m_d_His" ) . '.' . $ruta_archivo->extension;
						$saveVerificacion = $ruta_archivo->saveAs( $rutaFisicaDirectoriaUploadVerificacion );
	
						if($saveVerificacion){
							// $modelVerificacion->id_planeacion = $modelPlaneacion->id;
							// $modelVerificacion->estado = 1;            
							$modelVerificacion->ruta_archivo = $rutaFisicaDirectoriaUploadVerificacion;
							
							if( $modelVerificacion->save() )
							{
								if($modelReportes->load(Yii::$app->request->post()) && $modelReportes->save())
								{
									return $this->redirect(['view', 'id' => $modelDatosBasico->id, 'guardado' => 1 , 'urlVolver' => $urlVolver ]);
								}
							}
						}
					}
				}
			}
        }
		
		$dataTiposVerificacion = Parametro::find()
									->where( 'id_tipo_parametro=12' )
									->andWhere( 'estado=1' )
									->all();
									
		$tiposVerificacion = ArrayHelper::map( $dataTiposVerificacion, 'id', 'descripcion' );
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		
		$profesional		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		$sede = Sedes::findOne( $id_sede );
		$institucion = Instituciones::findOne( $id_institucion );

        return $this->renderAjax('update', [
            'modelDatosBasico' 	=> $modelDatosBasico,
            'modelPlaneacion' 	=> $modelPlaneacion,
            'modelVerificacion' => $modelVerificacion,
            'modelReportes' 	=> $modelReportes,
            'tiposVerificacion'	=> $tiposVerificacion,
            'profesional'		=> $profesional,
            'sede'				=> $sede,
            'institucion'		=> $institucion,
            'urlVolver'			=> $urlVolver,
        ]);
    }

    /**
     * Deletes an existing EcDatosBasicos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $modelDatosBasico 	= $this->findModel($id);
		
		if( $modelDatosBasico )
		{
			$modelPlaneacion	= EcPlaneacion::findOne(['id_datos_basicos' => $id ]);
			
			if( $modelPlaneacion )
			{
				$modelVerificacion	= EcVerificacion::findOne(['id_planeacion' => $modelPlaneacion->id ]);
				$modelReportes		= EcReportes::findOne(['id_planeacion' => $modelPlaneacion->id ]);
				
				if( $modelVerificacion && $modelReportes )
				{
					$idTipoInforme = $modelDatosBasico->id_tipo_informe;
					
					$modelDatosBasico->estado 	= 2;
					$modelPlaneacion->estado 	= 2;
					$modelVerificacion->estado 	= 2;
					$modelReportes->estado		= 2;
					
					$modelDatosBasico->save(false);
					$modelPlaneacion->save(false);
					$modelVerificacion->save(false);
					$modelReportes->save(false);
        
					return $this->redirect(['index', 'idTipoInforme' => $idTipoInforme ]);
				}
			}
		}
    }

    /**
     * Finds the EcDatosBasicos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EcDatosBasicos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EcDatosBasicos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
