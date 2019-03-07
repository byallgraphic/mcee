<?php

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
use app\models\EcProducto;
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
        
        $model = new Ieo();
		
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
														"datos" => $datos,
														"persona" => $persona,
														"nombres" => $nombres,
														"idTipoInforme" => $idTipoInforme,
														'proyecto' =>  $proyecto
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

        $query = Ieo::find()->where(['estado' => 1]);

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
    public function actionCreate()
    {
        /**
         * Se realiza registro del modelo base IEO
         * Obtenemos el id de iserción para usarlo como llave foranea en los demas modelos 
         */
        
        $ieo_id = 0;
        $idInstitucion = $_SESSION['instituciones'][0];
        $data = [];
        $institucion = Instituciones::findOne( $idInstitucion );
      
        
        $ieo_model = new Ieo();
        //$postData = Yii::$app->request->post();
        
        if ($ieo_model->load(Yii::$app->request->post())) 
		{
            
			$ieo_model->institucion_id = $idInstitucion;
            $ieo_model->estado = 1;
            $ieo_model->sede_id = $_SESSION["sede"][0] != "-1" ? $_SESSION["sede"][0] : 2;
            $ieo_model->id_tipo_informe = $_SESSION["idTipoInforme"];   
            
            /**Registro de Modelo Base y todos los modelos realacionados con documentación */
            if($ieo_model->save()){
                //$status = true;  
                $ieo_id = $ieo_model->id;
                //$ieo_id = 56;
                

                /**Carga de archivos multiples */
                if($arrayDatosRequerimientos = Yii::$app->request->post('RequerimientoExtraIeo'))
				{
                    
                    $modelRequerimiento = [];

                    for( $i = 0; $i < 8; $i++ )
					{
                        $modelRequerimiento[] = new RequerimientoExtraIeo();
                    }
                    if (RequerimientoExtraIeo::loadMultiple($modelRequerimiento, Yii::$app->request->post() )) {
                        //die();  
                       
                        //se guarda la informacion en una carpeta con el nombre del codigo dane de la institucion seleccionada
						$idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                        $carpeta = "../documentos/documentosIeo/requerimientoExtra/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
                        }

                        $propiedades = array( "socializacion_ruta", "soporte_necesidad");
                        
                        //recorre el array $modelRequerimiento con cada modelo creado dinamicamente
						foreach( $modelRequerimiento as $key => $model) 
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
										$rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/requerimientoExtra/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
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

                            //se deben asignar los valores ya que se crean los modelos dinamicamente, yii no los agrega
							//los datos que vienen por post
                            $model->ieo_id = $ieo_id;
                            $model->proyecto_ieo_id = isset($arrayDatosRequerimientos[$key]['proyecto_ieo_id']) ? $arrayDatosRequerimientos[$key]['proyecto_ieo_id'] : 0;
                            $model->actividad_id = isset($arrayDatosRequerimientos[$key]['proyecto_ieo_id']) ? $arrayDatosRequerimientos[$key]['proyecto_ieo_id'] : 0;
                            
                            //Guarda la informacion que tiene $model en la base de datos
							foreach( $modelRequerimiento as $key => $model) 
							{
                                if($model->socializacion_ruta){
                                    $model->save();
                                }								
							}
							
                        }
                        
                    }
                }

                /**Carga de archivos multiples */
                if($arrayDatosDocumentos = Yii::$app->request->post('DocumentosReconocimiento')){

                    $modelDocumentos = [];

                    for( $i = 0; $i < 8; $i++ ){
                        $modelDocumentos[] = new DocumentosReconocimiento();
                    }                    

                    if (DocumentosReconocimiento::loadMultiple($modelDocumentos, Yii::$app->request->post() )) {
                        
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

                    

                            $model->ieo_id = $ieo_id;
                            $model->proyecto_ieo_id = isset($arrayDatosDocumentos[$key]['proyecto_ieo_id']) ? $arrayDatosDocumentos[$key]['proyecto_ieo_id'] : 0;
                            $model->actividad_id = isset($arrayDatosDocumentos[$key]['actividad_id']) ? $arrayDatosDocumentos[$key]['actividad_id'] : 0;
                            $model->horario_trabajo = isset($arrayDatosDocumentos[$key]['horario_trabajo']) ? $arrayDatosDocumentos[$key]['horario_trabajo'] : 0;

                            //Guarda la informacion que tiene $model en la base de datos
                            foreach( $modelDocumentos as $key => $model) 
                            {
                                if($model->informe_caracterizacion){

                                    $model->save();
                                }								
                            }

                        }
                    
                    }
                }

                 /**Carga de archivos multiples */
                if($arrayDatosEvidencias = Yii::$app->request->post('Evidencias')){

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

                            $model->ieo_id = $ieo_id;
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
                if($arrayDatosProducto = Yii::$app->request->post('EcProducto')){
                    
                    $modelProdutos = [];

                    for( $i = 0; $i < 8; $i++ ){
                        $modelProdutos[] = new EcProducto();
                    }

                    if (EcProducto::loadMultiple($modelProdutos, Yii::$app->request->post() )) {

                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                        $carpeta = "../documentos/documentosIeo/producto/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
                        }

                        $propiedades = array( "imforme_ruta", "plan_accion_ruta");

                        foreach( $modelProdutos as $key => $model) 
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

                            $model->ieo_id = $ieo_id;
                            $model->id_proyecto = isset($arrayDatosProducto[$key]['id_proyecto']) ? $arrayDatosProducto[$key]['id_proyecto'] : 0;
                            $model->id_actividad = isset($arrayDatosProducto[$key]['id_actividad']) ? $arrayDatosProducto[$key]['id_actividad'] : 0;
                            
                            foreach( $modelProdutos as $key => $model) 
                            {
                                if($model->imforme_ruta){

                                    $model->save();
                                }								
                            }
                        }
                    }

                }



                /**Validacion y registro de campos para modelo Tipo de cantidad poblacion */
                if (Yii::$app->request->post('TiposCantidadPoblacion')){
                    
                    $data = Yii::$app->request->post('TiposCantidadPoblacion');
                    $count 	= count( $data );
                    $modelCantidadPoblacion = [];
        
                    for( $i = 0; $i < 54; $i++ ){
                        $modelCantidadPoblacion[] = new TiposCantidadPoblacion();
                    }
                    
                    if (TiposCantidadPoblacion::loadMultiple($modelCantidadPoblacion, Yii::$app->request->post() )) {
                      
                        foreach( $modelCantidadPoblacion as $key => $model) {
                            if($model->tiempo_libre){
                                $model->ieo_id = $ieo_id;
                                if($model->save() && Yii::$app->request->post('EstudiantesIeo')){
                                    $status = true;
                                    $dataEstudiantes = Yii::$app->request->post('EstudiantesIeo');
                                    
                                    $countEstudiantes 	= count( $dataEstudiantes );
                                    $modelEstudiantesIeo = [];
                                    
                                    for( $i = 0; $i < 54; $i++ ){
                                        $modelEstudiantesIeo[] = new EstudiantesIeo();
                                    }
                                    if (EstudiantesIeo::loadMultiple($modelEstudiantesIeo, Yii::$app->request->post() )) {
                                        foreach( $modelEstudiantesIeo as $key => $modelEstudiantes) {
                                                if($modelEstudiantes->grado_0){
                                                    $modelEstudiantes->id_tipo_cantidad_p = $model->id;
                                                    if(!$modelEstudiantes->save()){
                                                        $status = false;
                                                    }
                                                    //break;
                                                }
                                                
                                            }
                                    }
                                }
                            }
                        }
                    }
                    
                }
                return $this->redirect(['index', 'guardado' => 1, 'idTipoInforme' => $_SESSION["idTipoInforme"] ]);
            } 

        }
        
        $ZonasEducatibas  = ZonasEducativas::find()->where( 'estado=1' )->all();
        $zonasEducativas	 = ArrayHelper::map( $ZonasEducatibas, 'id', 'descripcion' );

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $command = Yii::$app->db->createCommand("SELECT cantp.actividad_id, cantp.tipo_actividad, cantp.tiempo_libre, cantp.edu_derechos, cantp.sexualidad, cantp.ciudadania, cantp.medio_ambiente, cantp.familia, cantp.directivos, cantp.fecha_creacion, cantp.proyecto_ieo_id,
                                                        est.grado_0, est.grado_1, est.grado_2, est.grado_3, est.grado_4, est.grado_5, est.grado_6, est.grado_7, est.grado_8, est.grado_9, est.grado_10, est.grado_11, est.total
                                                FROM ec.tipos_cantidad_poblacion AS cantp
                                                INNER JOIN ec.estudiantes_ieo AS est ON cantp.id = est.id_tipo_cantidad_p 
                                                WHERE cantp.ieo_id = $id");

        $result= $command->queryAll();                                       

        $result = ArrayHelper::getColumn($result, function ($element) 
        {
            $index = $element['actividad_id']."".$element['tipo_actividad'];
            $dato[$index]['tipo_actividad']= $element['tipo_actividad'];
            $dato[$index]['tiempo_libre']= $element['tiempo_libre'];
            $dato[$index]['edu_derechos']= $element['edu_derechos'];
            $dato[$index]['sexualidad']= $element['sexualidad'];
            $dato[$index]['ciudadania']= $element['ciudadania'];
            $dato[$index]['medio_ambiente']= $element['medio_ambiente'];
            $dato[$index]['familia']= $element['familia'];
            $dato[$index]['directivos']= $element['directivos'];
            $dato[$index]['fecha_creacion']= $element['fecha_creacion'];
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
            $dato[$index]['total']= $element['total'];

            return $dato;
        });
		
		$datos = array();
        foreach	($result as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
                
                $datos[$ids] = $valores;
        }

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
       
        return $this->redirect(['index', 'idTipoInforme' => $_SESSION["idTipoInforme"]]);
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
