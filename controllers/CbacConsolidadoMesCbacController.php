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
use app\models\CbacConsolidadoMesCbac;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\CbacImpConsolidadoMesCbac;
use app\models\CbacActividadesConsolidadoCbac;
use app\models\CbacTipoCantidaidPoblacionConsolidadoCbac;
use app\models\CbacEvidenciasConsolidadoCbac;

use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CbacConsolidadoMesCbacController implements the CRUD actions for CbacConsolidadoMesCbac model.
 */
class CbacConsolidadoMesCbacController extends Controller
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
     * Lists all CbacConsolidadoMesCbac models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CbacConsolidadoMesCbac::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
        ]);
    }

    /**
     * Displays a single CbacConsolidadoMesCbac model.
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

    function actionViewFases($model, $form, $datos = 0){
        
        $imp_cbac = new CbacImpConsolidadoMesCbac();
        $actividade_cbac = new CbacActividadesConsolidadoCbac();
        $tipo_poblacion_cbac = new CbacTipoCantidaidPoblacionConsolidadoCbac();
        $evidencias_cbac = new CbacEvidenciasConsolidadoCbac();

        $proyectos = [ 
            1 => "Desarrollar herramientas en docentes y directivos docentes de las IEO que implementen componentes artísticos y culturales.",
            2 => "Fortalecer la oferta de programas culturales para estudiantes en el proceso formativo de competencias básicas dentro y fuera del aula.",
            3 => "Promover el acompañamiento de padres de familia desde el arte y la cultura en el proceso de fortalecimiento de competencias básicas de estudiantes de las IEO.",
            4 => "",
        ];
        
        return $this->renderAjax('fases', [
            'fases' => $proyectos,
            'form' => $form,
            "model" => $model,
            'imp_cbac' => $imp_cbac,
            'actividade_cbac' => $actividade_cbac,
            'tipo_poblacion_cbac' => $tipo_poblacion_cbac,
            'evidencias_cbac' => $evidencias_cbac,
            'datos' => $datos
        ]);
        
    }

    /**
     * Creates a new CbacConsolidadoMesCbac model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacConsolidadoMesCbac();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

        if ($model->load(Yii::$app->request->post())) {

            $model->id_institucion = $idInstitucion;
            
            if($model->save()){
                 $id_consolidado = $model->id;
                 //$id_consolidado = 1;

                 if (Yii::$app->request->post('CbacImpConsolidadoMesCbac')){
                     $data = Yii::$app->request->post('CbacImpConsolidadoMesCbac');
                     $count  = count($data);
                     $modelImpCbac = [];

                     for( $i = 0; $i < $count; $i++ ){
                        $modelImpCbac[] = new CbacImpConsolidadoMesCbac();
                    }

                    if (CbacImpConsolidadoMesCbac::loadMultiple($modelImpCbac, Yii::$app->request->post() )) {
                        foreach($modelImpCbac as $key => $model) {
                             
                             if($model->avance_sede and $model->avance_ieo){
                                $model->id_consolidado_mes_cbac = $id_consolidado;
                                
                                if($model->save()){
                                    
                                    $id_imp = $model->id;
                                    
                                    if(Yii::$app->request->post('CbacActividadesConsolidadoCbac')){
                                        
                                        $dataActividad = Yii::$app->request->post('CbacActividadesConsolidadoCbac');
                                        $countActividad = count( $dataActividad );
                                        $modelActividadInd = [];

                                        for( $i = 0; $i < $countActividad; $i++ ){
                                            $modelActividadInd[] = new CbacActividadesConsolidadoCbac();
                                        }

                                        if (CbacActividadesConsolidadoCbac::loadMultiple($modelActividadInd, Yii::$app->request->post() )) {

                                            
                                            foreach($modelActividadInd as $key1 => $model1) {
                                                
                                                if($key == 1 && $key1 <= 2){
                                                    
                                                    if($model1->avance_sede && $model1->avance_ieo){
                                                        $model1->id_imp_consolidado_mes_cbac = $id_imp;
                                                        $model1->save();
                                                    }
                                                }

                                                if($key == 2 && $key1 > 2 && $key1 <= 7){
                                                    if($model1->avance_sede && $model1->avance_ieo){
                                                        $model1->id_imp_consolidado_mes_cbac = $id_imp;
                                                        $model1->save();
                                                    }
                                                }
                                                if($key == 3 && $key1 > 7){
                                                    if($model1->avance_sede && $model1->avance_ieo){
                                                        $model1->id_imp_consolidado_mes_cbac = $id_imp;
                                                        $model1->save();
                                                    }
                                                }                                            
                                            }                                           
                                        }
                                    }

                                    if(Yii::$app->request->post('CbacTipoCantidaidPoblacionConsolidadoCbac')){
                                        
                                        $dataPoblacion = Yii::$app->request->post('CbacTipoCantidaidPoblacionConsolidadoCbac');
                                        $countPoblacion = count( $dataPoblacion );
                                        $modelTipoPoblacion = [];

                                        for( $i = 0; $i < $countPoblacion; $i++ ){
                                            $modelTipoPoblacion[] = new CbacTipoCantidaidPoblacionConsolidadoCbac();
                                        }
                                        if (CbacTipoCantidaidPoblacionConsolidadoCbac::loadMultiple($modelTipoPoblacion, Yii::$app->request->post() )) {

                                            foreach($modelTipoPoblacion as $key2 => $model2) {
                                                $model2->id_imp_consolidado_mes_cbac = $id_imp;
                                                if($key == 1 && $key2 <= 2){
                                                    if($model2->ciencias_naturales || $model2->grado_6 || $model2->cuidadores){
                                                         $model2->save();
                                                    }
                                                }
                                                if($key == 2 && $key2 > 2 && $key2 <= 7){
                                                    if($model2->ciencias_naturales || $model2->grado_6 || $model2->cuidadores){
                                                         $model2->save();
                                                    }
                                                }
                                                if($key == 3 && $key2 > 7){
                                                    if($model2->ciencias_naturales || $model2->grado_6 || $model2->cuidadores){
                                                         $model2->save();
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    if(Yii::$app->request->post('CbacEvidenciasConsolidadoCbac')){
                                        $dataEvidencias = Yii::$app->request->post('CbacEvidenciasConsolidadoCbac');
                                        $countEvidencias = count( $dataEvidencias );
                                        $modelEvidencias = [];

                                        for( $i = 0; $i < $countEvidencias; $i++ ){
                                            $modelEvidencias[] = new CbacEvidenciasConsolidadoCbac();
                                        }

                                        if (CbacEvidenciasConsolidadoCbac::loadMultiple($modelEvidencias, Yii::$app->request->post() )) {

                                            foreach($modelEvidencias as $key3 => $model3) {
                                                    if($key == 1 && $key3 <= 2){

                                                        $file_actas = UploadedFile::getInstance( $model3, "[$key3]actas") ? UploadedFile::getInstance( $model3, "[$key3]actas") : null;
                                                        $file_reportes = UploadedFile::getInstance( $model3, "[$key3]reportes" ) ? UploadedFile::getInstance( $model3, "[$key3]reportes") : null;
                                                        $file_listados = UploadedFile::getInstance( $model3, "[$key3]listados" ) ? UploadedFile::getInstance( $model3, "[$key3]listados") : null;
                                                        $file_plan_trabajo = UploadedFile::getInstance( $model3, "[$key3]plan_trabajo" ) ? UploadedFile::getInstance( $model3, "[$key3]plan_trabajo") : null;
                                                        $file_formato_seguimiento = UploadedFile::getInstance( $model3, "[$key3]formato_seguimiento" ) ? UploadedFile::getInstance( $model3, "[$key3]formato_seguimiento") : null;
                                                        $file_formato_evaluacion = UploadedFile::getInstance( $model3, "[$key3]formato_evaluacion" ) ? UploadedFile::getInstance( $model3, "[$key3]formato_evaluacion") : null;
                                                        $file_fotografias = UploadedFile::getInstance( $model3, "[$key3]fotografias" ) ? UploadedFile::getInstance( $model3, "[$key3]fotografias") : null;
                                                        $file_vidoes = UploadedFile::getInstance( $model3, "[$key3]vidoes") ? UploadedFile::getInstance( $model3, "[$key3]vidoes") : null;
                                                        $file_otros = UploadedFile::getInstance( $model3, "[$key3]otros_productos") ? UploadedFile::getInstance( $model3, "[$key3]otros_productos") : null;

                                                    
                                                        $carpetaEvidencias = "../documentos/documentos_CBAC_MES/evidencias_CBAC/".$institucion->codigo_dane;
                                                        if (!file_exists($carpetaEvidencias)) {
                                                            mkdir($carpetaEvidencias, 0777, true);
                                                        }

                                                        if($file_actas){
                                                        $rutaFisicaActas  = $carpetaEvidencias."/";
                                                        $rutaFisicaActas .= $file_actas->baseName;
                                                        $rutaFisicaActas .= date( "_Y_m_d_His" ) . '.' . $file_actas->extension;
                                                        $saveActa = $file_actas->saveAs( $rutaFisicaActas );
                                                        $file_actas = $rutaFisicaActas;
                                                    

                                                        if($file_reportes){
                                                            $rutaFisicaReportes  = $carpetaEvidencias."/";
                                                            $rutaFisicaReportes .= $file_reportes->baseName;
                                                            $rutaFisicaReportes .= date( "_Y_m_d_His" ) . '.' . $file_reportes->extension;
                                                            $saveReportes = $file_reportes->saveAs( $rutaFisicaReportes );
                                                            $file_reportes = $rutaFisicaReportes;
                                                        }

                                                        if($file_listados){
                                                            $rutaFisicaListados  = $carpetaEvidencias."/";
                                                            $rutaFisicaListados .= $file_listados->baseName;
                                                            $rutaFisicaListados .= date( "_Y_m_d_His" ) . '.' . $file_listados->extension;
                                                            $saveListados = $file_listados->saveAs( $rutaFisicaListados );
                                                            $file_listados = $rutaFisicaListados;
                                                        }

                                                        if($file_plan_trabajo){
                                                            $rutaFisicaPlanTrabajo  = $carpetaEvidencias."/";
                                                            $rutaFisicaPlanTrabajo .= $file_plan_trabajo->baseName;
                                                            $rutaFisicaPlanTrabajo .= date( "_Y_m_d_His" ) . '.' . $file_plan_trabajo->extension;
                                                            $savePlanTrabajo = $file_plan_trabajo->saveAs( $rutaFisicaPlanTrabajo );
                                                            $file_plan_trabajo = $rutaFisicaPlanTrabajo;
                                                        }


                                                        if($file_formato_seguimiento){
                                                            $rutaFisicaFormato  = $carpetaEvidencias."/";
                                                            $rutaFisicaFormato .= $file_formato_seguimiento->baseName;
                                                            $rutaFisicaFormato .= date( "_Y_m_d_His" ) . '.' . $file_formato_seguimiento->extension;
                                                            $saveFormato = $file_formato_seguimiento->saveAs( $rutaFisicaFormato );
                                                            $file_formato_seguimiento = $rutaFisicaFormato;
                                                        }

                                                        if($file_formato_evaluacion){
                                                            $rutaFisicaFormatoEvaluacion  = $carpetaEvidencias."/";
                                                            $rutaFisicaFormatoEvaluacion .= $file_formato_evaluacion->baseName;
                                                            $rutaFisicaFormatoEvaluacion .= date( "_Y_m_d_His" ) . '.' . $file_formato_evaluacion->extension;
                                                            $saveFormato = $file_formato_evaluacion->saveAs( $rutaFisicaFormatoEvaluacion );
                                                            $file_formato_evaluacion = $rutaFisicaFormatoEvaluacion;
                                                        }

                                                        if($file_fotografias){
                                                            $rutaFisicaFotografias  = $carpetaEvidencias."/";
                                                            $rutaFisicaFotografias .= $file_fotografias->baseName;
                                                            $rutaFisicaFotografias .= date( "_Y_m_d_His" ) . '.' . $file_fotografias->extension;
                                                            $saveFotografias = $file_fotografias->saveAs( $rutaFisicaFotografias );
                                                            $file_fotografias = $rutaFisicaFotografias;
                                                        }

                                                        if($file_vidoes){
                                                            $rutaFisicaVideos  = $carpetaEvidencias."/";
                                                            $rutaFisicaVideos .= $file_vidoes->baseName;
                                                            $rutaFisicaVideos .= date( "_Y_m_d_His" ) . '.' . $file_vidoes->extension;
                                                            $saveVideos = $file_vidoes->saveAs( $rutaFisicaVideos );
                                                            $file_vidoes = $rutaFisicaVideos;
                                                        }

                                                        if($file_otros){
                                                            $rutaFisicaOtros  = $carpetaEvidencias."/";
                                                            $rutaFisicaOtros .= $file_otros->baseName;
                                                            $rutaFisicaOtros .= date( "_Y_m_d_His" ) . '.' . $file_otros->extension;
                                                            $saveOtros = $file_otros->saveAs( $rutaFisicaOtros );
                                                            $file_otros = $rutaFisicaOtros;
                                                        }


                                                        $modelEvidencias[$key]->id_imp_consolidado_mes_cbac = $id_imp;
                                                        $modelEvidencias[$key]->actas = $file_actas;
                                                        $modelEvidencias[$key]->reportes = $file_reportes;
                                                        $modelEvidencias[$key]->listados = $file_listados;
                                                        $modelEvidencias[$key]->plan_trabajo = $file_plan_trabajo;
                                                        $modelEvidencias[$key]->formato_seguimiento = $file_formato_seguimiento;
                                                        $modelEvidencias[$key]->formato_evaluacion = $file_formato_evaluacion;
                                                        $modelEvidencias[$key]->fotografias = $file_fotografias;
                                                        $modelEvidencias[$key]->vidoes = $file_vidoes;
                                                        $modelEvidencias[$key]->otros_productos = $file_otros;
                                                        $modelEvidencias[$key]->save();
                                                    }
                                                    if($key == 2 && $key2 > 2 && $key2 <= 7){

                                                        $file_actas = UploadedFile::getInstance( $model3, "[$key3]actas") ? UploadedFile::getInstance( $model3, "[$key3]actas") : null;
                                                        $file_reportes = UploadedFile::getInstance( $model3, "[$key3]reportes" ) ? UploadedFile::getInstance( $model3, "[$key3]reportes") : null;
                                                        $file_listados = UploadedFile::getInstance( $model3, "[$key3]listados" ) ? UploadedFile::getInstance( $model3, "[$key3]listados") : null;
                                                        $file_plan_trabajo = UploadedFile::getInstance( $model3, "[$key3]plan_trabajo" ) ? UploadedFile::getInstance( $model3, "[$key3]plan_trabajo") : null;
                                                        $file_formato_seguimiento = UploadedFile::getInstance( $model3, "[$key3]formato_seguimiento" ) ? UploadedFile::getInstance( $model3, "[$key3]formato_seguimiento") : null;
                                                        $file_formato_evaluacion = UploadedFile::getInstance( $model3, "[$key3]formato_evaluacion" ) ? UploadedFile::getInstance( $model3, "[$key3]formato_evaluacion") : null;
                                                        $file_fotografias = UploadedFile::getInstance( $model3, "[$key3]fotografias" ) ? UploadedFile::getInstance( $model3, "[$key3]fotografias") : null;
                                                        $file_vidoes = UploadedFile::getInstance( $model3, "[$key3]vidoes") ? UploadedFile::getInstance( $model3, "[$key3]vidoes") : null;
                                                        $file_otros = UploadedFile::getInstance( $model3, "[$key3]otros_productos") ? UploadedFile::getInstance( $model3, "[$key3]otros_productos") : null;

                                                    
                                                        $carpetaEvidencias = "../documentos/documentos_CBAC_MES/evidencias_CBAC/".$institucion->codigo_dane;
                                                        if (!file_exists($carpetaEvidencias)) {
                                                            mkdir($carpetaEvidencias, 0777, true);
                                                        }

                                                        if($file_actas){
                                                        $rutaFisicaActas  = $carpetaEvidencias."/";
                                                        $rutaFisicaActas .= $file_actas->baseName;
                                                        $rutaFisicaActas .= date( "_Y_m_d_His" ) . '.' . $file_actas->extension;
                                                        $saveActa = $file_actas->saveAs( $rutaFisicaActas );
                                                        $file_actas = $rutaFisicaActas;
                                                    

                                                        if($file_reportes){
                                                            $rutaFisicaReportes  = $carpetaEvidencias."/";
                                                            $rutaFisicaReportes .= $file_reportes->baseName;
                                                            $rutaFisicaReportes .= date( "_Y_m_d_His" ) . '.' . $file_reportes->extension;
                                                            $saveReportes = $file_reportes->saveAs( $rutaFisicaReportes );
                                                            $file_reportes = $rutaFisicaReportes;
                                                        }

                                                        if($file_listados){
                                                            $rutaFisicaListados  = $carpetaEvidencias."/";
                                                            $rutaFisicaListados .= $file_listados->baseName;
                                                            $rutaFisicaListados .= date( "_Y_m_d_His" ) . '.' . $file_listados->extension;
                                                            $saveListados = $file_listados->saveAs( $rutaFisicaListados );
                                                            $file_listados = $rutaFisicaListados;
                                                        }

                                                        if($file_plan_trabajo){
                                                            $rutaFisicaPlanTrabajo  = $carpetaEvidencias."/";
                                                            $rutaFisicaPlanTrabajo .= $file_plan_trabajo->baseName;
                                                            $rutaFisicaPlanTrabajo .= date( "_Y_m_d_His" ) . '.' . $file_plan_trabajo->extension;
                                                            $savePlanTrabajo = $file_plan_trabajo->saveAs( $rutaFisicaPlanTrabajo );
                                                            $file_plan_trabajo = $rutaFisicaPlanTrabajo;
                                                        }


                                                        if($file_formato_seguimiento){
                                                            $rutaFisicaFormato  = $carpetaEvidencias."/";
                                                            $rutaFisicaFormato .= $file_formato_seguimiento->baseName;
                                                            $rutaFisicaFormato .= date( "_Y_m_d_His" ) . '.' . $file_formato_seguimiento->extension;
                                                            $saveFormato = $file_formato_seguimiento->saveAs( $rutaFisicaFormato );
                                                            $file_formato_seguimiento = $rutaFisicaFormato;
                                                        }

                                                        if($file_formato_evaluacion){
                                                            $rutaFisicaFormatoEvaluacion  = $carpetaEvidencias."/";
                                                            $rutaFisicaFormatoEvaluacion .= $file_formato_evaluacion->baseName;
                                                            $rutaFisicaFormatoEvaluacion .= date( "_Y_m_d_His" ) . '.' . $file_formato_evaluacion->extension;
                                                            $saveFormato = $file_formato_evaluacion->saveAs( $rutaFisicaFormatoEvaluacion );
                                                            $file_formato_evaluacion = $rutaFisicaFormatoEvaluacion;
                                                        }

                                                        if($file_fotografias){
                                                            $rutaFisicaFotografias  = $carpetaEvidencias."/";
                                                            $rutaFisicaFotografias .= $file_fotografias->baseName;
                                                            $rutaFisicaFotografias .= date( "_Y_m_d_His" ) . '.' . $file_fotografias->extension;
                                                            $saveFotografias = $file_fotografias->saveAs( $rutaFisicaFotografias );
                                                            $file_fotografias = $rutaFisicaFotografias;
                                                        }

                                                        if($file_vidoes){
                                                            $rutaFisicaVideos  = $carpetaEvidencias."/";
                                                            $rutaFisicaVideos .= $file_vidoes->baseName;
                                                            $rutaFisicaVideos .= date( "_Y_m_d_His" ) . '.' . $file_vidoes->extension;
                                                            $saveVideos = $file_vidoes->saveAs( $rutaFisicaVideos );
                                                            $file_vidoes = $rutaFisicaVideos;
                                                        }

                                                        if($file_otros){
                                                            $rutaFisicaOtros  = $carpetaEvidencias."/";
                                                            $rutaFisicaOtros .= $file_otros->baseName;
                                                            $rutaFisicaOtros .= date( "_Y_m_d_His" ) . '.' . $file_otros->extension;
                                                            $saveOtros = $file_otros->saveAs( $rutaFisicaOtros );
                                                            $file_otros = $rutaFisicaOtros;
                                                        }


                                                        $modelEvidencias[$key]->id_imp_consolidado_mes_cbac = $id_imp;
                                                        $modelEvidencias[$key]->actas = $file_actas;
                                                        $modelEvidencias[$key]->reportes = $file_reportes;
                                                        $modelEvidencias[$key]->listados = $file_listados;
                                                        $modelEvidencias[$key]->plan_trabajo = $file_plan_trabajo;
                                                        $modelEvidencias[$key]->formato_seguimiento = $file_formato_seguimiento;
                                                        $modelEvidencias[$key]->formato_evaluacion = $file_formato_evaluacion;
                                                        $modelEvidencias[$key]->fotografias = $file_fotografias;
                                                        $modelEvidencias[$key]->vidoes = $file_vidoes;
                                                        $modelEvidencias[$key]->otros_productos = $file_otros;
                                                        $modelEvidencias[$key]->save();
                                                    }

                                                    if($key == 2 && $key2 > 2 && $key2 <= 7){

                                                        $file_actas = UploadedFile::getInstance( $model3, "[$key3]actas") ? UploadedFile::getInstance( $model3, "[$key3]actas") : null;
                                                        $file_reportes = UploadedFile::getInstance( $model3, "[$key3]reportes" ) ? UploadedFile::getInstance( $model3, "[$key3]reportes") : null;
                                                        $file_listados = UploadedFile::getInstance( $model3, "[$key3]listados" ) ? UploadedFile::getInstance( $model3, "[$key3]listados") : null;
                                                        $file_plan_trabajo = UploadedFile::getInstance( $model3, "[$key3]plan_trabajo" ) ? UploadedFile::getInstance( $model3, "[$key3]plan_trabajo") : null;
                                                        $file_formato_seguimiento = UploadedFile::getInstance( $model3, "[$key3]formato_seguimiento" ) ? UploadedFile::getInstance( $model3, "[$key3]formato_seguimiento") : null;
                                                        $file_formato_evaluacion = UploadedFile::getInstance( $model3, "[$key3]formato_evaluacion" ) ? UploadedFile::getInstance( $model3, "[$key3]formato_evaluacion") : null;
                                                        $file_fotografias = UploadedFile::getInstance( $model3, "[$key3]fotografias" ) ? UploadedFile::getInstance( $model3, "[$key3]fotografias") : null;
                                                        $file_vidoes = UploadedFile::getInstance( $model3, "[$key3]vidoes") ? UploadedFile::getInstance( $model3, "[$key3]vidoes") : null;
                                                        $file_otros = UploadedFile::getInstance( $model3, "[$key3]otros_productos") ? UploadedFile::getInstance( $model3, "[$key3]otros_productos") : null;

                                                    
                                                        $carpetaEvidencias = "../documentos/documentos_CBAC_MES/evidencias_CBAC/".$institucion->codigo_dane;
                                                        if (!file_exists($carpetaEvidencias)) {
                                                            mkdir($carpetaEvidencias, 0777, true);
                                                        }

                                                        if($file_actas){
                                                        $rutaFisicaActas  = $carpetaEvidencias."/";
                                                        $rutaFisicaActas .= $file_actas->baseName;
                                                        $rutaFisicaActas .= date( "_Y_m_d_His" ) . '.' . $file_actas->extension;
                                                        $saveActa = $file_actas->saveAs( $rutaFisicaActas );
                                                        $file_actas = $rutaFisicaActas;
                                                    

                                                        if($file_reportes){
                                                            $rutaFisicaReportes  = $carpetaEvidencias."/";
                                                            $rutaFisicaReportes .= $file_reportes->baseName;
                                                            $rutaFisicaReportes .= date( "_Y_m_d_His" ) . '.' . $file_reportes->extension;
                                                            $saveReportes = $file_reportes->saveAs( $rutaFisicaReportes );
                                                            $file_reportes = $rutaFisicaReportes;
                                                        }

                                                        if($file_listados){
                                                            $rutaFisicaListados  = $carpetaEvidencias."/";
                                                            $rutaFisicaListados .= $file_listados->baseName;
                                                            $rutaFisicaListados .= date( "_Y_m_d_His" ) . '.' . $file_listados->extension;
                                                            $saveListados = $file_listados->saveAs( $rutaFisicaListados );
                                                            $file_listados = $rutaFisicaListados;
                                                        }

                                                        if($file_plan_trabajo){
                                                            $rutaFisicaPlanTrabajo  = $carpetaEvidencias."/";
                                                            $rutaFisicaPlanTrabajo .= $file_plan_trabajo->baseName;
                                                            $rutaFisicaPlanTrabajo .= date( "_Y_m_d_His" ) . '.' . $file_plan_trabajo->extension;
                                                            $savePlanTrabajo = $file_plan_trabajo->saveAs( $rutaFisicaPlanTrabajo );
                                                            $file_plan_trabajo = $rutaFisicaPlanTrabajo;
                                                        }


                                                        if($file_formato_seguimiento){
                                                            $rutaFisicaFormato  = $carpetaEvidencias."/";
                                                            $rutaFisicaFormato .= $file_formato_seguimiento->baseName;
                                                            $rutaFisicaFormato .= date( "_Y_m_d_His" ) . '.' . $file_formato_seguimiento->extension;
                                                            $saveFormato = $file_formato_seguimiento->saveAs( $rutaFisicaFormato );
                                                            $file_formato_seguimiento = $rutaFisicaFormato;
                                                        }

                                                        if($file_formato_evaluacion){
                                                            $rutaFisicaFormatoEvaluacion  = $carpetaEvidencias."/";
                                                            $rutaFisicaFormatoEvaluacion .= $file_formato_evaluacion->baseName;
                                                            $rutaFisicaFormatoEvaluacion .= date( "_Y_m_d_His" ) . '.' . $file_formato_evaluacion->extension;
                                                            $saveFormato = $file_formato_evaluacion->saveAs( $rutaFisicaFormatoEvaluacion );
                                                            $file_formato_evaluacion = $rutaFisicaFormatoEvaluacion;
                                                        }

                                                        if($file_fotografias){
                                                            $rutaFisicaFotografias  = $carpetaEvidencias."/";
                                                            $rutaFisicaFotografias .= $file_fotografias->baseName;
                                                            $rutaFisicaFotografias .= date( "_Y_m_d_His" ) . '.' . $file_fotografias->extension;
                                                            $saveFotografias = $file_fotografias->saveAs( $rutaFisicaFotografias );
                                                            $file_fotografias = $rutaFisicaFotografias;
                                                        }

                                                        if($file_vidoes){
                                                            $rutaFisicaVideos  = $carpetaEvidencias."/";
                                                            $rutaFisicaVideos .= $file_vidoes->baseName;
                                                            $rutaFisicaVideos .= date( "_Y_m_d_His" ) . '.' . $file_vidoes->extension;
                                                            $saveVideos = $file_vidoes->saveAs( $rutaFisicaVideos );
                                                            $file_vidoes = $rutaFisicaVideos;
                                                        }

                                                        if($file_otros){
                                                            $rutaFisicaOtros  = $carpetaEvidencias."/";
                                                            $rutaFisicaOtros .= $file_otros->baseName;
                                                            $rutaFisicaOtros .= date( "_Y_m_d_His" ) . '.' . $file_otros->extension;
                                                            $saveOtros = $file_otros->saveAs( $rutaFisicaOtros );
                                                            $file_otros = $rutaFisicaOtros;
                                                        }


                                                        $modelEvidencias[$key]->id_imp_consolidado_mes_cbac = $id_imp;
                                                        $modelEvidencias[$key]->actas = $file_actas;
                                                        $modelEvidencias[$key]->reportes = $file_reportes;
                                                        $modelEvidencias[$key]->listados = $file_listados;
                                                        $modelEvidencias[$key]->plan_trabajo = $file_plan_trabajo;
                                                        $modelEvidencias[$key]->formato_seguimiento = $file_formato_seguimiento;
                                                        $modelEvidencias[$key]->formato_evaluacion = $file_formato_evaluacion;
                                                        $modelEvidencias[$key]->fotografias = $file_fotografias;
                                                        $modelEvidencias[$key]->vidoes = $file_vidoes;
                                                        $modelEvidencias[$key]->otros_productos = $file_otros;
                                                        $modelEvidencias[$key]->save();
                                                        }
                                                    }
                                                    }
                                                }

                                            }

                                        }
                                    }

                                }
                             
                             }
                        }
                    }
                 }
            }

            return $this->redirect(['index', 'guardado' => 1]);
        }

        $Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes  = ArrayHelper::map( $Sedes, 'id', 'descripcion' );

        return $this->renderAjax('create', [
            'model' => $model,
            'sedes' => $sedes,
            'institucion' => $institucion->descripcion,
        ]);
    }

    /**
     * Updates an existing CbacConsolidadoMesCbac model.
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


        $impConsolidado = new CbacImpConsolidadoMesCbac();
        $impConsolidado = $impConsolidado->find()->orderby("id")->andWhere("id_consolidado_mes_cbac=$id")->all();
        
        var_dump($impConsolidado);
        die();

        $result = ArrayHelper::getColumn($impConsolidado, function ($element) 
		{
            $dato[$element['id_componente']]['avance_sede']= $element['avance_sede'];
            $dato[$element['id_componente']]['avance_ieo']= $element['avance_ieo'];

            return $dato;
        });

        foreach	($result as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
                
                $datos[$ids] = $valores;
        }

        

        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

        return $this->renderAjax('update', [
            'model' => $model,
            'sedes' => $this->obtenerSede(),
            'institucion' => $institucion->descripcion,
            'datos'=> $datos,
        ]);
    }

    public function obtenerSede()
	{
        $idInstitucion = $_SESSION['instituciones'][0];
		$Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );
		
		return $sedes;
    }

    /**
     * Deletes an existing CbacConsolidadoMesCbac model.
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
     * Finds the CbacConsolidadoMesCbac model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacConsolidadoMesCbac the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacConsolidadoMesCbac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
