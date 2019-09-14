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
use app\models\IsaIniciacionSensibilizacionArtisticaConsolidado;
use app\models\IsaIniciacionSensibilizacionArtisticaConsolidadoBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Instituciones;
use app\models\Sedes;
use app\models\IsaActividadesArtisticas;
use app\models\IsaEncabezadoIniciacionArtisticaConsolidado;
use app\models\IsaEncabezadoIniciacionArtisticaConsolidadoBuscar;
use yii\helpers\ArrayHelper;

/**
 * IsaIniciacionSensibilizacionArtisticaConsolidadoController implements the CRUD actions for IsaIniciacionSensibilizacionArtisticaConsolidado model.
 */
class IsaIniciacionSensibilizacionArtisticaConsolidadoController extends Controller
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
     * Lists all IsaIniciacionSensibilizacionArtisticaConsolidado models.
     * @return mixed
     */
    public function actionIndex( $guardado = null )
    {
        $searchModel = new IsaEncabezadoIniciacionArtisticaConsolidadoBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' 	=> $searchModel,
            'dataProvider' 	=> $dataProvider,
            'guardado' 		=> $guardado,
        ]);
    }

    /**
     * Displays a single IsaIniciacionSensibilizacionArtisticaConsolidado model.
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
     * Creates a new IsaIniciacionSensibilizacionArtisticaConsolidado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$guardado = false;

		$institucion	= Instituciones::findOne( $id_institucion );
		$sede			= Sedes::findOne( $id_sede );

		$models = [];

		$modelEncabezado = new IsaEncabezadoIniciacionArtisticaConsolidado();

		if( Yii::$app->request->post() )
		{
			if( !empty( Yii::$app->request->post('IsaEncabezadoIniciacionArtisticaConsolidado')['id'] ) ){
				$modelEncabezado = IsaEncabezadoIniciacionArtisticaConsolidado::findOne( Yii::$app->request->post('IsaEncabezadoIniciacionArtisticaConsolidado')['id'] );
			}
			
			if( $modelEncabezado->load(Yii::$app->request->post()) )
			{
				$modelEncabezado->estado = 1;

				$modelsArtisticos = Yii::$app->request->post('IsaIniciacionSensibilizacionArtisticaConsolidado');

				if( count( $modelsArtisticos ) > 0 )
				{
					foreach( $modelsArtisticos as $id_actividad => $model )
					{
						if( !empty( $model['id'] ) )
						{
							$models[ $id_actividad ] = IsaIniciacionSensibilizacionArtisticaConsolidado::findOne( $model['id'] );
						}
						else
						{
							$models[ $id_actividad ] = new IsaIniciacionSensibilizacionArtisticaConsolidado();
						}
						
						$models[ $id_actividad ]->load( $model, '' );
					}
				}

				$valido = true;

				$valido = $modelEncabezado->validate([
								'id_institucion',
								'id_sede',
								'fecha',
								'periodo',
							]) && $valido;

				if( count( $models ) > 0 )
				{
					foreach( $models as $key => $model )
					{
						$valido = $model->validate([
										'total_sesiones_realizadas',
										'avance_por_mes',
										'total_sesiones_aplazadas',
										'total_sesiones_canceladas',
										'vecinos',
										'lideres_comunitarios',
										'empresarios_comerciantes_microempresas',
										'representantes_organizaciones_locales',
										'asociaciones_grupos_comunitarios',
										'otros_actores',
										'actas',
										'reportes',
										'listados',
										'plan_trabajo',
										'formato_seguimiento',
										'formato_evaluacion',
										'fotografias',
										'videos',
										'otros_productos',
									]) && $valido;
					}
				}

				if( $valido )
				{
					$modelEncabezado->estado = 1;
					$modelEncabezado->save(false);

					$modelEncabezado->id;

					foreach( $models as $id_actividad => $model )
					{
						$model->estado = 1;
						$model->id_actividad = $id_actividad;
						$model->id_encabezado_iniciacion_artistica_consolidado = $modelEncabezado->id;
						$model->save(false);
					}
					
					$guardado = true;
					
					return $this->redirect( ['index', 'guardado' => true ] );
				}
			}
		}

        // $model 			 = new IsaIniciacionSensibilizacionArtisticaConsolidado();

		// $model->estado 			 = 1;

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['index']);
        // }

		$actividades = IsaActividadesArtisticas::find()
								->where( 'estado=1' )
								->orderBy(['orden'=>SORT_ASC])
								->all();

		if( count($actividades) > 0 )
		{
			foreach( $actividades as $actividad )
			{
				if( empty( $models[ $actividad->id ] ) )
				{
					$models[ $actividad->id ] = new IsaIniciacionSensibilizacionArtisticaConsolidado();
				}
			}
		}

        return $this->renderAjax('create', [
            'models' 			=> $models,
            'institucion' 		=> $institucion,
            'sede' 				=> $sede,
            'actividades' 		=> $actividades,
            'modelEncabezado' 	=> $modelEncabezado,
            'guardado' 			=> $guardado,
        ]);
    }

    /**
     * Updates an existing IsaIniciacionSensibilizacionArtisticaConsolidado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$guardado = false;

		$institucion	= Instituciones::findOne( $id_institucion );
		$sede			= Sedes::findOne( $id_sede );
		
        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['index']);
        // }
		
		$modelEncabezado = IsaEncabezadoIniciacionArtisticaConsolidado::findOne($id);
		
		$modelsActividades = IsaIniciacionSensibilizacionArtisticaConsolidado::find()
									->where( 'id_encabezado_iniciacion_artistica_consolidado='.$modelEncabezado->id )
									->andWhere('estado=1')
									->all();
		
		foreach( $modelsActividades as $actividad )
		{
			$models[ $actividad->id_actividad ] = $actividad;
		}
		

		$actividades = IsaActividadesArtisticas::find()
								->where( 'estado=1' )
								->orderBy(['orden'=>SORT_ASC])
								->all();

		// if( count($actividades) > 0 )
		// {
			// foreach( $actividades as $actividad )
			// {
				// if( empty( $models[ $actividad->id ] ) )
				// {
					// $models[ $actividad->id ] = new IsaIniciacionSensibilizacionArtisticaConsolidado();
				// }
			// }
		// }
		
        return $this->renderAjax('create', [
            'models' 			=> $models,
            'institucion' 		=> $institucion,
            'sede' 				=> $sede,
            'actividades' 		=> $actividades,
            'modelEncabezado' 	=> $modelEncabezado,
            'guardado' 			=> $guardado,
        ]);
    }

    /**
     * Deletes an existing IsaIniciacionSensibilizacionArtisticaConsolidado model.
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
     * Finds the IsaIniciacionSensibilizacionArtisticaConsolidado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return IsaIniciacionSensibilizacionArtisticaConsolidado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IsaIniciacionSensibilizacionArtisticaConsolidado::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
