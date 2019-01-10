<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Controlador EjecucionFaseController
---------------------------------------
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
use app\models\EjecucionFase;
use app\models\EjecucionFaseIBuscar;
use app\models\SemillerosTicEjecucionFaseIi;
use app\models\SemillerosTicAccionesRecursosFaseIi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Fases;
use app\models\DatosIeoProfesional;
use app\models\CondicionesInstitucionales;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;
use app\models\Sesiones;
use app\models\DatosSesiones;
use app\models\SemillerosTicCiclos;
use app\models\SemillerosTicAnio;
use app\models\SemillerosDatosIeo;
use app\models\AcuerdosInstitucionales;
use yii\helpers\ArrayHelper;

/**
 * EjecucionFaseIController implements the CRUD actions for EjecucionFase model.
 */
class EjecucionFaseIiController extends Controller
{
	//Id de la fase y siempre es 2
	public $id_fase = 2;
	
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
	
	public function actionCiclos()
	{
		$id_ciclo = false;
		
		$model = new SemillerosTicCiclos();
		
		$model->load( Yii::$app->request->post() );
		
		if( empty( $model->id ) )
		{
			$dataAnios 	= SemillerosTicAnio::find()
							->where( 'estado=1' )
							->orderby( 'descripcion' )
							->all();
			
			$anios	= ArrayHelper::map( $dataAnios, 'id', 'descripcion' );
			
			$ciclos = [];
			
			if( $model->id_anio ){
				
				$dataCiclos = SemillerosTicCiclos::find()
								->where( 'estado=1' )
								->where( 'id_anio='.$model->id_anio )
								->orderby( 'descripcion' )
								->all();
				
				$ciclos		= ArrayHelper::map( $dataCiclos, 'id', 'descripcion' );
			}
			
			return $this->render( 'ciclos', [
				'model' 	=> $model,
				'anios' 	=> $anios,
				'ciclos'	=> $ciclos,
			]);
		}
		else{
			return $this->actionCreate();
		}
	}

    /**
     * Lists all EjecucionFase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EjecucionFaseIBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EjecucionFase model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EjecucionFase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		// echo "<pre>"; var_dump(Yii::$app->request->post()); echo "</pre>"; exit();
		$ciclo = new SemillerosTicCiclos();
		$anio = new SemillerosTicAnio();
		
		$ciclo->load( Yii::$app->request->post() );
		
		//Si no hay un ciclo se pide el ciclo, para ello se llama a la vista ciclos
		if( empty( $ciclo->id ) ){
			return $this->actionCiclos();
		}
		else{
			$ciclo = SemillerosTicCiclos::findOne( $ciclo->id );
			$anio = SemillerosTicAnio::findOne( $ciclo->id_anio );
		}
		
		//Indica si se guarda la fase
		$guardado = false;
		
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$guardar = Yii::$app->request->post('guardar') == 1 ? true: false;
		$valido = true;
		
		/***************************************************************************************************
		 * datosModelos contiene todos los modelos que se van a usar
		 * Es un array con una estructura similar a como se usa en la página de la
		 * siguiente manera
		 *
		 * Por cada session hay un data sesion, varias ejecuciones de fase y una sola accion y recurso
		 * $dataModelos['id_sesion'] = [
		 *		'dataSesion' => '',
		 *		'EjecuionFase' => [],
		 *		'accionesRecursos' => '',
		 *	];
		 ***************************************************************************************************/
		$datosModelos = [];
		
		$condicionesInstitucionales = new CondicionesInstitucionales();
		
		/************************************************************************
		 * Consultando todas las sesiones para la fase ii y que esten activos
		 * id_fase es una propiedad de este controlador
		 * Adicionalmente creo una estructura ya formada para data Modelos
		 ************************************************************************/
		$sesiones = Sesiones::find()
						->where( 'id_fase='.$this->id_fase )
						->andWhere( 'estado=1' )
						->all();
		
		//Creo 
		foreach( $sesiones as $keySesion => $sesion )
		{	
			$datosModelos[ $sesion->id ][ 'dataSesion' ] 		= new DatosSesiones();
			$datosModelos[ $sesion->id ][ 'ejecucionesFase' ][] = new SemillerosTicEjecucionFaseIi();
			$datosModelos[ $sesion->id ][ 'accionesRecursos' ]	= new SemillerosTicAccionesRecursosFaseIi();
		}
		
			
		/************************************************************************************
		 * Creo un modelo del profesional IEO en caso de existir
		 * Si no existe creo modelo nuevo
		 ************************************************************************************/
		$postDatosProfesional = Yii::$app->request->post('DatosIeoProfesional');
		
