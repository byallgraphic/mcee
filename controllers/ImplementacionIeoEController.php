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
use app\models\ImplementacionIeoE;
use app\models\CantidadPoblacionImpIeo;
use app\models\EvidenciasImpIeo;
use app\models\EstudiantesImpIeo;
use app\models\ProductoImplementacionIeo;
use app\models\Instituciones;
use app\models\ProductosImpIeo;



use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Collapse;


/**
 * ImplementacionIeoController implements the CRUD actions for ImplementacionIeo model.
 */
class ImplementacionIeoEController extends Controller
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
     * Lists all ImplementacionIeo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ImplementacionIeoE::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' 		=> $guardado,
        ]);
    }

    function actionViewFases($model, $form){
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

        foreach ($actividades as $actividad => $a)
		{
                
                $contenedores[] = [
                    'label' 	=>  $a,
                    'content' 	=> $this->renderPartial( 'actividades', 
                                        [  
                                            'form' => $form,
                                            'numActividad' => $actividad,
                                            'model' =>$model,
                                            'tiposCantidadPoblacion' =>  $tiposCantidadPoblacion,
                                            'estudiantesGrado' => $estudiantesGrado,
                                        ] 
                                    )
                ];
        }

        echo Collapse::widget([
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

    /**
     * Creates a new ImplementacionIeo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $ieo_model = new ImplementacionIeoE();
        $idInstitucion = $_SESSION['instituciones'][0];
        $institucion = Instituciones::findOne( $idInstitucion );
        $ieo_id = 0;
        $status = false;

        if ($ieo_model->load(Yii::$app->request->post())) {

            $ieo_model->institucion_id = $idInstitucion;
            $ieo_model->estado = 1;
            $ieo_model->sede_id = 2;
                       
            if($ieo_model->save()){
                $ieo_id = $ieo_model->id;

                $data = Yii::$app->request->post('ImplementacionIeo');
                $count 	= count( $data );
                $models = [];
                $modelEvidencias = [];
                $modelProductos = [];
                $countEvidencias = 0;
                $countProductos = 0;

                for( $i = 0; $i < $count; $i++ ){
                    $models[] = new ImplementacionIeo();
                }

                if (ImplementacionIeo::loadMultiple($models, Yii::$app->request->post() )) {

                    foreach( $models as $key => $model) {
                        //Generación de instancias de los documentos Actividades Evidencias
                        $producto_acuerdo = UploadedFile::getInstance( $model, "[$key]producto_acuerdo" );
                        $resultado_actividad = UploadedFile::getInstance( $model, "[$key]resultado_actividad" );
                        $acta = UploadedFile::getInstance( $model, "[$key]acta" );
                        $listado = UploadedFile::getInstance( $model, "[$key]listado" );
                        $fotografias = UploadedFile::getInstance( $model, "[$key]fotografias" );
                        $avance_formula = UploadedFile::getInstance( $model, "[$key]avance_formula" );
                        $avance_ruta_gestion = UploadedFile::getInstance( $model, "[$key]avance_ruta_gestion" );

                        //Generación de instancias de los documentos Productos
                        $producto_informe_acompañamiento = UploadedFile::getInstance( $model, "[$key]producto_informe_acompañamiento" );
                        $producto_trazabilidad = UploadedFile::getInstance( $model, "[$key]producto_trazabilidad" );
                        $producto_formnulacion_sistemactizacion = UploadedFile::getInstance( $model, "[$key]producto_formnulacion_sistemactizacion" );
                        $producto_ruta_gestion = UploadedFile::getInstance( $model, "[$key]producto_ruta_gestion" );
                        $producto_presentacion_resultados = UploadedFile::getInstance( $model, "[$key]producto_presentacion_resultados" );



                        $saveAvemceFormula = "";
                        $saveAvanceRutaGestion = "";

                        //Validación para el registro de documentos Actividades Evidencias
                        if( $producto_acuerdo && $resultado_actividad && $acta && $listado && $fotografias){
                                                       
                            $modelEvidencias [] = new EvidenciasImpIeo();
                            //Se crea carpeta para almecenar los documentos de Socializacion
                            $carpetaEvidencias = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion->codigo_dane;
                            if (!file_exists($carpetaEvidencias)) {
                                mkdir($carpetaEvidencias, 0777, true);
                            }

                            $base = "../documentos/documentosIeo/actividades/evidenciasImlementacionIeo/".$institucion->codigo_dane."/";
                          
                            $rutaFisicaDirectoriaUploadProducto = $base.$producto_acuerdo->baseName;
                            $rutaFisicaDirectoriaUploadProducto .= date( "_Y_m_d_His" ) . '.' . $producto_acuerdo->extension;
                            $saveProducto = $producto_acuerdo->saveAs( $rutaFisicaDirectoriaUploadProducto );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                            
                            $rutaFisicaDirectoriaUploadResultadoActividad = $base.$resultado_actividad->baseName;
                            $rutaFisicaDirectoriaUploadResultadoActividad .= date( "_Y_m_d_His" ) . '.' . $resultado_actividad->extension;
                            $saveResultadoActividad = $resultado_actividad->saveAs( $rutaFisicaDirectoriaUploadResultadoActividad );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                            
                            $rutaFisicaDirectoriaUploadActa = $base.$acta->baseName;
                            $rutaFisicaDirectoriaUploadActa .= date( "_Y_m_d_His" ) . '.' . $acta->extension;
                            $saveActa = $acta->saveAs( $rutaFisicaDirectoriaUploadActa );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                             
                            $rutaFisicaDirectoriaUploadListado = $base.$listado->baseName;
                            $rutaFisicaDirectoriaUploadListado .= date( "_Y_m_d_His" ) . '.' . $listado->extension;
                            $saveListado = $listado->saveAs( $rutaFisicaDirectoriaUploadListado );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                            $rutaFisicaDirectoriaUploadFotografia = $base.$fotografias->baseName;
                            $rutaFisicaDirectoriaUploadFotografia .= date( "_Y_m_d_His" ) . '.' . $fotografias->extension;
                            $saveFotografia = $fotografias->saveAs( $rutaFisicaDirectoriaUploadFotografia );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                             
                            if($avance_formula && $avance_ruta_gestion){
                                $rutaFisicaDirectoriaUploadAvemceFormula = $base.$avance_formula->baseName;
                                $rutaFisicaDirectoriaUploadAvemceFormula .= date( "_Y_m_d_His" ) . '.' . $avance_formula->extension;
                                $saveAvemceFormula = $avance_formula->saveAs( $rutaFisicaDirectoriaUploadAvemceFormula );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.

                                $rutaFisicaDirectoriaUploadAvanceRutaGestion = $base.$avance_ruta_gestion->baseName;
                                $rutaFisicaDirectoriaUploadAvanceRutaGestion .= date( "_Y_m_d_His" ) . '.' . $avance_ruta_gestion->extension;
                                $saveAvanceRutaGestion = $avance_ruta_gestion->saveAs( $rutaFisicaDirectoriaUploadAvanceRutaGestion );//$file->baseName puede ser cambiado por el nombre que quieran darle al archivo en el servidor.
                            }


                            if( $saveProducto && $saveResultadoActividad && $saveActa && $saveListado && $saveFotografia){ 
                                //Le asigno la ruta al arhvio
                                $modelEvidencias[$countEvidencias]->implementacion_ieo_id = $ieo_id;
                                $modelEvidencias[$countEvidencias]->producto_acuerdo = $rutaFisicaDirectoriaUploadProducto;
                                $modelEvidencias[$countEvidencias]->resultado_actividad = $rutaFisicaDirectoriaUploadResultadoActividad;
                                $modelEvidencias[$countEvidencias]->acta = $rutaFisicaDirectoriaUploadActa;
                                $modelEvidencias[$countEvidencias]->listado = $rutaFisicaDirectoriaUploadListado;
                                $modelEvidencias[$countEvidencias]->fotografias = $rutaFisicaDirectoriaUploadFotografia;

                                if($saveAvemceFormula && $saveAvanceRutaGestion){
                                    $modelEvidencias[$countEvidencias]->avance_formula = $rutaFisicaDirectoriaUploadAvemceFormula;
                                    $modelEvidencias[$countEvidencias]->avance_ruta_gestion = $rutaFisicaDirectoriaUploadAvanceRutaGestion;                           
                                }


                            }else{
                                echo $file->error;
                                exit("finnn....");
                            }
                            $countEvidencias++;
                        }

                        //Validación para el registro de documentos Producto
                        if($producto_informe_acompañamiento && $producto_trazabilidad && $producto_formnulacion_sistemactizacion && $producto_ruta_gestion && $producto_presentacion_resultados){
                           
                            $modelProductos [] = new ProductosImpIeo();
                            
                            $carpetaEvidencias = "../documentos/documentosIeo/actividades/productosImlementacionIeo/".$institucion->codigo_dane;
                            if (!file_exists($carpetaEvidencias)) {
                                mkdir($carpetaEvidencias, 0777, true);
                            }

                            $base = "../documentos/documentosIeo/actividades/productosImlementacionIeo/".$institucion->codigo_dane."/";

                            $rutaFisicaDirectoriaUploadProductoAcompañamiento = $base.$producto_informe_acompañamiento->baseName;
                            $rutaFisicaDirectoriaUploadProductoAcompañamiento .= date( "_Y_m_d_His" ) . '.' . $producto_informe_acompañamiento->extension;
                            $saveProductoAcompañamiento = $producto_informe_acompañamiento->saveAs( $rutaFisicaDirectoriaUploadProductoAcompañamiento );

                            $rutaFisicaDirectoriaUploadProductoTrazabilidad = $base.$producto_trazabilidad->baseName;
                            $rutaFisicaDirectoriaUploadProductoTrazabilidad .= date( "_Y_m_d_His" ) . '.' . $producto_trazabilidad->extension;
                            $saveProductoTrazabilidad = $producto_trazabilidad->saveAs( $rutaFisicaDirectoriaUploadProductoTrazabilidad );

                            $rutaFisicaDirectoriaUploadProductoformulacionSistematizacion = $base.$producto_formnulacion_sistemactizacion->baseName;
                            $rutaFisicaDirectoriaUploadProductoformulacionSistematizacion .= date( "_Y_m_d_His" ) . '.' . $producto_formnulacion_sistemactizacion->extension;
                            $saveProductoFormulacionSistematizacion = $producto_formnulacion_sistemactizacion->saveAs( $rutaFisicaDirectoriaUploadProductoformulacionSistematizacion );

                            $rutaFisicaDirectoriaUploadProductoRutaGestion = $base.$producto_ruta_gestion->baseName;
                            $rutaFisicaDirectoriaUploadProductoRutaGestion .= date( "_Y_m_d_His" ) . '.' . $producto_ruta_gestion->extension;
                            $saveProductoRutaGestion = $producto_ruta_gestion->saveAs( $rutaFisicaDirectoriaUploadProductoRutaGestion );

                            $rutaFisicaDirectoriaUploadProductoPresentacionResultado = $base.$producto_presentacion_resultados->baseName;
                            $rutaFisicaDirectoriaUploadProductoPresentacionResultado .= date( "_Y_m_d_His" ) . '.' . $producto_presentacion_resultados->extension;
                            $saveProductoPresentacionResultado = $producto_presentacion_resultados->saveAs( $rutaFisicaDirectoriaUploadProductoPresentacionResultado );

                            if( $saveProductoAcompañamiento && $saveProductoTrazabilidad && $saveProductoFormulacionSistematizacion && $saveProductoRutaGestion && $saveProductoPresentacionResultado){

                                $modelProductos[$countProductos]->implementacion_ieo_id = $ieo_id;
                                $modelProductos[$countProductos]->informe_acompañamiento = $rutaFisicaDirectoriaUploadProductoAcompañamiento;
                                $modelProductos[$countProductos]->trazabilidad = $rutaFisicaDirectoriaUploadProductoTrazabilidad;
                                $modelProductos[$countProductos]->formnulacion_sistemactizacion = $rutaFisicaDirectoriaUploadProductoformulacionSistematizacion;
                                $modelProductos[$countProductos]->ruta_gestion = $rutaFisicaDirectoriaUploadProductoRutaGestion;
                                $modelProductos[$countProductos]->presentacion_resultados = $rutaFisicaDirectoriaUploadProductoPresentacionResultado;
                            }else{
                                echo $file->error;
                                exit("finnn....");
                            }
                            $countProductos++;
                        }

                    }

                    foreach( $modelEvidencias as $key => $model) {
                        if(!$model->save()){
                            exit( "Error al guardar documentos Evidencias" );
                        }
                    }

                    foreach( $modelProductos as $key => $model) {
                        if(!$model->save()){
                            
                            exit( "Error al guardar documentos Productos" );
                        }
                    }


                }

                if (Yii::$app->request->post('CantidadPoblacionImpIeo')){
                    $data = Yii::$app->request->post('CantidadPoblacionImpIeo');
                    $count 	= count( $data );
                    $modelCantidadPoblacion = [];
        
                    for( $i = 0; $i < $count; $i++ ){
                        $modelCantidadPoblacion[] = new CantidadPoblacionImpIeo();
                    }
        
                    if (CantidadPoblacionImpIeo::loadMultiple($modelCantidadPoblacion, Yii::$app->request->post() )) {
                        foreach( $modelCantidadPoblacion as $key => $model) {
                           
                            if($model->tiempo_libre){
                                $model->implementacion_ieo_id = $ieo_id;                                                  
                                
                                if($model->save() && Yii::$app->request->post('EstudiantesImpIeo')){
                                    $status = true;
                                    $dataEstudiantes = Yii::$app->request->post('EstudiantesImpIeo');
                                    
                                    $countEstudiantes 	= count( $dataEstudiantes );
                                    $modelEstudiantesIeo = [];
                                    
                                    for( $i = 0; $i < $countEstudiantes; $i++ ){
                                        $modelEstudiantesIeo[] = new EstudiantesImpIeo();
                                    }


                                    if (EstudiantesImpIeo::loadMultiple($modelEstudiantesIeo, Yii::$app->request->post() )) {
                                        foreach( $modelEstudiantesIeo as $key => $modelEstudiantes) {
                                                if($modelEstudiantes->grado_0){
                                                    $modelEstudiantes->cantidad_poblacion_imp_ieo_id = $model->id;
                                                    
                                                    if(!$modelEstudiantes->save()){
                                                        $status = false;
                                                    }
                                                    
                                                    //break;
                                                }
                                                
                                            }
                                    }
                                }
                            }
                        }
                    }
                    
                }
            }
            return $this->redirect(['index', 'guardado' => true ]);
            
        }


     

        return $this->renderAjax('create', [
            'model' => $ieo_model,
            
        ]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

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
        if (($model = ImplementacionIeoE::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
