<?php
/**
 * Fecha:			Abril 21 de 2019
 * Programador: 	Edwin Molina G
 * Modificaciones:
 * Se realizan cambios varios para permitir crear y editar registros nuevos
 */
/**********
Versión: 001
Descripción: formulario mixto reporte e ingreso de datos isa-seguimiento-proceso
---------------------------------------
Modificaciones:
Fecha: 14-06-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: Se realizan cambios varios para permitir crear y editar registros nuevos
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
use yii\helpers\Json;
use app\models\IsaSeguimientoProceso;
use app\models\IsaSeguimientoProcesoBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\IsaRomProyectos;
use app\models\IsaPorcentajesActividades;
use app\models\IsaSemanaLogros;
use app\models\IsaSemanaLogrosForDebRet;
use app\models\IsaOrientacionMetodologicaActividades;
use app\models\IsaOrientacionMetodologicaVariaciones;
use app\models\IsaActividadesRom;
use app\models\IsaIntervencionIeo;
use app\models\RomReporteOperativoMisional;
use app\models\IsaActividadesRomXIntegranteGrupo;
use yii\base\Model;



/**
 * IsaSeguimientoProcesoController implements the CRUD actions for IsaSeguimientoProceso model.
 */
class IsaSeguimientoProcesoController extends Controller
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
     * Lists all IsaSeguimientoProceso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IsaSeguimientoProcesoBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( "estado=1" ); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
     * Displays a single IsaSeguimientoProceso model.
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
     * Creates a new IsaSeguimientoProceso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IsaSeguimientoProceso();
	
        if ($model->load( Yii::$app->request->post() ) && $model->save(false)) 
		{
			
			$actividadesModel[1] = new IsaPorcentajesActividades();
			$actividadesModel[2] = new IsaPorcentajesActividades();
			$actividadesModel[4] = new IsaPorcentajesActividades();


			if (IsaPorcentajesActividades::loadMultiple($actividadesModel, Yii::$app->request->post())) 
			{
				foreach ($actividadesModel as $key => $actividad) 
				{
					$actividad->id_seguimiento_proceso = $model->id;
					$actividad->save(false);
					
				}
			}
			$OriMetodologica = [];
			//se crean los modelos con los ids iguales a como vienen del $_POST
			foreach (Yii::$app->request->post()['IsaOrientacionMetodologicaActividades'] as $key =>  $modelos)
			{
				$OriMetodologica[$key] = new IsaOrientacionMetodologicaActividades();
			}
			
			if (IsaOrientacionMetodologicaActividades::loadMultiple($OriMetodologica, Yii::$app->request->post())) 
			{
				foreach ($OriMetodologica as $key => $OriMetodologicaActividad) 
				{
					$OriMetodologicaActividad->id_seguimiento_proceso = $model->id;
					$OriMetodologicaActividad->estado = 1;
					$OriMetodologicaActividad->save(false);
					
				}
			}
			
			
			$OriMetodologicaOriMetodologicaVariaciones = [];
			//se crean los modelos con los ids iguales a como vienen del $_POST
			foreach (Yii::$app->request->post()['IsaOrientacionMetodologicaVariaciones'] as $key =>  $modelos)
			{
				$OriMetodologicaOriMetodologicaVariaciones[$key] = new IsaOrientacionMetodologicaVariaciones();
			}
			
			if (IsaOrientacionMetodologicaVariaciones::loadMultiple($OriMetodologicaOriMetodologicaVariaciones, Yii::$app->request->post())) 
			{
				foreach ($OriMetodologicaOriMetodologicaVariaciones as $key => $OriMetodologicaVariacion) 
				{
					$OriMetodologicaVariacion->id_seguimiento_proceso = $model->id;
					$OriMetodologicaVariacion->estado = 1;
					$OriMetodologicaVariacion->save(false);
				}
			}
			
            return $this->redirect(['index']);
        }
		
         return $this->renderAjax('create', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'instituciones'=> $this->obtenerInstituciones(),
		
        ]);
    }


	
    /**
     * Updates an existing IsaSeguimientoProceso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save() ) 
		{
			
			
			if($postPorcentajesActividades =  Yii::$app->request->post()['IsaPorcentajesActividades'])
			{
				$porcentajeActividades = IsaPorcentajesActividades::find()->indexBy('id')->andWhere("id_seguimiento_proceso = $id")->all();
				
				//id del Yii::$app->request->post() e id de actividades deben ser iguales
				$actividadPorcentaje = [];
				foreach($porcentajeActividades as $key => $Pactividad)
				{
					$actividadPorcentaje[key($postPorcentajesActividades)] = $Pactividad;
					unset($postPorcentajesActividades[ key($postPorcentajesActividades) ]);
				}
				
				if (Model::loadMultiple($actividadPorcentaje, Yii::$app->request->post()) && Model::validateMultiple($actividadPorcentaje) ) 
				{
					foreach ($actividadPorcentaje as $actividad) 
					{
						$actividad->save(false);
					}
				}
				
			}
			
		
			if($postOrientcacionMetodologica  =   Yii::$app->request->post()['IsaOrientacionMetodologicaActividades'])
			{
				$orientacionMetodologica = IsaOrientacionMetodologicaActividades::find()->indexBy('id')->andWhere("id_seguimiento_proceso = $id")->all();
				
				// id del Yii::$app->request->post() e id de actividades deben ser iguales
				$orientacionM = [];
				foreach($orientacionMetodologica as $key => $orientacionMeto)
				{
					$orientacionM[key($postOrientcacionMetodologica)] = $orientacionMeto;
					unset($postOrientcacionMetodologica[ key($postOrientcacionMetodologica) ]);
				}
				if (Model::loadMultiple($orientacionM, Yii::$app->request->post()) && Model::validateMultiple($orientacionM) ) 
				{
					foreach ($orientacionM as $orientacion) 
					{
						$orientacion->save(false);
					}
				}
				
				
			}
			
			//se guardan los datos de la tabla IsaOrientacionMetodologicaVariaciones
			if($postIsaOrientacionMetodologicaVariaciones  =   Yii::$app->request->post()['IsaOrientacionMetodologicaVariaciones'])
			{
				$orientacionMetodologicaV = IsaOrientacionMetodologicaVariaciones::find()->indexBy('id')->andWhere("id_seguimiento_proceso = $id")->all();
				
				foreach($orientacionMetodologicaV as $key => $ori)
				{
					$ori->descripcion = $postIsaOrientacionMetodologicaVariaciones[$ori->id_variaciones_actividades]['descripcion'];	
					$ori->save(false); 	
				}
			}
			
			
			// die;
			
			
            return $this->redirect(['index']);
        }
		
		
        return $this->renderAjax('update', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'instituciones'=> $this->obtenerInstituciones(),
			
        ]);
    }


	//se obtiene los datos ingresados en el formulario 2 rom-reporte-operativo-misional
	public function actionLogros($fecha)
	{
		$valores = explode('-', $fecha);
		if(count($valores) == 2 && is_numeric($valores[0]) && is_numeric($valores[1]))
		{
			
			$idInstitucion 	= $_SESSION['instituciones'][0];
			$idSedes 		= $_SESSION['sede'][0];

			$connection = Yii::$app->getDb();
			$command = $connection->createCommand("
				SELECT 
					ari.id_rom_actividad,
					concat(pe.nombres,' ',pe.apellidos) as nombres,
					ari.logros, 
					ari.alternativas, 
					ari.articulacion, 
					ari.observaciones_generales,
					ari.alarmas,
					ari.fortalezas, 
					ari.debilidades, 
					ari.retos,
					ari.fecha_diligencia
				FROM 
					isa.actividades_rom_x_integrante_grupo as ari, 
					isa.reporte_operativo_misional as rom, 
					perfiles_x_personas as pxp,
					personas as pe
				WHERE
					ari.id_reporte_operativo_misional = rom.id
				AND
					rom.id_institucion = $idInstitucion
				AND
					rom.id_sedes	   = $idSedes
				AND
					rom.estado 		   = 1
				AND
					pxp.id = ari.diligencia
				AND
					pxp.id_personas = pe.id
				AND 
					ari.fecha_diligencia BETWEEN '$fecha' AND '$fecha-31'
			");
			
			$result = $command->queryAll();	
			
			$datos = [];
			foreach ($result as $r)
			{
				$datos[$r['nombres']][]=$r ;
			}
			
			 return Json::encode($datos);
		}
		
	}
	
    /**
     * Deletes an existing IsaSeguimientoProceso model.
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
	
	public function actionDatosAvances($fecha)
	{
		$idInstitucion 	= $_SESSION['instituciones'][0];
		$idSedes 		= $_SESSION['sede'][0];
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
			SELECT 
				rom.id_sedes, count(rom.id_sedes),ar.estado_actividad
			FROM 
				isa.reporte_operativo_misional as rom,
				isa.actividades_rom as ar
			WHERE 
				ar.id_reporte_operativo_misional = rom.id
			AND 
				rom.id_institucion = $idInstitucion
			AND 
				rom.estado = 1
			AND 
				ar.fecha_desde BETWEEN '$fecha-01' AND '".date( "Y-m-t", strtotime( $fecha ) )."'
			GROUP BY 
				rom.id_sedes,ar.estado_actividad
			
		");
		// GROUP BY rom.id_sedes
		$actividadesRom = $command->queryAll();
		
		$totalSesionesSede = 0;
		// $totalSesiones = count($actividadesRom) > 0 ? count($actividadesRom) : 0 ;
		$totalRealizadoSede =0;
		//se crea un array con indice el id de la sede y valor la cantidad (count)
		$totalesSedes = [];
		foreach($actividadesRom as $ar)
		{
			@$totalesSedes[$ar['id_sedes']][$ar['estado_actividad'] ] += $ar['count'] ;
			
			if($ar['id_sedes'] == $idSedes)
			{
				$totalSesionesSede +=$ar['count'];
					if($ar['estado_actividad'] == 179)
						$totalRealizadoSede += $ar['count'];
			}
		}

		//sedes de la instituciones actual
		$sedesIeo = Sedes::find()									  
				  ->where( "id_instituciones=$idInstitucion" )
				  ->andwhere("estado=1")
				  ->all();
		$asignaturas = ArrayHelper::map( $sedesIeo, 'id', 'descripcion' );
		
		if ($totalRealizadoSede > 0)
			$porcentajeSede = $totalRealizadoSede / $totalSesionesSede;
		else		
			$porcentajeSede = 0;
		
		
		$sesiones_realizadas = 0;
		$sesiones_aplazadas  = 0;
		$sesiones_canceladas =0;
		$totalSesionesIEO = 0;
		$porcetaje_actividades = [];
		
		foreach ($totalesSedes as $key => $ttSedes)
		{
			@$sesiones_realizadas = $ttSedes[179];
			@$sesiones_aplazadas  = $ttSedes[180];
			@$sesiones_canceladas = $ttSedes[181];
			
			$totalSesionesIEO += $sesiones_realizadas+$sesiones_aplazadas+$sesiones_canceladas;
			$porcetaje_actividades[$key] = $sesiones_realizadas  / ($sesiones_realizadas+$sesiones_aplazadas+$sesiones_canceladas);
		}
		
		$avanceIEO = 0;
		$porcetaje_actividadesSedes = 0;
		foreach ($porcetaje_actividades as $pa)
			$porcetaje_actividadesSedes+= $pa;
		
		$avanceIEO = $porcetaje_actividadesSedes / count($sedesIeo);
		
		$arrayDatos = [];
		
		$arrayDatos[] = $totalSesionesIEO * 100;
		$arrayDatos[] = $porcentajeSede * 100;
		$arrayDatos[] = $avanceIEO * 100 ;
		
		return json_encode($arrayDatos);
	}

    /**
     * Finds the IsaSeguimientoProceso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return IsaSeguimientoProceso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	 
	 
    protected function findModel($id)
    {
        if (($model = IsaSeguimientoProceso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
