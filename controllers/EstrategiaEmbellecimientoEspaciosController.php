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
use app\models\EstrategiaEmbellecimientoEspacios;
use app\models\Instituciones;
use app\models\Estados;
use app\models\TiposDocumentos;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Parametro;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * EstrategiaEmbellecimientoEspaciosController implements the CRUD actions for EstrategiaEmbellecimientoEspacios model.
 */
class EstrategiaEmbellecimientoEspaciosController extends Controller
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
     * Lists all EstrategiaEmbellecimientoEspacios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => EstrategiaEmbellecimientoEspacios::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EstrategiaEmbellecimientoEspacios model.
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
     * Creates a new EstrategiaEmbellecimientoEspacios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $data = [];
		$idInstitucion = $_SESSION['instituciones'][0];
		if( Yii::$app->request->post('EstrategiaEmbellecimientoEspacios') )
			$data = Yii::$app->request->post('EstrategiaEmbellecimientoEspacios');
		
        $count 	= count( $data );
        
        $models = [];
		for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new EstrategiaEmbellecimientoEspacios();
		}
							
		$dataInstituciones = Instituciones::find()
							->where( 'estado=1' )
							->andWhere( 'id='.$idInstitucion )
							->all();
        $instituciones 	  = ArrayHelper::map( $dataInstituciones, 'id', 'descripcion' );
        
        $dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Estrategia Embellecimiento'")->all();
		$tiposDocumento 	 = ArrayHelper::map( $dataTiposDocumento, 'id', 'descripcion' );
		
		$dataEstados  = Estados::find()->where( 'id=1' )->all();
        $estados 	  = ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
        
        if (EstrategiaEmbellecimientoEspacios::loadMultiple($models, Yii::$app->request->post() )) {			
			
			foreach( $models as $key => $model) {
				
                //getInstances devuelve un array, por tanto siemppre se pone la posición 0
               
				$file = UploadedFile::getInstance( $model, "[$key]file" );
                
				if( $file ){
					
					// $persona = Personas::findOne( $model->id_persona );
					$institucion = Instituciones::findOne( $idInstitucion );
					
					//Si no existe la carpeta se crea
					$carpeta = "../documentos/documentosEstrategiaEmbellecimientoEspacios/".$institucion->codigo_dane;
					if (!file_exists($carpeta)) {
						mkdir($carpeta, 0777, true);
					}
					
					//Construyo la ruta completa del archivo a guardar
					$rutaFisicaDirectoriaUploads  = "../documentos/documentosEstrategiaEmbellecimientoEspacios/".$institucion->codigo_dane."/";
					$rutaFisicaDirectoriaUploads .= $file->baseName;
					$rutaFisicaDirectoriaUploads .= date( "_Y_m_d_His" ) . '.' . $file->extension;
                    
                    
                    
					//Siempre activo
					$model->estado = 1;
                    
					$save = $file->saveAs( $rutaFisicaDirectoriaUploads );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
					
					if( $save )
					{
						//Le asigno la ruta al arhvio
						$model->ruta = $rutaFisicaDirectoriaUploads;
						
						// if( $model->save() )
							// return $this->redirect(['view', 'id' => $model->id]);
					}
					else
					{
						echo $file->error;
						exit("finnn....");
					}
				}
			}
			
			//Se valida que todos los campos de todos los modelos sean correctos
			if (!EstrategiaEmbellecimientoEspacios::validateMultiple($models)) {
				Yii::$app->response->format = 'json';
				 return \yii\widgets\ActiveForm::validateMultiple($models);
			}
			
			//Guardo todos los modelos
			foreach( $models as $key => $model) {
				$model->save();
			}
			
			return $this->redirect(['index', 'guardado' => true ]);
        }


        
        $model = new EstrategiaEmbellecimientoEspacios();

        $dataParametrosUsos = Parametro::find()
						->where( 'id_tipo_parametro=30' )
						->andWhere( 'estado=1' )
						->orderby( 'id' )
						->all();
						
        $parametrosUsos		= ArrayHelper::map( $dataParametrosUsos, 'id', 'descripcion' );
        
        $dataParametrosEmbellecimiento = Parametro::find()
						->where( 'id_tipo_parametro=31' )
						->andWhere( 'estado=1' )
						->orderby( 'id' )
						->all();
						
		$parametrosEmbellecimiento	= ArrayHelper::map( $dataParametrosEmbellecimiento, 'id', 'descripcion' );

        return $this->renderAjax('create', [
            'model' => $model,
            'parametrosUsos' => $parametrosUsos,
            'parametrosEmbellecimiento' => $parametrosEmbellecimiento,
            'tiposDocumento' => $tiposDocumento,
            'instituciones'	 => $instituciones,
            'estados' 		 => $estados,
			'idInstitucion'	 => $idInstitucion,
        ]);
    }

    /**
     * Updates an existing EstrategiaEmbellecimientoEspacios model.
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
     * Deletes an existing EstrategiaEmbellecimientoEspacios model.
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
     * Finds the EstrategiaEmbellecimientoEspacios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EstrategiaEmbellecimientoEspacios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EstrategiaEmbellecimientoEspacios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
