<?php

/**********
Versión: 001 
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Controlador EjecucionFaseIIIController
---------------------------------------
Modificaciones:
Fecha: 2019-02-25
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se pueden agregar sesiones
---------------------------------------
Fecha: 2019-02-25
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se quita campo número de estudiantes cultivadores y docentes creadores se deja como multiplo
---------------------------------------
Fecha: 2019-02-12
Descripción: Ya no se pide el ciclo y el año viene por url y todas las realiciones con id_ciclo se cambian a año
---------------------------------------
Fecha: 2019-02-05
Descripción: Se desagregan DATOS PROFESIONALES y docente creador con respecto a a la conformación de los semilleros
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
use app\models\Sesiones;
use app\models\DatosIeoProfesional;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;
use app\models\SemillerosTicEjecucionFaseIii;
use app\models\SemillerosTicCondicionesInstitucionalesFaseIii;
use app\models\SemillerosTicCiclos;
use app\models\SemillerosTicAnio;
use app\models\SemillerosDatosIeo;
use app\models\AcuerdosInstitucionales;
use app\models\Paralelos;
use app\models\DatosSesiones;
use yii\helpers\ArrayHelper;

/**
 * EjecucionFaseIController implements the CRUD actions for SemillerosTicEjecucionFaseIii model.
 */
class EjecucionFaseIiiController extends Controller
{
	public $id_fase = 3;
	
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
		
		$index 		= Yii::$app->request->get('index');
		$numSesion 	= $index + 1;
		
		$idFase 	= $this->id_fase;
		
		$html_option= "";
		
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
			
