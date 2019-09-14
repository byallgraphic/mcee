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
use app\models\CbacConsolidadoMisional;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\CbacImpMisional;
use app\models\CbacActividadMisional;

use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CbacConsolidadoMisionalController implements the CRUD actions for CbacConsolidadoMisional model.
 */
class CbacConsolidadoMisionalController extends Controller
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
     * Lists all CbacConsolidadoMisional models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CbacConsolidadoMisional::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
        ]);
    }

    /**
     * Displays a single CbacConsolidadoMisional model.
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
        
        $imp_misional = new CbacImpMisional();
        $actividad = new CbacActividadMisional();
        
        $proyectos = [ 
            1 => "Desarrollar herramientas en docentes y directivos docentes de las IEO que implementen componentes artísticos y culturales.",
            2 => "Fortalecer la oferta de programas culturales para estudiantes en el proceso formativo de competencias básicas dentro y fuera del aula.",
            3 => "Promover el acompañamiento de padres de familia desde el arte y la cultura en el proceso de fortalecimiento de competencias básicas de estudiantes de las IEO.",
            4 => ""
        ];
		
		return $this->renderAjax('fases', [
			'idPE' 	=> null,
            'fases' => $proyectos,
            'form' => $form,
            "model" => $model,
            'imp_misional' => $imp_misional,
            'actividadMisional' => $actividad,
            'datos' => $datos,
        ]);
		
	}

    /**
     * Creates a new CbacConsolidadoMisional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CbacConsolidadoMisional();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne($idInstitucion);

        if ($model->load(Yii::$app->request->post())) {

            $model->id_institucion = $idInstitucion;

            if($model->save()){
                $id_consolidado = $model->id;

                if (Yii::$app->request->post('CbacImpMisional')){
                    $data = Yii::$app->request->post('CbacImpMisional');
                    $count  = count($data);
                    $modelImpCbac = [];

                    for( $i = 0; $i < $count; $i++ ){
                        $modelImpCbac[] = new CbacImpMisional();
                    }

                    if (CbacImpMisional::loadMultiple($modelImpCbac, Yii::$app->request->post() )) {

                        foreach($modelImpCbac as $key => $model) {
                            if($model->mison and $model->descripcion){
                                $model->id_consolidado_misional = $id_consolidado;

                                if($model->save()){
                                    $id_imp = $model->id;

                                    if(Yii::$app->request->post('CbacActividadMisional')){
                                        
                                        $dataActividad = Yii::$app->request->post('CbacActividadMisional');
                                        $countActividad = count( $dataActividad );
                                        $modelActividadInd = [];

                                        for( $i = 0; $i < $countActividad; $i++ ){
                                            $modelActividadInd[] = new CbacActividadMisional();
                                        }

                                        if (CbacActividadMisional::loadMultiple($modelActividadInd, Yii::$app->request->post() )) {
                                            
                                            foreach($modelActividadInd as $key1 => $model1) {
                                                if($key == 1 && $key1 <= 2){
                                                    if($model1->estado && $model1->logros){
                                                        $model1->id_imp_misional = $id_imp;
                                                        $model1->save();
                                                    }
                                                }
                                                if($key == 2 && $key1 > 2 && $key1 <= 7){
                                                    if($model1->estado && $model1->logros){
                                                        $model1->id_imp_misional = $id_imp;
                                                        $model1->save();
                                                    }
                                                }
                                                if($key == 3 && $key1 > 7){
                                                    if($model1->estado && $model1->logros){
                                                        $model1->id_imp_misional = $id_imp;
                                                        $model1->save();
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
     * Updates an existing CbacConsolidadoMisional model.
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
			
			$arrayDatosImp = $post['CbacImpMisional'];
            $connection = Yii::$app->getDb();
            
            foreach($arrayDatosImp as $idAcciones => $valores)
			{
                if($valores['mison'] != ""){
                    $command = $connection->createCommand
                    (" 
                        UPDATE cbac.imp_misional set 			
                        mison						='". $valores['mison']."',
                        descripcion					='". $valores['descripcion']."',
                        hallazgo					='". $valores['hallazgo']."',
                        sedes_institucion_1				='". $valores['sedes_institucion_1']."',
                        sedes_institucion_2						='". $valores['sedes_institucion_2']."',
                        docentes_institucion_1					='". $valores['docentes_institucion_1']."',
                        docentes_institucion_2		='". $valores['docentes_institucion_2']."',
                        avance_sede		='". $valores['avance_sede']."',
                        avance_ieo						='". $valores['avance_ieo']."'
                    
                        WHERE componente_id = $idAcciones and id_consolidado_misional = $id
                    ");
                    $result = $command->queryAll();                    
                }

            }
            
            return $this->redirect(['index']);
        }

        //$impMisional = new CbacImpMisional();
        //$impMisional = $impMisional->find()->orderby("id")->andWhere("id_consolidado_misional=$id")->all();

        $command = Yii::$app->db->createCommand("SELECT imp.mison, imp.descripcion, imp.hallazgo, imp.sedes_institucion_1, imp.sedes_institucion_2, imp.docentes_institucion_1, imp.docentes_institucion_2, imp.avance_sede, imp.avance_ieo, imp.componente_id,
                                                        act.estado, act.logros, act.fortalezas, act.debilidades, act.retos, act.alarmas
                                                FROM cbac.imp_misional as imp
                                                INNER JOIN cbac.actividad_misional AS act ON act.id_imp_misional = imp.id
                                                WHERE imp.id_consolidado_misional=$id");

        $result= $command->queryAll();    

        $result = ArrayHelper::getColumn($result, function ($element) 
		{
            $dato[$element['componente_id']]['mison']= $element['mison'];
            $dato[$element['componente_id']]['descripcion']= $element['descripcion'];
            $dato[$element['componente_id']]['hallazgo']= $element['hallazgo'];
            $dato[$element['componente_id']]['sedes_institucion_1']= $element['sedes_institucion_1'];
            $dato[$element['componente_id']]['sedes_institucion_2']= $element['sedes_institucion_2'];
            $dato[$element['componente_id']]['docentes_institucion_1']= $element['docentes_institucion_1'];
            $dato[$element['componente_id']]['docentes_institucion_2']= $element['docentes_institucion_2'];
            $dato[$element['componente_id']]['avance_sede']= $element['avance_sede'];
            $dato[$element['componente_id']]['avance_ieo']= $element['avance_ieo'];
            $dato[$element['componente_id']]['estado']= $element['estado'];
            $dato[$element['componente_id']]['logros']= $element['logros'];
            $dato[$element['componente_id']]['fortalezas']= $element['fortalezas'];
            $dato[$element['componente_id']]['debilidades']= $element['debilidades'];
            $dato[$element['componente_id']]['retos']= $element['retos'];
            $dato[$element['componente_id']]['alarmas']= $element['alarmas'];

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
            'institucion' => $institucion->descripcion,
            'sedes' => $this->obtenerSede(),
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
     * Deletes an existing CbacConsolidadoMisional model.
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
     * Finds the CbacConsolidadoMisional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CbacConsolidadoMisional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CbacConsolidadoMisional::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
