<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Controlador EjecucionFaseController
---------------------------------------
Modificaciones:
Fecha: 2019-02-12
Desarrollador:	Edwin Molina Grisales
Descripción: Se dejan sesiones dinámicas
---------------------------------------
Fecha: 2019-02-12
Descripción: Ya no se pide el ciclo y el año viene por url
---------------------------------------
Fecha: 2019-02-04
Descripción: Se desagregan los campos Profesional A y docentes de cada sesión con respecto a a la conformación de los semilleros
---------------------------------------
Modificaciones:
Fecha: 2018-11-06
Descripción: Se usa en los select el plugin chosen y se modifica la función que calcula el total de sesiones
---------------------------------------
Fecha: 2018-10-16
Descripción: Se premite insertar y modificar registros del formulario Ejecucion Fase I Docentes
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
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Fases;
use app\models\DatosIeoProfesional;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;
use app\models\SemillerosTicEjecucionFase;
use app\models\Sesiones;
use app\models\CondicionesInstitucionales;
use app\models\DatosSesiones;
use app\models\SemillerosTicCiclos;
use app\models\SemillerosTicAnio;
use app\models\SemillerosDatosIeo;
use app\models\AcuerdosInstitucionales;
use app\models\EspecialidadesTecnicas;
use yii\helpers\ArrayHelper;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;
/**
 * EjecucionFaseIController implements the CRUD actions for EjecucionFase model.
 */
class EjecucionFaseIController extends Controller
{
	//Creando propiedad
	public $id_fase = 1;	//El id de la fase siempre es 1
	
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
		
		$institucion = Instituciones::findOne($id_institucion);
		
		$idFase 	= $this->id_fase;
		// $numSesion 	= Yii::$app->request->get('num_sesion');
		$index 		= Yii::$app->request->get('index');
		
		$numSesion = $index;
		
		$numSesion++;
		$index++;
		
		$dataEspecialidades = EspecialidadesTecnicas::findOne( $institucion->especialidad );
		
		$especialidades = [ $dataEspecialidades->id => $dataEspecialidades->descripcion ];
		
		// $docentes = [];
		
