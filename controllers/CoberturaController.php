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
use app\models\Cobertura;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Sedes;
use yii\helpers\ArrayHelper;

/**
 * CoberturaController implements the CRUD actions for Cobertura model.
 */
class CoberturaController extends Controller
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
     * Lists all Cobertura models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cobertura::find(),
        ]);
        
        return $this->redirect(['create', 'guardado' => $guardado ]);

        /*return $this->render('create', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado
        ]);*/
    }

    /**
     * Displays a single Cobertura model.
     * @param integer $id
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
     * Creates a new Cobertura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $data = [];
        $idInstitucion = $_SESSION['instituciones'][0];

        $dataSedes = Sedes::find()
						->where('id_instituciones = '.$idInstitucion)
						->andWhere( 'estado=1' )
						->orderby( 'id' )
                        ->all();
        $listaSedes		= ArrayHelper::map( $dataSedes, 'id', 'descripcion' ); 
        $staus = false;
        if( Yii::$app->request->post('Cobertura') )
			$data = Yii::$app->request->post('Cobertura');

        $count 	= count( $data );
        $models = [];
		for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new Cobertura();
		}

        if (Cobertura::loadMultiple($models, Yii::$app->request->post() )) {
            $i = 1;
            Cobertura::deleteAll('institucion_id = '. $idInstitucion);
            $observaciones = '';
           
            foreach( $models as $key => $model) {
                
                if($model->observaciones != NULL){
                    $observaciones = $model->observaciones;
                };
                $model->observaciones = $observaciones;
                $model->tema_id = $i;
                $model->institucion_id = $idInstitucion;               
                $i++;
            }
                                 
            foreach( $models as $key => $model) {
				$model->save();
			}

            return $this->redirect(['index', 'guardado' => 1 ]);
           
        }
       
        $data = Cobertura::find()
            ->where('institucion_id = '.$idInstitucion)
            ->orderby( 'id' )
            ->all();
        $niñosInstitucion = ArrayHelper::map( $data, 'tema_id', 'cantidad_niños_institucion' );
        $niñasInstitucion = ArrayHelper::map( $data, 'tema_id', 'cantidad_niñas_institucion' );
        $niñosSede = ArrayHelper::map( $data, 'tema_id', 'cantidad_niños_sede' );
        $niñasSede = ArrayHelper::map( $data, 'tema_id', 'cantidad_niñas_sede' ); 
        $observaciones =  ArrayHelper::map( $data, 'tema_id', 'observaciones' ); 
       
        $model = new Cobertura();
                  
        return $this->render('create', [
            'model' => $model,
            'sedes' => $listaSedes,
            'guardado' => 0,
            'niñosInstitucion' =>  $niñosInstitucion,
            'niñasInstitucion' =>  $niñasInstitucion,
            'niñosSede' =>  $niñosSede,
            'niñasSede' =>  $niñasSede,
            'observaciones' => $observaciones,

        ]);

    }

    /**
     * Updates an existing Cobertura model.
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
     * Deletes an existing Cobertura model.
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
     * Finds the Cobertura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cobertura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cobertura::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
