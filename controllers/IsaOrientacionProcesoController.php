<?php

/**********
Versión: 001
Fecha: 02-01-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud y formulario de orientacion proceso
---------------------------------------
Modificaciones:
Fecha: 22-04-2019
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se agregan tabs y se permite crear y modificar registros
----------------------------------------
Modificaciones:
Fecha: 02-01-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: creacion funcion actionFormulario
modificacion update 
modificacion create 
----------------------------------------
**********/

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
use app\models\IsaOrientacionProceso;
use app\models\IsaOrientacionProcesoBuscar;
use app\models\IsaProyectos;
use app\models\IsaAvances;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use app\models\Instituciones;
use app\models\Sedes;
/**
 * IsaOrientacionProcesoController implements the CRUD actions for IsaOrientacionProceso model.
 */
class IsaOrientacionProcesoController extends Controller
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

	/*
		funcion encargarda de mostrar los acordeones con sus respectivos titulos y campos 
	*/
	public function actionFormulario($model,$form,$datos = 0)
	{
		
		$proyectos = IsaProyectos::find()->where( 'estado=1' )->orderby('id ASC')->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		foreach ($proyectos as $idProyecto => $v)
		{
			
			 $contenedores[] = 	
				[
					'label' 		=>  $v,
					'content' 		=>  $this->renderPartial( 'procesos', 
													[  
                                                        'idProyecto' => $idProyecto,
														'form' => $form,
														'datos' => $datos,
													] 
										),
					'contentOptions'=> []
				];
	
		}
		
		 echo Collapse::widget([
			'items' => $contenedores,
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
	
	public function obtenerInstituciones()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$instituciones = new Instituciones();
		$instituciones = $instituciones->find()->where("id = $idInstitucion")->all();
		$instituciones = ArrayHelper::map($instituciones,'id','descripcion');
		
		return $instituciones;
	}
    /**
     * Lists all IsaOrientacionProceso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IsaOrientacionProcesoBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( "estado=1" ); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IsaOrientacionProceso model.
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
     * Creates a new IsaOrientacionProceso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IsaOrientacionProceso();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			
			$post = Yii::$app->request->post();
			
			$arrayDatosAvances = $post['IsaAvances'];
			
			$idOrientacionProceso = $model->id;
			foreach($arrayDatosAvances as $datos => $valores)
			{
				$arrayDatosAvances[$datos]['id_orientacion_proceso']=$idOrientacionProceso;
			}
			
			$columnNameArrayAvances = 
			[
				'logros',
				'fortalezas',
				'debilidades',
				'alternativas',
				'retos',
				'observaciones',
				'alarmas',
				'necesidades',
				'ajustes',
				'estrategias_debilidades',
				'estrategias_fortalezas',
				'temas_abordar',
				'como',
				'necesidades_articulacion',
				'indique',
				'id_acciones',
				'estado',
				'id_orientacion_proceso',
				
			];
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'isa.avances', $columnNameArrayAvances, $arrayDatosAvances
                     )
					 ->execute();
			
            return $this->redirect(['index', 'guardado' => 1]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'instituciones'=> $this->obtenerInstituciones(),
        ]);
    }

    /**
     * Updates an existing IsaOrientacionProceso model.
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
			$post = Yii::$app->request->post();
			
			$arrayDatosAvances = $post['IsaAvances'];
			$connection = Yii::$app->getDb();
			foreach($arrayDatosAvances as $idAcciones => $valores)
			{
				
				$command = $connection->createCommand
				(" 
					UPDATE isa.avances set 			
					logros						='". $valores['logros']."',
					fortalezas					='". $valores['fortalezas']."',
					debilidades					='". $valores['debilidades']."',
					alternativas				='". $valores['alternativas']."',
					retos						='". $valores['retos']."',
					necesidades					='". $valores['necesidades']."',
					ajustes						='". $valores['ajustes']."',
					estrategias_debilidades		='". $valores['estrategias_debilidades']."',
					estrategias_fortalezas		='". $valores['estrategias_fortalezas']."',
					temas_abordar				='". $valores['temas_abordar']."',
					como						='". $valores['como']."',
					necesidades_articulacion	='". $valores['necesidades_articulacion']."',
					indique						='". $valores['indique']."',
					observaciones				='". $valores['observaciones']."',
					alarmas						='". $valores['alarmas']."'

					WHERE id_acciones = $idAcciones and id_orientacion_proceso = $id
				");
				$result = $command->queryAll();
			}
            
			return $this->redirect(['index', 'guardado' => 1]);
        }

		
			$IsaAvances = new IsaAvances();
			$IsaAvances = $IsaAvances->find()->orderby("id")->andWhere("id_orientacion_proceso=$id")->all();
			
			
			//se trae la informacionde la basse de datos tabla ec.avances
			$result = ArrayHelper::getColumn($IsaAvances, function ($element) 
			{
				$dato[$element['id_acciones']]['logros']= $element['logros'];
				$dato[$element['id_acciones']]['fortalezas']= $element['fortalezas'];
				$dato[$element['id_acciones']]['debilidades']= $element['debilidades'];
				$dato[$element['id_acciones']]['alternativas']= $element['alternativas'];
				$dato[$element['id_acciones']]['id_acciones']= $element['id_acciones'];
				$dato[$element['id_acciones']]['id_orientacion_proceso']= $element['id_orientacion_proceso'];
				$dato[$element['id_acciones']]['retos']= $element['retos'];
				$dato[$element['id_acciones']]['necesidades']= $element['necesidades'];
				$dato[$element['id_acciones']]['estrategias_fortalezas']= $element['estrategias_fortalezas'];
				$dato[$element['id_acciones']]['estrategias_debilidades']= $element['estrategias_debilidades'];
				$dato[$element['id_acciones']]['ajustes']= $element['ajustes'];
				$dato[$element['id_acciones']]['temas_abordar']= $element['temas_abordar'];
				$dato[$element['id_acciones']]['como']= $element['como'];
				$dato[$element['id_acciones']]['necesidades_articulacion']= $element['necesidades_articulacion'];
				$dato[$element['id_acciones']]['indique']= $element['indique'];
				$dato[$element['id_acciones']]['observaciones']= $element['observaciones'];
				$dato[$element['id_acciones']]['alarmas']= $element['alarmas'];
				return $dato;
			});
			
			
			//se formate la informacion que deben tener los campos tabla ec.avances
			foreach	($result as $r => $valor)
			{
				foreach	($valor as $ids => $valores)
					
					$datos[$ids] = $valores;
			}
			
	
        return $this->renderAjax('update', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'instituciones'=> $this->obtenerInstituciones(),
			'datos'=>$datos,
        ]);
    }

    /**
     * Deletes an existing IsaOrientacionProceso model.
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
     * Finds the IsaOrientacionProceso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return IsaOrientacionProceso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IsaOrientacionProceso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
