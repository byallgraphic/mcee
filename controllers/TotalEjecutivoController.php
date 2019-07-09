<?php
/**********
---------------------------------------
Versión: 001
Fecha: 11-12-2018
Desarrollador: Maria Viviana Rodas
Descripción: Controlador de la vista que contiene los botones de sensibilización artistica
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
	header('Location: index.php?r=site%2Flogin');
	die;
}

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\Sedes;



/**
 * AsignaturasController implements the CRUD actions for Asignaturas model.
 */
class TotalEjecutivoController extends Controller
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
     * Lists all Asignaturas models.
     * @return mixed
     */

    public function actionIndex()
    {
		
		$fecha = '2019-06';
		$idInstitucion 	= $_SESSION['instituciones'][0];
		$idSedes 		= $_SESSION['sede'][0];
		
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
			SELECT 
				rom.id_sedes, 
				count(rom.id_sedes),
				ar.estado_actividad,
				ar.id_rom_actividad, 
				sum(tcp.vecinos::integer + tcp.lideres_comunitarios::integer  + tcp.empresarios_comerciantes::integer  + tcp.organizaciones_locales::integer  + tcp.grupos_comunitarios::integer  + tcp.otos_actores::integer ) as poblacion
			FROM 
				isa.reporte_operativo_misional as rom,
				isa.actividades_rom as ar,
				isa.tipo_cantidad_poblacion_rom as tcp 
			WHERE 
				ar.id_reporte_operativo_misional = rom.id
			AND 
				rom.id_institucion = $idInstitucion
			AND 
				rom.estado = 1
			AND 
				ar.fecha_desde BETWEEN '$fecha-01' AND '".date( "Y-m-t", strtotime( $fecha ) )."'
			AND	
				tcp.id_reporte_operativo_misional = rom.id
			GROUP BY 
				rom.id_sedes,ar.estado_actividad,ar.id_rom_actividad
			
		");
		
		
		$actividadesRom = $command->queryAll();
		$totalSesionesSede = 0;
		$totalRealizadoSede =0;
		//se crea un array con indice el id de la sede y valor la cantidad (count)
		$totalesSedes = [];
		


		$sesionesXsedeXactividad =array(); 
		foreach($actividadesRom as $ar)
		{
			
			// se agrupan las diferentes sesiones por sede y por actividad
			@$sesionesXsedeXactividad[$ar['id_rom_actividad']][$ar['estado_actividad']]['sesiones'] += $ar['count'];
			@$sesionesXsedeXactividad[$ar['id_rom_actividad']][$ar['estado_actividad']]['poblacion'] += $ar['poblacion'];
		}

		$command = $connection->createCommand("
			SELECT 
				count(rom.id_sedes),
				ar.id_rom_actividad
			FROM 
				isa.reporte_operativo_misional as rom,
				isa.actividades_rom as ar
			WHERE 
				ar.id_reporte_operativo_misional = rom.id
			AND 
				rom.id_institucion = $idInstitucion
			AND 
				rom.estado = 1
			GROUP BY 
				ar.id_rom_actividad
		");
		
		$datosPlaneadas = $command->queryAll();

		$totalPlaneadas = [];
		//se ordenan los datos segun las actividades
		foreach ( $datosPlaneadas as $datosp )
			$totalPlaneadas[$datosp['id_rom_actividad']] = $datosp['count'];
			
		
		// sedes de la instituciones actual
		// $sedesIeo = Sedes::find()									  
				  // ->where( "id_instituciones=$idInstitucion" )
				  // ->andwhere("estado=1")
				  // ->all();
		// $asignaturas = ArrayHelper::map( $sedesIeo, 'id', 'descripcion' );
		
		// if ($totalRealizadoSede > 0)
			// $porcentajeSede = $totalRealizadoSede / $totalSesionesSede;
		// else		
			// $porcentajeSede = 0;
		
		
		// $sesiones_realizadas = 0;
		// $sesiones_aplazadas  = 0;
		// $sesiones_canceladas =0;
		// $totalsesiones_realizadas = 0;
		// $totalsesiones_aplazadas  = 0;
		// $totalsesiones_canceladas = 0;
		// $totalSesionesIEO = 0;
		// $porcetaje_actividades = [];
		
		// foreach ($totalesSedes as $key => $ttSedes)
		// {
			// @$sesiones_realizadas = $ttSedes[179];
			// @$sesiones_aplazadas  = $ttSedes[180];
			// @$sesiones_canceladas = $ttSedes[181];
			
			// @$totalsesiones_realizadas += $ttSedes[179];
			// @$totalsesiones_aplazadas += $ttSedes[180];
			// @$totalsesiones_canceladas += $ttSedes[181];
			
			// $totalSesionesIEO += $sesiones_realizadas+$sesiones_aplazadas+$sesiones_canceladas;
			// $porcetaje_actividades[$key] = $sesiones_realizadas  / ($sesiones_realizadas+$sesiones_aplazadas+$sesiones_canceladas);
		// }
		
		// $avanceIEO = 0;
		// $porcetaje_actividadesSedes = 0;
		// foreach ($porcetaje_actividades as $pa)
			// $porcetaje_actividadesSedes+= $pa;
		
		// $avanceIEO = $porcetaje_actividadesSedes / count($sedesIeo);
		
		// $arrayDatos = [];
		
		// $arrayDatos[] = $totalSesionesIEO * 100;
		// $arrayDatos[] = $porcentajeSede * 100;
		// $arrayDatos[] = $avanceIEO * 100 ;
		
		
			
			
			$datosActividad1=[];
			$datosActividad2=[];
			$datosActividad4=[];
			
		if(isset($sesionesXsedeXactividad[1]))
		{
			$datosActividad1[] = "0%";
			$datosActividad1[] = @number_format($sesionesXsedeXactividad[1][179]['sesiones']*1 / $totalPlaneadas[1]*1,2) . "%";
			$datosActividad1[] = @$sesionesXsedeXactividad[1][179]['poblacion']*1;
			$datosActividad1[] = @$sesionesXsedeXactividad[1][179]['sesiones']*1;//realizadas
			$datosActividad1[] = @$sesionesXsedeXactividad[1][180]['sesiones']*1;//aplazadas
			$datosActividad1[] = @$sesionesXsedeXactividad[1][181]['sesiones']*1;//canceladas
		}
		else
		{
			for($i=1;$i<=6;$i++)
				$datosActividad1[] = 0;
		}
		
		if(isset($sesionesXsedeXactividad[2]))
		{
			$datosActividad2[] = 0;
			$datosActividad2[] = @number_format($sesionesXsedeXactividad[2][179]['sesiones']*1 / $totalPlaneadas[2]*1,2) . "%";
			$datosActividad2[] = @$sesionesXsedeXactividad[2][179]['poblacion']*1;
			$datosActividad2[] = @$sesionesXsedeXactividad[2][179]['sesiones']*1;//realizadas
			$datosActividad2[] = @$sesionesXsedeXactividad[2][180]['sesiones']*1;//aplazadas
			$datosActividad2[] = @$sesionesXsedeXactividad[2][181]['sesiones']*1;//canceladas
		}
		else
		{
			for($i=1;$i<=6;$i++)
				$datosActividad2[] = 0;
		}
			
		if(isset($sesionesXsedeXactividad[4]))
		{
			$datosActividad4[] = 0;
			$datosActividad4[] = @number_format($sesionesXsedeXactividad[4][179]['sesiones']*1 / $totalPlaneadas[4]*1,2) . "%";
			$datosActividad4[] = @$sesionesXsedeXactividad[4][179]['poblacion']*1;
			$datosActividad4[] = @$sesionesXsedeXactividad[4][179]['sesiones']*1;//realizadas
			$datosActividad4[] = @$sesionesXsedeXactividad[4][180]['sesiones']*1;//aplazadas
			$datosActividad4[] = @$sesionesXsedeXactividad[4][181]['sesiones']*1;//canceladas
		}
		else
		{
			for($i=1;$i<=6;$i++)
				$datosActividad4[] = 0;
		}
			
		$datos = [];
		//datos actividad 1
		$datos[]=
			[
				"actividad"				=>"Actividad 1." ,
				"porcentajeieo" 		=>@$datosActividad1[0] ,
				"porcentajeactividad"	=>@$datosActividad1[1],
				"benficiarios"			=>@$datosActividad1[2] ,
				"realizadas" 			=>@$datosActividad1[3] ,
				"aplazadas"				=>@$datosActividad1[4],
				"canceladas"			=>@$datosActividad1[5]
			];
		//datos actividad 2
		$datos[]=
			[
				"actividad"				=>"Actividad 2." ,
				"porcentajeieo"			=>@$datosActividad2[0] ,
				"porcentajeactividad"	=>@$datosActividad2[1],
				"benficiarios"			=>@$datosActividad2[2] ,
				"realizadas"			=>@$datosActividad2[3] ,
				"aplazadas"				=>@$datosActividad2[4],
				"canceladas"			=>@$datosActividad2[5]
			];
			
		//datos actividad 4
		$datos[]=
			[
				"actividad"				=>"Actividad 4." ,
				"porcentajeieo"			=>@$datosActividad4[0] ,
				"porcentajeactividad"	=>@$datosActividad4[1],
				"benficiarios"			=>@$datosActividad4[2] ,
				"realizadas"			=>@$datosActividad4[3] ,
				"aplazadas"				=>@$datosActividad4[4],
				"canceladas"			=>@$datosActividad4[5]
			];
		
		
		$dataProvider = new ArrayDataProvider([
			'allModels' => $datos,
		]);
		
			return $this->render('index', 
			[
				'dataProvider' 	=> $dataProvider,
			]);
		
    }
	
	

    
}
