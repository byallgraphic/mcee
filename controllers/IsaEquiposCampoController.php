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
use app\models\IsaEquiposCampo;
use app\models\IsaEquiposCampoBuscar;
use app\models\IsaIntegrantesXEquipo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use	yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * IsaEquiposCampoController implements the CRUD actions for IsaEquiposCampo model.
 */
class IsaEquiposCampoController extends Controller
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
     * Lists all IsaEquiposCampo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IsaEquiposCampoBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IsaEquiposCampo model.
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
     * Creates a new IsaEquiposCampo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IsaEquiposCampo();
		$modelIntegrantesEquipo = new IsaIntegrantesXEquipo();
		//solo guarda sin redireccion
		
		$request = Yii::$app->request;
		//se hace de esta forma, la forma natural de yii2 por alguna razon no funciona
		if (@$request->post() != null) 
		{
			//asi funciona //extraer la informacion del post
			foreach($request->post() as $datos)
			{}
			// echo "<pre>"; print_r($datos['nombre']); echo "</pre>"; 
			// echo "<pre>"; print_r($datos['integrantes']); echo "</pre>"; 
			
			// die;
			$model->nombre 		= $datos['nombre'];
			$model->descripcion = $datos['descripcion'];
			$model->cantidad 	= 1;
			$model->save(false);
			
			foreach ($datos['integrantes'] as $integrantes)
			{
				$integranteEquipo = new IsaIntegrantesXEquipo();
				$integranteEquipo->id_equipo_campo 	= $model->id;
				$integranteEquipo->id_perfil_persona_institucion= $integrantes;
				$integranteEquipo->estado = 1;
				$integranteEquipo->save(false);
			}
        }
        return $this->renderAjax('create', [
            'model' => $model,
			'personas'=> $this->obtenerNombresXPerfiles(),
			'modelIntegrantesEquipo'=> $modelIntegrantesEquipo,
        ]);
    }

	/****
		obtener el nombre de la persona de acuerdo el id del perfil y la institucion
	****/
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


    /**
     * Updates an existing IsaEquiposCampo model.
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
	
	
	public function actionEquipos()
	{
		
		$equiposCampo = new IsaEquiposCampo();
		$equiposCampo = $equiposCampo->find()->orderby("id")->andWhere("estado = 1")->all();
		$equiposCampo = ArrayHelper::map($equiposCampo,'id','nombre');
		
		$data[]="<option value=''>Seleccione..</option>";
		foreach ($equiposCampo as $key => $value) 
		{
			$id = $key;
			$nombre = $value;
			$data[]="<option value='$id'>$nombre</option>";
		}
		
		echo Json::encode($data);
	}

    /**
     * Deletes an existing IsaEquiposCampo model.
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
     * Finds the IsaEquiposCampo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return IsaEquiposCampo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IsaEquiposCampo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
