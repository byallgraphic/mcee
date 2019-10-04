<?php

/**********
Modificaciones:
Fecha: 2018-11-06
Desarrollador: Edwin Molina Grisales
Descripción: Se hacen modificaciones varias para guardar varios profesionales A, docentes aliados y nombres de docentes
---------------------------------------
Modificaciones:
Fecha: 2019-02-12
Desarrollador: Edwin Molina Grisales
Descripción: Ya no se pide el ciclo y el año viene por url y todas las realiciones con id_ciclo se cambian a año
---------------------------------------
Fecha: 2018-10-29
Desarrollador: Edwin Molina Grisales
Descripción: Se modifican el metodo actionCreate para que se guarden los datos suministrados por el usuarios o se modifiquen.
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
use app\models\SemillerosDatosIeo;
use app\models\SemillerosDatosIeoBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;
use app\models\Estados;
use app\models\Fases;
use app\models\Sesiones;
use app\models\EstudiantesOperativoSesion;
use app\models\Escalafones;
use app\models\Docentes;
use app\models\DistribucionesAcademicas;
use app\models\AcuerdosInstitucionales;
use app\models\Parametro;
use app\models\Jornadas;
use app\models\SemillerosTicCiclos;
use app\models\SemillerosTicAnio;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use yii\db\Query;


/**
 * SemillerosDatosIeoController implements the CRUD actions for SemillerosDatosIeo model.
 */
