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
		
		
		
		
      
       
        //$nombres				= $nombres->nombres." ".$nombres->apellidos;
        
        /*$proyectos = [ 
            1 => "Proyectos Pedagógicos Transversales",
            2 => "Proyectos de Servicio Social Estudiantil",
            3 => "Articulación Familiar"
        ];*/

        // $actividades =
		// [
            // 1 =>    "Requerimientos extras I.E.O",
            // 2 =>    "Reconocimiento previo y documentos a desarrollar por el profesional de apoyo",
            // 3 =>    "Actividad 1.Mesa de trabajo para la presentación de resultados de la caracterización y mapeo (puntos de partida y llegada)",
            // 4 =>    "Actividad 2. Acompañamiento en práctica",
            // 5 =>    "Actividad 3. Mesa de trabajo: contrucción del plan de acción",
            // 6 =>    "Productos"
        // ];
		
		// return $this->renderAjax('fases', [
            // 'fases' => $actividades,
            // 'form' => $form,
            // "model" => $model,
            // "documentosReconocimiento" =>  $documentosReconocimiento,
            // "tiposCantidadPoblacion" => $tiposCantidadPoblacion,
            // "evidencias" => $evidencias,
            // "producto" => $producto,
            // "requerimientoExtra" => $requerimientoExtra,
            // "estudiantesGrado" =>  $estudiantesGrado,
            // "datos" => $datos,
            // "persona" => $persona,
            // "nombres" => $nombres,
            // "idTipoInforme" => $idTipoInforme
        // ]);
		
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
        //$model = new Ieo();
        //$requerimientoExtra = new RequerimientoExtraIeo();
        //$documentosReconocimiento = new DocumentosReconocimiento();
        //$tiposCantidadPoblacion = new TiposCantidadPoblacion();
        //$estudiantesGrado = new EstudiantesIeo();
        //$evidencias = new Evidencias();
        $ieo_id = 0;
        $idInstitucion = $_SESSION['instituciones'][0];
        $data = [];
        $institucion = Instituciones::findOne( $idInstitucion );
        $status = false;
        
        $ieo_model = new Ieo();
        //$postData = Yii::$app->request->post();
        
        if ($ieo_model->load(Yii::$app->request->post())) {
            
            $ieo_model->institucion_id = $idInstitucion;
            $ieo_model->estado = 1;
            $ieo_model->sede_id = $_SESSION["sede"][0] != "-1" ? $_SESSION["sede"][0] : 2;
            $ieo_model->id_tipo_informe = $_SESSION["idTipoInforme"];   
            
            /**Registro de Modelo Base y todos los modelos realacionados con documentación */
            if($ieo_model->save()){
                //$status = true;  
                $ieo_id = $ieo_model->id;
                //$ieo_id = 56;
                

                /*if(Yii::$app->request->post('RequerimientoExtraIeo')){
                    
                    $modelRequerimiento = [];

                    for( $i = 0; $i < 14; $i++ ){
                        $modelRequerimiento[] = new RequerimientoExtraIeo();
                    }

                    if (RequerimientoExtraIeo::loadMultiple($modelRequerimiento, Yii::$app->request->post() )) {
                        
                        foreach($modelRequerimiento as $key => $model3) {
                            
                            $file_socializacion_ruta = UploadedFile::getInstance( $model3, "[$key]socializacion_ruta" );
                            $file_soporte_necesidad = UploadedFile::getInstance( $model3, "[$key]soporte_necesidad" );

                            
                            if( $file_socializacion_ruta && $file_soporte_necesidad){
                                
                                //Se crea carpeta para almecenar los documentos de Soporte Necesidad
                                $carpetaSocializacion = "../documentos/documentosIeo/requerimientoExtra/".$institucion->codigo_dane;
                                if (!file_exists($carpetaSocializacion)) {
                                    mkdir($carpetaSocializacion, 0777, true);
                                }
                                
                                //Construyo la ruta completa del archivo IEO Socialiazacion a guardar 
                                $rutaFisicaDirectoriaUploadSocializacion  = "../documentos/documentosIeo/requerimientoExtra/".$institucion->codigo_dane."/";
                                $rutaFisicaDirectoriaUploadSocializacion .= $file_socializacion_ruta->baseName;
                                $rutaFisicaDirectoriaUploadSocializacion .= date( "_Y_m_d_His" ) . '.' . $file_socializacion_ruta->extension;
                                $saveSocializacion = $file_socializacion_ruta->saveAs( $rutaFisicaDirectoriaUploadSocializacion );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                

                                //Construyo la ruta completa del archivo IEO Soporte Necesidad a guardar 
                                $rutaFisicaDirectoriaUploadSoporteNecesidad  = "../documentos/documentosIeo/requerimientoExtra/".$institucion->codigo_dane."/";
                                $rutaFisicaDirectoriaUploadSoporteNecesidad .= $file_soporte_necesidad->baseName;
                                $rutaFisicaDirectoriaUploadSoporteNecesidad .= date( "_Y_m_d_His" ) . '.' . $file_soporte_necesidad->extension;
                                $saveSoporteNecesidad = $file_soporte_necesidad->saveAs( $rutaFisicaDirectoriaUploadSoporteNecesidad );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                            
                                if( $saveSocializacion && $saveSoporteNecesidad){
                                    
                                    //Le asigno la ruta al arhvio
                                    $modelRequerimiento[$key]->socializacion_ruta = $rutaFisicaDirectoriaUploadSocializacion;
                                    $modelRequerimiento[$key]->soporte_necesidad = $rutaFisicaDirectoriaUploadSoporteNecesidad;
                                    $modelRequerimiento[$key]->ieo_id = $ieo_id;
                                    $modelRequerimiento[$key]->save();
    
                                }else{
                                    echo $file->error;
                                    exit("finnn....");
                                }
                            }
                            
                        }
                    }
                }*/

                /**Carga de archivos multiples */
                if($arrayDatosRequerimientos = Yii::$app->request->post('RequerimientoExtraIeo')){
                    
                    $modelRequerimiento = [];

                    for( $i = 0; $i < 8; $i++ ){
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

                /*if(Yii::$app->request->post('DocumentosReconocimiento')){
                    
                    $modelReconocimiento = [];

                    for( $i = 0; $i < 24; $i++ ){
                        $modelReconocimiento[] = new DocumentosReconocimiento();
                    }

                    if (DocumentosReconocimiento::loadMultiple($modelReconocimiento, Yii::$app->request->post() )) {
                        
                        foreach($modelReconocimiento as $key => $model3) {
                            
                            $file_informe_caracterizacion = UploadedFile::getInstance( $model3, "[$key]informe_caracterizacion" );
                            $file_matriz_caracterizacion = UploadedFile::getInstance( $model3, "[$key]matriz_caracterizacion" );
                            $file_revision_pei = UploadedFile::getInstance( $model3, "[$key]revision_pei" );
                            $file_revision_autoevaluacion = UploadedFile::getInstance( $model3, "[$key]revision_autoevaluacion" );
                            $file_revision_pmi = UploadedFile::getInstance( $model3, "[$key]revision_pmi" );
                            $file_resultados_caracterizacion = UploadedFile::getInstance( $model3, "[$key]resultados_caracterizacion" );

                            if( $file_informe_caracterizacion && $file_matriz_caracterizacion && $file_revision_pei && $file_revision_autoevaluacion && $file_revision_pmi && $file_resultados_caracterizacion){   
                                //die();
                                //Se crea carpeta para almecenar los documentos de Socializacion
                                $carpetaDocumentosReconocimiento = "../documentos/documentosIeo/documentosReconocimiento/".$institucion->codigo_dane;
                                if (!file_exists($carpetaDocumentosReconocimiento)) {
                                    mkdir($carpetaDocumentosReconocimiento, 0777, true);
                                }

                                $ruta =   "../documentos/documentosIeo/documentosReconocimiento/".$institucion->codigo_dane."/";

                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoInformeCaracterizacion = $ruta.$file_informe_caracterizacion->baseName;
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoInformeCaracterizacion .= date( "_Y_m_d_His" ) . '.' . $file_informe_caracterizacion->extension;
                                $saveInformeCaracterizacion = $file_informe_caracterizacion->saveAs( $rutaFisicaDirectoriaUploadDocumentosReconocimientoInformeCaracterizacion );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                
                            
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoMatrizCaracterizacion = $ruta.$file_matriz_caracterizacion->baseName;
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoMatrizCaracterizacion .= date( "_Y_m_d_His" ) . '.' . $file_matriz_caracterizacion->extension;
                                $saveMatrizCaracterizacion = $file_matriz_caracterizacion->saveAs( $rutaFisicaDirectoriaUploadDocumentosReconocimientoMatrizCaracterizacion );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                                
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPei = $ruta.$file_revision_pei->baseName;
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPei .= date( "_Y_m_d_His" ) . '.' . $file_revision_pei->extension;
                                $saveRevisionPei = $file_revision_pei->saveAs( $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPei );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                                
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoAutoevaluacion = $ruta.$file_revision_autoevaluacion->baseName;
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoAutoevaluacion .= date( "_Y_m_d_His" ) . '.' . $file_revision_autoevaluacion->extension;
                                $saveAutoevaluacion = $file_revision_autoevaluacion->saveAs( $rutaFisicaDirectoriaUploadDocumentosReconocimientoAutoevaluacion );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPmi = $ruta.$file_revision_pmi->baseName;
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPmi .= date( "_Y_m_d_His" ) . '.' . $file_revision_pmi->extension;
                                $saveRevisionPmi = $file_revision_pmi->saveAs( $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPmi );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.


                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoResultadosCaracterizacion = $ruta.$file_resultados_caracterizacion->baseName;
                                $rutaFisicaDirectoriaUploadDocumentosReconocimientoResultadosCaracterizacion .= date( "_Y_m_d_His" ) . '.' . $file_resultados_caracterizacion->extension;
                                $saveResultadosCaracterizacion = $file_resultados_caracterizacion->saveAs( $rutaFisicaDirectoriaUploadDocumentosReconocimientoResultadosCaracterizacion );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                                if( $saveInformeCaracterizacion && $saveMatrizCaracterizacion && $saveRevisionPei && $saveAutoevaluacion && $saveRevisionPmi && $saveResultadosCaracterizacion){
                                    
                                    //Le asigno la ruta al arhvio
                                    $modelReconocimiento[$key]->informe_caracterizacion = $rutaFisicaDirectoriaUploadDocumentosReconocimientoInformeCaracterizacion;
                                    $modelReconocimiento[$key]->matriz_caracterizacion = $rutaFisicaDirectoriaUploadDocumentosReconocimientoMatrizCaracterizacion;
                                    $modelReconocimiento[$key]->revision_pei = $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPei;
                                    $modelReconocimiento[$key]->revision_autoevaluacion = $rutaFisicaDirectoriaUploadDocumentosReconocimientoAutoevaluacion;
                                    $modelReconocimiento[$key]->revision_pmi = $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPmi;
                                    $modelReconocimiento[$key]->resultados_caracterizacion = $rutaFisicaDirectoriaUploadDocumentosReconocimientoResultadosCaracterizacion;
                                    $modelReconocimiento[$key]->ieo_id = $ieo_id;
                                    $modelReconocimiento[$key]->save();
                                    
                                }else{
                                    echo $file->error;
                                    exit("finnn....");
                                }

                            }

                        }
                    }
                    
                }*/

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

                /*if(Yii::$app->request->post('Evidencias')){

                    $modelEvidencias = [];

                    for( $i = 0; $i < 54; $i++ ){
                        $modelEvidencias[] = new Evidencias();
                    }

                    if (Evidencias::loadMultiple($modelEvidencias, Yii::$app->request->post() )) {

                        foreach($modelEvidencias as $key => $model4) {
                            
                            $file_producto_ruta = UploadedFile::getInstance( $model4, "[$key]producto_ruta" );
                            $file_resultados_actividad_ruta = UploadedFile::getInstance( $model4, "[$key]resultados_actividad_ruta" );
                            $file_acta_ruta = UploadedFile::getInstance( $model4, "[$key]acta_ruta" );
                            $file_listado_ruta = UploadedFile::getInstance( $model4, "[$key]listado_ruta" );
                            $file_fotografias_ruta = UploadedFile::getInstance( $model4, "[$key]fotografias_ruta" );

                            if( $file_producto_ruta && $file_resultados_actividad_ruta && $file_acta_ruta && $file_listado_ruta){
                                
                                //Se crea carpeta para almecenar los documentos de Socializacion
                                $carpetaEvidencias = "../documentos/documentosIeo/actividades/evidencias/".$institucion->codigo_dane;
                                if (!file_exists($carpetaEvidencias)) {
                                    mkdir($carpetaEvidencias, 0777, true);
                                }

                                $base = "../documentos/documentosIeo/actividades/evidencias/".$institucion->codigo_dane."/";    

                                $rutaFisicaDirectoriaUploadProducto = $base.$file_producto_ruta->baseName;
                                $rutaFisicaDirectoriaUploadProducto .= date( "_Y_m_d_His" ) . '.' . $file_producto_ruta->extension;
                                $saveProducto = $file_producto_ruta->saveAs( $rutaFisicaDirectoriaUploadProducto );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                
                                $rutaFisicaDirectoriaUploadResultadosActividad = $base.$file_resultados_actividad_ruta->baseName;
                                $rutaFisicaDirectoriaUploadResultadosActividad .= date( "_Y_m_d_His" ) . '.' . $file_resultados_actividad_ruta->extension;
                                $saveResultadosActividad = $file_resultados_actividad_ruta->saveAs( $rutaFisicaDirectoriaUploadResultadosActividad );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                
                                $rutaFisicaDirectoriaUploadActa = $base.$file_acta_ruta->baseName;
                                $rutaFisicaDirectoriaUploadActa .= date( "_Y_m_d_His" ) . '.' . $file_acta_ruta->extension;
                                $saveActa = $file_acta_ruta->saveAs( $rutaFisicaDirectoriaUploadActa );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                 
                                $rutaFisicaDirectoriaUploadListado = $base.$file_listado_ruta->baseName;
                                $rutaFisicaDirectoriaUploadListado .= date( "_Y_m_d_His" ) . '.' . $file_listado_ruta->extension;
                                $saveListado = $file_listado_ruta->saveAs( $rutaFisicaDirectoriaUploadListado );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
    
                                $rutaFisicaDirectoriaUploadFotografia = $base.$file_fotografias_ruta->baseName;
                                $rutaFisicaDirectoriaUploadFotografia .= date( "_Y_m_d_His" ) . '.' . $file_fotografias_ruta->extension;
                                $saveFotografia = $file_fotografias_ruta->saveAs( $rutaFisicaDirectoriaUploadFotografia );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                                if( $saveProducto && $saveResultadosActividad && $saveActa && $saveListado && $saveFotografia){                                 
                                    //Le asigno la ruta al arhvio
                                    $modelEvidencias[$key]->producto_ruta = $rutaFisicaDirectoriaUploadProducto;
                                    $modelEvidencias[$key]->resultados_actividad_ruta = $rutaFisicaDirectoriaUploadResultadosActividad;
                                    $modelEvidencias[$key]->acta_ruta = $rutaFisicaDirectoriaUploadActa;
                                    $modelEvidencias[$key]->listado_ruta = $rutaFisicaDirectoriaUploadListado;
                                    $modelEvidencias[$key]->fotografias_ruta = $rutaFisicaDirectoriaUploadFotografia;
                                    $modelEvidencias[$key]->ieo_id = $ieo_id;
                                    $modelEvidencias[$key]->save();
    
                                }else{
                                    echo $file->error;
                                    exit("finnn....");
                                }
                            }

                        }

                    }
                }*/

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


                /*if(Yii::$app->request->post('Producto')){

                    $modelProducto = [];
                    for( $i = 0; $i < 64; $i++ ){
                        $modelProducto[] = new Producto();
                    }

                    if (Producto::loadMultiple($modelProducto, Yii::$app->request->post() )) {
                        foreach($modelProducto as $key => $model5) {
                            
                            $file_producto_imforme_ruta = UploadedFile::getInstance( $model5, "[$key]imforme_ruta" );
                            $file_plan_accion = UploadedFile::getInstance( $model5, "[$key]plan_accion_ruta" );
                            
                            if($file_producto_imforme_ruta && $file_plan_accion){

                                //Se crea carpeta para almecenar los documentos de Socializacion
                                $carpetaProducto = "../documentos/documentosIeo/producto/".$institucion->codigo_dane;
                                if (!file_exists($carpetaProducto)) {
                                    mkdir($carpetaProducto, 0777, true);
                                }

                                //Construyo la ruta completa del archivo IEO Socialiazacion a guardar 
                                $rutaFisicaDirectoriaUploadProductoInforme  = "../documentos/documentosIeo/producto/".$institucion->codigo_dane."/";
                                $rutaFisicaDirectoriaUploadProductoInforme .= $file_producto_imforme_ruta->baseName;
                                $rutaFisicaDirectoriaUploadProductoInforme .= date( "_Y_m_d_His" ) . '.' . $file_producto_imforme_ruta->extension;
                                $saveProductoInforme = $file_producto_imforme_ruta->saveAs( $rutaFisicaDirectoriaUploadProductoInforme );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                

                                //Construyo la ruta completa del archivo IEO Soporte Necesidad a guardar 
                                $rutaFisicaDirectoriaUploadProductoPlan  = "../documentos/documentosIeo/producto/".$institucion->codigo_dane."/";
                                $rutaFisicaDirectoriaUploadProductoPlan .= $file_plan_accion->baseName;
                                $rutaFisicaDirectoriaUploadProductoPlan .= date( "_Y_m_d_His" ) . '.' . $file_plan_accion->extension;
                                $saveProductoPlan = $file_plan_accion->saveAs( $rutaFisicaDirectoriaUploadProductoPlan );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                                
                                if($saveProductoInforme && $saveProductoPlan){
                                    //Le asigno la ruta al arhvio
                                    $modelProducto[$key]->imforme_ruta = $rutaFisicaDirectoriaUploadProductoInforme;
                                    $modelProducto[$key]->plan_accion_ruta = $rutaFisicaDirectoriaUploadProductoPlan;
                                    $modelProducto[$key]->ieo_id = $ieo_id;
                                    $modelProducto[$key]->save();                                   
    
                                }else{
                                    echo $file->error;
                                    exit("finnn....");
                                }
                            }

                        }
                    }
                }*/

                /**Carga de archivos multiples */
                if($arrayDatosProducto = Yii::$app->request->post('Producto')){
                    
                    $modelProdutos = [];

                    for( $i = 0; $i < 8; $i++ ){
                        $modelProdutos[] = new Producto();
                    }

                    if (Producto::loadMultiple($modelProdutos, Yii::$app->request->post() )) {

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
        

        $proyecto = "";
        if($_SESSION["idTipoInforme"] == 26){
            $proyecto = 'Articulación Familiar';
        }else if($_SESSION["idTipoInforme"] == 14){
            $proyecto = 'Servicio Social Obligatorio';
        }else if($_SESSION["idTipoInforme"] == 2){
            $proyecto = 'Proyectos Pedagógicos Transversales';
        }
      
        
        $ZonasEducatibas  = ZonasEducativas::find()->where( 'estado=1' )->all();
        $zonasEducativas	 = ArrayHelper::map( $ZonasEducatibas, 'id', 'descripcion' );

        $comunas  = ComunasCorregimientos::find()->where( 'estado=1' )->all();
        $comunas	 = ArrayHelper::map( $comunas, 'id', 'descripcion' );
        
        
        return $this->renderAjax('create', [
            'model' => $ieo_model,
            'zonasEducativas' => $zonasEducativas,
            'proyecto' => $proyecto,
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

        if($countBarrios>0){
            foreach($barrios as $barrio){
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
