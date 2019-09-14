<?php
/**********
Versión: 001
Fecha: 14-01-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud y generacion de word Informe Avance Ejecucion Misional
-------------------------------------
Modificaciones:
Fecha: 14-01-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: se crean las funciones 
					obtenerNombresXPerfiles
					obtenerNombrePersona
					obtenerProyectosEjes
					nombrePerfilesXPersonas
					obtenerInstituciones
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

use Yii;
use app\models\EcInformeAvanceEjecucionMisional;
use app\models\EcInformeAvanceEjecucionMisionalBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Instituciones;
use app\models\EcProyectos;
use app\models\PerfilesXPersonas;
use app\models\Personas;
use app\models\PerfilesXPersonasInstitucion;


/**
 * EcInformeAvanceEjecucionMisionalController implements the CRUD actions for EcInformeAvanceEjecucionMisional model.
 */
class EcInformeAvanceEjecucionMisionalController extends Controller
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
     * Lists all EcInformeAvanceEjecucionMisional models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EcInformeAvanceEjecucionMisionalBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( "estado=1" ); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EcInformeAvanceEjecucionMisional model.
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

   
	/****
		obtener el nombre de la persona de acuerdo el id del perfil y la institucion
	****/
	public function obtenerNombresXPerfiles($idPerfil)
	{
		$idInstitucion 	= $_SESSION['instituciones'][0];
		/**
		* Llenar nombre de los cooordinadores-eje
		*/
		//variable con la conexion a la base de datos 
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
			SELECT ppi.id, concat(pe.nombres,' ',pe.apellidos) as nombres
			FROM perfiles_x_personas as pp, 
			personas as pe,
			perfiles_x_personas_institucion ppi
			WHERE pp.id_personas = pe.id
			AND pp.id_perfiles = $idPerfil
			AND ppi.id_perfiles_x_persona = pp.id
			AND ppi.id_institucion = $idInstitucion
		");
		$result = $command->queryAll();
		$nombresPerfil = array();
		foreach ($result as $r)
		{
			$nombresPerfil[$r['id']]= $r['nombres'];
		}
		
		return $nombresPerfil;
	}
	
	
	/****
		Obtener el nombre de la persona segun el id perfilesxpersonas de la sesion actual
	****/
	public function obtenerNombrePersona()
	{
		$idPersona 	= $_SESSION['perfilesxpersonas'];
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
			SELECT pp.id, concat(pe.nombres,' ',pe.apellidos) as nombres
			FROM perfiles_x_personas as pp, 
			personas as pe
			WHERE pp.id_personas = pe.id
            and pp.id = $idPersona
		");
		$result = $command->queryAll();
		$persona = array();
		foreach ($result as $r)
		{
			$persona[$r['id']]= $r['nombres'];
		}
		
		return $persona;
		
	}
	
	/****
		Nombre de la institucion segun el id de la institucion de la sesion
	****/
	
	public function obtenerInstituciones()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$instituciones = new Instituciones();
		$instituciones = $instituciones->find()->where("id = $idInstitucion")->all();
		$instituciones = ArrayHelper::map($instituciones,'id','descripcion');
		
		return $instituciones;
	}
	
	/****
		Obtener los nombre de los proyectos que en este caso son los ejes
	****/
	public function obtenerProyectosEjes()
	{
		$idTipoInforme = $_GET['idTipoInforme'];
		
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand(
		"
			select p.descripcion,p.id
			from ec.tipo_informe as ti, ec.componentes as c, ec.proyectos as p
			where ti.id = $idTipoInforme
			and ti.id_componente = c.id
			and c.descripcion = p.descripcion
			
		");
		$ecProyectos = $command->queryAll();
		
		$descripcionProyecto = $ecProyectos[0]['descripcion'];
		$ejes = new EcProyectos();
		$ejes = $ejes->find()->andWhere("descripcion ='$descripcionProyecto'" )->orderby("id")->all();
		$ejes = ArrayHelper::map($ejes,'id','descripcion');
		
		return $ejes;
	}
	
	
	 /**
     * Creates a new EcInformeAvanceEjecucionMisional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EcInformeAvanceEjecucionMisional();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','guardado'=> 1]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
			'persona' => $this->obtenerNombrePersona(),
			'coordinador' =>$this->obtenerNombresXPerfiles(23),
			'secretario' =>$this->obtenerNombresXPerfiles(24),
			'coordinadorProyecto' =>$this->obtenerNombresXPerfiles(25),
			'instituciones'=> $this->obtenerInstituciones(),
			'ejes'=> $this->obtenerProyectosEjes(),
        ]);
    }
	
    /**
     * Updates an existing EcInformeAvanceEjecucionMisional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['index','guardado'=> 1]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
			'persona' => $this->obtenerNombrePersona(),
			'coordinador' =>$this->obtenerNombresXPerfiles(23),
			'secretario' =>$this->obtenerNombresXPerfiles(24),
			'coordinadorProyecto' =>$this->obtenerNombresXPerfiles(25),
			'instituciones'=> $this->obtenerInstituciones(),
			'ejes'=> $this->obtenerProyectosEjes(),
        ]);
    }

	
	public function nombrePerfilesXPersonas($id)
	{
		$idPerfilesXpersonas	= PerfilesXPersonasInstitucion::findOne($id)->id_perfiles_x_persona;
		$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
		$nombres 				= Personas::findOne($perfiles_x_persona);
		$nombres				= $nombres->nombres." ".$nombres->apellidos;
		
		return $nombres;
	}
	
	public function actionInforme($id)
    {
		
		$model = $this->findModel($id);
		
		$institucionNombre  = Instituciones::findOne($model->id_institucion)->descripcion;
		
		$ejeNombre  		= EcProyectos::findOne($model->id_eje)->descripcion;
		
		
		
		
		$coordinador	= $this->nombrePerfilesXPersonas($model->id_coordinador);
		$secretaria 	= $this->nombrePerfilesXPersonas($model->id_secretaria);
		$id_coor_proyecto_uni = $this->nombrePerfilesXPersonas($model->id_coor_proyecto_uni);
		$id_coor_proyecto_sec = $this->nombrePerfilesXPersonas($model->id_coor_proyecto_sec);
		
		$descripcion			= $model->descripcion;
		$presentacion			= $model->presentacion;
		$productos				= $model->productos;
		$presentacion_retos		= $model->presentacion_retos;
		$alarmas				= $model->alarmas;
		$consolidad_avance		= $model->consolidad_avance;
		
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
		$document = $phpWord->loadTemplate('plantillas\9.Informe_de_avance_ejecución_y_misional_del_proyectoPlantilla.docx');
		
		$document->setValue('ieo', $institucionNombre);
		$document->setValue('eje', $ejeNombre);
		$document->setValue('coordinador', $coordinador);
		$document->setValue('secretaria', $secretaria);
		$document->setValue('id_coor_proyecto_uni', $id_coor_proyecto_uni);
		$document->setValue('id_coor_proyecto_sec', $id_coor_proyecto_sec);
		$document->setValue('año', date("Y"));
		
		$document->setValue('descripcion', $descripcion);
		$document->setValue('presentacion', $presentacion);
		$document->setValue('productos', $productos);
		$document->setValue('presentacion_retos', $presentacion_retos);
		$document->setValue('alarmas', $alarmas);
		$document->setValue('consolidad_avance', $consolidad_avance);
		
		$nombreArchivo ='9.Informe_de_avance_ejecución_y_misional_del_proyecto.docx';
		$document->saveAs($nombreArchivo); // Save to temp file
		
		
		header("Content-disposition: attachment; filename=$nombreArchivo");
		header("Content-type: MIME");
		readfile($nombreArchivo);
		
		
    }
    /**
     * Deletes an existing EcInformeAvanceEjecucionMisional model.
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
     * Finds the EcInformeAvanceEjecucionMisional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EcInformeAvanceEjecucionMisional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EcInformeAvanceEjecucionMisional::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
