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
use app\models\CbacOrientacionProcesoCbac;
use app\models\CbacActividadesCbac;
use app\models\Sedes;
use app\models\Instituciones;

use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CbacOrientacionProcesoCbacController implements the CRUD actions for CbacOrientacionProcesoCbac model.
 */
class CbacOrientacionProcesoCbacController extends Controller
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
     * Lists all CbacOrientacionProcesoCbac models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CbacOrientacionProcesoCbac::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
        ]);
    }

    /**
     * Displays a single CbacOrientacionProcesoCbac model.
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
        
        $actividades_isa = new CbacActividadesCbac();
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
            'actividades_isa' => $actividades_isa,
            'datos' => $datos,
        ]);
		
	}

    /**
     * Creates a new CbacOrientacionProcesoCbac model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacOrientacionProcesoCbac();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

        if ($model->load(Yii::$app->request->post())) {

            $model->id_institucion = $idInstitucion;

            if($model->save()){
                $isa_id = $model->id;
                //$isa_id = 4;
                if (Yii::$app->request->post('CbacActividadesCbac')){
                    $data = Yii::$app->request->post('CbacActividadesCbac');
                    $count 	= count( $data );
                    $modelActividades = [];

                    for( $i = 0; $i < $count; $i++ ){
                        $modelActividades[] = new CbacActividadesCbac();
                    }

                    if (CbacActividadesCbac::loadMultiple($modelActividades, Yii::$app->request->post() )) {
                        foreach($modelActividades as $key => $modelActividad) {
                            if($modelActividad->logors and $modelActividad->fortalezas){

                                $modelActividad->id_orientacion_proceso_cbac = $isa_id;
                                $modelActividad->save();   
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
     * Updates an existing CbacOrientacionProcesoCbac model.
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
       
        $actividades = new CbacActividadesCbac();
        $actividades = $actividades->find()->orderby("id")->andWhere("id_orientacion_proceso_cbac=$id")->all();
        

        $result = ArrayHelper::getColumn($actividades, function ($element) 
		{
            $dato[$element['id_actividad_c']]['logors']= $element['logors'];
            $dato[$element['id_actividad_c']]['fortalezas']= $element['fortalezas'];
            $dato[$element['id_actividad_c']]['debilidades']= $element['debilidades'];
            $dato[$element['id_actividad_c']]['alternativas']= $element['alternativas'];
            $dato[$element['id_actividad_c']]['retos']= $element['retos'];
            $dato[$element['id_actividad_c']]['observaciones']= $element['observaciones'];
            $dato[$element['id_actividad_c']]['alarmas']= $element['alarmas'];
            $dato[$element['id_actividad_c']]['necesidades']= $element['necesidades'];
            $dato[$element['id_actividad_c']]['estrategias_aprovechar']= $element['estrategias_aprovechar'];
            $dato[$element['id_actividad_c']]['estrategias_enfrentar']= $element['estrategias_enfrentar'];
            $dato[$element['id_actividad_c']]['ajustes']= $element['ajustes'];
            $dato[$element['id_actividad_c']]['temas']= $element['temas'];
            $dato[$element['id_actividad_c']]['articulacion']= $element['articulacion'];
            $dato[$element['id_actividad_c']]['necesidades_articulacion']= $element['necesidades_articulacion'];
            $dato[$element['id_actividad_c']]['cumplimiento_objetivos']= $element['cumplimiento_objetivos'];

            return $dato;

        });

        foreach	($result as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
                
                $datos[$ids] = $valores;
        }

        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);


        return $this->renderAjax('update', [
            'model' => $model,
            'sedes' => $this->obtenerSede(),
            'datos'=>$datos,
            'institucion' => $institucion->descripcion,
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
     * Deletes an existing CbacOrientacionProcesoCbac model.
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
     * Finds the CbacOrientacionProcesoCbac model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacOrientacionProcesoCbac the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacOrientacionProcesoCbac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
