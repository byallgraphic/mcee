<?php
/**********
Versión: 001
Fecha: 02-01-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud Seguimiento operador
---------------------------------------
Modificaciones:
Fecha: 02-01-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: Modificaciones en los actionCreate y actionDelete
----------------------------------------
**********/
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

use app\models\PppReporteActividades;
use app\models\PppSeguimientoFile;
use app\models\Sedes;
use Yii;
use app\models\PppSeguimientoOperador;
use app\models\PppSeguimientoOperadorBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Parametro;
use app\models\Personas;
use app\models\Instituciones;
use app\models\PppIndicadores;
use app\models\PppActividades;
use yii\helpers\ArrayHelper;


/**
 * PppSeguimientoOperadorController implements the CRUD actions for PppSeguimientoOperador model.
 */
class PppSeguimientoOperadorController extends Controller
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
     * Lists all PppSeguimientoOperador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PppSeguimientoOperadorBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['estado' => 1])->andWhere(['id_admin' => $_SESSION["id"]])->andWhere(['id_tipo_seguimiento' => Yii::$app->request->get('idTipoSeguimiento')]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PppSeguimientoOperador model.
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
     * Creates a new PppSeguimientoOperador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $id_sede 		= $_SESSION['sede'][0];
        $id_institucion	= $_SESSION['instituciones'][0];
        $guardado = false;
        $reportExist = false;
        $model = new PppSeguimientoOperador();
        $reportAct = new pppReporteActividades();

        if (Yii::$app->request->get('id')){
            $model = PppSeguimientoOperador::findOne(Yii::$app->request->get('id'));
            $reportAct = PppReporteActividades::find()->where(['id_seguimiento_operador' => Yii::$app->request->get('id')])->all();
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
        $dataIndicadores	= PppIndicadores::find()
            ->where( 'estado=1' )
            ->all();
        $indicadores		= ArrayHelper::map( $dataIndicadores, 'id', 'descripcion' );
        $dataActividades	= PppActividades::find()
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

        $gs = new PppSeguimientoOperador();
        $gs->id_tipo_seguimiento = $GeSeguimientoOperador['id_tipo_seguimiento'];
        $gs->email = $GeSeguimientoOperador['email'];
        $gs->id_admin = $_SESSION["id"];
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


        foreach (json_decode($GeSeguimientoOperador['reporte_actividades']) as $RepAct){
            $ra = new PppReporteActividades();

            $ra->id_seguimiento_operador = $gs->id;
            $ra->objetivo = $RepAct->objetivo;
            $ra->actividad = $RepAct->actividad;
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

            if (isset($_FILES['files']) && !empty($_FILES['files'])) {
                $no_files = count($_FILES["files"]['name']);
                for ($i = 0; $i < $no_files; $i++) {
                    $urlBase  = "../documentos/seguimientoOperador/";
                    $name = $_FILES["files"]['name'][$i];//'segOperador'.$gs->id.'-'.$ra->id.'.'.substr($_FILES["files"]['name'][$i], strrpos($_FILES["files"]['name'][$i], '.') + 1);

                    move_uploaded_file($_FILES["files"]["tmp_name"][$i], $urlBase.$name);

                    $file_ra = new PppSeguimientoFile();
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
     * Updates an existing PppSeguimientoOperador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $GeSeguimientoOperador = Yii::$app->request->post();
        $gs = PppSeguimientoOperador::findOne(Yii::$app->request->post('id'));
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

        $ra = PppReporteActividades::find()->where(['id_seguimiento_operador' => $gs->id])->one();

        foreach (json_decode($GeSeguimientoOperador['reporte_actividades']) as $RepAct) {
            $ra->objetivo = $RepAct->objetivo;
            $ra->actividad = $RepAct->actividad;
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

            if (isset($_FILES['files']) && !empty($_FILES['files'])) {
                $no_files = count($_FILES["files"]['name']);
                for ($i = 0; $i < $no_files; $i++) {
                    $urlBase = "../documentos/seguimientoOperador/";
                    $name = 'segOperador' . $gs->id . '-' . $ra->id . '.' . substr($_FILES["files"]['name'][$i], strrpos($_FILES["files"]['name'][$i], '.') + 1);

                    move_uploaded_file($_FILES["files"]["tmp_name"][$i], $urlBase . $name);

                    $file_ra = new PppSeguimientoFile();
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
     * Deletes an existing PppSeguimientoOperador model.
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
     * Finds the PppSeguimientoOperador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PppSeguimientoOperador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PppSeguimientoOperador::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
