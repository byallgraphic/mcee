<?php

/**********
Versión: 001
Fecha: 2018-08-23
Desarrollador: Edwin Molina Grisales
Descripción: Controlador EjecucionFaseIEstudiantesController
---------------------------------------
Modificaciones:
Fecha: 2019-03-13
Persona encargarda: Edwin Molina Grisales
Descripción: Sesiones dinámicas
---------------------------------------
Fecha: 2018-11-02
Persona encargarda: Edwin Molina Grisales
Descripción: Modificaciones varias para poder insertar o actualizar los registros del usuario
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
use app\models\SemillerosTicEjecucionFaseIiEstudiantes;
use app\models\EjecucionFaseIBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;





use app\models\DatosIeoProfesional;
use app\models\Fases;
use app\models\SemillerosTicDatosIeoProfesionalEstudiantes;
use app\models\SemillerosTicAnio;
use app\models\SemillerosTicCiclos;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;
use app\models\Sesiones;
use app\models\DatosSesiones;
use app\models\SemillerosTicCondicionesInstitucionalesEstudiantes;
use app\models\Niveles;
use app\models\SedesNiveles;
use app\models\AcuerdosInstitucionalesEstudiantes;
use app\models\SemillerosDatosIeoEstudiantes;
use app\models\Paralelos;
use yii\helpers\ArrayHelper;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\bootstrap\Collapse;

/**
 * EjecucionFaseIController implements the CRUD actions for EjecucionFase model.
 */
class EjecucionFaseIiEstudiantesController extends Controller
{
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
	
