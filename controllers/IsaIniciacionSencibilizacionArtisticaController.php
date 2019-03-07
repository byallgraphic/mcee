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
use app\models\IsaIniciacionSencibilizacionArtistica;
use app\models\Sedes;
use app\models\Instituciones;
use app\models\IsaProyectosGenerales;

use yii\helpers\ArrayHelper;
use app\models\IsaActividadesIsa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Collapse;

/**
 * IsaIniciacionSencibilizacionArtisticaController implements the CRUD actions for IsaIniciacionSencibilizacionArtistica model.
 */
class IsaIniciacionSencibilizacionArtisticaController extends Controller
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
     * Lists all IsaIniciacionSencibilizacionArtistica models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => IsaIniciacionSencibilizacionArtistica::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'guardado' => $guardado,
        ]);
    }

    function actionViewFases($model, $form)
	{
        
        $proyectos = new IsaProyectosGenerales();
        $actividades_isa = new IsaActividadesIsa();
		
		
		//tipo_proyecto diferenciador para usar la misma tabla para varios proyectos
		$proyectos = $proyectos->find()->andWhere("tipo_proyecto = 1")->orderby("id")->all();
		$proyectos = ArrayHelper::map($proyectos,'id','descripcion');
		
		
		$items = [];

		foreach( $proyectos as $idProyecto => $titulo )
		{
			

			$items[] = 	[
							'label' 		=>  $titulo,
							'content' 		=>  $this->renderAjax( 'faseItem', 
															[  
																'form' => $form,
																"model" => $model,
																'idProyecto' => $idProyecto,
																'actividades_isa' => $actividades_isa
																
															] 
												),
							'contentOptions'=> []
						];
						
		}

	

		echo Collapse::widget([
			'items' => $items,
		]);
		
	}

    /**
     * Displays a single IsaIniciacionSencibilizacionArtistica model.
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
     * Creates a new IsaIniciacionSencibilizacionArtistica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IsaIniciacionSencibilizacionArtistica();

        if ($model->load(Yii::$app->request->post())) 
		{
				
            if($model->save())
			{
                $isa_id = $model->id;
				$data = Yii::$app->request->post('IsaActividadesIsa');
					
				$arrayDatos = $data;
				
				foreach($data as $datos => $valores)
				{
					$arrayDatos[$datos]['id_iniciacion_sencibilizacion_artistica']=$isa_id;
				}
			
				// echo "<pre>"; print_r( $arrayDatos ); echo "</pre>"; 
				// die;
			
				
				// $columnNameArray = 
				// [
				// 'fecha_prevista_desde',
				// 'fecha_prevista_hasta',
				// 'num_equipo_campo',
				// 'perfiles',
				// 'docente_orientador',
				// 'fases',
				// 'num_encuentro',
				// 'nombre_actividad',
				// 'actividad_desarrollar',
				// 'lugares_recorrer',
				// 'tematicas_abordadas',
				// 'objetivos_especificos',
				// 'tiempo_previsto',
				// 'productos',
				// 'cotenido_si_no',
				// 'contenido_nombre',
				// 'contenido_fecha',
				// 'cotenido_vigencia',
				// 'contenido_justificacion',
				// 'arcticulacion',
				// 'cantidad_participantes',
				// 'requerimientos_tecnicos',
				// 'requerimientos_logisticos',
				// 'destinatarios',
				// 'fecha_entega_envio',
				// 'observaciones_generales',
				// 'nombre_diligencia',
				// 'rol',
				// 'fecha',
				// 'id_procesos_generales',
				// 'id_iniciacion_sencibilizacion_artistica'
				// ];
				// $insertCount = Yii::$app->db->createCommand()
                   // ->batchInsert(
                         // 'isa.actividades_isa', $columnNameArray, $arrayDatos
                     // )
					 // ->execute();

                
            }
           
            return $this->redirect(['index', 'guardado' => 1]);
        }
		
		$idInstitucion = $_SESSION['instituciones'][0];
		$institucion = Instituciones::findOne($idInstitucion);
        $Sedes  = Sedes::find()->where( "id_instituciones = $idInstitucion" )->all();
        $sedes	= ArrayHelper::map( $Sedes, 'id', 'descripcion' );

       
        return $this->renderAjax('create', [
            'model' => $model,
            'sedes' => $sedes,
            'institucion' => $institucion->descripcion,
        ]);
    }

    /**
     * Updates an existing IsaIniciacionSencibilizacionArtistica model.
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
     * Deletes an existing IsaIniciacionSencibilizacionArtistica model.
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
     * Finds the IsaIniciacionSencibilizacionArtistica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IsaIniciacionSencibilizacionArtistica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IsaIniciacionSencibilizacionArtistica::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
