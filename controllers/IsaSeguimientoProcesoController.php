<?php
/**
 * Fecha:			Abril 21 de 2019
 * Programador: 	Edwin Molina G
 * Modificaciones:
 * Se realizan cambios varios para permitir crear y editar registros nuevos
 */


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
use app\models\IsaSeguimientoProceso;
use app\models\IsaSeguimientoProcesoBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Collapse;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\IsaSeguimientoProyectos;
use app\models\IsaPorcentajesActividades;
use app\models\IsaSemanaLogros;
use app\models\IsaSemanaLogrosForDebRet;
use app\models\IsaOrientacionMetodologicaActividades;
use app\models\IsaOrientacionMetodologicaVariaciones;
use app\models\IsaIntervencionIeo;


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
		
		$proyectos = IsaSeguimientoProyectos::find()->where( 'estado=1' )->orderby('id ASC')->all();
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

        if ($model->load( Yii::$app->request->post() )) 
		{
			
			$post = Yii::$app->request->post();
			
			
			
			$model->save();
			
			//se guardan los datos en la tabla Isa.Porcentajes_Actividades
			$arrayDatosActivides = $post['IsaPorcentajesActividades'];
			//se agrega el id de la tabla principal despues de guardarla
			foreach($arrayDatosActivides as $datos => $valores)
			{
				$arrayDatosActivides[$datos]['id_seguimiento_proceso']=$model->id;
			}
	
			$columnNameArrayIsaPorcentajesActividades=['total_sesiones','avance_sede','avance_ieo','seguimiento_actividades','evaluacion_actividades','id_actividades_seguimiento','estado','id_seguimiento_proceso',];
			
			// inserta todos los datos que trae el array 
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'isa.porcentajes_actividades', $columnNameArrayIsaPorcentajesActividades, $arrayDatosActivides
                     )
					 ->execute();
					 
					 
			//se guardan los datos en la tabla Isa.Semana_Logros
			$arrayDatosSemanaLogros = $post['IsaSemanaLogros'];
			//se agrega el id de la tabla principal despues de guardarla
			foreach($arrayDatosSemanaLogros as $datos => $valores)
			{
				$arrayDatosSemanaLogros[$datos]['id_seguimiento_proceso']=$model->id;
			}
			
			$columnNameArraySemanaLogros=['semana1','semana2','semana3','semana4','id_logros_actividades','estado','id_seguimiento_proceso'];
			
			// inserta todos los datos que trae el array
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'isa.semana_logros', $columnNameArraySemanaLogros, $arrayDatosSemanaLogros
                     )
					 ->execute();
					 
					 
					 
			// echo "<pre>"; print_r($post); echo "</pre>"; 
			// die;		 
			//se guardan los datos en la tabla Isa.Orientacion_Metodologica_Actividades
			$arrayDatosIsaOrientacionMetodologicaActividades = $post['IsaOrientacionMetodologicaActividades'];
			//se agrega el id de la tabla principal despues de guardarla
			foreach($arrayDatosIsaOrientacionMetodologicaActividades as $datos => $valores)
			{
				$arrayDatosIsaOrientacionMetodologicaActividades[$datos]['estado']=1;
				$arrayDatosIsaOrientacionMetodologicaActividades[$datos]['id_seguimiento_proceso']=$model->id;
			}
			
			$columnNameIsaOrientacionMetodologicaActividades=['descripcion','id_actividades','id_logros','estado','id_seguimiento_proceso'];
			
			// inserta todos los datos que trae el array
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'isa.orientacion_metodologica_actividades', $columnNameIsaOrientacionMetodologicaActividades, $arrayDatosIsaOrientacionMetodologicaActividades
                     )
					 ->execute();
					 
			

			
			//se guardan los datos en la tabla Isa.Semana_Logros_For_Deb_Ret
			$arrayDatosIsaSemanaLogrosForDebRet = $post['IsaSemanaLogrosForDebRet'];
			//se agrega el id de la tabla principal despues de guardarla
			foreach($arrayDatosIsaSemanaLogrosForDebRet as $datos => $valores)
			{
				$arrayDatosIsaSemanaLogrosForDebRet[$datos]['id_seguimiento_proceso']=$model->id;
			}
			
			$columnNameIsaSemanaLogrosForDebRet=['semana1','semana2','semana3','semana4','id_for_deb_ret','estado','id_seguimiento_proceso'];
			
			// inserta todos los datos que trae el array
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'isa.semana_logros_for_deb_ret', $columnNameIsaSemanaLogrosForDebRet, $arrayDatosIsaSemanaLogrosForDebRet
                     )
					 ->execute();		 
					 
			
			//se guardan los datos en la tabla Isa.Orientacion_Metodologica_Variaciones
			$arrayDatosIsaOrientacionMetodologicaVariaciones = $post['IsaOrientacionMetodologicaVariaciones'];
			//se agrega el id de la tabla principal despues de guardarla
			foreach($arrayDatosIsaOrientacionMetodologicaVariaciones as $datos => $valores)
			{
				$arrayDatosIsaOrientacionMetodologicaVariaciones[$datos]['estado']=1;
				$arrayDatosIsaOrientacionMetodologicaVariaciones[$datos]['id_seguimiento_proceso']=$model->id;
			}
			
			$columnNameIsaSemanaLogrosForDebRet=['descripcion','id_variaciones_actividades','id_for_deb_ret','estado','id_seguimiento_proceso'];
			
			// inserta todos los datos que trae el array
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'isa.orientacion_metodologica_variaciones', $columnNameIsaSemanaLogrosForDebRet, $arrayDatosIsaOrientacionMetodologicaVariaciones
                     )
					 ->execute();		 
					  
            return $this->redirect(['index']);
        }
	
		
		
         return $this->renderAjax('create', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'instituciones'=> $this->obtenerInstituciones(),
			'isaIntervencionIeo' => $this->intervencioIEO(),
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

        if ($model->load(Yii::$app->request->post()) ) 
		{
			
			$post = Yii::$app->request->post();
			// echo "<pre>"; print_r($post); echo "</pre>"; 

			// die;
			$connection = Yii::$app->getDb();
			$arrayDatosIsaPorcentajesActividades = $post['IsaPorcentajesActividades'];
			foreach($arrayDatosIsaPorcentajesActividades as $idPlaneacion => $val)
			{
				$command = $connection->createCommand
				(" 
					UPDATE isa.porcentajes_actividades set 			
					total_sesiones 	='". $val['total_sesiones']."', 
					avance_sede 	='". $val['avance_sede']."', 
					avance_ieo 		='". $val['avance_ieo']."', 
					seguimiento_actividades	 ='". $val['seguimiento_actividades']."', 
					evaluacion_actividades	 ='". $val['evaluacion_actividades']."'
					WHERE id_seguimiento_proceso = $id and  id_actividades_seguimiento =". $val['id_actividades_seguimiento']."
				");
				$result = $command->queryAll();
			}
			
			 
			$arrayDatosIsaSemanaLogros = $post['IsaSemanaLogros'];
			foreach($arrayDatosIsaSemanaLogros as $idLogros => $val)
			{
				$command = $connection->createCommand
				(" 
					UPDATE isa.semana_logros set 			
					semana1  ='". $val['semana1']."', 
					semana2  ='". $val['semana2']."', 
					semana3  ='". $val['semana3']."', 
					semana4  ='". $val['semana4']."'
					WHERE id_seguimiento_proceso = $id and id_logros_actividades = $idLogros
				");
				$result = $command->queryAll();
			}
			
			
			$arrayDatosisaSemanaLogrosForDebRet = $post['IsaSemanaLogrosForDebRet'];
			foreach($arrayDatosisaSemanaLogrosForDebRet as $idLogrosfdr => $val)
			{
				$command = $connection->createCommand
				(" 
					UPDATE isa.semana_logros_for_deb_ret set 			
					semana1  ='". $val['semana1']."', 
					semana2  ='". $val['semana2']."', 
					semana3  ='". $val['semana3']."', 
					semana4  ='". $val['semana4']."'
					WHERE id_seguimiento_proceso = $id and id_for_deb_ret = $idLogrosfdr
				");
				$result = $command->queryAll();
			}
			
			
				
			$arrayDatosIsaOrientacionMetodologicaActividades = $post['IsaOrientacionMetodologicaActividades'];
			foreach($arrayDatosIsaOrientacionMetodologicaActividades as $idActividades => $val)
			{
				$command = $connection->createCommand
				(" 
					UPDATE isa.orientacion_metodologica_actividades set 			
					descripcion  ='". $val['descripcion']."'
					
					WHERE id_seguimiento_proceso = $id and id_actividades = $val[id_actividades] and id_logros = $val[id_logros]
				");
				$result = $command->queryAll();
			}
			
		
			$arrayDatosIsaOrientacionMetodologicaVariaciones = $post['IsaOrientacionMetodologicaVariaciones'];
			foreach($arrayDatosIsaOrientacionMetodologicaVariaciones as $idActividades => $val)
			{
				// var_dump( $val ); echo "<br>";
				// echo " 
					// UPDATE isa.orientacion_metodologica_variaciones set 			
					// descripcion  ='". $val['descripcion']."'
					// WHERE id_seguimiento_proceso = $id and id_variaciones_actividades = $val[id_variaciones_actividades] and id_for_deb_ret = $val[id_for_deb_ret]
				// <br><br>"; 
				
				$command = $connection->createCommand
				(" 
					UPDATE isa.orientacion_metodologica_variaciones set 			
					descripcion  ='". $val['descripcion']."'
					WHERE id_seguimiento_proceso = $id and id_variaciones_actividades = $val[id_variaciones_actividades] and id_for_deb_ret = $val[id_for_deb_ret]
				");
				$result = $command->queryAll();
			}
			
			// exit();
			
				
			$model->save();
            return $this->redirect(['index']);
        }
		
		// incio -- se llenan los datos del formulario desde la base de datos
		$isaPorcentajesActividades = new IsaPorcentajesActividades();
		$isaPorcentajesActividades = $isaPorcentajesActividades->find()->orderby("id")->andWhere("id_seguimiento_proceso=$id")->all();
		
		//se trae la informacionde la basse de datos tabla ec.avances
		$resultisaPorcentajesActividades = ArrayHelper::getColumn($isaPorcentajesActividades, function ($element) 
		{
			$dato[$element['id_actividades_seguimiento']]['total_sesiones']= $element['total_sesiones'];
			$dato[$element['id_actividades_seguimiento']]['avance_sede']= $element['avance_sede'];
			$dato[$element['id_actividades_seguimiento']]['avance_ieo']= $element['avance_ieo'];
			$dato[$element['id_actividades_seguimiento']]['seguimiento_actividades']= $element['seguimiento_actividades'];
			$dato[$element['id_actividades_seguimiento']]['evaluacion_actividades']= $element['evaluacion_actividades'];
			$dato[$element['id_actividades_seguimiento']]['id_seguimiento_proceso']= $element['id_seguimiento_proceso'];
			$dato[$element['id_actividades_seguimiento']]['id_actividades_seguimiento']= $element['id_actividades_seguimiento'];
			return $dato;
		});
		
		
		//se formate la informacion que deben tener los campos tabla ec.avances
		foreach	($resultisaPorcentajesActividades as $r => $valor)
		{
			foreach	($valor as $ids => $valores)
				
				$datos['PorcentajesActividades'][$ids] = $valores;
		}
		
	
		$isaSemanaLogros = new IsaSemanaLogros();
		$isaSemanaLogros = $isaSemanaLogros->find()->orderby("id")->andWhere("id_seguimiento_proceso=$id")->all();
		
		//se trae la informacionde la basse de datos tabla ec.avances
		$resultisaSemanaLogros = ArrayHelper::getColumn($isaSemanaLogros, function ($element) 
		{
			$dato[$element['id_logros_actividades']]['semana1']= $element['semana1'];
			$dato[$element['id_logros_actividades']]['semana2']= $element['semana2'];
			$dato[$element['id_logros_actividades']]['semana3']= $element['semana3'];
			$dato[$element['id_logros_actividades']]['semana4']= $element['semana4'];
			$dato[$element['id_logros_actividades']]['id_logros_actividades']= $element['id_logros_actividades'];
			$dato[$element['id_logros_actividades']]['id_seguimiento_proceso']= $element['id_seguimiento_proceso'];
			return $dato;
		});
		
		
		//se formate la informacion que deben tener los campos tabla ec.avances
		foreach	($resultisaSemanaLogros as $r => $valor)
		{
			foreach	($valor as $ids => $valores)
				
				$datos['SemanaLogros'][$ids] = $valores;
		}
		
		$isaSemanaLogrosForDebRet = new IsaSemanaLogrosForDebRet();
		$isaSemanaLogrosForDebRet = $isaSemanaLogrosForDebRet->find()->orderby("id")->andWhere("id_seguimiento_proceso=$id")->all();
		
		//se trae la informacionde la basse de datos tabla ec.avances
		$resultisaSemanaLogros = ArrayHelper::getColumn($isaSemanaLogrosForDebRet, function ($element) 
		{
			$dato[$element['id_for_deb_ret']]['semana1']= $element['semana1'];
			$dato[$element['id_for_deb_ret']]['semana2']= $element['semana2'];
			$dato[$element['id_for_deb_ret']]['semana3']= $element['semana3'];
			$dato[$element['id_for_deb_ret']]['semana4']= $element['semana4'];
			$dato[$element['id_for_deb_ret']]['id_for_deb_ret']= $element['id_for_deb_ret'];
			$dato[$element['id_for_deb_ret']]['id_seguimiento_proceso']= $element['id_seguimiento_proceso'];
			return $dato;
		});
		
		
		//se formate la informacion que deben tener los campos tabla ec.avances
		foreach	($resultisaSemanaLogros as $r => $valor)
		{
			foreach	($valor as $ids => $valores)
				
				$datos['semanaLogrosfdr'][$ids] = $valores;
		}
		
		
		$isaOrientacionMetodologicaActividades = new IsaOrientacionMetodologicaActividades();
		$isaOrientacionMetodologicaActividades = $isaOrientacionMetodologicaActividades->find()->orderby("id")->andWhere("id_seguimiento_proceso=$id")->all();
		
		//se trae la informacionde la basse de datos tabla ec.avances
		$resultisaOrientacionMetodologicaActividades = ArrayHelper::getColumn($isaOrientacionMetodologicaActividades, function ($element) 
		{
			$dato[$element['id_actividades']][$element['id_logros']]['descripcion']				= $element['descripcion'];
			$dato[$element['id_actividades']][$element['id_logros']]['id_actividades']			= $element['id_actividades'];
			$dato[$element['id_actividades']][$element['id_logros']]['id_seguimiento_proceso']	= $element['id_seguimiento_proceso'];
			$dato[$element['id_actividades']][$element['id_logros']]['id_seguimiento_proceso']	= $element['id_logros'];
			return $dato;
		});
		
		
		//se formate la informacion que deben tener los campos tabla ec.avances
		foreach	($resultisaOrientacionMetodologicaActividades as $r => $valor)
		{
			foreach( $valor as $ids => $valores )
			{
				foreach( $valores as $k => $v )
					$datos['OrientacionMetodologicaActividades'][$ids][$k] = $v;
			}
		}
		
		
		
		$isaOrientacionMetodologicaVariaciones = new IsaOrientacionMetodologicaVariaciones();
		$isaOrientacionMetodologicaVariaciones = $isaOrientacionMetodologicaVariaciones->find()->orderby("id")->andWhere("id_seguimiento_proceso=$id")->all();
		
		//se trae la informacionde la basse de datos tabla ec.avances
		$resultisaOrientacionMetodologicaVariaciones = ArrayHelper::getColumn($isaOrientacionMetodologicaVariaciones, function ($element) 
		{
			$dato[$element['id_variaciones_actividades']][$element['id_for_deb_ret']]['descripcion']				= $element['descripcion'];
			$dato[$element['id_variaciones_actividades']][$element['id_for_deb_ret']]['id_variaciones_actividades']	= $element['id_variaciones_actividades'];
			$dato[$element['id_variaciones_actividades']][$element['id_for_deb_ret']]['id_seguimiento_proceso']		= $element['id_seguimiento_proceso'];
			$dato[$element['id_variaciones_actividades']][$element['id_for_deb_ret']]['id_for_deb_ret']				= $element['id_for_deb_ret'];
			return $dato;
		});
		
		
		//se formate la informacion que deben tener los campos tabla ec.avances
		foreach	($resultisaOrientacionMetodologicaVariaciones as $r => $valor)
		{
			foreach	($valor as $ids => $valores)
			{	
				foreach( $valores as $k => $v )
					$datos['OrientacionMetodologicaVariaciones'][$ids][$k] = $v;
			}
		}
		
		// fin -- se llenan los datos del formulario desde la base de datos
        return $this->renderAjax('update', [
            'model' => $model,
			'sedes' => $this->obtenerSede(),
			'instituciones'=> $this->obtenerInstituciones(),
			'datos'=>$datos,
			'isaIntervencionIeo' => $this->intervencioIEO(),
        ]);
    }


	public function intervencioIEO()
	{
		$isaIntervencionIeo = new IsaIntervencionIeo();
		$isaIntervencionIeo = $isaIntervencionIeo->find()->orderby("id")->all();
		$isaIntervencionIeo = ArrayHelper::map($isaIntervencionIeo,'id','nombre_actividad');
		
		return $isaIntervencionIeo;
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
