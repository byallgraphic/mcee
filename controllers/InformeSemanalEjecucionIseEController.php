<?php

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
use app\models\InformeSemanalEjecucionIseE;
use app\models\EcTipoCantidadPoblacionIse;
use app\models\EcDocentesIse;
use app\models\EcEstudiantesIse;
use app\models\EcActividadesIse;
use app\models\EcVisitasIse;

use app\models\Instituciones;
use app\models\Sedes;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * InformeSemanalEjecucionIseController implements the CRUD actions for InformeSemanalEjecucionIse model.
 */
class InformeSemanalEjecucionIseEController extends Controller
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


    function actionViewFases($model, $form, $idTipoInforme){
        
      
        //$model = new InformeSemanalEjecucionIse();
        $tipo_poblacion = new EcTipoCantidadPoblacionIse;
        $estudiasntes =  new EcEstudiantesIse;
        $actividades =  new EcActividadesIse;
        $visitas = new EcVisitasIse;

		return $this->renderAjax('fases', [
			'idPE' 	=> null,
			'fases' => ["Proyectos Pedagógicos Transversales", "Ariculación Familiar", "Proyecto de Servicio Social"],
            "tipo_poblacion" => $tipo_poblacion,
            "estudiasntes" => $estudiasntes,
            "actividades" => $actividades,
            "visitas"  => $visitas,
            "form" => $form,
            "idTipoInforme" => $idTipoInforme
        ]);
		
	}

    /**
     * Lists all InformeSemanalEjecucionIse models.
     * @return mixed
     */
    public function actionIndex($guardado = 0, $idTipoInforme = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => InformeSemanalEjecucionIseE::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
            'idTipoInforme' => $idTipoInforme,
        ]);
    }

    /**
     * Displays a single InformeSemanalEjecucionIse model.
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
     * Creates a new InformeSemanalEjecucionIse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InformeSemanalEjecucionIse();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne( $idInstitucion );

        $Sedes = Sedes::find()->where( "id_instituciones =  $idInstitucion" )->all();
		$sedes = ArrayHelper::map( $Sedes, 'id', 'descripcion' );

        if ($model->load(Yii::$app->request->post())) {
            $model->institucion_id =  $idInstitucion;
            //$model->sede_id = 55;
            $model->proyecto_id = 1;
            $model->estado = 1;
            $model->id_tipo_informe = 7;
            $id_informe = 0;

            if($model->save()){
                $id_informe = $model->id;

                $dataActividades = Yii::$app->request->post('EcActividadesIse');
                $modelsActividades = [];

                for( $i = 0; $i < count($dataActividades); $i++ ){
                    $modelsActividades[] = new EcActividadesIse();
                }
                
                if (EcActividadesIse::loadMultiple($modelsActividades, Yii::$app->request->post() )) {
                    foreach( $modelsActividades as $key => $model) {
                        if($model->avance_ieo){
                            $model->informe_semanal_ejecucion_id = $id_informe;
                            $model->nombre= "";
                            $model->estado = 1;

                            if(!$model->save()){
                                var_dump("Error al guarda Actividade ".$key);
                                die();
                            }
                        }
                        
                    }

                }

                $dataCantidadPoblacion = Yii::$app->request->post('EcTipoCantidadPoblacionIse');
                $modelsCantidadPoblacion = [];

                for( $i = 0; $i < count($dataActividades); $i++ ){
                    $modelsCantidadPoblacion[] = new EcTipoCantidadPoblacionIse();
                }

                if (EcTipoCantidadPoblacionIse::loadMultiple($modelsCantidadPoblacion, Yii::$app->request->post() )) {
                    foreach( $modelsCantidadPoblacion as $key => $model) {
                        if($model->edu_derechos){
                            $model->id_informe_semanal_ejecucion_ise = $id_informe;
                            $model->estado = 1;

                            if(!$model->save()){
                                var_dump("Error al guarda Actividade ".$key);
                                die();
                            }

                        }
                    }
                }

                $dataEstudiantes = Yii::$app->request->post('EcEstudiantesIse');
                $modelsEstudiantes = [];

                for( $i = 0; $i < count($dataEstudiantes); $i++ ){
                    $modelsEstudiantes[] = new EcEstudiantesIse();
                }

                if (EcEstudiantesIse::loadMultiple($modelsEstudiantes, Yii::$app->request->post() )) {
                    foreach( $modelsEstudiantes as $key => $model) {
                        if($model->grado_0){
                            
                            $model->id_informe_semanal = $id_informe;
                            $model->estado = 1;
                            $model->total = $model->grado_0 + $model->grado_1 +$model->grado_2 +$model->grado_3 + $model->grado_4 + $model->grado_5 + $model->grado_6 + $model->grado_7 + $model->grado_8 + $model->grado_9 +$model->grado_10+ $model->grado_11;

                            if(!$model->save()){
                                var_dump("Error al guarda Estudiantes ".$key);
                                die();
                            }

                        }
                    }
                }

                $dataVisitas = Yii::$app->request->post('EcVisitasIse');
                $modelsVisitas = [];

                for( $i = 0; $i < count($dataVisitas); $i++ ){
                    $modelsVisitas[] = new EcVisitasIse();
                }

                if (EcVisitasIse::loadMultiple($modelsVisitas, Yii::$app->request->post() )) {
                    foreach( $modelsVisitas as $key => $model) {
                        if($model->cantidad_visitas_realizadas){
                            
                            $model->informe_semanal_ejecucion_id = $id_informe;
                            $model->estado = 1;
                            if(!$model->save()){
                                var_dump("Error al guarda Estudiantes ".$key);
                                die();
                            }

                        }
                    }
                }    
            }

            return $this->redirect(['index', "guardado" => 1, 'idTipoInforme' => $_SESSION["idTipoInforme"]]);
        }
       
        return $this->renderAjax('create', [
            'model' => $model,
            'institucion' => $institucion->descripcion,
            'sedes' => $sedes,
        ]);
    }

    /**
     * Updates an existing InformeSemanalEjecucionIse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing InformeSemanalEjecucionIse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InformeSemanalEjecucionIse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InformeSemanalEjecucionIse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InformeSemanalEjecucionIse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
