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
use app\models\GeSeguimientoGestion;
use app\models\GeSeguimientoGestionBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Parametro;
use app\models\Instituciones;
use app\models\Personas;
use yii\helpers\ArrayHelper;

/**
 * GeSeguimientoGestionController implements the CRUD actions for GeSeguimientoGestion model.
 */
class GeSeguimientoGestionController extends Controller
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
     * Lists all GeSeguimientoGestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeSeguimientoGestionBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeSeguimientoGestion model.
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
     * Creates a new GeSeguimientoGestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$guardado = false;
		
		$tipo_seguimiento = Yii::$app->request->get( 'idTipoSeguimiento' );
		
        $model = new GeSeguimientoGestion();

        if( $model->load(Yii::$app->request->post()) ){
			
			$model->id_tipo_seguimiento = $tipo_seguimiento;
			$model->estado = 1;
			
			if( $model->save() ){
				$guardado = true;
				// return $this->redirect(['index']);
			}
        }
		
		$dataCargos = Parametro::find()
									->where( 'estado=1' )
									->andWhere( 'id_tipo_parametro=38' )
									->all();
		
		$cargos = ArrayHelper::map( $dataCargos, 'id', 'descripcion' );
		
		$institucion 		= Instituciones::findOne( $id_institucion );
		
		$listBoleano 	= [
							1 => "Sí",
							0 => "No",
						];
						
		$dataConsideraciones = Parametro::find()
									->where( 'estado=1' )
									->andWhere( 'id_tipo_parametro=39' )
									->all();
		
		$consideracones = ArrayHelper::map( $dataConsideraciones, 'id', 'descripcion' );
		
		$dataRespuestas = Parametro::find()
									->where( 'estado=1' )
									->andWhere( 'id_tipo_parametro=1' )
									->all();
		
		$respuestas = ArrayHelper::map( $dataRespuestas, 'id', 'descripcion' );
		
		$dataCalificaciones = Parametro::find()
									->where( 'estado=1' )
									->andWhere( 'id_tipo_parametro=1' )
									->all();
		
		$calificaciones 	= ArrayHelper::map( $dataCalificaciones, 'id', 'descripcion' );
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		
		$personas			= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );

        return $this->render('create', [
            'model' 			=> $model,
            'cargos' 			=> $cargos,
            'institucion' 		=> $institucion,
            'listBoleano' 		=> $listBoleano,
            'consideracones' 	=> $consideracones,
            'respuestas' 		=> $respuestas,
            'calificaciones' 	=> $calificaciones,
            'guardado' 			=> $guardado,
            'personas' 			=> $personas,
        ]);
    }

    /**
     * Updates an existing GeSeguimientoGestion model.
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
     * Deletes an existing GeSeguimientoGestion model.
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
     * Finds the GeSeguimientoGestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GeSeguimientoGestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeSeguimientoGestion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
