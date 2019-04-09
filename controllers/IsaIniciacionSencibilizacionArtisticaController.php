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
use app\models\IsaIniciacionSencibilizacionArtistica;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\IsaProyectosGenerales;
use app\models\IsaEquiposCampo;

use yii\helpers\ArrayHelper;
use app\models\IsaActividadesIsa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Collapse;

/**
 * IsaIniciacionSencibilizacionArtisticaController implements the CRUD actions for IsaIniciacionSencibilizacionArtistica model.
 */
class IsaIniciacionSencibilizacionArtisticaController extends Controller
{
	
	public $arraySiNo = 
		[
			1 => "Si",
			2 => "No"		
		];
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
     * Lists all IsaIniciacionSencibilizacionArtistica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => IsaIniciacionSencibilizacionArtistica::find()->andWhere("estado =1")->orderby("id"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    function actionViewFases($model, $form)
	{
        
        $proyectos = new IsaProyectosGenerales();
        $actividades_isa = new IsaActividadesIsa();
		
		
		//tipo_proyecto diferenciador para usar la misma tabla para varios proyectos
		$proyectos = $proyectos->find()->andWhere("tipo_proyecto = 1")->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		
		$items = [];
		
		
		foreach( $proyectos as $idProyecto => $titulo )
		{
			

			$items[] = 	[
							'label' 		=>  $titulo,
							'content' 		=>  $this->renderAjax( 'faseItem', 
															[  
																'form' => $form,
																"model" => $model,
																'idProyecto' => $idProyecto,
																'actividades_isa' => $actividades_isa,
																'arraySiNo' => $this->arraySiNo,
																'equiposCampo' => $this->obtenerEquiposCampo(),
																
															] 
												),
							'contentOptions'=> []
						];
						
		}
		echo Collapse::widget([
			'items' => $items,
		]);
		
	}

    /**
     * Displays a single IsaIniciacionSencibilizacionArtistica model.
     * @param integer $id
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
     * Creates a new IsaIniciacionSencibilizacionArtistica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IsaIniciacionSencibilizacionArtistica();

        if ($model->load(Yii::$app->request->post())) 
		{
				
            if($model->save())
			{
                $isa_id = $model->id;
				$data = Yii::$app->request->post('IsaActividadesIsa');
					
				$arrayDatos = $data;
				
				foreach($data as $datos => $valores)
				{
					$arrayDatos[$datos]['id_iniciacion_sencibilizacion_artistica']=$isa_id;
				}
				
				$columnNameArray = 
				[
				'fecha_prevista_desde',
				'fecha_prevista_hasta',
				'num_equipo_campo',
				'perfiles',
				'docente_orientador',
				'fases',
				'num_encuentro',
				'nombre_actividad',
				'actividad_desarrollar',
				'lugares_recorrer',
				'tematicas_abordadas',
				'objetivos_especificos',
				'tiempo_previsto',
				'productos',
				'contenido_vigencia',
				'contenido_si_no',
				'contenido_nombre',
				'contenido_fecha',
				'contenido_justificacion',
				'articulacion',
				'cantidad_participantes',
				'requerimientos_tecnicos',
				'requerimientos_logisticos',
				'destinatarios',
				'fecha_entrega_envio',
				'observaciones_generales',
				'nombre_diligencia',
				'rol',
				'fecha',
				'id_procesos_generales',
				'id_iniciacion_sencibilizacion_artistica'
				];
				$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'isa.actividades_isa', $columnNameArray, $arrayDatos
                     )
					 ->execute();
            }
           
            return $this->redirect(['index', 'guardado' => 1]);
        }
		
		
		
       
	   
        return $this->renderAjax('create', [
            'model' => $model,
			'sede' => $this->obtenerSede(),
			'institucion'=> $this->obtenerInstitucion(),
			'arraySiNo' => $this->arraySiNo,
        ]);
    }

    /**
     * Updates an existing IsaIniciacionSencibilizacionArtistica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

		
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			
			$connection = Yii::$app->getDb();
			
			foreach (Yii::$app->request->post('IsaActividadesIsa') as $key => $actividades)
			{
				
				
				$command = $connection->createCommand("
				UPDATE 
					isa.actividades_isa
				SET 
					fecha_prevista_desde		='".$actividades['fecha_prevista_desde']."', 
					fecha_prevista_hasta		='".$actividades['fecha_prevista_hasta']."', 
					num_equipo_campo			='".$actividades['num_equipo_campo']."', 
					perfiles					='".$actividades['perfiles']."', 
					docente_orientador			='".$actividades['docente_orientador']."',
					fases						='".$actividades['fases']."', 
					num_encuentro				='".$actividades['num_encuentro']."', 
					nombre_actividad			='".$actividades['nombre_actividad']."', 
					actividad_desarrollar		='".$actividades['actividad_desarrollar']."', 
					lugares_recorrer			='".$actividades['lugares_recorrer']."', 
					tematicas_abordadas			='".$actividades['tematicas_abordadas']."',
					objetivos_especificos		='".$actividades['objetivos_especificos']."',
					tiempo_previsto				='".$actividades['tiempo_previsto']."', 
					productos					='".$actividades['productos']."', 
					contenido_si_no				='".$actividades['contenido_si_no']."', 
					contenido_nombre			='".$actividades['contenido_nombre']."', 
					contenido_fecha				='".$actividades['contenido_fecha']."', 
					contenido_vigencia			='".$actividades['contenido_vigencia']."',
					contenido_justificacion		='".$actividades['contenido_justificacion']."', 
					articulacion				='".$actividades['articulacion']."', 
					cantidad_participantes		='".$actividades['cantidad_participantes']."', 
					requerimientos_tecnicos		='".$actividades['requerimientos_tecnicos']."',
					requerimientos_logisticos	='".$actividades['requerimientos_logisticos']."', 
					destinatarios				='".$actividades['destinatarios']."',
					fecha_entrega_envio			='".$actividades['fecha_entrega_envio']."', 
					observaciones_generales		='".$actividades['observaciones_generales']."',
					nombre_diligencia			='".$actividades['nombre_diligencia']."',
					rol							='".$actividades['rol']."', 
					fecha						='".$actividades['fecha']."'
				WHERE 
					id_iniciacion_sencibilizacion_artistica= $id 
				AND 
					id_procesos_generales=$key
				;
			");
			$result = $command->queryAll();
			
			}
            return $this->redirect(['index']);
        }
		
		
        return $this->renderAjax('update', [
            'model' => $model,
			'sede' => $this->obtenerSede(),
			'institucion'=> $this->obtenerInstitucion(),
			'arraySiNo' => $this->arraySiNo,
			
        ]);
    }

	
	
	public function obtenerInstitucion()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$instituciones = new Instituciones();
		$instituciones = $instituciones->find()->where("id = $idInstitucion")->all();
		$instituciones = ArrayHelper::map($instituciones,'id','descripcion');
		
		return $instituciones;
	}
	
	public function obtenerSede()
	{
		$idSedes 		= $_SESSION['sede'][0];
		$sedes = new Sedes();
		$sedes = $sedes->find()->where("id =  $idSedes")->all();
		$sedes = ArrayHelper::map($sedes,'id','descripcion');
		
		return $sedes;
	}
	
	public function obtenerEquiposCampo()
	{
		$equiposCampo = new IsaEquiposCampo();
		$equiposCampo = $equiposCampo->find()->orderby("id")->all();
		$equiposCampo = ArrayHelper::map($equiposCampo,'id','descripcion');
		return $equiposCampo;
	}
	
	
    /**
     * Deletes an existing IsaIniciacionSencibilizacionArtistica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * Finds the IsaIniciacionSencibilizacionArtistica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IsaIniciacionSencibilizacionArtistica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IsaIniciacionSencibilizacionArtistica::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
