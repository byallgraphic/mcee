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
use app\models\ImplementacionIeo;
use app\models\CantidadPoblacionImpIeo;
use app\models\EvidenciasImpIeo;
use app\models\EstudiantesImpIeo;
use app\models\ProductoImplementacionIeo;
use app\models\Instituciones;
use app\models\ProductosImpIeo;
use app\models\ZonasEducativas;
use app\models\PerfilesXPersonasInstitucion;
use app\models\PerfilesXPersonas;
use app\models\Personas;
use app\models\ComunasCorregimientos;
use app\models\BarriosVeredas;
use app\models\Sedes;
use yii\base\Model;


use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;


/**
 * ImplementacionIeoController implements the CRUD actions for ImplementacionIeo model.
 */
class ImplementacionIeoController extends Controller
{

    public $tipo_informe;


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
     * Lists all ImplementacionIeo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {

        $query = ImplementacionIeo::find()->where(['estado' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' =>$query,
        ]);
        $_SESSION["tipo_informe"] = isset(($_GET['idTipoInforme'])) ? intval($_GET['idTipoInforme']) : $_SESSION["tipo_informe"]; 


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' 		=> $guardado,
        ]);

        
    }

    function actionViewFases($model, $form, $datos)
	{
       
        
        $actividades = [ 
            1 => 'Actividad 1. Socialización de plan de acción',
            2 => 'Actividad general. MCEE Encuentro',
            3 => 'Actividad 2. Mesa de trabajo',
            4 => 'Actividad 3. Acompañamiento a la práctica',
            5 => 'Actividad 4. Mesa de trabajo',
            6 => 'Actividad 5. Acompañamiento a la práctica',
            7 => 'Actividad Especial. Taller',
            8 => 'Actividad Especial.  Salida pedagógica',
            9 => 'Actividad 6. Mesa de Trabajo',
            10 => 'Actividad 7. Acompañamiento a la Práctica',
            11 => 'Actividad 8. Mesa de Trabajo',
            12 => 'Actividad 9.  Acompañamiento a la Práctica',
            13 => 'Actividad Especial. Taller',
            14 => 'Actividad Especial.  Salida pedagógica',
            15 => 'Actividad 10. Mesa de trabajo',
            16 => 'Actividad general. MCEE Encuentro',
            17 => 'Productos'
        ];

        $tiposCantidadPoblacion = new CantidadPoblacionImpIeo();
        $estudiantesGrado = new EstudiantesImpIeo();
        $evidencias = new EvidenciasImpIeo();
        $producto = new ProductoImplementacionIeo();
        
        $colors = ["#cce5ff", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff", "#d6d8d9", "#d4edda", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff", "#f8d7da", "#fff3cd", "#d1ecf1", "#d6d8d9", "#cce5ff"];

        foreach ($actividades as $numActividad => $titulo)
		{
                
                $contenedores[] = [
                    'label' 	=>  $titulo,
                    'content' 	=> $this->renderPartial( 'actividades', 
                                        [  
                                            'form' => $form,
                                            'numActividad' => $numActividad,
                                            'model' =>$model,
                                            'tiposCantidadPoblacion' =>  $tiposCantidadPoblacion,
                                            'estudiantesGrado' => $estudiantesGrado,
                                            'producto' => $producto,
                                            'evidencias' => $evidencias,
                                            'datos' => $datos
                                        ] 
                                        ),
                    'headerOptions' => ['class' => 'tab1', 'style' => "background-color: $colors[$numActividad];"],
                ];
        }

        /*echo Collapse::widget([
            'items' => $contenedores,
        ]);*/

        echo Tabs::widget([
            'items' => $contenedores,
        ]);

    }

    /**
     * Displays a single ImplementacionIeo model.
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

	public function obtenerZonaEducativa()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$idZonaEducativa = Instituciones::findOne( $idInstitucion )->id_zona_educativa;
		$zonaEducativa  = ZonasEducativas::find()->where(" estado=1 and id = $idZonaEducativa " )->all();
        $zonaEducativa  = ArrayHelper::map( $zonaEducativa, 'id', 'descripcion' );
		
		return $zonaEducativa;
	}
	
    /**
     * Creates a new ImplementacionIeo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $ieo_model = new ImplementacionIeo();
        $idInstitucion = $_SESSION['instituciones'][0];
       
       
        if ($ieo_model->load(Yii::$app->request->post())) 
		{
			$ieo_model->estado =1;
			echo "<pre>"; print_r(Yii::$app->request->post()); echo "</pre>"; 
			die;
            if($ieo_model->save())
			{
                $ieo_id = $ieo_model->id;

                if($arrayDatosEvidencias = Yii::$app->request->post('EvidenciasImpIeo'))
				{
					$modelEvidencias = [];

					foreach ($arrayDatosEvidencias as $key => $valor)	
						$modelEvidencias[$key] = new EvidenciasImpIeo();

					
					if (EvidenciasImpIeo::loadMultiple($modelEvidencias, Yii::$app->request->post() )) 
					{
						
						$idInstitucion 	= $_SESSION['instituciones'][0];
						$institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

						$carpeta = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion;
						if (!file_exists($carpeta)) 
						{
							mkdir($carpeta, 0777, true);
						}
						
						$propiedades = array( "producto_acuerdo", "resultado_actividad", "acta", "listado", "fotografias", "avance_formula", "avance_ruta_gestion");
						$propiedadUso = array();
						foreach( $modelEvidencias as $key => $model) 
						{
							// $key +=1;
							
							//recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
							//para posteriormente guardar en la base de datos
							foreach($propiedades as $llave => $propiedad)
							{
								
								$arrayRutasFisicas = array();
								// se guarda el archivo en file
								
								// se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
								$files = UploadedFile::getInstances( $model, "[$key]$propiedad" );
								
								//si no se agrega ninguna archivo al campo se pone como NULL 
								if(count($files) == 0)
								{
									$model->$propiedad = NULL;
								}
										
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
										$rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
										$save = $file->saveAs( $rutaFisicaDirectoriaUploads );
									
										//rutas de todos los archivos
										$arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
										//array con las propiedades que tienen archivos para subir
										$propiedadUso[$llave] =  $propiedad;
									}
									
									// asignacion de la ruta al campo de la db
									$model->$propiedad = implode(",", $arrayRutasFisicas);
									
									
									// $model->$propiedad =  $var;
									$arrayRutasFisicas = null;
								}
								else
								{
									// echo "No hay archivo cargado";
								}
                            }
							
										
                            $model->implementacion_ieo_id = $ieo_id;
                            $model->id_actividad = $key;
							
							$model->save();
							
                        
                        }

                    }

                }
				
				
					if($arrayDatosProductos = Yii::$app->request->post('ProductoImplementacionIeo'))
					{
						
						$modelProductos = [];

						// for( $i = 0; $i < count(Yii::$app->request->post()); $i++ ){
							$modelProductos[1] = new ProductoImplementacionIeo();
						// }

					   
						if (ProductoImplementacionIeo::loadMultiple($modelProductos, Yii::$app->request->post() ) ) 
						{
						   
							$idInstitucion 	= $_SESSION['instituciones'][0];
							$institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;

							$carpeta = "../documentos/documentosIeo/actividades/productosImlementacionIeo/".$institucion;
							if (!file_exists($carpeta)) 
							{
								mkdir($carpeta, 0777, true);
							}

							$propiedades = array( "informe_acompanamiento", "trazabilidad_plan_accion", "formulacion", "ruta_gestion", "resultados_procesos");
							
							foreach( $modelProductos as $key => $model) 
							{
								
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
											$rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/actividades/productosImlementacionIeo/".$institucion."/".$file->baseName . $d->format("Y_m_d_H_i_s.u") . '.' . $file->extension;
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
							$model->implementacion_ieo_id = $ieo_id;
							$model->estado = 1;

							foreach( $modelProductos as $key => $model) 
							{
								if($model->informe_acompanamiento){

									$model->save();
								}								
							}
						}
					}
				}

				if (Yii::$app->request->post('CantidadPoblacionImpIeo'))
				{
					$data = Yii::$app->request->post('CantidadPoblacionImpIeo');
					$count 	= count( $data );
					$modelCantidadPoblacion = [];
		
				
						foreach($data as $key => $valor  )
							$modelCantidadPoblacion[$key] = new CantidadPoblacionImpIeo();
					
		
					if (CantidadPoblacionImpIeo::loadMultiple($modelCantidadPoblacion, Yii::$app->request->post() )) 
					{
						foreach( $modelCantidadPoblacion as $key => $model) 
						{
							$model->implementacion_ieo_id = $ieo_id;                                                  
							$model->save(false);
						}
					}
					
				}
				
				if(Yii::$app->request->post('EstudiantesImpIeo'))
				{
					
					$dataEstudiantes = Yii::$app->request->post('EstudiantesImpIeo');
					
					$countEstudiantes 	= count( $dataEstudiantes );
					$modelEstudiantesIeo = [];
					
					for( $i = 1; $i <= $countEstudiantes-1; $i++ )
					{
						$modelEstudiantesIeo[$i] = new EstudiantesImpIeo();
					}
					if (EstudiantesImpIeo::loadMultiple($modelEstudiantesIeo, Yii::$app->request->post() )) 
					{
					
						foreach( $modelEstudiantesIeo as $key1 => $modelEstudiantes) 
						{
							
							$modelEstudiantes->id_implementacion_ieo = $ieo_id;
							$modelEstudiantes->id_actividad = $key1;
							$modelEstudiantes->save(false);
								
						}
					}
				}
				// die;
				
				
				
				
                return $this->redirect(['index', 'guardado' => true ]);
			
			}//fin update post
        }
            
            
        

        $idPerfilesXpersonas	= PerfilesXPersonasInstitucion::find()->where( "id_institucion = $idInstitucion" )->all();
		$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
        $nombres1 				= Personas::find($perfiles_x_persona)->all();
        $nombres				 = ArrayHelper::map( $nombres1, 'id', 'nombres');
     

        $comunas  = ComunasCorregimientos::find()->where( 'estado=1' )->all();
        $comunas	 = ArrayHelper::map( $comunas, 'id', 'descripcion' );
        
        return $this->renderAjax('create', [
            'model' => $ieo_model,
            'zonasEducativas' => $this->obtenerZonaEducativa(),
            "nombres" => $nombres,
            'comunas' => $comunas,
			'institucion'=>$this->obtenerInstitucion(),
			'sede'=>$this->obtenerSede(),
            
        ]);
    }


    public function actionLists($id)
    {
        
        $countBarrios = BarriosVeredas::find()
                ->where(['id_comunas_corregimientos' => $id, 'estado'  => '1'])
                ->count();

        $barrios = BarriosVeredas::find()
                ->where(['id_comunas_corregimientos' => $id, 'estado'  => '1'])
                ->orderBy('id DESC')
                ->all();

        if($countBarrios>0){
            foreach($barrios as $barrio){
                echo "<option value='".$barrio->id."'>".$barrio->descripcion."</option>";
            }
        }
        else
		{
            // echo "<option>-</option>";
        }
        
        //echo "<option>-</option>";

    }

    /**
     * Updates an existing ImplementacionIeo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			$connection = Yii::$app->getDb();
			if ($cantidadPoblacion = Yii::$app->request->post('CantidadPoblacionImpIeo') )
			{
					
				foreach($cantidadPoblacion as $idActividad => $valores)
				{
					
					//se envia null cuando el campo no esta en la base de datos
					$tiempo_libre	=  isset($valores['tiempo_libre']) ? $valores['tiempo_libre']: 'null' ;
					$edu_derechos 	=  isset($valores['edu_derechos']) ? $valores['edu_derechos']: 'null' ;
					$sexualidad 	=  isset($valores['sexualidad']) ? $valores['sexualidad']: 'null' ;
					$ciudadania 	=  isset($valores['ciudadania']) ? $valores['ciudadania']: 'null' ;
					$medio_ambiente	=  isset($valores['medio_ambiente']) ? $valores['medio_ambiente']: 'null' ;
					$familia 		=  isset($valores['familia']) ? $valores['familia']: 'null' ;
					$directivos 	=  isset($valores['directivos']) ? $valores['directivos']: 'null' ;
					$fecha_creacion =  isset($valores['fecha_creacion']) ? $valores['fecha_creacion']: 'null' ;
					$tipo_actividad =  isset($valores['tipo_actividad']) ? $valores['tipo_actividad']: 'null' ;
					
					$command = $connection->createCommand
					(" 
						UPDATE 
							ec.cantidad_poblacion_imp_ieo
						SET 
						
							tiempo_libre	='". $valores['tiempo_libre']."',
							edu_derechos	='". $valores['edu_derechos']."',
							sexualidad		='". $valores['sexualidad']."',
							ciudadania		='". $valores['ciudadania']."',
							medio_ambiente	='". $valores['medio_ambiente']."',
							familia			='". $valores['familia']."',
							directivos		='". $valores['directivos']."',
							fecha_creacion	='". $valores['fecha_creacion']."',
							tipo_actividad	= $tipo_actividad
						WHERE 
							implementacion_ieo_id = $id
						AND
							id_actividad = $idActividad
							
					");
					$result = $command->queryAll();
				}
				
			}
			
			if ($estudiantes = Yii::$app->request->post('EstudiantesImpIeo') )
			{
					
				array_pop($estudiantes);
				foreach($estudiantes as $idActividad => $value)
				{
					//se envia null cuando el campo no esta en la base de datos
					$grado_0	=  isset($value['grado_0']) ? $value['grado_0']: 'null' ;
					$grado_1 	=  isset($value['grado_1']) ? $value['grado_1']: 'null' ;
					$grado_2 	=  isset($value['grado_2']) ? $value['grado_2']: 'null' ;
					$grado_3 	=  isset($value['grado_3']) ? $value['grado_3']: 'null' ;
					$grado_4	=  isset($value['grado_4']) ? $value['grado_4']: 'null' ;
					$grado_5 	=  isset($value['grado_4']) ? $value['grado_4']: 'null' ;
					$grado_6 	=  isset($value['grado_4']) ? $value['grado_4']: 'null' ;
					$grado_7 	=  isset($value['grado_4']) ? $value['grado_4']: 'null' ;
					$grado_8 	=  isset($value['grado_4']) ? $value['grado_4']: 'null' ;
					$grado_9 	=  isset($value['grado_4']) ? $value['grado_4']: 'null' ;
					$grado_10 	=  isset($value['grado_4']) ? $value['grado_4']: 'null' ;
					$grado_11 	=  isset($value['grado_4']) ? $value['grado_4']: 'null' ;
					
						
					$command = $connection->createCommand
					(" 
						UPDATE 
							ec.estudiantes_imp_ieo
						SET 
							grado_0 =	$grado_0,
							grado_1 =	$grado_1,
							grado_2 =	$grado_2,
							grado_3 =	$grado_3,
							grado_4 =	$grado_4,
							grado_5 =	$grado_5,
							grado_6 =	$grado_6,
							grado_7 =	$grado_7,
							grado_8 =	$grado_8,
							grado_9 =	$grado_9,
							grado_10 =	$grado_10,
							grado_11 =	$grado_11
							
						WHERE 
							id_implementacion_ieo = $id
						AND
							id_actividad = $idActividad
							
					");
					$result = $command->queryAll();
				}
			}
			
			
			/**Carga de archivos multiples evidencias -> actividades */ 
                if($arrayDatosEvidencias = Yii::$app->request->post('EvidenciasImpIeo'))
				{
					
                    $modelEvidencias = [];
					
					foreach ($arrayDatosEvidencias as $llave => $valor)
					{
						 $modelEvidencias[$llave] = new EvidenciasImpIeo();
					}
                       
                    if (EvidenciasImpIeo::loadMultiple($modelEvidencias, Yii::$app->request->post() )) 
					{	
						$connection = Yii::$app->getDb();
						$command = $connection->createCommand("
							SELECT   
								producto_acuerdo, 
								resultado_actividad,
								acta, 
								listado,
								fotografias, 
								avance_formula,
								avance_ruta_gestion
							FROM 
								ec.evidencias_imp_ieo
							WHERE 
								implementacion_ieo_id = $id
							ORDER BY id
						");
						$resul = $command->queryAll();
						
                        $idInstitucion 	= $_SESSION['instituciones'][0];
                        $institucion = Instituciones::findOne( $idInstitucion )->codigo_dane;
						
						foreach  ($resul as $r )
						{
							$producto_acuerdo[]				= $r['producto_acuerdo'];
							$resultado_actividad[] 			= $r['resultado_actividad'];
							$acta[] 						= $r['acta'];
							$listado[]						= $r['listado'];
							$fotografias[]					= $r['fotografias'];
							$avance_formula[]				= $r['avance_formula'];
							$avance_ruta_gestion[]			= $r['avance_ruta_gestion'];
						}
						
                        $propiedades = array( "producto_acuerdo", "resultado_actividad", "acta", "listado", "fotografias","avance_formula","avance_ruta_gestion");
                        $llave =0;
                        foreach( $modelEvidencias as $key => $model1) 
                        {
                            //recorre el array $propiedades, para subir los archivos y asigarles las rutas de las ubicaciones de los arhivos en el servidor
                            //para posteriormente guardar en la base de datos
                            foreach($propiedades as $propiedad)
                            {
                                $arrayRutasFisicas = array();
                                // se guarda el archivo en file
                                // se obtiene la informacion del(los) archivo(s) nombre, tipo, etc.
                                $files = UploadedFile::getInstances( $model1, "[$key]$propiedad" );
                                if( $files )
                                {
									$arrayRuta = explode(",",$$propiedad[$llave]);
									
                                    //se suben todos los archivos uno por uno
                                    foreach($files as $file)
                                    {
                                        //se usan microsegundos para evitar un nombre de archivo repetido
										// Construyo la ruta completa del archivo a guardar
                                        $rutaFisicaDirectoriaUploads  = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion."/".$file->baseName . $this->microSegundos() . '.' . $file->extension;
										
										//saber si el archivo ya existe
										$nombreArchivo = $file->name;
										$extensionArchivo =  pathinfo($nombreArchivo, PATHINFO_EXTENSION );
										$nombre_base = basename($nombreArchivo, '.'.$extensionArchivo);
										
										//la extencion debe estar en minuisculas para la combrobacion
										$extensionArchivo = strtolower($extensionArchivo);
										
										//se pasan las rutas que estan en la db en el campo $$propiedad[$llave] para saber en que parte esta el archivo y sobreescribirlo
										//saber si el nombre y la extencion del archivo ya existe en la base de datos / saber si ya existe el archivo se y se sobreescribe sin cambios en la db
										if (substr ($$propiedad[$llave],strpos ($$propiedad[$llave],$nombre_base),strlen ($nombre_base)) == $nombre_base & substr ($$propiedad[$llave],strpos ($$propiedad[$llave],$nombre_base) + strlen ($nombre_base)+ 27,strlen($extensionArchivo) )  == $extensionArchivo  )
										{
											//si archivo ya existe se sobreescribe sobreescribiendo la ruta de guardado
											// Construyo la ruta completa del archivo a guardar
											foreach ($arrayRuta as $ar)
											{
												if (substr ($ar,strpos ($ar,$nombre_base),strlen ($nombre_base)) == $nombre_base & substr ($ar,strpos ($ar,$nombre_base) + strlen ($nombre_base)+ 27,strlen($extensionArchivo) )  == $extensionArchivo  )												
												{
													$rutaFisicaDirectoriaUploads  = $ar;
													// $arrayRutasFisicas[] = $ar;
												}
											}
										}
										else // si no cumple el if debe ser un archivo nuevo
										{
											$arrayRutasFisicas[] = $rutaFisicaDirectoriaUploads;
										}
										//guardar el archivo fisicamente en el servidor
                                        $save = $file->saveAs( $rutaFisicaDirectoriaUploads );
                                        //rutas de todos los archivos
                                    }
									$arrayRutasFisicas[]= $$propiedad[$llave];
									$command = $connection->createCommand("
									UPDATE ec.evidencias_imp_ieo
									set $propiedad = '".implode(",", $arrayRutasFisicas)."'
									WHERE 
										implementacion_ieo_id = $id
									AND
										id_actividad = $key
									");
									$resul = $command->queryAll();
									$arrayRutasFisicas = null;
									
                                }
                                else
                                {
                                    // echo "No hay archivo cargado";
                                }
                            }
							$llave++;
                        }
                    }
                }
			
			
			die;
			return $this->redirect(['index','idTipoInforme' => $model->id_tipo_informe]);
        }
		
		$idInstitucion 	= $_SESSION['instituciones'][0];
		$cantidaPoblacion = new CantidadPoblacionImpIeo();
		$cantidaPoblacion = $cantidaPoblacion->find()->orderby("id")->andWhere("implementacion_ieo_id = $id")->all();

		
		$result = ArrayHelper::getColumn($cantidaPoblacion, function ($element) 
        {
            $dato[$element['id_actividad']]['tiempo_libre']= $element['tiempo_libre'];
            $dato[$element['id_actividad']]['tipo_actividad']= $element['tipo_actividad'];
            $dato[$element['id_actividad']]['edu_derechos']= $element['edu_derechos'];
            $dato[$element['id_actividad']]['sexualidad']= $element['sexualidad'];
            $dato[$element['id_actividad']]['ciudadania']= $element['ciudadania'];
            $dato[$element['id_actividad']]['medio_ambiente']= $element['medio_ambiente'];
            $dato[$element['id_actividad']]['directivos']= $element['directivos'];
            $dato[$element['id_actividad']]['familia']= $element['familia'];

            return $dato;
        });
		
		
        foreach	($result as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
                
                $datos[$ids] = $valores;
        }
		 
		$estudiantesImp = new EstudiantesImpIeo();
		$estudiantesImp = $estudiantesImp->find()->orderby("id")->andWhere("id_implementacion_ieo = $id")->all();
        $result1 = ArrayHelper::getColumn($estudiantesImp, function ($element) 
        {
            
            $dato[$element['id_actividad']]['grado_0']= $element['grado_0'];
            $dato[$element['id_actividad']]['grado_1']= $element['grado_1'];
            $dato[$element['id_actividad']]['grado_2']= $element['grado_2'];
            $dato[$element['id_actividad']]['grado_3']= $element['grado_3'];
            $dato[$element['id_actividad']]['grado_4']= $element['grado_4'];
            $dato[$element['id_actividad']]['grado_5']= $element['grado_5'];
            $dato[$element['id_actividad']]['grado_6']= $element['grado_6'];
            $dato[$element['id_actividad']]['grado_7']= $element['grado_7'];
            $dato[$element['id_actividad']]['grado_8']= $element['grado_8'];
            $dato[$element['id_actividad']]['grado_9']= $element['grado_9'];
            $dato[$element['id_actividad']]['grado_10']= $element['grado_10'];
            $dato[$element['id_actividad']]['grado_11']= $element['grado_11'];

            return $dato;
        });

		
	
        foreach	($result1 as $r => $valor)
        {
            foreach	($valor as $ids => $valores)
			{
				$datos1[$ids] = $valores;
				
			}
        }
		
		foreach($datos1 as $key => $value)
		{
			$merge[$key] = @array_merge($datos[$key],$datos1[$key]);
		}
		
	
		$comunas  = ComunasCorregimientos::find()->where( 'estado=1' )->all();
        $comunas	 = ArrayHelper::map( $comunas, 'id', 'descripcion' );
		
		$idPerfilesXpersonas	= PerfilesXPersonasInstitucion::find()->where( "id_institucion = $idInstitucion" )->all();
		$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
        $nombres1 				= Personas::find($perfiles_x_persona)->all();
        $nombres				 = ArrayHelper::map( $nombres1, 'id', 'nombres');
		
		
        return $this->renderAjax('update', [
            'model' => $model,
            'zonasEducativas' =>  $this->obtenerZonaEducativa(),
            'datos'=> $merge,
			'institucion'=>$this->obtenerInstitucion(),
			'sede'=>$this->obtenerSede(),
			'comunas' => $comunas,
			'nombres' => $nombres,
			
        ]);
    }

	
	public function microSegundos()
	{
	
		$t = microtime(true);
		$micro = sprintf("%06d",($t - floor($t)) * 1000000);
		$d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
		
		return $d->format("Y_m_d_H_i_s.u");
	}
	
	public function obtenerInstitucion()
	{
		$idInstitucion = $_SESSION['instituciones'][0];
		$instituciones = new Instituciones();
		$instituciones = $instituciones->find()->where("id = $idInstitucion")->all();
		$instituciones = ArrayHelper::map($instituciones,'id','descripcion');
		
		return $instituciones;
	}
	
	public function obtenerSede()
	{
		$idSedes 		= $_SESSION['sede'][0];
		$sedes = new Sedes();
		$sedes = $sedes->find()->where("id =  $idSedes")->all();
		$sedes = ArrayHelper::map($sedes,'id','descripcion');
		
		return $sedes;
	}
	
    /**
     * Deletes an existing ImplementacionIeo model.
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

        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ImplementacionIeo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImplementacionIeo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImplementacionIeo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

