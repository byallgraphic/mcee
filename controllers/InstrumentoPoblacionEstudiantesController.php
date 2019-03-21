<?php

/**********
Versión: 001
Fecha: 2018-09-06
Desarrollador: Edwin Molina Grisales
Descripción: Controlador InstrumentoPoblacionEstudiantesController
---------------------------------------
*/

namespace app\controllers;

use Yii;
use app\models\InstrumentoPoblacionEstudiantes;
use app\models\InstrumentoPoblacionEstudiantesBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;
use app\models\Estados;
use app\models\Fases;
use app\models\Sesiones;
use app\models\PoblacionEstudiantesSesion;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use yii\db\Query;

use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

use app\models\Paralelos;
use app\models\Generos;
use app\models\TiposIdentificaciones;
use app\models\Jornadas;
use app\models\AcuerdosInstitucionalesEstudiantes;
use app\models\SemillerosTicCiclos;
use app\models\SemillerosTicAnio;

use app\models\SemillerosTicDatosIeoProfesionalEstudiantes;
use app\models\SemillerosTicEjecucionFaseIEstudiantes;
use app\models\SemillerosTicEjecucionFaseIiEstudiantes;
use app\models\SemillerosTicEjecucionFaseIiiEstudiantes;
// use app\models\TiposIdentificaciones;



/**
 * InstrumentoPoblacionEstudiantesController implements the CRUD actions for InstrumentoPoblacionEstudiantes model.
 */
