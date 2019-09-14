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
use app\models\Permisos;
use app\models\PermisosBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Modulos;
use app\models\Perfiles;
use yii\helpers\ArrayHelper;

/**
 * PermisosController implements the CRUD actions for Permisos model.
 */
class PermisosController extends Controller
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
     * Lists all Permisos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermisosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( "estado=1" )->orderby("id"); 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Permisos model.
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
     * Creates a new Permisos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Permisos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','guardado'=>true]);
        }
		$modulo = Modulos::find()->orderby( 'id' )->all();				
		$modulo	= ArrayHelper::map( $modulo, 'id', 'descripcion' );
		
		$perfil = Perfiles::find()->orderby( 'id' )->all();				
		$perfil = ArrayHelper::map( $perfil, 'id', 'descripcion' );
		
        return $this->renderAjax('create', [
            'model' => $model,
			'modulo' => $modulo,
			'perfil' => $perfil,
			
        ]);
    }

    /**
     * Updates an existing Permisos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','guardado'=>true]);
        }
		
		$modulo = Modulos::find()->orderby( 'id' )->all();				
		$modulo	= ArrayHelper::map( $modulo, 'id', 'descripcion' );
		
		$perfil = Perfiles::find()->orderby( 'id' )->all();				
		$perfil = ArrayHelper::map( $perfil, 'id', 'descripcion' );
        return $this->renderAjax('update', [
            'model' => $model,
			'modulo' => $modulo,
			'perfil' => $perfil,
        ]);
    }

    /**
     * Deletes an existing Permisos model.
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

        return $this->redirect(['index']);
    }

    /**
     * Finds the Permisos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Permisos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permisos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
