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
use app\models\CbacPlanMisionalOperativo;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\CbacPmoActividades;

use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CbacPlanMisionalOperativoController implements the CRUD actions for CbacPlanMisionalOperativo model.
 */
class CbacPlanMisionalOperativoController extends Controller
{
    
	public $arraySiNo = 
		[
			1 => "Si",
			2 => "No"		
		];
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
     * Lists all CbacPlanMisionalOperativo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CbacPlanMisionalOperativo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
        ]);
    }

    /**
     * Displays a single CbacPlanMisionalOperativo model.
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
        
        $actividades_pom = new CbacPmoActividades();
        
        $proyectos = [ 
            1 => "Desarrollar herramientas en docentes y directivos docentes de las IEO que implementen componentes artísticos y culturales.",
            2 => "Fortalecer la oferta de programas culturales para estudiantes en el proceso formativo de competencias básicas dentro y fuera del aula.",
            3 => "Promover el acompañamiento de padres de familia desde el arte y la cultura en el proceso de fortalecimiento de competencias básicas de estudiantes de las IEO.",
        ];
		
		return $this->renderAjax('fases', [
            'fases' => $proyectos,
            'form' => $form,
            "model" => $model,
            'actividades_pom' => $actividades_pom,
            'datos' => $datos,
			'arraySiNo' => $this->arraySiNo,
        ]);
		
	}

    /**
     * Creates a new CbacPlanMisionalOperativo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacPlanMisionalOperativo();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->id_institucion = $idInstitucion;
            if($model->save()){
                $id_pmo = $model->id;
                //$id_pmo = 2;

                if (Yii::$app->request->post('CbacPmoActividades')){
                    $data = Yii::$app->request->post('CbacPmoActividades');
                    $count 	= count($data);
                    $modelActividades = [];

                    for( $i = 0; $i < 12; $i++ ){
                        $modelActividades[] = new CbacPmoActividades();
                    }

                    if (CbacPmoActividades::loadMultiple($modelActividades, Yii::$app->request->post() )) {
                        foreach( $modelActividades as $key => $modelActividad) {
                            if($modelActividad->desde and $modelActividad->hasta){
                                $modelActividad->id_pmo = $id_pmo;
                                $modelActividad->save();
                            }
                        }
                    }

                }



            }
            return $this->redirect(['index', 'guardado' => 1 ]);
        }

        $Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );

        return $this->renderAjax('create', [
            'model' => $model,
            'sedes' => $sedes,
            'institucion' => $institucion->descripcion,
			'arraySiNo' => $this->arraySiNo,
        ]);
    }

    /**
     * Updates an existing CbacPlanMisionalOperativo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $post = Yii::$app->request->post();
			
			$arrayDatosAvances = $post['CbacPmoActividades'];
			$connection = Yii::$app->getDb();
            
            foreach($arrayDatosAvances as $idAcciones => $valores)
			{
                
				if($valores['desde'] != ""){
                    $command = $connection->createCommand
                    (" 
                        UPDATE cbac.pmo_actividades set 			
                        desde						='". $valores['desde']."',
                        hasta					='". $valores['hasta']."',
                        num_equipos					='". $valores['num_equipos']."',
                        perfiles				='". $valores['perfiles']."',
                        docentes						='". $valores['docentes']."',
                        fases					='". $valores['fases']."',
                        num_encuentro		='". $valores['num_encuentro']."',
                        nombre_actividad		='". $valores['nombre_actividad']."',
                        actividades_desarrolladas						='". $valores['actividades_desarrolladas']."',
                        tematicas				='". $valores['tematicas']."',
                        objetivos_especificos						='". $valores['objetivos_especificos']."',
                        tiempo_previsto	='". $valores['tiempo_previsto']."',
                        productos						='". $valores['productos']."',
                        contenido_si_no				='". $valores['contenido_si_no']."',
                        contenido_nombre						='". $valores['contenido_nombre']."',
                        contenido_fecha						='". $valores['contenido_fecha']."',
                        contenido_justificacion						='". $valores['contenido_justificacion']."',
                        acticulacion						='". $valores['acticulacion']."',
                        cantidad_participantes						='". $valores['cantidad_participantes']."',
                        requerimientos_tecnicos						='". $valores['requerimientos_tecnicos']."',
                        requerimientos_logoisticos						='". $valores['requerimientos_logoisticos']."',
                        destinatarios						='". $valores['destinatarios']."',
                        fehca_entrega						='". $valores['fehca_entrega']."',
                        observaciones_generales						='". $valores['observaciones_generales']."',
                        rol						='". $valores['rol']."',
                        
                       
                        contenido_vigencia						='". $valores['contenido_vigencia']."'
                        

                        WHERE id_actividad = $idAcciones and id_pmo = $id
                    ");
                    $result = $command->queryAll();
                }
                
			}

            return $this->redirect(['index']);
        }

        
        $actividades = new CbacPmoActividades();
        $actividades = $actividades->find()->orderby("id")->andWhere("id_pmo=$id")->all();


        $result = ArrayHelper::getColumn($actividades, function ($element) 
		{
            $dato[$element['id_actividad']]['desde']= $element['desde'];
            $dato[$element['id_actividad']]['hasta']= $element['hasta'];
            $dato[$element['id_actividad']]['num_equipos']= $element['num_equipos'];
            $dato[$element['id_actividad']]['perfiles']= $element['perfiles'];
            $dato[$element['id_actividad']]['docentes']= $element['docentes'];
            $dato[$element['id_actividad']]['fases']= $element['fases'];
            $dato[$element['id_actividad']]['num_encuentro']= $element['num_encuentro'];
            $dato[$element['id_actividad']]['nombre_actividad']= $element['nombre_actividad'];
            $dato[$element['id_actividad']]['actividades_desarrolladas']= $element['actividades_desarrolladas'];
            $dato[$element['id_actividad']]['tematicas']= $element['tematicas'];
            $dato[$element['id_actividad']]['objetivos_especificos']= $element['objetivos_especificos'];
            $dato[$element['id_actividad']]['tiempo_previsto']= $element['tiempo_previsto'];
            $dato[$element['id_actividad']]['productos']= $element['productos'];
            $dato[$element['id_actividad']]['contenido_si_no']= $element['contenido_si_no'];
            $dato[$element['id_actividad']]['contenido_nombre']= $element['contenido_nombre'];
            $dato[$element['id_actividad']]['contenido_fecha']= $element['contenido_fecha'];
            $dato[$element['id_actividad']]['contenido_justificacion']= $element['contenido_justificacion'];
            $dato[$element['id_actividad']]['acticulacion']= $element['acticulacion'];
            $dato[$element['id_actividad']]['cantidad_participantes']= $element['cantidad_participantes'];
            $dato[$element['id_actividad']]['requerimientos_tecnicos']= $element['requerimientos_tecnicos'];
            $dato[$element['id_actividad']]['requerimientos_logoisticos']= $element['requerimientos_logoisticos'];
            $dato[$element['id_actividad']]['destinatarios']= $element['destinatarios'];
            $dato[$element['id_actividad']]['fehca_entrega']= $element['fehca_entrega'];
            $dato[$element['id_actividad']]['observaciones_generales']= $element['observaciones_generales'];
            $dato[$element['id_actividad']]['nombre_dilegencia']= $element['nombre_dilegencia'];
            $dato[$element['id_actividad']]['rol']= $element['rol'];
            $dato[$element['id_actividad']]['lugares_visitados']= $element['lugares_visitados'];
            $dato[$element['id_actividad']]['penalistas_invitados']= $element['penalistas_invitados'];
            $dato[$element['id_actividad']]['programacion']= $element['programacion'];
            $dato[$element['id_actividad']]['tematicas_abordadas']= $element['tematicas_abordadas'];
            $dato[$element['id_actividad']]['resultado_producto_esperado']= $element['resultado_producto_esperado'];
            $dato[$element['id_actividad']]['contenido_vigencia']= $element['contenido_vigencia'];

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
            'institucion' => $institucion->descripcion,
            'datos'=>$datos,
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
     * Deletes an existing CbacPlanMisionalOperativo model.
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
     * Finds the CbacPlanMisionalOperativo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacPlanMisionalOperativo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacPlanMisionalOperativo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