		$datoSesion 	= new DatosSesiones();
		$ejecucionesFase= [ new EjecucionFase() ];
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
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		
		$docentes = $profesionales		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		$item = 	[
					'label' 		=>  $sesion->descripcion,
					'content' 		=>  $this->renderPartial( 'sesionItem', 
													[ 
														'idPE' 			=> null, 
														'index' 		=> 0,
														'indexEf' 		=> $sesion->id,
														'sesion' 		=> $sesion,
														'datosSesion'	=> $datoSesion,
														'models' 		=> $ejecucionesFase,
														'condiciones'	=> $condiciones,
														'form'			=> $form,
														'datosModelos'	=> null,
														'docentes' 		=> $docentes,
														'especialidades'=> $especialidades,
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

	public function actionCreateAll()
	{
		// echo "<pre>"; var_dump( Yii::$app->request->post() ); echo "</pre>"; exit();
		// $ciclo = new SemillerosTicCiclos();
		// $anio = new SemillerosTicAnio();
		
		// $ciclo->load( Yii::$app->request->post() );
		
		// //Si no hay un ciclo se pide el ciclo, para ello se llama a la vista ciclos
		// if( empty( $ciclo->id ) ){
			// return $this->actionCiclos();
		// }
		// else{
			// $ciclo = SemillerosTicCiclos::findOne( $ciclo->id );
			// $anio = SemillerosTicAnio::findOne( $ciclo->id_anio );
		// }
		
		$docentesArray = [];
		
		$anio = Yii::$app->request->get('anio');
		$esDocente = Yii::$app->request->get('esDocente');
	
		//Indica si se guarda la fase
		$guardado = false;
		
		$guardar = Yii::$app->request->post('guardar') == 1 ? true: false;
		
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$fase  = Fases::findOne( $this->id_fase );
		
		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
		
		$datosModelos = [];
		
		$sesiones = [];
		
		if( true || Yii::$app->request->isPost ){
		
			$datosSesiones = [];
			
			$model = $ejecucionFase = [];
			
			$condicionesInstitucionales = new CondicionesInstitucionales();
			
			/************************************************************************************
			 * Creo un modelo del profesional IEO en caso de existir
			 * Si no existe creo modelo nuevo
			 ************************************************************************************/
			$postDatosProfesional = Yii::$app->request->post('DatosIeoProfesional');
			
			$datosIeoProfesional = false;
			if( $id_institucion && $postDatosProfesional['id_profesional_a'] )
			{
				$datosIeoProfesional 	= DatosIeoProfesional::findOne([
												'id_institucion'	=> $id_institucion,
												'id_sede'			=> $id_sede,
												'id_profesional_a'	=> $postDatosProfesional['id_profesional_a'],
											  ]);
			}
			
			if( !$datosIeoProfesional )
			{
				$datosIeoProfesional = new DatosIeoProfesional();
				$datosIeoProfesional->id_institucion = $id_institucion;
				$datosIeoProfesional->load(Yii::$app->request->post());
			}
			
			$datosIeoProfesional->estado = 1;
			/************************************************************************************/
			
			//Si se cargo los modelos del profesional proceso a cargar los modelos guardados o crearlos
			if( $datosIeoProfesional )
			{
				if( !$guardar && $datosIeoProfesional->id )
				{
					//Buscando los datos de Sesion de ejecucion de fase para el profesional
					$ejecucionesFases = EjecucionFase::find()
											->select( 'id_datos_sesiones' )
											->where( 'id_fase='.$this->id_fase )
											->andWhere( 'id_datos_ieo_profesional='.$datosIeoProfesional->id )
											->andWhere( 'anio='.$anio )
											->groupby( 'id_datos_sesiones' )
											->all();
											
					foreach( $ejecucionesFases as $key => $value )
					{
						if( !empty( $value['id_datos_sesiones'] ) )
						{
							$ds = DatosSesiones::findOne( $value['id_datos_sesiones'] );
							$ds->fecha_sesion = Yii::$app->formatter->asDate($ds->fecha_sesion, "php:d-m-Y");
							if( $ds ){
								$datosSesiones[] = $ds;
							}
						}
						else{
							$datosSesiones[] = new DatosSesiones();
						}
						
						if( $value['docente'] )
							$docentesArray = $docentesArray + explode( ",", $value['docente'] );
					}
					
					$condicionesInstitucionales = CondicionesInstitucionales::findOne([ 
														'id_datos_ieo_profesional'	=> $datosIeoProfesional->id,
														'id_fase'					=> $this->id_fase,
														'anio'						=> $anio,
													]);
					
					if( !$condicionesInstitucionales )
					{
						$condicionesInstitucionales = new CondicionesInstitucionales();
					}
					
					/**************************************************************************************************
					 * Por cada Dato de sesion se debe buscar una ejecución de fase
					 * Si no se encuentra una ejecucion de fase se crea de 0 ya que indica que es un nuevo registro
					 *
					 * Adicional creo un array multidimensional
					 * La primera posicion indica el id de la sesion
					 * La segunda posicion indica el id de los datos de la sesion
					 * La tercera posicion indica contiene la ejecucion de fase
					 * Este array se crea para poder mostrar correctamente los datos en la vista
					 *
					 * Mas adelante se vuelve a verificar que exista por lo menos una posicion por id de sesion
					 **************************************************************************************************/
					if( count($datosSesiones) > 0 )
					{
						foreach( $datosSesiones as $key => $datosSesion )
						{
							//Si hay un id busco la session, si no hay un id de la sesion es nuevo y por tanto la ejecucion de fae también
							if( $datosSesion->id && $datosIeoProfesional->id ){
								
								// //Se busca las ejecución de fases por los datos del profesional
								// //El id de la fase esta creada como propiedad ya que siempre es constante
								$ejecucionesFase = EjecucionFase::find()
														->where( 'id_datos_ieo_profesional='.$datosIeoProfesional->id )
														->andWhere( 'id_datos_sesiones='.$datosSesion->id )
														->andWhere( 'id_fase='.$this->id_fase )
														->andWhere( 'anio='.$anio )
														->all();

								foreach( $ejecucionesFase as $key => $ejecFase ){
									
									// Si se encuentra una ejecución se usa, de lo contrario la ejecución de fase es nueva
									if( $ejecFase )
									{
										$ejecFase->estado = 1;
										$ejecFase->docente = explode( ",", $ejecFase->docente );
										// $ejecFase->id_fase = $this->id_fase;
										$ejecucionFase[] = $ejecFase;
										
										$docentesArray = $docentesArray + $ejecFase->docente;
									}
									else
									{
										$ejecFase = new EjecucionFase();
										$ejecFase->estado = 1;
										$ejecFase->id_fase = $this->id_fase;
										$ejecucionFase[] = $ejecFase;
									}
									
									//Si no se ha agregado agrego una ejecucion de fase vacio
									if( !isset( $datosModelos[ $datosSesion->id_sesion ] ) )
									{
										$datosModelos[ $datosSesion->id_sesion ][ 'dataSesion' ] 		= $datosSesion;
										$datosModelos[ $datosSesion->id_sesion ][ 'ejecucionesFase' ][] = new EjecucionFase();
										
										$sesiones[] = Sesiones::findOne($datosSesion->id_sesion);
									}

									$datosModelos[ $datosSesion->id_sesion ]['ejecucionesFase'][] = $ejecFase;
									
								}
							}
							else
							{
								$ejecFase = new EjecucionFase();
								$ejecFase->estado = 1;
								$ejecFase->id_fase = $this->id_fase;
								$ejecucionFase[] = $ejecFase;
								
								//Si no se ha agregado agrego una ejecucion de fase vacio
								if( !isset( $datosModelos[ $datosSesion->id_sesion ] ) )
								{
									$datosModelos[ $datosSesion->id_sesion ][ 'dataSesion' ] 		= $datosSesion;
									$datosModelos[ $datosSesion->id_sesion ][ 'ejecucionesFase' ][] = new EjecucionFase();
									
									$sesiones[] = Sesiones::findOne($datosSesion->id_sesion);
								}
								
								// $docentesArray = $docentesArray + $ejecFase->docente;

								$datosModelos[ $datosSesion->id_sesion ]['ejecucionesFase'][] = $ejecFase;
							}
							
						}
					}
				}
				
				
				
				
				/************************************************************************************
				 * Si va a empezar el proceso de guardar
				 * Llenos todos los campos de acuerdo a los datos del POST
				 * La estructura es un array
				 * Donde la primera posicion corresponde a los datos de la sesion correspondiente al primer foreach
				 * La segunda posición corresponde a los datos de la sesión correspondiente al foreach interno
				 * Esto debido a que por un datos de sesión puede haber más de una ejecución de fase
				 ************************************************************************************/
				if( $guardar && Yii::$app->request->post('DatosSesiones') && Yii::$app->request->post('EjecucionFase') ){
					
					$datosSesiones	= [];
					$datosModelos	= [];
					$model = $ejecucionFase = [];
					
					foreach( Yii::$app->request->post('DatosSesiones') as $kDataSesion => $vDataSesion ){
						
						if( !empty( trim( $vDataSesion['fecha_sesion'] ) ) ){
							
							if( !empty( $vDataSesion['id'] ) )
							{
								$ds = DatosSesiones::findOne( $vDataSesion['id'] );
								$ds->fecha_sesion = Yii::$app->formatter->asDate($ds->fecha_sesion, "php:d-m-Y");
							}
							else{
								$ds = new DatosSesiones();
							}
							
							$datosSesiones[] = $ds;
							
							if( $guardar )
							{
								$ds->load( $vDataSesion, '' );
								$ds->fecha_sesion = Yii::$app->formatter->asDate($ds->fecha_sesion, "php:d-m-Y");
							}
							
							if( is_array( Yii::$app->request->post('EjecucionFase')[$kDataSesion] ) ){
								
								foreach( Yii::$app->request->post('EjecucionFase')[$kDataSesion] as $kEjecucionFase => $vEjecucionFase ){

									//Si hay un id busco la session, si no hay un id de la sesion es nuevo y por tanto la ejecucion de fae también
									if( !empty( $vEjecucionFase['id'] ) ){
										
										//Se busca las ejecución de fases por los datos del profesional
										//El id de la fase esta creada como propiedad ya que siempre es constante
										$ejecFase = EjecucionFase::findOne($vEjecucionFase['id']);
										
										// Si se encuentra una ejecución se usa, de lo contrario la ejecución de fase es nueva
										if( $ejecFase )
										{
											$ejecFase->estado = 1;
											// $ejecFase->id_fase = $this->id_fase;
											$ejecucionFase[] = $ejecFase;
										}
										else
										{
											$ejecFase = new EjecucionFase();
											$ejecFase->estado = 1;
											$ejecFase->id_fase = $this->id_fase;
											$ejecucionFase[] = $ejecFase;
										}					
									}
									else
									{
										$ejecFase = new EjecucionFase();
										$ejecFase->estado = 1;
										$ejecFase->id_fase = $this->id_fase;
										$ejecucionFase[] = $ejecFase;
									}
									
									//Si no se ha agregado agrego una ejecucion de fase vacio
									if( !isset( $datosModelos[ $ds->id_sesion ] ) )
									{
										$datosModelos[ $ds->id_sesion ][ 'dataSesion' ] 		= $ds;
										$datosModelos[ $ds->id_sesion ][ 'ejecucionesFase' ][]	= new EjecucionFase();
										
										$sesiones[] = Sesiones::findOne($ds->id_sesion);
									}

									$ejecFase->load( $vEjecucionFase, '' );
									$ejecFase->docente = implode( ",", $vEjecucionFase['docente'] );
									
									$docentesArray = $docentesArray + $vEjecucionFase['docente'];
									
									$datosModelos[ $ds->id_sesion ]['ejecucionesFase'][] = $ejecFase;
								}
							}
						}
					}
				
					/********************************************************************
					 * Cargando datos de ejecucion de fase
					 ********************************************************************/
					if( $guardar )
						$condicionesInstitucionales->load( Yii::$app->request->post() );
					/********************************************************************/
					
					/***************************************************************
					 * Validando todos los modelos a guardar
					 **************************************************************/
					
					//Validando todos los campos necesarios para guardar del modelo datos Profesional IEO
					$valido = $datosIeoProfesional->validate([
							'id_profesional_a',
						]);
					
					//Validando todos los campos necesarios para datos sesiones
					$valido = DatosSesiones::validateMultiple( $datosSesiones, [
									'id_sesion',
									'fecha_sesion',
									'duracion_sesion',
									'estado',
								] ) && $valido;

					//Validando todos los campos necesarios para datos sesiones
					$valido = EjecucionFase::validateMultiple( $ejecucionFase, [
									'id_fase',
									'docente',
									'asignaturas',
									'especiaidad',
									'paricipacion_sesiones',
									'numero_apps',
									'seiones_empleadas',
									'acciones_realiadas',
									'temas_problama',
									'tipo_conpetencias',
									'observaciones',
									'estado',
									'numero_sesiones_docente',
									'nombre_aplicaciones_creadas',
								] ) && $valido;

					$valido = $condicionesInstitucionales->validate( [
									'parte_ieo',
									'parte_univalle',
									'parte_sem',
									'otro',
									'total_sesiones_ieo',
									'total_docentes_ieo',
									'sesiones_por_docente',
								] ) && $valido;
					/**************************************************************/
				
					//Si todo está correcto se proceda guardar los datos, sin validar ya que fue todo validado con anterioridad
					if( $guardar && $valido )
					{
						//Se guarda primero los datos de Datos Ieo Profesional
						$datosIeoProfesional->estado 		= 1;
						$datosIeoProfesional->id_institucion= $id_institucion;
						$datosIeoProfesional->id_sede 		= $id_sede;
						$datosIeoProfesional->save(false);
						
						foreach( $datosModelos as $key => $value )
						{	
							$datoSesion = $value['dataSesion'];
							
							if( !empty( $datoSesion->fecha_sesion ) )
							{
								//guardando los datos de Datos Sesiones
								$datoSesion->save(false);
								
								//guardando los datos de Datos Sesiones
								$primera = true;	//la primera posicion siempre es una ejecucion de fase vacia, no se ejecuta
								foreach( $value['ejecucionesFase'] as $key => $ejecFase )
								{
									if( !$primera ){
										
										//Si la fase no tiene id_dato sesion se asigna
										if( !$ejecFase->id_datos_sesiones )
										{
											$ejecFase->id_datos_sesiones = $datoSesion->id;
										}
										
										//Si no tiene id_datos_ieo_profesional se asigna
										if( !$ejecFase->id_datos_ieo_profesional )
										{
											$ejecFase->id_datos_ieo_profesional = $datosIeoProfesional->id;
										}
										
										$ejecFase->anio = $anio;
										$ejecFase->save(false);
										
										$value['ejecucionesFase'][$key]->docente = explode( ",", $ejecFase->docente );
									}
									$primera = false;
								}
							}
						}
						
						$condicionesInstitucionales->id_datos_ieo_profesional = $datosIeoProfesional->id;
						$condicionesInstitucionales->id_fase = $this->id_fase;
						$condicionesInstitucionales->anio = $anio;
						$condicionesInstitucionales->estado = 1;
						
						$condicionesInstitucionales->save(false);
						
						$guardado = true;
					}
					else
					{
						// echo "Hubo un error...";
					}
				}
			}
		}
	
		if( $datosIeoProfesional->id_profesional_a ){
			
			$dataPersonas 		= Personas::find()
									->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
									->andWhere( 'id='.$datosIeoProfesional->id_profesional_a )
									->all();
			
			$profesionales		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		}
		else{
			$profesionales		= [];
		}
		
		$dataEspecialidades = EspecialidadesTecnicas::findOne( $institucion->especialidad );
		
		$especialidades = [ $dataEspecialidades->id => $dataEspecialidades->descripcion ];
		
		
		if( empty( $sesiones ) )
		{
			$sesiones = Sesiones::find()
							->where( 'id_fase=1' )
							->andWhere( 'estado=1' )
							->andWhere( "descripcion='Sesión 1'" )
							->all();
			
			//Verifico que la variable datosModelos tenga al menos una posicion por id de sesion
			//Si en alguna posicion no hay nada, creo los datos vacios
			foreach( $sesiones as $keySesion => $sesion ){
				
				if( !isset( $datosModelos[ $sesion->id ] ) )
				{
					// $datosModelos[ $sesion->id ][ 0 ][] = new EjecucionFase();
					$datosModelos[ $sesion->id ][ 'dataSesion' ] 		= new DatosSesiones();
					$datosModelos[ $sesion->id ][ 'ejecucionesFase' ][] = new EjecucionFase();
				}
				else{
					foreach( $docentesArray + $datosModelos[ $sesion->id ][ 'ejecucionesFase' ] as $ef ){
						$docentesArray = $docentesArray + $ef->docente;
					}
				}
			}
		}
		
		if( !empty( $sesiones ) )
		{	
			foreach( $sesiones as $keySesion => $sesion1 )
			{	
				foreach( $datosModelos[ $sesion1->id ][ 'ejecucionesFase' ] as $ef )
				{
					if( is_array( $ef->docente ) ){
						$docentesArray = array_merge( $docentesArray , $ef->docente );
					}
				}
			}
		}
		
		if( !empty( $docentesArray ) ){
			
			$dataPersonas 		= Personas::find()
									->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
									->andWhere( [ 'in', 'id', $docentesArray ] )
									->all();
			
			$docentes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		}
		else{
			$docentes		= [];
		}
		
		return $this->render('create', [
            'model' 				=>  [ new EjecucionFase() ]+$ejecucionFase,
            'fase'  				=> $fase,
            'institucion'			=> $institucion,
            'sede' 		 			=> $sede,
            'docentes' 				=> $docentes,
            'sesiones' 				=> $sesiones,	//Eso se pasa a la vista sesiones
            'datosIeoProfesional'	=> $datosIeoProfesional,
			'condiciones'			=> $condicionesInstitucionales,
			'datosModelos'			=> $datosModelos,
			'guardado'				=> $guardado,
			// 'ciclo'					=> $ciclo,
            'profesionales'			=> $profesionales,
            'anio'					=> $anio,
            'esDocente'				=> $esDocente,
            'especialidades'		=> $especialidades,
        ]);
	
	}
	
    /**
     * Creates a new EjecucionFase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		// echo "<pre>"; var_dump( Yii::$app->request->get() ); echo "</pre>";
		// echo "<pre>"; var_dump( Yii::$app->request->post() ); echo "</pre>";
		
		return $this->actionCreateAll();
		
	
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
        $model = new EjecucionFase();
		
		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
		
		$fase  = Fases::findOne( $this->id_fase );
		
		$datosIeoProfesional  = new DatosIeoProfesional();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
        // }
		
		
		
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		
		$docentes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		$sesiones = Sesiones::find()
						->where( 'id_fase=1' )
						->andWhere( 'estado=1' )
						->all();

		$personas = new Personas();				
		// $personas->id = Yii::$app->request->post('Personas')['id'] ? Yii::$app->request->post('Personas')['id'] : '';
		$personas->setAttributes( Yii::$app->request->post('Personas'), false );
		$datosIeoProfesional->setAttributes( Yii::$app->request->post('DatosIeoProfesional'), false );
		
		$condiciones = new CondicionesInstitucionales();
		
        return $this->render('create', [
            'model' 				=> $model,
            'fase'  				=> $fase,
            'institucion'			=> $institucion,
            'sede' 		 			=> $sede,
            'docentes' 				=> $docentes,
            'sesiones' 				=> $sesiones,	//Eso se pasa a la vista sesiones
            // 'personas'	 			=> $personas,
            'datosIeoProfesional'	=> $datosIeoProfesional,
			'condiciones'			=> $condiciones,
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
