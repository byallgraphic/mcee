<?php
/**********
Versión: 001
Fecha: Fecha en formato (30-08-2018)
Desarrollador: Viviana Rodas
Descripción: diario de campo semilleros tic
---------------------------------------------------
Modificaciones
Fecha: Fecha en formato (30-08-2018)
Desarrollador: Edwin Molina G
Descripción: Por cada Sesión realizada en la ejecución de fase se muestra una descripción y fase a llenar
******************/

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
use app\models\SemillerosTicDiarioDeCampoEstudiantes;
use app\models\SemillerosTicDiarioDeCampoEstudiantesBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\SemillerosTicFases;
use app\models\SemillerosTicCiclos;
use app\models\SemillerosTicAnio;
use yii\helpers\ArrayHelper;
use app\models\Parametro;
use app\models\DatosIeoProfesional;
use app\models\EjecucionFase;
use app\models\Fases;
use app\models\Sesiones;
use app\models\AcuerdosInstitucionalesEstudiantes;
use app\models\Paralelos;
use app\models\DatosSesiones;
use app\models\SemillerosTicMovimientoDiarioCampoEstudiantes;

/**
 * SemillerosTicDiarioDeCampoEstudiantesController implements the CRUD actions for SemillerosTicDiarioDeCampoEstudiantes model.
 */
