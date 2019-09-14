<?php

/**
 * Nota:
 * Total de sesiones(o encuentros) por actividad: Total de actividades que halla por tabla intervención_ieo
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
use app\models\IsIsaInformeSemanalIsa;
use app\models\IsIsaActividadesIsIsa;
use app\models\IsIsaActividadIsIsa;
use app\models\IsIsaTipoCantidadPoblacionIsIsa;
use app\models\IsIsaEvidenciasIsIsa;
use app\models\Sedes;
use app\models\Instituciones;

use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IsIsaInformeSemanalIsaController implements the CRUD actions for IsIsaInformeSemanalIsa model.
 */
class IsIsaInformeSemanalIsaController extends Controller
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
     * Lists all IsIsaInformeSemanalIsa models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => IsIsaInformeSemanalIsa::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
        ]);
    }

    function actionViewFases($model, $form){
        
        $actividades_is_isa = new IsIsaActividadesIsIsa();
        $actividade_is_isa = new IsIsaActividadIsIsa();
        $tipo_poblacion_is_isa = new IsIsaTipoCantidadPoblacionIsIsa();


        $proyectos = [ 
            1 => "Sensibilizar a la comunidad sobre la importancia del arte y la cultura a través de la oferta cultural del municipio.",
            2 => "Desarrollar programas de iniciación y sensibilización artística desde las instituciones educativas oficiales dirigidos a la comunidad.",
        ];
		
		return $this->renderAjax('fases', [
            'fases' => $proyectos,
            'form' => $form,
            "model" => $model,
            'actividades_is_isa' => $actividades_is_isa,
            'actividade_is_isa' => $actividade_is_isa,
            'tipo_poblacion_is_isa' => $tipo_poblacion_is_isa,
        ]);
		
	}

    /**
     * Displays a single IsIsaInformeSemanalIsa model.
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
     * Creates a new IsIsaInformeSemanalIsa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IsIsaInformeSemanalIsa();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);
		
		$id_sede 		= $_SESSION['sede'][0];

        if ($model->load(Yii::$app->request->post())) {
            
            $model->id_institucion = $_SESSION['instituciones'][0];
            $model->id_sede = intval($model->id_sede);

            if($model->save()){
                $is_isa_id = $model->id;
                //$is_isa_id = 2;

                if (Yii::$app->request->post('IsIsaActividadesIsIsa')){
                    $data = Yii::$app->request->post('IsIsaActividadesIsIsa');
                    $count 	= count($data);
                    $modelActividades = [];

                    for( $i = 0; $i < $count; $i++ ){
                        $modelActividades[] = new IsIsaActividadesIsIsa();
                    }

                    if (IsIsaActividadesIsIsa::loadMultiple($modelActividades, Yii::$app->request->post() )) {
                        foreach( $modelActividades as $key => $modelActividad) {
                            if($modelActividad->duracion and $modelActividad->docente){
                                $modelActividad->id_informe_semanal_isa = $is_isa_id;
                                if($modelActividad->save()){
                                    
                                    if(Yii::$app->request->post('IsIsaActividadIsIsa')){
                                        $dataActividad = Yii::$app->request->post('IsIsaActividadIsIsa');
                                        $countActividad = count( $dataActividad );
                                        $modelActividadInd = [];
                                        
                                        for( $i = 0; $i < $countActividad; $i++ ){
                                            $modelActividadInd[] = new IsIsaActividadIsIsa();
                                        }
    
                                        if (IsIsaActividadIsIsa::loadMultiple($modelActividadInd, Yii::$app->request->post() )) {
                                            if($modelActividadInd[$key]->sesiones_realizadas){
                                                $modelActividadInd[$key]->id_actividades_is_isa = $modelActividad->id;
                                                $modelActividadInd[$key]->save();
                                            }
                                            
                                        }
                                    }

                                    if(Yii::$app->request->post('IsIsaTipoCantidadPoblacionIsIsa')){
                                        
                                        $dataPoblacion = Yii::$app->request->post('IsIsaTipoCantidadPoblacionIsIsa');
                                        $countPoblacion = count( $dataPoblacion );
                                        $modelTipoPoblacion = [];

                                        for( $i = 0; $i < $countPoblacion; $i++ ){
                                            $modelTipoPoblacion[] = new IsIsaTipoCantidadPoblacionIsIsa();
                                        }

                                        if (IsIsaTipoCantidadPoblacionIsIsa::loadMultiple($modelTipoPoblacion, Yii::$app->request->post() )) {
                                            if($modelTipoPoblacion[$key]->vecinos){
                                                $modelTipoPoblacion[$key]->id_actividades_is_isa = $modelActividad->id;
                                                $modelTipoPoblacion[$key]->save();
                                            }
                                            
                                        }
                                    }


                                    if(Yii::$app->request->post('IsIsaEvidenciasIsIsa')){
                                        $dataEvidencias = Yii::$app->request->post('IsIsaEvidenciasIsIsa');
                                        $countEvidencias = count( $dataEvidencias );
                                        $modelEvidencias = [];

                                        for( $i = 0; $i < $countEvidencias; $i++ ){
                                            $modelEvidencias[] = new IsIsaEvidenciasIsIsa();
                                        }

                                        if (IsIsaEvidenciasIsIsa::loadMultiple($modelEvidencias, Yii::$app->request->post() )) {

                                            $file_actas = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]acta") ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]acta") : null;
                                            $file_reportes = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]reprote" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]reprote") : null;
                                            $file_listados = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]listados" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]listados") : null;
                                            $file_plan_trabajo = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]plan_trabajo" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]plan_trabajo") : null;
                                            $file_formato_seguimiento = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]formato_seguimiento" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]formato_seguimiento") : null;
                                            $file_formato_evaluacion = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]formato_evaluacion" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]formato_evaluacion") : null;
                                            $file_fotografias = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]fotografias" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]fotografias") : null;
                                            $file_vidoes = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]videos") ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]videos") : null;
                                            $file_otros = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]otros") ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]otros") : null;

                                        
                                            $carpetaEvidencias = "../documentos/documentos_IS_ISA/evidenciasIS_ISA/".$institucion->codigo_dane;
                                            if (!file_exists($carpetaEvidencias)) {
                                                mkdir($carpetaEvidencias, 0777, true);
                                            }

                                            if($file_actas){
                                                $rutaFisicaActas  = $carpetaEvidencias."/";
                                                $rutaFisicaActas .= $file_actas->baseName;
                                                $rutaFisicaActas .= date( "_Y_m_d_His" ) . '.' . $file_actas->extension;
                                                $saveActa = $file_actas->saveAs( $rutaFisicaActas );
                                                $file_actas = $rutaFisicaActas;
                                            }

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
                                            
                                            $modelEvidencias[$key]->id_actividades_is_isa = $modelActividad->id;
                                            $modelEvidencias[$key]->acta = $file_actas;
                                            $modelEvidencias[$key]->reprote = $file_reportes;
                                            $modelEvidencias[$key]->listados = $file_listados;
                                            $modelEvidencias[$key]->plan_trabajo = $file_plan_trabajo;
                                            $modelEvidencias[$key]->formato_seguimiento = $file_formato_seguimiento;
                                            $modelEvidencias[$key]->formato_evaluacion = $file_formato_evaluacion;
                                            $modelEvidencias[$key]->fotografias = $file_fotografias;
                                            $modelEvidencias[$key]->videos = $file_vidoes;
                                            $modelEvidencias[$key]->otros = $file_otros;
                                            $modelEvidencias[$key]->save();

                                        
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

        $Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->andWhere('id='.$id_sede)->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );
        
        return $this->renderAjax('create', [
            'model' => $model,
            'sedes' => $sedes,
            'institucion' => $institucion->descripcion,
        ]);
    }

    /**
     * Updates an existing IsIsaInformeSemanalIsa model.
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

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IsIsaInformeSemanalIsa model.
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
     * Finds the IsIsaInformeSemanalIsa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IsIsaInformeSemanalIsa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IsIsaInformeSemanalIsa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
