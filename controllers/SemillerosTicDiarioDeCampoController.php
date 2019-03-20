<?php
/**********
Versión: 001
Fecha: Fecha en formato (15-08-2018)
Desarrollador: Viviana Rodas
Descripción: diario de campo semilleros tic
----------------------------------------------------------------
Modificaciones:
----------------------------------------------------------------
Fecha: 2019-03-018
Desarrollador: Edwin Molina Grisales
Descripción: Se permite exportar a excel los datos del diario de campo
----------------------------------------------------------------
Fecha: 2019-03-05
Desarrollador: Edwin Molina Grisales
Descripción: Se solicita por cada sesión realizada en las ejecuciones de fase una descripción y hallazgo
----------------------------------------------------------------
Fecha: 2019-02-26
Desarrollador: Edwin Molina Grisales
Descripción: Se elimina ciclos y se trabaja con el año de la url
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
use app\models\SemillerosTicDiarioDeCampo;
use app\models\SemillerosTicDiarioDeCampoBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Fases;
use yii\helpers\ArrayHelper;
use app\models\SemillerosTicCiclos;
use app\models\SemillerosTicAnio;
use app\models\Parametro;
use app\models\DatosIeoProfesional;
use app\models\EjecucionFase;
use app\models\DatosSesiones;
use app\models\Sesiones;
use app\models\SemillerosTicMovimientoDiarioCampo;


/**
 * SemillerosTicDiarioDeCampoController implements the CRUD actions for SemillerosTicDiarioDeCampo model.
 */
