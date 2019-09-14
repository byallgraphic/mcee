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
use app\models\CbacOrientacionProcesoSeguimiento;
use app\models\CbacActividadOps;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\CbacImpOps;

use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CbacOrientacionProcesoSeguimientoController implements the CRUD actions for CbacOrientacionProcesoSeguimiento model.
 */
class CbacOrientacionProcesoSeguimientoController extends Controller
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
     * Lists all CbacOrientacionProcesoSeguimiento models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $query = CbacOrientacionProcesoSeguimiento::find()->where(['estado' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
        ]);
    }

    /**
     * Displays a single CbacOrientacionProcesoSeguimiento model.
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

    function actionViewFases($model, $form, $datos = 0){
        
        $actividades = new CbacActividadOps();
        $impOps = new CbacImpOps();
        $proyectos = [ 
            1 => "Desarrollar herramientas en docentes y directivos docentes de las IEO que implementen componentes artísticos y culturales.",
            2 => "Fortalecer la oferta de programas culturales para estudiantes en el proceso formativo de competencias básicas dentro y fuera del aula.",
            3 => "Promover el acompañamiento de padres de familia desde el arte y la cultura en el proceso de fortalecimiento de competencias básicas de estudiantes de las IEO."
        ];
		
		return $this->renderAjax('fases', [
			'idPE' 	=> null,
            'fases' => $proyectos,
            'form' => $form,
            "model" => $model,
            'actividades_isa' => $actividades,
            'datos' => $datos,
            'impOps'=> $impOps,
        ]);
		
	}

    /**
     * Creates a new CbacOrientacionProcesoSeguimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacOrientacionProcesoSeguimiento();

        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);
        $modelActividadesImp = [];

        if ($model->load(Yii::$app->request->post())) {
            //var_dump($model);
            $model->id_institcion = $idInstitucion;

            if($model->save()){
                $id_ops = $model->id;
                
                if (Yii::$app->request->post('CbacActividadOps')){

                    $data = Yii::$app->request->post('CbacActividadOps');
                    $count 	= count( $data );

                    $modelActividades = [];

                    for( $i = 0; $i < $count; $i++ ){
                        $modelActividades[] = new CbacActividadOps();
                    }

                   

                    if (CbacActividadOps::loadMultiple($modelActividades, Yii::$app->request->post() )) {
                        
                        foreach($modelActividades as $key => $modelActividad) {

                            if($modelActividad->total_sesiones_realizadas and $modelActividad->avance_sede and $modelActividad->avance_ieo){
                                $modelActividad->id_orientacion_proceso_seguimiento = $id_ops;
                                
                                if($modelActividad->save()){
                                    $id_actividad = $modelActividad->id;
                                    if(Yii::$app->request->post('CbacImpOps')){
                                
                                        for ($k=1; $k < 13 ; $k++) { 
                                            if($key == $k){
                                                $modelCount = Yii::$app->request->post('CbacImpOps')[$key]; 
                                                for ($i=1; $i < 9; $i++) { 
                                                    if($modelCount[$i]['semana_1']){
                                                        $impOps = new CbacImpOps();
                                                        $impOps->id_actividad_ops = $id_actividad;
                                                        $impOps->semana_1 = $modelCount[$i]['semana_1'];
                                                        $impOps->semana_2 = $modelCount[$i]['semana_2'];
                                                        $impOps->semana_3 =  $modelCount[$i]['semana_3'];
                                                        $impOps->semana_4 =  $modelCount[$i]['semana_4'];
                                                        $impOps->resumen = $modelCount[$i]['resumen'];
                                                        $impOps->save();
                                                    }
                                                    
                                                }
                                               
                                            }   
                                        }
                                    }
                                }
                            }
                        }
                       
                    }

                }
            }
            
            return $this->redirect(['index', 'guardado' => 1]);
        }

        $Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );

        return $this->renderAjax('create', [
            'model' => $model,
            'sedes' => $sedes,
            'institucion' => $institucion->descripcion,
        ]);
    }

    /**
     * Updates an existing CbacOrientacionProcesoSeguimiento model.
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

        $command = Yii::$app->db->createCommand("SELECT act.id_actividad, act.total_sesiones_realizadas, act.avance_sede, act.avance_ieo, act.documentos_seguimiento, act.documentos_evaluacion, act.resumen_alertar
                                                 FROM cbac.actividad_ops AS act
                                                 WHERE act.id_orientacion_proceso_seguimiento = $id");

        $result= $command->queryAll();                                       
                
        $result = ArrayHelper::getColumn($result, function ($element) 
        {
            $dato[$element['id_actividad']]['total_sesiones_realizadas']= $element['total_sesiones_realizadas'];
            $dato[$element['id_actividad']]['avance_sede']= $element['avance_sede'];
            $dato[$element['id_actividad']]['avance_ieo']= $element['avance_ieo'];
            $dato[$element['id_actividad']]['documentos_seguimiento']= $element['documentos_seguimiento'];
            $dato[$element['id_actividad']]['documentos_evaluacion']= $element['documentos_evaluacion'];
            $dato[$element['id_actividad']]['resumen_alertar']= $element['resumen_alertar'];

            return $dato;
        });

        foreach	($result as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
                //var_dump($ids);
                $datos[$ids] = $valores;
        }

        
        //die();

        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

        return $this->renderAjax('update', [
            'model' => $model,
            'sedes' => $this->obtenerSede(),
            'institucion' => $institucion->descripcion,
            'datos'=> $datos,
        ]);
    }

    public function obtenerSede()
	{
        $idInstitucion = $_SESSION['instituciones'][0];
		$Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );
		
		return $sedes;
    }

    /**
     * Deletes an existing CbacOrientacionProcesoSeguimiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $ops = CbacOrientacionProcesoSeguimiento::findOne($id);
        $ops->estado = 2;
        $ops->update();
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CbacOrientacionProcesoSeguimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacOrientacionProcesoSeguimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacOrientacionProcesoSeguimiento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
