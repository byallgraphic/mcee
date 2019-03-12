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
use app\models\EcLevantamientoOrientacion;
use app\models\EcLevantamientoOrientacionBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\Estados;
use app\models\Parametro;
use	yii\helpers\ArrayHelper;

/**
 * EcLevantamientoOrientacionController implements the CRUD actions for EcLevantamientoOrientacion model.
 */
class EcLevantamientoOrientacionController extends Controller
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
	public function obtenerParametros($idTipoInforme)
	{
		
		if($idTipoInforme == 33)
			$id = 87;
		
		if($idTipoInforme == 21)
			$id = 88;
		
		if($idTipoInforme == 9)
			$id = 86;
		
		$dataParametros = Parametro::find()
						->where( 'id_tipo_parametro=23' )
						->andWhere( "estado=1 and id = $id" )
						->orderby( 'id' )
						->all();
						
		$parametros		= ArrayHelper::map( $dataParametros, 'id', 'descripcion' );
			
		
		return $parametros;
	}
	
	
	public function obtenerSedes()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$sedes = new Sedes();
		$sedes = $sedes->find()->where("id_instituciones=$idInstitucion")->all();
		$sedes = ArrayHelper::map($sedes,'id','descripcion');
		
		return $sedes;
	}
	
	public function obtenerInstituciones()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$instituciones = new Instituciones();
		$instituciones = $instituciones->find()->where("id = $idInstitucion")->all();
		$instituciones = ArrayHelper::map($instituciones,'id','descripcion');
		
		return $instituciones;
	}
	public function obtenerEstados()
	{
		$estados = new Estados();
		$estados = $estados->find()->orderby("id")->all();
		$estados = ArrayHelper::map($estados,'id','descripcion');
		
		return $estados;
	}

    /**
     * Lists all EcLevantamientoOrientacion models.
     * @return mixed
     */
    public function actionIndex($idTipoInforme)
    {
        $searchModel = new EcLevantamientoOrientacionBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( "estado=1" ); 
		$dataProvider->query->andWhere( "id_tipo_informe=$idTipoInforme" ); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EcLevantamientoOrientacion model.
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
     * Creates a new EcLevantamientoOrientacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idTipoInforme)
    {
        $model = new EcLevantamientoOrientacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'guardado' => 1,'idTipoInforme' => $idTipoInforme]);
        }


        return $this->renderAjax('create', [
            'model' => $model,
			'sedes' => $this->obtenerSedes(),
			'instituciones' =>$this->obtenerInstituciones(),
			'estados' =>$this->obtenerEstados(),
			'parametros' =>$this->obtenerParametros($idTipoInforme),
			'idTipoInforme' => $idTipoInforme,
        ]);
    }

    /**
     * Updates an existing EcLevantamientoOrientacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$idTipoInforme = $model->id_tipo_informe;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','guardado' => 1,'idTipoInforme' => $model->id_tipo_informe]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
			'sedes' => $this->obtenerSedes(),
			'instituciones' =>$this->obtenerInstituciones(),
			'estados' =>$this->obtenerEstados(),
			'parametros' =>$this->obtenerParametros(),
			'idTipoInforme' => $idTipoInforme,
        ]);
    }

    /**
     * Deletes an existing EcLevantamientoOrientacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$model->estado = 2;
		$model->update(false);

        return $this->redirect(['index','idTipoInforme' => $model->id_tipo_informe]);
    }

    /**
     * Finds the EcLevantamientoOrientacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EcLevantamientoOrientacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EcLevantamientoOrientacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
