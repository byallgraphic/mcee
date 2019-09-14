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
use app\models\IeoE;
use app\models\DocumentosReconocimiento;
use app\models\TiposCantidadPoblacion;
use app\models\Evidencias;
use app\models\TipoDocumentos;
use app\models\Producto;
use app\models\RequerimientoExtraIeo;
use app\models\ZonasEducativas;

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
class IeoEController extends Controller
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

    function actionViewFases($model, $form){
        
        $model = new IeoE();
        $documentosReconocimiento = new DocumentosReconocimiento();
        $tiposCantidadPoblacion = new TiposCantidadPoblacion();
        $requerimientoExtra = new RequerimientoExtraIeo();
        $evidencias = new Evidencias();
        $producto = new Producto();
        $estudiantesGrado = new EstudiantesIeo();

        $proyectos = [ 
            1 => "Proyectos Pedagógicos Transversales",
            2 => "Proyectos de Servicio Social Estudiantil",
            3 => "Articulación Familiar"
        ];
		
		return $this->renderAjax('fases', [
			'idPE' 	=> null,
            'fases' => $proyectos,
            'form' => $form,
            "model" => $model,
            "documentosReconocimiento" =>  $documentosReconocimiento,
            "tiposCantidadPoblacion" => $tiposCantidadPoblacion,
            "evidencias" => $evidencias,
            "producto" => $producto,
            "requerimientoExtra" => $requerimientoExtra,
            "estudiantesGrado" =>  $estudiantesGrado
        ]);
		
	}

    /**
     * Lists all Ieo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => IeoE::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
        return $this->render('view', [
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
        
        $ieo_model = new IeoE();
        //$postData = Yii::$app->request->post();
        
        if ($ieo_model->load(Yii::$app->request->post())) {
            
            $ieo_model->institucion_id = $idInstitucion;
            $ieo_model->estado = 1;
            $ieo_model->sede_id = 2;
            $ieo_model->id_tipo_informe = 2;          
            $ieo_model->codigo_dane = $institucion->codigo_dane;

            
            /**Registro de Modelo Base y todos los modelos realacionados con documentación */
            if($ieo_model->save()){

                $status = true;  
                $ieo_id = $ieo_model->id;
                $data = Yii::$app->request->post('Ieo');
                $count 	= count( $data );
        
                $models = [];
                $modelDocumentosReconocimiento = [];
                $modelRequerimientoExtra = [];
                $modelEvidencias = [];
                $modelProducto = [];
                for( $i = 0; $i < 63; $i++ ){
                    $models[] = new Ieo();
                }
                 
                $countRequeimientos = 0;
                $countDocumentos = 0;
                $countEvidencias = 0;
                $countProducto = 0;

                if (Ieo::loadMultiple($models, Yii::$app->request->post() )) {
                    
                    foreach( $models as $key => $model) {
                                                                       
                        // Generación de instancias de los documentos REQUERIMIENTO EXTRA IEO
                        $file_socializacion_ruta = UploadedFile::getInstance( $model, "[$key]file_socializacion_ruta" );
                        $file_soporte_necesidad = UploadedFile::getInstance( $model, "[$key]file_soporte_necesidad" );
                        
                        // Generación de instancias de los documentos Reconocimiento previo y documentos a desarrollar por el profesional de apoyo
                        $file_informe_caracterizacion = UploadedFile::getInstance( $model, "[$key]file_informe_caracterizacion" );
                        $file_matriz_caracterizacion = UploadedFile::getInstance( $model, "[$key]file_matriz_caracterizacion" );
                        $file_revision_pei = UploadedFile::getInstance( $model, "[$key]file_revision_pei" );
                        $file_revision_autoevaluacion = UploadedFile::getInstance( $model, "[$key]file_revision_autoevaluacion" );
                        $file_revision_pmi = UploadedFile::getInstance( $model, "[$key]file_revision_pmi" );
                        $file_resultados_caracterizacion = UploadedFile::getInstance( $model, "[$key]file_resultados_caracterizacion" );
                        $file_horario_trabajo = UploadedFile::getInstance( $model, "[$key]file_horario_trabajo" );

                        //Generación de instancias de los documentos Actividades Evidencias
                        $file_producto_ruta = UploadedFile::getInstance( $model, "[$key]file_producto_ruta" );
                        $file_resultados_actividad_ruta = UploadedFile::getInstance( $model, "[$key]file_resultados_actividad_ruta" );
                        $file_acta_ruta = UploadedFile::getInstance( $model, "[$key]file_acta_ruta" );
                        $file_listado_ruta = UploadedFile::getInstance( $model, "[$key]file_listado_ruta" );
                        $file_fotografias_ruta = UploadedFile::getInstance( $model, "[$key]file_fotografias_ruta" );

                        //Generación de instancias de los documentos Productos
                        $file_producto_imforme_ruta = UploadedFile::getInstance( $model, "[$key]file_producto_imforme_ruta" );
                        $file_plan_accion = UploadedFile::getInstance( $model, "[$key]file_producto_plan_accion" );
                        $file_producto_presentacion = UploadedFile::getInstance( $model, "[$key]file_producto_presentacion" );
                        
                        //Validación para el registro de documentos requerimientos extras IEO
                        if( $file_socializacion_ruta && $file_soporte_necesidad){
                           
                            $modelRequerimientoExtra [] = new RequerimientoExtraIeo();
                            //Se crea carpeta para almecenar los documentos de Socializacion
                            $carpetaSocializacion = "../documentos/documentosIeo/requerimientoExtra/socializacion/".$institucion->codigo_dane;
                            if (!file_exists($carpetaSocializacion)) {
                                mkdir($carpetaSocializacion, 0777, true);
                            }

                            //Se crea carpeta para almecenar los documentos de Soporte Necesidad
                            $carpetaSocializacion = "../documentos/documentosIeo/requerimientoExtra/soporteNecesidad/".$institucion->codigo_dane;
                            if (!file_exists($carpetaSocializacion)) {
                                mkdir($carpetaSocializacion, 0777, true);
                            }
                            
                            //Construyo la ruta completa del archivo IEO Socialiazacion a guardar 
                            $rutaFisicaDirectoriaUploadSocializacion  = "../documentos/documentosIeo/requerimientoExtra/socializacion/".$institucion->codigo_dane."/";
                            $rutaFisicaDirectoriaUploadSocializacion .= $file_socializacion_ruta->baseName;
                            $rutaFisicaDirectoriaUploadSocializacion .= date( "_Y_m_d_His" ) . '.' . $file_socializacion_ruta->extension;
                            $saveSocializacion = $file_socializacion_ruta->saveAs( $rutaFisicaDirectoriaUploadSocializacion );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                            

                            //Construyo la ruta completa del archivo IEO Soporte Necesidad a guardar 
                            $rutaFisicaDirectoriaUploadSoporteNecesidad  = "../documentos/documentosIeo/requerimientoExtra/soporteNecesidad/".$institucion->codigo_dane."/";
                            $rutaFisicaDirectoriaUploadSoporteNecesidad .= $file_soporte_necesidad->baseName;
                            $rutaFisicaDirectoriaUploadSoporteNecesidad .= date( "_Y_m_d_His" ) . '.' . $file_soporte_necesidad->extension;
                            $saveSoporteNecesidad = $file_soporte_necesidad->saveAs( $rutaFisicaDirectoriaUploadSoporteNecesidad );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                            if( $saveSocializacion && $saveSoporteNecesidad){
                                
                                //Le asigno la ruta al arhvio
                                $modelRequerimientoExtra[$countRequeimientos]->socializacion_ruta = $rutaFisicaDirectoriaUploadSocializacion;
                                $modelRequerimientoExtra[$countRequeimientos]->soporte_necesidad = $rutaFisicaDirectoriaUploadSoporteNecesidad;
                                $modelRequerimientoExtra[$countRequeimientos]->ieo_id = $ieo_id;
                                $modelRequerimientoExtra[$countRequeimientos]->proyecto_ieo_id = 1;
                                

                            }else{
                                echo $file->error;
                                exit("finnn....");
                            }
                            $countRequeimientos++;
                        }

                        //Validación para el registro de documentos Reconocimiento previo y documentos a desarrollar por el profesional de apoyo
                        if( $file_informe_caracterizacion && $file_matriz_caracterizacion && $file_revision_pei && $file_revision_autoevaluacion && $file_revision_pmi && $file_resultados_caracterizacion && $file_horario_trabajo){   
                           
                            $modelDocumentosReconocimiento []= new DocumentosReconocimiento();
                            //Se crea carpeta para almecenar los documentos de Socializacion
                            $carpetaDocumentosReconocimiento = "../documentos/documentosIeo/documentosReconocimiento/".$institucion->codigo_dane;
                            if (!file_exists($carpetaDocumentosReconocimiento)) {
                                mkdir($carpetaDocumentosReconocimiento, 0777, true);
                            }

                            $ruta =   "../documentos/documentosIeo/documentosReconocimiento/".$institucion->codigo_dane."/";

                            //Construyo la ruta completa del archivo IEO Documentos de reconocimiento por cada uno de los archos 
                            
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

                            
                            $rutaFisicaDirectoriaUploadDocumentosReconocimientoHorarioTrabajo = $ruta.$file_horario_trabajo->baseName;
                            $rutaFisicaDirectoriaUploadDocumentosReconocimientoHorarioTrabajo .= date( "_Y_m_d_His" ) . '.' . $file_horario_trabajo->extension;
                            $saveHorarioTrabajo = $file_horario_trabajo->saveAs( $rutaFisicaDirectoriaUploadDocumentosReconocimientoHorarioTrabajo );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                            
                            

                            if( $saveInformeCaracterizacion && $saveMatrizCaracterizacion && $saveRevisionPei && $saveAutoevaluacion && $saveRevisionPmi && $saveResultadosCaracterizacion && $saveHorarioTrabajo){
                                //Le asigno la ruta al arhvio
                                $modelDocumentosReconocimiento[$countDocumentos]->informe_caracterizacion = $rutaFisicaDirectoriaUploadDocumentosReconocimientoInformeCaracterizacion;
                                $modelDocumentosReconocimiento[$countDocumentos]->matriz_caracterizacion = $rutaFisicaDirectoriaUploadDocumentosReconocimientoMatrizCaracterizacion;
                                $modelDocumentosReconocimiento[$countDocumentos]->revision_pei = $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPei;
                                $modelDocumentosReconocimiento[$countDocumentos]->revision_autoevaluacion = $rutaFisicaDirectoriaUploadDocumentosReconocimientoAutoevaluacion;
                                $modelDocumentosReconocimiento[$countDocumentos]->revision_pmi = $rutaFisicaDirectoriaUploadDocumentosReconocimientoRevisionPmi;
                                $modelDocumentosReconocimiento[$countDocumentos]->resultados_caracterizacion = $rutaFisicaDirectoriaUploadDocumentosReconocimientoResultadosCaracterizacion;
                                $modelDocumentosReconocimiento[$countDocumentos]->horario_trabajo = $rutaFisicaDirectoriaUploadDocumentosReconocimientoHorarioTrabajo;
                                $modelDocumentosReconocimiento[$countDocumentos]->ieo_id = $ieo_id;
                                $modelDocumentosReconocimiento[$countDocumentos]->proyecto_ieo_id = 1;
                            }else{
                                echo $file->error;
                                exit("finnn....");
                            }
                            $countDocumentos ++;
                        }

                        //Validación para el registro de documentos Actividades Evidencias
                        if( $file_producto_ruta && $file_resultados_actividad_ruta && $file_acta_ruta && $file_listado_ruta){
                            $modelEvidencias [] = new Evidencias();
                            //Se crea carpeta para almecenar los documentos de Socializacion
                            $carpetaEvidencias = "../documentos/documentosIeo/actividades/evidencias/".$institucion->codigo_dane;
                            if (!file_exists($carpetaEvidencias)) {
                                mkdir($carpetaEvidencias, 0777, true);
                            }

                            //Se crea carpeta para almecenar los documentos de Soporte Necesidad
                            $carpetaSocializacion = "../documentos/documentosIeo/actividades/evidencias/".$institucion->codigo_dane;
                            if (!file_exists($carpetaSocializacion)) {
                                mkdir($carpetaSocializacion, 0777, true);
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
                                $modelEvidencias[$countEvidencias]->ieo_id = $ieo_id;
                                $modelEvidencias[$countEvidencias]->tipo_actividad_id = 1;
                                $modelEvidencias[$countEvidencias]->producto_ruta = $rutaFisicaDirectoriaUploadProducto;
                                $modelEvidencias[$countEvidencias]->resultados_actividad_ruta = $rutaFisicaDirectoriaUploadResultadosActividad;
                                $modelEvidencias[$countEvidencias]->acta_ruta = $rutaFisicaDirectoriaUploadActa;
                                $modelEvidencias[$countEvidencias]->listado_ruta = $rutaFisicaDirectoriaUploadListado;
                                $modelEvidencias[$countEvidencias]->fotografias_ruta = $rutaFisicaDirectoriaUploadFotografia;


                            }else{
                                echo $file->error;
                                exit("finnn....");
                            }
                            $countEvidencias++;
                        }

                        //Validación para el registro de documentos Producto
                        if( $file_producto_imforme_ruta && $file_plan_accion){
                           
                            $modelProducto []= new Producto();
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

                            if( $saveProductoInforme && $saveProductoPlan){
                                
                                //Le asigno la ruta al arhvio
                                $modelProducto[$countProducto]->imforme_ruta = $rutaFisicaDirectoriaUploadProductoInforme;
                                $modelProducto[$countProducto]->plan_accion_ruta = $rutaFisicaDirectoriaUploadProductoPlan;
                                $modelProducto[$countProducto]->ieo_id = $ieo_id;
                                $modelProducto[$countProducto]->actividades_ieo_id = 1;
                                

                            }else{
                                echo $file->error;
                                exit("finnn....");
                            }
                            $countProducto++;
                        }

                        
                    }
                 
                    
                    foreach( $modelRequerimientoExtra as $key => $model) {
                        if(!$model->save()){
                            exit( "Error al guardar documentos Requrimientos extras IEO" );
                        }
                    }

                    foreach( $modelDocumentosReconocimiento as $key => $model) {
                        if(!$model->save()){
                            exit( "Error al guardar documentos Reconocimiento IEO" );
                        }
                    }

                    foreach( $modelEvidencias as $key => $model) {
                        if(!$model->save()){
                            exit( "Error al guardar documentos Evidencias" );
                        }
                    }

                    foreach( $modelProducto as $key => $model) {
                        if(!$model->save()){
                            exit( "Error al guardar documentos Producto" );
                        }
                      }

                }

                /**Validacion y registro de campos para modelo Tipo de cantidad poblacion */
                if (Yii::$app->request->post('TiposCantidadPoblacion')){
                    $data = Yii::$app->request->post('TiposCantidadPoblacion');
                    $count 	= count( $data );
                    $modelCantidadPoblacion = [];
        
                    for( $i = 0; $i < $count; $i++ ){
                        $modelCantidadPoblacion[] = new TiposCantidadPoblacion();
                    }
        
                    if (TiposCantidadPoblacion::loadMultiple($modelCantidadPoblacion, Yii::$app->request->post() )) {
                        foreach( $modelCantidadPoblacion as $key => $model) {
                                                if($model->tiempo_libre){
                                $model->actividad_id = 1;
                                $model->ieo_id = $ieo_id;
                                $model->proyecto_ieo_id = 1;
                                                
                                
                                if($model->save() && Yii::$app->request->post('EstudiantesIeo')){
                                    $status = true;
                                    $dataEstudiantes = Yii::$app->request->post('EstudiantesIeo');
                                    
                                    $countEstudiantes 	= count( $dataEstudiantes );
                                    $modelEstudiantesIeo = [];
                                    
                                    for( $i = 0; $i < $countEstudiantes; $i++ ){
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
                return $this->redirect(['index', 'guardado' => 1 ]);
            }
            

        }
        
      
        $ZonasEducatibas  = ZonasEducativas::find()->where( 'estado=1' )->all();
		$zonasEducativas	 = ArrayHelper::map( $ZonasEducatibas, 'id', 'descripcion' );
        
        return $this->renderAjax('create', [
            'model' => $ieo_model,
            'zonasEducativas' => $zonasEducativas,
        ]);
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

        return $this->render('update', [
            'model' => $model,
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = IeoE::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
