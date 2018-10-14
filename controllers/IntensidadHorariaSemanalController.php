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
use app\models\IntensidadHorariaSemanal;
use app\models\IntensidadHorariaSemanalBuscar;
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
 * IntensidadHorariaSemanalController implements the CRUD actions for IntensidadHorariaSemanal model.
 */
class IntensidadHorariaSemanalController extends Controller
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
     * Lists all IntensidadHorariaSemanal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IntensidadHorariaSemanalBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( "estado=1" ); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IntensidadHorariaSemanal model.
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
     * Creates a new IntensidadHorariaSemanal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

	 
	function actionAgregarCampos()
	{
	
		$idInstitucion = $_SESSION['instituciones'][0];
		$consecutivo = Yii::$app->request->post('consecutivo');
		
		$model = new IntensidadHorariaSemanal();
		
		$dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Intensidad horario'")->all();
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

	 
	public function actionCreate()
    {
		$data = [];
		$idInstitucion = $_SESSION['instituciones'][0];
		if( Yii::$app->request->post('IntensidadHorariaSemanal') )
			$data = Yii::$app->request->post('IntensidadHorariaSemanal');
		
		$count 	= count( $data );
		
		$models = [];
		for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new IntensidadHorariaSemanal();
		}
							
		$dataInstituciones = Instituciones::find()
							->where( 'estado=1' )
							->andWhere( 'id='.$idInstitucion )
							->all();
		$instituciones 	  = ArrayHelper::map( $dataInstituciones, 'id', 'descripcion' );
		
		$dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Intensidad horaria'")->all();
		$tiposDocumento 	 = ArrayHelper::map( $dataTiposDocumento, 'id', 'descripcion' );
		
		$dataEstados  = Estados::find()->where( 'id=1' )->all();
		$estados 	  = ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
		
		if (IntensidadHorariaSemanal::loadMultiple($models, Yii::$app->request->post() )) {			
			
			foreach( $models as $key => $model) {
				
				//getInstances devuelve un array, por tanto siemppre se pone la posición 0
				$file = UploadedFile::getInstance( $model, "[$key]ruta" );
				
				if( $file )
				{
					
					// $persona = Personas::findOne( $model->id_persona );
					$institucion = Instituciones::findOne( $idInstitucion );
					
					//Si no existe la carpeta se crea
					$carpeta = "../documentos/IntensidadHorariaSemanal/".$institucion->codigo_dane;
					if (!file_exists($carpeta)) {
						mkdir($carpeta, 0777, true);
					}
					
					//Construyo la ruta completa del archivo a guardar
					$rutaFisicaDirectoriaUploads  = "../documentos/IntensidadHorariaSemanal/".$institucion->codigo_dane."/";
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
			if (!IntensidadHorariaSemanal::validateMultiple($models)) {
				Yii::$app->response->format = 'json';
				 return \yii\widgets\ActiveForm::validateMultiple($models);
			}
			
			//Guardo todos los modelos
			foreach( $models as $key => $model) {
				$model->save();
			}
			
			return $this->redirect(['index', 'guardado' => true ]);
        }
		
		$model = new IntensidadHorariaSemanal();

        return $this->renderAjax('create', [
            'model' 		 => $model,
            'tiposDocumento' => $tiposDocumento,

        ]);
    }
	
	
    /**
     * Updates an existing IntensidadHorariaSemanal model.
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
     * Deletes an existing IntensidadHorariaSemanal model.
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
     * Finds the IntensidadHorariaSemanal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return IntensidadHorariaSemanal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IntensidadHorariaSemanal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