		$datosIeoProfesional = false;
		if( $id_institucion && $postDatosProfesional['id_profesional_a'] )
		{
			$datosIeoProfesional 		= DatosIeoProfesional::findOne([
											'id_institucion'	=> $id_institucion,
											'id_sede'			=> $id_sede,
											'id_profesional_a'	=> $postDatosProfesional['id_profesional_a'],
											'estado'			=> 1,
										  ]);
		}
		
		if( !$datosIeoProfesional )
		{
			$datosIeoProfesional = new DatosIeoProfesional();
			$datosIeoProfesional->id_institucion = $id_institucion;
			$datosIeoProfesional->load(Yii::$app->request->post());
		}
		
		$datosIeoProfesional->estado = 1;
		
		if( $datosIeoProfesional )
		{
			//Si ya hay un modelo para datos profesional, procedo a consultar las ejecuciones de fase que halla por cada profesional
			if( $datosIeoProfesional->id )
			{
				//Buscando los datos de Sesion de ejecucion de fase ii para el profesional ya guardadas
				$ejecucionesFases = SemillerosTicEjecucionFaseIi::find()
										->where( 'id_fase='.$this->id_fase )
										->andWhere( 'id_datos_ieo_profesional='.$datosIeoProfesional->id )
										->andWhere( 'id_ciclo='.$ciclo->id )
										->orderby(['id_datos_sesiones'=>SORT_DESC])
										->all();
										
				foreach( $ejecucionesFases as $keyEjecucionFase => $ejecucionFase )
				{
					if( !empty( $ejecucionFase['id_datos_sesiones'] ) )
					{
						$ds = DatosSesiones::findOne( $ejecucionFase['id_datos_sesiones'] );
						
						//Dando el formato a la fecha yyyy-mm-dd
						$ds->fecha_sesion = Yii::$app->formatter->asDate($ds->fecha_sesion, "php:d-m-Y");
						
						//Consultando acción realizadas y recursos empleados en la ejecución de fase II, solo hay uno por sesion
						$accionRecurso = SemillerosTicAccionesRecursosFaseIi::findOne([ 'id_datos_sesion' => $ds->id ]);
						
						$datosModelos[ $ds->id_sesion ][ 'dataSesion' ] 		= $ds;
						$datosModelos[ $ds->id_sesion ][ 'ejecucionesFase' ][] 	= $ejecucionFase;
						
						if( $accionRecurso )
						{
							$datosModelos[ $ds->id_sesion ][ 'accionesRecursos' ] = $accionRecurso;
						}
					}
				}
				
				$condicionesInstitucionales = CondicionesInstitucionales::findOne([ 
													'id_datos_ieo_profesional' 	=> $datosIeoProfesional->id,
													'id_fase'					=> $this->id_fase,
													'id_ciclo'					=> $ciclo->id,
												]);
			}
					
			if( !$condicionesInstitucionales )
			{
				$condicionesInstitucionales = new CondicionesInstitucionales();
			}
			
			//si se va a guardar los datos, cargos todos los datos de los modelos y los valdido
			if( $guardar ){
				
				/*****************************************************************************************************
				 * En caso de que sea un post, cargo los datos correspondientes del post a cada modelo DatosSesiones
				 *****************************************************************************************************/
				if( Yii::$app->request->post('DatosSesiones') )
				{
					/************************************************************************
					 * DataSesiones es un array donde el indice es el id de la sesion
					 ************************************************************************/
					foreach( Yii::$app->request->post('DatosSesiones') as $sesion => $dataSesion )
					{
						//Solo si es diferente a vacio se cargan los campos
						//Si es vacio significa que no hay ni ejecución de fase ni acción recurso 
						//diligenciados y por tanto no se guarda
						if( $dataSesion['fecha_sesion'] != '' )
						{
							$datosModelos[$sesion]['dataSesion']->load( $dataSesion, '');
						}
					}
				}
				/************************************************************************************************/
				
				/*****************************************************************************************************
				 * En caso de que sea un post, cargo los datos correspondientes del post a cada modelo EjecucionFase
				 *****************************************************************************************************/
				if( Yii::$app->request->post('SemillerosTicEjecucionFaseIi') )
				{
					/************************************************************************
					 * EjecucionFase es un multiarray
					 * La primera posición es el id de la sesion
					 * La segunda posición contiene los datos de cada ejecucion de fase para dicha sesión
					 ************************************************************************/
					foreach( Yii::$app->request->post('SemillerosTicEjecucionFaseIi') as $sesion => $ejecucionesFase )
					{
						foreach( $ejecucionesFase as $key => $ejecucionFase )
						{
							/**
							 * Si el id de ejecución de fase que viene en el post, significa que es nuevo y se crea 
							 * el modelo nuevo para dicha ejecución de fase
							 */
							if( empty( $ejecucionFase['id'] ) )
							{
								$ef = new SemillerosTicEjecucionFaseIi();
								$ef->load( $ejecucionFase, '' );
								$datosModelos[$sesion]['ejecucionesFase'][] = $ef;
							}
							else{
								//Si tiene un id está la ejecución de fase está en dataModelos
								//La primera posicion siempre debe estar vacía
								$esPrimera = true;
								foreach( $datosModelos[ $sesion ]['ejecucionesFase'] as $dmEjecucionFase )
								{
									if( !$esPrimera )
									{
										if( $dmEjecucionFase->id == $ejecucionFase['id'] )
										{
											$dmEjecucionFase->load( $ejecucionFase, '' );
											break;
										}
									}
									$esPrimera = false;
								}
							}
						}
					}
				}
				/************************************************************************************************/
				
				/*****************************************************************************************************
				 * En caso de que sea un post, cargo los datos correspondientes del post a cada modelo SemillerosTicAccionesRecursosFaseIi
				 *****************************************************************************************************/
				if( Yii::$app->request->post('SemillerosTicAccionesRecursosFaseIi') )
				{
					/************************************************************************
					 * DataSesiones es un array donde el indice es el id de la sesion
					 ************************************************************************/
					foreach( Yii::$app->request->post('SemillerosTicAccionesRecursosFaseIi') as $sesion => $accionRecurso )
					{
						$datosModelos[$sesion]['accionesRecursos']->load( $accionRecurso, '');
					}
				}
				/************************************************************************************************/
				
				//Cargando los datos de condiciones institucionales
				$condicionesInstitucionales->load( Yii::$app->request->post() );
				
				foreach( $datosModelos as $key => $modelos )
				{
					if( $modelos['dataSesion']->fecha_sesion != '' )
					{	
						//if( !array_key_exists( 'dataSesion', $modelos ) ){ exit( "El key es: ".$key ); }
						$valido = $modelos['dataSesion']->validate([
										'id_sesion',
										'fecha_sesion',
									]) && $valido;
						
						$valido = $modelos['accionesRecursos']->validate([
										'tipo_accion',
										'descripcion_accion',
										'responsable_accion',
										'tiempo_desarrollo',
										'tic',
										'tipo_recurso_tic',
										'digitales',
										'escolares',
										'tipo_recurso_no_tic',
										'tiempo_uso_recurso',
										'tipo_recurso_digitales',
									]) && $valido;
						
						//La primera posición de ejcución fase siempre es vacia
						$esPrimera = true;
						foreach( $modelos['ejecucionesFase'] as $k => $ejecucionFase )
						{
							if( !$esPrimera )
							{
								$valido = $ejecucionFase->validate([
												'docentes',
												'asignaturas',
												'especialidad',
												'numero_apps_desarrolladas',
												'nombre_aplicaciones_desarrolladas',
												'nombre_aplicaciones_creadas',
												'numero',
												'tipo_obra',
												'temas_abordados',
												'numero_pruebas',
												'numero_disecciones',
												'observaciones_generales',
											]) && $valido;
							}
							$esPrimera = false;
						}
					}
				}
				
				$valido = $condicionesInstitucionales->validate([
								'parte_ieo',
								'parte_univalle',
								'parte_sem',
								'otro',
								'total_sesiones_ieo',
								'total_docentes_ieo',
								'sesiones_por_docente',
							]) && $valido;

				$valido = $datosIeoProfesional->validate() && $valido;

				//Valido que todos los modelos sean correctos para guardar
				if( $valido )
				{
					//Se guarda primero los datos de Datos Ieo Profesional
					$datosIeoProfesional->id_sede = $id_sede;
					$datosIeoProfesional->save(false);
			
					//Procedo a guardar los datos
					//La primera posición de ejcución fase siempre es vacia
					foreach( $datosModelos as $key => $modelos )
					{
						if( $modelos['dataSesion']->fecha_sesion != '' )
						{
							$modelos['dataSesion']->estado = 1;
							$modelos['dataSesion']->save(false);
							
							$modelos['accionesRecursos']->estado = 1;
							$modelos['accionesRecursos']->id_datos_sesion = $modelos['dataSesion']->id;
							$modelos['accionesRecursos']->id_ciclo = $ciclo->id;
							$modelos['accionesRecursos']->save(false);
							
							$esPrimera = true;
							foreach( $modelos['ejecucionesFase'] as $k => $ejecucionFase )
							{
								if( !$esPrimera )
								{
									$ejecucionFase->id_datos_ieo_profesional= $datosIeoProfesional->id;
									$ejecucionFase->id_datos_sesiones 		= $modelos['dataSesion']->id;
									$ejecucionFase->id_fase 				= $this->id_fase;
									$ejecucionFase->estado 					= 1;
									$ejecucionFase->id_ciclo 				= $ciclo->id;
									$ejecucionFase->save(false);
								}
								$esPrimera = false;
							}
						}
					}
					
					$condicionesInstitucionales->id_datos_ieo_profesional = $datosIeoProfesional->id;
					$condicionesInstitucionales->id_fase = $this->id_fase;
					$condicionesInstitucionales->estado = 1;
					$condicionesInstitucionales->id_ciclo = $ciclo->id;
					$condicionesInstitucionales->save( false );
					
					$guardado = true;
				}
			}
			
		}
		
		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
		
