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
use app\models\EcInformeSemanalTotalEjecutivoE;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * EcInformeSemanalTotalEjecutivoController implements the CRUD actions for EcInformeSemanalTotalEjecutivo model.
 */
class EcInformeSemanalTotalEjecutivoEController extends Controller
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
     * Lists all EcInformeSemanalTotalEjecutivo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => EcInformeSemanalTotalEjecutivoE::find(),
        ]);
        
        return $this->redirect(['create', 'guardado' => $guardado ]);
            
        /*return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);*/
    }

    /**
     * Displays a single EcInformeSemanalTotalEjecutivo model.
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
     * Creates a new EcInformeSemanalTotalEjecutivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $data = [];
        $idInstitucion = $_SESSION['instituciones'][0];
        $secuenciaData = 1;
        if( Yii::$app->request->post('EcInformeSemanalTotalEjecutivoE') )
			$data = Yii::$app->request->post('EcInformeSemanalTotalEjecutivoE');

        $count 	= count( $data );
        $models = [];
        for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new EcInformeSemanalTotalEjecutivo();
        }
        
        if (EcInformeSemanalTotalEjecutivoE::loadMultiple($models, Yii::$app->request->post() )) {
            
            EcInformeSemanalTotalEjecutivoE::deleteAll('institucion_id = '. $idInstitucion);
           
           
            foreach( $models as $key => $model) {
                $model->institucion_id = $idInstitucion;
                $model->secuencia = $secuenciaData;               
                $secuenciaData++;
            }
                                 
            foreach( $models as $key => $model) {
				$model->save();
			}

            return $this->redirect(['index', 'guardado' => 1 ]);
           
        }
        $data = EcInformeSemanalTotalEjecutivoE::find()
            ->where('institucion_id = '.$idInstitucion)
            ->orderby( 'id' )
            ->all();
        
        $cantidad_ieo = ArrayHelper::map( $data, 'secuencia', 'cantidad_ieo' );
        $cantidad_sedes_ieo = ArrayHelper::map( $data, 'secuencia', 'cantidad_sedes' );
        $porcentaje_ieo = ArrayHelper::map( $data, 'secuencia', 'porcentaje_ieo' );
        $porcentaje_sedes = ArrayHelper::map( $data, 'secuencia', 'porcentaje_sedes' );
        $porcentaje_actividad_uno = ArrayHelper::map( $data, 'secuencia', 'porcentaje_actividad_uno' );
        $porcentaje_actividad_dos = ArrayHelper::map( $data, 'secuencia', 'porcentaje_actividad_dos' );
        $porcentaje_actividad_tres = ArrayHelper::map( $data, 'secuencia', 'porcentaje_actividad_tres' );
        $poblacion_beneficiada_directa = ArrayHelper::map( $data, 'secuencia', 'poblacion_beneficiada_directa' );
        $poblacion_beneficiada_indirecta = ArrayHelper::map( $data, 'secuencia', 'poblacion_beneficiada_indirecta' );
        $alarmas_generales = ArrayHelper::map( $data, 'secuencia', 'alarmas_generales' );        

        $model = new EcInformeSemanalTotalEjecutivoE();
    
        return $this->render('create', [
            'model' => $model,
            'guardado' => 0,
            'cantidad_ieo' => $cantidad_ieo,
            'cantidad_sedes_ieo' => $cantidad_sedes_ieo,
            'porcentaje_ieo' => $porcentaje_ieo,
            'porcentaje_sedes' => $porcentaje_sedes,
            'porcentaje_actividad_uno' => $porcentaje_actividad_uno,
            'porcentaje_actividad_dos' => $porcentaje_actividad_dos,
            'porcentaje_actividad_tres' => $porcentaje_actividad_tres,
            'poblacion_beneficiada_directa' => $poblacion_beneficiada_directa,
            'poblacion_beneficiada_indirecta' => $poblacion_beneficiada_indirecta,
            'alarmas_generales' => $alarmas_generales,
        ]);
    }

    /**
     * Updates an existing EcInformeSemanalTotalEjecutivo model.
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
     * Deletes an existing EcInformeSemanalTotalEjecutivo model.
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
     * Finds the EcInformeSemanalTotalEjecutivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EcInformeSemanalTotalEjecutivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EcInformeSemanalTotalEjecutivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