			$html_option = "<option value='".$sesion->id."'>".$sesion->descripcion."</option>";
		}
		else{
			$html_option = "<option value='".$sesion->id."'>".$sesion->descripcion."</option>";
		}
		
		echo $html_option;
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
     * Lists all SemillerosTicEjecucionFaseIii models.
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
     * Displays a single SemillerosTicEjecucionFaseIii model.
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
     * Creates a new SemillerosTicEjecucionFaseIii model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		// // echo "<pre>"; var_dump(Yii::$app->request->post()); echo "</pre>";
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
		
		$anio = Yii::$app->request->get('anio');
		$esDocente = Yii::$app->request->get('esDocente');
		
		$guardar = Yii::$app->request->post('guardar') == 1 ? true: false;
		
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
        $model = new SemillerosTicEjecucionFaseIii();
		
		//Solo hay una condicion por fase iii
		$condiciones = SemillerosTicCondicionesInstitucionalesFaseIii::findOne([ 
							'id_fase'	=> $this->id_fase,
							'anio'		=> $anio,
						]);
		
		//Si no existe se crea una vacia
		if( !$condiciones )
		{
			$condiciones = new SemillerosTicCondicionesInstitucionalesFaseIii();
		}
		
		$models[] = [
						'profesionales' => new DatosIeoProfesional([ 'id_institucion' => $id_institucion ]),
						'datosSesion' 	=> new DatosSesiones(),
						'ejecucionFase' => new SemillerosTicEjecucionFaseIii(),
					];
		

		if( !$guardar )
		{
			//Consultando las ejecuciones de fase
			$ejecucionesFases = SemillerosTicEjecucionFaseIii::find()
									->where( 'id_fase='.$this->id_fase )
									->where( 'anio='.$anio )
									->andWhere( 'estado=1' )
									->all();
									
			foreach( $ejecucionesFases as $key => $vEjecucionesFases )
			{
				$datoSesion = DatosSesiones::findOne( $vEjecucionesFases->id_datos_sesion );
				$datoSesion->fecha_sesion = Yii::$app->formatter->asDate($datoSesion->fecha_sesion, "php:d-m-Y");
				
				$vEjecucionesFases->docente_creador = explode( ",", $vEjecucionesFases->docente_creador );
				
				$models[] = [
								'profesionales' => DatosIeoProfesional::findOne( $vEjecucionesFases->id_datos_ieo_profesional ),
								'datosSesion' 	=> $datoSesion,
								'ejecucionFase' => $vEjecucionesFases,
							];
			}
		}
		
		if( Yii::$app->request->post('SemillerosTicEjecucionFaseIii') )
		{
			foreach( Yii::$app->request->post('SemillerosTicEjecucionFaseIii') as $key => $vEjecucionesFases )
			{
				if( !empty( $vEjecucionesFases['id'] ) )
				{
					$ef = SemillerosTicEjecucionFaseIii::findOne( $vEjecucionesFases['id'] );
				}
				else
				{
					$ef = new SemillerosTicEjecucionFaseIii();
				}
				
				//Cargando los datos al modelo
				$ef->load( $vEjecucionesFases, '' );
				
				$datosIeoProfesional = Yii::$app->request->post('DatosIeoProfesional')[$key];
				
				$dp = DatosIeoProfesional::findOne([
										'id_institucion'	=> $id_institucion,
										'id_sede'			=> $id_sede,
										'id_profesional_a'	=> $datosIeoProfesional['id_profesional_a'],
										'estado'			=> 1,
									  ]);
				
				if( !$dp ){
					$dp = new DatosIeoProfesional();
					$dp->id_institucion = $id_institucion;
					$dp->id_sede = $id_sede;
				}
				
				//Cargando los datos al modelo datosIeoProfesional
				$dp->load( $datosIeoProfesional, '' );
				
				
				$postDatosSesiones = Yii::$app->request->post('DatosSesiones')[$key];
				
				$ds = false;
				if( !empty( $postDatosSesiones['id'] ) )
				{
					$ds = DatosSesiones::findOne( $postDatosSesiones['id'] );
				}
				
				if( !$ds ){
					$ds = new DatosSesiones();
				}
				
				
				//Cargando los datos al modelo Datos sesion
				$ds->load( $postDatosSesiones, '' );
				
				$models[] =[
								'datosSesion' 	=> $ds,
								'profesionales' => $dp,
								'ejecucionFase' => $ef,
							];
			}
		}
		
		$condiciones->load( Yii::$app->request->post() );
		
		$guardado = false;
		
		if( Yii::$app->request->isPost && $guardar )
		{
			
			$valido = true;
			
			$esPrimera = true;
			foreach( $models as $key => $value )
			{
				if( !$esPrimera )
				{
					$valido = $value['datosSesion']->validate([
										'id_sesion',
										'fecha_sesion',
									]) && $valido;
									
					$valido = $value['profesionales']->validate([
										'id_institucion' => 'Institución',
										'id_profesional_a' => 'Profesional A',
									]) && $valido;
									
					$value['ejecucionFase']->docente_creador 			= implode( ",", $value['ejecucionFase']->docente_creador );
					
					$valido = $value['ejecucionFase']->validate([
										'docente_creador',
										'asignatura',
										'docente_usuario',
										'grado',
										'numero_apps_usadas',
										'nombre_aplicaciones',
										'tic',
										'tipo_recurso_tic',
										'digitales',
										'tipo_recurso_digital',
										'escolares_no_tic',
										'tipo_recurso_no_tic',
										'tiempo_uso_recurso_tic',
										'observaciones',
										'total_aplicaciones_usadas',
										'numero',
										'tipo_de_produccion',
										'temas_escolares',
										'indice_problematicas',
										'fecha_uso_aplicaciones',
										'estudiantes_cultivadores',
									]) && $valido;
									
					$value['ejecucionFase']->docente_creador			= explode( ",", $value['ejecucionFase']->docente_creador );
					
				}
				$esPrimera = false;
								
			}

			$valido = $condiciones->validate([
							'parte_ieo',
							'parte_univalle',
							'parte_sem',
							'otro',
						]) && $valido;

			if( $valido )
			{
				$esPrimera = true;
				foreach( $models as $key => $value )
				{
					if( !$esPrimera )
					{
						$value['datosSesion']->estado 	= 1;
						$value['datosSesion']->save(false);
						
						$value['profesionales']->estado 	= 1;
						$value['profesionales']->id_sede 	= $id_sede;
						$value['profesionales']->save( false );
						
						$value['ejecucionFase']->id_fase 					= $this->id_fase;
						$value['ejecucionFase']->id_datos_ieo_profesional 	= $value['profesionales']->id;
						$value['ejecucionFase']->estado 					= 1;
						$value['ejecucionFase']->anio 						= $anio;
						$value['ejecucionFase']->docente_creador 			= implode( ",", $value['ejecucionFase']->docente_creador );
						$value['ejecucionFase']->id_datos_sesion			= $value['datosSesion']->id;
						$value['ejecucionFase']->save( false );
						
						$value['ejecucionFase']->docente_creador			= explode( ",", $value['ejecucionFase']->docente_creador );
												
						$condiciones->estado 	= 1;
						$condiciones->id_fase 	= $this->id_fase;
						$condiciones->anio 		= $anio;
						$condiciones->save( false );
						
						$guardado = true;
					}
					$esPrimera = false;
				}
			}
		}
		
		$institucion = Instituciones::find()->all();
		
		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
		
		$fase  = Fases::findOne( $this->id_fase );
		
		$profesional  = new DatosIeoProfesional();
		
		$profesionales = [];
		$dataProfesionales = SemillerosDatosIeo::find()
								->where( 'id_institucion='.$id_institucion )
								->andWhere( 'sede='.$id_sede )
								->andWhere( 'anio='.$anio )
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
								->andWhere( 'anio='.$anio )
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
		
		$dataSesionesFases = 	Sesiones::find()
									->alias( 's' )
									->where( 's.id_fase='.$this->id_fase )
									->andWhere( 's.estado=1' )
									->all();
								
		$listaSesiones	= ArrayHelper::map( $dataSesionesFases, 'id', 'descripcion' );
		
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		
		$docentes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		$profesionales  = $docentes;
		

        return $this->render('create', [
            'model' 		=> $model,
            'models' 		=> $models,
            'fase'  		=> $fase,
            'institucion'	=> $institucion,
            'sede' 		 	=> $sede,
            'docentes' 		=> $docentes,
            'profesional'	=> $profesional,
            'condiciones'	=> $condiciones,
            'guardado'		=> $guardado,
            // 'ciclo'			=> $ciclo,
			'profesionales'	=> $profesionales,
			'cursos'		=> $cursos,
			'listaSesiones'	=> $listaSesiones,
			'anio'			=> $anio,
			'esDocente'		=> $esDocente,
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
