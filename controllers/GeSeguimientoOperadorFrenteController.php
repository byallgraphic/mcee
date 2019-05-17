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
use app\models\GeSeguimientoOperadorFrente;
use app\models\GeSeguimientoOperadorFrenteBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Sedes;
use app\models\Parametro;
use app\models\Instituciones;
use app\models\Personas;
use yii\helpers\ArrayHelper;

use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * GeSeguimientoOperadorFrenteController implements the CRUD actions for GeSeguimientoOperadorFrente model.
 */
class GeSeguimientoOperadorFrenteController extends Controller
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
     * Lists all GeSeguimientoOperadorFrente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeSeguimientoOperadorFrenteBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeSeguimientoOperadorFrente model.
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
     * Creates a new GeSeguimientoOperadorFrente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		
		$guardado = false;
		
		$tipo_seguimiento = Yii::$app->request->get( 'idTipoSeguimiento' );


        $model = GeSeguimientoOperadorFrente::findOne(Yii::$app->request->get( 'id' ));

        if (!isset($model)){
            $model = new GeSeguimientoOperadorFrente();
        }

        if( $model->load(Yii::$app->request->post()) ) {
			
			$model->id_tipo_seguimiento = Yii::$app->request->post('idTipoSeguimiento');
			$model->estado = 1;
			
			$model->documentFile = UploadedFile::getInstance( $model, 'documentFile' );
			
			if( $model->documentFile ) {
				
				//Si no existe la carpeta se crea
				$carpeta = "../documentos/seguimientoOperadorFrente/";
				if (!file_exists($carpeta)) {
					mkdir($carpeta, 0777, true);
				}
				
				//Construyo la ruta completa del archivo a guardar
				$rutaFisicaDirectoriaUploads  = "../documentos/seguimientoOperadorFrente/";
				$rutaFisicaDirectoriaUploads .= $model->documentFile->baseName;
				$rutaFisicaDirectoriaUploads .= date( "_Y_m_d_His" ) . '.' . $model->documentFile->extension;
				
				$save = $model->documentFile->saveAs( $rutaFisicaDirectoriaUploads );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
				
				$model->ruta_archivo = $rutaFisicaDirectoriaUploads;
				
				if( $model->save(false) )
				{	
					$guardado = true;
					// return $this->redirect(['index']);
				}
			}
        }
		
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		
		$personas			= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		
		$mesReporte = [
						1  => 'Enero',
						2  => 'Febrero',
						3  => 'Marzo',
						4  => 'Abril',
						5  => 'Mayo',
						6  => 'Junio',
						7  => 'Julio',
						8  => 'Agosto',
						9  => 'Septiembre',
						10 => 'Octubre',
						11 => 'Noviembre',
						12 => 'Diciembre',
					];
					
		$sino = [
						1  => 'Sí',
						0  => 'No',
					];
					
		$dataSeleccion = Parametro::find()
									->where( 'estado=1' )
									->andWhere( 'id_tipo_parametro=41' )
									->all();
		
		$seleccion = ArrayHelper::map( $dataSeleccion, 'id', 'descripcion' );
        $sede = Sedes::findOne( $id_sede );

        if( $model->load(Yii::$app->request->post())){
            return $this->redirect('index.php?r=ge-seguimiento-operador-frente&idTipoSeguimiento='.Yii::$app->request->post('idTipoSeguimiento').'&guardado=true');
        }

        return $this->render('create', [
            'model' => $model,
            'guardado' => $guardado,
            'personas' => $personas,
            'mesReporte' => $mesReporte,
            'sede'				=> $sede,
            'sino' => $sino,
            'seleccion' => $seleccion,
        ]);
    }

    /**
     * Updates an existing GeSeguimientoOperadorFrente model.
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
     * Deletes an existing GeSeguimientoOperadorFrente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect('index.php?r=ge-seguimiento-operador-frente&idTipoSeguimiento=3');
    }

    /**
     * Finds the GeSeguimientoOperadorFrente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GeSeguimientoOperadorFrente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeSeguimientoOperadorFrente::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
