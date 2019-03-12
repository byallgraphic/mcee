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
use app\models\Sedes;
use app\models\Instituciones;
use app\models\SemillerosTicDatosIeoProfesional;
use app\models\EjecucionFase;
use yii\helpers\ArrayHelper;
use DateTime;
use DatePeriod;
use DateInterval;
/**
 * EcDatosBasicosController implements the CRUD actions for EcDatosBasicos model.
 */
class ResumenOperativoFasesDocentesController extends Controller
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
        
        $searchModel = new EcDatosBasicosBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	//retorna la informacion del Resumen_Operativo_ Estudiantes_Docentes_Operativo docentes
	public function actionObtenerInfo()
	{


		//informacion de la tabla  semilleros_tic.datos_ieo_profesional
		// variable con la conexion a la base de datos 
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
			SELECT	dip.id ,i.codigo_dane as codigo_dane_institucion, i.descripcion as institucion, s.codigo_dane as codigo_dane_sede,
							s.descripcion as sede, 
							i.id as id_institucion, 
							s.id as id_sede, 
							a.descripcion as anio, 
							fa.descripcion as fase,
							sdi.personal_a,
							sdi.id as id_semilleros
			FROM 	semilleros_tic.datos_ieo_profesional as dip,public.sedes as s,public.instituciones as i, semilleros_tic.anio as a, 
					semilleros_tic.fases as fa,	semilleros_tic.ejecucion_fase as ef, semilleros_tic.semilleros_datos_ieo as sdi
			WHERE 	dip.id_institucion = i.id
			AND		dip.id_sede = s.id
			AND 	dip.estado = 1
			AND 	dip.id = ef.id_datos_ieo_profesional
			AND 	ef.id_fase=fa.id 
			AND 	sdi.id_institucion =dip.id_institucion
			AND 	sdi.sede = dip.id_sede 
			GROUP BY dip.id,i.codigo_dane,i.descripcion, 
			s.codigo_dane, s.descripcion,i.id,s.id, a.descripcion,
			fa.descripcion,sdi.personal_a, sdi.id
			ORDER BY i.id, s.id
			");
		$datos_ieo_profesional = $command->queryAll();
	
		$html="";
		$contador =0;
		foreach ($datos_ieo_profesional as $dip)
		{
			$html.="<tr>";

			$idInstitucion = $dip['id_institucion'];
			$idSede = $dip['id_sede'];
			
			//obtener las fecha de inicio de semillero 
			$command = $connection->createCommand
			("
				SELECT fecha_sesion FROM semilleros_tic.datos_sesiones WHERE id_sesion = 1 ORDER BY id ASC 
			");
			$fechas = $command->queryAll();

			$id_datos_ieo_profesional = $dip['id'];
			$command = $connection->createCommand
			("
				SELECT 
				id_datos_sesiones,
				docente,
				asignaturas,
				especiaidad,
				seiones_empleadas,
				numero_apps,
				docente
				FROM semilleros_tic.ejecucion_fase 
				WHERE id_datos_ieo_profesional = $id_datos_ieo_profesional 
			");
			$datoSemillerosTicEjecucionFase = $command->queryAll();
			
			
			$docente = array();
			$especiaidad = array();
			
			
			//se agrupa la informacion de todas las sesiones para luego ser concatenada
			foreach ($datoSemillerosTicEjecucionFase as $datosSTEF => $valor)
			{	
				
				@$asignatura[$valor['id_datos_sesiones']][]= $valor['asignaturas'];
				@$especiaidad[$valor['id_datos_sesiones']][]= $valor['especiaidad'];
				@$datosSesion[$valor['id_datos_sesiones']]= $valor['id_datos_sesiones'];
				@$seionesEmpleadas[$valor['id_datos_sesiones']]= $valor['id_datos_sesiones'];
				@$numeroApps+= $valor['numero_apps'];
				@$cantidadDocente [$valor['id_datos_sesiones']][]= $valor['docente'];
			}
				
		
			$idDatosSesiones = implode(",",$datosSesion);			
			//se pasa a por comas para mostrar todas la materias
			//variable que guarda los datos a mostrar
			$asignaturas="";
			foreach ($asignatura as $asig)
			{
				$asignaturas .= implode(",",$asig).",";
			}
			$asignaturas = substr($asignaturas,0,-1);
			
			
			
			//cantidad docentes fase 1 sesiones
			foreach ($cantidadDocente as $cd => $value)
			{
				$cantidadDocentes[] = count($value);
			}
			
		
			$command = $connection->createCommand
			("
				SELECT 
				fecha_sesion,
				duracion_sesion
				FROM semilleros_tic.datos_sesiones
				WHERE id in($idDatosSesiones)
				GROUP BY fecha_sesion,duracion_sesion,id
				ORDER BY id ASC 
			");
			$datos_sesiones = $command->queryAll();
			
		
		
			$idProfesionalA = $dip['personal_a'];
			//nombres de los profesional a
			$command = $connection->createCommand
			("
				SELECT concat(p.nombres,' ',p.apellidos) as nombre		
				FROM public.personas as p
				WHERE id in($idProfesionalA )
			");
			$datoPersonalA = $command->queryAll();	
			$nomresPersonalA = $this->arrayArrayComas($datoPersonalA,'nombre');
		
			

			//nombres de los docentes 
			$idSemilleros = $dip['id_semilleros'];
			$command = $connection->createCommand
			("
				SELECT 
				id_docente,
				especialidad,
				frecuencias_sesiones
				FROM semilleros_tic.acuerdos_institucionales
				WHERE id_semilleros_datos_ieo = $idSemilleros
			");
			$datoAcuerdosInstitucionales = $command->queryAll();	
			$datosIdDocentes = $this->arrayArrayComas($datoAcuerdosInstitucionales,'id_docente');
			$especialidades= $this->arrayArrayComas($datoAcuerdosInstitucionales,'especialidad');
			//id de la frecuencia sesiones mensual
			$frecuenciaSesion= $this->arrayArrayComas($datoAcuerdosInstitucionales,'frecuencias_sesiones');
			
			$command = $connection->createCommand
			("
				SELECT concat(p.nombres,' ',p.apellidos) as nombre		
				FROM public.personas as p
				WHERE id in($datosIdDocentes )
			");
			$datosDocentes = $command->queryAll();	
			$nombresDocentes = $this->arrayArrayComas($datosDocentes,'nombre');
			//datos Fase II
			
			
			//Promedio de duración por cada sesión (hora reloj)
			$totalDuracionSesiones =0;
			
				
			$segundos = 0;
			foreach($datos_sesiones as $ds)
			{
				
				$segundos += $this->horasSegundos($ds['duracion_sesion']);
			}
			
			$promedioHorasFase1  = $segundos / count($datos_sesiones);
			$promedioHorasFase1 =  $this->SegundosHora($promedioHorasFase1);
			
			
			$command = $connection->createCommand("
			SELECT descripcion 
			FROM public.parametro
			WHERE id in($frecuenciaSesion)
			ORDER BY id ASC ");
			$frecuenciasSesiones = $command->queryAll();
			$frecuenciasSesiones= $this->arrayArrayComas($frecuenciasSesiones,'descripcion');
			
	
			$html.="<td style='border: 1px solid black;'>".$dip['codigo_dane_institucion']."</td>";	
			$html.="<td style='border: 1px solid black;'>".$dip['institucion']."</td>";	
			$html.="<td style='border: 1px solid black;'>".$dip['codigo_dane_sede']."</td>";	
			$html.="<td style='border: 1px solid black;'>".$dip['sede']."</td>";
			
			//anio
			$html.="<td style='border: 1px solid black;'>".$dip['anio']."</td>";	
			
			//profesional_a
			$html.="<td style='border: 1px solid black;'>".$nomresPersonalA ."</td>";
			
			//Fecha de inicio del Semillero
			$html.="<td style='border: 1px solid black;'>".@$fechas[$contador]['fecha_sesion']."</td>";	
			
			//nombre del docente
			$html.="<td style='border: 1px solid black;'>".$nombresDocentes."</td>";
			
			//Nombre de las asignaturas que enseña
			$html.="<td style='border: 1px solid black;'>".$asignaturas."</td>";	
			
			//Especialidad de la Media Técnica o Técnica	
			$html.="<td style='border: 1px solid black;'>".$especialidades."</td>";
			
			//Frecuencia sesiones mensual fase 1
			$html.="<td style='border: 1px solid black;'>".$frecuenciasSesiones ."</td>";	
			
			//Promedio de duración por cada sesión (hora reloj) fase 1
			$html.="<td style='border: 1px solid black;'>".$promedioHorasFase1 ."</td>";
				
				
		
			//docente por sesion fase 1
			for($i=0;$i<=5;$i++)
			{
				//docentes por sesion fase 1
				$html.="<td style='border: 1px solid black;'>".@$cantidadDocentes[$i]."</td>";
				//fecha de la sesion fase 1
				$html.="<td style='border: 1px solid black;'>".@$datos_sesiones[$i]['fecha_sesion']."</td>";
				//duración de la sesion fase 1
				$html.="<td style='border: 1px solid black;'>".@$datos_sesiones[$i]['duracion_sesion']."</td>";
				
			}
			
			$command = $connection->createCommand
				("
					select ai.frecuencias_sesiones, p.descripcion
					from semilleros_tic.acuerdos_institucionales as ai, semilleros_tic.fases as f, semilleros_tic.semilleros_datos_ieo as sdi,
						semilleros_tic.datos_ieo_profesional as dip, semilleros_tic.ejecucion_fase_ii as ef, semilleros_tic.anio as a, public.parametro as p
					where f.id = 2
					and ai.id_fase = f.id
					and ai.id_semilleros_datos_ieo = sdi.id
					and sdi.id_institucion = dip.id_institucion
					and sdi.sede = dip.id_sede
					and dip.id_institucion = $idInstitucion 
					and dip.id_sede = $idSede
					and c.id_anio = a.id
					and dip.estado = 1
					and ef.estado = 1
					and sdi.estado = 1
					and ai.estado = 1
					and a.estado = 1
					and  ai.frecuencias_sesiones = p.id
					group by ai.frecuencias_sesiones,p.descripcion

				");
				$frecuenciaSesiones = $command->queryAll();
			
			// echo "<pre>"; print_r($frecuenciaSesiones); echo "</pre>"; 
			$frecunciaSesionesFase2 = $this->arrayArrayComas($frecuenciaSesiones,'descripcion');
			
			//total Sesiones
			$html.="<td style='border: 1px solid black;'>".count($seionesEmpleadas)."</td>";
			
			//Número de Apps 0.0 creadas
			$html.="<td style='border: 1px solid black;'>$numeroApps</td>";
			
			//frecuencia sesiones mensual fase ii
			$html.="<td style='border: 1px solid black;'>$frecunciaSesionesFase2</td>";
			
			
			
			//datos de la fase 2
			$command = $connection->createCommand("
			SELECT 
			id_datos_sesiones,
			docentes,
			numero_apps_desarrolladas
			FROM semilleros_tic.ejecucion_fase_ii
			WHERE id_datos_ieo_profesional = $id_datos_ieo_profesional
			AND estado = 1
			ORDER BY id ASC ");
			$datosEjeccionFaseii = $command->queryAll();
			
			
			$cantidadDocenteFase2 = array();
			
			$datosSesionFase2= array();
			foreach ($datosEjeccionFaseii as $datosSTEF2 => $valor)
			{	
				
				@$asignaturaFase2[$valor['id_datos_sesiones']][]= $valor['asignaturas'];
				@$especiaidadFase2[$valor['id_datos_sesiones']][]= $valor['especiaidad'];
				@$datosSesionFase2[$valor['id_datos_sesiones']]= $valor['id_datos_sesiones'];
				@$seionesEmpleadasFase2[$valor['id_datos_sesiones']]= $valor['id_datos_sesiones'];
				@$numeroAppsFase2+= $valor['numero_apps_desarrolladas'];
				@$cantidadDocenteFase2[$valor['id_datos_sesiones']][]= $valor['docente'];
			}
				
			//cantidad docentes fase 1 sesiones
			foreach ($cantidadDocenteFase2 as $cd => $value)
			{
				$cantidadDocentesFase2[] = count($value);
			}
			
			if(isset($cantidadDocentesFase2))
			{
				
				$idDatosSesionesFase2 = implode(",",$datosSesionFase2);	
				
				$command = $connection->createCommand
				("
					SELECT 
					id,
					fecha_sesion,
					duracion_sesion
					FROM semilleros_tic.datos_sesiones
					WHERE id in($idDatosSesionesFase2)
					GROUP BY fecha_sesion,duracion_sesion,id
					ORDER BY id ASC 
				");
				$datos_sesionesFase2 = $command->queryAll();
				
				$cantidadSesionesEmpleadasFase2 =  count($seionesEmpleadasFase2);
					
			
				$totalDuracionSesionesFse2 =0;
				foreach($datos_sesionesFase2 as $ddsf2)
				{
					
					$totalDuracionSesionesFse2+=$this->horasSegundos( $ddsf2['duracion_sesion']);
				}
				
				$promedio =  $this->SegundosHora( $totalDuracionSesionesFse2 / count($datos_sesionesFase2));
				
			}
			else
			{
				$cantidadSesionesEmpleadasFase2 = "";
			}
			
		
			$html.="<td style='border: 1px solid black;'>$promedio</td>";
			
			//informacion sesiones fase 2
			for($i=0;$i<=5;$i++)
			{
				//docentes por sesion fase 2
				$html.="<td style='border: 1px solid black;'>".@$cantidadDocentesFase2[$i]."</td>";
				// fecha de la sesion fase 2
				$html.="<td style='border: 1px solid black;'>".@$datos_sesionesFase2[$i]['fecha_sesion']."</td>";
				//duración de la sesion fase 2
				$html.="<td style='border: 1px solid black;'>".@$datos_sesionesFase2[$i]['duracion_sesion']."</td>";
				
			}
			
			
			//total Sesiones fase2
			$html.="<td style='border: 1px solid black;'>".$cantidadSesionesEmpleadasFase2."</td>";
			
			//Número de Apps 0.0 creadas
			$html.="<td style='border: 1px solid black;'>$numeroAppsFase2</td>";
			
			
			
			//datos de la fase 3
			$command = $connection->createCommand("
			SELECT 
			id_datos_sesion,
			docente_creador
			FROM semilleros_tic.ejecucion_fase_iii
			WHERE id_datos_ieo_profesional = $id_datos_ieo_profesional
			AND estado = 1
			ORDER BY id ASC ");
			$datosEjeccionFaseiii = $command->queryAll();
			
			// echo "<pre>"; print_r($datosEjeccionFaseiii); echo "</pre>"; 
			$cantidadDocenteFase3 = array();
			
			// $datosSesionFase3= array();
			foreach ($datosEjeccionFaseiii as $datosSTEF2 => $valor)
			{	
				
				@$asignaturaFase3[$valor['id_datos_sesion']][]= $valor['asignaturas'];
				@$especiaidadFase3[$valor['id_datos_sesion']][]= $valor['especiaidad'];
				@$datosSesionFase3[$valor['id_datos_sesion']]= $valor['id_datos_sesion'];
				@$seionesEmpleadasFase3[$valor['id_datos_sesion']]= $valor['id_datos_sesiones'];
					
			}
				
			//cantidad docentes fase 3 sesiones
			
			if(isset($datosSesionFase3))
			{
				$idDatosSesionesFase3 = implode(",",array_filter ( $datosSesionFase3));	
				
			
				$command = $connection->createCommand
				("
					SELECT 
					ds.id_sesion, 
					ds.fecha_sesion, 
					ds.duracion_sesion, 
					se.descripcion as sesion 
					FROM semilleros_tic.datos_sesiones as ds, semilleros_tic.sesiones as se
					where ds.id in($idDatosSesionesFase3)
					AND ds.id_sesion = se.id
					ORDER BY ds.id ASC 
				");
				$datos_sesionesFase3 = $command->queryAll();
			
				foreach ($datos_sesionesFase3 as $dsF3 => $value)
				{
					$fechaSesionFase3[$value['id_sesion']][] =$value['fecha_sesion'];
					$duracionSesionFase3[$value['id_sesion']][] =$value['duracion_sesion'];
				}
				
				$cantidadSesionesEmpleadasFase3 =  count($duracionSesionFase3);
				// $nombresDocentes = array();
				
				
				foreach($fechaSesionFase3 as $fs3 => $value)
				{
					$fechasSesionesFase3[] =$value[0];
				}

				$contador = 0;
				$totalpromedio=0;
				foreach($duracionSesionFase3 as $ds3 => $value)
				{
					$total= 0;
					foreach($value as $dato)
					{
						$contador++;
						$total +=$this->horasSegundos($dato);
					}
					$totalpromedio +=$total;
					$duracionesSesionesFase3[]= $this->SegundosHora($total);
				}
				
				$promedioFase3 = $this->SegundosHora($totalpromedio / $contador);
				$contador = 0;
				
				$promedio =  $this->SegundosHora( $totalDuracionSesionesFse2 / count($datos_sesionesFase2));
				
				
								
				$command = $connection->createCommand
				("
				SELECT ds.id_sesion, 
				ef.docente_creador, 
				ai.id_docente
				FROM semilleros_tic.ejecucion_fase_iii as ef, semilleros_tic.datos_sesiones as ds, semilleros_tic.acuerdos_institucionales as ai
				where ef.id_datos_sesion in ($idDatosSesionesFase3)
				AND ef.id_datos_sesion = ds.id
				AND ai.id = ef.docente_creador
				ORDER BY ef.id ASC
				");
				$docenteCreador = $command->queryAll();
				
				foreach($docenteCreador as $dc)
				{
					$iddocenteCreador[$dc['id_sesion']][] = $dc['id_docente'];
				}
				
				foreach($iddocenteCreador as $id)
				{
					
					$command = $connection->createCommand
					("
						SELECT concat(p.nombres,' ',p.apellidos) as nombre		
						FROM public.personas as p
						WHERE id in(".implode(",",$id) ." )
					");
					$datoDocenteCreador = $command->queryAll();
					
					
					foreach ($datoDocenteCreador as $ncreador)
					{
						// echo "<pre>"; print_r($ncreador); echo "</pre>"; 
						$nomCredor[]=$ncreador['nombre'];
					}
					
					$nombreDocenteCreador[]=count($nomCredor);
					$nomCredor=null;
					

				}
				
					
			$command = $connection->createCommand
				("
					select ai.frecuencias_sesiones, p.descripcion
					from semilleros_tic.acuerdos_institucionales as ai, semilleros_tic.fases as f, semilleros_tic.semilleros_datos_ieo as sdi,
						semilleros_tic.datos_ieo_profesional as dip, semilleros_tic.ejecucion_fase_ii as ef, semilleros_tic.anio as a, public.parametro as p
					where f.id = 3
					and ai.id_fase = f.id
					and ai.id_semilleros_datos_ieo = sdi.id
					and sdi.id_institucion = dip.id_institucion
					and sdi.sede = dip.id_sede
					and dip.id_institucion = $idInstitucion 
					and dip.id_sede = $idSede
					and dip.estado = 1
					and ef.estado = 1
					and sdi.estado = 1
					and ai.estado = 1
					and a.estado = 1
					and  ai.frecuencias_sesiones = p.id
					group by ai.frecuencias_sesiones,p.descripcion
			
				");
				$frecuenciaSesiones3 = $command->queryAll();
			
			$frecunciaSesionesFase3 = $this->arrayArrayComas($frecuenciaSesiones3,'descripcion');
							
				// $nomresPersonalA = $this->arrayArrayComas($datoPersonalA,'nombre');
				
				$command = $connection->createCommand
					("
						SELECT asignatura,
						numero_estudiantes,
						grado
						FROM semilleros_tic.ejecucion_fase_iii
					");
					$asignaturasFase3 = $command->queryAll();
					
					$nombreAsignaturasFase3 = $this->arrayArrayComas($asignaturasFase3,'asignatura');
					$numeroEstudiantes = $this->arrayArrayComas($asignaturasFase3,'numero_estudiantes');
					$numeroEstudiantes = explode(",", $numeroEstudiantes);
					$numeroEstudiantes = array_sum($numeroEstudiantes);
					$nombreGradosFase3 = $this->arrayArrayComas($asignaturasFase3,'grado');
					
					
			}
			else
			{

				$cantidadSesionesEmpleadasFase3 = "";
			}
			
			
			$arrayFases = array(
			'Sesión 1',
			'Sesión 2',
			'Sesión 3',
			'Sesión 4',
			'Sesión 5',
			'Sesión 6',
			'Sesión 7',
			'Sesión 8',
			'Sesión 9',
			'Sesión 10',
			'Sesión 11',
			'Sesión 12',
			);
			
			
			//datos sesion iii
			//frecuencia sesiones mensual fase iii
			$html.="<td style='border: 1px solid black;'>$frecunciaSesionesFase3</td>";
			
			//frecuencia sesiones mensual fase iii
			$html.="<td style='border: 1px solid black;'>$promedioFase3</td>";
			
			//informacion sesiones fase 3
			
			for($i=0;$i<=11;$i++)
			{
				
				//docentes por sesion fase 3
				$html.="<td style='border: 1px solid black;'>".@$nombreDocenteCreador[$i]."</td>";
				// fecha de la sesion fase 3
				$html.="<td style='border: 1px solid black;'>".@$fechasSesionesFase3[$i]."</td>";
				//duración de la sesion fase 3
				$html.="<td style='border: 1px solid black;'>".@$duracionesSesionesFase3[$i]."</td>";
				// $cantidadDocenteCreador = "";	
			}
				
			//total Sesiones fase3
			$html.="<td style='border: 1px solid black;'>".$cantidadSesionesEmpleadasFase3."</td>";
			
			//Número de Apps 0.0 creadas
			$html.="<td style='border: 1px solid black;'>$numeroAppsFase2</td>";
			
			//Nombres asignaturas en las que uso la App fase3
			$html.="<td style='border: 1px solid black;'>$nombreAsignaturasFase3</td>";
			
			//Número de estudiantes fase3
			$html.="<td style='border: 1px solid black;'>$numeroEstudiantes</td>";
				
				
			//Grado de estudiantes fase3 
			$html.="<td style='border: 1px solid black;'>$nombreGradosFase3</td>";
			
			
			@$totalSesiones  = @count($seionesEmpleadas) + @$cantidadSesionesEmpleadasFase2 + @$cantidadSesionesEmpleadasFase3;
			$html.="<td style='border: 1px solid black;'>$totalSesiones</td>";
			
			// nombresDocentes;
			
			
		
			$cantidadDocentes = explode(",",$nombresDocentes);
			$numeroDocentes =count($cantidadDocentes);
			$html.="<td style='border: 1px solid black;'>$numeroDocentes</td>";
			
			
			$html.="</tr>";
			
			//se borra le variable para que quede vacia en el siguiente ciclo del foreach
			$asignaturas	= null;
			$especiaidades	= null;
			$datosSesion	= null;
			$seionesEmpleadas = null;
			$asignatura		= null;
			$especiaidad	= null;
			$datosSesion	= null;
			$seionEmpleada	= null;
			$numeroApp		= null;
			$numeroApps		= null;
			$cantidadDocente= null;
			$cantidadDocentes = null;
			$cantidadDocenteFase2= null;
			$cantidadDocentesFase2= null;
			$datosSesionFase2 = null;
			$datos_sesionesFase2 = null;
			$seionesEmpleadasFase2 = null;
			$numeroAppsFase2 = null;
			$cantidadDocenteFase3= null;
			$cantidadDocentesFase3= null;
			$datosSesionFase3 = null;
			$datos_sesionesFase3 = null;
			$seionesEmpleadasFase3 = null;
			$numeroAppsFase3 = null;
			$fechasSesionesFase3 = null;
			$duracionesSesionesFase3 =null;
			$docenteXSesion = null;
			$nombresDocentes =null;
			$nombres = null;
			$nomCredor = null;
			$iddocenteCreador = null;
			$idDatosSesionesFase3 = null;
			$datoDocenteCreador = null;
			$nombreDocenteCreador = null;
			$promedio=null;
			$frecunciaSesionesFase2 = null;
			$frecunciaSesionesFase3=null;
			$promedioFase3=null;
			$nombreAsignaturasFase3 = null;	
			$numeroEstudiantes = null;
			$nombreGradosFase3 = null;
			$numeroApps= null;
			$cantidadDocenteCreador = null;
			$contador++;
		}
		echo $html;
	}
    /**
     * Displays a single EcDatosBasicos model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	 
	public function arrayArrayComas($array,$nombrePos)
	{
		foreach ($array as $ar)
		{		
			$datos[] = $ar[$nombrePos];
		}
		return  implode(",",$datos);
	}
	
	public function horasSegundos($hora)
	{
		list($horas, $minutos) = explode(':',$hora);
			$hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 );
		
		return $hora_en_segundos;
	}
	
	public function SegundosHora($segundos) { 
    $h = floor($segundos / 3600); 
    $m = floor(($segundos % 3600) / 60); 
    
    return sprintf('%02d:%02d', $h, $m); 
}
	
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
