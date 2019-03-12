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
use app\models\ImplementacionIeo;
use app\models\CantidadPoblacionImpIeo;
use app\models\EvidenciasImpIeo;
use app\models\EstudiantesImpIeo;
use app\models\ProductoImplementacionIeo;
use app\models\Instituciones;
use app\models\ProductosImpIeo;
use app\models\ZonasEducativas;
use app\models\PerfilesXPersonasInstitucion;
use app\models\PerfilesXPersonas;
use app\models\Personas;
use app\models\ComunasCorregimientos;
use app\models\BarriosVeredas;


use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;


/**
 * ImplementacionIeoController implements the CRUD actions for ImplementacionIeo model.
 */
class ImplementacionIeoController extends Controller
{

    public $tipo_informe;


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
     * Lists all ImplementacionIeo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {

        $query = ImplementacionIeo::find()->where(['estado' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' =>$query,
        ]);
        $_SESSION["tipo_informe"] = isset(($_GET['idTipoInforme'])) ? intval($_GET['idTipoInforme']) : $_SESSION["tipo_informe"]; 


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' 		=> $guardado,
        ]);

        
    }

    function actionViewFases($model, $form, $datos){
       
        
        $actividades = [ 
            1 => 'Actividad 1. Socialización de plan de acción',
            2 => 'Actividad general. MCEE Encuentro',
            3 => 'Actividad 2. Mesa de trabajo',
            4 => 'Actividad 3. Acompañamiento a la práctica',
            5 => 'Actividad 4. Mesa de trabajo',
            6 => 'Actividad 5. Acompañamiento a la práctica',
            7 => 'Actividad Especial. Taller',
            8 => 'Actividad Especial.  Salida pedagógica',
            9 => 'Actividad 6. Mesa de Trabajo',
            10 => 'Actividad 7. Acompañamiento a la Práctica',
            11 => 'Actividad 8. Mesa de Trabajo',
            12 => 'Actividad 9.  Acompañamiento a la Práctica',
            13 => 'Actividad Especial. Taller',
            14 => 'Actividad Especial.  Salida pedagógica',
            15 => 'Actividad 10. Mesa de trabajo',
            16 => 'Actividad general. MCEE Encuentro',
            17 => 'Productos'
        ];

        $tiposCantidadPoblacion = new CantidadPoblacionImpIeo();
        $estudiantesGrado = new EstudiantesImpIeo();
        $evidencias = new EvidenciasImpIeo();
        $producto = new ProductoImplementacionIeo();
        
        $colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff", "#d6d8d9", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];

        foreach ($actividades as $actividad => $a)
		{
                
                $contenedores[] = [
                    'label' 	=>  $a,
                    'content' 	=> $this->renderPartial( 'actividades', 
                                        [  
                                            'form' => $form,
                                            'numActividad' => $actividad,
                                            'model' =>$model,
                                            'tiposCantidadPoblacion' =>  $tiposCantidadPoblacion,
                                            'estudiantesGrado' => $estudiantesGrado,
                                            'producto' => $producto,
                                            'evidencias' => $evidencias,
                                            'datos' => $datos
                                        ] 
                                        ),
                    'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$actividad];"],
                ];
        }

        /*echo Collapse::widget([
            'items' => $contenedores,
        ]);*/

        echo Tabs::widget([
            'items' => $contenedores,
        ]);

    }

    /**
     * Displays a single ImplementacionIeo model.
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

	public function obtenerZonaEducativa()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$idZonaEducativa = Instituciones::findOne( $idInstitucion )->id_zona_educativa;
		$zonaEducativa  = ZonasEducativas::find()->where(" estado=1 and id = $idZonaEducativa " )->all();
        $zonaEducativa  = ArrayHelper::map( $zonaEducativa, 'id', 'descripcion' );
		
		return $zonaEducativa;
	}
	
    /**
     * Creates a new ImplementacionIeo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $ieo_model = new ImplementacionIeo();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne( $idInstitucion );
        $ieo_id = 0;
        $status = false;
       
        if ($ieo_model->load(Yii::$app->request->post())) {

            $ieo_model->institucion_id = $idInstitucion;
            $ieo_model->estado = 1;
            $ieo_model->sede_id = 2;
            $ieo_model->id_tipo_informe = $_SESSION["tipo_informe"];
                       
            if($ieo_model->save()){
                $ieo_id = $ieo_model->id;
                //$ieo_id = 1;

                /*if(Yii::$app->request->post('EvidenciasImpIeo')){

                    $dataEvidencias = Yii::$app->request->post('EvidenciasImpIeo');
                    $countEvidencias = count( $dataEvidencias );
                    $modelEvidencias = [];

                    for( $i = 0; $i < $countEvidencias; $i++ ){
                        $modelEvidencias[] = new EvidenciasImpIeo();
                    }

                    if (EvidenciasImpIeo::loadMultiple($modelEvidencias, Yii::$app->request->post() )) {
                        foreach($modelEvidencias as $key => $model3) {
                            $saveAvemceFormula = "";
                            $saveAvanceRutaGestion = "";
                            
                            $producto_acuerdo = UploadedFile::getInstance( $model3, "[$key]producto_acuerdo" );
                            $resultado_actividad = UploadedFile::getInstance( $model3, "[$key]resultado_actividad" );
                            $acta = UploadedFile::getInstance( $model3, "[$key]acta" );
                            $listado = UploadedFile::getInstance( $model3, "[$key]listado" );
                            $fotografias = UploadedFile::getInstance( $model3, "[$key]fotografias" );

                            $avance_formula = UploadedFile::getInstance( $model3, "[$key]avance_formula" );
                            $avance_ruta_gestion = UploadedFile::getInstance( $model3, "[$key]avance_ruta_gestion" );
                            
                            if( $producto_acuerdo && $resultado_actividad && $acta && $listado && $fotografias){
                                                       
                                $modelEvidencias [] = new EvidenciasImpIeo();
                                //Se crea carpeta para almecenar los documentos de Socializacion
                                $carpetaEvidencias = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion->codigo_dane;
                                if (!file_exists($carpetaEvidencias)) {
                                    mkdir($carpetaEvidencias, 0777, true);
                                }

                                $base = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion->codigo_dane."/";
                          
                                $rutaFisicaDirectoriaUploadProducto = $base.$producto_acuerdo->baseName;
                                $rutaFisicaDirectoriaUploadProducto .= date( "_Y_m_d_His" ) . '.' . $producto_acuerdo->extension;
                                $saveProducto = $producto_acuerdo->saveAs( $rutaFisicaDirectoriaUploadProducto );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                
                                $rutaFisicaDirectoriaUploadResultadoActividad = $base.$resultado_actividad->baseName;
                                $rutaFisicaDirectoriaUploadResultadoActividad .= date( "_Y_m_d_His" ) . '.' . $resultado_actividad->extension;
                                $saveResultadoActividad = $resultado_actividad->saveAs( $rutaFisicaDirectoriaUploadResultadoActividad );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                
                                $rutaFisicaDirectoriaUploadActa = $base.$acta->baseName;
                                $rutaFisicaDirectoriaUploadActa .= date( "_Y_m_d_His" ) . '.' . $acta->extension;
                                $saveActa = $acta->saveAs( $rutaFisicaDirectoriaUploadActa );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                
                                $rutaFisicaDirectoriaUploadListado = $base.$listado->baseName;
                                $rutaFisicaDirectoriaUploadListado .= date( "_Y_m_d_His" ) . '.' . $listado->extension;
                                $saveListado = $listado->saveAs( $rutaFisicaDirectoriaUploadListado );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                                $rutaFisicaDirectoriaUploadFotografia = $base.$fotografias->baseName;
                                $rutaFisicaDirectoriaUploadFotografia .= date( "_Y_m_d_His" ) . '.' . $fotografias->extension;
                                $saveFotografia = $fotografias->saveAs( $rutaFisicaDirectoriaUploadFotografia );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                
                                if($avance_formula && $avance_ruta_gestion){
                                    $rutaFisicaDirectoriaUploadAvemceFormula = $base.$avance_formula->baseName;
                                    $rutaFisicaDirectoriaUploadAvemceFormula .= date( "_Y_m_d_His" ) . '.' . $avance_formula->extension;
                                    $saveAvemceFormula = $avance_formula->saveAs( $rutaFisicaDirectoriaUploadAvemceFormula );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
    
                                    $rutaFisicaDirectoriaUploadAvanceRutaGestion = $base.$avance_ruta_gestion->baseName;
                                    $rutaFisicaDirectoriaUploadAvanceRutaGestion .= date( "_Y_m_d_His" ) . '.' . $avance_ruta_gestion->extension;
                                    $saveAvanceRutaGestion = $avance_ruta_gestion->saveAs( $rutaFisicaDirectoriaUploadAvanceRutaGestion );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                                }


                                if( $saveProducto && $saveResultadoActividad && $saveActa && $saveListado && $saveFotografia){ 
                                    //Le asigno la ruta al arhvio
                                    $modelEvidencias[$key]->implementacion_ieo_id = $ieo_id;
                                    $modelEvidencias[$key]->producto_acuerdo = $rutaFisicaDirectoriaUploadProducto;
                                    $modelEvidencias[$key]->resultado_actividad = $rutaFisicaDirectoriaUploadResultadoActividad;
                                    $modelEvidencias[$key]->acta = $rutaFisicaDirectoriaUploadActa;
                                    $modelEvidencias[$key]->listado = $rutaFisicaDirectoriaUploadListado;
                                    $modelEvidencias[$key]->fotografias = $rutaFisicaDirectoriaUploadFotografia;
                                    
                                    if($saveAvemceFormula && $saveAvanceRutaGestion){
                                        $modelEvidencias[$key]->avance_formula = $rutaFisicaDirectoriaUploadAvemceFormula;
                                        $modelEvidencias[$key]->avance_ruta_gestion = $rutaFisicaDirectoriaUploadAvanceRutaGestion;                           
                                    }
                                    
                                    $modelEvidencias[$key]->save();
        
    
                                }else{
                                    echo $file->error;
                                    exit("finnn....");
                                }

                            }
                        }
                    }

                }*/

                if($arrayDatosEvidencias = Yii::$app->request->post('EvidenciasImpIeo')){

                        $modelEvidencias = [];

                        for( $i = 0; $i < 8; $i++ ){
                            $modelEvidencias[] = new EvidenciasImpIeo();
                        } 

                        if (EvidenciasImpIeo::loadMultiple($modelEvidencias, Yii::$app->request->post() )) {
                            
                            $idInstitucion 	= $_SESSION['instituciones'][0];
                            $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                            $carpeta = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion;
                            if (!file_exists($carpeta)) 
                            {
                                mkdir($carpeta, 0777, true);
                            }
                            
                            $propiedades = array( "producto_acuerdo", "resultado_actividad", "acta", "listado", "fotografias", "avance_formula", "avance_ruta_gestion");
                        
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
                                            $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
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
                            $model->implementacion_ieo_id = $ieo_id;
                                                

                            foreach( $modelEvidencias as $key => $model) 
                            {
                                if($model->producto_acuerdo){

                                    $model->save();
                                }								
                            }
                        
                        }

                    }

                }



                /*if(Yii::$app->request->post('ProductoImplementacionIeo')){
                    
                    $dataProductos = Yii::$app->request->post('ProductoImplementacionIeo');
                    $countProductos = count( $dataProductos );
                    $modelProductos = [];


                    for( $i = 0; $i < $countProductos+1; $i++ ){
                        $modelProductos[] = new ProductoImplementacionIeo();
                    }

                                        

                    if (ProductoImplementacionIeo::loadMultiple($modelProductos, Yii::$app->request->post() )) {
                        
                        foreach($modelProductos as $key => $model3) {

                            
                            $producto_informe_acompañamiento = UploadedFile::getInstance( $model3, "[$key]informe_acompanamiento" );
                            $producto_trazabilidad = UploadedFile::getInstance( $model3, "[$key]trazabilidad_plan_accion" );
                            $producto_formnulacion_sistemactizacion = UploadedFile::getInstance( $model3, "[$key]formulacion" );
                            $producto_ruta_gestion = UploadedFile::getInstance( $model3, "[$key]ruta_gestion" );
                            $producto_presentacion_resultados = UploadedFile::getInstance( $model3, "[$key]resultados_procesos" );
                            


                            if($producto_informe_acompañamiento && $producto_trazabilidad && $producto_formnulacion_sistemactizacion && $producto_ruta_gestion && $producto_presentacion_resultados){

                                

                                $modelProductos [] = new ProductoImplementacionIeo();
                            
                                $carpetaEvidencias = "../documentos/documentosIeo/actividades/productosImlementacionIeo/".$institucion->codigo_dane;
                                if (!file_exists($carpetaEvidencias)) {
                                    mkdir($carpetaEvidencias, 0777, true);
                                }    

                                $base = "../documentos/documentosIeo/actividades/productosImlementacionIeo/".$institucion->codigo_dane."/";

                                $rutaFisicaDirectoriaUploadProductoAcompañamiento = $base.$producto_informe_acompañamiento->baseName;
                                $rutaFisicaDirectoriaUploadProductoAcompañamiento .= date( "_Y_m_d_His" ) . '.' . $producto_informe_acompañamiento->extension;
                                $saveProductoAcompañamiento = $producto_informe_acompañamiento->saveAs( $rutaFisicaDirectoriaUploadProductoAcompañamiento );

                                $rutaFisicaDirectoriaUploadProductoTrazabilidad = $base.$producto_trazabilidad->baseName;
                                $rutaFisicaDirectoriaUploadProductoTrazabilidad .= date( "_Y_m_d_His" ) . '.' . $producto_trazabilidad->extension;
                                $saveProductoTrazabilidad = $producto_trazabilidad->saveAs( $rutaFisicaDirectoriaUploadProductoTrazabilidad );

                                $rutaFisicaDirectoriaUploadProductoformulacionSistematizacion = $base.$producto_formnulacion_sistemactizacion->baseName;
                                $rutaFisicaDirectoriaUploadProductoformulacionSistematizacion .= date( "_Y_m_d_His" ) . '.' . $producto_formnulacion_sistemactizacion->extension;
                                $saveProductoFormulacionSistematizacion = $producto_formnulacion_sistemactizacion->saveAs( $rutaFisicaDirectoriaUploadProductoformulacionSistematizacion );

                                $rutaFisicaDirectoriaUploadProductoRutaGestion = $base.$producto_ruta_gestion->baseName;
                                $rutaFisicaDirectoriaUploadProductoRutaGestion .= date( "_Y_m_d_His" ) . '.' . $producto_ruta_gestion->extension;
                                $saveProductoRutaGestion = $producto_ruta_gestion->saveAs( $rutaFisicaDirectoriaUploadProductoRutaGestion );

                                $rutaFisicaDirectoriaUploadProductoPresentacionResultado = $base.$producto_presentacion_resultados->baseName;
                                $rutaFisicaDirectoriaUploadProductoPresentacionResultado .= date( "_Y_m_d_His" ) . '.' . $producto_presentacion_resultados->extension;
                                $saveProductoPresentacionResultado = $producto_presentacion_resultados->saveAs( $rutaFisicaDirectoriaUploadProductoPresentacionResultado );

                                if( $saveProductoAcompañamiento && $saveProductoTrazabilidad && $saveProductoFormulacionSistematizacion && $saveProductoRutaGestion && $saveProductoPresentacionResultado){

                                    $modelProductos[$key]->implementacion_ieo_id = $ieo_id;
                                    $modelProductos[$key]->informe_acompanamiento = $rutaFisicaDirectoriaUploadProductoAcompañamiento;
                                    $modelProductos[$key]->trazabilidad_plan_accion = $rutaFisicaDirectoriaUploadProductoTrazabilidad;
                                    $modelProductos[$key]->formulacion = $rutaFisicaDirectoriaUploadProductoformulacionSistematizacion;
                                    $modelProductos[$key]->ruta_gestion = $rutaFisicaDirectoriaUploadProductoRutaGestion;
                                    $modelProductos[$key]->resultados_procesos = $rutaFisicaDirectoriaUploadProductoPresentacionResultado;
                                    $modelProductos[$key]->estado = 1;
                                    $modelProductos[$key]->save();

                                }else{
                                    echo $file->error;
                                    exit("finnn....");
                                }

                            }
                        }
                        
                    }


                }*/

                if($arrayDatosProductos = Yii::$app->request->post('ProductoImplementacionIeo')){
                    
                    $modelProductos = [];

                    for( $i = 0; $i < count(Yii::$app->request->post()); $i++ ){
                        $modelProductos[] = new ProductoImplementacionIeo();
                    }

                    
                    if (ProductoImplementacionIeo::loadMultiple($modelProductos, Yii::$app->request->post() )) {
                       
                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

                        $carpeta = "../documentos/documentosIeo/actividades/productosImlementacionIeo/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
                        }

                        $propiedades = array( "informe_acompanamiento", "trazabilidad_plan_accion", "formulacion", "ruta_gestion", "resultados_procesos");
                        
                        foreach( $modelProductos as $key => $model) 
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
                                        $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/actividades/productosImlementacionIeo/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
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
                        $model->implementacion_ieo_id = $ieo_id;
                        $model->estado = 1;

                        foreach( $modelProductos as $key => $model) 
                        {
                            if($model->informe_acompanamiento){

                                $model->save();
                            }								
                        }
                    }
                }
            }



                if (Yii::$app->request->post('CantidadPoblacionImpIeo')){
                    $data = Yii::$app->request->post('CantidadPoblacionImpIeo');
                    $count 	= count( $data );
                    $modelCantidadPoblacion = [];
        
                    for( $i = 0; $i < $count; $i++ ){
                        $modelCantidadPoblacion[] = new CantidadPoblacionImpIeo();
                    }
        
                    if (CantidadPoblacionImpIeo::loadMultiple($modelCantidadPoblacion, Yii::$app->request->post() )) {
                        foreach( $modelCantidadPoblacion as $key => $model) {
                           
                            if($model->tiempo_libre){
                                $model->implementacion_ieo_id = $ieo_id;                                                  
                                
                                if($model->save() && Yii::$app->request->post('EstudiantesImpIeo')){
                                    $status = true;
                                    $dataEstudiantes = Yii::$app->request->post('EstudiantesImpIeo');
                                    
                                    $countEstudiantes 	= count( $dataEstudiantes );
                                    $modelEstudiantesIeo = [];
                                    
                                    for( $i = 0; $i < $countEstudiantes; $i++ ){
                                        $modelEstudiantesIeo[] = new EstudiantesImpIeo();
                                    }


                                    if (EstudiantesImpIeo::loadMultiple($modelEstudiantesIeo, Yii::$app->request->post() )) {
                                        foreach( $modelEstudiantesIeo as $key1 => $modelEstudiantes) {
                                                
                                            if($modelEstudiantes->grado_0){
                                                    
                                                    $modelEstudiantes->cantidad_poblacion_imp_ieo_id = $model->id;
                                                    
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
                return $this->redirect(['index', 'guardado' => true ]);
            }
            
            
        }

        $idPerfilesXpersonas	= PerfilesXPersonasInstitucion::find()->where( "id_institucion = $idInstitucion" )->all();
		$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
        $nombres1 				= Personas::find($perfiles_x_persona)->all();
        $nombres	 = ArrayHelper::map( $nombres1, 'id', 'nombres');
     

        $comunas  = ComunasCorregimientos::find()->where( 'estado=1' )->all();
        $comunas	 = ArrayHelper::map( $comunas, 'id', 'descripcion' );
        
        return $this->renderAjax('create', [
            'model' => $ieo_model,
            'zonasEducativas' => $this->obtenerZonaEducativa(),
            "nombres" => $nombres,
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
        else{
            echo "<option>-</option>";
        }
        
        //echo "<option>-</option>";

    }

    /**
     * Updates an existing ImplementacionIeo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $command = Yii::$app->db->createCommand("SELECT canp.id_actividad, canp.tiempo_libre, canp.edu_derechos, canp.sexualidad, canp.ciudadania, canp.medio_ambiente, canp.familia, canp.directivos, canp.fecha_creacion, canp.tipo_actividad,
                                                        est.grado_0, est.grado_1, est.grado_2, est.grado_3, est.grado_4, est.grado_5, est.grado_6, est.grado_7, est.grado_8, est.grado_9, est.grado_10, est.grado_11
                                                FROM ec.cantidad_poblacion_imp_ieo AS canp
                                                INNER JOIN ec.estudiantes_imp_ieo AS est ON canp.id = est.cantidad_poblacion_imp_ieo_id
                                                WHERE canp.implementacion_ieo_id = $id");

        $result= $command->queryAll();                                       

        $result = ArrayHelper::getColumn($result, function ($element) 
        {
            $dato[$element['id_actividad']]['tiempo_libre']= $element['tiempo_libre'];
            $dato[$element['id_actividad']]['tipo_actividad']= $element['tipo_actividad'];
            $dato[$element['id_actividad']]['edu_derechos']= $element['edu_derechos'];
            $dato[$element['id_actividad']]['sexualidad']= $element['sexualidad'];
            $dato[$element['id_actividad']]['ciudadania']= $element['ciudadania'];
            $dato[$element['id_actividad']]['medio_ambiente']= $element['medio_ambiente'];
            $dato[$element['id_actividad']]['directivos']= $element['directivos'];
            $dato[$element['id_actividad']]['familia']= $element['familia'];
            $dato[$element['id_actividad']]['grado_0']= $element['grado_0'];
            $dato[$element['id_actividad']]['grado_1']= $element['grado_1'];
            $dato[$element['id_actividad']]['grado_2']= $element['grado_2'];
            $dato[$element['id_actividad']]['grado_3']= $element['grado_3'];
            $dato[$element['id_actividad']]['grado_4']= $element['grado_4'];
            $dato[$element['id_actividad']]['grado_5']= $element['grado_5'];
            $dato[$element['id_actividad']]['grado_6']= $element['grado_6'];
            $dato[$element['id_actividad']]['grado_7']= $element['grado_7'];
            $dato[$element['id_actividad']]['grado_8']= $element['grado_8'];
            $dato[$element['id_actividad']]['grado_9']= $element['grado_9'];
            $dato[$element['id_actividad']]['grado_10']= $element['grado_10'];
            $dato[$element['id_actividad']]['grado_11']= $element['grado_11'];

            return $dato;
        });

        foreach	($result as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
                
                $datos[$ids] = $valores;
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'zonasEducativas' =>  $this->obtenerZonaEducativa(),
            'datos'=> $datos,
        ]);
    }

    /**
     * Deletes an existing ImplementacionIeo model.
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

        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ImplementacionIeo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImplementacionIeo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImplementacionIeo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

