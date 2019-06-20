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

use app\models\GeReporteActividades;
use app\models\GeSeguimientoFile;
use Yii;
use app\models\GeSeguimientoOperador;
use app\models\GeSeguimientoOperadorBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use app\models\Sedes;
use app\models\Parametro;
use app\models\Personas;
use app\models\Instituciones;
use app\models\GeIndicadores;
use app\models\GeObjetivos;
use app\models\GeActividades;
use yii\helpers\ArrayHelper;

use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * GeSeguimientoOperadorController implements the CRUD actions for GeSeguimientoOperador model.
 */
class GeSeguimientoOperadorController extends Controller
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
     * Lists all GeSeguimientoOperador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeSeguimientoOperadorBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_tipo_seguimiento' => Yii::$app->request->get('idTipoSeguimiento')]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeSeguimientoOperador model.
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
     * Creates a new GeSeguimientoOperador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $id_sede 		= $_SESSION['sede'][0];
		$id_institucion	= $_SESSION['instituciones'][0];
		$guardado = false;
        $reportExist = false;
        $model = new GeSeguimientoOperador();
        $reportAct = new GeReporteActividades();

        if (Yii::$app->request->get('id')){
            $model = GeSeguimientoOperador::findOne(Yii::$app->request->get('id'));

            $reportAct = GeReporteActividades::find()->where(['id_seguimiento_operador' => Yii::$app->request->get('id')])->all();
            $reportExist = true;
        }

		$dataNombresOperador = Parametro::find()
									->where( 'estado=1' )
									->andWhere( 'id_tipo_parametro=37' )
									->all();
		
		$nombresOperador = ArrayHelper::map( $dataNombresOperador, 'id', 'descripcion' );
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
		$dataPersonas 		= Personas::find()
								->select( "( nombres || ' ' || apellidos ) as nombres, personas.id" )
								->innerJoin( 'perfiles_x_personas pp', 'pp.id_personas=personas.id' )
								->innerJoin( 'docentes d', 'd.id_perfiles_x_personas=pp.id' )
								->innerJoin( 'perfiles_x_personas_institucion ppi', 'ppi.id_perfiles_x_persona=pp.id' )
								->where( 'personas.estado=1' )
								->andWhere( 'id_institucion='.$id_institucion )
								->all();
		$personas			= ArrayHelper::map( $dataPersonas, 'id', 'nombres' );
		$institucion 		= Instituciones::findOne( $id_institucion );
		$dataIndicadores	= GeIndicadores::find()
								->where( 'estado=1' )
								->all();
		$indicadores		= ArrayHelper::map( $dataIndicadores, 'id', 'descripcion' );
		$dataActividades	= GeActividades::find()
								->where( 'estado=1' )
								->all();
		$actividades		= ArrayHelper::map( $dataActividades, 'id', 'descripcion' );
        $sede = Sedes::findOne( $id_sede );
		
        return $this->renderAjax('create', [
            'model' 			=> $model,
            'reportAct'         => $reportAct,
            'nombresOperador' 	=> $nombresOperador,
            'mesReporte' 		=> $mesReporte,
            'personas' 			=> $personas,
            'institucion' 		=> $institucion,
            'sede'				=> $sede,
            'indicadores' 		=> $indicadores,
            'actividades' 		=> $actividades,
            'guardado' 			=> $guardado,
            'reportExist'       => $reportExist
        ]);
    }

    public function actionStore(){

        $GeSeguimientoOperador = Yii::$app->request->post();
        $gs = new GeSeguimientoOperador();
        $gs->id_tipo_seguimiento = $GeSeguimientoOperador['id_tipo_seguimiento'];
        $gs->email = $GeSeguimientoOperador['email'];
        $gs->id_operador = $GeSeguimientoOperador['id_operador'];
        $gs->cual_operador = isset($GeSeguimientoOperador['cual_operador']) ? $GeSeguimientoOperador['cual_operador'] : '';
        $gs->proyecto_reportar = $GeSeguimientoOperador['proyecto_reportar'];
        $gs->id_ie = $GeSeguimientoOperador['id_ie'];
        $gs->mes_reporte = $GeSeguimientoOperador['mes_reporte'];
        $gs->semana_reporte = $GeSeguimientoOperador['semana_reportada'];
        $gs->id_persona_responsable = $GeSeguimientoOperador['id_persona_responsable'];
        $gs->avances_cumplimiento_cuantitativos = $GeSeguimientoOperador['avances_cumplimiento_cuantitativos'];
        $gs->avances_cumplimiento_cualitativos = $GeSeguimientoOperador['avances_cumplimiento_cualitativos'];
        $gs->propuesta_dificultades = $GeSeguimientoOperador['propuesta_dificultades'];
        $gs->indicador =  $GeSeguimientoOperador['indicador'];
        $gs->dificultades = $GeSeguimientoOperador['dificultades'];
        $gs->estado = 1;
        $gs->save(false);

        foreach (array_filter(json_decode($GeSeguimientoOperador['reporte_actividades'])) as $key => $RepAct){
            $ra = new GeReporteActividades();

            $ra->id_seguimiento_operador = $gs->id;
            $ra->objetivo = $RepAct->objetivo;
            $ra->actividad = $RepAct->actividad;
            $ra->poblacion_beneficiaria = $RepAct->id_poblacion;
            $ra->descripcion = $RepAct->descripcion_actividad;
            $ra->num_participantes = $RepAct->numero_participantes;
            $ra->duracion = $RepAct->duracion_actividad;
            $ra->logros = $RepAct->logros_alcanzados;
            $ra->dificultades = $RepAct->dificultadades;

            $ra->save(false);

            $carpeta = "../documentos/seguimientoOperador/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            if (isset($_FILES['files-' . $key]) && !empty($_FILES['files-' . $key])) {
                $no_files = count($_FILES['files-' . $key]['name']);
                for ($i = 0; $i < $no_files; $i++) {
                    $urlBase = "../documentos/seguimientoOperador/";
                    $name = $_FILES['files-' . $key]['name'][$i];//'segOperador'.$gs->id.'-'.$ra->id.'.'.substr($_FILES["files"]['name'][$i], strrpos($_FILES["files"]['name'][$i], '.') + 1);

                    move_uploaded_file($_FILES['files-' . $key]["tmp_name"][$i], $urlBase . $name);

                    $file_ra = new GeSeguimientoFile();
                    $file_ra->id_reporte_actividades = $ra->id;
                    $file_ra->file = $name;
                    $file_ra->save(false);
                }
            }
        }

        Yii::$app->session->setFlash('ok');
        return 'ok';
    }

    /**
     * Updates an existing GeSeguimientoOperador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $GeSeguimientoOperador = Yii::$app->request->post();
        $gs = GeSeguimientoOperador::findOne(Yii::$app->request->post('id'));
        $gs->id_operador = $GeSeguimientoOperador['id_operador'];
        $gs->cual_operador = isset($GeSeguimientoOperador['cual_operador']) ? $GeSeguimientoOperador['cual_operador'] : '';
        $gs->proyecto_reportar = $GeSeguimientoOperador['proyecto_reportar'];
        $gs->id_ie = $GeSeguimientoOperador['id_ie'];
        $gs->mes_reporte = $GeSeguimientoOperador['mes_reporte'];
        $gs->semana_reporte = $GeSeguimientoOperador['semana_reportada'];
        $gs->id_persona_responsable = $GeSeguimientoOperador['id_persona_responsable'];
        $gs->avances_cumplimiento_cuantitativos = $GeSeguimientoOperador['avances_cumplimiento_cuantitativos'];
        $gs->avances_cumplimiento_cualitativos = $GeSeguimientoOperador['avances_cumplimiento_cualitativos'];
        $gs->propuesta_dificultades = $GeSeguimientoOperador['propuesta_dificultades'];
        $gs->indicador =  $GeSeguimientoOperador['indicador'];
        $gs->dificultades = $GeSeguimientoOperador['dificultades'];
        $gs->estado = 1;
        $gs->save(false);

        foreach (array_filter(json_decode($GeSeguimientoOperador['reporte_actividades'])) as $key => $RepAct) {
            $ra = GeReporteActividades::find()->where(['id_seguimiento_operador' => $gs->id])
                ->andWhere(['objetivo' => $RepAct->objetivo])->one();
            if (isset($ra)){
                $ra->objetivo = $RepAct->objetivo;
                $ra->actividad = $RepAct->actividad;
                $ra->poblacion_beneficiaria = $RepAct->id_poblacion;
                $ra->descripcion = $RepAct->descripcion_actividad;
                $ra->num_participantes = $RepAct->numero_participantes;
                $ra->duracion = $RepAct->duracion_actividad;
                $ra->logros = $RepAct->logros_alcanzados;
                $ra->dificultades = $RepAct->dificultadades;
                $ra->save(false);
            }else{
                $ra = new GeReporteActividades();

                $ra->id_seguimiento_operador = $gs->id;
                $ra->objetivo = $RepAct->objetivo;
                $ra->actividad = $RepAct->actividad;
                $ra->poblacion_beneficiaria = $RepAct->id_poblacion;
                $ra->descripcion = $RepAct->descripcion_actividad;
                $ra->num_participantes = $RepAct->numero_participantes;
                $ra->duracion = $RepAct->duracion_actividad;
                $ra->logros = $RepAct->logros_alcanzados;
                $ra->dificultades = $RepAct->dificultadades;

                $ra->save(false);
            }

            $carpeta = "../documentos/seguimientoOperador/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            if (isset($_FILES['files-' . $key]) && !empty($_FILES['files-' . $key])) {
                $no_files = count($_FILES['files-' . $key]['name']);
                for ($i = 0; $i < $no_files; $i++) {
                    $urlBase = "../documentos/seguimientoOperador/";
                    $name = $_FILES['files-' . $key]['name'][$i];//'segOperador'.$gs->id.'-'.$ra->id.'.'.substr($_FILES["files"]['name'][$i], strrpos($_FILES["files"]['name'][$i], '.') + 1);

                    move_uploaded_file($_FILES['files-' . $key]["tmp_name"][$i], $urlBase . $name);

                    $file_ra = new GeSeguimientoFile();
                    $file_ra->id_reporte_actividades = $ra->id;
                    $file_ra->file = $name;
                    $file_ra->save(false);
                }
            }

        }

        Yii::$app->session->setFlash('ok');
        return 'ok';
    }

    /**
     * Deletes an existing GeSeguimientoOperador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect('index.php?r=ge-seguimiento-operador&idTipoSeguimiento=1');
    }

    /**
     * Deletes an existing GeSeguimientoOperador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDactividad($id)
    {
        $actividad = GeReporteActividades::findOne($id);
        $actividad->delete();
        return 'ok';
    }

    /**
     * Deletes an existing GeSeguimientoOperador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDfile($id)
    {
        $file = GeSeguimientoFile::find($id)->one();
        if (isset($file)){
            $file->delete();
        }
        return 'ok';
    }

    /**
     * Finds the GeSeguimientoOperador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GeSeguimientoOperador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeSeguimientoOperador::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
