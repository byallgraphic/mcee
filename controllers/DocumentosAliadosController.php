<?php

/**********
Versión: 001
Fecha: 2018-10-03
Desarrollador: Edwin MG
Descripción: Modelo Documentos Aliados Buscar
---------------------------------------
*/

namespace app\controllers;

if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	header('Location: index.php?r=site%2Flogin');
	die;
}
use Yii;
use app\models\DocumentosAliados;
use app\models\DocumentosAliadosBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\TiposDocumentos;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\Personas;
use app\models\Instituciones;
use app\models\Estados;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * DocumentosInstanciasInstitucionalesController implements the CRUD actions for DocumentosAliados model.
 */
class DocumentosAliadosController extends Controller
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
     * Lists all Sedes models.
     * @return mixed
     */
    

    function actionAgregarCampos()
	{
	
		$idInstitucion = $_SESSION['instituciones'][0];
		$consecutivo = Yii::$app->request->post('consecutivo');
		
		$model = new DocumentosAliados();
		
		$dataInstituciones = Instituciones::find()
							->where( 'estado=1' )
							->andWhere( 'id='.$idInstitucion )
							->all();
		$instituciones 	  = ArrayHelper::map( $dataInstituciones, 'id', 'descripcion' );
		
		$dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Aliados'")->all();
		$tiposDocumento 	 = ArrayHelper::map( $dataTiposDocumento, 'id', 'descripcion' );
		
		$dataEstados  = Estados::find()->where( 'id=1' )->all();
		$estados 	  = ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
		
		$form = ActiveForm::begin();
		
		?> 
			<div class=row>
	
				<div class=cell style='display:none;'>
					<?= $form->field($model, '['.$consecutivo.']id_institucion')->dropDownList( $instituciones ) ?>
				</div>
				
				<div class=cell>
					<?= $form->field($model, '['.$consecutivo.']nombre')->dropDownList( $tiposDocumento, [ 'prompt' => 'Seleccione...' ] ) ?>
				</div>

				<div class=cell>
					<?= $form->field($model,  '['.$consecutivo.']tipo_documento')->dropDownList( [ 'Pública' => 'Pública', 'Privada' => 'Privada' ], [ 'prompt' => 'Seleccione...' ] ) ?>
				</div>
					
				<div class=cell>
					<?= $form->field($model,  '['.$consecutivo.']descripcion')->textarea() ?>
				</div>
				
				<div class=cell>
					<?= $form->field($model,  '['.$consecutivo.']file')->label('Archivo')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?>
				</div>

				<div class=cell style='display:none'>
					<?= $form->field($model,  '['.$consecutivo.']estado')->hiddenInput( [ 'value' => '1' ] )->label( '' ) ?>
				</div>
					
			</div>
		
		<?php
		
	}

    /**
     * Lists all DocumentosAliados models.
     * @return mixed
     */
    public function actionIndex($guardado = 0 )
    {
		$idInstitucion = $_SESSION['instituciones'][0];
		if( $idInstitucion > 0 )
		{
			$searchModel = new DocumentosAliadosBuscar();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->query->andWhere( 'estado=1' )->andWhere( 'id_institucion='.$idInstitucion );

			return $this->render('index', [
				'searchModel'	=> $searchModel,
				'dataProvider'	=> $dataProvider,
				'guardado' 		=> $guardado,
				'idInstitucion'	=> $idInstitucion,
			]);
		}
    }

    /**
     * Displays a single Documentos model.
     * @param string $id
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
     * Creates a new Documentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$data = [];
		$idInstitucion = $_SESSION['instituciones'][0];
		
		if( Yii::$app->request->post('DocumentosAliados') )
			$data = Yii::$app->request->post('DocumentosAliados');
		
		$count 	= count( $data );
		
		$models = [];
		for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new DocumentosAliados();
		}
							
		$dataInstituciones = Instituciones::find()
							->where( 'estado=1' )
							->andWhere( 'id='.$idInstitucion )
							->all();
		$instituciones 	  = ArrayHelper::map( $dataInstituciones, 'id', 'descripcion' );
		
		$dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Aliados'")->all();
		$tiposDocumento 	 = ArrayHelper::map( $dataTiposDocumento, 'id', 'descripcion' );
		
		$dataEstados  = Estados::find()->where( 'id=1' )->all();
		$estados 	  = ArrayHelper::map( $dataEstados, 'id', 'descripcion' );
		
		if (DocumentosAliados::loadMultiple($models, Yii::$app->request->post() )) {			
			
			foreach( $models as $key => $model) {
				
				//getInstances devuelve un array, por tanto siemppre se pone la posición 0
				$file = UploadedFile::getInstance( $model, "[$key]file" );
				
				if( $file ){
					
					// $persona = Personas::findOne( $model->id_persona );
					$institucion = Instituciones::findOne( $model->id_institucion );
					
					//Si no existe la carpeta se crea
					$carpeta = "../documentos/DocumentosAliados/".$institucion->codigo_dane;
					if (!file_exists($carpeta)) {
						mkdir($carpeta, 0777, true);
					}
					
					//Construyo la ruta completa del archivo a guardar
					$rutaFisicaDirectoriaUploads  = "../documentos/DocumentosAliados/".$institucion->codigo_dane."/";
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
				else{
					exit( "No hay archivo cargado" );
				}
			}
			
			//Se valida que todos los campos de todos los modelos sean correctos
			if (!DocumentosAliados::validateMultiple($models)) {
				Yii::$app->response->format = 'json';
				 return \yii\widgets\ActiveForm::validateMultiple($models);
			}
			
			//Guardo todos los modelos
			foreach( $models as $key => $model) {
				$model->save();
			}
			
			return $this->redirect(['index', 'guardado' => true ]);
        }
		
		$model = new DocumentosAliados();

        return $this->render('create', [
            'model' 		 => $model,
            'tiposDocumento' => $tiposDocumento,
            'instituciones'	 => $instituciones,
            'estados' 		 => $estados,
            'idInstitucion'	 => $idInstitucion,
        ]);
    }
	

    // /**
     // * Updates an existing Documentos model.
     // * If update is successful, the browser will be redirected to the 'view' page.
     // * @param string $id
     // * @return mixed
     // * @throws NotFoundHttpException if the model cannot be found
     // */
    // public function actionUpdate($id)
    // {
        // $model = $this->findModel($id);
		
		// $dataPersonas = Personas::find( $model->id )
								// ->select( "personas.id, ( nombres || ' ' || apellidos ) as nombres, identificacion " )
								// ->where( 'id='.$model->id_persona )
								// ->all();
		// $personas 	  = ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		// $dataTiposDocumento  = TiposDocumentos::find()->where( 'estado=1' )->andWhere( "categoria='Instancia institucionales'")->all();
		// $tiposDocumento 	 = ArrayHelper::map( $dataTiposDocumento, 'id', 'descripcion' );
		
		// $dataEstados  = Estados::find()->where( 'id=1' )->all();
		// $estados 	  = ArrayHelper::map( $dataEstados, 'id', 'descripcion' );

        // if ($model->load(Yii::$app->request->post()) )
		// {
			// // $file = UploadedFile::getInstanceByName('file');
			// $file = UploadedFile::getInstance( $model, 'ruta' );
			
			// if( $file ){
				
				// $persona = Personas::findOne( $model->id_persona );
					
				// //Si no existe la carpeta se crea
				// $carpeta = "../documentos/documentosInteresDocentes/".$persona->identificacion;
				// if (!file_exists($carpeta)) {
					// mkdir($carpeta, 0777, true);
				// }
				
				// $rutaFisicaDirectoriaUploads  = "../documentos/documentosInteresDocentes/".$persona->identificacion."/";
				// $rutaFisicaDirectoriaUploads .= $file->baseName;
				// $rutaFisicaDirectoriaUploads .= date( "_Y_m_d_His" ) . '.' . $file->extension;
				
				// $file->saveAs( $rutaFisicaDirectoriaUploads );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
				
				// $model->ruta = $rutaFisicaDirectoriaUploads;
		
				// if( $model->save() )
					// return $this->redirect(['view', 'id' => $model->id]);
			// }
        // }

        // return $this->render('update', [
            // 'model' => $model,
			// 'tiposDocumento' => $tiposDocumento,
            // 'personas' 		 => $personas,
            // 'estados' 		 => $estados,
        // ]);
    // }

    /**
     * Deletes an existing Documentos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$model->estado = 2;
		$model->update( false );

        return $this->redirect(['index']);
    }

    /**
     * Finds the Documentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Documentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentosAliados::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
