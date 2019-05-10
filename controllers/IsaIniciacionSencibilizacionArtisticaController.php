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
																'docenteOrientador' => $this->obtenerNombresXPerfiles(),
																'intervencionIEO' => $intervencionIEO,
																
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
			
			
			// foreach ($intervencionIEO as $iIEO)
			// {
				// $ieo = new IsaIntervencionIeo();
				// $ieo->perfiles 				= $iIEO->perfiles;
				// $ieo->docente_orientador 	= implode(",",$iIEO->docente_orientador);
				// $ieo->fases 				= $iIEO->fases;
				// $ieo->num_encuentro 		= $iIEO->num_encuentro;
				// $ieo->nombre_actividad 		= $iIEO->nombre_actividad;
				// $ieo->actividad_desarrollar = $iIEO->actividad_desarrollar;
				// $ieo->lugares_recorrer 		= $iIEO->lugares_recorrer;
				// $ieo->tematicas_abordadas 	= $iIEO->tematicas_abordadas;
				// $ieo->objetivos_especificos = $iIEO->objetivos_especificos;
				// $ieo->tiempo_previsto 		= $iIEO->tiempo_previsto;
				// $ieo->id_actividades_isa	= $aIsa->id;
				// $ieo->id_equipo_campos 		= $iIEO->id_equipos_campo;
				// $ieo->productos 			= $iIEO->productos;
				// $ieo->save(false);
			// }
			
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
		$idSedes 		= $_SESSION['sede'][0];
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
	
	
	/****
		obtener el nombre de la persona de acuerdo el id del perfil y la institucion
	****/
	public function obtenerNombresXPerfiles()
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
