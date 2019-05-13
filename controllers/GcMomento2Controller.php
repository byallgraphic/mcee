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

use app\models\GcBitacora;
use app\models\GcMomento1;
use app\models\GcPlaneacionPorDia;
use Yii;
use app\models\GcMomento2;
use app\models\GcMomento2Buscar;
use app\models\GcEvidenciasMomento2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GcMomento2Controller implements the CRUD actions for GcMomento2 model.
 */
class GcMomento2Controller extends Controller
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
     * Lists all GcMomento2 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GcMomento2Buscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GcMomento2 model.
     * @param string $id
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
     * Creates a new GcMomento2 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GcMomento2();
		
		//se crea una instancia del modelo GcEvidenciasMomento2
		$modelEvidenciasMomento2 		 	= new GcEvidenciasMomento2();


        $bitacora = GcBitacora::findOne(Yii::$app->request->get('id_bitacora'));
        $momentoI = GcMomento1::findOne($bitacora->semanas[0]->id);
        $planeacionDias = GcPlaneacionPorDia::find()->where(['id_momento1_planeacion' => $momentoI->id])->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'modelEvidenciasMomento2' => $modelEvidenciasMomento2,
            'planeacionDias' => $planeacionDias,
            'id_semana' => $bitacora->semanas[0]->id
        ]);
    }

    /**
     * Updates an existing GcMomento2 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing GcMomento2 model.
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
     * Finds the GcMomento2 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GcMomento2 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GcMomento2::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddObject(){
        $GCMomento2 = Yii::$app->request->post();
        $model = new GcMomento2();
        $model->id_semana = $GCMomento2['id_semana'];
        $model->realizo_visita = $GCMomento2['descripcion_visita'];
        $model->descripcion_visita = $GCMomento2['descripcion_visita'];
        $model->estudiantes = $GCMomento2['estudiantes'];
        $model->docentes = $GCMomento2['docentes'];
        $model->directivos = $GCMomento2['directivos'];
        $model->otro = $GCMomento2['otro'];
        $model->estado = true;

        $model->save(false);

        $carpeta = "../documentos/momento2/";
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        if (isset($_FILES['files']) && !empty($_FILES['files'])) {
            $no_files = count($_FILES["files"]['name']);
            for ($i = 0; $i < $no_files; $i++) {
                $urlBase  = "../documentos/momento2/";
                $name = $_FILES["files"]['name'][$i];

                move_uploaded_file($_FILES["files"]["tmp_name"][$i], $urlBase.$name);

                $file_ra = new GcEvidenciasMomento2();
                $file_ra->url = $urlBase.$name;
                $file_ra->id_momento2 = $model->id;
                $file_ra->estado = true;
                $file_ra->id_planeacion_por_dia = 1;
                $file_ra->save(false);
            }
        }

        return 'ok';
    }


    public function actionGetEvidencia(){
        $id = Yii::$app->request->get("id");
        $data = GcEvidenciasMomento2::find()->where(["id_momento2" => $id])->asArray()->all();

        return json_encode($data);
    }
}
