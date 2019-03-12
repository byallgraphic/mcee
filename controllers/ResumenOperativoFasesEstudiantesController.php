<?php
/**********
Versión: 001
Fecha: 2018-09-03
Desarrollador: Edwin Molina Grisales
Descripción: RESUMEN OPERATIVO FASES ESTUDIANTES
---------------------------------------
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
use app\models\EcDatosBasicos;
use app\models\EcDatosBasicosBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\EcPlaneacion;
use app\models\EcReportes;
use app\models\EcVerificacion;
use app\models\Parametro;
use yii\helpers\ArrayHelper;
/**
 * EcDatosBasicosController implements the CRUD actions for EcDatosBasicos model.
 */
class ResumenOperativoFasesEstudiantesController extends Controller
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
     * Lists all EcDatosBasicos models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $connection = Yii::$app->getDb();
		$command = $connection->createCommand("
        SELECT	dip.id ,i.codigo_dane as codigo_dane_institucion, i.descripcion as institucion, s.codigo_dane as codigo_dane_sede,
                        s.descripcion as sede, 
                        i.id as id_institucion, 
                        s.id as id_sede, 
                        a.descripcion as anio, 
                        fa.descripcion as fase,
                        sdi.profecional_a,
                        sdi.id as id_semilleros,
                        dip.curso_participantes
        FROM 	semilleros_tic.datos_ieo_profesional_estudiantes as dip,public.sedes as s,public.instituciones as i, semilleros_tic.anio as a, 
                semilleros_tic.fases as fa,	semilleros_tic.ejecucion_fase_i_estudiantes as ef, semilleros_tic.semilleros_datos_ieo_estudiantes as sdi
        WHERE 	dip.id_institucion = i.id
        AND		dip.id_sede = s.id
        AND 	dip.estado = 1
        AND 	sdi.id_institucion =dip.id_institucion
        AND 	sdi.id_sede = dip.id_sede 
        GROUP BY 
			dip.id,
			i.codigo_dane,
			i.descripcion, 
			s.codigo_dane, 
			s.descripcion,i.id,s.id, a.descripcion,
			fa.descripcion,sdi.profecional_a, sdi.id
        ORDER BY i.id,s.id");
        $datos_ieo_profesional = $command->queryAll();
		$idSedes 		= $_SESSION['sede'][0];

        //echo "<pre>"; print_r($datos_ieo_profesional); echo "</pre>";
        $data[$idSedes] = [];
        foreach ($datos_ieo_profesional as $dip)
		{
            if($dip['id_sede'] == $idSedes && $dip["anio"] = Yii::$app->request->get("anio"))
			{
                array_push($data[$idSedes], $dip);
            }
			
			// else if($dip['id_sede'] == '49'){
                // array_push($data['49'], $dip);
            // }
        }
		
		// echo "<pre>"; print_r($data); echo "</pre>";
		
		
        $contador =0;
        $totalDatos = [];
		foreach ($data as $dip)
		{
           if(!empty($dip)){
                    $data= [];
                    $idInstitucion = $dip[0]['id_institucion'];
                    $idSede = $dip[0]['id_sede'];
                
                    //nombres de los profesional a
                    $idProfesionalA = $dip[0]['profecional_a'];
                    $command = $connection->createCommand
                    ("
                        SELECT concat(p.nombres,' ',p.apellidos) as nombre		
                        FROM public.personas as p
                        WHERE id in($idProfesionalA)
                    ");
                    $datoPersonalA = $command->queryAll();	
                    $nomresPersonalA = $this->arrayArrayComas($datoPersonalA,'nombre');

                    //obtener las fecha de inicio de semillero con respecto a la sesion 1
                    $command = $connection->createCommand
                    ("
                        SELECT dts.fecha_sesion 
                        FROM semilleros_tic.datos_sesiones as dts
                        join semilleros_tic.ejecucion_fase_i_estudiantes as efe on efe.id_datos_sesion = dts.id
                        join semilleros_tic.datos_ieo_profesional_estudiantes dpro on efe.id_datos_ieo_profesional_estudiantes = dpro.id
                        WHERE dts.id_sesion = 1 and dpro.id_sede =  $idSede ORDER BY dts.id desc 
                    ");
                    $fechas = $command->queryAll();

                  
                    
                    array_push($data, $dip[0]['codigo_dane_institucion'], $dip[0]['institucion'], $dip[0]['codigo_dane_sede'],$dip[0]['sede'],  $dip[0]['anio'], $nomresPersonalA, @$fechas[0]['fecha_sesion']);
                    
                    
                /**Inicio datos fases 1 */
                    $id_datos_ieo_profesional1 = $dip[0]['id'];
                    $idSemilleros1 = $dip[0]['id_semilleros'];
                    $command = $connection->createCommand
                    ("
                        SELECT 
                        frecuencia_sesiones, curso
                        FROM semilleros_tic.acuerdos_institucionales_estudiantes
                        WHERE id_semilleros_datos_estudiantes = $idSemilleros1 and id_fase = 1
                    ");

                    $datoAcuerdosInstitucionales = $command->queryAll();
                    $frecuenciaSesion1 = $this->arrayArrayComas($datoAcuerdosInstitucionales,'frecuencia_sesiones') != "" ? $this->arrayArrayComas($datoAcuerdosInstitucionales,'frecuencia_sesiones') : "0" ;
                    $cursoSesion1 = $this->arrayArrayComas($datoAcuerdosInstitucionales,'curso') != "" ? $this->arrayArrayComas($datoAcuerdosInstitucionales,'curso') : "0" ;

					
					 
                    /**Obtiene nombres descriptivos en base a los id's de las sesiones */
                    $command = $connection->createCommand("
                    SELECT descripcion
                    FROM public.parametro
                    WHERE id in($frecuenciaSesion1)
                    ORDER BY id ASC ");
                    $frecuenciasSesiones = $command->queryAll();
                    $frecuenciasSesiones= $this->arrayArrayComas($frecuenciasSesiones,'descripcion'); 
                    array_push($data,$frecuenciasSesiones);
                    
                    //Duracion promedio de las sesiones
                    //Datos generales de las sesiones

                    $command = $connection->createCommand
                    ("
                        SELECT 
                        dts.duracion_sesion
                        FROM semilleros_tic.ejecucion_fase_i_estudiantes as  efe
                        inner join semilleros_tic.datos_sesiones as dts on dts.id = efe.id_datos_sesion
                        WHERE id_datos_ieo_profesional_estudiantes = $id_datos_ieo_profesional1 
                    ");
                    $datoSemillerosTicEjecucionFase1 = $command->queryAll();
					
						
                    $segundos = 0;
                    foreach ($datoSemillerosTicEjecucionFase1 as $datosSTEF => $valor)
					{ 
                        $segundos += $this->conversionSegundos($valor['duracion_sesion']);
                    }
                    $promedioHorasFase1  = @($segundos / count($datoSemillerosTicEjecucionFase1));
                    $promedioHorasFase1 =  $this->conversionSegundosHora($promedioHorasFase1);
                    

                    /**Obtiene nombre de los cursos para fase 1 */
                    $command = $connection->createCommand("
                    SELECT descripcion
                    FROM public.paralelos
                    WHERE id in($cursoSesion1)
                    ORDER BY id ASC ");
                    $cusosSesiones = $command->queryAll();
                    $cusosSesiones= $this->arrayArrayComas($cusosSesiones,'descripcion');
                    array_push($data, $promedioHorasFase1, $cusosSesiones);
					
                    $command = $connection->createCommand("
                        SELECT
                            dts.fecha_sesion,
                            efe.apps_creadas,
                            efe.participacion_sesiones,
                            dts.duracion_sesion
                        FROM semilleros_tic.ejecucion_fase_i_estudiantes efe
                        inner join semilleros_tic.datos_sesiones dts on dts.id = efe.id_datos_sesion
                        WHERE id_datos_ieo_profesional_estudiantes = $id_datos_ieo_profesional1
                        AND efe.estado = 1
                        ORDER BY efe.id ASC
                        ");
                    $datosEjeccionFasei = $command->queryAll();
                    $promedioParticipantes1 = 0;
                    $maxSesion1 = 0;

                    if(count($datosEjeccionFasei) > 0){
                        foreach ($datosEjeccionFasei as $datos1 => $valor){
                            @$totalapps1 += $valor['apps_creadas'];
                            @$totalparticipantes1  += $valor['participacion_sesiones'];
                            array_push($data, "", $valor['fecha_sesion'], $valor['participacion_sesiones'], $valor['duracion_sesion']);
                            $promedioParticipantes1 += $valor['participacion_sesiones'];
                            $maxSesion1 = $valor['participacion_sesiones'];
                        }
                        $promedioParticipantes1 =  $promedioParticipantes1 / count($datosEjeccionFasei);
                        /**rellena la cantidad de sesiones vacias */
                        /*$restantes = 6 - count($datosEjeccionFasei);
                        if($restantes > 0 ){
                            for ($i=0; $i < $restantes; $i++) {
                                array_push($data, "", "", "", "");
                            }
                        }*/
                        array_push($data, count($datosEjeccionFasei), $totalparticipantes1, $totalapps1);
                    }
                /**Fin datos Fase 1 */
             
                /**Inicio datos Fase 2 */
                    $id_datos_ieo_profesional2 = 10;
                    $idSemilleros2 = $dip[1]['id_semilleros'];
                
                    $command = $connection->createCommand
                    ("
                        SELECT 
                        frecuencia_sesiones, curso
                        FROM semilleros_tic.acuerdos_institucionales_estudiantes
                        WHERE id_semilleros_datos_estudiantes = $idSemilleros2 and id_fase = 2
                    ");
                    $datoAcuerdosInstitucionales2 = $command->queryAll();
                    $frecuenciaSesion2 = $this->arrayArrayComas($datoAcuerdosInstitucionales2,'frecuencia_sesiones') != "" ? $this->arrayArrayComas($datoAcuerdosInstitucionales2,'frecuencia_sesiones') : "0" ;
                    $cursoSesion2 = $this->arrayArrayComas($datoAcuerdosInstitucionales2,'curso') != "" ? $this->arrayArrayComas($datoAcuerdosInstitucionales2,'curso') : "0" ;   
                    
                    /**Obtiene nombres descriptivos en base a los id's de las sesiones */
                    $command = $connection->createCommand("
                    SELECT descripcion
                    FROM public.parametro
                    WHERE id in($frecuenciaSesion2)
                    ORDER BY id ASC ");
                    $frecuenciasSesiones2 = $command->queryAll();
                    $frecuenciasSesiones2= $this->arrayArrayComas($frecuenciasSesiones2,'descripcion');

                    array_push($data,$frecuenciasSesiones2);

                    //Duracion promedio de las sesiones
                    //Datos generales de las sesiones
                    $command = $connection->createCommand
                    ("
                        SELECT 
                        dts.duracion_sesion
                        FROM semilleros_tic.ejecucion_fase_ii_estudiantes as  efe
                        inner join semilleros_tic.datos_sesiones as dts on dts.id = efe.id_datos_sesion
                        WHERE efe.id_datos_ieo_profesional_estudiantes = $id_datos_ieo_profesional2 
                    ");

                    $datoSemillerosTicEjecucionFase2 = $command->queryAll();
                    $segundos2 = 0;
                    foreach ($datoSemillerosTicEjecucionFase2 as $datosSTEF => $valor){ 
                        $segundos2 += $this->conversionSegundos($valor['duracion_sesion']);
                    }
                    $promedioHorasFase2  = @($segundos2 / count($datoSemillerosTicEjecucionFase2));
                    $promedioHorasFase2 =  $this->conversionSegundosHora($promedioHorasFase2);

                    /**Obtiene nombre de los cursos para fase 1 */
                    $command = $connection->createCommand("
                    SELECT descripcion
                    FROM public.paralelos
                    WHERE id in($cursoSesion2)
                    ORDER BY id ASC ");
                    $cusosSesiones2 = $command->queryAll();
                    $cusosSesiones2= $this->arrayArrayComas($cusosSesiones2,'descripcion');
                    array_push($data, $promedioHorasFase2, $cusosSesiones2);

                    $command = $connection->createCommand("
                        SELECT
                            dts.fecha_sesion,
                            efe.apps_desarrolladas,
                            efe.estudiantes_participantes,
                            dts.duracion_sesion
                        FROM semilleros_tic.ejecucion_fase_ii_estudiantes efe
                        inner join semilleros_tic.datos_sesiones dts on dts.id = efe.id_datos_sesion
                        WHERE id_datos_ieo_profesional_estudiantes = $id_datos_ieo_profesional2
                        AND efe.estado = 1
                        ORDER BY efe.id ASC
                        ");
                    $datosEjeccionFaseii = $command->queryAll();
                    $promedioParticipantes2 = 0;
                    $maxSesion2 = 0;
                    if(count($datosEjeccionFaseii) > 0){
                        foreach ($datosEjeccionFaseii as $datos1 => $valor){
                            @$totalapps2 += $valor['apps_desarrolladas'];
                            @$totalparticipantes2  += $valor['estudiantes_participantes'];
                            array_push($data, "", $valor['fecha_sesion'], $valor['estudiantes_participantes'], $valor['duracion_sesion']);
                            $promedioParticipantes2 += $valor['estudiantes_participantes'];
                            $maxSesion2++;
                        }
                        $promedioParticipantes2 = ($promedioParticipantes2 / count($datosEjeccionFaseii));
                        /**rellena la cantidad de sesiones vacias */
                        /*$restantes = 6 - count($datosEjeccionFaseii);
                        if($restantes > 0 ){
                            for ($i=0; $i < $restantes; $i++) { 
                                array_push($data, "", "", "", "");
                            }
                        }*/
                        array_push($data, count($datosEjeccionFaseii), $totalparticipantes2, $totalapps2);
                    }
                /**Fin fase 2 */

                /**Inicio datos Fase 3 */
                    $id_datos_ieo_profesional3 = $dip[2]['id'];
                    $idSemilleros3 = $dip[2]['id_semilleros'];

                    $command = $connection->createCommand
                    ("
                        SELECT 
                        frecuencia_sesiones, curso
                        FROM semilleros_tic.acuerdos_institucionales_estudiantes
                        WHERE id_semilleros_datos_estudiantes = $idSemilleros3 and id_fase = 3
                    ");
                    $datoAcuerdosInstitucionales3 = $command->queryAll();
                    $frecuenciaSesion3 = $this->arrayArrayComas($datoAcuerdosInstitucionales3,'frecuencia_sesiones') != "" ? $this->arrayArrayComas($datoAcuerdosInstitucionales3,'frecuencia_sesiones') : "0" ;
                    $cursoSesion3 = $this->arrayArrayComas($datoAcuerdosInstitucionales3,'curso') != "" ? $this->arrayArrayComas($datoAcuerdosInstitucionales3,'curso') : "0" ;  

                    /**Obtiene nombres descriptivos en base a los id's de las sesiones */
                    $command = $connection->createCommand("
                    SELECT descripcion
                    FROM public.parametro
                    WHERE id in($frecuenciaSesion3)
                    ORDER BY id ASC ");
                    $frecuenciasSesiones3 = $command->queryAll();
                    $frecuenciasSesiones3= $this->arrayArrayComas($frecuenciasSesiones3,'descripcion');    

                    array_push($data,$frecuenciasSesiones3);

                    //Duracion promedio de las sesiones
                    //Datos generales de las sesiones
                    
                    $command = $connection->createCommand
                    ("
                        SELECT 
                        dts.duracion_sesion
                        FROM semilleros_tic.ejecucion_fase_iii_estudiantes as  efe
                        inner join semilleros_tic.datos_sesiones as dts on dts.id = efe.id_datos_sesion
                        WHERE efe.id_datos_ieo_profesional_estudiantes = $id_datos_ieo_profesional3
                    ");
                    $datoSemillerosTicEjecucionFase3 = $command->queryAll();
                    $segundos3 = 0;
                    foreach ($datoSemillerosTicEjecucionFase3 as $datosSTEF => $valor){ 
                        $segundos3 += $this->conversionSegundos($valor['duracion_sesion']);
                    }
                    $promedioHorasFase3  = @($segundos3 / count($datoSemillerosTicEjecucionFase3));
                    $promedioHorasFase3 =  $this->conversionSegundosHora($promedioHorasFase3);

                    /**Obtiene nombre de los cursos para fase 1 */
                    $command = $connection->createCommand("
                    SELECT descripcion
                    FROM public.paralelos
                    WHERE id in($cursoSesion3)
                    ORDER BY id ASC ");
                    $cusosSesiones3 = $command->queryAll();
                    $cusosSesiones3= $this->arrayArrayComas($cusosSesiones3,'descripcion');
                    array_push($data, $promedioHorasFase3, $cusosSesiones3);

                    $command = $connection->createCommand("
                    SELECT
                        dts.fecha_sesion,
                        efe.numero_apps,
                        efe.estudiantes_participantes,
                        dts.duracion_sesion
                    FROM semilleros_tic.ejecucion_fase_iii_estudiantes efe
                    inner join semilleros_tic.datos_sesiones dts on dts.id = efe.id_datos_sesion
                    WHERE id_datos_ieo_profesional_estudiantes = $id_datos_ieo_profesional3
                    AND efe.estado = 1
                    ORDER BY efe.id ASC
                    ");
                    $datosEjeccionFaseiii = $command->queryAll();
                    $promedioParticipantes3 = 0;
                    $maxSesion3 = 0;
                    if(count($datosEjeccionFaseiii) > 0){

                        foreach ($datosEjeccionFaseiii as $datos1 => $valor){
                            @$totalapps3 += $valor['numero_apps'];
                            @$totalparticipantes3  += $valor['estudiantes_participantes'];
                            array_push($data, "", $valor['fecha_sesion'], $valor['estudiantes_participantes'], $valor['duracion_sesion']);
                            $promedioParticipantes3 += $valor['estudiantes_participantes'];
                            $maxSesion3++;
                        }
                        $promedioParticipantes3 =  $promedioParticipantes3 / count($datosEjeccionFaseiii);
                        /**rellena la cantidad de sesiones vacias */
                        /*$restantes3 = 6 - count($datosEjeccionFaseiii);
                        if($restantes > 0 ){
                            for ($i=0; $i < $restantes; $i++) { 
                                array_push($data, "", "", "", "");
                            }
                        }*/
                        array_push($data, count($datosEjeccionFaseiii), $totalparticipantes3, $totalapps3);
                    }
                /**Fin datos fase 3 */
                array_push($data, ($promedioParticipantes1 + $promedioParticipantes2 + $promedioParticipantes3) / 3 ,(count($datosEjeccionFaseiii) + count($datosEjeccionFaseii) + count($datosEjeccionFasei)));

                array_push($totalDatos, $data);
				
                $contador++;
            }
        }
        
        
        $searchModel = new EcDatosBasicosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $totalDatos,
            'maxSesion1' => $maxSesion1,
            'maxSesion2' => $maxSesion2,
            'maxSesion3' => $maxSesion3
        ]);
    }

    public function conversionSegundos($hora)
	{
        list($horas, $minutos) = explode(':',$hora);
        $hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 );
    
    return $hora_en_segundos;
    }
    

	public function conversionSegundosHora($segundos) { 
        $h = floor($segundos / 3600); 
        $m = floor(($segundos % 3600) / 60); 
        
        return sprintf('%02d:%02d', $h, $m); 
    }

    public function arrayArrayComas($array,$nombrePos)
	{   
        $datos = [];
		foreach ($array as $ar)
		{	  
			$datos[] = $ar[$nombrePos];
        }
		return  implode(",",$datos);
	}

    /**
     * Displays a single EcDatosBasicos model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EcDatosBasicos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelDatosBasico 	= new EcDatosBasicos();
        $modelPlaneacion	= new EcPlaneacion();
        $modelVerificacion	= new EcVerificacion();
        $modelReportes		= new EcReportes();

        if ($modelDatosBasico->load(Yii::$app->request->post()) && $modelDatosBasico->save()) {
            return $this->redirect(['view', 'id' => $modelDatosBasico->id]);
        }
		
		$dataTiposVerificacion = Parametro::find()
									->where( 'id_tipo_parametro=12' )
									->andWhere( 'estado=1' )
									->all();
									
		$tiposVerificacion = ArrayHelper::map( $dataTiposVerificacion, 'id', 'descripcion' );

        return $this->render('create', [
            'modelDatosBasico' 	=> $modelDatosBasico,
            'modelPlaneacion' 	=> $modelPlaneacion,
            'modelVerificacion' => $modelVerificacion,
            'modelReportes' 	=> $modelReportes,
            'tiposVerificacion'	=> $tiposVerificacion,
        ]);
    }

    /**
     * Updates an existing EcDatosBasicos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EcDatosBasicos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EcDatosBasicos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EcDatosBasicos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EcDatosBasicos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
