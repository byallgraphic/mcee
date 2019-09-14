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
use app\models\CbacInformeSemanalCac;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\CbacActividadesIsCac;
use app\models\CbacActividadIsCac;
use app\models\CbacTipoCantidadPoblacionIsCac;
use app\models\CbacEvidenciasCac;

use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CbacInformeSemanalCacController implements the CRUD actions for CbacInformeSemanalCac model.
 */
class CbacInformeSemanalCacController extends Controller
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
     * Lists all CbacInformeSemanalCac models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CbacInformeSemanalCac::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CbacInformeSemanalCac model.
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
        
        $actividades_is_isa = new CbacActividadesIsCac();
        $actividade_is_isa = new CbacActividadIsCac();
        $tipo_poblacion_is_isa = new CbacTipoCantidadPoblacionIsCac();
        $evidencias_is_isa = new CbacEvidenciasCac();


        $proyectos = [ 
            1 => "Desarrollar herramientas en docentes y directivos docentes de las IEO que implementen componentes artísticos y culturales.",
            2 => "Fortalecer la oferta de programas culturales para estudiantes en el proceso formativo de competencias básicas dentro y fuera del aula.",
            3 => "Promover el acompañamiento de padres de familia desde el arte y la cultura en el proceso de fortalecimiento de competencias básicas de estudiantes de las IEO.",
        ];
		
		return $this->renderAjax('fases', [
            'fases' => $proyectos,
            'form' => $form,
            "model" => $model,
            'actividades_is_isa' => $actividades_is_isa,
            'actividade_is_isa' => $actividade_is_isa,
            'tipo_poblacion_is_isa' => $tipo_poblacion_is_isa,
            'evidencias_is_isa' => $evidencias_is_isa,
            'datos' => $datos
        ]);
		
	}

    /**
     * Creates a new CbacInformeSemanalCac model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacInformeSemanalCac();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->id_institucion = $_SESSION['instituciones'][0];
            if($model->save()){
                $is_isa_id = $model->id;
                //$is_isa_id = 1;


                if (Yii::$app->request->post('CbacActividadesIsCac')){
                    $data = Yii::$app->request->post('CbacActividadesIsCac');
                    $count 	= count($data);
                    $modelActividades = [];

                    for( $i = 0; $i < $count; $i++ ){
                        $modelActividades[] = new CbacActividadesIsCac();
                    }

                    if (CbacActividadesIsCac::loadMultiple($modelActividades, Yii::$app->request->post() )) {
                        foreach($modelActividades as $key => $modelActividad) {
                            if($modelActividad->duracion and $modelActividad->docente){
                                $modelActividad->id_informe_semanal_isa = $is_isa_id;

                                if($modelActividad->save()){
                                    if(Yii::$app->request->post('CbacActividadIsCac')){
                                        $dataActividad = Yii::$app->request->post('CbacActividadIsCac');
                                        $countActividad = count( $dataActividad );
                                        $modelActividadInd = [];
                                        
                                        for( $i = 0; $i < $countActividad; $i++ ){
                                            $modelActividadInd[] = new CbacActividadIsCac();
                                        }
    
                                        if (CbacActividadIsCac::loadMultiple($modelActividadInd, Yii::$app->request->post() )) {
                                            if($modelActividadInd[$key]->sesiones_realizadas){
                                                $modelActividadInd[$key]->id_actividades_is_cac = $modelActividad->id;
                                                $modelActividadInd[$key]->save();
                                            }
                                            
                                        }
                                    }

                                    if(Yii::$app->request->post('CbacTipoCantidadPoblacionIsCac')){
                                        $dataPoblacion = Yii::$app->request->post('CbacTipoCantidadPoblacionIsCac');
                                        $countPoblacion = count( $dataPoblacion );
                                        $modelTipoPoblacion = [];

                                        for( $i = 0; $i < $countPoblacion; $i++ ){
                                            $modelTipoPoblacion[] = new CbacTipoCantidadPoblacionIsCac();
                                        }

                                        if (CbacTipoCantidadPoblacionIsCac::loadMultiple($modelTipoPoblacion, Yii::$app->request->post() )) {
                                            if($modelTipoPoblacion[$key]->ciencias_naturales){
                                                $modelTipoPoblacion[$key]->id_actividades_is_cac = $modelActividad->id;
                                                $modelTipoPoblacion[$key]->save();
                                            }
                                            
                                        }
                                    }

                                    if(Yii::$app->request->post('CbacEvidenciasCac')){
                                        $dataEvidencias = Yii::$app->request->post('CbacEvidenciasCac');
                                        $countEvidencias = count( $dataEvidencias );
                                        $modelEvidencias = [];

                                        for( $i = 0; $i < $countEvidencias; $i++ ){
                                            $modelEvidencias[] = new CbacEvidenciasCac();
                                        }

                                        if (CbacEvidenciasCac::loadMultiple($modelEvidencias, Yii::$app->request->post() )) {
                                            
                                            $file_actas = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]actas") ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]actas") : null;
                                            $file_reportes = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]reprotes" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]reprotes") : null;
                                            $file_listados = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]listados" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]listados") : null;
                                            $file_plan_trabajo = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]plan_trabajo" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]plan_trabajo") : null;
                                            $file_formato_seguimiento = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]formato_seguimiento" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]formato_seguimiento") : null;
                                            $file_formato_evaluacion = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]formato_evaluacion" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]formato_evaluacion") : null;
                                            $file_fotografias = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]fotografias" ) ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]fotografias") : null;
                                            $file_vidoes = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]vidoes") ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]vidoes") : null;
                                            $file_otros = UploadedFile::getInstance( $modelEvidencias[$key], "[$key]otros_productos") ? UploadedFile::getInstance( $modelEvidencias[$key], "[$key]otros_productos") : null;

                                        
                                            $carpetaEvidencias = "../documentos/documentos_IS_CAC/evidenciasIS_CAC/".$institucion->codigo_dane;
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


                                            $modelEvidencias[$key]->id_actividades_is_cac = $modelActividad->id;
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
            return $this->redirect(['index', 'guardado' => 1]);
        }

        $Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );

        return $this->renderAjax('create', [
            'model' => $model,
            'sedes' => $sedes,
            'institucion' => $institucion->descripcion,
        ]);
    }

    /**
     * Updates an existing CbacInformeSemanalCac model.
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


        $command = Yii::$app->db->createCommand("SELECT acts.id_actividad, acts.duracion, acts.docente, acts.equipos, acts.logros, acts.variaciones_devilidades, acts.variaciones_fortalezas, acts.retos, acts.articulacion, acts.alrmas,
                                                        act.sesiones_realizadas, act.porcentaje, act.sesiones_aplazadas, act.sesiones_canceladas,
                                                        tip.ciencias_naturales, tip.ciencias_sociales, tip.educacion_artistica, tip.educacion_etica, tip.educacion_fisica, tip.educacion_religiosa, tip.estadistica, tip.humanidades, tip.idiomas_extranjeros, tip.lengua_castellana, tip.matematicas, tip.tecnologia, tip.otras, tip.docentes_partipantes_sede, tip.rectora, tip.coordinadores, tip.directivos_partipantes_sede
                                                FROM cbac.actividades_is_cac AS acts
                                                INNER JOIN cbac.actividad_is_cac AS act on act.id_actividades_is_cac = acts.id
                                                INNER JOIN cbac.tipo_cantidad_poblacion_is_cac AS tip on tip.id_actividades_is_cac = acts.id
                                                WHERE acts.id_informe_semanal_isa = $id");

        $result= $command->queryAll();                                       
                
        $result = ArrayHelper::getColumn($result, function ($element) 
        {
            $dato[$element['id_actividad']]['duracion']= $element['duracion'];
            $dato[$element['id_actividad']]['docente']= $element['docente'];
            $dato[$element['id_actividad']]['equipos']= $element['equipos'];
            $dato[$element['id_actividad']]['logros']= $element['logros'];
            $dato[$element['id_actividad']]['variaciones_devilidades']= $element['variaciones_devilidades'];
            $dato[$element['id_actividad']]['variaciones_fortalezas']= $element['variaciones_fortalezas'];
            $dato[$element['id_actividad']]['retos']= $element['retos'];
            $dato[$element['id_actividad']]['articulacion']= $element['articulacion'];
            $dato[$element['id_actividad']]['alrmas']= $element['alrmas'];
            $dato[$element['id_actividad']]['sesiones_realizadas']= $element['sesiones_realizadas'];
            $dato[$element['id_actividad']]['porcentaje']= $element['porcentaje'];
            $dato[$element['id_actividad']]['sesiones_aplazadas']= $element['sesiones_aplazadas'];
            $dato[$element['id_actividad']]['sesiones_canceladas']= $element['sesiones_canceladas'];

            $dato[$element['id_actividad']]['ciencias_naturales']= $element['ciencias_naturales'];
            $dato[$element['id_actividad']]['ciencias_sociales']= $element['ciencias_sociales'];
            $dato[$element['id_actividad']]['educacion_artistica']= $element['educacion_artistica'];
            $dato[$element['id_actividad']]['educacion_etica']= $element['educacion_etica'];
            $dato[$element['id_actividad']]['educacion_fisica']= $element['educacion_fisica'];
            $dato[$element['id_actividad']]['educacion_religiosa']= $element['educacion_religiosa'];
            $dato[$element['id_actividad']]['estadistica']= $element['estadistica'];
            $dato[$element['id_actividad']]['humanidades']= $element['humanidades'];
            $dato[$element['id_actividad']]['idiomas_extranjeros']= $element['idiomas_extranjeros'];
            $dato[$element['id_actividad']]['lengua_castellana']= $element['lengua_castellana'];
            $dato[$element['id_actividad']]['matematicas']= $element['matematicas'];
            $dato[$element['id_actividad']]['tecnologia']= $element['tecnologia'];
            $dato[$element['id_actividad']]['otras']= $element['otras'];
            $dato[$element['id_actividad']]['docentes_partipantes_sede']= $element['docentes_partipantes_sede'];
            $dato[$element['id_actividad']]['rectora']= $element['rectora'];
            $dato[$element['id_actividad']]['coordinadores']= $element['coordinadores'];
            $dato[$element['id_actividad']]['directivos_partipantes_sede']= $element['directivos_partipantes_sede'];


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
     * Deletes an existing CbacInformeSemanalCac model.
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
     * Finds the CbacInformeSemanalCac model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacInformeSemanalCac the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacInformeSemanalCac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
