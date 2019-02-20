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
use app\models\GcMomento1;
use app\models\GcMomento1Buscar;
use app\models\GcPropositos;
use app\models\GcPlaneacionPorDia;
use app\models\GcDiasPlaneacion;
use app\models\GcResultadosMomento1;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * GcMomento1Controller implements the CRUD actions for GcMomento1 model.
 */
class GcMomento1Controller extends Controller
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
     * Lists all GcMomento1 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GcMomento1Buscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GcMomento1 model.
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
     * Creates a new GcMomento1 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GcMomento1();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
		
		 //se crea una instancia del modelo propositos
		$propositosTable 		 	= new GcPropositos();
		//se traen los datos de propositos
		$dataPropositos		 	= $propositosTable->find()->all();
		//se guardan los datos en un array
		$propositos	 	 	 	= ArrayHelper::map( $dataPropositos, 'id', 'descripcion' );
		
		
		//se crea una instancia del modelo planeacion por dia
		$modelPlaneacionxdia 		 	= new GcPlaneacionPorDia();
		//se traen los datos de planeacion por dia
		// $dataGcPlaneacionPorDia		 	= $GcPlaneacionPorDiaTable->find()->all();
		//se guardan los datos en un array
		// $planeacionPorDia	 	 	 	= ArrayHelper::map( $dataGcPlaneacionPorDia, 'id', 'descripcion_plan' );
		
		//se crea una instancia del modelo dias planeacion
		$diasPlaneacionTable 		 	= new GcDiasPlaneacion();
		//se traen los datos de dias planeacion
		$datadiasPlaneacion		 	= $diasPlaneacionTable->find()->all();
		//se guardan los datos en un array
		$diasPlaneacion	 	 	 	= ArrayHelper::map( $datadiasPlaneacion, 'id', 'descripcion' );
		
		//se crea una instancia del modelo resultados momento 1
		$modelResultadosMomento1 		 	= new GcResultadosMomento1();
		// //se traen los datos de resultados momento 1
		// $dataresultadosMomento1		 	= $resultadosMomento1Table->find()->all();
		// //se guardan los datos en un array
		// $resultadosMomento1	 	 	 	= ArrayHelper::map( $dataresultadosMomento1, 'id', 'descripcion' );


        return $this->render('create', [
            'model' => $model,
            'propositos' => $propositos,
            'modelPlaneacionxdia' => $modelPlaneacionxdia,
            'diasPlaneacion' => $diasPlaneacion,
            'modelResultadosMomento1' => $modelResultadosMomento1,
        ]);
    }

    /**
     * Updates an existing GcMomento1 model.
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
     * Deletes an existing GcMomento1 model.
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
     * Finds the GcMomento1 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GcMomento1 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GcMomento1::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}