		$fase  = Fases::findOne( $this->id_fase );
		
		// $dataPersonas 		= Personas::find()
								// ->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								// ->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								// ->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								// ->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								// ->where( 'personas.estado=1' )
								// ->andWhere( 'id_institucion='.$id_institucion )
								// ->all();
		
		// $docentes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		$profesionales = [];
		$dataProfesionales = SemillerosDatosIeo::find()
								->where( 'id_institucion='.$id_institucion )
								->andWhere( 'sede='.$id_sede )
								->andWhere( 'id_ciclo='.$ciclo->id )
								->andWhere( 'estado=1' )
								->all();
								
		foreach( $dataProfesionales as $value )
		{
			$pros = explode( ",", $value->personal_a );
			
			foreach( $pros as $p )
			{
				$persona = Personas::findOne( $p );
				if( empty($profesionales[ $value->id ]) )
					$profesionales[ $value->id ] = $persona->nombres." ".$persona->apellidos;
				else
					$profesionales[ $value->id ] .= " - ".$persona->nombres." ".$persona->apellidos;
			}
		}
		
		
		$docentes = [];
		$dataDocentes = AcuerdosInstitucionales::find()
								->where( 'id_fase='.$this->id_fase )
								->andWhere( 'id_ciclo='.$ciclo->id )
								->andWhere( 'estado=1' )
								->all();
								
		foreach( $dataDocentes as $value )
		{
			$doces = explode( ",", $value->id_docente );
			
			foreach( $doces as $d )
			{
				$persona = Personas::findOne( $d );
				if( empty( $docentes[ $value->id ] ) )
					$docentes[ $value->id ] = $persona->nombres." ".$persona->apellidos;
				else
					$docentes[ $value->id ] .= " - ".$persona->nombres." ".$persona->apellidos;
			}
		}
		

        return $this->render('create', [
            'fase'  				=> $fase,
            'institucion'			=> $institucion,
            'sede' 		 			=> $sede,
            'docentes' 				=> $docentes,
            'sesiones' 				=> $sesiones,
            'datosModelos'			=> $datosModelos,
            'condiciones'			=> $condicionesInstitucionales,
            'datosIeoProfesional'	=> $datosIeoProfesional,
            'datosModelos'			=> $datosModelos,
            'guardado'				=> $guardado,
            'ciclo'					=> $ciclo,
            'profesionales'			=> $profesionales,
			'anio'					=> $anio,
        ]);
    }

    /**
     * Updates an existing EjecucionFase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EjecucionFase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EjecucionFase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EjecucionFase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EjecucionFase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
