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

/**********
Versión: 002
Fecha: 16-04-2018
Desarrollador: Oscar David Lopez
Descripción: Forulario informe planeacion IEO
---------------------------------------
Modificaciones:
Fecha: 16-04-2018
Persona encargada: Oscar David Lopez
Cambios realizados: Se reestructua el formulario, reduccion de codigo y correcion de errores

---------------------------------------
**********/


use Yii;
use app\models\EcInformePlaneacionIeo;
use app\models\EcInformePlaneacionIeoSearch;
use app\models\EcProyectos;
use app\models\EcProcesos;
use app\models\EcAvances;
use app\models\EcRespuestas;
use app\models\ZonasEducativas;
use app\models\EcInformePlaneacionProyectos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ComunasCorregimientos;
use app\models\BarriosVeredas;
use yii\helpers\ArrayHelper;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Parametro;
use app\models\EcTipoInforme;
use app\models\EcPorcentajeAvance;
use yii\bootstrap\Collapse;

/**
 * EcinformeplaneacionieoController implements the CRUD actions for EcInformePlaneacionIeo model.
 */
class EcinformeplaneacionieoController extends Controller
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

    function actionViewfases($model,$form,$datos = 0,$datoRespuesta=0,$datoInformePlaneacionProyectos=0,$idTipoInforme )
	{
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand(
		"
			select p.descripcion,p.id
			from ec.tipo_informe as ti, ec.componentes as c, ec.proyectos as p
			where ti.id = $idTipoInforme
			and ti.id_componente = c.id
			and c.descripcion = p.descripcion
			
		");
		$ecProyectos = $command->queryAll();
		
		
		// $docentes	= ArrayHelper::map( $dataDocentes, 'id', 'nombres' );
		
		
		// $ecProyectos = EcProyectos::find()->where( 'estado=1' )
							// ->orderby('id ASC')->all();

		$modelProyectos = new EcProyectos();
		$estadoActual = [ 
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4'
				];
		
		
	
		//colores del acordeon
		$arrayColores = array(
		"Proyectos Pedagógicos Transversales"=>"panel panel-danger",
		"Articulación Familiar" =>"panel panel-info",
		"Proyecto de Servicio Social Estudiantil"=>"panel panel-success",
		"Proyecto Fortalecimiento de Competencias Básicas desde la Transversalidad"=>"panel-warning"
		);
		
		$contenedores = array();
		// $ecProyectos = ArrayHelper::map($ecProyectos,'id','descripcion');
		foreach ($ecProyectos as $proyecto)
		{
			
			 $contenedores[] = 	
				[
					'label' 		=>  $proyecto['descripcion'],
					'content' 		=>  $this->renderPartial( 'procesos', 
													[  
                                                        'idProyecto' => $proyecto['id'],
														'form' => $form,
														'estadoActual' => $estadoActual,
														'modelProyectos' =>  $modelProyectos,
														'datos'=>$datos,
														'datoRespuesta'=> $datoRespuesta,
														'datoInformePlaneacionProyectos'=> $datoInformePlaneacionProyectos,
													] 
										),
					 'contentOptions' => ['class' => 'in'],
					 'options' => ['class' => $arrayColores[$proyecto['descripcion']]]
				];
	
		}
		
		 echo Collapse::widget([
			'items' => $contenedores,
		]);
		 
		 
    }
	
	
	public function actionInfoPorcentajes($idProyecto)
	{
		
		$proyectos = new EcProyectos();
		$proyectos = $proyectos->find()->andWhere("id = $idProyecto")->orderby("id")->all();
		// $proyectos = $proyectos->find()->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		
		$idsPreguntaPorcentajeAvance = new Parametro();
		$idsPreguntaPorcentajeAvance = $idsPreguntaPorcentajeAvance->find()->orderby("id")->andWhere("id in(128,129,130,131,132,133,134,135,136,137,138,139,140)")->all();
		// $idsPreguntaPorcentajeAvance = ArrayHelper::map($idsPreguntaPorcentajeAvance,'id','descripcion');
		
		
		$result = ArrayHelper::getColumn($idsPreguntaPorcentajeAvance, function ($element) {
				return $element['descripcion'];
			});
			
		// $arrayColorPanel = array
		// (
			// "panel panel-danger",
			// "panel panel-success",
			// "panel panel-primary",
			// "panel panel-info",
		// );
		
		
		$arrayColores = array
		(
			1=>"panel panel-danger",
			3=>"panel panel-info",
			2=>"panel panel-success",
			4=>"panel panel-warning"
		);
		$cont=0;
		$bandera = 0;
		
		$html ="";
		foreach($proyectos as $pro)
		{
			
			$html.= "<div class='".$arrayColores[$idProyecto]."'><div class='panel-heading'> 
							<h3 class='panel-title'>$pro</h3> 
							<div class='panel-body'>
							</div>
							</div>";
							
		//muestra las preguntas de los porcentajes de avance de 4 en 4
			for($i=0;;$i++)
			{
				$bandera++;
				$html .= array_shift($result)."
				<div id='myProgress'>
					<div id='porcentajeAvance$bandera' class='myBar'>0%</div> 
				</div>
				<br>";
				if($bandera % 4 == 0 or $bandera ==13)					
					break;
			}
			
			$html.= "</div>";
			$cont++;
		}
		
		echo json_encode( $html);
		// echo $json_encode();
		
	}

	public function obtenerParametros()
	{
		//parametros de Fases informe planeación IEO
		$dataParametros = Parametro::find()
						->where( 'id_tipo_parametro=24' )
						->andWhere( 'estado=1' )
						->orderby( 'id' )
						->all();
						
		$parametros		= ArrayHelper::map( $dataParametros, 'id', 'descripcion' );
		
		return $parametros;
	
	}

    /**
     * Lists all EcInformePlaneacionIeo models.
     * @return mixed
     */
    public function actionIndex($idTipoInforme)
    {
		$idSedes 		= $_SESSION['sede'][0];
        $searchModel = new EcInformePlaneacionIeoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( "estado=1 and id_sede= $idSedes and id_tipo_informe = $idTipoInforme" ); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function obtenerSedes()
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
	
	public function obtenerZonaEducativa()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$idZonaEducativa = Instituciones::findOne( $idInstitucion )->id_zona_educativa;
		$zonaEducativa  = ZonasEducativas::find()->where(" estado=1 and id = $idZonaEducativa " )->all();
        $zonaEducativa  = ArrayHelper::map( $zonaEducativa, 'id', 'descripcion' );
		
		return $zonaEducativa;
	}
    /**
     * Displays a single EcInformePlaneacionIeo model.
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

	
	public function obtenerPorcentajes($post)
	{
		
		$estado1 = 0;
		$estado2 = 0;
		$estado3 = 0;
		$estado4 = 0;
		$estado5 = 0;
		$estado6 = 0;
		$estado7 = 0;
		$estado8 = 0;
		$estado9 = 0;
		$estado10 = 0;
		$estado11 = 0;
		$estado12 = 0;
		$estado13 = 0;
		$contador=0;
		foreach ($post['EcAvances'] as $avances)
		{
			$contador++;
			// echo $contador;
				
			switch ($contador) 
			{
				case 1:
				case 2:
				case 3:
				$estado1 += $avances['estado_actual'];
				break;
				
				case 4:
				case 5:
				case 6:
				$estado2 += $avances['estado_actual'];
				break;
				
				case 7:
				case 8:
				case 9:
				$estado3 += $avances['estado_actual'];
				break;
			
				case 10:
				case 11:
				case 12:
				$estado4 += $avances['estado_actual'];
				break;
				
				case 13:
				case 14:
				case 15:
				$estado5 += $avances['estado_actual'];
				break;
				
				case 16:
				case 17:
				case 18:
				$estado6 += $avances['estado_actual'];
				break;
				
				case 19:
				case 20:
				case 21:
				$estado7 += $avances['estado_actual'];
				break;
				
				case 22:
				case 23:
				case 24:
				$estado8 += $avances['estado_actual'];
				break;
				
				case 25:
				case 26:
				case 27:
				$estado9 += $avances['estado_actual'];
				break;
				
				case 28:
				case 29:
				case 30:
				case 31:
				case 32:
				$estado10 += $avances['estado_actual'];
				break;
				
			}
			
		}
		$porcentajeAvances1 = explode(".", ($estado1 / 12*100));
		$porcentajeAvances2 = explode(".", ($estado2 / 12*100));
		$porcentajeAvances3 = explode(".", ($estado3 / 20*100));
		$porcentajeAvances4 = explode(".", ($estado4 / 12*100));
		$porcentajeAvances5 = explode(".", ($estado5 / 12*100));
		$porcentajeAvances6 = explode(".", ($estado6 / 12*100));
		$porcentajeAvances7 = explode(".", ($estado7 / 12*100));
		$porcentajeAvances8 = explode(".", ($estado8 / 12*100));
		$porcentajeAvances9 = explode(".", ($estado9 / 12*100));
		$porcentajeAvances10 = explode(".", ($estado10 / 12*100));
		
		
		
		$contador=0;
		
		
		
		foreach ($post['EcRespuestas'] as $respuestas)
		{
			$contador++;
				
			switch ($contador) 
			{
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				$estado11 += $respuestas['respuesta'];
				break;
				
				case 6:
				case 7:
				case 8:
				case 9:
				case 10:
				case 11:
				$estado12 += $respuestas['respuesta'];
				break;
				
				case 12:
				case 13:
				case 14:
				case 15:
				case 16:
				case 17:
				$estado13 += $respuestas['respuesta'];
				break;
		
			}	
		}
		
		$porcentajeRespuestas4 = explode(".", ($estado11 / 20*100));
		$porcentajeRespuestas5 = explode(".", ($estado12 / 24*100));
		$porcentajeRespuestas6 = explode(".", ($estado13 / 24*100));
		
	
		$arrayPorcentajes = array
		(
			$porcentajeAvances1[0], 
			$porcentajeAvances2[0], 
			$porcentajeAvances3[0],
			$porcentajeRespuestas4[0],		
			$porcentajeAvances4[0],
			$porcentajeAvances5[0], 
			$porcentajeAvances6[0],
			$porcentajeRespuestas5[0],
			$porcentajeAvances7[0],
			$porcentajeAvances8[0],
			$porcentajeAvances9[0],
			$porcentajeRespuestas6[0],
			$porcentajeAvances10[0]
		);
		
		// echo "<pre>"; print_r($arrayPorcentajes ); echo "</pre>"; 
			// die;
		return $arrayPorcentajes;
	}
    /**
     * Creates a new EcInformePlaneacionIeo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idTipoInforme)
    {
        $model = new EcInformePlaneacionIeo();

        if ($model->load(Yii::$app->request->post())) 
		{
			
			$model->save();
			$post = Yii::$app->request->post();
			
			$idInforme = $model->id;
			$porcentajes = $this->obtenerPorcentajes($post);
			
			//ids en tabla parametros
			$idsPreguntaPorcentajeAvance = array
			(
				128,
				129,
				130,
				131,
				132,
				133,
				134,
				135,
				136,
				137,
				138,
				139,
				140,
			);
			
			//id de la tabla procesos y cada 3 el id de la tabla productos
			$idProcesos = array
			(
				2,
				1,
				4,
				1,
				6,
				5,
				9,
				2,
				10,
				11,
				13,
				3,
				8,
			);
			for($i=0;$i<= count($porcentajes)-1;$i++)
			{
				$modelPorcentajes = new EcPorcentajeAvance();
				//cada tercer id se inserta en el campo productos
				if($i == 3 or $i == 7 or $i== 11)
				{
					$modelPorcentajes->id_productos = $idProcesos[$i];
					// $modelPorcentajes->id_proceso = 0;
				}
				else
				{
					// echo $i;
					// $modelPorcentajes->id_proceso = 0;
					$modelPorcentajes->id_proceso = $idProcesos[$i];
				}
				
				$modelPorcentajes->id_pregunta_porcentaje_avance = $idsPreguntaPorcentajeAvance[$i]; 
				$modelPorcentajes->id_informe_planeacion = $idInforme;
				$modelPorcentajes->fecha_avance = date("Y-m-d H:i:s");
				$modelPorcentajes->porcentaje = $porcentajes[$i];
				$modelPorcentajes->save();
			}
			$arrayDatosEcAvances = $post['EcAvances'];
			
			//se agrega el id del informe despues de haber sido creado 
			foreach($arrayDatosEcAvances as $datos => $valores)
			{
				$arrayDatosEcAvances[$datos]['id_informe']=$model->id;
			}
			
			$columnNameArrayEcAvances=['estado_actual','logros','retos','argumentos','id_acciones','estado','id_informe'];
			
			// inserta todos los datos que trae el array en posicon EcAvances
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'ec.avances', $columnNameArrayEcAvances, $arrayDatosEcAvances
                     )
					 ->execute();
					 
			$arrayDatosEcRespuestas = $post['EcRespuestas'];
			
				//se agrega el id del informe despues de haber sido creado 
			foreach($arrayDatosEcRespuestas as $datos => $valores)
			{
				$arrayDatosEcRespuestas[$datos]['id_informe']=$idInforme;
			}
			
			$columnNameArrayEcRespuestas=['respuesta','id_estrategia','estado','id_informe'];
			//inserta todos los datos que trae el array en posicon EcRespuestas
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'ec.respuestas', $columnNameArrayEcRespuestas, $arrayDatosEcRespuestas
                     )
					 ->execute();
			
			
			$arrayDatosEcInformePlaneacionProyectos = $post['EcInformePlaneacionProyectos'];
			
			//se agrega el id del informe despues de haber sido creado 
			foreach($arrayDatosEcInformePlaneacionProyectos as $datose => $valorese)
			{
				$arrayDatosEcInformePlaneacionProyectos[$datose]['id_informe']=$idInforme;
			}

			$columnNameArrayEcInformePlaneacionProyectos=['horario_de_trabajo_docentes','id_proyecto','estado','id_informe_planeacion'];
			
			// inserta todos los datos que trae el array en posicon EcInformePlaneacionProyectos
			$insertCount = Yii::$app->db->createCommand()
                   ->batchInsert(
                         'ec.informe_planeacion_proyectos', $columnNameArrayEcInformePlaneacionProyectos, $arrayDatosEcInformePlaneacionProyectos
                     )
					 ->execute();
			
			
            return $this->redirect(['index','idTipoInforme'=>$idTipoInforme,'guardado'=>1]);
        }

	
		
		$idSedes 		= $_SESSION['sede'][0];
		
		$sedes = Sedes::findOne($idSedes );
		$idSedesComunas = @$sedes->comuna; 
		$idSedesBarrios = @$sedes->id_barrios_veredas;
		$codigoDane = @$sedes->codigo_dane;
		
		$comunas  = ComunasCorregimientos::find()->where( 'estado=1' )->all();
        $comunas	 = ArrayHelper::map( $comunas, 'id', 'descripcion' );
		
        return $this->renderAjax('create', [
			'model' => $model,           
			'comunas' => $comunas,
			'sedes'=> $this->obtenerSedes(),
			'instituciones' => $this->obtenerInstituciones(),
			'fases' =>$this->obtenerParametros(),
			'codigoDane' => $codigoDane,
			'zonaEducativa' => $this->obtenerZonaEducativa(),
			
        ]);
    }

    /**
     * Updates an existing EcInformePlaneacionIeo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) 
		{
			
			$model->save();
			$post = Yii::$app->request->post();
			
			$porcentajes = $this->obtenerPorcentajes($post);
			// echo "<pre>"; print_r($porcentajes); echo "</pre>"; 
			
			// die;
		
			$idInforme = $model->id;
			$idTipoInforme = $model->id_tipo_informe;
			//ids en tabla parametros
			$idsPreguntaPorcentajeAvance = array
			(
				128,
				129,
				130,
				131,
				132,
				133,
				134,
				135,
				136,
				137,
				138,
				139,
				140,
			);
			
			//id de la tabla procesos y cada 3 el id de la tabla productos
			$idProcesos = array
			(
				2,
				1,
				4,
				1,
				6,
				5,
				9,
				2,
				10,
				11,
				13,
				3,
				8,
			);
			for($i=0;$i<= count($porcentajes)-1;$i++)
			{
				$modelPorcentajes = new EcPorcentajeAvance();
				//cada tercer id se inserta en el campo productos
				if($i == 3 or $i == 7 or $i== 11)
				{
					$modelPorcentajes->id_productos = $idProcesos[$i];
					// $modelPorcentajes->id_proceso = 0;
				}
				else
				{
					// echo $i;
					// $modelPorcentajes->id_proceso = 0;
					$modelPorcentajes->id_proceso = $idProcesos[$i];
				}
				$modelPorcentajes->id_pregunta_porcentaje_avance = $idsPreguntaPorcentajeAvance[$i]; 
				$modelPorcentajes->id_informe_planeacion = $idInforme;
				$modelPorcentajes->fecha_avance = date("Y-m-d H:i:s");
				$modelPorcentajes->porcentaje = $porcentajes[$i];
				$modelPorcentajes->save();
			}
			

			$arrayDatosEcAvances = $post['EcAvances'];
			
			//se agrega el id del informe despues de haber sido creado 
			$connection = Yii::$app->getDb();
			foreach($arrayDatosEcAvances as $idAcciones => $valores)
			{
				$arrayDatosEcAvances[$idAcciones]['id_informe']=$idInforme;
				
				$command = $connection->createCommand
				(" 
					UPDATE ec.avances set 			
					estado_actual 	='". $valores['estado_actual']."',
					logros			='" .$valores['logros']."',
					retos			='". $valores['retos']."',
					argumentos		='". $valores['argumentos']."'
					WHERE id_acciones = $idAcciones and id_informe = $idInforme
				");
				$result = $command->queryAll();
			}
			
					 
			$arrayDatosEcRespuestas = $post['EcRespuestas'];
			
			foreach($arrayDatosEcRespuestas as $idRespuestas => $val)
			{
				$command = $connection->createCommand
				(" 
					UPDATE ec.respuestas set 			
					respuesta		='". $val['respuesta']."'
					WHERE id_estrategia = $idRespuestas and id_informe = $idInforme
				");
				$result = $command->queryAll();
			}
			
			$arrayDatosEcInformePlaneacionProyectos = $post['EcInformePlaneacionProyectos'];
			
			foreach($arrayDatosEcInformePlaneacionProyectos as $idRespuestas => $val)
			{
				$command = $connection->createCommand
				(" 
					UPDATE ec.informe_planeacion_proyectos set 			
					horario_de_trabajo_docentes		='". $val['horario_de_trabajo_docentes']."'
					WHERE id_informe_planeacion = $idInforme and id_proyecto =  $idRespuestas
				");
				$result = $command->queryAll();
			}
			
            return $this->redirect(['index','idTipoInforme'=>$idTipoInforme,'guardado'=>1]);
        }

		$idSedes 		= $_SESSION['sede'][0];
		$sedes = Sedes::findOne($idSedes );
		
		
		$ecAvances = new EcAvances();
		$ecAvances = $ecAvances->find()->orderby("id")->andWhere("id_informe=$id")->all();
		
		//se trae la informacionde la basse de datos tabla ec.avances
		$result = ArrayHelper::getColumn($ecAvances, function ($element) 
		{
			$dato[$element['id_acciones']]['estado_actual']= $element['estado_actual'];
			$dato[$element['id_acciones']]['logros']= $element['logros'];
			$dato[$element['id_acciones']]['retos']= $element['retos'];
			$dato[$element['id_acciones']]['argumentos']= $element['argumentos'];
			return $dato;
		});
		
		
		//se formate la informacion que deben tener los campos tabla ec.avances
		foreach	($result as $r => $valor)
		{
			foreach	($valor as $ids => $valores)
				
				$datos[$ids] = $valores;
		}
			
		$ecRespuestas = new EcRespuestas();
		$ecRespuestas = $ecRespuestas->find()->orderby("id")->andWhere("id_informe=$id")->all();
		$datoRespuesta = ArrayHelper::map($ecRespuestas,'id_estrategia','respuesta');

		$ecInformePlaneacionProyectos= new EcInformePlaneacionProyectos();
		$ecInformePlaneacionProyectos = $ecInformePlaneacionProyectos->find()->orderby("id")->andWhere("id_informe_planeacion=$id")->all();
		$datoInformePlaneacionProyectos = ArrayHelper::map($ecInformePlaneacionProyectos,'id_proyecto','horario_de_trabajo_docentes');
		
		
		//se formate la informacion que deben tener los campos tabla ec.avances
		
		
		
		$idSedesComunas = @$sedes->comuna; 
		$idSedesBarrios = @$sedes->id_barrios_veredas;
		$codigoDane = @$sedes->codigo_dane;
		
		$comunas  = ComunasCorregimientos::find()->where( 'estado=1' )->all();
        $comunas	 = ArrayHelper::map( $comunas, 'id', 'descripcion' );
		
		$informacoin;
        return $this->renderAjax('update', [
            'model' => $model,
			'comunas' => $comunas,
			'sedes'=> $this->obtenerSedes(),
			'instituciones' => $this->obtenerInstituciones(),
			'fases' =>$this->obtenerParametros(),
			'codigoDane' => $codigoDane,
			'datos'=>$datos,
			'datoRespuesta'=>$datoRespuesta,
			'datoInformePlaneacionProyectos'=>$datoInformePlaneacionProyectos,
			'zonaEducativa' => $this->obtenerZonaEducativa(),
			
        ]);
    }

    /**
     * Deletes an existing EcInformePlaneacionIeo model.
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

        return $this->redirect(['index','guardado' => 1]);
    }

    /**
     * Finds the EcInformePlaneacionIeo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EcInformePlaneacionIeo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EcInformePlaneacionIeo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
