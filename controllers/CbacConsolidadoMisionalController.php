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
use app\models\CbacConsolidadoMisional;
use app\models\CbacConsolidadoMisionalBuscar;
use app\models\Sedes;
use app\models\Instituciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CbacRomProyectos;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use app\models\CbacPersonasComunidad;
use app\models\CbacEstadoActualMisional;
use yii\base\Model;

/**
 * CbacConsolidadoMisionalController implements the CRUD actions for CbacConsolidadoMisional model.
 */
class CbacConsolidadoMisionalController extends Controller
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
		
		$proyectos = CbacRomProyectos::find()->where( 'estado=1' )->orderby('id ASC')->all();
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
     * Lists all CbacConsolidadoMisional models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CbacConsolidadoMisionalBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CbacConsolidadoMisional model.
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
     * Creates a new CbacConsolidadoMisional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacConsolidadoMisional();

        if ($model->load(Yii::$app->request->post()) ) 
		{
			$model->estado = 1;
			$model->save();
			$personasModel = [];
			foreach (Yii::$app->request->post()['CbacPersonasComunidad'] as $key => $personas)
			{
				$personasModel[$key] = new CbacPersonasComunidad();
				
				if (CbacPersonasComunidad::loadMultiple($personasModel, Yii::$app->request->post())) 
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
			foreach (Yii::$app->request->post()['CbacEstadoActualMisional'] as $key => $estado)
			{
				$estadoActualModel[$key] = new CbacEstadoActualMisional();
				
				if (CbacEstadoActualMisional::loadMultiple($estadoActualModel, Yii::$app->request->post())) 
				{
					foreach ($estadoActualModel as $key => $est) 
					{
						$est->id_consolidado_misional = $model->id;
						$est->id_actividades_consolidado = $key;
						$est->save(false);
						
					}
				}
			}
			
            return $this->redirect(['index','guardado' => 1]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'institucion'=> $this->obtenerInstitucion(),
        ]);
    }

    /**
     * Updates an existing CbacConsolidadoMisional model.
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
			
			$personas = CbacPersonasComunidad::find()->indexBy('id')->andWhere("id_consolidado_misional = $id")->all();
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

			
			$estadoActual = CbacEstadoActualMisional::find()->indexBy('id')->andWhere("id_consolidado_misional = $id")->all();
			$estadoActualModel = [];
			foreach($estadoActual as $estado)
			{
				$estadoActualModel[ $estado->id_actividades_consolidado ] = $estado;
				
			}
			
			if (Model::loadMultiple($estadoActualModel, Yii::$app->request->post())  ) 
			{
				foreach ($estadoActualModel as $est) 
				{
					$est->save(false);
				}
			}
		

            return $this->redirect(['index','guardado' => 1]);
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
     * Deletes an existing CbacConsolidadoMisional model.
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
     * Finds the CbacConsolidadoMisional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CbacConsolidadoMisional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacConsolidadoMisional::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