	public function actionAddSessionItem()
	{
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$idFase 	= $this->id_fase;
		// $numSesion 	= Yii::$app->request->get('num_sesion');
		$index 		= Yii::$app->request->get('index');
		
		$numSesion = $index;
		
		$numSesion++;
		$index++;
		
		$ejecucionesFases= [ new SemillerosTicEjecucionFaseIiEstudiantes() ];
		$datosSesion	 = new DatosSesiones();
		
		$condiciones 	= null;
		
		$form = ActiveForm::begin();
		
		$sesion = Sesiones::find()
						->where( 'id_fase='.$idFase )
						->andWhere( 'estado=1' )
						->andWhere( "descripcion='Sesión ".$numSesion."'" )
						->one();
						
		if( !$sesion ){
			$sesion = new Sesiones();
			$sesion->descripcion = "Sesión ".$numSesion;
			$sesion->id_fase 	 = $idFase;
			$sesion->estado 	 = 1;
			
			$sesion->save();
		}
		
		$item = [
					'label' 		=>  $sesion->descripcion,
					'content' 		=>  $this->renderPartial( 'sesionItem', 
													[ 
														'sesion' 			=> $sesion,
														'ejecucionesFases' 	=> $ejecucionesFases,
														'datosSesion' 		=> $datosSesion,
														'form' 				=> $form,
													] 
										),
					'contentOptions'=> []
				];
		
		
		$header = $sesion->descripcion;
		// $index = 9;
		
		$a = new Collapse();
		$a->options['id'] = 'collapseOne';
		$options = ArrayHelper::getValue($item, 'options', []);
		Html::addCssClass($options, 'panel panel-default');
		echo $items = Html::tag('div', $a->renderItem($header, $item, $index), $options);
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
							->all();
			
			$anios	= ArrayHelper::map( $dataAnios, 'id', 'descripcion' );
			
			$ciclos = [];
			
			if( $model->id_anio ){
				
				$dataCiclos = SemillerosTicCiclos::find()
								->where( 'estado=1' )
								->where( 'id_anio='.$model->id_anio )
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
		// echo "<pre>"; var_dump(Yii::$app->request->post()); echo "</pre>";
		//$ciclo = new SemillerosTicCiclos();
		// $anio = new SemillerosTicAnio();
		
		//$ciclo->load( Yii::$app->request->post() );
		
		//Si no hay un ciclo se pide el ciclo, para ello se llama a la vista ciclos
		//if( empty( $ciclo->id ) ){
        //    return $this->actionCiclos();
		//}
		///else{
			//$ciclo = SemillerosTicCiclos::findOne( $ciclo->id );
		//	$anio = SemillerosTicAnio::findOne( $ciclo->id_anio );
		//}
		$anio 		= Yii::$app->request->get('anio');
		$esDocente 	= Yii::$app->request->get('esDocente');
		
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$condiciones = null;
		
		//Indica si se guarda la fase
		$guardado = false;
		
		$sesiones = [];
		
		$guardar = Yii::$app->request->post('guardar') == 1 ? true: false;
		
		/***************************************************************************************************
		 * datosModelos contiene todos los modelos que se van a usar
		 * Es un array con una estructura similar a como se usa en la página de la
		 * siguiente manera
		 *
		 * Por cada session hay un data sesion, varias ejecuciones de fase 
		 * $dataModelos['id_sesion'] = [
		 *		'datosSesion' => '',
		 *		'EjecuionFase' => [],
		 *		'accionesRecursos' => '',
		 *	];
		 ***************************************************************************************************/
		$datosModelos = [];
		
		/************************************************************************************
		 * Creo un modelo del profesional IEO en caso de existir
		 * Si no existe creo modelo nuevo
		 ************************************************************************************/
		$postDatosProfesional = Yii::$app->request->post('SemillerosTicDatosIeoProfesionalEstudiantes');
		
		$datosIeoProfesional = false;
		if( $id_institucion && $id_sede && $anio )
		{
			$datosIeoProfesional 		= SemillerosTicDatosIeoProfesionalEstudiantes::findOne([
											'id_institucion'		=> $id_institucion,
											'id_sede'				=> $id_sede,
											'id_fase'				=> $this->id_fase,
											'anio'					=> $anio,
											// 'id_profesional_a'		=> $postDatosProfesional['id_profesional_a'],
											//'curso_participantes'	=> $postDatosProfesional['curso_participantes'],
										  ]);
		}
		
		if( !$datosIeoProfesional )
		{
			$datosIeoProfesional = new SemillerosTicDatosIeoProfesionalEstudiantes();
			$datosIeoProfesional->load(Yii::$app->request->post());
		}
		else
		{
			$datosIeoProfesional->id_profesional_a = explode( ",", $datosIeoProfesional->id_profesional_a );
			$datosIeoProfesional->curso_participantes = explode( ",", $datosIeoProfesional->curso_participantes );
			
			$datosIeoProfesional->load(Yii::$app->request->post());
		}
		
		
		if( $datosIeoProfesional )
		{
			//Si ya hay un modelo para datos profesional, procedo a consultar las ejecuciones de fase que halla por cada profesional
			if( $datosIeoProfesional->id )
			{
				if( !$guardar )
				{
					$ejecucionesFases = SemillerosTicEjecucionFaseIiEstudiantes::find()
											->where( 'id_fase='.$this->id_fase )
											//->andWhere( 'id_ciclo='.$ciclo->id )
											->andWhere( 'anio='.$anio )
											->andWhere( 'id_datos_ieo_profesional_estudiantes='.$datosIeoProfesional->id )
											->andWhere( 'estado=1' )
											->all();
			
					foreach( $ejecucionesFases as $key => $ejecucionFase )
					{
						$ds = DatosSesiones::findOne( $ejecucionFase->id_datos_sesion );
						
						$ds->fecha_sesion = Yii::$app->formatter->asDate($ds->fecha_sesion, "php:d-m-Y");
						
						if( !isset( $datosModelos[ $ds->id_sesion ] ) ){
							
							$datosModelos[ $ds->id_sesion ][ 'ejecucionesFase' ][]	= new SemillerosTicEjecucionFaseIiEstudiantes();
							$sesiones[] = Sesiones::findOne( $ds->id_sesion );
						}
						
						$datosModelos[ $ds->id_sesion ][ 'datosSesion' ] 		= $ds;
						$datosModelos[ $ds->id_sesion ][ 'ejecucionesFase' ][]	= $ejecucionFase;
						
						$datosIeoProfesional->estudiantes_id = $ejecucionFase->estudiantes_id;
					}
				}
				
				$condiciones = SemillerosTicCondicionesInstitucionalesEstudiantes::findOne([ 
										'id_datos_ieo_profesional_estudiantes' 	=> $datosIeoProfesional->id,
										'id_fase'								=> $this->id_fase,
										'anio'									=> $anio,
										//'id_ciclo'								=> $ciclo->id,
									]);
				
			}
			
			//Si no hay condiciones institucionales significa que no se encontró nada en los registros y se crea uno nuevo
			if( !$condiciones )
			{
				$condiciones = new SemillerosTicCondicionesInstitucionalesEstudiantes();
			}
			
			//esta variable solo es activa si el dan al boton guardar
			if( $guardar )
			{
				//Si es un pos procedo a cargar todos los datos de acuerdo a lo ingresado por el usuario
				if( Yii::$app->request->post() ){
					
					if( is_array( Yii::$app->request->post( 'DatosSesiones' ) ) )
					{
						foreach( Yii::$app->request->post( 'DatosSesiones' ) as $sesion_id => $dataSesion )
						{
							if( !empty( $dataSesion['fecha_sesion'] ) )
							{
								//Si existe id consulto los datos correspondientes y cargo los datos del post
								//Si no, creo un nuevo modelo y cargo los datos del post
								if( !empty( $dataSesion['id'] ) )
								{
									$ds = DatosSesiones::findOne( $dataSesion['id'] );
								}
								else{
									$ds = new DatosSesiones();
								}
								
								if( !isset( $datosModelos[ $sesion_id ] ) ){
							
									$datosModelos[ $sesion_id ][ 'ejecucionesFase' ][]	= new SemillerosTicEjecucionFaseIiEstudiantes();
									$sesiones[] = Sesiones::findOne( $sesion_id );
								}
								
								$ds->load( $dataSesion, '' );
								
								$datosModelos[ $sesion_id ][ 'datosSesion' ] 		= $ds;
							}
						}
					}
					
					if( is_array( Yii::$app->request->post( 'SemillerosTicEjecucionFaseIiEstudiantes' ) ) )
					{
						foreach( Yii::$app->request->post( 'SemillerosTicEjecucionFaseIiEstudiantes' ) as $sesion_id => $ejecucionFases )
						{
							foreach( $ejecucionFases as $key => $ejecucionFase )
							{
								//Si existe id consulto los datos correspondientes y cargo los datos del post
								//Si no, creo un nuevo modelo y cargo los datos del post
								if( !empty( $ejecucionFase['id'] ) )
								{
									$ef = SemillerosTicEjecucionFaseIiEstudiantes::findOne( $ejecucionFase['id'] );
								}
								else{
									$ef = new SemillerosTicEjecucionFaseIiEstudiantes();
								}
								
								$ef->load( $ejecucionFase, '' );
								
								$datosModelos[ $sesion_id ][ 'ejecucionesFase' ][] = $ef;
								
								$datosIeoProfesional->estudiantes_id = $ef->estudiantes_id;
							}
						}
					}
				}
			
				$condiciones->load( Yii::$app->request->post() );
			
				$valido = true;
				
				$valido = $datosIeoProfesional->validate([
									'id_profesional_a',
									'curso_participantes',
								]) && $valido;
				
				foreach( $datosModelos as $key => $modelo )
				{
					if( !empty($modelo[ 'datosSesion' ]->fecha_sesion ) ){
						
						$valido = $modelo[ 'datosSesion' ]->validate([
										'fecha_sesion',
									]) && $valido;
						
						$primera = true;
						foreach( $modelo[ 'ejecucionesFase' ] as $key => $ejecucionFase )
						{
							if( !$primera )
							{
								$valido = $ejecucionFase->validate([
												'estudiantes_participantes',
												'apps_desarrolladas',
												'nombre_aplicaciones',
												'tipo_accion',
												'descripcion',
												'responsable_accion',
												'tiempo_desarrollo'=> 'Tiempo Desarrollo',
												'tic',
												'tipo_uso_tic',
												'digitales',
												'tipo_uso_digitales',
												'no_tic',
												'tipo_uso_no_tic',
												'tiempo_uso_tic',
												'numero_obras',
												'tipo_obras',
												'indice_temas',
												'numero_pruebas',
												'numero_disecciones',
												'observaciones',
											]) && $valido;
							}
							$primera = false;
						}
					}
				}
				
				$valido = $condiciones->validate([
								'parte_ieo' 				=> 'Parte Ieo',
								'parte_univalle' 			=> 'Parte Univalle',
								'parte_sem' 				=> 'Parte Sem',
								'otro' 						=> 'Otro',
								'estado' 					=> 'Estado',
								'total_sesiones_ieo' 		=> 'Total Sesiones Ieo',
								'total_docentes_ieo' 		=> 'Total Docentes Ieo',
								'sesiones_por_docente' 		=> 'Sesiones por Docente',
							]) && $valido;
				
				if( $valido )
				{
					$datosIeoProfesional->id_institucion 	= $id_institucion;
					$datosIeoProfesional->id_sede 			= $id_sede;
					$datosIeoProfesional->estado 			= 1;
					$datosIeoProfesional->anio 				= $anio;
					$datosIeoProfesional->id_fase 			= $this->id_fase;
					
                    if( is_array($datosIeoProfesional->curso_participantes) )
                        $datosIeoProfesional->curso_participantes = implode(",", $datosIeoProfesional->curso_participantes);
                    
					if( is_array($datosIeoProfesional->id_profesional_a) )
                        $datosIeoProfesional->id_profesional_a	= implode(",", $datosIeoProfesional->id_profesional_a);
					
					$datosIeoProfesional->save( false );

                    $datosIeoProfesional->curso_participantes 	= explode(",", $datosIeoProfesional->curso_participantes);
                    $datosIeoProfesional->id_profesional_a 		= explode(",", $datosIeoProfesional->id_profesional_a);

                    foreach( $datosModelos as $sesion_id => $modelo )
					{
						if( !empty($modelo[ 'datosSesion' ]->fecha_sesion ) )
						{
							$modelo[ 'datosSesion' ]->id_sesion = $sesion_id;
							$modelo[ 'datosSesion' ]->estado 	= 1;
							$modelo[ 'datosSesion' ]->save(false);
							
							$primera = true;
							foreach( $modelo[ 'ejecucionesFase' ] as $key => $ejecucionFase )
							{
                                $estudiantes_id = Yii::$app->request->post()["SemillerosTicDatosIeoProfesionalEstudiantes"];
                                $ejecucionFase->estudiantes_id = isset($estudiantes_id["estudiantes_id"])? $estudiantes_id["estudiantes_id"] : '';
                                if( !$primera )
								{
									$ejecucionFase->id_datos_ieo_profesional_estudiantes 	= $datosIeoProfesional->id;
									$ejecucionFase->id_datos_sesion 						= $modelo[ 'datosSesion' ]->id;
									$ejecucionFase->id_fase 								= $this->id_fase;
									$ejecucionFase->anio 									= $anio;
									//$ejecucionFase->id_ciclo 								= $ciclo->id;
									$ejecucionFase->estado 									= 1;
									$ejecucionFase->save(false);
								}
								$primera = false;
							}
						}
					}
					
					$condiciones->id_datos_ieo_profesional_estudiantes 	= $datosIeoProfesional->id;
					$condiciones->id_fase 								= $this->id_fase;
					$condiciones->anio	 								= $anio;
					//$condiciones->id_ciclo 								= $ciclo->id;
					$condiciones->estado 								= 1;
					$condiciones->save(false);
					
					$guardado = true;
				}
			}
		}

		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
		
		$fase  = Fases::findOne( $this->id_fase );
		
		$docentes = [];
		/*$dataPersonas 	= SemillerosDatosIeoEstudiantes::find()
								->select( 'id, profecional_a' )
								->alias( 'se' )
								// ->innerJoin( 'semilleros_tic.acuerdos_institucionales_estudiantes ae', 'ae.id_semilleros_datos_estudiantes=se.id' )
								->where( 'se.estado=1' )
								->andWhere( 'se.id_institucion='.$id_institucion )
								->andWhere( 'se.id_sede='.$id_sede )
								->andWhere( 'se.id_ciclo='.$ciclo->id )
								// ->andWhere( 'ae.estado=1' )
								->groupby([ 'id','profecional_a' ])
								->all();
		
		foreach( $dataPersonas as $key => $personas ){
			
			$profesionales = explode( ',', $personas->profecional_a );
			
			foreach( $profesionales as $profesional )
			{
				$persona =  Personas::findOne( $profesional );
				
				if( empty( $docentes[ $personas->id ] ) )
					$docentes[ $personas->id ] = $persona->nombres." ".$persona->apellidos;
				else
					$docentes[ $personas->id ] .= " - ".$persona->nombres." ".$persona->apellidos;
			}
		}*/
        // $dataPersonas = Personas::find()
            // ->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
            // ->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
            // ->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
            // ->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
            // ->where( 'personas.estado=1' )
            // ->andWhere( 'id_institucion='.$id_institucion )
            // ->all();

        // $docentes = ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		
		
		
		$docentesArray = [];
		
		if( !empty($datosIeoProfesional->id_profesional_a) ){
			$docentesArray = $datosIeoProfesional->id_profesional_a;
		}
		
		if( count($docentesArray) > 0 ){
			
			$dataPersonas 		= Personas::find()
										->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
										->andWhere( [ 'in', 'id', $docentesArray ] )
										->all();
			
			$docentes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		}
		else
		{
			$docentes = [];
		}
		
		
		
		
		
		
		

        $cursos = [];
		
		// $post_profesional_a = Yii::$app->request->post('SemillerosTicDatosIeoProfesionalEstudiantes')['id_profesional_a'];
		
		// if( $post_profesional_a )
		// {
			/*$dataCursos = AcuerdosInstitucionalesEstudiantes::find()
								->alias( 'ae' )
								->innerJoin( 'semilleros_tic.semilleros_datos_ieo_estudiantes se', 'se.id=ae.id_semilleros_datos_estudiantes' )
								->where( 'ae.id_fase='.$this->id_fase )
								->andWhere( 'ae.estado=1' )
								->andWhere( 'se.estado=1' )
								->andWhere( 'se.id='."'".$post_profesional_a."'" )
								->andWhere( 'ae.id_ciclo='.$ciclo->id )
								->all();
			
			foreach( $dataCursos as $dataCurso )
			{
				$dcursos = explode( ',', $dataCurso->curso );
				
				foreach( $dcursos as $value ){
					if( empty( $cursos[ $dataCurso->id ] ) )
					{	
						$cursos[ $dataCurso->id ] = Paralelos::findOne( $value )->descripcion;
					}
					else{
						$cursos[ $dataCurso->id ] .= " , ".Paralelos::findOne( $value )->descripcion;
					}
				}
			}*/
			$dataCursos = 	Paralelos::find()
									->alias( 'p' )
									->innerJoin( 'sedes_jornadas as sj', 'sj.id=p.id_sedes_jornadas' )
									->innerJoin( 'sedes_niveles as sn', 'sn.id=p.id_sedes_niveles' )
									->innerJoin( 'jornadas as j', 'j.id=sj.id_jornadas' )
									->innerJoin( 'niveles as n', 'n.id=sn.id_niveles' )
									->innerJoin( 'sedes as s', 's.id=sn.id_sedes' )
									->where( 's.id='.$id_sede )
									->andWhere( 'sj.id_sedes = s.id' )
									->andWhere( 'j.estado=1' )
									->andWhere( 'n.estado=1' )
									->andWhere( 's.estado=1' )
									->orderby( 'descripcion' )
									->all();

            $cursos	= ArrayHelper::map( $dataCursos, 'id', 'descripcion' );
		// }
		
		/************************************************************************
		 * Consultando todas las sesiones para la fase i estudiantes y que esten activos
		 * id_fase es una propiedad de este controlador
		 * Adicionalmente creo una estructura ya formada para data Modelos
		 ************************************************************************/
		if( empty($sesiones) )
		{
			$sesiones = Sesiones::find()
							->where( 'id_fase='.$this->id_fase )
							->andWhere( 'estado=1' )
							->andWhere( "descripcion='Sesión 1'" )
							->all();
			
			//Creo 
			foreach( $sesiones as $keySesion => $sesion )
			{	
				$datosModelos[ $sesion->id ][ 'datosSesion' ] 		= new DatosSesiones();
				$datosModelos[ $sesion->id ][ 'ejecucionesFase' ][] = new SemillerosTicEjecucionFaseIiEstudiantes();
			}
		}

        return $this->render('create', [
            'datosModelos'	=> $datosModelos,
            'profesional'	=> $datosIeoProfesional,
            'fase'  		=> $fase,
            'institucion'	=> $institucion,
            'sede' 		 	=> $sede,
            'docentes' 		=> $docentes,
			//'ciclo'			=> $ciclo,
			'condiciones'	=> $condiciones,
			'guardado'		=> $guardado,
			'cursos'		=> $cursos,
			'anio'			=> $anio,
			'esDocente'		=> $esDocente,
			'sesiones'		=> $sesiones,
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