class SemillerosTicDiarioDeCampoController extends Controller
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
		$diarioCampo 	= SemillerosTicDiarioDeCampo::find()
									->where( 'estado=1' )
									->orderby( ['anio' => SORT_DESC ] )
									->all();
								
		foreach( $diarioCampo as $dcKey => $dcValue )
		{
			$movimientos = SemillerosTicMovimientoDiarioCampo::find()
									->where( 'id_diario_de_campo='.$dcValue->id )
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
				
				$section->addText( $anios, 'Titulo Anio' );
			
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
			$objWriter->save('diarioDeCampoDocentes.docx');
		}
    }


    /**
     * Lists all SemillerosTicDiarioDeCampo models.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->actionExportar();
		
		$anio 		= Yii::$app->request->get('anio');
		$esDocente 	= Yii::$app->request->get('esDocente');
		
		$idInstitucion 	= $_SESSION['instituciones'][0];
	    $idSedes 		= $_SESSION['sede'][0];
		
        $searchModel = new SemillerosTicDiarioDeCampoBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere('estado=1');
        
		return $this->render('index', [
            'searchModel' 	=> $searchModel,
            'dataProvider'	=> $dataProvider,
            'anio' 			=> $anio,
            'esDocente' 	=> $esDocente,
            'sede' 			=> $idSedes,
        ]);
    }

    /**
     * Displays a single SemillerosTicDiarioDeCampo model.
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
     * Creates a new SemillerosTicDiarioDeCampo model.
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
			$diarioCampo 	= SemillerosTicDiarioDeCampo::findOne([
										'id_fase' 	=> $idFase,
										'anio' 		=> $anio,
										'estado' 	=> 1,
									]);
			
			//Si no encuentra significa que es un registro nuevo
			if( !$diarioCampo )
			{
				$diarioCampo 	= new SemillerosTicDiarioDeCampo();
				$diarioCampo->id_fase = $idFase;
			}
			
			//Consulto todas las Sesiones por ejecuciones de Fase
			switch( $idFase )
			{
				case 1: 
					$tabla = ""; 
					$campoSesiones = 'id_datos_sesiones';
					break;
					
				case 2: 
					$tabla = "_ii"; 
					$campoSesiones = 'id_datos_sesiones';
					break;
					
				case 3: 
					$tabla = "_iii"; 
					$campoSesiones = 'id_datos_sesion';
					break;
			}
			
			$datosSesiones	= DatosSesiones::find()
									->alias('ds')
									->select( 'id_sesion' )
									->innerJoin( 'semilleros_tic.ejecucion_fase'.$tabla.' ef', 'ef.'.$campoSesiones.'=ds.id' )
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
				
				$mov = SemillerosTicMovimientoDiarioCampo::findOne([
											'id_diario_de_campo'=> $diarioCampo->id,
											'id_sesion' 		=> $value->id_sesion,
										]);
										
				if( !$mov )
				{
					$mov = new SemillerosTicMovimientoDiarioCampo();
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
			$diarioCampo 	= SemillerosTicDiarioDeCampo::findOne([
										'id_fase' 	=> Yii::$app->request->post('SemillerosTicDiarioDeCampo')['id_fase'],
										'anio' 		=> $anio,
										'estado'	=> 1,
									]);
									
			if( !$diarioCampo )
			{
				$diarioCampo 	= new SemillerosTicDiarioDeCampo();
				$diarioCampo->load(Yii::$app->request->post());
			}
			
			
			$postMovimientos = Yii::$app->request->post('SemillerosTicMovimientoDiarioCampo');
			
			foreach( $postMovimientos as $key => $mov )
			{
				$modelMov = null;
				
				if( $mov['id'] )
				{
					$modelMov = SemillerosTicMovimientoDiarioCampo::findOne($mov['id']);
				}
				else{
					$modelMov = new SemillerosTicMovimientoDiarioCampo();
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
					$mov->id_diario_de_campo = $diarioCampo->id;
					$mov->anio 				 = $anio;
					$mov->estado 			 = 1;
					$mov->save(false);
				}
				
				return $this->redirect(['index',
									'anio' 		=> $anio,
									'esDocente' => 1,
								]);
			}
		}
		
		if( !$diarioCampo )
		{
			$diarioCampo 	= new SemillerosTicDiarioDeCampo();
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
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$anio 		= Yii::$app->request->get('anio');
		$esDocente 	= Yii::$app->request->get('esDocente');
		
		$ciclos = new SemillerosTicCiclos();
		
		// $ciclos->load( Yii::$app->request->post() );
		
        $model = new SemillerosTicDiarioDeCampo();

		//se crea una instancia del modelo fases
		$fasesModel 		 	= new Fases();
		//se traen los datos de fases
		$dataFases		 	= $fasesModel->find()->orderby( 'id' )->all();
		//se guardan los datos en un array
		$fases	 	 	 	= ArrayHelper::map( $dataFases, 'id', 'descripcion' );
		
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 
									'anio' 		=> $anio,
									'esDocente' => $esDocente,
								]);
        }
		
		// $dataAnios 	= SemillerosTicAnio::find()
							// ->where( 'estado=1' )
							// ->orderby( 'descripcion' )
							// ->all();
			
		// $anios	= ArrayHelper::map( $dataAnios, 'id', 'descripcion' );
		
		$anios[] = [ $anio => $anio ];
		
		$cicloslist = [];
		
		// // if( $ciclos->id_anio ){
			
			// $dataCiclos = SemillerosTicCiclos::find()
							// ->where( 'estado=1' )
							// ->where( 'id_anio=1' )
							// ->orderby( 'descripcion' )
							// ->all();
			
			// $cicloslist	= ArrayHelper::map( $dataCiclos, 'id', 'descripcion' );
		// // }

		
        return $this->renderAjax('create', [
            'model' => $model,
            'fases' => $fases,
            'fasesModel' => $fasesModel,
            'ciclos' => $ciclos,
            'cicloslist' => $cicloslist,
            'anios' => $anios,
            'anioSelected' => $anio,
            'anio' => $anio,
            'esDocente' => $esDocente,
        ]);
    }

    /**
     * Updates an existing SemillerosTicDiarioDeCampo model.
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
			$diarioCampo 	= SemillerosTicDiarioDeCampo::findOne($id);
			$diarioCampo->isNewRecord =true;
			
			$idFase = $diarioCampo->id_fase;
			
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
			
			
			//Si no encuentra significa que es un registro nuevo
			if( !$diarioCampo )
			{
				$diarioCampo 	= new SemillerosTicDiarioDeCampo();
				$diarioCampo->id_fase = $idFase;
			}
			
			//Consulto todas las Sesiones por ejecuciones de Fase
			switch( $idFase )
			{
				case 1: 
					$tabla = ""; 
					$campoSesiones = 'id_datos_sesiones';
					break;
					
				case 2: 
					$tabla = "_ii"; 
					$campoSesiones = 'id_datos_sesiones';
					break;
					
				case 3: 
					$tabla = "_iii"; 
					$campoSesiones = 'id_datos_sesion';
					break;
			}
			
			$datosSesiones	= DatosSesiones::find()
									->alias('ds')
									->select( 'id_sesion' )
									->innerJoin( 'semilleros_tic.ejecucion_fase'.$tabla.' ef', 'ef.'.$campoSesiones.'=ds.id' )
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
				
				$mov = SemillerosTicMovimientoDiarioCampo::findOne([
											'id_diario_de_campo' 	=> $diarioCampo->id,
											'id_sesion' 						=> $value->id_sesion,
										]);
										
				if( !$mov )
				{
					$mov = new SemillerosTicMovimientoDiarioCampo();
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
     * Deletes an existing SemillerosTicDiarioDeCampo model.
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
									'esDocente' => 1,
							]);
    }

    /**
     * Finds the SemillerosTicDiarioDeCampo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SemillerosTicDiarioDeCampo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SemillerosTicDiarioDeCampo::findOne($id)) !== null) {
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
	public function actionOpcionesEjecucionDiarioCampo($idFase, $idAnio, $idCiclo, $faseO)
    {
	   $data = array('mensaje'=>'','html'=>'','contenido'=>'','descripcion'=>'','hallazgos'=>'','html1'=>'','contenido1'=>'',);
	   
	   $idInstitucion 	= $_SESSION['instituciones'][0];
	   $idSedes 		= $_SESSION['sede'][0];

	   //se crea una instancia del modelo parametro
		$parametroTable 		 	= new Parametro();
		
		//Para traer las descripciones de los encabezados
		if ($idFase == 14) {$idParametro = 9;}
		elseif ($idFase == 15) {$idParametro = 10;}
		elseif ($idFase == 16) {$idParametro = 11;}
		
		//se traen los datos de paramero								  
		$dataParametro		 	= $parametroTable->find()->where('estado=1 and id_tipo_parametro ='.$idParametro)->all();										  
		//se guardan los datos en un array
		$opcionesEjecucion	 	 	 = ArrayHelper::map( $dataParametro, 'id', 'descripcion' );
		
		
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
			
			$datosEjecucionFase1 =array();
			
			//se traen 6 datos para mostrar
			
			$command = $connection->createCommand("select ci.total_docentes_ieo, ef.asignaturas, ef.especiaidad, ef.seiones_empleadas, ef.numero_apps, ef.temas_problama
			 from semilleros_tic.anio as a, semilleros_tic.fases as f, semilleros_tic.ejecucion_fase as ef, semilleros_tic.datos_ieo_profesional as dip, 
			 semilleros_tic.condiciones_institucionales as ci, semilleros_tic.datos_sesiones as ds
			 where a.descripcion = '$idAnio'
			 and f.id = $faseO
			 and ef.id_fase = f.id
			 and dip.id = ef.id_datos_ieo_profesional
			 and dip.id_institucion = ".$idInstitucion."
			 and dip.id_sede = ".$idSedes."
			 group by ef.id, ci.total_docentes_ieo, ef.asignaturas, ef.especiaidad, ef.seiones_empleadas, ef.numero_apps, ef.temas_problama
			 ");
			 
			 $command = $connection->createCommand("select ci.total_docentes_ieo, ef.asignaturas, ef.especiaidad, ef.seiones_empleadas, ef.numero_apps, ef.temas_problama
													  from 	semilleros_tic.fases as f, semilleros_tic.ejecucion_fase as ef, semilleros_tic.datos_ieo_profesional as dip, 
															semilleros_tic.condiciones_institucionales as ci, semilleros_tic.datos_sesiones as ds
													 where f.id = $faseO
													   and ef.id_fase = f.id
													   and dip.id = ef.id_datos_ieo_profesional
													   and dip.id_institucion = ".$idInstitucion."
													   and dip.id_sede = ".$idSedes."
													   and ef.anio = ".$idAnio."
												  group by ef.id, ci.total_docentes_ieo, ef.asignaturas, ef.especiaidad, ef.seiones_empleadas, ef.numero_apps, ef.temas_problama
													 ");
			$result1 = $command->queryAll();
			
			
			//se llena el resultado de a consulta en un array
			foreach($result1 as $key){
				$datosEjecucionFase1[]=$key;
			}
			
			$datosEF =array();
			//se asignan indices numericos a los resultados
			foreach($datosEjecucionFase1 as $d => $valor) //se saca el indice
			{
				foreach($valor as $v) //se recorre el array valor y se le cambian los indices
				{
					
					$datosEF[$d][]=$v;
				}
			}
				
				
				// echo "<pre>"; print_r($datosEF); echo "</pre>"; 
				// echo "<pre>"; print_r("datosef"); echo "</pre>"; 
			if (count($datosEF) < 1)
			{
				$data['mensaje']="No se encontraron datos almacenados";
			}
			else
			{  //si se encontraron datos almacenados
				// echo "si tiene";
					
					// se unen los resultados para mostrar
				$asignaturas = "";
				$especiaidad = "";
				$seiones_empleadas = 0;
				$numero_apps = 0;
				$temas_problama = "";
				$contador=0;
			
				foreach($datosEF as $key => $value){
					
					foreach($value as $val)
					{
						switch ($contador) 
						{
							case 0:
								$total_docentes_ieo = $val;
								break;
							case 1:
								$asignaturas .= $val.", ";
								break;
							case 2:
								$especiaidad .=$val.", ";
								break;
							case 3:
								$seiones_empleadas += $val;
								break;
							case 4:
								$numero_apps += $val;
								break;
							case 5:
								$temas_problama .= $val.", ";
								break;
						}
						$contador++;
					}
					$contador=0;
					
				}
			
			
				//para la fecuencia de las sesiones se trae de la conformacion de semilleros
				$frecuenciaSesiones =array();
				
				// $command = $connection->createCommand("
				// select ai.frecuencias_sesiones
				// from semilleros_tic.acuerdos_institucionales as ai, semilleros_tic.fases as f, semilleros_tic.semilleros_datos_ieo as sdi,
					// semilleros_tic.datos_ieo_profesional as dip, semilleros_tic.ejecucion_fase as ef, semilleros_tic.anio as a
				// where f.id = ".$faseO."
				// and ai.id_fase = f.id
				// and ai.id_semilleros_datos_ieo = sdi.id
				// and sdi.id_institucion = dip.id_institucion
				// and sdi.sede = dip.id_sede
				// and dip.id_institucion = ".$idInstitucion."
				// and dip.id_sede = ".$idSedes."
				// and a.descripcion = '$idAnio' 
				// and dip.estado = 1
				// and ef.estado = 1
				// and sdi.estado = 1
				// and ai.estado = 1
				// and a.estado = 1
				// group by ai.frecuencias_sesiones");
				
				$command = $connection->createCommand("
						select ai.frecuencias_sesiones
						  from semilleros_tic.acuerdos_institucionales as ai, semilleros_tic.fases as f, semilleros_tic.semilleros_datos_ieo as sdi,
							   semilleros_tic.datos_ieo_profesional as dip, semilleros_tic.ejecucion_fase as ef
						 where f.id = ".$faseO."
						   and ai.id_fase = f.id
						   and ai.id_semilleros_datos_ieo = sdi.id
						   and sdi.id_institucion = dip.id_institucion
						   and sdi.sede = dip.id_sede
						   and dip.id_institucion = ".$idInstitucion."
						   and dip.id_sede = ".$idSedes."
						   and dip.estado = 1
						   and ef.estado = 1
						   and sdi.estado = 1
						   and ai.estado = 1
						   and ef.anio = $idAnio
					  group by ai.frecuencias_sesiones");
					  
				$result2 = $command->queryAll();
				
			
				//se llena el resultado de a consulta en un array
						foreach($result2 as $key){
							$frecuenciaSesiones[]=$key;
						}
				
				
				if (count($frecuenciaSesiones) < 1){
					
					$data['mensaje']="No se encontraron datos almacenados o verifique la información";
					
				}
				else
				{					
							//consultar la descripcion de la frecuencia sesiones
							// $frecuenciaSesionesDescripcion =array();
							$command = $connection->createCommand("select descripcion
							from parametro
							where id_tipo_parametro = 6 
							and id = ".$frecuenciaSesiones[0]['frecuencias_sesiones']."
							and estado = 1");
							$result4 = $command->queryAll();
							
							$frecuenciaSesionesDescripcion = "";
							foreach($result4 as $key){
								
								$frecuenciaSesionesDescripcion.=" ".implode(" ",$key);
								
							}
					
						
					
					
					//para traer la duracion de cada sesion  
					$otrosDatosEjecucionFase1 =array();
					$command = $connection->createCommand("select s.descripcion, ds.duracion_sesion
					 from semilleros_tic.sesiones as s, semilleros_tic.datos_sesiones as ds, semilleros_tic.ejecucion_fase as ef
					 where ef.id_fase = ".$faseO."
					 and ef.estado = 1
					 and ds.id = ef.id_datos_sesiones
					 and s.id = ds.id_sesion
					 and ds.estado = 1
					 and s.estado = 1
					 group by s.id, ds.fecha_sesion, ds.id
					 order by ds.id");
					$result3 = $command->queryAll();
					foreach($result3 as $key){
						$otrosDatosEjecucionFase1[]=$key;
					}
					
					//se asignan indices numericos a los resultados
					foreach($otrosDatosEjecucionFase1 as $d => $valor) //se saca el indice
					{
						foreach($valor as $v) //se recorre el array valor y se le cambian los indices
						{
							
							$datosEF1[$d][]=$v;
						}
					}
					
					
					//para pasar el array a texto para mostrarlos
					// $duracionSesiones = "";
					foreach($datosEF1 as $key){
						
						$duracionSesiones[]=$key[0].": ".$key[1];
						
					}
					$duracionSesiones = implode(",",$duracionSesiones);
					
					
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
									$data['contenido'].=$total_docentes_ieo;
									$data['contenido'].="</div>";
									
									break;
								case 1:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$asignaturas;
									$data['contenido'].="</div>";
									
									break;
								case 2:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$especiaidad;
									$data['contenido'].="</div>";
									
									break;
								case 3:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$seiones_empleadas;
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
									$data['contenido1'].=$frecuenciaSesionesDescripcion;
									$data['contenido1'].="</div>";
									
									break;
								case 1:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$duracionSesiones;
									$data['contenido1'].="</div>";
									
									break;
								case 2:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$numero_apps;  
									$data['contenido1'].="</div>";
									
									break;
								case 3:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$temas_problama;
									$data['contenido1'].="</div>";
									
									break;
								
							}
					}
				}	
			} //if
				
		}
		else if ($faseO == 2)
		{
			$datosEjecucionFase2 =array();
				
								
				// $command = $connection->createCommand("
				// select 
					// ai.total_docentes, 
					// ef.asignaturas, 
					// ef.especialidad, 
					// ef.numero_apps_desarrolladas 
				// from 
				// semilleros_tic.anio as a, 
				// semilleros_tic.fases as f, 
				// semilleros_tic.ejecucion_fase_ii as ef, semilleros_tic.datos_ieo_profesional as dip, 
				// semilleros_tic.datos_sesiones as ds, semilleros_tic.acuerdos_institucionales as ai
				// where a.descripcion = '$idAnio' 
				// and f.id = $faseO 
				// and ef.id_fase = f.id 
				// and dip.id = ef.id_datos_ieo_profesional 
				// and dip.id_institucion = ".$idInstitucion." 
				// and dip.id_sede = ".$idSedes." 
				// and ai.id_fase = $faseO
				// group by ef.id, ai.total_docentes, ef.asignaturas, ef.especialidad, ef.numero_apps_desarrolladas
				// ");
				
				$command = $connection->createCommand("
				select ai.total_docentes, ef.asignaturas, ef.especialidad, ef.numero_apps_desarrolladas 
				  from semilleros_tic.fases as f, 
					   semilleros_tic.ejecucion_fase_ii as ef, 
					   semilleros_tic.datos_ieo_profesional as dip, 
					   semilleros_tic.datos_sesiones as ds, 
					   semilleros_tic.acuerdos_institucionales as ai
				 where ef.anio = $idAnio 
				   and f.id = $faseO 
				   and ef.id_fase = f.id 
				   and dip.id = ef.id_datos_ieo_profesional 
				   and dip.id_institucion = ".$idInstitucion." 
				   and dip.id_sede = ".$idSedes." 
				   and ai.id_fase = $faseO
			  group by ef.id, ai.total_docentes, ef.asignaturas, ef.especialidad, ef.numero_apps_desarrolladas
				");
				$result1 = $command->queryAll();
				
				
				
				//se llena el resultado de la consulta en un array
				foreach($result1 as $key){
					$datosEjecucionFase2[]=$key;
				}
				
				$datosEF =array();
				//se asignan indices numericos a los resultados
				foreach($datosEjecucionFase2 as $d => $valor) //se saca el indice
				{
					foreach($valor as $v) //se recorre el array valor y se le cambian los indices
					{
						
						$datosEF[$d][]=$v;
					}
				}
				
				if (count($datosEF) < 1){
					$data['mensaje']="No se encontraron datos almacenados";
					
				}
				else{  //si se encontraron datos almacenados
					// echo "si tiene";
				
					// se unen los resultados para mostrar
					$total_docentes_ieo=0;
					$asignaturas = "";
					$especiaidad = "";
					$numero_apps_desarrolladas = 0;
					
					$contador=0;
					
					foreach($datosEF as $key => $value){
						
						foreach($value as $val)
						{
							switch ($contador) 
							{
								case 0:
									$total_docentes_ieo = $val;
									break;
								case 1:
									$asignaturas .= $val.", ";
									break;
								case 2:
									$especiaidad .=$val.", ";
									break;
								case 3:
									$numero_apps_desarrolladas += $val;
									break;
								
							}
							$contador++;
						}
						$contador=0;
						
					}
					
					//para la fecuencia de las sesiones se trae de la conformacion de semilleros
					$frecuenciaSesiones =array();
					
					// $command = $connection->createCommand("select ai.frecuencias_sesiones
					// from semilleros_tic.acuerdos_institucionales as ai, semilleros_tic.fases as f, semilleros_tic.semilleros_datos_ieo as sdi,
						// semilleros_tic.datos_ieo_profesional as dip, semilleros_tic.ejecucion_fase_ii as ef, semilleros_tic.anio as a,
						// semilleros_tic.ciclos as c
					// where f.id = ".$faseO."
					// and ai.id_fase = f.id
					// and ai.id_semilleros_datos_ieo = sdi.id
					// and sdi.id_institucion = dip.id_institucion
					// and sdi.sede = dip.id_sede
					// and dip.id_institucion = ".$idInstitucion."
					// and dip.id_sede = ".$idSedes."
					// and c.id = ".$idCiclo."
					// and ai.id_ciclo = c.id 
					// and ef.id_ciclo = c.id
					// and a.descripcion = '$idAnio' 
					// and c.id_anio = a.id
					// and dip.estado = 1
					// and ef.estado = 1
					// and sdi.estado = 1
					// and ai.estado = 1
					// and a.estado = 1
					// and c.estado =1
					// group by ai.frecuencias_sesiones");
					
					$command = $connection->createCommand("select ai.frecuencias_sesiones
															 from semilleros_tic.acuerdos_institucionales as ai, 
																  semilleros_tic.fases as f, 
																  semilleros_tic.semilleros_datos_ieo as sdi,
																  semilleros_tic.datos_ieo_profesional as dip, 
																  semilleros_tic.ejecucion_fase_ii as ef, 
																  semilleros_tic.anio as a,
																  semilleros_tic.ciclos as c
															where f.id = ".$faseO."
															and ai.id_fase = f.id
															and ai.id_semilleros_datos_ieo = sdi.id
															and sdi.id_institucion = dip.id_institucion
															and sdi.sede = dip.id_sede
															and dip.id_institucion = ".$idInstitucion."
															and dip.id_sede = ".$idSedes."
															and ai.anio = ef.anio
															and ef.anio = ".$idAnio."
															and dip.estado = 1
															and ef.estado = 1
															and sdi.estado = 1
															and ai.estado = 1
															group by ai.frecuencias_sesiones");
					$result2 = $command->queryAll();
					
					//se llena el resultado de a consulta en un array
							foreach($result2 as $key){
								$frecuenciaSesiones[]=$key;
							}
					
					
					if (count($frecuenciaSesiones) < 1){
						
						$data['mensaje']="No se encontraron datos almacenados o verifique la información";
					}
					else{	
							//consultar la descripcion de la frecuencia sesiones
							// $frecuenciaSesionesDescripcion =array();
							$command = $connection->createCommand("select descripcion
							from parametro
							where id_tipo_parametro = 6 
							and id = ".$frecuenciaSesiones[0]['frecuencias_sesiones']."
							and estado = 1");
							$result4 = $command->queryAll();
							
							$frecuenciaSesionesDescripcion = "";
							foreach($result4 as $key){
								
								$frecuenciaSesionesDescripcion.=" ".implode(" ",$key);
								
							}
					}
					
					//para traer la duracion de cada sesion  
					$otrosDatosEjecucionFase1 =array();
					// $command = $connection->createCommand("select s.descripcion, ds.duracion_sesion
					 // from semilleros_tic.sesiones as s, semilleros_tic.datos_sesiones as ds, semilleros_tic.ejecucion_fase_ii as ef
					 // where ef.id_fase = ".$faseO."
					 // and ef.id_ciclo = ".$idCiclo."
					 // and ef.estado = 1
					 // and ds.id = ef.id_datos_sesiones
					 // and s.id = ds.id_sesion
					 // and ds.estado = 1
					 // and s.estado = 1
					 // group by s.id, ds.fecha_sesion, ds.id
					 // order by ds.id");
					 
					 $command = $connection->createCommand("select s.descripcion, ds.duracion_sesion
															  from semilleros_tic.sesiones as s, semilleros_tic.datos_sesiones as ds, semilleros_tic.ejecucion_fase_ii as ef
															 where ef.id_fase = ".$faseO."
															   and ef.anio = ".$idAnio."
															   and ef.estado = 1
															   and ds.id = ef.id_datos_sesiones
															   and s.id = ds.id_sesion
															   and ds.estado = 1
															   and s.estado = 1
														  group by s.id, ds.fecha_sesion, ds.id
														  order by ds.id");
					$result3 = $command->queryAll();
					foreach($result3 as $key){
						$otrosDatosEjecucionFase1[]=$key;
					}
					
					//se asignan indices numericos a los resultados
					foreach($otrosDatosEjecucionFase1 as $d => $valor) //se saca el indice
					{
						foreach($valor as $v) //se recorre el array valor y se le cambian los indices
						{
							
							$datosEF1[$d][]=$v;
						}
					}
					
					
					//para pasar el array a texto para mostrarlos
					// $duracionSesiones = "";
					foreach($datosEF1 as $key){
						
						$duracionSesiones[]=$key[0].": ".$key[1];
						
					}
					$duracionSesiones = implode(",",$duracionSesiones);
					
					
					//para traer los recursos tic usados
					
					// $command = $connection->createCommand("select arf.tic
						// from semilleros_tic.acciones_recursos_fase_ii as arf, semilleros_tic.datos_sesiones as ds, semilleros_tic.ejecucion_fase_ii as ef, semilleros_tic.datos_ieo_profesional as dip
						// where arf.id_ciclo = ".$idCiclo."
						// and arf.id_datos_sesion = ds.id
						// and arf.estado = 1
						// and arf.id_datos_sesion = ef.id_datos_sesiones
						// and ef.id_ciclo = ".$idCiclo."
						// and ef.id_fase = ".$faseO."
						// and ef.estado = 1
						// and ds.estado = 1
						// and ef.id_datos_ieo_profesional = dip.id
						// and dip.id_institucion = ".$idInstitucion."
						// and dip.id_sede = ".$idSedes."");
						
					$command = $connection->createCommand("select arf.tic
															 from semilleros_tic.acciones_recursos_fase_ii as arf, 
															      semilleros_tic.datos_sesiones as ds, 
																  semilleros_tic.ejecucion_fase_ii as ef, 
																  semilleros_tic.datos_ieo_profesional as dip
															where arf.anio = ".$idAnio."
															  and arf.id_datos_sesion = ds.id
															  and arf.estado = 1
															  and arf.id_datos_sesion = ef.id_datos_sesiones
															  and ef.anio = ".$idAnio."
															  and ef.id_fase = ".$faseO."
															  and ef.estado = 1
															  and ds.estado = 1
															  and ef.id_datos_ieo_profesional = dip.id
															  and dip.id_institucion = ".$idInstitucion."
															  and dip.id_sede = ".$idSedes."");
					$result3 = $command->queryAll();
					
					$recursosTic = $this->arrayArrayComas($result3,'tic');
					
					
					//para traer sesiones realizadas
					// $command = $connection->createCommand("select count(ds.fecha_sesion) as sesiones_realizadas
						// from semilleros_tic.datos_sesiones as ds, 
						// semilleros_tic.ejecucion_fase_ii as ef, semilleros_tic.datos_ieo_profesional as dip
						// where ds.id = ef.id_datos_sesiones
						// and ef.id_ciclo = ".$idCiclo."
						// and ef.id_fase = ".$faseO."
						// and ef.estado = 1
						// and ds.estado = 1
						// and ef.id_datos_ieo_profesional = dip.id
						// and dip.id_institucion = ".$idInstitucion."
						// and dip.id_sede = ".$idSedes."");
						
					$command = $connection->createCommand("select count(ds.fecha_sesion) as sesiones_realizadas
															 from semilleros_tic.datos_sesiones as ds, 
																  semilleros_tic.ejecucion_fase_ii as ef, 
																  semilleros_tic.datos_ieo_profesional as dip
															where ds.id = ef.id_datos_sesiones
															  and ef.anio = ".$idAnio."
															  and ef.id_fase = ".$faseO."
															  and ef.estado = 1
															  and ds.estado = 1
															  and ef.id_datos_ieo_profesional = dip.id
															  and dip.id_institucion = ".$idInstitucion."
															  and dip.id_sede = ".$idSedes."");
					$result4 = $command->queryAll();
					
					$sesionesRealizadas = $result4[0]['sesiones_realizadas'];
					
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
									$data['contenido'].=$total_docentes_ieo;
									$data['contenido'].="</div>";
									
									break;
								case 1:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$asignaturas;
									$data['contenido'].="</div>";
									
									break;
								case 2:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$especiaidad;
									$data['contenido'].="</div>";
									
									break;
								case 3:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$sesionesRealizadas;
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
									$data['contenido1'].=$frecuenciaSesionesDescripcion;
									$data['contenido1'].="</div>";
									
									break;
								case 1:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$duracionSesiones;
									$data['contenido1'].="</div>";
									
									break;
								case 2:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$numero_apps_desarrolladas;  
									$data['contenido1'].="</div>";
									
									break;
								case 3:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$recursosTic;
									$data['contenido1'].="</div>";
									
									break;
								
							}
					}
					
				} //else
		} //fase 2
	elseif($faseO == 3){
		
		$datosEjecucionFase2 =array();
				
								
				// $command = $connection->createCommand("select ai.total_docentes, ef.asignatura, ai.especialidad, ef.numero_apps_usadas, ef.tic
				// from semilleros_tic.anio as a, semilleros_tic.ciclos as c, semilleros_tic.fases as f, 
				// semilleros_tic.ejecucion_fase_iii as ef, semilleros_tic.datos_ieo_profesional as dip, 
				// semilleros_tic.datos_sesiones as ds, semilleros_tic.acuerdos_institucionales as ai
				// where a.descripcion = '$idAnio'
				// and c.id = $idCiclo
				// and c.id_anio = a.id
				// and f.id = $faseO 
				// and ef.id_fase = f.id 
				// and dip.id = ef.id_datos_ieo_profesional 
				// and dip.id_institucion = ".$idInstitucion." 
				// and dip.id_sede = ".$idSedes."
				// and ai.id_fase = $faseO
				// and ai.id_ciclo = $idCiclo
				// group by ef.id, ai.total_docentes, ef.asignatura, ai.especialidad, ef.numero_apps_usadas,ef.tic
				// ");
				
				$command = $connection->createCommand("select ai.total_docentes, ef.asignatura, ai.especialidad, ef.numero_apps_usadas, ef.tic
														 from semilleros_tic.fases as f, 
															  semilleros_tic.ejecucion_fase_iii as ef, 
															  semilleros_tic.datos_ieo_profesional as dip, 
															  semilleros_tic.datos_sesiones as ds, 
															  semilleros_tic.acuerdos_institucionales as ai
														where f.id = $faseO 
														  and ef.id_fase = f.id 
														  and dip.id = ef.id_datos_ieo_profesional 
														  and dip.id_institucion = ".$idInstitucion." 
														  and dip.id_sede = ".$idSedes."
														  and ai.id_fase = $faseO
														  and ai.anio = $idAnio
													 group by ef.id, ai.total_docentes, ef.asignatura, ai.especialidad, ef.numero_apps_usadas,ef.tic
														");
				$result1 = $command->queryAll();
				
				//se llena el resultado de la consulta en un array
				foreach($result1 as $key){
					$datosEjecucionFase2[]=$key;
				}
				
				$datosEF =array();
				//se asignan indices numericos a los resultados
				foreach($datosEjecucionFase2 as $d => $valor) //se saca el indice
				{
					foreach($valor as $v) //se recorre el array valor y se le cambian los indices
					{
						
						$datosEF[$d][]=$v;
					}
				}
				
				if (count($datosEF) < 1){
					$data['mensaje']="No se encontraron datos almacenados";
					
				}
				else{  //si se encontraron datos almacenados
					// echo "si tiene";
				
					// se unen los resultados para mostrar
					$total_docentes_ieo=0;
					$asignaturas = "";
					$especiaidad = "";
					$numero_apps_usadas = 0;
					$tic="";
					
					$contador=0;
				
					foreach($datosEF as $key => $value){
						
						foreach($value as $val)
						{
							switch ($contador) 
							{
								case 0:
									$total_docentes_ieo = $val;
									break;
								case 1:
									$asignaturas .= $val.", ";
									break;
								case 2:
									$especiaidad =$val;
									break;
								case 3:
									$numero_apps_usadas += $val;
									break;
								case 4:
									$tic .= $val.", ";
									break;
								
							}
							$contador++;
						}
						$contador=0;
						
					}
					
					//para traer la duracion de cada sesion  
					$otrosDatosEjecucionFase1 =array();
					// $command = $connection->createCommand("select s.descripcion, ds.duracion_sesion
					 // from semilleros_tic.sesiones as s, semilleros_tic.datos_sesiones as ds, semilleros_tic.ejecucion_fase_iii as ef
					 // where ef.id_fase = ".$faseO."
					 // and ef.id_ciclo = ".$idCiclo."
					 // and ef.estado = 1
					 // and ds.id = ef.id_datos_sesion
					 // and s.id = ds.id_sesion
					 // and ds.estado = 1
					 // and s.estado = 1
					 // group by s.id, ds.fecha_sesion, ds.id
					 // order by ds.id");
					 
					 $command = $connection->createCommand("select s.descripcion, ds.duracion_sesion
															  from semilleros_tic.sesiones as s, 
																   semilleros_tic.datos_sesiones as ds, 
																   semilleros_tic.ejecucion_fase_iii as ef
															 where ef.id_fase = ".$faseO."
															   and ef.anio = ".$idAnio."
															   and ef.estado = 1
															   and ds.id = ef.id_datos_sesion
															   and s.id = ds.id_sesion
															   and ds.estado = 1
															   and s.estado = 1
														  group by s.id, ds.fecha_sesion, ds.id
														  order by ds.id");
					$result3 = $command->queryAll();
					foreach($result3 as $key){
						$otrosDatosEjecucionFase1[]=$key;
					}
					
					//se asignan indices numericos a los resultados
					foreach($otrosDatosEjecucionFase1 as $d => $valor) //se saca el indice
					{
						foreach($valor as $v) //se recorre el array valor y se le cambian los indices
						{
							
							$datosEF1[$d][]=$v;
						}
					}
					
					
					//para pasar el array a texto para mostrarlos
					// $duracionSesiones = "";
					foreach($datosEF1 as $key){
						
						$duracionSesiones[]=$key[0].": ".$key[1];
						
					}
					$duracionSesiones = implode(",",$duracionSesiones);
					
				
				
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
									$data['contenido'].=$total_docentes_ieo;
									$data['contenido'].="</div>";
									
									break;
								case 1:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$asignaturas;
									$data['contenido'].="</div>";
									
									break;
								case 2:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].=$especiaidad;
									$data['contenido'].="</div>";
									
									break;
								case 3:
									$data['contenido'].="<div class='col-xs-3' >";
									$data['contenido'].="";
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
									$data['contenido1'].=$duracionSesiones;
									$data['contenido1'].="</div>";
									
									break;
								case 1:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$numero_apps_usadas;
									$data['contenido1'].="</div>";
									
									break;
								case 2:
									$data['contenido1'].="<div class='col-xs-3' >";
									$data['contenido1'].=$tic;  
									$data['contenido1'].="</div>";
									
									break;
								// case 3:
									// $data['contenido1'].="<div class='col-xs-3' >";
									// $data['contenido1'].="";
									// $data['contenido1'].="</div>";
									
									// break;
								
							}
					}
				
				} //else
				
		
	} //fase 3
		
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
