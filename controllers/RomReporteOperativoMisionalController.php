<?php
/**********
Versión: 001
Fecha: 02-01-2019
Desarrollador: Oscar David Lopez Villa
Descripción: crud orientacion proceseso 
---------------------------------------
Modificaciones:
Fecha: 25-01-2019
Fecha: 01-02-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: Se reestructura completamente la funcion actionCreate,
					Se implementa la subida de archivos multiples sobre multiples formularios
					Se elimina la funcion actionViewFaces y se reemplaza por actionFormulario donde se reestructura completamente
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
use yii\web\UploadedFile;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\Parametro;
use app\models\IsaRomProyectos;
use app\models\IsaActividadesRom;
use app\models\RomReporteOperativoMisional;
use app\models\IsaTipoCantidadPoblacionRom;
use app\models\IsaEvidenciasRom;
use app\models\RomActividadesRom;
use app\models\RomTipoCantidadPoblacionRom;
use yii\bootstrap\Collapse;
use app\models\UploadForm;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\DateTime;

/**
 * RomReporteOperativoMisionalController implements the CRUD actions for RomReporteOperativoMisional model.
 */
class RomReporteOperativoMisionalController extends Controller
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
     * Lists all RomReporteOperativoMisional models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RomReporteOperativoMisional::find()->where(['estado' => 1]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

	public function obtenerParametros($idTipoParametro)
	{
		//parametros de Fases informe planeación IEO
		$dataParametros = Parametro::find()
						->where( "id_tipo_parametro=$idTipoParametro" )
						->andWhere( 'estado=1' )
						->orderby( 'id' )
						->all();
						
		$parametros		= ArrayHelper::map( $dataParametros, 'id', 'descripcion' );
		
		return $parametros;
	
	}
		
	//funcion que se encarga de crear el formulario dinamicamente sin contar los campos de guardado que estan en la vista formulario
    function actionFormulario($model, $form, $datos = 0 )
	{
		$proyectos = new IsaRomProyectos();
		$proyectos = $proyectos->find()->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		$estados= $this->obtenerParametros(45);
		// $ecProyectos = EcProyectos::find()->where( 'estado=1' )->orderby('id ASC')->all();
		
		
		//acordeon de los proyecto 
		foreach ($proyectos as $idProyecto => $v)
		{
			
			 $contenedores[] = 	
				[
					'label' 		=>  $v,
					'content' 		=>  $this->renderPartial( 'procesos', 
													[  
                                                        'idProyecto' => $idProyecto,
														'form' => $form,
														//'modelProyectos' =>  $modelProyectos,
														'datos'=>$datos,
														'estados'=>$estados,
													] 
										),
					'contentOptions'=> ['class' => 'in'],
					'options' => ['class' => ' panel-primary']
					
				];
				
	
		}
		
		 echo Collapse::widget([
			'items' => $contenedores,
			
		]);
		
	}

    /**
     * Displays a single RomReporteOperativoMisional model.
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
     * Creates a new RomReporteOperativoMisional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RomReporteOperativoMisional();
		
		$idInstitucion = $_SESSION['instituciones'][0];
		
        $institucion = Instituciones::findOne($idInstitucion);
        if ($model->load(Yii::$app->request->post())) 
		{
            if($model->save())
			{
                $rom_id = $model->id;
				
				if($arrayDatosActividades = Yii::$app->request->post('IsaActividadesRom'))
				{
				
					// se agrega el id del reporte despues de haber sido creado 
					foreach($arrayDatosActividades as $datos => $valores)
					{
						$arrayDatosActividades[$datos]['id_reporte_operativo_misional']= $rom_id;
					}
					
					//guarda la informa en la tabla isa.actividades segun como vienen los datos en el post
					$columnNameArrayActividades=['alarmas','alternativas','articulacion','debilidades','diligencia','docente_orientador','duracion_sesion','estado','evaluacion','fecha_desde','fecha_diligencia','fecha_hasta','fecha_reprogramacion','fortalezas','id_rom_actividad','justificacion_activiad_no_realizada','logros','nombre_actividad','num_equipos','observaciones_generales','perfiles','retos','rol','id_reporte_operativo_misional'];
					// inserta todos los datos que trae el array arrayDatosActividades
					$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert('isa.actividades_rom', $columnNameArrayActividades, $arrayDatosActividades) ->execute();
				}
				
				if($arrayDatosPoblacion = Yii::$app->request->post('IsaTipoCantidadPoblacionRom'))
				{
					
					// se agrega el id del reporte despues de haber sido creado 
					foreach($arrayDatosPoblacion as $datos => $valores)
					{
						$arrayDatosPoblacion[$datos]['id_reporte_operativo_misional'] = $rom_id;
					}
					
					//guarda la informa en la tabla isa.tipo_cantidad_poblacion_rom segun como vienen los datos en el post
					$columnNameArrayPoblacion=['vecinos','lideres_comunitarios','empresarios_comerciantes','organizaciones_locales','grupos_comunitarios','otos_actores','total_participantes','id_rom_actividades','id_reporte_operativo_misional'];
					// inserta todos los datos que trae el array arrayDatosActividades
					$insertCount = Yii::$app->db->createCommand()
					   ->batchInsert('isa.tipo_cantidad_poblacion_rom', $columnNameArrayPoblacion, $arrayDatosPoblacion)->execute(); 
				}
				
				//guarda todos los archivos en el servidor y la url en la base de datos
				//valida que el post tenga IsaEvidenciasRom y lo asigan a la variable $arrayDatosEvidencias
				if($arrayDatosEvidencias = Yii::$app->request->post('IsaEvidenciasRom'))
				{
					
					//se deben crear modelos de forma dinamica para posteriormente hacer el guardado de la informacion
					$modeloEvidencias = [];
					$cantidad = count($arrayDatosEvidencias);
					for( $i = 0; $i < $cantidad; $i++ )
					{
						$modeloEvidencias[] = new IsaEvidenciasRom();
					}
					
					//carga la informacion 
					if (IsaEvidenciasRom::loadMultiple($modeloEvidencias,  Yii::$app->request->post() )) 
					{	
						//se guarda la informacion en una carpeta con el nombre del codigo dane de la institucion seleccionada
						$idInstitucion 	= $_SESSION['instituciones'][0];
						$institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;
						
						//Si no existe la carpeta se crea
						$carpeta = "../documentos/reporteOperativo/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
						}
						
						//array con los nombres de los campos de la tabla isa.evidencias_rom
						$propiedades = array( "actas", "reportes", "listados", "plan_trabajo", "formato_seguimiento", "formato_evaluacion", "fotografias", "vidoes", "otros_productos");
						
						//recorre el array $modeloEvidencias con cada modelo creado dinamicamente
						foreach( $modeloEvidencias as $key => $model) 
						{
							$key +=1;
							
							//recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
							//para posteriormente guardar en la base de datos
							foreach($propiedades as $propiedad)
							{
								$arrayRutasFisicas = array();
								// se guarda el archivo en file
								
								// se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
								$files = UploadedFile::getInstances( $model, "[$key]$propiedad" );
								
								if( $files )
								{
									//se suben todos los archivos uno por uno
									foreach($files as $file)
									{
										//se usan microsegundos para evitar un nombre de archivo repetido
										$t = microtime(true);
										$micro = sprintf("%06d",($t - floor($t)) * 1000000);
										$d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
										
										// Construyo la ruta completa del archivo a guardar
										$rutaFisicaDirectoriaUploads  = "../documentos/reporteOperativo/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
										$save = $file->saveAs( $rutaFisicaDirectoriaUploads );
										//rutas de todos los archivos
										$arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
									}
									
									// asignacion de la ruta al campo de la db
									$model->$propiedad = implode(",", $arrayRutasFisicas);
									// $model->$propiedad =  $var;
									$arrayRutasFisicas = null;
								}
								else
								{
									echo "No hay archivo cargado";
								}
								
							}
							
							//se deben asignar los valores ya que se crean los modelos dinamicamente, yii no los agrega
							//los datos que vienen por post
							$model->cantidad  						= $arrayDatosEvidencias[$key]['cantidad'];
							$model->archivos_enviados_entregados 	= $arrayDatosEvidencias[$key]['archivos_enviados_entregados'];
							$model->fecha_entrega_envio				= $arrayDatosEvidencias[$key]['fecha_entrega_envio'];
							$model->id_rom_actividad				= $arrayDatosEvidencias[$key]['id_rom_actividad'];
							$model->id_reporte_operativo_misional 	= $rom_id;
							//Siempre activo
							$model->estado = 1;
							
							
							//Guarda la informacion que tiene $model en la base de datos
							foreach( $modeloEvidencias as $key => $model) 
							{
								$model->save();
							}
						}
						return $this->redirect(['index', 'guardado' => true ]);
							
					} 
							 
				}
				return $this->redirect(['index', 'guardado' => 1 ]);
			}
			
		}	
			$Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
			$sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );

			return $this->renderAjax('create', [
				'model' => $model,
				'sedes' => $sedes,
				'institucion'=> $this->obtenerInstitucion(),
				
			]);
		
	}

	
	public function obtenerInstitucion()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$instituciones = new Instituciones();
		$instituciones = $instituciones->find()->where("id = $idInstitucion")->all();
		$instituciones = ArrayHelper::map($instituciones,'id','descripcion');
		
		return $instituciones;
	}
	

	
    /**
     * Updates an existing RomReporteOperativoMisional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$idInstitucion = $_SESSION['instituciones'][0];
		$Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );
	
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
            return $this->redirect(['index']);
        }
		
		$datos = array();
		
		
		$actividadesRom = new RomActividadesRom ();
		$actividadesRom = $actividadesRom->find()->orderby("id")->andWhere("id_reporte_operativo_misional = $id")->all();
	
		//se trae la informacionde la base de datos 
		$result = ArrayHelper::getColumn($actividadesRom, function ($element) 
		{
			$dato[$element['id_reporte_operativo_misional']]['fecha_desde']= $element['fecha_desde'];
			$dato[$element['id_reporte_operativo_misional']]['fecha_hasta']= $element['fecha_hasta'];
			$dato[$element['id_reporte_operativo_misional']]['num_equipos']= $element['num_equipos'];
			$dato[$element['id_reporte_operativo_misional']]['perfiles']= $element['perfiles'];
			$dato[$element['id_reporte_operativo_misional']]['docente_orientador']= $element['docente_orientador'];
			$dato[$element['id_reporte_operativo_misional']]['nombre_actividad']= $element['nombre_actividad'];
			$dato[$element['id_reporte_operativo_misional']]['duracion_sesion']= $element['duracion_sesion'];
			$dato[$element['id_reporte_operativo_misional']]['logros']= $element['logros'];
			$dato[$element['id_reporte_operativo_misional']]['fortalezas']= $element['fortalezas'];
			$dato[$element['id_reporte_operativo_misional']]['debilidades']= $element['debilidades'];
			$dato[$element['id_reporte_operativo_misional']]['alternativas']= $element['alternativas'];
			$dato[$element['id_reporte_operativo_misional']]['retos']= $element['retos'];
			$dato[$element['id_reporte_operativo_misional']]['articulacion']= $element['articulacion'];
			$dato[$element['id_reporte_operativo_misional']]['evaluacion']= $element['evaluacion'];
			$dato[$element['id_reporte_operativo_misional']]['observaciones_generales']= $element['observaciones_generales'];
			$dato[$element['id_reporte_operativo_misional']]['alarmas']= $element['alarmas'];
			$dato[$element['id_reporte_operativo_misional']]['justificacion_activiad_no_realizada']= $element['justificacion_activiad_no_realizada'];
			$dato[$element['id_reporte_operativo_misional']]['fecha_reprogramacion']= $element['fecha_reprogramacion'];
			$dato[$element['id_reporte_operativo_misional']]['diligencia']= $element['diligencia'];
			$dato[$element['id_reporte_operativo_misional']]['rol']= $element['rol'];
			$dato[$element['id_reporte_operativo_misional']]['fecha_diligencia']= $element['alarmas'];
			$dato[$element['id_reporte_operativo_misional']]['estado']= $element['estado'];
			$dato[$element['id_reporte_operativo_misional']]['id_actividad']= $element['id_actividad'];

			return $dato;
		});
		
		//se formate la informacion que deben tener los campos 
		foreach	($result as $r => $valor)
			foreach	($valor as $ids => $valores)
				$datos['actividades'][$valores['id_actividad']] = $valores;
	
		$tipoCantidadPoblacion = new RomTipoCantidadPoblacionRom ();
		$tipoCantidadPoblacion = $tipoCantidadPoblacion->find()->orderby("id")->andWhere("id_reporte_operativo_misional = $id")->all();
	
		//se trae la informacionde la base de datos tabla ec.avances
		$result = ArrayHelper::getColumn($tipoCantidadPoblacion, function ($element) 
		{
			$dato[$element['id_reporte_operativo_misional']]['vecinos']= $element['vecinos'];
			$dato[$element['id_reporte_operativo_misional']]['lideres_comunitarios']= $element['lideres_comunitarios'];
			$dato[$element['id_reporte_operativo_misional']]['empresarios_comerciantes']= $element['empresarios_comerciantes'];
			$dato[$element['id_reporte_operativo_misional']]['organizaciones_locales']= $element['organizaciones_locales'];
			$dato[$element['id_reporte_operativo_misional']]['grupos_comunitarios']= $element['grupos_comunitarios'];
			$dato[$element['id_reporte_operativo_misional']]['otos_actores']= $element['otos_actores'];
			$dato[$element['id_reporte_operativo_misional']]['total_participantes']= $element['total_participantes'];
			$dato[$element['id_reporte_operativo_misional']]['id_actividades_rom']= $element['id_actividades_rom'];

			return $dato;
		});
	
		
		//se formate la informacion que deben tener los campos 
		foreach	($result as $r => $valor)
			foreach	($valor as $ids => $valores)
				$datos['tipoCantidadPoblacion'][$valores['id_actividades_rom']] = $valores;
		
		
        return $this->renderAjax('update', [
            'model' => $model,
			'sedes' => $sedes,
			'institucion'=> $this->obtenerInstitucion(),
			'datos' => $datos,
        ]);
    }

    /**
     * Deletes an existing RomReporteOperativoMisional model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * Finds the RomReporteOperativoMisional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RomReporteOperativoMisional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RomReporteOperativoMisional::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
