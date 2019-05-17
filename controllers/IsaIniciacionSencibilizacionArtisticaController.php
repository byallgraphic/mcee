<?php

/**********
Versión: 001
Fecha: 06-05-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud orientacion proceseso 
---------------------------------------
Modificaciones:
Fecha: 06-05-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: guardar y editar
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
use app\models\IsaIniciacionSencibilizacionArtistica;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\IsaProyectosGenerales;
use app\models\IsaEquiposCampo;
use app\models\IsaIntervencionIeo;
use app\models\IsaRequerimientosTecnicos;
use yii\base\Model;

use yii\helpers\ArrayHelper;
use app\models\IsaActividadesIsa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;


/**
 * IsaIniciacionSencibilizacionArtisticaController implements the CRUD actions for IsaIniciacionSencibilizacionArtistica model.
 */
class IsaIniciacionSencibilizacionArtisticaController extends Controller
{
	
	public $arraySiNo = 
		[
			1 => "No",
			2 => "Si"		
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
		
		$id_sede 		= $_SESSION['sede'][0];
		$sede 		 = Sedes::findOne($id_sede);
        $dataProvider = new ActiveDataProvider([
            'query' => IsaIniciacionSencibilizacionArtistica::find()->andWhere("estado =1")->orderby("id"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
			'sede' => $sede
        ]);
    }

    function actionViewFases($model, $form)
	{
        
        $proyectos = new IsaProyectosGenerales();
        $actividades_isa = new IsaActividadesIsa();
        $intervencionIEO = new IsaIntervencionIeo();
		
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
																'docenteOrientador' => $this->obtenerDocenteOrientador(),
																'intervencionIEO' => $intervencionIEO,
																'ciclos' => $ciclos,
																'perfiles' => $this->obtenerPefiles(),
																'reqTecnicos' => $reqTecnicos
																
															] 
												),
							'contentOptions'=> [],
							
						];	
			
		}
		// echo tabs::widget([
			// 'items' => $items,
		// ]);
		
		
		echo Collapse::widget([
			'items' => $items,
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
			SELECT ppi.id, concat(pe.nombres,' ',pe.apellidos) as nombres
			FROM perfiles_x_personas as pp, 
			personas as pe,
			perfiles_x_personas_institucion ppi
			WHERE pp.id_personas = pe.id
			AND pp.id_perfiles = 11
			AND ppi.id_perfiles_x_persona = pp.id
			AND ppi.id_institucion = $idInstitucion
		");
		$result = $command->queryAll();
		$nombresPerfil = array();
		foreach ($result as $r)
		{
			$nombresPerfil[$r['id']]= $r['nombres'];
		}
		
		return $nombresPerfil;
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
		//
        if ($model->load(Yii::$app->request->post()) && $model->save() ) 
		{
			
			//guardar en la tabla isa.actividades_isa
			
				$actividadesModel[1] = new IsaActividadesIsa();
				$actividadesModel[2] = new IsaActividadesIsa();
				$actividadesModel[4] = new IsaActividadesIsa();
			

			if (IsaActividadesIsa::loadMultiple($actividadesModel, Yii::$app->request->post())) 
			{
				foreach ($actividadesModel as $key => $actividad) 
				{
					$actividad->id_iniciacion_sencibilizacion_artistica = $model->id;
					$actividad->requerimientos_tecnicos = null;
					$actividad->save(false);
					
					$idActividades[$key] = $actividad->id;
				}
			}
			
				$intervencionModel[1] = new IsaIntervencionIeo();
				$intervencionModel[2] = new IsaIntervencionIeo();
				$intervencionModel[4] = new IsaIntervencionIeo();
			

			if (IsaIntervencionIeo::loadMultiple($intervencionModel, Yii::$app->request->post())) 
			{
				foreach ($intervencionModel as $key => $intervencion) 
				{
					$intervencion->id_actividades_isa = $idActividades[$key];
					$intervencion->save(false);
				}
			}
			
			//guardar los Requerimientos Técnicos 
			foreach(Yii::$app->request->post()['requerimientos'] as $requerimientos )
			{
				foreach ($requerimientos as $idActividad => $requerimiento)
				{
					$idRequerimiento = key($requerimiento);
					$cantidaRequerimiento = $requerimiento[$idRequerimiento];
					
					$IRT = new IsaRequerimientosTecnicos();
					$IRT->id_requerimiento	= $idRequerimiento;
					$IRT->cantidad 			= $cantidaRequerimiento;
					$IRT->id_actividad 		= $idActividad;
					$IRT->id_iniciacion_sencibilizacion_artistica = $model->id;
					$IRT->save(false);
				}
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
	
	
	public function actionStore()
	{

        $postDatos = Yii::$app->request->post();
		
		$model = new IsaIniciacionSencibilizacionArtistica();

		$model->id_institucion 			= $postDatos['id_institucion'];
		$model->id_sede 				= $postDatos['id_sede'];
		$model->caracterizacion_si_no 	= $postDatos['caracterizacion_si_no'];
		$model->caracterizacion_nombre 	= $postDatos['caracterizacion_nombre'];
		$model->caracterizacion_fecha 	= $postDatos['caracterizacion_fecha'];
		$model->caracterizacion_justificacion = $postDatos['caracterizacion_justificacion'];
		$model->estado 					= 1;
		$model->save(false);
		
		$intervencionIEO = json_decode($postDatos['intervencion_ieo']);
		unset($intervencionIEO[0]);
		unset($intervencionIEO[3]);
		
		// echo "<pre>"; print_r($intervencionIEO); echo "</pre>";
		
		$activadesIsa = json_decode($postDatos['activadesIsa']);
		unset($activadesIsa[0]);
		unset($activadesIsa[3]);
		
		foreach($activadesIsa as $key => $actividadI)
		{
			$aIsa = new IsaActividadesIsa();
			
			$aIsa->id_iniciacion_sencibilizacion_artistica = $model->id;
			$aIsa->id_procesos_generales 		= $key ;
			$aIsa->fecha_prevista_desde 		= $actividadI->fecha_prevista_desde;
			$aIsa->fecha_prevista_hasta 		= $actividadI->fecha_prevista_hasta;
			$aIsa->contenido_si_no 				= $actividadI->contenido_si_no;
			$aIsa->contenido_nombre 			= $actividadI->contenido_nombre;
			$aIsa->contenido_fecha 				= $actividadI->contenido_fecha;
			$aIsa->contenido_justificacion 		= $actividadI->contenido_justificacion;
			$aIsa->articulacion 				= $actividadI->articulacion;
			$aIsa->cantidad_participantes 		= $actividadI->cantidad_participantes;
			$aIsa->requerimientos_tecnicos 		= $actividadI->requerimientos_tecnicos;
			$aIsa->requerimientos_logisticos 	= $actividadI->requerimientos_logisticos;
			$aIsa->destinatarios 				= $actividadI->destinatarios;
			$aIsa->fecha_entrega_envio 			= $actividadI->fecha_entrega_envio;
			$aIsa->observaciones_generales 		= $actividadI->observaciones_generales;
			$aIsa->nombre_diligencia 			= $actividadI->nombre_diligencia;
			$aIsa->rol 							= $actividadI->rol;
			$aIsa->fecha 						= $actividadI->fecha;
			$aIsa->id_procesos_generales 		= $actividadI->id_procesos_generales;
			
			$aIsa->save(false);
			
			
			$ieo = new IsaIntervencionIeo();
			$ieo->perfiles 				= $intervencionIEO[$key]->perfiles;
			$ieo->docente_orientador 	= implode(",",$intervencionIEO[$key]->docente_orientador);
			$ieo->fases 				= $intervencionIEO[$key]->fases;
			$ieo->num_encuentro 		= $intervencionIEO[$key]->num_encuentro;
			$ieo->nombre_actividad 		= $intervencionIEO[$key]->nombre_actividad;
			$ieo->actividad_desarrollar = $intervencionIEO[$key]->actividad_desarrollar;
			$ieo->lugares_recorrer 		= $intervencionIEO[$key]->lugares_recorrer;
			$ieo->tematicas_abordadas 	= $intervencionIEO[$key]->tematicas_abordadas;
			$ieo->objetivos_especificos = $intervencionIEO[$key]->objetivos_especificos;
			$ieo->tiempo_previsto 		= $intervencionIEO[$key]->tiempo_previsto;
			$ieo->id_actividades_isa	= $aIsa->id;
			$ieo->id_equipo_campos 		= $intervencionIEO[$key]->id_equipos_campo;
			$ieo->productos 			= $intervencionIEO[$key]->productos;
			$ieo->save(false);
			
			
		}

        Yii::$app->session->setFlash('ok');
        // return 'ok';
		return $this->redirect(['index', 'guardado' => 1]);
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
			$requerimientos = new IsaRequerimientosTecnicos();
			$requerimientos = $requerimientos->find()->orderby("id")->andWhere("id_iniciacion_sencibilizacion_artistica = $id")->all();
			$requerimientos = ArrayHelper::map($requerimientos,'id_requerimiento','cantidad','id_actividad');
		
			
			$arrayRequerimientos = [];
			foreach(Yii::$app->request->post()['requerimientos'] as $req )
			{
				//agrupa la informacion de los requerimintos con el id de la actividad 
				$arrayRequerimientos[key($req)][key($req[key($req)])]= $req[key($req)][key($req[key($req)])];
			}	
		
			$eliminar = [];
			$insertar = [];
			foreach ($arrayRequerimientos as $key => $arrayReq)
			{
				
				if ( isset($requerimientos[$key] ))
				{
					$eliminar = array_diff_assoc($arrayReq,$requerimientos[$key]);
					$insertar = array_diff_assoc($requerimientos[$key],$arrayReq);
					
					echo "<pre>"; print_r($eliminar); echo "</pre>"; 
					echo "<pre>"; print_r($insertar); echo "</pre>"; 
					
					
					foreach ($eliminar as $key => $delete)
					{
						
					}
				}
				elseif ( !isset($requerimientos[$key]) )
				{
					//si no existe $requerimientos[$key] es porque no existe nada en la base de datos y se inserta todo
					$insertar = $arrayReq;
					foreach ($insertar as $key => $cantidad)
					{
						$IRT = new IsaRequerimientosTecnicos();
						$IRT->id_requerimiento	= $key;
						$IRT->cantidad 			= $cantidad;
						$IRT->id_actividad 		= $key;
						$IRT->id_iniciacion_sencibilizacion_artistica = $id;
						$IRT->save(false);
					}
					
				}
				
				
				
			}
			
			$reqTec = IsaRequerimientosTecnicos::find()->orderby("id")->andWhere("id_iniciacion_sencibilizacion_artistica = $id and id_requerimiento = 3")->all();
			$reqTec = ArrayHelper::getColumn($reqTec,'id');
			
			$reqTec = IsaRequerimientosTecnicos::findOne( $reqTec[0]);
			$reqTec->cantidad = 10;
			$reqTec->save(false);
			// foreach ($requerimientos as $idActividad => $requerimiento)
				// {
					// $idRequerimiento = key($requerimiento);
					// $cantidaRequerimiento = $requerimiento[$idRequerimiento];
					
					// $IRT = new IsaRequerimientosTecnicos();
					// $IRT->id_requerimiento	= $idRequerimiento;
					// $IRT->cantidad 			= $cantidaRequerimiento;
					// $IRT->id_actividad 		= $idActividad;
					// $IRT->id_iniciacion_sencibilizacion_artistica = $model->id;
					// $IRT->save(false);
				// }
			
		
			
			
			
			
			die;
			$actividades = IsaActividadesIsa::find()->indexBy('id')->andWhere("id_iniciacion_sencibilizacion_artistica = $id")->all();
			
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
			
			if (Model::loadMultiple($intervencionIsa, Yii::$app->request->post()) && Model::validateMultiple($intervencionIsa) ) 
			{
				foreach ($intervencionIsa as $interIsa) 
				{
					$interIsa->save(false);
				}
			}			
			return $this->redirect(['index','guardado' => 1]);
			
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
		$idSedes = $_SESSION['sede'][0];
		$sedes = new Sedes();
		$sedes = $sedes->find()->where("id =  $idSedes")->all();
		$sedes = ArrayHelper::map($sedes,'id','descripcion');
		
		return $sedes;
	}
	
	public function obtenerEquiposCampo()
	{
		$equiposCampo = new IsaEquiposCampo();
		$equiposCampo = $equiposCampo->find()->orderby("id")->andWhere("estado = 1")->all();
		$equiposCampo = ArrayHelper::map($equiposCampo,'id','nombre');
		return $equiposCampo;
	}
	
	// public function obtenerEquiposCampo()
	// {
		// $equiposCampo = new IsaEquiposCampo();
		// $equiposCampo = $equiposCampo->find()->orderby("id")->andWhere("estado = 1")->all();
		// $equiposCampo = ArrayHelper::map($equiposCampo,'id','nombre');
		// return $equiposCampo;
	// }
	
	
	public function actionRequerimientos($id)
	{
		$requerimientos = new IsaRequerimientosTecnicos();
		$requerimientos = $requerimientos->find()->orderby("id")->andWhere("id_iniciacion_sencibilizacion_artistica = $id")->all();
		$requerimientos = ArrayHelper::map($requerimientos,'id_requerimiento','cantidad','id_actividad');
		
		echo json_encode( $requerimientos );
	}
	
	
	/****
		obtener el nombre de la persona de acuerdo el id del perfil y la institucion
	****/
	public function obtenerDocenteOrientador()
	{
		$idInstitucion 	= $_SESSION['instituciones'][0];
		/**
		* Llenar nombre de los cooordinadores-eje
		*/
		//variable con la conexion a la base de datos 
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
			SELECT ppi.id, concat(pe.nombres,' ',pe.apellidos) as nombres, pe.identificacion
			FROM perfiles_x_personas as pp, 
			personas as pe,
			perfiles_x_personas_institucion ppi
			WHERE pp.id_personas = pe.id
			AND pp.id_perfiles = 10
			AND ppi.id_perfiles_x_persona = pp.id
			AND ppi.id_institucion = $idInstitucion
		");
		$result = $command->queryAll();
		$nombresPerfil = array();
		foreach ($result as $r)
		{
			$nombresPerfil[$r['id']]= $r['nombres']. " - " . $r['identificacion'];
		}
		
		return $nombresPerfil;
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