class InstrumentoPoblacionEstudiantesController extends Controller
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
	
	function actionSede(){
		
		$sede 		 = Yii::$app->request->post('sede');
		$institucion = Yii::$app->request->post('institucion');
		
		$sede 		 = Sedes::findOne( $sede );
		$institucion = Instituciones::findOne( $institucion );
		
		return $this->renderPartial( 'sede', [
			'sede' 		=> $sede,
			'institucion' 	=> $institucion,
        ]);
	}
	
	function actionEstudiantes()
	{
		return;
		
		$estudiante = Yii::$app->request->post('estudiante');
		
		$persona = Personas::findOne( $estudiante );
		
		return $this->renderPartial( 'estudiantes', [
			'persona' 	=> $persona,
        ]);
	}
	
	function actionEstudiantesPorSede()
	{	
		
		$sede = Yii::$app->request->get('sede');
		
		$data = Personas::find()
					->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
					->innerJoin( 'estudiantes e', 'e.id_perfiles_x_personas=pp.id' )
					->innerJoin( 'paralelos p', 'p.id=e.id_paralelos' )
					->innerJoin( 'sedes_niveles sn', 'sn.id=p.id_sedes_niveles' )
					->where( 'sn.id_sedes='.$sede )
					->andWhere( 'pp.estado=1' )
					->andWhere( 'e.estado=1' )
					->andWhere( 'p.estado=1' )
					->andWhere( 'personas.estado=1' )
					->all();
		
		return Json::encode( $data );
	}
	
	function actionViewFases()
	{
		$institucion 	= Yii::$app->request->post()['institucion'];
		$sede 			= Yii::$app->request->post()['sede'];
		$estudiante		= Yii::$app->request->post()['estudiante'];
		
		// {"10-1":["10"],"4-1":["3","9"]}
		
		$datos = [];
		

		// $acuerdos = AcuerdosInstitucionalesEstudiantes::find()
							// ->where( 'estado=1' )
							// // ->andWhere( "'".$docente."' = ANY(string_to_array(id_docente,','))" )
							// ->all();
		
		// foreach( $acuerdos as $k => $v ){
			// $f = Fases::findOne( $v->id_fase );
			// $ciclos = SemillerosTicCiclos::findOne( $v->id_ciclo );
			// $anio = SemillerosTicAnio::findOne( $ciclos->id_anio );
			// $datos['Creación'][ $f->descripcion ][] = $anio->descripcion;
			// $datos['Fase'][ $f->descripcion ][] = $anio->descripcion;
		// }
		
		
		if( !empty($estudiante) && is_numeric($estudiante) )
		{
			$dataPersonas 		= Personas::find()
										->select( "( nombres || ' ' || apellidos ) as nombres, personas.id, personas.identificacion, personas.id_tipos_identificaciones" )
										->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
										->innerJoin( 'estudiantes e', 'e.id_perfiles_x_personas=pp.id' )
										->innerJoin( 'paralelos p', 'p.id=e.id_paralelos' )
										->innerJoin( 'sedes_niveles sn', 'sn.id=p.id_sedes_niveles' )
										->where( 'sn.id_sedes='.$sede )
										->andWhere( 'pp.estado=1' )
										->andWhere( 'e.estado=1' )
										->andWhere( 'p.estado=1' )
										->andWhere( 'personas.estado=1' )
										->andWhere( 'personas.id='.$estudiante )
										->all();
			
		}
		else
		{	
			$dataPersonas 		= Personas::find()
										->select( "( nombres || ' ' || apellidos ) as nombres, personas.id, personas.identificacion, personas.id_tipos_identificaciones" )
										->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
										->innerJoin( 'estudiantes e', 'e.id_perfiles_x_personas=pp.id' )
										->innerJoin( 'paralelos p', 'p.id=e.id_paralelos' )
										->innerJoin( 'sedes_niveles sn', 'sn.id=p.id_sedes_niveles' )
										->where( 'sn.id_sedes='.$sede )
										->andWhere( 'pp.estado=1' )
										->andWhere( 'e.estado=1' )
										->andWhere( 'p.estado=1' )
										->andWhere( 'personas.estado=1' )
										->all();
			
		}
		
		
		foreach( $dataPersonas as $key => $estudiante )
		{
			$agregar = false;
			
			$ti = TiposIdentificaciones::findOne( $estudiante['id_tipos_identificaciones'] );
			
			$paralelos = Paralelos::find()
								->innerJoin( 'estudiantes e', 'e.id_paralelos=paralelos.id' )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id=e.id_perfiles_x_personas' )
								->innerJoin( 'personas p', 'p.id=pp.id_personas' )
								->innerJoin( 'sedes_niveles sn', 'sn.id=paralelos.id_sedes_niveles' )
								->where( 'p.id='.$estudiante['id'] )
								->andWhere( 'pp.estado=1' )
								->andWhere( 'e.estado=1' )
								->andWhere( 'paralelos.estado=1' )
								->andWhere( 'p.estado=1' )
								->one();
			
			// var_dump( $docente['id'] ); exit();
			$dato = [
						"{$estudiante['id']}" 	=> 	[
								'info'		=> 	[ 
													'nombre' 				=> $estudiante['nombres'], 
													'tipoIdentificacion' 	=> $ti ? $ti->descripcion : 'Sin Identificación', 
													'numeroIdentificacion' 	=> $estudiante['identificacion'],
													'curso' 				=> $paralelos->descripcion,
												],
								'Creación'	=> 	[],
								'Fases'		=> 	[],
							],
					];
					
					
			// $acuerdos		AcuerdosInstitucionalesEstudiantes::find()
						// ->where( 'estado=1' )
						// ->all();
			
			$acuerdos = AcuerdosInstitucionalesEstudiantes::find()
								->where( 'estado=1' )
								->andWhere( "estudiantes_id LIKE '%\"".$estudiante['id']."\"%'" )
								->all();
			
			foreach( $acuerdos as $k => $v ){
				$agregar = true;
				$dato[ $estudiante->id ]['Creación'][ $v->id_fase ][] = $v->anio;
			}			
						
			
					
			$fase1 = SemillerosTicEjecucionFaseIEstudiantes::find()
								->alias( 'f1' )
								// ->innerJoin( 'semilleros_tic.datos_ieo_profesional_estudiantes dpe', 'dpe.id=f1.id_datos_ieo_profesional_estudiantes' )
								->where( 'f1.estado=1' )
								// ->andWhere( 'dpe.estado=1' )
								->andWhere( "f1.estudiantes_id LIKE '%\"".$estudiante['id']."\"%'" )
								->all();
								
			foreach( $fase1 as $k => $v ){
				$agregar = true;
				$dato[ $estudiante->id ]['Fases'][ $v->id_fase ][] = $v->anio;
			}
			
			$fase2 = SemillerosTicEjecucionFaseIiEstudiantes::find()
								->alias( 'f2' )
								// ->innerJoin( 'semilleros_tic.datos_ieo_profesional_estudiantes dpe', 'dpe.id=f2.id_datos_ieo_profesional_estudiantes' )
								->where( 'f2.estado=1' )
								// ->andWhere( 'dpe.estado=1' )
								->andWhere( "f2.estudiantes_id LIKE '%\"".$estudiante['id']."\"%'" )
								->all();
								
			foreach( $fase2 as $k => $v ){
				$agregar = true;
				$dato[ $estudiante->id ]['Fases'][ $v->id_fase ][] = $v->anio;
			}
			
			$fase3 = SemillerosTicEjecucionFaseIiiEstudiantes::find()
								->alias( 'f3' )
								// ->innerJoin( 'semilleros_tic.datos_ieo_profesional_estudiantes dpe', 'dpe.id=f3.id_datos_ieo_profesional_estudiantes' )
								->where( 'f3.estado=1' )
								// ->andWhere( 'dpe.estado=1' )
								->andWhere( "f3.estudiantes_id LIKE '%\"".$estudiante['id']."\"%'" )
								->all();
								
			foreach( $fase3 as $k => $v ){
				$agregar = true;
				$dato[ $estudiante->id ]['Fases'][ $v->id_fase ][] = $v->anio;
			}
			
			// $dato[ $estudiante->id ]['Fases'][ 1 ][] = rand(2016,2019);
			// $dato[ $estudiante->id ]['Fases'][ 2 ][] = rand(2016,2019);
			// $dato[ $estudiante->id ]['Fases'][ 3 ][] = rand(2016,2019);
			
			// $dato[ $estudiante->id ]['Creación'][ 1 ][] = rand(2016,2019);
			// $dato[ $estudiante->id ]['Creación'][ 2 ][] = rand(2016,2019);
			// $dato[ $estudiante->id ]['Creación'][ 3 ][] = rand(2016,2019);
			
			if( $agregar )
			{
				$datos[] = $dato;
			}
		}
		
		$fases	= Fases::find()
					->where('estado=1')
					->orderby( 'descripcion' )
					->all();
		
		return $this->renderPartial('fases', [
			// 'idPE' 	=> $idPE,
			'fases' => $fases,
			'datos' => $datos,
        ]);
		
	}
	
    /**
     * Lists all InstrumentoPoblacionEstudiantes models.
     * @return mixed
     */
    public function actionIndex()
    {
		$sede 			= $_SESSION['sede'][0];
		$institucion	= $_SESSION['instituciones'][0];
		
		$queryFasesSesiones = new Query();
		
		$dataFasesSesiones = $queryFasesSesiones
								->select( "f.id as fid, f.descripcion as fdesc, s.id as sid, s.descripcion sdesc " )
								->from( 'semilleros_tic.fases f' )
								->innerJoin( 'semilleros_tic.sesiones s', 's.id_fase=f.id' )
								->where( 'f.estado=1' )
								->andWhere( 's.estado=1' )
								->orderby( 'f.descripcion, s.descripcion' )
								->all();
		
		$headersFases = [];
		$headersSesiones = [];
		
		foreach( $dataFasesSesiones as $key => $value ){
			
			if( !isset( $headersFases[ $value['fdesc'] ] ) )
			{
				$headersFases[ $value['fdesc'] ] = 0;
			}
			
			$headersSesiones[ $value['sdesc'] ] = $value['sid'];
			$headersFases[ $value['fdesc'] ]++;
		}
		
		// $query = new Query();
		// // compose the query
		// $query->select('*')
			  // ->from( 'semilleros_tic.instrumento_poblacion_estudiantes	ipe' )
			  // ->innerJoin( 'semilleros_tic.poblacion_estudiantes_sesion pes', 'pes.id_poblacion_estudiantes=ipe.id' )
			  // ->innerJoin( 'semilleros_tic.sesiones s', 's.id=pes.id_sesiones' )
			  // ->innerJoin( 'semilleros_tic.fases f', 'f.id=s.id_fase' )
			  // ->innerJoin( 'personas pe', 'pe.id=ipe.id_persona_estudiante' )
			  // ->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=pe.id' )
			  // ->innerJoin( 'estudiantes e', 'e.id_perfiles_x_personas=pp.id' )
			  // ->innerJoin( 'paralelos p', 'p.id=e.id_paralelos' )
			  // ->innerJoin( 'sedes_niveles sn', 'sn.id=p.id_sedes_niveles' )
			  // ->where( 'sn.id_sedes='.$sede )
			  // ->andWhere( 'ipe.id_institucion='.$institucion )
			  // ->andWhere( 'ipe.id_sede='.$sede )
			  // ->andWhere( 'pp.estado=1' )
			  // ->andWhere( 'e.estado=1' )
			  // ->andWhere( 'p.estado=1' )
			  // ->andWhere( 'pe.estado=1' )
			  // ->andWhere( 'ipe.estado=1' )
			  // ->all();
		
		// echo "<pre>".$query->createCommand()->sql."</pre>";
		
        $searchModel = new InstrumentoPoblacionEstudiantesBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$data = [];
		$i = 0;
		foreach( $dataProvider->query->all() as $datap ){
			
			$persona = Personas::findOne( $datap->id_persona_estudiante ); 
			$sexo	 = Generos::findOne( $persona->id_generos );
						
			$paralelos = Paralelos::find()
							->innerJoin( 'estudiantes e', 'e.id_paralelos=paralelos.id' )
							->innerJoin( 'perfiles_x_personas pp', 'pp.id=e.id_perfiles_x_personas' )
							->innerJoin( 'personas p', 'p.id=pp.id_personas' )
							->innerJoin( 'sedes_niveles sn', 'sn.id=paralelos.id_sedes_niveles' )
							->where( 'p.id='.$persona->id )
							->andWhere( 'pp.estado=1' )
							->andWhere( 'e.estado=1' )
							->andWhere( 'paralelos.estado=1' )
							->andWhere( 'p.estado=1' )
							->one();
		
			$jornada = Jornadas::find()
							->innerJoin( 'sedes_jornadas sj', 'sj.id_jornadas=jornadas.id' )
							->innerJoin( 'paralelos p', 'p.id_sedes_jornadas=sj.id' )
							->where( 'p.id='.$paralelos->id )
							->one();

			$edad = "Sin fecha de nacimiento";
			if( $persona->fecha_nacimiento && $persona->fecha_nacimiento!= NULL && !empty( $persona->fecha_nacimiento ) ){
				$cumpleanos = new \DateTime( $persona->fecha_nacimiento );
				$hoy 		= new \DateTime();
				$edad 		= $hoy->diff($cumpleanos)->y;
				// $edad 	   .= " años";
			}

			$genero = "Género no registrado";
			if( $persona->id_generos && $persona->id_generos!= NULL && !empty( $persona->id_generos ) ){
				
				$g = Generos::findOne( $persona->id_generos);
				$genero = $g->descripcion;
			}
			
			// $data[$i]['institucion'] 	= Instituciones::findOne( $institucion );
			// $data[$i]['sede'] 			= Sedes::findOne( $sede );
			// $data[$i]['nombres'] 		= $persona->nombres." ".$persona->apellidos;
			// $data[$i]['genero'] 		= $genero;
			// $data[$i]['identificacion'] = $persona->identificacion;
			// $data[$i]['edad'] 			= $edad;
			// $data[$i]['grupo'] 			= explode( "-", $paralelos->descripcion )[0];
			// $data[$i]['curso'] 			= $paralelos->descripcion;
			// $data[$i]['jornada'] 		= $jornada ? $jornada->descripcion : ' no registrada';
			
			
			
			$data[ $datap->id_institucion.'-'.$datap->id_sede ][] = [
				'institucion' 	=> Instituciones::findOne( $datap->id_institucion ),
				'sede' 			=> Sedes::findOne( $datap->id_sede ),
				'nombres' 		=> $persona->nombres." ".$persona->apellidos,
				'genero' 		=> $genero,
				'identificacion'=> $persona->identificacion,
				'edad' 			=> $edad,
				'grupo'			=> explode( "-", $paralelos->descripcion )[0],
				'curso'			=> $paralelos->descripcion,
				'jornada' 		=> $jornada ? $jornada->descripcion : ' no registrada',
			];
			
			$i++;
		}

        return $this->render('index', [
            'searchModel' 	=> $searchModel,
            'dataProvider' 	=> $dataProvider,
            'datos'			=> $data,
            'institucion' 	=> Instituciones::findOne( $institucion ),
            'sede' 			=> Sedes::findOne( $sede ),
        ]);
    }

    /**
     * Displays a single InstrumentoPoblacionEstudiantes model.
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
     * Creates a new InstrumentoPoblacionEstudiantes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGuardar()
	{
		// echo "<pre>"; var_dump( $_POST );  echo "</pre>"; exit();
		$data = [
					'error' => 0,
					'msg' => '',
					'html' => '',
				];
		
		$instrumentoPoblacionEstudiantes = Yii::$app->request->post()['InstrumentoPoblacionEstudiantes'];
		
		$model = InstrumentoPoblacionEstudiantes::findOne([
						'id_institucion' 		=> $instrumentoPoblacionEstudiantes[ 'id_institucion' ],
						'id_sede' 				=> $instrumentoPoblacionEstudiantes[ 'id_sede' ],
						'id_persona_estudiante' => $instrumentoPoblacionEstudiantes[ 'id_persona_estudiante' ],
						'estado' 				=> '1',
					]);
					
		if( !$model ){
			$model = new InstrumentoPoblacionEstudiantes();
		}
		
		if( $model->load(Yii::$app->request->post()) )
		{
			if( $model->save() ){
				
				$poblaciones = Yii::$app->request->post()['PoblacionEstudiantesSesion'];
				
				foreach( $poblaciones as $key => $poblacion ){
					$modelp	=	PoblacionEstudiantesSesion::findOne([
									'id_poblacion_estudiantes' 	=> $model->id,
									'id_sesiones' 				=> $poblacion[ 'id_sesiones' ],
								]);
					
					if( !$modelp ){
						$modelp	=	new PoblacionEstudiantesSesion();
					}
					
					$modelp->id_poblacion_estudiantes	= $model->id;
					$modelp->id_sesiones				= $poblacion[ 'id_sesiones' ];
					$modelp->valor						= $poblacion[ 'valor' ];
					$modelp->save( false );
				}
				// else{
					// $data['error'] 	= 2;
					// $data['msg'] 	= 'No guarda los datos del estudiantes';
				// }
				
				// return $this->redirect(['view', 'id' => $model->id]);
			}
			else{
				$data['error'] 	= 2;
				$data['msg'] 	= 'No guarda los datos del estudiantes';
			}
        }
		else{
			$data['error'] 	= 1;
			$data['msg'] 	= 'No carga el modelo InstrumentoPoblacionEstudiantes';
		}
		
		// echo json_encode( $data );
		return Json::encode( $data );
	}
	
    public function actionCreate()
    {
		
		$anio = Yii::$app->request->get('anio');
		$esDocente = Yii::$app->request->get('esDocente');
		
		// echo "<pre>"; var_dump( $_POST );  echo "</pre>"; exit();
        $model = new InstrumentoPoblacionEstudiantes();
		
		$dataInstituciones 	= Instituciones::find()
								->where( 'estado=1' )
								->all();
		
		$instituciones		= ArrayHelper::map( $dataInstituciones, 'id', 'descripcion' );
		
		$dataSedes 			= Sedes::find()
								->where( 'estado=1' )
								->all();
		
		$sedes		= ArrayHelper::map( $dataSedes, 'id', 'descripcion' );
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, id" )
								->where( 'estado=1' )
								->all();
		
		$estudiantes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		
		// $dataEstados 		= Estados::find()
								// ->where( 'id=1' )
								// ->all();
		
		// $estados			= ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
		
		// $dataPoblacion 		= PoblacionEstudiantesSesion::find()
								// ->where( 'id=1' )
								// ->all();
		
		// $poblacion			= ArrayHelper::map( $dataPoblacion, 'id', 'descripcion' );
							

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' 		=> $model,
            'instituciones' => $instituciones,
            'sedes' 		=> [],
            'estudiantes'	=> [],
            'estados'		=> 1,
            'anio'			=> $anio,
            'esDocente'		=> $esDocente,
        ]);
    }

    /**
     * Updates an existing InstrumentoPoblacionEstudiantes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$dataInstituciones 	= Instituciones::find()
								->where( 'estado=1' )
								->all();
		
		$instituciones		= ArrayHelper::map( $dataInstituciones, 'id', 'descripcion' );
		
		$dataSedes 			= Sedes::find()
								->where( 'estado=1' )
								->all();
		
		$sedes		= ArrayHelper::map( $dataSedes, 'id', 'descripcion' );
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, id" )
								->where( 'estado=1' )
								->all();
		
		$estudiantes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		
		$dataEstados 		= Estados::find()
								->where( 'id=1' )
								->all();
		
		$estados			= ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
		
		$dataPoblacion 		= PoblacionEstudiantesSesion::find()
								->where( 'id=1' )
								->all();
		
		$poblacion			= ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
							

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'instituciones' => $instituciones,
            'sedes' 		=> $sedes,
            'estudiantes'	=> $estudiantes,
            'estados'		=> $estados,
        ]);
    }

    /**
     * Deletes an existing InstrumentoPoblacionEstudiantes model.
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
     * Finds the InstrumentoPoblacionEstudiantes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InstrumentoPoblacionEstudiantes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InstrumentoPoblacionEstudiantes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
