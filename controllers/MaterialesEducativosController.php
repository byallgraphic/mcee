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
use app\models\MaterialesEducativos;
use app\models\MaterialesEducativosBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Estados;
use yii\web\UploadedFile;
use app\models\Instituciones;
use yii\helpers\ArrayHelper;
use app\models\Parametro;
use yii\widgets\ActiveForm;


/**
 * MaterialesEducativosController implements the CRUD actions for MaterialesEducativos model.
 */
class MaterialesEducativosController extends Controller
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
     * Lists all MaterialesEducativos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialesEducativosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( 'estado=1' );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	
	function actionAgregarCampos(){
		
		$idInstitucion = $_SESSION['instituciones'][0];
		$consecutivo = Yii::$app->request->post('consecutivo');
		
		$model = new MaterialesEducativos();
		$tipo = $this->obtenerParametros(26);
		$autor = $this->obtenerParametros(27);
		$nivel = $this->obtenerParametros(28);
		$estados = $this->obtenerEstados();
		
		$form = ActiveForm::begin();
		
		?> 
		<div class=row>
			<?= $form->field($model, '['.$consecutivo.']tipo')->DropDownList($tipo,['prompt'=>'Seleccione...']) ?>

			<?= $form->field($model, '['.$consecutivo.']autor')->DropDownList($autor,['prompt'=>'Seleccione...']) ?>

			<?= $form->field($model, '['.$consecutivo.']nivel')->DropDownList($nivel,['prompt'=>'Seleccione...'])?>

			<?= $form->field($model, '['.$consecutivo.']otro_cual')->textInput() ?>

			<?= $form->field($model, '['.$consecutivo.']nombre_apellidos')->textInput() ?>

			<?= $form->field($model, '['.$consecutivo.']reseña')->textArea() ?>
			
			<?= $form->field($model, '['.$consecutivo.']ruta')->fileInput() ?>
			
			<?= $form->field($model, '['.$consecutivo.']estado')->DropDownList($estados) ?>
		</div>
		<?php
		
	}


	public function obtenerParametros($id_parametro)
	{
		//parametros de Fases informe planeación IEO
		$dataParametros = Parametro::find()
						->where( "id_tipo_parametro=$id_parametro" )
						->andWhere( 'estado=1' )
						->orderby( 'id' )
						->all();
						
		$parametros		= ArrayHelper::map( $dataParametros, 'id', 'descripcion' );
		
		return $parametros;
	
	}
	
			
	public function obtenerEstados()
	{
		$estados = new Estados();
		$estados = $estados->find()->orderby("id")->all();
		$estados = ArrayHelper::map($estados,'id','descripcion');
		
		return $estados;
	}
	
	/**
     * Displays a single MaterialesEducativos model.
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
     * Creates a new MaterialesEducativos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$data = [];
		$idInstitucion = $_SESSION['instituciones'][0];
		
		$institucion = Instituciones::findOne($idInstitucion);
		
		if( Yii::$app->request->post('MaterialesEducativos') )
			$data = Yii::$app->request->post('MaterialesEducativos');
        
		$count 	= count( $data );
		
		$models = [];
		for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new MaterialesEducativos();
		}
		
		if (MaterialesEducativos::loadMultiple($models, Yii::$app->request->post() )) 
		{			
			
			foreach( $models as $key => $model) {
				
				//getInstances devuelve un array, por tanto siemppre se pone la posición 0
				$file = UploadedFile::getInstance( $model, "[$key]ruta" );
				
				if( $file )
				{
					
					//Si no existe la carpeta se crea
					$carpeta = "../documentos/MaterialesEducativos/".$institucion->codigo_dane;
					if (!file_exists($carpeta)) 
					{
						mkdir($carpeta, 0777, true);
					}
					
					//Construyo la ruta completa del archivo a guardar
					$rutaFisicaDirectoriaUploads  = "../documentos/MaterialesEducativos/".$institucion->codigo_dane."/";
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
			if (!MaterialesEducativos::validateMultiple($models)) {
				Yii::$app->response->format = 'json';
				 return \yii\widgets\ActiveForm::validateMultiple($models);
			}
			
			//Guardo todos los modelos
			foreach( $models as $key => $model) {
				$model->save();
			}
			
			return $this->redirect(['index', 'guardado' => true ]);
        }
		
		$model = new MaterialesEducativos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
			'tipo' => $this->obtenerParametros(26),
			'autor' => $this->obtenerParametros(27),
			'nivel' => $this->obtenerParametros(28),
			'estados' => $this->obtenerEstados(),
			
        ]);
    }

    /**
     * Updates an existing MaterialesEducativos model.
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
			'tipo' => $this->obtenerParametros(26),
			'autor' => $this->obtenerParametros(27),
			'nivel' => $this->obtenerParametros(28),
			'estados' => $this->obtenerEstados(),
        ]);
    }

    /**
     * Deletes an existing MaterialesEducativos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MaterialesEducativos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MaterialesEducativos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaterialesEducativos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
