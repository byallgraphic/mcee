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
use app\models\CbacEquiposCampo;
use app\models\CbacEquiposCampoBuscar;
use app\models\CbacIntegrantesXEquipo;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use	yii\helpers\Json;
/**
 * CbacEquiposCampoController implements the CRUD actions for CbacEquiposCampo model.
 */
class CbacEquiposCampoController extends Controller
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
     * Lists all CbacEquiposCampo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CbacEquiposCampoBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CbacEquiposCampo model.
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
     * Creates a new CbacEquiposCampo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacEquiposCampo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }


	  /**
     * Creates a new CbacEquiposCampo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCrearEquipo()
    {
        $model = new CbacEquiposCampo();

		// echo "<pre>"; print_r(Yii::$app->request->post()); echo "</pre>"; 
		// die;
	
        if ($model->load( Yii::$app->request->post() )) 
		{
			//no coge el 1 en la base de datos
			$model->estado = 1;
			$model->save();
			
            // return $this->redirect(['index']);
			foreach (Yii::$app->request->post()['CbacEquiposCampo']['integrantes'] as $integrantes)
			{
				$integranteEquipo = new CbacIntegrantesXEquipo();
				$integranteEquipo->id_equipo_campo 	= $model->id;
				$integranteEquipo->id_perfil_persona_institucion= $integrantes;
				$integranteEquipo->save(false);
			}
        }

        return $this->renderAjax('crearEquipo', [
            'model' => $model,
            'integrantes' => $this->obtenerNombresXPerfiles(),
        ]);
    }

	public function obtenerNombresXPerfiles()
	{
		$idInstitucion 	= $_SESSION['instituciones'][0];
		/**
		* Llenar nombre de los cooordinadores-eje
		*/
		//variable con la conexion a la base de datos 
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
			SELECT ppi.id, concat(pe.nombres,' ',pe.apellidos) as nombres
			FROM perfiles_x_personas as pp, 
			personas as pe,
			perfiles_x_personas_institucion ppi
			WHERE pp.id_personas = pe.id
			AND pp.id_perfiles = 11
			AND ppi.id_perfiles_x_persona = pp.id
			AND ppi.id_institucion = $idInstitucion
		");
		$result = $command->queryAll();
		$nombresPerfil = array();
		foreach ($result as $r)
		{
			$nombresPerfil[$r['id']]= $r['nombres'];
		}
		
		return $nombresPerfil;
	}


	public function actionEquipos()
	{
		
		$equiposCampo = new cbacEquiposCampo();
		$equiposCampo = $equiposCampo->find()->orderby("id")->andWhere("estado = 1")->all();
		$equiposCampo = ArrayHelper::map($equiposCampo,'id','nombre');
		
		$data[]="<option value=''>Seleccione..</option>";
		foreach ($equiposCampo as $key => $value) 
		{
			$id = $key;
			$nombre = $value;
			$data[]="<option value='$id'>$nombre</option>";
		}
		
		echo json::encode($data);
	}
	
    /**
     * Updates an existing CbacEquiposCampo model.
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
     * Deletes an existing CbacEquiposCampo model.
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
     * Finds the CbacEquiposCampo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CbacEquiposCampo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacEquiposCampo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
