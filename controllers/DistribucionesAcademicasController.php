<?php

namespace app\controllers;

use Yii;
use app\models\DistribucionesAcademicas;
use app\models\DistribucionesAcademicasBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\Response;

use app\models\Estados;


/**
 * DistribucionesAcademicasController implements the CRUD actions for DistribucionesAcademicas model.
 */
class DistribucionesAcademicasController extends Controller
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
	

    /**
     * Lists all DistribucionesAcademicas models.
     * @return mixed
     */
    public function actionIndex($idInstitucion = 0, $idSedes = 0)
    {
        // Si existe id sedes e institución se muestra la listas de todas las jornadas correspondientes
		if( $idInstitucion != 0 && $idSedes != 0 )
		{
			
			$searchModel = new DistribucionesAcademicasBuscar();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->query->select ("da.id, da.id_asignaturas_x_niveles_sedes, da.id_perfiles_x_personas_docentes, da.id_aulas_x_sedes, da.fecha_ingreso, da.estado, da.id_paralelo_sede");
			$dataProvider->query->from( 'distribuciones_academicas as da, asignaturas_x_niveles_sedes as ans, sedes_niveles as sn');
			$dataProvider->query->andwhere( "da.id_asignaturas_x_niveles_sedes = ans.id
											AND sn.id = ans.id_sedes_niveles
											AND sn.id_sedes = $idSedes
											AND da.estado = 1");
		
			// echo "<pre>"; print_r($dataProvider); echo "</pre>";
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'idSedes' 	=> $idSedes,
				'idInstitucion' => $idInstitucion,
			]);
		}
		else
		{
			// Si el id de institucion o de sedes es 0 se llama a la vista listarInstituciones
			 return $this->render('listarInstituciones',[
				'idSedes' 		=> $idSedes,
				'idInstitucion' => $idInstitucion,
			] );
		}
    }

    /**
     * Displays a single DistribucionesAcademicas model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
		/**
		* Se trae el id de sede desde el aula
		*/
		//variable con la conexion a la base y traer id sede
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("select s.id
											  from aulas as a, sedes as s, distribuciones_academicas as da
											  where da.id_aulas_x_sedes = a.id
											  and a.id_sedes = s.id
											  and a.estado = 1
											  and s.estado = 1
											  group by s.id");
		$idSedes = $command->queryAll();
		$idSedes = $idSedes[0]['id'];
		// /**
		// * Se trae el id de institucion desde sede
		// */
		$command = $connection->createCommand(" select i.id
												  from sedes as s, instituciones as i
												  where s.id_instituciones = i.id
												  and s.estado = 1
												  and i.estado = 1
												  and s.id = $idSedes");
		$idInstitucion = $command->queryAll();
		$idInstitucion = $idInstitucion[0]['id'];
		
		return $this->render('view', [
            'model' => $this->findModel($id),
			'idSedes' 		=> $idSedes,
			'idInstitucion' => $idInstitucion,
        ]);
    }

    /**
     * Creates a new DistribucionesAcademicas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idSedes, $idInstitucion)
    {	
        //se crea una instancia del modelo estados
		$estadosTable 		 	= new Estados();
		//se traen los datos de estados
		$dataestados		 	= $estadosTable->find()->where( 'id=1' )->all();
		//se guardan los datos en un array
		$estados	 	 	 	= ArrayHelper::map( $dataestados, 'id', 'descripcion' );
		
		/**
		* Concexion a la db, llenar select de docentes
		*/
		//variable con la conexion a la base de datos  pe.id=10 es el perfil docente
		$connection = Yii::$app->getDb();
		
		$command = $connection->createCommand("select d.id_perfiles_x_personas as id, concat(p.nombres,' ',p.apellidos) as nombres
												from personas as p, perfiles_x_personas as pp, docentes as d, perfiles as pe
												where p.id= pp.id_personas
												and p.estado=1
												and pp.id_perfiles=pe.id
												and pe.id=10
												and pe.estado=1
												and pp.id= d.id_perfiles_x_personas");
		$result = $command->queryAll();
		//se formatea para que lo reconozca el select
		foreach($result as $key){
			$docentes[$key['id']]=$key['nombres'];
		}
		
		/**
		* Llenar select de aulas por sede
		*/
		$command = $connection->createCommand("SELECT a.id, a.descripcion
												FROM aulas as a, sedes as s
												WHERE a.id_sedes = s.id
												AND a.id_sedes = $idSedes");
		$result = $command->queryAll();
		//se formatea para que lo reconozca el select
		foreach($result as $key){
			$aulas[$key['id']]=$key['descripcion'];
		}
		
		/**
		* Llenar select de paralelo(grupo) por sede
		*/
		$command = $connection->createCommand("SELECT p.id, p.descripcion
												FROM paralelos as p, sedes_niveles as sn
												WHERE sn.id_sedes = p.id_sedes_niveles
												AND sn.id_sedes = $idSedes");
		$result = $command->queryAll();
		//se formatea para que lo reconozca el select
		foreach($result as $key){
			$grupos[$key['id']]=$key['descripcion'];
		}

		$modificar = false;
		
		$model = new DistribucionesAcademicas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'idSedes' => $idSedes,
			'estados'=>$estados,
			'docentes'=>$docentes,
			'aulas'=>$aulas,
			'grupos'=>$grupos,
			'modificar'=>$modificar,
			'niveles_sede'=>'',
			'asignaturas_distribucion'=>'',
			'idInstitucion'=>$idInstitucion,
        ]);
    }

    /**
     * Updates an existing DistribucionesAcademicas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        //se crea una instancia del modelo estados
		$estadosTable 		 	= new Estados();
		//se traen los datos de estadosCiviles
		$dataestados		 	= $estadosTable->find()->all();
		//se guardan los datos en un array
		$estados	 	 	 	= ArrayHelper::map( $dataestados, 'id', 'descripcion' );
		
		/**
		* Se trae el id de sede desde el aula
		*/
		//variable con la conexion a la base y traer id sede
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("select s.id
											  from aulas as a, sedes as s, distribuciones_academicas as da
											  where da.id_aulas_x_sedes = a.id
											  and a.id_sedes = s.id
											  and a.estado = 1
											  and s.estado = 1
											  group by s.id");
		$idSedes = $command->queryAll();
		$idSedes1 = $idSedes[0]['id'];
		// /**
		// * Se trae el id de institucion desde sede
		// */
		$command = $connection->createCommand(" select i.id
												  from sedes as s, instituciones as i
												  where s.id_instituciones = i.id
												  and s.estado = 1
												  and i.estado = 1
												  and s.id = $idSedes1");
		$idInstitucion = $command->queryAll();
		$idInstitucion = $idInstitucion[0]['id'];
		
		/**
		* Concexion a la db, llenar select de docentes
		*/
		//variable con la conexion a la base de datos  pe.id=10 es el perfil docente
		
		
		$command = $connection->createCommand("select d.id_perfiles_x_personas as id, concat(p.nombres,' ',p.apellidos) as nombres
												from personas as p, perfiles_x_personas as pp, docentes as d, perfiles as pe
												where p.id= pp.id_personas
												and p.estado=1
												and pp.id_perfiles=pe.id
												and pe.id=10
												and pe.estado=1
												and pp.id= d.id_perfiles_x_personas");
		$result = $command->queryAll();
		//se formatea para que lo reconozca el select
		foreach($result as $key){
			$docentes[$key['id']]=$key['nombres'];
		}
		
		/**
		* Llenar select de aulas por sede
		*/
		$command = $connection->createCommand("SELECT a.id, a.descripcion
												FROM aulas as a, sedes as s
												WHERE a.id_sedes = s.id
												AND a.id_sedes = $idSedes1");
		$result = $command->queryAll();
		//se formatea para que lo reconozca el select
		foreach($result as $key){
			$aulas[$key['id']]=$key['descripcion'];
		}
		
		/**
		* Llenar select de paralelo(grupo) por sede
		*/
		$command = $connection->createCommand("SELECT p.id, p.descripcion
												FROM paralelos as p, sedes_niveles as sn
												WHERE sn.id_sedes = p.id_sedes_niveles
												AND sn.id_sedes = $idSedes1");
		$result = $command->queryAll();
		//se formatea para que lo reconozca el select
		foreach($result as $key){
			$grupos[$key['id']]=$key['descripcion'];
		}
		
		/**
		* Traer de id_asignaturas_x_niveles_sedes con id de distribuciones academicas
		*/
		$command = $connection->createCommand("select da.id_asignaturas_x_niveles_sedes
												from distribuciones_academicas as da
												where da.id = $id");
		$result = $command->queryAll();
		$id_asignaturas_x_niveles_sedes = $result[0]['id_asignaturas_x_niveles_sedes'];
		
		/**
		* Traer de los niveles de esa sede 
		*/
		$command = $connection->createCommand("SELECT sn.id, n.descripcion
												FROM public.sedes_niveles as sn, niveles as n, asignaturas_x_niveles_sedes as ans
												where sn.id_sedes = $idSedes1
												and sn.id_niveles = n.id
												and n.estado = 1
												and sn.id_niveles = ans.id_sedes_niveles");
		$result = $command->queryAll();
		$niveles_sede = $result[0]['id'];  //ya se tiene el valor del nivel que se selecciono 26 septimo
		
		/**
		* Traer de las asignaturas ya guardada en la asignaturas por niveles sedes 
		*/
		$command = $connection->createCommand("SELECT ans.id, a.descripcion
												FROM asignaturas_x_niveles_sedes as ans, asignaturas as a, sedes_niveles as sn
												WHERE a.estado = 1
												AND a.id = ans.id_asignaturas
												AND ans.id_sedes_niveles = sn.id
												AND sn.id = $niveles_sede
												and ans.id = $id_asignaturas_x_niveles_sedes");
		$result = $command->queryAll();
		$asignaturas_distribucion = $result[0]['id']; 
		
		$modificar = true;
		
		$model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
			'estados'=>$estados,
			'idSedes' => $idSedes1,
			'idInstitucion' => $idInstitucion,
			'docentes'=>$docentes,
			'aulas'=>$aulas,
			'grupos'=>$grupos,
			'niveles_sede'=>$niveles_sede,
			'asignaturas_distribucion'=>$asignaturas_distribucion,
			'modificar'=>$modificar,
        ]);
    }

    /**
     * Deletes an existing DistribucionesAcademicas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();

		// /**
		// * Se trae el id de sede desde el aula
		// */
		//variable con la conexion a la base y traer id sede
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("select s.id
											  from aulas as a, sedes as s, distribuciones_academicas as da
											  where da.id_aulas_x_sedes = a.id
											  and a.id_sedes = s.id
											  and a.estado = 1
											  and s.estado = 1
											  group by s.id");
		$idSedes = $command->queryAll();
		$idSedes = $idSedes[0]['id'];
		// /**
		// * Se trae el id de institucion desde sede
		// */
		$command = $connection->createCommand(" select i.id
												  from sedes as s, instituciones as i
												  where s.id_instituciones = i.id
												  and s.estado = 1
												  and i.estado = 1
												  and s.id = $idSedes");
		$idInstitucion = $command->queryAll();
		$idInstitucion = $idInstitucion[0]['id'];
        
		$model = DistribucionesAcademicas::findOne($id);
		$model->estado = 2;
		$model->update(false);
		
		
		// return $this->redirect('index', [
			// 'idSedes' 		=> $idSedes,
			// 'idInstitucion' => $idInstitucion,
        // ]);
		
		return $this->redirect(['index', 'idInstitucion' => $idInstitucion,'idSedes'=>$idSedes]);
    }

    /**
     * Finds the DistribucionesAcademicas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DistribucionesAcademicas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DistribucionesAcademicas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	
	 /**
     * Esta funcion lista las asignaturas por sede nivel que estan activas.
     * 
     * @param Recibe id sedes nivel
     * @return la lista de asignaturas
     * @throws no tiene excepciones
     */		
  public function actionListarA($idSedesNiveles )
	{
		
		//variable con la conexion a la base de datos
		$connection = Yii::$app->getDb();
		//saber el id de la sede para redicionar al index correctamente
		$command = $connection->createCommand("SELECT ans.id, a.descripcion
												FROM asignaturas_x_niveles_sedes as ans, asignaturas as a, sedes_niveles as sn
												WHERE a.estado = 1
												AND a.id = ans.id_asignaturas
												AND ans.id_sedes_niveles = sn.id
												AND sn.id = $idSedesNiveles");
		$result = $command->queryAll();
		
		 return Json::encode( $result );
		
	
	}
	
  public function actionListarBloques($idSede )
	{
		
		
		return Json::encode( $idSede );
	
	}
	
	 /**
     * Esta funcion lista las institucines que estan activas.
     * 
     * @param Recibe id institucion y el id de sedes
     * @return la lista de insticiones
     * @throws no tiene excepciones
     */
	public function actionListarInstituciones( $idInstitucion = 0, $idSedes = 0 )
    {
        return $this->render('listarInstituciones',[
			'idSedes' 		=> $idSedes,
			'idInstitucion' => $idInstitucion,
		] );
    }

	
	// public function actionListarDistribuciones()
	// {
	// // //variable con la conexion a la base de datos
		// // $connection = Yii::$app->getDb();
		// // //saber el id de la sede para redicionar al index correctamente
		// // $command = $connection->createCommand("
		// // SELECT * FROM distribuciones_academicas");
		// // $result = $command->queryAll();
		
		// $comunasTable	 	 = new DistribucionesAcademicas();
		// $dataComunas		 = $comunasTable->find()->all();
									// // ->where( 'comunas_corregimientos.estado=1' )
									// // ->andWhere( 'comunas_corregimientos.id_municipios='.$idMunicipio )
									
		// $comunas	 	 	 = ArrayHelper::map( $dataComunas, 'id', 'estado' );
		
	// // print_r ($comunas);	
	// return Json::encode( $comunas );	
	
	// }
}