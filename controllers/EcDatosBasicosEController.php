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
use app\models\EcDatosBasicosE;
use app\models\EcDatosBasicosBuscar;
use app\models\Instituciones;
use app\models\EcPlaneacion;
use app\models\EcReportes;
use app\models\EcVerificacion;
use app\models\Parametro;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * EcDatosBasicosController implements the CRUD actions for EcDatosBasicos model.
 */
class EcDatosBasicosEController extends Controller
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
    public function actionIndex()
    {
        $searchModel = new EcDatosBasicosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EcDatosBasicos model.
     * @param string $id
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
     * Creates a new EcDatosBasicos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelDatosBasico 	= new EcDatosBasicosE();
        $modelPlaneacion	= new EcPlaneacion();
        $modelVerificacion	= new EcVerificacion();
        $modelReportes		= new EcReportes();
        

        if ($modelDatosBasico->load(Yii::$app->request->post())) {
            $modelDatosBasico->id_institucion = $_SESSION['instituciones'][0];
            $modelDatosBasico->id_sede = 2;
            $modelDatosBasico->estado = 1;

            if($modelDatosBasico->save()){
            
                if ($modelPlaneacion->load(Yii::$app->request->post())){
                    
                    $modelPlaneacion->id_datos_basicos = $modelDatosBasico->id;
                    $modelPlaneacion->estado = 1;
                    
                    if($modelPlaneacion->save()){

                        if ($modelVerificacion->load(Yii::$app->request->post())){

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
                        }

                       if ($modelReportes->load(Yii::$app->request->post())){
                            $modelReportes->id_planeacion = $modelPlaneacion->id;
                            $modelReportes->estado = 1;
                            $modelReportes->save();
                        }                        
                    }
                }
            }
            
            return $this->redirect(['view', 'id' => $modelDatosBasico->id, 'guardado' => 1]);
        }


		
		$dataTiposVerificacion = Parametro::find()
									->where( 'id_tipo_parametro=12' )
									->andWhere( 'estado=1' )
									->all();
									
		$tiposVerificacion = ArrayHelper::map( $dataTiposVerificacion, 'id', 'descripcion' );

        return $this->render('create', [
            'modelDatosBasico' 	=> $modelDatosBasico,
            'modelPlaneacion' 	=> $modelPlaneacion,
            'modelVerificacion' => $modelVerificacion,
            'modelReportes' 	=> $modelReportes,
            'tiposVerificacion'	=> $tiposVerificacion,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
