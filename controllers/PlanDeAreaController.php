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
use app\models\PlanDeArea;
use app\models\PlanDeAreaBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Estados;
use yii\helpers\ArrayHelper;
use app\models\Parametro;
use app\models\Instituciones;
use app\models\TiposDocumentos;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * PlanDeAreaController implements the CRUD actions for PlanDeArea model.
 */
class PlanDeAreaController extends Controller
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
     * Lists all PlanDeArea models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanDeAreaBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( "estado=1" ); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	function actionAgregarCampos()
	{
	
		$idInstitucion = $_SESSION['instituciones'][0];
		$consecutivo = Yii::$app->request->post('consecutivo');
		
		$model = new PlanDeArea();
		
		$dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Plan de area'")->all();
		$tiposDocumento 	 = ArrayHelper::map( $dataTiposDocumento, 'id', 'descripcion' );
		
		
		$form = ActiveForm::begin();
		
		?> 
				
		<div class=row>

			<div class=cell>
			<?= $form->field($model, '['.$consecutivo.']descripcion')->textInput() ?>
			</div>

				<div class=cell>
				<?= $form->field($model, '['.$consecutivo.']id_tipos_documentos')->dropDownList( $tiposDocumento, [ 'prompt' => 'Seleccione...' ] ) ?>
			</div>

				<div class=cell>
			<?= $form->field($model, '['.$consecutivo.']ruta')->label('Archivo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
			</div>

				<div class=cell>
			<?= $form->field($model, '['.$consecutivo.']estado')->hiddenInput( [ 'value' => '1' ] )->label( '' ) ?>
			</div>
		</div>
		
		<?php
		
	}
    /**
     * Displays a single PlanDeArea model.
     * @param string $id
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
     * Creates a new PlanDeArea model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
 
 
	public function actionCreate()
    {
		$data = [];
		$idInstitucion = $_SESSION['instituciones'][0];
		if( Yii::$app->request->post('PlanDeArea') )
			$data = Yii::$app->request->post('PlanDeArea');
		
		$count 	= count( $data );
		
		$models = [];
		for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new PlanDeArea();
		}
							
		
		$dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Plan de area'")->all();
		$tiposDocumento 	 = ArrayHelper::map( $dataTiposDocumento, 'id', 'descripcion' );
		
	
		
		if (PlanDeArea::loadMultiple($models, Yii::$app->request->post() )) {			
			
			foreach( $models as $key => $model) {
				
				//getInstances devuelve un array, por tanto siemppre se pone la posición 0
				$file = UploadedFile::getInstance( $model, "[$key]ruta" );
				
				if( $file )
				{
					
					// $persona = Personas::findOne( $model->id_persona );
					$institucion = Instituciones::findOne( $idInstitucion );
					
					//Si no existe la carpeta se crea
					$carpeta = "../documentos/PlanDeArea/".$institucion->codigo_dane;
					if (!file_exists($carpeta)) {
						mkdir($carpeta, 0777, true);
					}
					
					//Construyo la ruta completa del archivo a guardar
					$rutaFisicaDirectoriaUploads  = "../documentos/PlanDeArea/".$institucion->codigo_dane."/";
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
				else
				{
					exit( "No hay archivo cargado" );
				}
			}
			
			//Se valida que todos los campos de todos los modelos sean correctos
			if (!PlanDeArea::validateMultiple($models)) {
				Yii::$app->response->format = 'json';
				 return \yii\widgets\ActiveForm::validateMultiple($models);
			}
			
			//Guardo todos los modelos
			foreach( $models as $key => $model) {
				$model->save();
			}
			
			return $this->redirect(['index', 'guardado' => true ]);
        }
		
		$model = new PlanDeArea();

        return $this->renderAjax('create', [
            'model' 		 => $model,
            'tiposDocumento' => $tiposDocumento,
        ]);
    }
	

    /**
     * Updates an existing PlanDeArea model.
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
     * Deletes an existing PlanDeArea model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
         $model = $this->findModel($id);
		$model->estado = 2;
		$model->update(false);
		
		
		return $this->redirect(['index']);
    }

    /**
     * Finds the PlanDeArea model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PlanDeArea the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlanDeArea::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