class SemillerosDatosIeoController extends Controller
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
	
	
	function actionConsultarDocentes(){
		
		$search = $_GET['search'];
		
		$id_institucion	= $_SESSION['instituciones'][0];
		
		 //se crea una instancia del modelo personas
		$personasTable 		 	= new Personas();
		$dataPersonas		 	= $personasTable->find()->select(["id, CONCAT(nombres, ' ', apellidos) AS nombres"])
										->where('estado=1')
										->andWhere( "CONCAT(nombres, ' ', apellidos) ILIKE '%".$search."%'" )
										->all();										  
		
		//se guardan los datos en un array
		$docentes	 	 	 	= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		
		// $dataPersonas 		= Personas::find()
								// ->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								// ->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								// ->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								// ->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								// ->where( 'personas.estado=1' )
								// ->andWhere( 'id_institucion='.$id_institucion )
								// ->andWhere( "CONCAT(nombres, ' ', apellidos) ILIKE '%".$search."%'" )
								// ->all();
		
		// $docentes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		return json_encode( $docentes );
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
     * Lists all SemillerosDatosIeo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SemillerosDatosIeoBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SemillerosDatosIeo model.
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
     * Creates a new SemillerosDatosIeo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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
		
		$id_institucion	= $_SESSION['instituciones'][0];
		$id_sede 		= $_SESSION['sede'][0];
		
		$datosIEO = false;
		
		$datosIEO = SemillerosDatosIeo::findOne([
							'id_institucion' 		=> $id_institucion,
							'sede' 			 		=> $id_sede,
							'anio' 			 		=> $anio,
						]);
		
		if( !$datosIEO )
		{
			$datosIEO = new SemillerosDatosIeo();
			$datosIEO->load( Yii::$app->request->post() );
		}
		else{
			$datosIEO->personal_a		= explode( ",", $datosIEO->personal_a );
			$datosIEO->docente_aliado	= explode( ",", $datosIEO->docente_aliado );
		}
		
		$guardar = Yii::$app->request->post('guardar') == 1 ? true: false;
		$guardado = false;
		
		$modelos = [];
		
		//Busco todas las fases
		$fases	= Fases::find()
					->where('estado=1')
					->orderby( 'descripcion' )
					->all();
		
		//Por cada fase hay un acuerdo institucional
		//La primera es vacia ya que se usa para crear la primera fila y con ella crear las demas dinamicamente
		foreach( $fases as $key => $fase ){
			$modelos[ $fase->id ][] = new AcuerdosInstitucionales();
		}
		
		//Si no se va a guardar se buscan todos los datos guardados
		if( !$guardar )
		{	
			if( $datosIEO->id )
			{ 
				$acuerdos = AcuerdosInstitucionales::find()
								->where( 'estado=1' )
								->andWhere( 'anio='.$anio )
								->andWhere( 'id_semilleros_datos_ieo='.$datosIEO->id )
								->all();
				
				foreach( $acuerdos as $key => $acuerdo )
				{	
					$acuerdo->id_docente = explode( ",", $acuerdo->id_docente );
					$modelos[ $acuerdo->id_fase ][] = $acuerdo;
				}
			}
		}
		else{
			
			$datosIEO->load( Yii::$app->request->post() );
			
			if( is_array( Yii::$app->request->post('AcuerdosInstitucionales') ) )
			{
				foreach( Yii::$app->request->post('AcuerdosInstitucionales') as $id_fase => $acuerdos )
				{
					foreach( $acuerdos as $acuerdo )
					{
						if( !empty( $acuerdo['id'] ) )
						{
							$ac = AcuerdosInstitucionales::findOne( $acuerdo['id'] ); 
						}
						else
						{
							$ac = new AcuerdosInstitucionales(); 
						}
						
						$ac->load( $acuerdo, '');
							
						$modelos[ $id_fase ][] = $ac;
					}
				}
			}
			
			$valido = true;
			
			$valido = $datosIEO->validate([
								'personal_a' 		=> 'Personal A.',
								'docente_aliado' 	=> 'Docente aliado',
							]) && $valido;
			
			foreach( $modelos as $fase_id => $modelo )
			{
				$primera = true;
				foreach( $modelo as $k => $value )
				{
					if( !$primera )
					{	
						$valido = $value->validate([
										'id_docente',
										'asignatura',
										'especialidad',
										'frecuencias_sesiones',
										'jornada',
										'recursos_requeridos',
										'total_docentes',
										'observaciones',
									]) && $valido;
					}
					$primera = false;
				}
			}
			
			if( $valido )
			{
				$datosIEO->estado 			= 1;
				$datosIEO->sede				= $id_sede;
				$datosIEO->personal_a		= implode( ",", $datosIEO->personal_a );
				$datosIEO->docente_aliado	= implode( ",", $datosIEO->docente_aliado );
				$datosIEO->anio				= $anio;
				
				$datosIEO->save( false );
				
				$datosIEO->personal_a		= explode( ",", $datosIEO->personal_a );
				$datosIEO->docente_aliado	= explode( ",", $datosIEO->docente_aliado );
				
				foreach( $modelos as $id_fase => $modelo )
				{	
					$primera = true;
					foreach( $modelo as $k => $value )
					{
						if( !$primera )
						{
							$value->id_semilleros_datos_ieo = $datosIEO->id;
							$value->id_fase 				= $id_fase;
							$value->anio 					= $anio;
							$value->estado 					= 1;
							$value->id_docente 				= implode( ",", $value->id_docente );
							
							$value->save( false );
							
							$value->id_docente 				= explode( ",", $value->id_docente );
						}
						
						$primera = false;
					}
				}
				
				$guardado = true;
			}
		}

       
		
		$institucion = Instituciones::findOne($id_institucion);
		$sede 		 = Sedes::findOne($id_sede);
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		
		$docentes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		
		$dataJornadas 	= Parametro::find()
						->where( 'id_tipo_parametro=7' )
						->andWhere( 'estado=1' )
						->all();

		$jornadas		= ArrayHelper::map( $dataJornadas, 'id', 'descripcion' );
		
		$dataRecursos 	= Parametro::find()
						->where( 'id_tipo_parametro=8' )
						->andWhere( 'estado=1' )
						->all();

		$recursos		= ArrayHelper::map( $dataRecursos, 'id', 'descripcion' );
		
		$dataParametro 	= Parametro::find()
						->where( 'id_tipo_parametro=6' )
						->andWhere( 'estado=1' )
						->orderby( 'id' )
						->all();

		$parametros		= ArrayHelper::map( $dataParametro, 'id', 'descripcion' );
		
		$fases	= Fases::find()
					->where('estado=1')
					->orderby( 'descripcion' )
					->all();

		$profesionales 	  = [];
		$docentes_aliados = [];
		$dataProfesionales = SemillerosDatosIeo::find()
								->alias( 'sdi' )
								->innerJoin( 'semilleros_tic.acuerdos_institucionales ai', 'ai.id_semilleros_datos_ieo=sdi.id' )
								->where( 'sdi.estado=1' )
								->where( 'ai.estado=1' )
								->where( 'ai.anio='.$anio )
								->all();
		
		foreach( $dataProfesionales as $key => $value ){
			$profesionales[] = $value->personal_a;
			$docentes_aliados[ $value->personal_a ] = $value->docente_aliado;
		}
					
        return $this->render('create', [
            'datosIEO' 			=> $datosIEO,
            'institucion' 		=> $institucion,
            'sede' 				=> $sede,
            'docentes' 			=> $docentes,
            'controller'		=> $this,
            'jornadas'			=> $jornadas,
            'recursos'			=> $recursos,
            'parametros'		=> $parametros,
            'fases'				=> $fases,
            'modelos'			=> $modelos,
            'profesionales'		=> $profesionales,
            'docentes_aliados'	=> $docentes_aliados,
            // 'ciclo'				=> $ciclo,
            'guardado'			=> $guardado,
            'anio'				=> $anio,
            'esDocente'			=> $esDocente,
        ]);
    }

    /**
     * Updates an existing SemillerosDatosIeo model.
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
     * Deletes an existing SemillerosDatosIeo model.
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
     * Finds the SemillerosDatosIeo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SemillerosDatosIeo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SemillerosDatosIeo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
