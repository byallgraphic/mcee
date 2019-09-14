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
use app\models\DocumentosActividadesVinculacion;
use app\models\Instituciones;
use app\models\Estados;
use app\models\TiposDocumentos;
use app\models\DocumentosActividadesVinculacionBuscar;

use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentosActividadesVinculacionController implements the CRUD actions for DocumentosActividadesVinculacion model.
 */
class DocumentosActividadesVinculacionController extends Controller
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
     * Lists all DocumentosActividadesVinculacion models.
     * @return mixed
     */
    public function actionIndex($idInstitucion = 0, $guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DocumentosActividadesVinculacionBuscar::find(),
        ]);
        
        $idInstitucion = $_SESSION['instituciones'][0];
		if( $idInstitucion > 0 )
		{
			$searchModel = new DocumentosActividadesVinculacionBuscar();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->query->andWhere( 'id_estado=1' )->andWhere( 'id_instituciones='.$idInstitucion );

			return $this->render('index', [
				'searchModel' 	=> $searchModel,
				'dataProvider' 	=> $dataProvider,
				'guardado' 		=> $guardado,
				'idInstitucion'	=> $idInstitucion,
			]);
		}


    }

    /**
     * Displays a single DocumentosActividadesVinculacion model.
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
     * Creates a new DocumentosActividadesVinculacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	 
	function actionAgregarCampos(){
		
		
		$consecutivo = Yii::$app->request->post('consecutivo');
		
		$model = new DocumentosOficiales();
		
		
							
		$instituciones 	  = $this->obtenerInstituciones();
		
		
		$tiposDocumento 	 = $this->obtenerTiposDocumento();
		
		$dataEstados  = Estados::find()->where( 'id=1' )->all();
		$estados 	  = ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
		
		$form = ActiveForm::begin();
		
		?> 
			<div class=row>
	
				<div class=cell>
					<?= $form->field($model, '['.$consecutivo.']id_instituciones')->dropDownList( $instituciones ) ?>
				</div>

				<div class=cell>
					<?= $form->field($model,  '['.$consecutivo.']id_tipo_documentos')->dropDownList( $tiposDocumento, [ 'prompt' => 'Seleccione...' ] ) ?>
				</div>
					
				<div class=cell>
					<?= $form->field($model,  '['.$consecutivo.']descripcion')->textArea()-label("Descripción") ?>
				</div>
				
				<div class=cell>
					<?= $form->field($model,  '['.$consecutivo.']ruta')->label('Archivo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
				</div>

				<div class=cell style='display:none'>
					<?= $form->field($model,  '['.$consecutivo.']estado')->hiddenInput( [ 'value' => '1' ] )->label( '' ) ?>
				</div>
					
			</div>
		
		<?php
		
	} 
	 
    public function actionCreate()
    {

        $data = [];
        $idInstitucion = $_SESSION['instituciones'][0];
		if( Yii::$app->request->post('DocumentosActividadesVinculacion') )
			$data = Yii::$app->request->post('DocumentosActividadesVinculacion');
		
        $count 	= count( $data );
        
        $models = [];
		for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new DocumentosActividadesVinculacion();
        }
        
        $dataInstituciones = Instituciones::find()
							->where( 'estado=1' )
							->andWhere( 'id='.$idInstitucion )
							->all();
        $instituciones 	  = ArrayHelper::map( $dataInstituciones, 'id', 'descripcion' );

        

        $dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Actividades Vinculacion'")->all();
		$tiposDocumento 	 = ArrayHelper::map( $dataTiposDocumento, 'id', 'descripcion' );

		$dataEstados  = Estados::find()->where( 'id=1' )->all();
		$estados 	  = ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
        

        if (DocumentosActividadesVinculacion::loadMultiple($models, Yii::$app->request->post() )) {			
			
			foreach( $models as $key => $model) {
				
                //getInstances devuelve un array, por tanto siemppre se pone la posición 0
               
				$file = UploadedFile::getInstance( $model, "[$key]file" );
                
				if( $file ){
	
					// $persona = Personas::findOne( $model->id_persona );
					$institucion = Instituciones::findOne( $idInstitucion );
					
					//Si no existe la carpeta se crea
					$carpeta = "../documentos/documentosActividadesVinculacion/".$institucion->codigo_dane;
					if (!file_exists($carpeta)) {
						mkdir($carpeta, 0777, true);
					}
					
					//Construyo la ruta completa del archivo a guardar
					$rutaFisicaDirectoriaUploads  = "../documentos/documentosActividadesVinculacion/".$institucion->codigo_dane."/";
					$rutaFisicaDirectoriaUploads .= $file->baseName;
					$rutaFisicaDirectoriaUploads .= date( "_Y_m_d_His" ) . '.' . $file->extension;
                    
                    
                    
					//Siempre activo
                    $model->id_estado = 1;
                    $model->id_instituciones = $idInstitucion;
                    
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
			if (!DocumentosActividadesVinculacion::validateMultiple($models)) {
				Yii::$app->response->format = 'json';
				 return \yii\widgets\ActiveForm::validateMultiple($models);
			}
			
			//Guardo todos los modelos
			foreach( $models as $key => $model) {
				$model->save();
			}
			
			return $this->redirect(['index', 'guardado' => true ]);
        }

        $model = new DocumentosActividadesVinculacion();

        return $this->render('create', [
            'model' => $model,
            'tiposDocumento' => $tiposDocumento,
            'instituciones'	 => $instituciones,
            'estados' 		 => $estados,
			'idInstitucion'	 => $idInstitucion,
        ]);
    }

    /**
     * Updates an existing DocumentosActividadesVinculacion model.
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
     * Deletes an existing DocumentosActividadesVinculacion model.
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
     * Finds the DocumentosActividadesVinculacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocumentosActividadesVinculacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentosActividadesVinculacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
