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
use app\models\CbacPlanMisionalOperativo;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\CbacPmoActividades;
use app\models\PerfilesXPersonas;
use app\models\CbacIntervencionIeo;
use app\models\CbacEquiposCampo;
use app\models\Perfiles;
use app\models\CbacProyectosCbac;
use app\models\CbacRequerimientosLogisticos;
use app\models\CbacRequerimientosTecnicos;	
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CbacPlanMisionalOperativoController implements the CRUD actions for CbacPlanMisionalOperativo model.
 */
class CbacPlanMisionalOperativoController extends Controller
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
     * Lists all CbacPlanMisionalOperativo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CbacPlanMisionalOperativo::find()->andWhere("estado =1")->orderby("id"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
        ]);
    }

    /**
     * Displays a single CbacPlanMisionalOperativo model.
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

    function actionViewFases($model, $form){
        
        $actividades_pom = new CbacPmoActividades();
        $intervencionIeo = new CbacIntervencionIeo();
        
		
		$proyectos = new CbacProyectosCbac();
		$proyectos = $proyectos->find()->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		$ciclos = 
		[
			1 => "Caracterización",
			2 => "Diseño e implementación de planes de acción",
			3 => "Recepción activa y proyección de acciones",
			4 => "Procesos de creación",
			5 => "Procesos de socialización",
			6 => "Evaluación artística participativa",
			7 => "Evaluación",
			8 => "Nuevos proyectos"
		];
		
		$reqTecnicos = 
		[
			1 =>"Acuarela Escolar (x 12) Buss Pelikan",
			2 =>"Acetatos en Octavos x 20 octavos",
			3 =>"Bastidor Marco 20 x 20",
			4 =>"block para dibujo de 20 hojas",
			5 =>"Borrador De Nata",
			6 =>"Caja de lápices",
			7 =>"Caja marcadores permanentes x 6 colores surtidos",
			8 =>"Caja de clips",
			9 =>"Caja de colores x 12 colores",
			10 =>"Caja de colores stanford Recreo Bicolor 12/24",
			11 =>"Caja de crayones x 12 unidades",
			12 =>"Caja de lapiceros negros x 12 unidades",
			13 =>"Caja de marcadores de punta fina x 6 colores surtidos",
			14 =>"Caja Plumon Magicolor x 12 Delgado",
			15 =>"Caja Plumon Est. Colorella Star x 12 (1217)",
			16 =>"Caja Pomo Triangular para maquillaje x 8",
			17 =>"Caja de tizas grandes x 8 colores surtidos",
			18 =>"Caja de tizas pequeñas x 10 colores surtidos",
			19 =>"Caja de vinilos x 6 colores surtidos",
			20 =>"Carton Paja Crema 1/8",
			21 =>"Cartón paja pliego",
			22 =>"Cartulina Bristol 1/8",
			23 =>"Cartulina legajadora x 25 unidades",
			24 =>"Cinta de enmascarar 18mm x 40 mts",
			25 =>"Cinta de enmascarar 12mm x 40 mts",
			26 =>"Cuaderno linea corriente 100 hojas",
			27 =>"Cuaderno cuadriculados 100 hojas",
			28 =>"Escarcha x 200 grs",
			29 =>"Escarapela sencilla",
			30 =>"Fomi en 1/8",
			31 =>"Gancho legajador",
			32 =>"Kit de pinceles #3 #6 #7",
			33 =>"Lana Escolar 16 GR Azul Oscuro #2",
			34 =>"Lana en ovillo 15 grs",
			35 =>"Lapiz Delineador de ojos café",
			36 =>"Lapiz Delineador de ojos negro",
			37 =>"Lapiz #2 HB",
			38 =>"Lapiz #2 B",
			39 =>"Marcador borrable negro",
			40 =>"Marcador borrable azul",
			41 =>"Marcador borrable verde",
			42 =>"Marcador borrable rojo",
			43 =>"Marcador permanente Azul",
			44 =>"Marcador permanente Negro",
			45 =>"Marcador permanente Rojo",
			46 =>"Marcador permanente Verde",
			47 =>"Nylon 1 mm x 100 mts",
			48 =>"palestras para mezclar el vinilo",
			49 =>"Palo Paleta corto (x1000) Lastra",
			50 =>"Papel silueta x8 unidades en tamaño 1/8",
			51 =>"Paquete de letras didacticas",
			52 =>"Pegante liquido x 4000 grs",
			53 =>"Pegante liquido x 1000 grs",
			54 =>"Pegante liquido x 20 Litros",
			55 =>"Pega stic x 20 grs",
			56 =>"Pincel Maquillaje Kit 4ref",
			57 =>"Pincel Redondo 582 #5 Tipo Eterna",
			58 =>"Pinceles Cerdas Suaves Juego X 6 Unidades",
			59 =>"Pintucarita surtido x 12 GRAL",
			60 =>"Piola",
			61 =>"Platilina en barra x 200 grs",
			62 =>"Porcelanicrón barra x 250 grs",
			63 =>"Post it",
			64 =>"Regla x 30 cms",
			65 =>"Regla x 15 cms",
			66 =>"Resaltador Berol Amarillo",
			67 =>"Resaltador Berol Azul",
			68 =>"Resaltador Berol Fuscia",
			69 =>"Resaltador Berol Naranja",
			70 =>"Resaltador Berol Verde",
			71 =>"Resma de papel tamaño carta",
			72 =>"Rollo de papel kraff",
			73 =>"Stikers de letras y figuras",
			74 =>"Tabla legajadora oficio azul",
			75 =>"Tabla legajadora oficio verde",
			76 =>"Tabla legajadora oficio roja",
			77 =>"Taja lapiz",
			78 =>"Tijeras punta roma",
			79 =>"Vinilo rojo 260 cc",
			80 =>"Vinilo amarillo 260 cc",
			81 =>"Vinilo azul 260 cc",
			82 =>"Vinilo blanco 260 cc",
			83 =>"Vinilo negro 260 cc",
		];
		
		$reqLogisticos =
		[
			1 => "Transporte",
			2 => "Refrigerio",
		];
		
		$PerfilesXPersonas = PerfilesXPersonas::findOne($_SESSION['perfilesxpersonas']);
		$perfil = Perfiles::findOne($PerfilesXPersonas->id_perfiles);
		$rol[$perfil->id]  = $perfil->descripcion;
		
		
		
		return $this->renderAjax('fases', [
            'proyectos' => $proyectos,
            'form' => $form,
            "model" => $model,
            'actividades_pom' => $actividades_pom,
			'arraySiNo' => $this->arraySiNo,
			'rol'			  => $rol,
			'reqLogisticos'  => $reqLogisticos,
			'reqTecnicos' => $reqTecnicos,
			'equiposCampo' => $this->obtenerEquiposCampo(),
			'intervencionIeo' =>  $intervencionIeo,
			'perfiles' => $this->obtenerPefiles(),
																
        ]);
		
	}

    /**
     * Creates a new CbacPlanMisionalOperativo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacPlanMisionalOperativo();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

		
        if ($model->load(Yii::$app->request->post())) 
		{
            
			$contador = [];
			foreach( Yii::$app->request->post()['CbacIntervencionIeo'] as $key =>  $interIEO)
			{
				if(@$interIEO['perfiles'] != null && @$interIEO['nombre_actividad'] != "")
				{
					$contador[] = $key;
				}
			}
			
			if(count($contador) > 0 )
			{
				$model->id_institucion = $idInstitucion;
				if($model->save())
				{
					foreach ($contador as $cont)
					{
						if (Yii::$app->request->post('CbacPmoActividades'))
						{
							$data = Yii::$app->request->post('CbacPmoActividades');
							$count 	= count($data);
							$modelActividades = [];
							
							$modelActividades[$cont] = new CbacPmoActividades();
							
							if (CbacPmoActividades::loadMultiple($modelActividades, Yii::$app->request->post() )) 
							{
								foreach( $modelActividades as $key => $modelActividad) 
								{
									$modelActividad->id_pmo = $model->id;
									$modelActividad->save(false);
									$idActividades[$key] = $modelActividad->id;
								}
							}
						}
						
						$intervencionModel[$cont] = new CbacIntervencionIeo();
					
						if (CbacIntervencionIeo::loadMultiple($intervencionModel, Yii::$app->request->post())) 
						{
							//se llena los perfiles separados por comas //se pasa de selecion unica a mutiple
							$postIEO = Yii::$app->request->post()['CbacIntervencionIeo'];
							
							foreach ($intervencionModel as $key => $intervencion) 
							{
								if(@$postIEO[$key]['perfiles'] != null && $intervencion->nombre_actividad != "" )
								{
									$intervencion->perfiles = implode(",",$postIEO[$key]['perfiles']); 
									$intervencion->id_pmo_actividades = $idActividades[$key];
									$intervencion->save(false);
									// $controller = RomReporteOperativoMisionalController::crearReporteOperativoMisional($intervencion->id);
								}
							}
						}
						
						
					}
					
					if (@Yii::$app->request->post()['requerimientos'])
					{
						//guardar los Requerimientos Técnicos 
						foreach(Yii::$app->request->post()['requerimientos'] as $requerimientos )
						{
							foreach ($requerimientos as $idActividad => $requerimiento)
							{
								$idRequerimiento = key($requerimiento);
								$cantidaRequerimiento = $requerimiento[$idRequerimiento];
								
								$RT = new CbacRequerimientosTecnicos();
								$RT->id_requerimiento	= $idRequerimiento;
								$RT->cantidad 			= $cantidaRequerimiento;
								$RT->id_actividad 		= $idActividad;
								$RT->id_plan_misional_operativo = $model->id;
								$RT->save(false);
							}
						}
					}
						
					if (@Yii::$app->request->post()['reqLogisticos'])
					{
						$requerimientoLogisticos =[]; 
						foreach(Yii::$app->request->post()['reqLogisticos'] as $key => $requerimientosL )
						{
							foreach ($requerimientosL as $idActividad => $requerimiento)
							{
								$requerimientoLogisticos[$idActividad][key($requerimiento)][] =  $requerimiento[key($requerimiento)];
							}
						}
					
					
						foreach ($requerimientoLogisticos as $idActividad => $requerimientoLogistico)
						{
							foreach($requerimientoLogistico as $idRequerimiento => $requelog)
							{	
								$RL = new CbacRequerimientosLogisticos();
								$RL->id_requerimiento	= $idRequerimiento;
								$RL->cantidad 			= $requelog[0];
								$RL->id_actividad 		= $idActividad;
								$RL->dir_origen 		= @$requelog[1];
								$RL->dir_destino 		= @$requelog[2];
								$RL->id_plan_misional_operativo = $model->id;
								$RL->save(false);
							}
							
						}
					}
					return $this->redirect(['index', 'guardado' => 1 ]);
				}
				else
				{
					return $this->redirect(['index', 'error1' => 1]);
				}
			}
		}

        $Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );
		
        return $this->renderAjax('create', [
            'model' => $model,
            'sedes' => $sedes,
            'institucion' => $institucion->descripcion,
			'arraySiNo' => $this->arraySiNo,
        ]);
    }

    /**
     * Updates an existing CbacPlanMisionalOperativo model.
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
            
			
			$arrayRequerimientos = [];
			if (@Yii::$app->request->post()['requerimientos'])
			{
				foreach(Yii::$app->request->post()['requerimientos'] as $req )
				{
					//agrupa la informacion de los requerimintos con el id de la actividad 
					$arrayRequerimientos[key($req)][key($req[key($req)])]= $req[key($req)][key($req[key($req)])];
				}	
			
			
				//se borran los registros y luego se insertan nuevamente
				$models = CbacRequerimientosTecnicos::find()->where("id_plan_misional_operativo = $id")->all();
							foreach ($models as $model) {
								$model->delete();
							}
				foreach ($arrayRequerimientos as $idActividadReq => $arrayReq)
				{
					foreach ($arrayReq as $idReq => $cantidad)
					{
						$IRT = new CbacRequerimientosTecnicos();
						$IRT->id_requerimiento	= $idReq;
						$IRT->cantidad 			= $cantidad;
						$IRT->id_actividad 		= $idActividadReq;
						$IRT->id_plan_misional_operativo = $id;
						$IRT->save(false);
					}
				}
			}
			$arrayRequerimientosL = [];
			
			
			if (@Yii::$app->request->post()['reqLogisticos'])
			{
				foreach(Yii::$app->request->post()['reqLogisticos'] as $req )
				{
					//agrupa la informacion de los requerimintos con el id de la actividad 
					$arrayRequerimientosL[key($req)][key($req[key($req)])][]= $req[key($req)][key($req[key($req)])];
				}	
		
				//se borran los registros y luego se insertan nuevamente
				$models = CbacRequerimientosLogisticos::find()->where("id_plan_misional_operativo = $id")->all();
				
							foreach ($models as $model) {
								$model->delete();
							}
				foreach ($arrayRequerimientosL as $idActividadReqL => $arrayReq)
				{	
					foreach ($arrayReq as $idReqL => $datos)
					{
						
						$IRT = new CbacRequerimientosLogisticos();
						$IRT->id_requerimiento	= $idReqL;
						$IRT->cantidad 			= $datos[0];
						$IRT->dir_origen 		= @$datos[1];
						$IRT->dir_destino 		= @$datos[2];
						$IRT->id_actividad 		= $idActividadReqL;
						$IRT->id_plan_misional_operativo = $id;
						$IRT->save(false);
					}
				}
			
			}
			$actividades = IsaActividadesIsa::find()->indexBy('id')->andWhere("id_plan_misional_operativo = $id")->all();
			
			//id del Yii::$app->request->post() e id de actividades deben ser iguales
			$cont = 1;
			foreach($actividades as $key => $actividad)
			{
				$idActividades[] = $key;
				$actividadIsa[$cont] = $actividad;
				
				if ($cont == 2)
					$cont++;
				
				$cont++;
			}
			
			if (Model::loadMultiple($actividadIsa, Yii::$app->request->post()) && Model::validateMultiple($actividadIsa) ) 
			{
				foreach ($actividadIsa as $activIsa) 
				{
					$activIsa->requerimientos_tecnicos = null;
					$activIsa->save(false);
				}
			}
			
			$idActividades = implode(",",$idActividades); 
			$intervencionIeo = IsaIntervencionIeo::find()->indexBy('id')->andWhere("id_actividades_isa in ( $idActividades )")->all();
			
			//id del Yii::$app->request->post() e id de intervencionIeo deben ser iguales
			$cont = 1;
			foreach($intervencionIeo as $intervencion)
			{
				$intervencionIsa[$cont] = $intervencion;
				// actividades 1 2 4
				if ($cont == 2)
					$cont++;
				
				$cont++;
			}
			
			$postIEO = Yii::$app->request->post()['IsaIntervencionIeo'];
			
			foreach ($postIEO as $key => $inter )
			{
				if (isset($postIEO[$key]['perfiles']))
				{
					$perfiles[ $key ] =  implode(",",$postIEO[$key]['perfiles']);
				}
				else
				{
					$perfiles[ $key ] = "";
				}
			}
			 
			if (Model::loadMultiple($intervencionIsa, Yii::$app->request->post()) && Model::validateMultiple($intervencionIsa) ) 
			{
				foreach ($intervencionIsa as  $key => $interIsa) 
				{
					$interIsa->perfiles = $perfiles[$key];
					$interIsa->save(false);
				}	
			}	
			
			
			
			
            return $this->redirect(['index']);
        }

        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

        return $this->renderAjax('update', [
            'model' => $model,
            'sedes' => $this->obtenerSede(),
            'institucion' => $institucion->descripcion,
			'arraySiNo' => $this->arraySiNo,
        ]);
    }

	public function obtenerPefiles()
	{
		$idInstitucion 	= $_SESSION['instituciones'][0];
		/**
		* Llenar nombre de los cooordinadores-eje
		*/
		//variable con la conexion a la base de datos 
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
			SELECT pe.id, concat(pe.nombres,' ',pe.apellidos) as nombres, identificacion 
			FROM personas as pe
			ORDER BY id ASC LIMIT 160
		");
		
		
		$result = $command->queryAll();
		$nombresPerfil = array();
		foreach ($result as $r)
		{
			$nombresPerfil[$r['id']]= $r['nombres']." - ". $r['identificacion'] ;
		}
		
		return $nombresPerfil;
	}
	
	
	public function obtenerEquiposCampo()
	{
		$equiposCampo = new CbacEquiposCampo();
		$equiposCampo = $equiposCampo->find()->orderby("id")->andWhere("estado = 1")->all();
		$equiposCampo = ArrayHelper::map($equiposCampo,'id','nombre');
		return $equiposCampo;
	}
	
	
    public function obtenerSede()
	{
        $idInstitucion = $_SESSION['instituciones'][0];
		$Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );
		
		return $sedes;
    }


    /**
     * Deletes an existing CbacPlanMisionalOperativo model.
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
     * Finds the CbacPlanMisionalOperativo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacPlanMisionalOperativo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacPlanMisionalOperativo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
