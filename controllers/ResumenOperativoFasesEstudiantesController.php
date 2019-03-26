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
		$anio = Yii::$app->request->get('anio');
		$esDocente = Yii::$app->request->get('esDocente');

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

        //echo "<pre>"; print_r($datos_ieo_profesional); echo "</pre>";
        $data = [];
        foreach ($datos_ieo_profesional as $key =>  $dip)
        {
            if($dip["anio"] = Yii::$app->request->get("anio"))
            {
                $data[$dip['id_sede']] =  $dip;
            }
        }
        $contador =0;
        $totalDatos = [];
        $maxSesionFaseI = 0;
        $maxSesionFaseII = 0;
        $maxSesionFaseIII = 0;
        $mayorSesion = [];
        foreach ($data as $key => $dip)
        {
            if(!empty($dip)){
                $data= [];
                $idInstitucion = $dip['id_institucion'];
                $idSede = $dip['id_sede'];

                //nombres de los profesional a
                $idProfesionalA = $dip['profecional_a'];
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
                    WHERE dpro.id_sede =  $idSede 
                ");
                $fechas = $command->queryAll();

                //array_push($data, $dip['codigo_dane_institucion'], $dip['institucion'], $dip['codigo_dane_sede'],$dip['sede'],  $dip['anio'], $nomresPersonalA, @$fechas[0]['fecha_sesion']);

                $data['datos_ieo']['codigo_dane_institucion'] = $dip['codigo_dane_institucion'];
                $data['datos_ieo']['institucion'] = $dip['institucion'];
                $data['datos_ieo']['codigo_dane_sede'] = $dip['codigo_dane_sede'];
                $data['datos_ieo']['sede'] = $dip['sede'];
                $data['datos_ieo']['nombre_profesional'] = $nomresPersonalA;


                /**Inicio datos fases 1 */
                $id_datos_ieo_profesional1 = $dip['id'];
                $idSemilleros1 = $dip['id_semilleros'];
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
                //array_push($data,$frecuenciasSesiones);
                $data['fase_1']['frecuencia_sesion'] = $frecuenciasSesiones;

                //Duracion promedio de las sesiones
                //Datos generales de las sesiones

                $command = $connection->createCommand
                ("
                    SELECT 
                    dts.duracion_sesion
                    FROM semilleros_tic.datos_sesiones as dts
                    join semilleros_tic.ejecucion_fase_i_estudiantes as efe on efe.id_datos_sesion = dts.id
                    join semilleros_tic.datos_ieo_profesional_estudiantes dpro on efe.id_datos_ieo_profesional_estudiantes = dpro.id
                    WHERE dpro.id_sede =  $idSede 
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
                //array_push($data, $promedioHorasFase1, $cusosSesiones);
                $data['fase_1']['duracion_promedio'] = $promedioHorasFase1;
                $data['fase_1']['cursos'] = $cusosSesiones;

                $command = $connection->createCommand("
                    SELECT 
                    DISTINCT(dts.id_sesion),
                            dts.fecha_sesion,
                            efe.apps_creadas,
                            efe.participacion_sesiones,
                            dts.duracion_sesion
                    FROM semilleros_tic.datos_sesiones as dts
                    join semilleros_tic.ejecucion_fase_i_estudiantes as efe on efe.id_datos_sesion = dts.id
                    join semilleros_tic.datos_ieo_profesional_estudiantes dpro on efe.id_datos_ieo_profesional_estudiantes = dpro.id
                    WHERE dpro.id_sede =  $idSede 
                    ");
                $datosEjeccionFasei = $command->queryAll();
                $promedioParticipantes1 = 0;

                if ($maxSesionFaseI < count($datosEjeccionFasei)){
                    $maxSesionFaseI = count($datosEjeccionFasei);
                }

                if(count($datosEjeccionFasei) > 0){
                    foreach ($datosEjeccionFasei as $datos1 => $valor){
                        @$totalapps1 += $valor['apps_creadas'];
                        @$totalparticipantes1  += $valor['participacion_sesiones'];
                        //array_push($data, "", $valor['fecha_sesion'], $valor['participacion_sesiones'], $valor['duracion_sesion']);
                        $promedioParticipantes1 += $valor['participacion_sesiones'];

                        $data['fase_1']['sesiones'][$datos1][0] = $datos1;
                        $data['fase_1']['sesiones'][$datos1][1] = $valor['fecha_sesion'];
                        $data['fase_1']['sesiones'][$datos1][2] = $valor['participacion_sesiones'];
                        $data['fase_1']['sesiones'][$datos1][3] = $valor['duracion_sesion'];
                    }

                    $promedioParticipantes1 =  $promedioParticipantes1 / count($datosEjeccionFasei);
                    //array_push($data, count($datosEjeccionFasei), $totalparticipantes1, $totalapps1);

                    $data['fase_1']['total_sesiones'] = count($datosEjeccionFasei);
                    $data['fase_1']['total_participaciones'] = $totalparticipantes1;
                    $data['fase_1']['totalapps'] = $totalapps1;
                }
                /**Fin datos Fase 1 */

                /**Inicio datos Fase 2 */
                $id_datos_ieo_profesional2 = $dip['id'];
                $idSemilleros2 = $dip['id_semilleros'];

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

                //array_push($data,$frecuenciasSesiones2);
                $data['fase_2']['frecuencia_sesion'] = $frecuenciasSesiones2;


                //Duracion promedio de las sesiones
                //Datos generales de las sesiones
                $command = $connection->createCommand
                ("
                    SELECT 
                        dts.duracion_sesion
                    FROM semilleros_tic.datos_sesiones as dts
                    join semilleros_tic.ejecucion_fase_i_estudiantes as efe on efe.id_datos_sesion = dts.id
                    join semilleros_tic.datos_ieo_profesional_estudiantes dpro on efe.id_datos_ieo_profesional_estudiantes = dpro.id
                    WHERE dpro.id_sede =  $idSede 
                    ");

                $datoSemillerosTicEjecucionFase2 = $command->queryAll();
                $segundos2 = 0;
                foreach ($datoSemillerosTicEjecucionFase2 as $datosSTEF => $valor){
                    $segundos2 += $this->conversionSegundos($valor['duracion_sesion']);
                }
                $promedioHorasFase2  = @($segundos2 / count($datoSemillerosTicEjecucionFase2));
                $promedioHorasFase2 =  $this->conversionSegundosHora($promedioHorasFase2);

                /**Obtiene nombre de los cursos para fase 2 */
                $command = $connection->createCommand("
                    SELECT descripcion
                    FROM public.paralelos
                    WHERE id in($cursoSesion2)
                    ORDER BY id ASC ");
                $cusosSesiones2 = $command->queryAll();
                $cusosSesiones2= $this->arrayArrayComas($cusosSesiones2,'descripcion');
                //array_push($data, $promedioHorasFase2, $cusosSesiones2);
                $data['fase_2']['duracion_promedio'] = $promedioHorasFase2;
                $data['fase_2']['cursos'] = $cusosSesiones2;

                $command = $connection->createCommand("
                    SELECT 
                    DISTINCT(dts.id_sesion),
                            dts.fecha_sesion,
                            efe.apps_desarrolladas,
                            efe.estudiantes_participantes,
                            dts.duracion_sesion
                    FROM semilleros_tic.datos_sesiones as dts
                    join semilleros_tic.ejecucion_fase_ii_estudiantes as efe on efe.id_datos_sesion = dts.id
                    join semilleros_tic.datos_ieo_profesional_estudiantes dpro on efe.id_datos_ieo_profesional_estudiantes = dpro.id
                    WHERE dpro.id_sede =  $idSede 
                        ");
                $datosEjeccionFaseii = $command->queryAll();
                $promedioParticipantes2 = 0;
                if ($maxSesionFaseII < count($datosEjeccionFaseii)){
                    $maxSesionFaseII = count($datosEjeccionFaseii);
                }
                if(count($datosEjeccionFaseii) > 0){
                    foreach ($datosEjeccionFaseii as $datos1 => $valor){
                        @$totalapps2 += $valor['apps_desarrolladas'];
                        @$totalparticipantes2  += $valor['estudiantes_participantes'];
                        //array_push($data, "", $valor['fecha_sesion'], $valor['estudiantes_participantes'], $valor['duracion_sesion']);
                        $promedioParticipantes2 += $valor['estudiantes_participantes'];

                        $data['fase_2']['sesiones'][$datos1][0] = $datos1;
                        $data['fase_2']['sesiones'][$datos1][1] = $valor['fecha_sesion'];
                        $data['fase_2']['sesiones'][$datos1][2] = $valor['estudiantes_participantes'];
                        $data['fase_2']['sesiones'][$datos1][3] = $valor['duracion_sesion'];
                    }
                    $promedioParticipantes2 = ($promedioParticipantes2 / count($datosEjeccionFaseii));
                    /**rellena la cantidad de sesiones vacias */

                    //array_push($data, count($datosEjeccionFaseii), $totalparticipantes2, $totalapps2);

                    $data['fase_2']['total_sesiones'] = count($datosEjeccionFaseii);
                    $data['fase_2']['total_participaciones'] = $totalparticipantes2;
                    $data['fase_2']['totalapps'] = $totalapps2;
                }
                /**Fin fase 2 */

                /**Inicio datos Fase 3 */
                $id_datos_ieo_profesional3 = $dip['id'];
                $idSemilleros3 = $dip['id_semilleros'];

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

                //array_push($data,$frecuenciasSesiones3);
                $data['fase_3']['frecuencia_sesion'] = $frecuenciasSesiones3;

                //Duracion promedio de las sesiones
                //Datos generales de las sesiones

                $command = $connection->createCommand
                ("
                    SELECT 
                        dts.duracion_sesion
                    FROM semilleros_tic.datos_sesiones as dts
                    join semilleros_tic.ejecucion_fase_iii_estudiantes as efe on efe.id_datos_sesion = dts.id
                    join semilleros_tic.datos_ieo_profesional_estudiantes dpro on efe.id_datos_ieo_profesional_estudiantes = dpro.id
                    WHERE dpro.id_sede =  $idSede 
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
                //array_push($data, $promedioHorasFase3, $cusosSesiones3);
                $data['fase_3']['duracion_promedio'] = $promedioHorasFase3;
                $data['fase_3']['cursos'] = $cusosSesiones3;

                $command = $connection->createCommand("
                    SELECT 
                    DISTINCT(dts.id_sesion),
                        dts.fecha_sesion,
                        efe.numero_apps,
                        efe.estudiantes_participantes,
                        dts.duracion_sesion
                    FROM semilleros_tic.datos_sesiones as dts
                    join semilleros_tic.ejecucion_fase_iii_estudiantes as efe on efe.id_datos_sesion = dts.id
                    join semilleros_tic.datos_ieo_profesional_estudiantes dpro on efe.id_datos_ieo_profesional_estudiantes = dpro.id
                    WHERE dpro.id_sede =  $idSede 
                    ");
                $datosEjeccionFaseiii = $command->queryAll();
                $promedioParticipantes3 = 0;
                if ($maxSesionFaseIII < count($datosEjeccionFaseiii)){
                    $maxSesionFaseIII = count($datosEjeccionFaseiii);
                }
                if(count($datosEjeccionFaseiii) > 0){
                    foreach ($datosEjeccionFaseiii as $datos1 => $valor){
                        @$totalapps3 += $valor['numero_apps'];
                        @$totalparticipantes3  += $valor['estudiantes_participantes'];
                        //array_push($data, "", $valor['fecha_sesion'], $valor['estudiantes_participantes'], $valor['duracion_sesion']);

                        $data['fase_3']['sesiones'][$datos1][0] = $datos1;
                        $data['fase_3']['sesiones'][$datos1][1] = $valor['fecha_sesion'];
                        $data['fase_3']['sesiones'][$datos1][2] = $valor['estudiantes_participantes'];
                        $data['fase_3']['sesiones'][$datos1][3] = $valor['duracion_sesion'];

                        $promedioParticipantes3 += $valor['estudiantes_participantes'];
                    }
                    $promedioParticipantes3 =  $promedioParticipantes3 / count($datosEjeccionFaseiii);
                    /**rellena la cantidad de sesiones vacias */

                    //array_push($data, count($datosEjeccionFaseiii), $totalparticipantes3, $totalapps3);

                    $data['fase_3']['total_sesiones'] = count($datosEjeccionFaseiii);
                    $data['fase_3']['total_participaciones'] = $totalparticipantes3;
                    $data['fase_3']['totalapps'] = $totalapps3;
                }
                /**Fin datos fase 3 */
                //array_push($data, ($promedioParticipantes1 + $promedioParticipantes2 + $promedioParticipantes3) / 3 ,(count($datosEjeccionFaseiii) + count($datosEjeccionFaseii) + count($datosEjeccionFasei)));


                //array_push($totalDatos, $data);

                if (isset($data['fase_1']['sesiones'][$datos1])){
                    if ($maxSesionFaseI < $data['fase_1']['sesiones'][$datos1][0]){
                        $maxSesionFaseI = $data['fase_1']['sesiones'][$datos1][0];
                    }
                }

                if (isset($data['fase_2']['sesiones'][$datos1])){
                    if ($maxSesionFaseII < $data['fase_2']['sesiones'][$datos1][0]){
                        $maxSesionFaseII = $data['fase_2']['sesiones'][$datos1][0];
                    }
                }

                if (isset($data['fase_3']['sesiones'][$datos1])) {
                    if ($maxSesionFaseIII < $data['fase_3']['sesiones'][$datos1][0]) {
                        $maxSesionFaseIII = $data['fase_3']['sesiones'][$datos1][0];
                    }
                }

                $mayorSesion['maxSesionFaseI'] = $maxSesionFaseI;
                $mayorSesion['maxSesionFaseII'] = $maxSesionFaseII;
                $mayorSesion['maxSesionFaseIII'] = $maxSesionFaseIII;

                $lastSesion = 0;
                if (isset($data['fase_1']['sesiones'])){
                    $lastSesion = array_shift($data['fase_1']['sesiones']);
                }

                $data['datos_ieo']['fecha_inicio_semillero'] = $lastSesion[1];


                $data['total']['promedio'] = ($promedioParticipantes1 + $promedioParticipantes2 + $promedioParticipantes3) / 3 ;
                $data['total']['suma_fases'] = (count($datosEjeccionFaseiii) + count($datosEjeccionFaseii) + count($datosEjeccionFasei));

                $totalDatos[$key] = $data;

                $contador++;
            }

        }

        foreach ($totalDatos AS $key => $dato) {
            if (!isset($dato['fase_1']['sesiones'])){
                $dato['fase_1']['sesiones'] = [];
            }
            if (!isset($dato['fase_2']['sesiones'])){
                $dato['fase_2']['sesiones'] = [];
            }
            if (!isset($dato['fase_3']['sesiones'])){
                $dato['fase_3']['sesiones'] = [];
            }

            for ($i = count($dato['fase_1']['sesiones']); $i < $maxSesionFaseI; $i++) {
                $totalDatos[$key]['fase_1']['sesiones'][$i] = [];
                array_push($totalDatos[$key]['fase_1']['sesiones'][$i], $i,"---","---","---");
            }
            for ($i = count($dato['fase_2']['sesiones']); $i < $maxSesionFaseII; $i++) {
                $totalDatos[$key]['fase_2']['sesiones'][$i] = [];
                array_push($totalDatos[$key]['fase_2']['sesiones'][$i], $i,"---","---","---");
            }
            for ($i = count($dato['fase_3']['sesiones']); $i < $maxSesionFaseIII; $i++) {
                $totalDatos[$key]['fase_3']['sesiones'][$i] = [];
                array_push($totalDatos[$key]['fase_3']['sesiones'][$i], $i,"---","---","---");
            }
        }

        /**rellena la cantidad de sesiones vacias */
        $searchModel = new EcDatosBasicosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $totalDatos,
            'mayorSesion' => $mayorSesion,
			'anio' => $anio,
			'esDocente' => $esDocente,
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
