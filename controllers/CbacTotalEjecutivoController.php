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
use app\models\CbacTotalEjecutivo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;


/**
 * CbacTotalEjecutivoController implements the CRUD actions for CbacTotalEjecutivo model.
 */
class CbacTotalEjecutivoController extends Controller
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
     * Lists all CbacTotalEjecutivo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CbacTotalEjecutivo::find(),
        ]);

        return $this->redirect(['create', 'guardado' => $guardado ]);

        /*return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);*/
    }

    /**
     * Displays a single CbacTotalEjecutivo model.
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
     * Creates a new CbacTotalEjecutivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacTotalEjecutivo();
        

        if ($model->load(Yii::$app->request->post())) {

            if( Yii::$app->request->post('CbacTotalEjecutivo') )
                $data = Yii::$app->request->post('CbacTotalEjecutivo');

            $count 	= count( $data );
            $models = [];
            for( $i = 0; $i < $count; $i++ )
            {
                $models[] = new CbacTotalEjecutivo();
            }

            if (CbacTotalEjecutivo::loadMultiple($models, Yii::$app->request->post() )) {

                CbacTotalEjecutivo::deleteAll('id_institucion = '.$_SESSION['instituciones'][0].' and id_sede = '.$_SESSION['sede'][0]);

                $count = 1;
                $_porcentaje_1 = $models[0]->avance_objetivos_sede;
                $_porcentaje_2 = $models[1]->avance_objetivos_sede;
                $_porcentaje_3 = $models[2]->avance_objetivos_sede;

                foreach( $models as $key => $model) {
                    
                    $model->objetivos_generale = "293 Implementar estrategias artisticas y culturales que fortalezcan las competencias básicas de los estudiantes de grados sexto a once de las Instituciones Educativas Oficiales";
                    $model->id_institucion = $_SESSION['instituciones'][0];
                    $model->id_sede = $_SESSION['sede'][0];

                    if($key <= 1){
                        $model->objetivos_especificos = "293-1. Desarrollar herramientas en docentes y directivos docentes de las IEO que implementen componentes artísticos y culturales.";
                        $model->id_actividad = (string)$count;
                        $model->avance_objetivos_sede = $_porcentaje_1;
                        $model->save();
                    }

                    if($key >= 2 && $key <= 7){
                        $model->objetivos_especificos = "293-2. Fortalecer la oferta de programas culturales para estudiantes en el proceso formativo de competencias básicas dentro y fuera del aula.";
                        $model->id_actividad = (string)$count;
                        $model->avance_objetivos_sede = $_porcentaje_2;
                        $model->save();
                    }

                    if($key > 7){
                        $model->objetivos_especificos = "293-3. Promover el acompañamiento de padres de familia desde el arte y la cultura en el proceso de fortalecimiento de competencias básicas de estudiantes de las IEO.";
                        $model->id_actividad = (string)$count;
                        $model->avance_objetivos_sede = $_porcentaje_3;
                        $model->save();
                    }
                    $count ++;
                }
                
                //die();
            }

            return $this->redirect(['index', 'guardado' => 1 ]);
        }


        $data = CbacTotalEjecutivo::find()
            ->where('id_institucion = '.$_SESSION['instituciones'][0].' and id_sede = '.$_SESSION['sede'][0])
            ->orderby( 'id' )
            ->all();
        
        $avance_ieo = ArrayHelper::map( $data, 'id_actividad', 'avance_ieo' );
        $avance_actividad_sede = ArrayHelper::map( $data, 'id_actividad', 'avance_actividad_sede' );
        $avance_actividad_ieo = ArrayHelper::map( $data, 'id_actividad', 'avance_actividad_ieo' );
        $beneficiarios = ArrayHelper::map( $data, 'id_actividad', 'beneficiarios' );
        $sesiones_realizadas_ieo = ArrayHelper::map( $data, 'id_actividad', 'sesiones_realizadas_ieo' );
        $sesiones_aplazadas_ieo = ArrayHelper::map( $data, 'id_actividad', 'sesiones_aplazadas_ieo' );
        $sesiones_canceladas_ieo = ArrayHelper::map( $data, 'id_actividad', 'sesiones_canceladas_ieo' );
        $avance_objetivos_sede = ArrayHelper::map( $data, 'id_actividad', 'avance_objetivos_sede' );
        

        return $this->render('create', [
            'model' => $model,
            'avance_ieo' => $avance_ieo,
            'avance_actividad_sede' => $avance_actividad_sede,
            'avance_actividad_ieo' => $avance_actividad_ieo,
            'beneficiarios' => $beneficiarios,
            'sesiones_realizadas_ieo' => $sesiones_realizadas_ieo,
            'sesiones_aplazadas_ieo' => $sesiones_aplazadas_ieo,
            'sesiones_canceladas_ieo' => $sesiones_canceladas_ieo,
            'avance_objetivos_sede' => $avance_objetivos_sede,
        ]);
    }

    /**
     * Updates an existing CbacTotalEjecutivo model.
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
     * Deletes an existing CbacTotalEjecutivo model.
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
     * Finds the CbacTotalEjecutivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacTotalEjecutivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacTotalEjecutivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
