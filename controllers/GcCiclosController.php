<?php
/**********
Versión: 001
Fecha: 2019-01-29
Desarrollador: Edwin Molina Grisales
Descripción: Ciclos
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
use app\models\GcCiclos;
use app\models\GcCiclosBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\GcSemanas;
use app\models\GcBitacora;
use app\models\GcDocentesXBitacora;
use app\models\Personas;
use yii\helpers\ArrayHelper;
/**
 * GcCiclosController implements the CRUD actions for GcCiclos model.
 */
class GcCiclosController extends Controller
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
     * Lists all GcCiclos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GcCiclosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere( 'estado=1' );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GcCiclos model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$modelCiclo 			= GcCiclos::findOne( $id );
		$modelBitacora 			= GcBitacora::findOne([ 'id_ciclo' => $id ]);
		$modelDocentesXBitacora	= GcDocentesXBitacora::findAll([ 'id_bitacora' => $modelBitacora->id ]);
		$modelSemanas			= GcSemanas::findAll([ 'id_ciclo' => $id ]);
		
        return $this->renderAjax('view', [
			'modelCiclo' 			=> $modelCiclo,
            'modelBitacora' 		=> $modelBitacora,
            'modelSemanas' 			=> $modelSemanas,
            'modelDocentesXBitacora'=> $modelDocentesXBitacora,
        ]);
    }

    /**
     * Creates a new GcCiclos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$id_institucion	= $_SESSION['instituciones'][0];
		$id_sede 		= $_SESSION['sede'][0];
		
		$modelCiclo 				= new GcCiclos();
        $modelBitacora 				= new GcBitacora();
        $modelSemanas				= [];
        $modelDocentesXBitacora		= []; //new GcDocentesXBitacora();
		$modelDatosDocentesXBitacora= [];
		
		if( Yii::$app->request->post() )
		{
			$idGcCiclos		= Yii::$app->request->post( 'GcCiclos' )['id'];
			$idGcBitacora	= Yii::$app->request->post( 'GcBitacora' )['id'];
			
			if( $idGcCiclos )
			{
				$modelCiclo = GcCiclos::findOne($idGcCiclos);
				$modelCiclo->load( Yii::$app->request->post() );
			}
			
			if( $idGcBitacora )
			{
				$modelBitacora 			= GcBitacora::findOne( $idGcBitacora );
			}
			
			$docentesUsuario = Yii::$app->request->post('GcDocentesXBitacora')['docente'];
				
			foreach( $docentesUsuario as $key => $docent )
			{
				$mdb = new GcDocentesXBitacora();
				$mdb->docente = $docent;
				$modelDocentesXBitacora[] = $mdb;
			}

			$datosSemanas = Yii::$app->request->post( 'GcSemanas' );

			if( count($datosSemanas) > 0 )
			{
				foreach( $datosSemanas as $keySemana => $semana )
				{	
					if( $semana['id'] ){
						$mdSemana = GcSemanas::findOne( $semana['id'] );
					}
					else{
						$mdSemana = new GcSemanas();
					}
					
					$mdSemana->load( $semana, '' );
					
					$modelSemanas[]			= $mdSemana;
				}
			}
			
			$valido = true;
			
			if( $modelCiclo->load(Yii::$app->request->post()) ){
				
				$valido = $modelCiclo->validate([
									'fecha',
									'descripcion',
									'fecha_inicio',
									'fecha_finalizacion',
									'fecha_cierre',
									'fecha_maxima_acceso',
									'id_creador',
								]) && $valido;
				echo $valido ? '<br>true ciclo' : '<br>false ciclo';
								
				foreach( $modelDocentesXBitacora as $key => $model )
				{
					$valido = $model->validate([
										'docente',
									]) && $valido;
				}
				echo $valido ? '<br>true dcxbit' : '<br>false dcxbit';
				foreach( $modelSemanas as $key => $semana )
				{
					$valido = $semana->validate([
												'descripcion',
												'fecha_inicio',
												'fecha_finalizacion',
												'fecha_cierre',
											]) && $valido;
				}
				echo $valido ? '<br>true sem' : '<br>false sem';
				// return $this->redirect(['index']);
			}
			
			if( $valido )
			{
				if( $modelCiclo->load(Yii::$app->request->post()) ){
					
					$modelCiclo->estado = 1;
					$modelCiclo->save( false );
					
					$modelBitacora->id_ciclo 	= $modelCiclo->id;
					// $modelBitacora->id_sede 	= $id_sede;
					$modelBitacora->estado 		= 1;
					$modelBitacora->save( false );
					
					//Elimino todos los registros y luego se insetar todos los seleccionados por el usuario
					GcDocentesXBitacora::deleteAll( 'id_bitacora='.$modelBitacora->id );
					
					foreach( $modelDocentesXBitacora as $key => $model )
					{
						$model->id_bitacora = $modelBitacora->id;
						$model->estado = 1;
						$model->save( false );
					}
					
					foreach( $modelSemanas as $key => $semana )
					{
						$semana->estado = 1;
						$semana->id_ciclo = $modelCiclo->id;
						$semana->save(false);
					}
					
					return $this->redirect(['index']);
				}
			}
		}
		else if( Yii::$app->request->get() )
		{
			$id_ciclo = Yii::$app->request->get('id');
			
			if( $id_ciclo )
			{
				$modelCiclo 			= GcCiclos::findOne( $id_ciclo );
				$modelBitacora 			= GcBitacora::findOne([ 'id_ciclo' => $id_ciclo ]);
				$modelDocentesXBitacora	= GcDocentesXBitacora::findAll([ 'id_bitacora' => $modelBitacora->id ]);
				$modelSemanas			= GcSemanas::findAll([ 'id_ciclo' => $id_ciclo ]);
			}
		}
		
		/*Se realiza consulta provisonal para obtener listado de docentes*/
		$dataPersonas 		= Personas::find()
									->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
									->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
									->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
									->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
									->where( 'personas.estado=1' )
									->andWhere( 'id_institucion='.$id_institucion )
									->all();
		
		$docentes		= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		

		if( count($modelDocentesXBitacora) > 0 )
		{
			foreach( $modelDocentesXBitacora as $key => $value){
				$modelDatosDocentesXBitacora[] = $value->docente;
			}
		}
		
		$modelDocentesXBitacora = new GcDocentesXBitacora();
		$modelDocentesXBitacora->docente = $modelDatosDocentesXBitacora;

        return $this->renderAjax('create', [
            'modelCiclo' 			=> $modelCiclo,
            'modelBitacora' 		=> $modelBitacora,
            'modelSemanas' 			=> array_merge( [ new GcSemanas() ], $modelSemanas ),
            'modelDocentesXBitacora'=> $modelDocentesXBitacora,
            'docentes'				=> $docentes,
        ]);
    }

    /**
     * Updates an existing GcCiclos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GcCiclos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
		
		$modelCiclo 			= GcCiclos::findOne( $id );
		$modelBitacora 			= GcBitacora::findOne([ 'id_ciclo' => $id ]);
		$modelDocentesXBitacora	= GcDocentesXBitacora::findAll([ 'id_bitacora' => $modelBitacora->id ]);
		$modelSemanas			= GcSemanas::findAll([ 'id_ciclo' => $id ]);
		
		$modelCiclo->estado = 2;
		$modelBitacora->estado = 2;
		
		$modelCiclo->save(false);
		$modelBitacora->save(false);
		
		foreach( $modelDocentesXBitacora as $key => $model ){
			$model->estado = 2;
			$model->save(false);
		}
		
		foreach( $modelSemanas as $key => $model ){
			$model->estado = 2;
			$model->save(false);
		}

        return $this->redirect(['index']);
    }

    /**
     * Finds the GcCiclos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GcCiclos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GcCiclos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