class SemillerosTicDiarioDeCampoEstudiantesController extends Controller
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
     * Creates a new SemillerosTicDiarioDeCampo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionExportar()
    {
		// Creando Nuevo documento
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		
		$idFase 	= Yii::$app->request->get('idFase');
		
		$anio 		= Yii::$app->request->get('anio');
		$esDocente 	= Yii::$app->request->get('esDocente');
		
		$ciclos = new SemillerosTicCiclos();
		
		$datos = [];
		
		/**
		 * Estructura de datos
		 * Aquí formo como están estructurados los datos para guardar
		 *
		 * Un diario de campo tiene muchos movimientos
		 */
		$diarioCampo 	= null;
		$movimientos	= [];
		/**/
			
		//Busco diario de campo según los datos suministrados
		$diarioCampo 	= SemillerosTicDiarioDeCampoEstudiantes::find()
									->where( 'estado=1' )
									->orderby( ['anio' => SORT_DESC ] )
									->all();
								
		foreach( $diarioCampo as $dcKey => $dcValue )
		{
			$movimientos = SemillerosTicMovimientoDiarioCampoEstudiantes::find()
									->where( 'id_diario_de_campo_estudiantes='.$dcValue->id )
									->andWhere( 'estado=1' )
									->orderby(['id_sesion' => SORT_ASC])
									->all();
									
			foreach( $movimientos as $key => $value )
			{
				$datos[ $value->anio ][ $dcValue->id_fase ][] =	[ 
																'descripcion' 	=> $value->descripcion,
																'hallazgos' 	=> $value->hallazgos,
																'id_sesion' 	=> $value->id_sesion,
															];
			}
		}
		
		if( count( $datos ) > 0 )
		{
			$fontStyleName = 'Titulo Anio';
			$array_options = [ 
								'name' 	=> 'Tahoma', 
								'size' 	=> 16, 
								'color'	=> '1B2232', 
								'bold' 	=> true ,
							];
			$phpWord->addFontStyle( $fontStyleName, $array_options );
			
			$fontStyleName = 'Titulo Fase';
			$array_options = [ 
								'name' 	=> 'Tahoma', 
								'size' 	=> 14, 
								'color'	=> '1B2232', 
								'bold' 	=> true ,
							];
			$phpWord->addFontStyle( $fontStyleName, $array_options );
			
			$fontStyleName = 'Titulo Sesion';
			$array_options = [ 
								'name' 	=> 'Tahoma', 
								'size' 	=> 12, 
								'color'	=> '1B2232', 
								'bold' 	=> true ,
							];
			$phpWord->addFontStyle( $fontStyleName, $array_options );
			
			$fontStyleName = 'Titulo Bitacora';
			$array_options = [ 
								'name' 	=> 'Tahoma', 
								'size' 	=> 12, 
								'color'	=> '1B2232', 
								'bold' 	=> true ,
							];
			$phpWord->addFontStyle( $fontStyleName, $array_options );
			
			$fontStyleName = 'Titulo Resumen';
			$array_options = [ 
								'name' 	=> 'Tahoma', 
								'size' 	=> 12, 
								'color'	=> '1B2232', 
								'bold' 	=> true ,
							];
			$phpWord->addFontStyle( $fontStyleName, $array_options );
			
			$fontStyleName = 'Titulo Escritura';
			$array_options = [ 
								'name' 	=> 'Tahoma', 
								'size' 	=> 12, 
								'color'	=> '1B2232', 
								'bold' 	=> true ,
							];
			$phpWord->addFontStyle( $fontStyleName, $array_options );
			
			//Creando el archivo word
			foreach( $datos as $anios => $fase )
			{
				// Agregando una sección vacía
				$section = $phpWord->addSection();
				
				$section->addText( "Año ".$anios, 'Titulo Anio' );
			
				foreach( $fase as $id_fase => $datos )
				{
					$section->addText( Fases::findOne( $id_fase )->descripcion, 'Titulo Fase' );
					
					//Consulto todas las Sesiones por ejecuciones de Fase
					switch( $id_fase )
					{
						case 1: 
							$idFaseFase = 14; 
							$titulo="BITACORA FASE I";
							break;
							
						case 2: 
							$idFaseFase = 15; 
							$titulo="BITACORA FASE II";
							break;
							
						case 3: 
							$idFaseFase = 16; 
							$titulo="BITACORA FASE III";
							break;
					}
					
					$dataResumen = $this->actionOpcionesEjecucionDiarioCampo( $idFaseFase, $anios, 1, $id_fase );
					$dataResumen['titulo'] = $titulo;
					
					$section->addText( $dataResumen[ 'titulo' ], 'Titulo Bitacora' );
					
					$section->addText( 'RESUMEN CUANTITATIVO DEL RESULTADO', 'Titulo Bitacora' );
					
					if( !empty( $dataResumen['html'] ) )
					{
						//Agregando una tabla
						$table = $section->addTable();
						
						$table->addRow();
						
						$titulosTabla = explode( "</div>", $dataResumen['html'] );
						// var_dump( $titulosTabla );
						
						foreach( $titulosTabla as $key => $value )
						{
							$cell = $table->addCell(null, [ 'bgColor' => 'cccccc' ]);
							$cell->addText( strip_tags( $value ), [ 'bold' => true ] );
						}
						// var_dump( $dataResumen['contenido'] );
						
						$table->addRow();
						
						if( !empty( $dataResumen['contenido'] ) )
						{
							$contenidoCeldas = explode( "</div>", $dataResumen['contenido'] );
							
							foreach( $contenidoCeldas as $key => $value )
							{
								$cell = $table->addCell();
								$cell->addText( strip_tags( $value ) );
							}
						}
					}
					
					if( !empty( $dataResumen['html1'] ) )
					{
						//Agregando una tabla
						$table = $section->addTable();
						
						$table->addRow();
						
						$titulosTabla = explode( "</div>", $dataResumen['html1'] );
						
						foreach( $titulosTabla as $key => $value )
						{
							$cell = $table->addCell(null, [ 'bgColor' => 'cccccc' ]);
							$cell->addText( strip_tags( $value ), [ 'bold' => true ] );
						}
						
						$table->addRow();
						
						if( !empty( $dataResumen['contenido1'] ) )
						{
							$contenidoCeldas = explode( "</div>", $dataResumen['contenido1'] );
							
							foreach( $contenidoCeldas as $key => $value )
							{
								$cell = $table->addCell();
								$cell->addText( strip_tags( $value ) );
							}
						}
					}
					
					foreach( $datos as $key => $value )
					{
						$section->addText( Sesiones::findOne( $value[ 'id_sesion' ] )->descripcion, 'Titulo Sesion' );
						
						
						$section->addText( $dataResumen[ 'descripcion' ] );
						$section->addText( $value[ 'descripcion' ] );
						
						$section->addText( $dataResumen[ 'hallazgos' ] );
						$section->addText( $value[ 'hallazgos' ] );
					}
				}
			}
			
			// Guardando el archivo
			$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
			$objWriter->save('diarioDeCampoEstudiantes.docx');
		}
    }


	public function actionSesiones( $id_fase )
	{
		 return $this->renderAjax('sesiones ', [
            'model' => $model,
			'fases' => $fases,
            'fasesModel' => $fasesModel,
			'ciclos' => $ciclos,
            'cicloslist' => $cicloslist,
            'anios' => $anios,
            'anio' => $anio,
            'esDocente' => $esDocente,
        ]);
	}
	
    /**
     * Lists all SemillerosTicDiarioDeCampoEstudiantes models.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->actionExportar();
		
		$anio 		= Yii::$app->request->get('anio');
		$esDocente 	= Yii::$app->request->get('esDocente');
		
		$idInstitucion 	= $_SESSION['instituciones'][0];
	    $idSedes 		= $_SESSION['sede'][0];
		
        $searchModel = new SemillerosTicDiarioDeCampoEstudiantesBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere('estado=1');
		
        return $this->render('index', [
            'searchModel' 	=> $searchModel,
            'dataProvider' 	=> $dataProvider,
			'anio' 			=> $anio,
            'esDocente' 	=> $esDocente,
            'sede' 			=> $idSedes,
        ]);
    }

    /**
     * Displays a single SemillerosTicDiarioDeCampoEstudiantes model.
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
     * Creates a new SemillerosTicDiarioDeCampoEstudiantes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$idFase 	= Yii::$app->request->get('idFase');
		
		$anio 		= Yii::$app->request->get('anio');
		$esDocente 	= Yii::$app->request->get('esDocente');
		
		$ciclos = new SemillerosTicCiclos();
		
		$dataResumen = [];
		
		/**
		 * Estructura de datos
		 * Aquí formo como están estructurados los datos para guardar
		 *
		 * Un diario de campo tiene muchos movimientos
		 */
		$diarioCampo 	= null;
		$movimientos	= [];
		/**/
		
		//Si hay un idFase, significa que se debe buscar los datos guardados
		//Se hace por que significa que el usuario cambio la fase en el select de la vista _form
		if( $idFase && !Yii::$app->request->post() )
		{
			//Consulto todas las Sesiones por ejecuciones de Fase
			switch( $idFase )
			{
				case 1: 
					$idFaseFase = 14; 
					$titulo="BITACORA FASE I";
					break;
					
				case 2: 
					$idFaseFase = 15; 
					$titulo="BITACORA FASE II";
					break;
					
				case 3: 
					$idFaseFase = 16; 
					$titulo="BITACORA FASE III";
					break;
			}
			
			$dataResumen = $this->actionOpcionesEjecucionDiarioCampo( $idFaseFase, $anio, 1, $idFase );
			$dataResumen['titulo'] = $titulo;
			
			
			//Busco diario de campo según los datos suministrados
			$diarioCampo 	= SemillerosTicDiarioDeCampoEstudiantes::findOne([
										'id_fase' 	=> $idFase,
										'anio' 		=> $anio,
										'estado' 	=> 1,
									]);
			
			//Si no encuentra significa que es un registro nuevo
			if( !$diarioCampo )
			{
				$diarioCampo 	= new SemillerosTicDiarioDeCampoEstudiantes();
				$diarioCampo->id_fase = $idFase;
			}
			
			//Consulto todas las Sesiones por ejecuciones de Fase
			switch( $idFase )
			{
				case 1: $tabla = "i"; break;
				case 2: $tabla = "ii"; break;
				case 3: $tabla = "iii"; break;
			}
			
			$datosSesiones	= DatosSesiones::find()
									->alias('ds')
									->select( 'id_sesion' )
									->innerJoin( 'semilleros_tic.ejecucion_fase_'.$tabla.'_estudiantes ef', 'ef.id_datos_sesion=ds.id' )
									->where( 'ds.estado=1' )
									->andWhere( 'ef.estado=1' )
									->andWhere( 'ef.anio='.$anio )
									->andWhere( 'ef.id_fase='.$idFase )
									->groupby( 'id_sesion' )
									->all();
			
			$sesiones = [];
			
			foreach( $datosSesiones as $key => $value )
			{
				$sesiones[] =  $value->id_sesion;
				
				$mov = SemillerosTicMovimientoDiarioCampoEstudiantes::findOne([
											'id_diario_de_campo_estudiantes' 	=> $diarioCampo->id,
											'id_sesion' 						=> $value->id_sesion,
										]);
										
				if( !$mov )
				{
					$mov = new SemillerosTicMovimientoDiarioCampoEstudiantes();
					$mov->id_sesion = $value->id_sesion;
				}
										
				$movimientos[] = $mov;
			}
		}
		
		//Si existen datos post, signfica que se pretende guardar los datos ingresados por el usuario
		if( Yii::$app->request->post() )
		{
			//Si no existe un id Fase significa que se procede a guardar los datos
			//Busco diario de campo según los datos suministrados
			$diarioCampo 	= SemillerosTicDiarioDeCampoEstudiantes::findOne([
										'id_fase' 	=> Yii::$app->request->post('SemillerosTicDiarioDeCampoEstudiantes')['id_fase'],
										'anio' 		=> $anio,
										'estado'	=> 1,
									]);
									
			if( !$diarioCampo )
			{
				$diarioCampo 	= new SemillerosTicDiarioDeCampoEstudiantes();
				$diarioCampo->load(Yii::$app->request->post());
			}
			
			
			$postMovimientos = Yii::$app->request->post('SemillerosTicMovimientoDiarioCampoEstudiantes');
			
			foreach( $postMovimientos as $key => $mov )
			{
				// echo "<pre>"; var_dump( $postMovimientos ); echo "</pre>";
				// var_dump( $mov ); exit();
				$modelMov = null;
				
				if( $mov['id'] )
				{
					$modelMov = SemillerosTicMovimientoDiarioCampoEstudiantes::findOne($mov['id']);
				}
				else{
					$modelMov = new SemillerosTicMovimientoDiarioCampoEstudiantes();
				}
				
				$modelMov->load( $mov, '' );
				
				$movimientos[] = $modelMov;
			}
			
			//Desde aquí se procede a guardar los datos
			
			$valido = true;
			
			$valido = $diarioCampo->validate([
								'id_fase',
								'anio',
							]) && $valido;
			
			foreach( $movimientos as $key => $mov )
			{
				$valido = $mov->validate([
								'descripcion',
								'hallazgos',
								'id_sesion',
							]) && $valido;
			}
			
			//Si todo esta bien se guarda los datos
			if( $valido )
			{
				$diarioCampo->estado = 1;
				$diarioCampo->save( false );
				
				foreach( $movimientos as $key => $mov )
				{
					$mov->id_diario_de_campo_estudiantes = $diarioCampo->id;
					$mov->anio 							 = $anio;
					$mov->estado 						 = 1;
					$mov->save(false);
				}
				
				return $this->redirect(['index',
									'anio' 		=> $anio,
									'esDocente' => 0,
								]);
			}
		}
		
		if( !$diarioCampo )
		{
			$diarioCampo 	= new SemillerosTicDiarioDeCampoEstudiantes();
		}
		
		//se crea una instancia del modelo fases
		$fasesModel 		 	= new Fases();
		//se traen los datos de fases
		$dataFases		 	= $fasesModel->find()->orderby( 'id' )->all();
		//se guardan los datos en un array
		$fases	 	 	 	= ArrayHelper::map( $dataFases, 'id', 'descripcion' );
		
		$anios	= [ $anio => $anio ];
		
		$cicloslist = [];
		
		return $this->renderAjax('create', [
            'diarioCampo' 	=> $diarioCampo,
            'movimientos' 	=> $movimientos,
			'fases' 		=> $fases,
            'fasesModel'	=> $fasesModel,
			'ciclos' 		=> $ciclos,
            'cicloslist'	=> $cicloslist,
            'anios' 		=> $anios,
            'anio' 			=> $anio,
            'esDocente' 	=> $esDocente,
            'dataResumen' 	=> $dataResumen,
        ]);
    }

    /**
     * Updates an existing SemillerosTicDiarioDeCampoEstudiantes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
		$idFase 	= Yii::$app->request->get('idFase');
		
		$anio 		= Yii::$app->request->get('anio');
		$esDocente 	= Yii::$app->request->get('esDocente');
		
		$ciclos = new SemillerosTicCiclos();
		
		$dataResumen = [];
		
		/**
		 * Estructura de datos
		 * Aquí formo como están estructurados los datos para guardar
		 *
		 * Un diario de campo tiene muchos movimientos
		 */
		$diarioCampo 	= null;
		$movimientos	= [];
		/**/
		
		//Si hay un idFase, significa que se debe buscar los datos guardados
		//Se hace por que significa que el usuario cambio la fase en el select de la vista _form
		if( $id )
		{
			//Busco diario de campo según los datos suministrados
			$diarioCampo 	= SemillerosTicDiarioDeCampoEstudiantes::findOne($id);
			$diarioCampo->isNewRecord =true;
			// var_dump( $diarioCampo->isNewRecord );
			
			$idFase = $diarioCampo->id_fase;
			
			//Consulto todas las Sesiones por ejecuciones de Fase
			switch( $idFase )
			{
				case 1: $idFaseFase = 14; break;
				case 2: $idFaseFase = 15; break;
				case 3: $idFaseFase = 16; break;
			}
			
			$dataResumen = $this->actionOpcionesEjecucionDiarioCampo( $idFaseFase, $anio, 1, $idFase );
			
			
			//Si no encuentra significa que es un registro nuevo
			if( !$diarioCampo )
			{
				$diarioCampo 	= new SemillerosTicDiarioDeCampoEstudiantes();
				$diarioCampo->id_fase = $idFase;
			}
			
			//Consulto todas las Sesiones por ejecuciones de Fase
			switch( $idFase )
			{
				case 1: $tabla = "i"; break;
				case 2: $tabla = "ii"; break;
				case 3: $tabla = "iii"; break;
			}
			
			$datosSesiones	= DatosSesiones::find()
									->alias('ds')
									->select( 'id_sesion' )
									->innerJoin( 'semilleros_tic.ejecucion_fase_'.$tabla.'_estudiantes ef', 'ef.id_datos_sesion=ds.id' )
									->where( 'ds.estado=1' )
									->andWhere( 'ef.estado=1' )
									->andWhere( 'ef.anio='.$anio )
									->andWhere( 'ef.id_fase='.$idFase )
									->groupby( 'id_sesion' )
									->all();
			
			$sesiones = [];
			
			foreach( $datosSesiones as $key => $value )
			{
				$sesiones[] =  $value->id_sesion;
				
				$mov = SemillerosTicMovimientoDiarioCampoEstudiantes::findOne([
											'id_diario_de_campo_estudiantes' 	=> $diarioCampo->id,
											'id_sesion' 						=> $value->id_sesion,
										]);
										
				if( !$mov )
				{
					$mov = new SemillerosTicMovimientoDiarioCampoEstudiantes();
					$mov->id_sesion = $value->id_sesion;
				}
										
				$movimientos[] = $mov;
			}
		}
		
		//se crea una instancia del modelo fases
		$fasesModel 		 	= Fases::findOne( $diarioCampo->id_fase );
		
		//se guardan los datos en un array
		$fases	 	 	 	= [ $fasesModel->id => $fasesModel->descripcion ];
		
		$anios	= [ $anio => $anio ];
		
		$cicloslist = [];
			

        return $this->renderAjax('create', [
            'diarioCampo' 	=> $diarioCampo,
            'movimientos' 	=> $movimientos,
			'fases' 		=> $fases,
            'fasesModel'	=> $fasesModel,
			'ciclos' 		=> $ciclos,
            'cicloslist'	=> $cicloslist,
            'anios' 		=> $anios,
            'anio' 			=> $anio,
            'esDocente' 	=> $esDocente,
            'dataResumen' 	=> $dataResumen,
        ]);
    }

    /**
     * Deletes an existing SemillerosTicDiarioDeCampoEstudiantes model.
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

        return $this->redirect(['index', 
									'anio' 		=> $model->anio,
									'esDocente' => 0,
							]);
    }

    /**
     * Finds the SemillerosTicDiarioDeCampoEstudiantes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SemillerosTicDiarioDeCampoEstudiantes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SemillerosTicDiarioDeCampoEstudiantes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	/**
     * Esta funcion lista las opciones de la ejecución diario de campo
     * 
     * @param Recibe id fase
     * @return la lista de los campos
     * @throws no tiene excepciones
     */	
	public function actionOpcionesEjecucionDiarioCampo($idFase, $idAnio, $idCiclo,$faseO)
    {
       
	  $data = array('mensaje'=>'','html'=>'','contenido'=>'','descripcion'=>'','hallazgos'=>'','html1'=>'','contenido1'=>'',);
	   
	   $idInstitucion 	= $_SESSION['instituciones'][0];
	   $idSedes 		= $_SESSION['sede'][0];

	   //se crea una instancia del modelo parametro
		$parametroTable 		 	= new Parametro();
		
		//Para traer las descripciones de los encabezados
		if ($idFase == 14) {$idParametro = 14;}
		elseif ($idFase == 15) {$idParametro = 15;}
		elseif ($idFase == 16) {$idParametro = 16;}
		
		//se traen los datos de paramero								  
		$dataParametro		 	= $parametroTable->find()->where('estado=1 and id_tipo_parametro ='.$idParametro)->all();										  
		//se guardan los datos en un array
		$opcionesEjecucion	 	 	 = ArrayHelper::map( $dataParametro, 'id', 'descripcion' );
		
		// echo "<pre>"; print_r($opcionesEjecucion); echo "</pre>";
		
		//se debe consultar el año, el ciclo y la fase para llegar a los datos de la fase
		
		//se crean las instancias de los modelos para traer los textos la base de datos
		$datosIeoProfesional = new DatosIeoProfesional();
		$ejecucionFase = new EjecucionFase();
		
		//se hacen las consultas
		
		/**
		* Concexion a la db, traer los textos segun la fase
		*/
		//variable con la conexion a la base de datos 
		
		$connection = Yii::$app->getDb();
		
		if ($faseO == 1)
		{
			$nro_estudiantes =0;		//No. de estudiantes
			$grados;				//Grados: sale de acuerdos institucionales
			$nro_sesiones=0;			//No. de sesiones realizadas
			$frecuencia;			//Frecuencia de sesiones: este es de la tabla semilleros_datos_ieo_estudiantes
			$duracion_sesion;		//Duración de cada sesión
			$aplicaciones_creadas;	//Aplicaciones creadas
			$temas_tratados;		//Temas problemas tratados


				
				
				$command = $connection->createCommand("
					 select ef.numero_estudiantes, ef.aplicaciones_creadas, ef.problemas_creacion, p.curso_participantes, ds.duracion_sesion, ds.id_sesion
					   from semilleros_tic.ejecucion_fase_i_estudiantes ef, 
							semilleros_tic.datos_ieo_profesional_estudiantes p,
							semilleros_tic.datos_sesiones ds
					  where ef.anio									= $idAnio
						and ef.id_fase 								= $faseO
						and ef.id_datos_sesion						= ds.id
						and ef.id_datos_ieo_profesional_estudiantes	= p.id
						and p.id_institucion						= $idInstitucion
						and p.id_sede								= $idSedes
						and ef.estado								= 1
						and p.estado								= 1
						and ds.estado								= 1
				 ");
				$result1 = $command->queryAll();
				
				
				if (count($result1) < 1){
					$data['mensaje']="No se encontraron datos almacenados";
					
				}
				else{
					
					//se llena el resultado de a consulta en un array
					foreach( $result1 as $key ){
						
						//Solo se suma el número de estudiantes
						$nro_estudiantes += $key['numero_estudiantes'];
						
						//es el id de acuerdos institucionales
						$grados[] 				= $key['curso_participantes'];
						
						// //Se suma las sesiones
						// $nro_sesiones 			+= $key['participacion_sesiones'];
						
						// Se hace en un array todas las duraciones de las sesiones
						$duracion_sesion[ $key['id_sesion'] ] = Sesiones::findOne( $key['id_sesion'] )->descripcion.": ".$key['duracion_sesion'];
						
						//Array del nombre de las aplicacioens creadas
						$aplicaciones_creadas[] = $key['aplicaciones_creadas'];
						
						//Total de temas tratados
						$temas_tratados[] 		= $key['problemas_creacion'];
					}
					
					//Contiene la lista de los grados en la ejecución fase i estudiantes
					$cursos = [];
					
					//Buscando frecuencias y cursos
					if( is_array( $grados ) )
					{
						foreach( $grados as $grado ){
							
							$acuerdo = AcuerdosInstitucionalesEstudiantes::findOne( $grado );
							
							if( $acuerdo )
							{	
								//muestra la lista de cursos por id
								$lista_cursos_id = explode( ",", $acuerdo->curso );
								
								foreach( $lista_cursos_id as $id_curso )
								{
									//Saco la descripcion del curso
									$des = Paralelos::findOne( $id_curso )->descripcion;
									
									//Si el curso no esta en la lista la agrego
									if( !in_array($des, $cursos) )
									{
										$cursos[] = Paralelos::findOne( $id_curso )->descripcion;
									}
								}
							}
							
							
						}
						
						$frecuencias = [];
						if( $acuerdo )
							$frecuencias[] = Parametro::findOne( $acuerdo->frecuencia_sesiones )->descripcion;
					
					//se formatea para mostrarlos separados por , cursos
						$cursosDescripcion = [];
						foreach($cursos as $key){
							
							$cursosDescripcion[]=$key;
							
							}
						
						if($cursosDescripcion)
							$cursosDescripcion = implode(",",$cursosDescripcion);
						
						//se formatea para mostrarlos separados por , frecuencias
						$frecuenciasDescripcion = [];
						foreach($frecuencias as $key){
							
							$frecuenciasDescripcion[]=$key;
							
							}
						
						if($frecuenciasDescripcion)
						$frecuenciasDescripcion = implode(",",$frecuenciasDescripcion);
						
						//se formatea para mostrarlos separados por , aplicaciones_creadas
						foreach($aplicaciones_creadas as $key){
							
							$aplicacionesCreadasDescripcion[]=$key;
							
							}
						$aplicacionesCreadasDescripcion = implode(",",$aplicacionesCreadasDescripcion);
					
						//se formatea para mostrarlos separados por , temas_tratados
						foreach($temas_tratados as $key){
							
							$temasTratadosDescripcion[]=$key;
							
							}
						$temasTratadosDescripcion = implode(",",$temasTratadosDescripcion);
						
						//se formatea para mostrarlos separados por , duracion_sesion
						foreach($duracion_sesion as $key){
							
							$duracionSesionDescripcion[]=$key;
							
							}
						$duracionSesionDescripcion = implode(",",$duracionSesionDescripcion);
					
					// echo "<pre>"; print_r($cursosDescripcion); echo "</pre>"; die();
					}
					
					//para traer sesiones realizadas
						$command = $connection->createCommand("select count(ds.fecha_sesion) as sesiones_realizadas
							from semilleros_tic.datos_sesiones as ds, 
							semilleros_tic.ejecucion_fase_i_estudiantes as ef, semilleros_tic.datos_ieo_profesional_estudiantes as dip
							where ds.id = ef.id_datos_sesion
							and ef.anio = ".$idAnio."
							and ef.id_fase = ".$faseO."
							and ef.estado = 1
							and ds.estado = 1
							and ef.id_datos_ieo_profesional_estudiantes = dip.id
							and dip.id_institucion = ".$idInstitucion."
							and dip.id_sede = ".$idSedes."");
						$result4 = $command->queryAll();
						
						$nro_sesiones = $result4[0]['sesiones_realizadas'];
						
						
						//se llena la información a mostrar en el formulario
						
						$data['html']="";
						$data['contenido']="";
						$data['html1']="";
						$data['contenido1']="";
						$contador =0;
						//este foreach toma los primeros 4 resultados de la consulta y los formatea para mostrarlos
						foreach ($opcionesEjecucion as $key => $value)
						{
							
							
							$data['html'].="<div class='col-xs-3'>";
							$data['html'].=$value;
							$data['html'].="</div>";
							
								switch ($contador) 
								{
									case 0:
										$data['contenido'].="<div class='col-xs-3' >";
										$data['contenido'].=$nro_estudiantes;
										$data['contenido'].="</div>";
										
										break;
									case 1:
										$data['contenido'].="<div class='col-xs-3' >";
										$data['contenido'].=implode( ",", $cursosDescripcion );
										$data['contenido'].="</div>";
										
										break;
									case 2:
										$data['contenido'].="<div class='col-xs-3' >";
										$data['contenido'].=$nro_sesiones;
										$data['contenido'].="</div>";
										
										break;
									case 3:
										$data['contenido'].="<div class='col-xs-3' >";
										$data['contenido'].=implode( ",", $frecuenciasDescripcion );
										$data['contenido'].="</div>";
										
										break;
									
								}

							$contador++;
							// unset(current($opcionesEjecucion));
							array_shift($opcionesEjecucion);
							if ($contador ==4)
								break;
							
						}
						
						//este foreach toma los ultimos 4 resultados de la consulta y los formatea para mostrarlos
						foreach ($opcionesEjecucion as $key => $value)
						{
							
							$data['html1'].="<div class='col-xs-3'>";
							$data['html1'].=$value;
							$data['html1'].="</div>";
							
							switch ($key) 
								{
									case 0:
										$data['contenido1'].="<div class='col-xs-3' >";
										$data['contenido1'].=$duracionSesionDescripcion;
										$data['contenido1'].="</div>";
										
										break;
									case 1:
										$data['contenido1'].="<div class='col-xs-3' >";
										$data['contenido1'].=$aplicacionesCreadasDescripcion;
										$data['contenido1'].="</div>";
										
										break;
									case 2:
										$data['contenido1'].="<div class='col-xs-3' >";
										$data['contenido1'].=$temasTratadosDescripcion;  
										$data['contenido1'].="</div>";
										
										break;
									case 3:
										$data['contenido1'].="<div class='col-xs-3' >";
										$data['contenido1'].="";
										$data['contenido1'].="</div>";
										
										break;
									
								}
						}
					
				} //else
				
				
					
		} //if
		else if ($faseO == 2 || $faseO == 3)
		{
			$nro_estudiantes =0;		//No. de estudiantes
			$grados;				//Grados: sale de acuerdos institucionales
			$nro_sesiones=0;			//No. de sesiones realizadas
			$frecuencia;			//Frecuencia de sesiones: este es de la tabla semilleros_datos_ieo_estudiantes
			$duracion_sesion;		//Duración de cada sesión
			$aplicaciones_desarrolladas;	//Aplicaciones desarrolladas
			$tic;		//Tic

			if ($faseO == 2){$tabla = "ejecucion_fase_ii_estudiantes";}
			if ($faseO == 3){$tabla = "ejecucion_fase_iii_estudiantes";}
				
				$command = $connection->createCommand("
					 select ef.estudiantes_participantes, ef.nombre_aplicaciones, ef.tic, p.curso_participantes, ds.duracion_sesion, ds.id_sesion
					   from semilleros_tic.$tabla ef, 
							semilleros_tic.datos_ieo_profesional_estudiantes p,
							semilleros_tic.datos_sesiones ds
					  where ef.anio									= $idAnio
						and ef.id_fase 								= $faseO
						and ef.id_datos_sesion						= ds.id
						and ef.id_datos_ieo_profesional_estudiantes	= p.id
						and p.id_institucion						= $idInstitucion
						and p.id_sede								= $idSedes
						and ef.estado								= 1
						and p.estado								= 1
						and ds.estado								= 1
				 ");
				$result1 = $command->queryAll();
				
				if (count($result1) < 1){
					$data['mensaje']="No se encontraron datos almacenados";
					
				}
				else{
					
						//se llena el resultado de a consulta en un array
				foreach( $result1 as $key ){
					
					//Solo se suma el número de estudiantes
					$nro_estudiantes += $key['estudiantes_participantes'];
					
					//es el id de acuerdos institucionales
					$grados[] 				= $key['curso_participantes'];
					
					// //Se suma las sesiones
					// $nro_sesiones 			+= $key['participacion_sesiones'];
					
					// Se hace en un array todas las duraciones de las sesiones
					$duracion_sesion[ $key['id_sesion'] ] = Sesiones::findOne( $key['id_sesion'] )->descripcion.": ".$key['duracion_sesion'];
					
					//Array del nombre de las aplicacioens desarrolladas
					$aplicaciones_desarrolladas[] = $key['nombre_aplicaciones'];
					
					//Total de temas tratados
					$tic[] 		= $key['tic'];
				}
				
				//Contiene la lista de los grados en la ejecución fase i estudiantes
				$cursos = [];
				
				//Buscando frecuencias y cursos
				if( is_array( $grados ) )
				{
					foreach( $grados as $grado ){
						
						$acuerdo = AcuerdosInstitucionalesEstudiantes::findOne( explode( ",",$grado ) );
						
						if( $acuerdo ){
							
							//muestra la lista de cursos por id
							$lista_cursos_id = explode( ",", $acuerdo->curso );
							
							foreach( $lista_cursos_id as $id_curso )
							{
								//Saco la descripcion del curso
								$des = Paralelos::findOne( $id_curso )->descripcion;
								
								//Si el curso no esta en la lista la agrego
								if( !in_array($des, $cursos) )
								{
									$cursos[] = Paralelos::findOne( $id_curso )->descripcion;
								}
							}
						}
						
						
					}
					
					$frecuencias = [];
					if($acuerdo)
						$frecuencias[] = Parametro::findOne( $acuerdo->frecuencia_sesiones )->descripcion;
					
				
				//se formatea para mostrarlos separados por , cursos
				$cursosDescripcion = [];
					foreach($cursos as $key){
						
						$cursosDescripcion[]=$key;
						
						}
					
					$cursosDescripcion = implode(",",$cursosDescripcion);
					
					//se formatea para mostrarlos separados por , frecuencias
					$frecuenciasDescripcion = [];
					foreach($frecuencias as $key){
						
						$frecuenciasDescripcion[]=$key;
						
						}
					$frecuenciasDescripcion = implode(",",$frecuenciasDescripcion);
					
					//se formatea para mostrarlos separados por , aplicaciones_creadas
					foreach($aplicaciones_desarrolladas as $key){
						
						$aplicacionesDesarrolladasDescripcion[]=$key;
						
						}
					$aplicacionesDesarrolladasDescripcion = implode(",",$aplicacionesDesarrolladasDescripcion);
				
				    //se formatea para mostrarlos separados por , tic
					foreach($tic as $key){
						
						$ticDescripcion[]=$key;
						
						}
					$ticDescripcion = implode(",",$ticDescripcion);
					
					//se formatea para mostrarlos separados por , duracion_sesion
					foreach($duracion_sesion as $key){
						
						$duracionSesionDescripcion[]=$key;
						
						}
					$duracionSesionDescripcion = implode(",",$duracionSesionDescripcion);
				
				// echo "<pre>"; print_r($cursosDescripcion); echo "</pre>"; die();
				}
				
				//para traer sesiones realizadas
					$command = $connection->createCommand("select count(ds.fecha_sesion) as sesiones_realizadas
						from semilleros_tic.datos_sesiones as ds, 
						semilleros_tic.$tabla as ef, semilleros_tic.datos_ieo_profesional_estudiantes as dip
						where ds.id = ef.id_datos_sesion
						and ef.anio = ".$idAnio."
						and ef.id_fase = ".$faseO."
						and ef.estado = 1
						and ds.estado = 1
						and ef.id_datos_ieo_profesional_estudiantes = dip.id
						and dip.id_institucion = ".$idInstitucion."
						and dip.id_sede = ".$idSedes."");
					$result4 = $command->queryAll();
					
					$nro_sesiones = $result4[0]['sesiones_realizadas'];
					
					
					//se llena la información a mostrar en el formulario
					
					$data['html']="";
					$data['contenido']="";
					$data['html1']="";
					$data['contenido1']="";
					$contador =0;
					//este foreach toma los primeros 4 resultados de la consulta y los formatea para mostrarlos
					foreach ($opcionesEjecucion as $key => $value)
					{
						
						
						$data['html'].="<div class='col-xs-3'>";
						$data['html'].=$value;
						$data['html'].="</div>";
						
							switch ($contador) 
							{
								case 0:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$nro_estudiantes;
									$data['contenido'].="</div>";
									
									break;
								case 1:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$cursosDescripcion;
									$data['contenido'].="</div>";
									
									break;
								case 2:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$nro_sesiones;
									$data['contenido'].="</div>";
									
									break;
								case 3:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$frecuenciasDescripcion;
									$data['contenido'].="</div>";
									
									break;
								
							}

						$contador++;
						// unset(current($opcionesEjecucion));
						array_shift($opcionesEjecucion);
						if ($contador ==4)
							break;
						
					}
					
					//este foreach toma los ultimos 4 resultados de la consulta y los formatea para mostrarlos
					foreach ($opcionesEjecucion as $key => $value)
					{
						
						$data['html1'].="<div class='col-xs-3'>";
						$data['html1'].=$value;
						$data['html1'].="</div>";
						
						switch ($key) 
							{
								case 0:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$duracionSesionDescripcion;
									$data['contenido1'].="</div>";
									
									break;
								case 1:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$aplicacionesDesarrolladasDescripcion;
									$data['contenido1'].="</div>";
									
									break;
								case 2:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$ticDescripcion;  
									$data['contenido1'].="</div>";
									
									break;
								case 3:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].="";
									$data['contenido1'].="</div>";
									
									break;
								
							}
					}
					
				} //else
				
				
		} //fase 2 0 fase 3
	
		
		// echo "<pre>"; print_r($datosEF); echo "</pre>";
		
		
		
		
		//Para traer las descripciones para ingresar el texto
		if ($idFase == 14) {$idParametro = 78;}
		elseif ($idFase == 15) {$idParametro = 79;}
		elseif ($idFase == 16) {$idParametro = 80;}
		
		//se crea una instancia del modelo parametro
		$descripcionTexto = Parametro::findOne($idParametro)->descripcion;
		
		
		$data['descripcion']=$descripcionTexto;
		
		//Para traer los hallazgos
		if ($idFase == 14) {$idParametro = 81;}
		elseif ($idFase == 15) {$idParametro = 82;}
		elseif ($idFase == 16) {$idParametro = 85;}
		
		//se crea una instancia del modelo parametro
		$hallazgosTexto = Parametro::findOne($idParametro)->descripcion;
		
		
		$data['hallazgos']=$hallazgosTexto;

        
		 // echo "<pre>"; print_r($data); echo "</pre>";
		
		return $data;
		
		// echo json_encode( $data ); 
	   
    }
	
	/**
     * Esta funcion lista las opciones de ciclo
     * 
     * @param Recibe id anio
     * @return la lista de los ciclos
     * @throws no tiene excepciones
     */	
	public function actionLlenarCiclos($idAnio)
    {
		$data = array('mensaje'=>'','html'=>'');
	   
		
		$ciclosSelected =array();
		
			// $ciclos = new SemillerosTicCiclos();
			
			$dataCiclos = SemillerosTicCiclos::find()
							->where( 'estado=1' )
							->where( 'id_anio='.$idAnio.'' )
							->orderby('id')
							->all();
			
			$result	= ArrayHelper::map( $dataCiclos, 'id', 'descripcion' );
			
			if (count($result) < 1 ){
				$data['html'].= '<option value="">Seleccione...</option>';
			}
			else{
				$data['html'].= '<option value="">Seleccione...</option>';
					foreach ($result as $key => $value) {
				$data['html'].= '<option value="'.$key.'">'.$value.'</option>';
				
						}
			}
			// echo "<pre>"; print_r($result); echo "</pre>";  die();
			// echo "<pre>"; print_r($data); echo "</pre>"; die();
		echo json_encode( $data );	
			
	}
	
	/**
     * Esta funcion recibe un array y lo devuelve separado por comas
     * 
     * @param Recibe el array
     * @return lista de items separados por comas
     * @throws no tiene excepciones
     */	
	public function arrayArrayComas($array,$nombrePos)
	{
		foreach ($array as $ar)
		{		
			$datos[] = $ar[$nombrePos];
		}
		return  implode(",",$datos);
	}
}
