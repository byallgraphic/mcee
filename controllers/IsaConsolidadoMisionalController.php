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
use app\models\IsaConsolidadoMisional;
use app\models\IsaConsolidadoMisionalBuscar;
use app\models\Sedes;
use app\models\Instituciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\IsaRomProyectos;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use app\models\IsaPersonasComunidad;
use app\models\IsaEstadoActualMisional;
use yii\base\Model;

/**
 * IsaConsolidadoMisionalController implements the CRUD actions for IsaConsolidadoMisional model.
 */
class IsaConsolidadoMisionalController extends Controller
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

	public function actionFormulario($model,$form,$datos = 0)
	{
		
		$proyectos = IsaRomProyectos::find()->where( 'estado=1' )->orderby('id ASC')->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
	

		foreach ($proyectos as $idProyecto => $label)
		{
			
			 $contenedores[] = 	
				[
					'label' 		=>  $label,
					'content' 		=>  $this->renderPartial( 'procesos', 
													[  
                                                        'idProyecto' => $idProyecto,
														'form' => $form,
														'datos' => $datos,
													] 
										),
					'contentOptions'=>  ['class' => 'in'],
				];
	
		}
		
		 echo Collapse::widget([
			'items' => $contenedores,
		]);
		
	}

    /**
     * Lists all IsaConsolidadoMisional models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IsaConsolidadoMisionalBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IsaConsolidadoMisional model.
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
     * Creates a new IsaConsolidadoMisional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IsaConsolidadoMisional();

        if ($model->load(Yii::$app->request->post()) ) 
		{
			$model->estado = 1;
			$model->save();
			$personasModel = [];
			foreach (Yii::$app->request->post()['IsaPersonasComunidad'] as $key => $personas)
			{
				$personasModel[$key] = new IsaPersonasComunidad();
				
				if (IsaPersonasComunidad::loadMultiple($personasModel, Yii::$app->request->post())) 
				{
					foreach ($personasModel as $key => $per) 
					{
						$per->id_consolidado_misional = $model->id;
						$per->id_actividades_consolidado = $key;
						$per->save(false);
						
					}
				}
			}

		
			$estadoActualModel = [];
			foreach (Yii::$app->request->post()['IsaEstadoActualMisional'] as $key => $estado)
			{
				$estadoActualModel[$key] = new IsaEstadoActualMisional();
				
				if (IsaEstadoActualMisional::loadMultiple($estadoActualModel, Yii::$app->request->post())) 
				{
					foreach ($estadoActualModel as $key => $est) 
					{
						$est->id_consolidado_misional = $model->id;
						$est->id_actividades_consolidado = $key;
						$est->save(false);
						
					}
				}
			}
			
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'institucion'=> $this->obtenerInstitucion(),
        ]);
    }

    /**
     * Updates an existing IsaConsolidadoMisional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			
			$personas = IsaPersonasComunidad::find()->indexBy('id')->andWhere("id_consolidado_misional = $id")->all();
			 
			$per = [];
			foreach($personas as  $persona)
			{
				$per[ $persona->id_actividades_consolidado ] = $persona;
				
			}

			if (Model::loadMultiple($per, Yii::$app->request->post()) && Model::validateMultiple($per) ) 
			{
				foreach ($per as $perso) 
				{
					$perso->save(false);
				}
			}

	
			
			
			$estadoActual = IsaEstadoActualMisional::find()->indexBy('id')->andWhere("id_consolidado_misional = $id")->all();
			 
			 echo "<pre>"; print_r( Yii::$app->request->post()['IsaEstadoActualMisional']); echo "</pre>"; 
			

			$estadoActualModel = [];
			foreach($estadoActual as $estado)
			{
				$estadoActualModel[ $estado->id_actividades_consolidado ] = $estado;
				
			}
			
			if (Model::loadMultiple($estadoActualModel, Yii::$app->request->post())  ) 
			{
				echo "entro";
				foreach ($estadoActualModel as $est) 
				{
					$est->save(false);
				}
			}
		

            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'institucion'=> $this->obtenerInstitucion(),
        ]);
    }
	
	
	
	public function obtenerSede()
	{
		$idSedes 		= $_SESSION['sede'][0];
		$sedes = new Sedes();
		$sedes = $sedes->find()->where("id =  $idSedes")->all();
		$sedes = ArrayHelper::map($sedes,'id','descripcion');
		
		return $sedes;
	}
	
	
	public function obtenerInstitucion()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$instituciones = new Instituciones();
		$instituciones = $instituciones->find()->where("id = $idInstitucion")->all();
		$instituciones = ArrayHelper::map($instituciones,'id','descripcion');
		
		return $instituciones;
	}

    /**
     * Deletes an existing IsaConsolidadoMisional model.
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
     * Finds the IsaConsolidadoMisional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return IsaConsolidadoMisional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IsaConsolidadoMisional::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
