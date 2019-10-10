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
use app\models\EcInformeSemanalTotalEjecutivo;
use app\models\Sedes;
use app\models\Instituciones;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * EcInformeSemanalTotalEjecutivoController implements the CRUD actions for EcInformeSemanalTotalEjecutivo model.
 */
class EcInformeSemanalTotalEjecutivoController extends Controller
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
     * Lists all EcInformeSemanalTotalEjecutivo models.
     * @return mixed
     */
    public function actionIndex($guardado = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => EcInformeSemanalTotalEjecutivo::find(),
        ]);
        
        $_SESSION["tipo_informe"] = isset(($_GET['idTipoInforme'])) ? $_GET['idTipoInforme'] : 0;
        
        return $this->redirect(['create', 'guardado' => $guardado ]);
            
        /*return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);*/
    }

    /**
     * Displays a single EcInformeSemanalTotalEjecutivo model.
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
     * Creates a new EcInformeSemanalTotalEjecutivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $data = [];
        $idInstitucion = $_SESSION['instituciones'][0];
        $secuenciaData = 1;
        if( Yii::$app->request->post('EcInformeSemanalTotalEjecutivo') )
			$data = Yii::$app->request->post('EcInformeSemanalTotalEjecutivo');

        $count 	= count( $data );
        $models = [];
        for( $i = 0; $i < $count; $i++ )
		{
			$models[] = new EcInformeSemanalTotalEjecutivo();
        }
        
        if (EcInformeSemanalTotalEjecutivo::loadMultiple($models, Yii::$app->request->post() )) {
            
            EcInformeSemanalTotalEjecutivo::deleteAll('institucion_id = '. $idInstitucion);
           
           
            foreach( $models as $key => $model) {
                $model->institucion_id = $idInstitucion;
                $model->secuencia = $secuenciaData; 
                $model->id_tipo_informe =  $_SESSION["tipo_informe"];              
                $secuenciaData++;
            }
                                 
            foreach( $models as $key => $model) {
				$model->save();
			}

            return $this->redirect(['index', 'guardado' => 1 ]);
           
        }

		
		
		
			
        $model = new EcInformeSemanalTotalEjecutivo();
    
        return $this->render('create', [
            'model' => $model,
            'guardado' => 0,
       
			
        ]);
    }
	
	
	public function actionReporteTotalEjecutivo()
	{
		
		$sedes = Sedes::find()->andWhere(" estado =1 ")->orderby( 'id' )->all();
		$sedes = ArrayHelper::map( $sedes, 'id', 'id_instituciones' );
			
		$instituciones = Instituciones::find()->andWhere(" estado =1 ")->orderby( 'id' )->all();
		$instituciones = ArrayHelper::map( $instituciones, 'id', 'descripcion' );		
			
	
        $connection = Yii::$app->getDb();
		$command = $connection->createCommand("
		select 
			ise.institucion_id, 
			ise.sede_id,
			ise.id_tipo_informe,
			ai.id as id_actividad_ise,
			ai.avance_sede,
			ai.avance_ieo,
			ai.actividad_1_porcentaje,
			ai.actividad_2_porcentaje,
			ai.actividad_3_porcentaje,
			ise.fecha_inicio,
			ise.fecha_fin
		from 
			ec.informe_semanal_ejecucion_ise as ise,
			ec.actividades_ise as ai
		where 
			ise.id = ai.informe_semanal_ejecucion_id
		and 
			ise.estado = 1
		");
		$result = $command->queryAll();
		
		if (!isset($result))
		{
			
		
		
	
		
		$avanceSede = [];
		$avanceIEO = [];
		$activiadad1 = [];
		
			
		$arrayIdActividad = array();
		$datos = [];
		foreach ($result as $r)
		{	
			$datos[$r['fecha_inicio']. " A " .$r['fecha_fin']][$r['institucion_id']][$r['sede_id']][$r['id_tipo_informe']]['avance_sede'] = $r['avance_sede'];
			$datos[$r['fecha_inicio']. " A " .$r['fecha_fin']][$r['institucion_id']][$r['sede_id']][$r['id_tipo_informe']]['actividad_1_porcentaje'] = $r['actividad_1_porcentaje'];
			$datos[$r['fecha_inicio']. " A " .$r['fecha_fin']][$r['institucion_id']][$r['sede_id']][$r['id_tipo_informe']]['actividad_2_porcentaje'] = $r['actividad_2_porcentaje'];
			$datos[$r['fecha_inicio']. " A " .$r['fecha_fin']][$r['institucion_id']][$r['sede_id']][$r['id_tipo_informe']]['actividad_3_porcentaje'] = $r['actividad_3_porcentaje'];	
			$arrayIdActividad[] = $r['id_actividad_ise'];
		}
		
		foreach($datos as $key => $valor)
		{
			foreach($valor as $ieo)
			{
				foreach($ieo as $sede)
				{
					//Saber cuantas sedes estan al 100% en el rango de fecha (semana)
					//PPT 7
					if(@$sede[7]['avance_sede'] == 100)
					{
						@$avanceSede[$key][7]+= 1;
					}
					
					//PSSE	19
					if(@$sede[19]['avance_sede'] == 100)
					{
						@$avanceSede[$key][19]+= 1;
					}
					
					//PAF 31
					if(@$sede[31]['avance_sede'] == 100)
					{
						@$avanceSede[$key][31]+= 1;
					}
					
					@$activiadades[$key][7]['actividad_1_porcentaje'] += $sede[7]['actividad_1_porcentaje'];
					@$activiadades[$key][7]['actividad_2_porcentaje'] += $sede[7]['actividad_2_porcentaje'];
					@$activiadades[$key][7]['actividad_3_porcentaje'] += $sede[7]['actividad_3_porcentaje'];
					@$activiadades[$key][19]['actividad_1_porcentaje'] += $sede[19]['actividad_1_porcentaje'];
					@$activiadades[$key][19]['actividad_2_porcentaje'] += $sede[19]['actividad_2_porcentaje'];
					@$activiadades[$key][19]['actividad_3_porcentaje'] += $sede[19]['actividad_3_porcentaje'];
					@$activiadades[$key][31]['actividad_1_porcentaje'] += $sede[31]['actividad_1_porcentaje'];
					@$activiadades[$key][31]['actividad_2_porcentaje'] += $sede[31]['actividad_2_porcentaje'];
					@$activiadades[$key][31]['actividad_3_porcentaje'] += $sede[31]['actividad_3_porcentaje'];
						
				}
				
				//Saber cuantas IEO estan al 100% en el rango de fecha (semana)
				//PPT 7
				if(@$avanceSede[$key][7] / count($ieo) == 1)
				{
					@$avanceIEO[$key][7]+=1;
				}
					
				//PSSE	19
				if(@$avanceSede[$key][19] / count($ieo) == 1)
				{
					@$avanceIEO[$key][19]+=1;
				}
				
				//PAF 31
				if(@$avanceSede[$key][31] / count($ieo) == 1)
				{
					@$avanceIEO[$key][31]+=1;
				}
			}
		}
		
	
		$porcentajeIEO = [];
		$cantidadIEO = count($instituciones);

		foreach($avanceIEO as $key => $aIEO) 
		{
			@$porcentajeIEO[$key][7] = round ( $aIEO[7] / 45  * 100);
			@$porcentajeIEO[$key][19] = round ( $aIEO[19] / 45  * 100);
			@$porcentajeIEO[$key][31] = round ( $aIEO[31] / 45 * 100);
		}
	
		//porcentaje sobre la actividad 1 2 y 3
		$cantidadSedes = count($sedes);
		
		foreach($activiadades as $key => $actividad )
		{
			
		
			@$activiadades[$key][7]['actividad_1_porcentaje'] = round ( $actividad[7]['actividad_1_porcentaje'] / $cantidadSedes  );
			@$activiadades[$key][7]['actividad_2_porcentaje'] = round ( $actividad[7]['actividad_2_porcentaje'] / $cantidadSedes  );
			@$activiadades[$key][7]['actividad_3_porcentaje'] = round ( $actividad[7]['actividad_3_porcentaje'] / $cantidadSedes  );
			@$activiadades[$key][19]['actividad_1_porcentaje'] = round ( $actividad[19]['actividad_1_porcentaje'] / $cantidadSedes );
			@$activiadades[$key][19]['actividad_2_porcentaje'] = round ( $actividad[19]['actividad_2_porcentaje'] / $cantidadSedes );
			@$activiadades[$key][19]['actividad_3_porcentaje'] = round ( $actividad[19]['actividad_3_porcentaje'] / $cantidadSedes );
			@$activiadades[$key][31]['actividad_1_porcentaje'] = round ( $actividad[31]['actividad_1_porcentaje'] / $cantidadSedes );
			@$activiadades[$key][31]['actividad_2_porcentaje'] = round ( $actividad[31]['actividad_2_porcentaje'] / $cantidadSedes );
			@$activiadades[$key][31]['actividad_3_porcentaje'] = round ( $actividad[31]['actividad_3_porcentaje'] / $cantidadSedes );
		}
	
	
	
		// echo "<pre>"; print_r($activiadades); echo "</pre>"; 
		// die;
		$porcentajesSedes = [];
		foreach ($avanceSede as $key => $aSedes )
		{
			@$porcentajesSedes[$key][7] = round ( $aSedes[7] / $cantidadSedes  * 100);
			@$porcentajesSedes[$key][19] = round ( $aSedes[19] / 59  * 100);
			@$porcentajesSedes[$key][31] = round ( $aSedes[31] / $cantidadSedes * 100);
		}
				
		// $command = $connection->createCommand("
		// SELECT 
			// ise.fecha_inicio,
			// ise.fecha_fin,
			// ise.id_tipo_informe,
			// tcpi.tiempo_libre, 
			// tcpi.edu_derechos, 
			// tcpi.sexualidad_ciudadania, 
			// tcpi.medio_ambiente,
			// tcpi.familia,
			// tcpi.directivos
		// FROM 
			// ec.tipo_cantidad_poblacion_ise as tcpi, 
			// ec.informe_semanal_ejecucion_ise as ise
		// WHERE 
			// tcpi.id_informe_semanal_ejecucion_ise  = ise.id
		// AND
			// ise.estado = 1
		// ");
		// $result1 = $command->queryAll();
		
		$arrayIdActividad  =  implode(",", $arrayIdActividad);
		$command = $connection->createCommand("
		SELECT 
			ise.fecha_inicio,
			ise.fecha_fin,
			ise.id_tipo_informe,
			tcpi.tiempo_libre, 
			tcpi.edu_derechos, 
			tcpi.sexualidad_ciudadania, 
			tcpi.medio_ambiente,
			tcpi.familia,
			tcpi.directivos,
			tcpi.id as id_tipo_cantidad_poblacion_ise
		FROM 
			ec.informe_semanal_ejecucion_ise as ise,
			ec.actividades_ise as ai,
			ec.tipo_cantidad_poblacion_ise as tcpi
		WHERE 
			ai.informe_semanal_ejecucion_id  = ise.id
		AND 
			tcpi.id_actividad_ise = ai.id
		AND 
			ai.id in ($arrayIdActividad)
		AND
			ise.estado = 1 
		");
		$result1 = $command->queryAll();
		
		

		$poblacionBenficiadaDirecta =  [];
		$arrayIdCantidadPoblacion = [];
		foreach($result1 as $d )
		{
			@$poblacionBenficiadaDirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['tiempo_libre'];
            @$poblacionBenficiadaDirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['edu_derechos'];
            @$poblacionBenficiadaDirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['sexualidad_ciudadania'];
            @$poblacionBenficiadaDirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['medio_ambiente'];
			$arrayIdCantidadPoblacion[] = $d['id_tipo_cantidad_poblacion_ise'];
		}
		
		
		$poblacionBenficiadaIndirecta = [];
		foreach($result1 as $d )
		{
			@$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['familia'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['directivos'];
		}
		
	
		
		// $command = $connection->createCommand("
		// SELECT 
			// ise.fecha_inicio,
			// ise.fecha_fin,
			// ise.id_tipo_informe,
			// ei.grado_0, 
			// ei.grado_1, 
			// ei.grado_2, 
			// ei.grado_3, 
			// ei.grado_4, 
			// ei.grado_5, 
			// ei.grado_6, 
			// ei.grado_7, 
			// ei.grado_8,
			// ei.grado_9, 
			// ei.grado_10, 
			// ei.grado_11
		// FROM 
			// ec.estudiantes_ise as ei,
			// ec.informe_semanal_ejecucion_ise as ise
		// WHERE 	
			// ei.id_informe_semanal_ejecucion_ise  = ise.id
		// AND
		// ise.estado = 1
		// ");
		// $result2 = $command->queryAll();
		
		$arrayIdCantidadPoblacion  = implode(",", $arrayIdCantidadPoblacion);
		$command = $connection->createCommand("
		SELECT 
			ise.fecha_inicio,
			ise.fecha_fin,
			ise.id_tipo_informe,
			ei.grado_0, 
			ei.grado_1, 
			ei.grado_2, 
			ei.grado_3, 
			ei.grado_4, 
			ei.grado_5, 
			ei.grado_6, 
			ei.grado_7, 
			ei.grado_8,
			ei.grado_9, 
			ei.grado_10, 
			ei.grado_11
			
		FROM 
			ec.informe_semanal_ejecucion_ise as ise,
			ec.actividades_ise as ai,
			ec.tipo_cantidad_poblacion_ise as tcpi,
			ec.estudiantes_ise as ei
		WHERE 
			ai.informe_semanal_ejecucion_id  = ise.id
		AND 
			tcpi.id_actividad_ise = ai.id
		AND 
			ai.id in ($arrayIdActividad)
		AND 
			ei.id_tipo_cantidad_poblacion = tcpi.id
		AND 
			tcpi.id in ($arrayIdCantidadPoblacion)
		AND
			ise.estado = 1   
		");
		$result2 = $command->queryAll();
		
		foreach($result2 as $d )
		{
			@$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_0'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_1'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_2'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_3'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_4'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_5'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_6'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_7'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_8'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_9'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_10'];
            @$poblacionBenficiadaIndirecta[$d['fecha_inicio'] . " A " .$d['fecha_fin']][$d['id_tipo_informe']] += $d['grado_11'];
		}
		
		
		
		
		$reporte = "
		   <thead>
            <tr>
                <th>Fecha</th>
                <th>Eje</th>
                <th>Cnt. I.E.O sobre avance esperado</th>
                <th>Cnt. De sedes sobre avance esperadoe</th>
                <th>Porcentaje de I.E.O</th>
                <th>Porcentaje sobre sedes</th>
                <th>Porcentaje sobre actividad 1</th>
                <th>Porcentaje sobre actividad 2</th>
                <th>Porcentaje sobre actividad 3</th>
                <th>Población Beneficiada Directamente</th>
                <th>Población beneficiada de manera indirecta</th>
            </tr>
        </thead>
        <tbody>";
           

     
		
		$arrayEjes = [7 => 'PPT', 19 =>'PSSE', 31 =>'PAF'];
		foreach ($avanceIEO as $key => $avanceInstitucion)
		{
			foreach ($arrayEjes as $llave => $valor)
			{
				$reporte .= "<tr>";
				$reporte .= "<td>" . $key . "</td>";
				$reporte .= "<td>" . $valor . "</td>";
				$reporte .= "<td>" . @$avanceInstitucion[$llave] . "</td>";
				$reporte .= "<td>" . @$avanceSede[$key][$llave] . "</td>";
				$reporte .= "<td>" . @$porcentajeIEO[$key][$llave] . "</td>";
				$reporte .= "<td>" . @$porcentajesSedes[$key][$llave] . "</td>";
				$reporte .= "<td>" . @$activiadades[$key][$llave]['actividad_1_porcentaje'] . "</td>";
				$reporte .= "<td>" . @$activiadades[$key][$llave]['actividad_2_porcentaje'] . "</td>";
				$reporte .= "<td>" . @$activiadades[$key][$llave]['actividad_3_porcentaje'] . "</td>";
				$reporte .= "<td>" . @$poblacionBenficiadaDirecta[$key][$llave] . "</td>";
				$reporte .= "<td>" . @$poblacionBenficiadaIndirecta[$key][$llave] . "</td>";
				$reporte .= "</tr>";
			}
		}
		$reporte .= "</tbody>";
		$reporte .= "<tfoot>
			<tr>
				<th colspan='1' style='text-align:right'> </th>
				<th colspan='1' style='text-align:right'>Total</th>
				<th colspan='1' style='text-align:right'>Total:</th>
				<th colspan='1' style='text-align:right'>Total:</th>
				<th colspan='1' style='text-align:right'>Total:</th>
				<th colspan='1' style='text-align:right'>Total:</th>
				<th colspan='1' style='text-align:right'>Total:</th>
				<th colspan='1' style='text-align:right'>Total:</th>
				<th colspan='1' style='text-align:right'>Total:</th>
				<th colspan='1' style='text-align:right'>Total:</th>
				<th colspan='1' style='text-align:right'>Total:</th>
			</tr>
			
         
            
        </tfoot>";
		  
		
		}
		else
		{
			
			$reporte='	<table id="example" class="display" style="width:100%">
				<thead>
				<tr>
					<th>Fecha</th>
					<th>Eje</th>
					<th>Cnt. I.E.O sobre avance esperado</th>
					<th>Cnt. De sedes sobre avance esperadoe</th>
					<th>Porcentaje de I.E.O</th>
					<th>Porcentaje sobre sedes</th>
					<th>Porcentaje sobre actividad 1</th>
					<th>Porcentaje sobre actividad 2</th>
					<th>Porcentaje sobre actividad 3</th>
					<th>Población Beneficiada Directamente</th>
					<th>Población beneficiada de manera indirecta</th>
				</tr>
			</thead>
				<tbody>
					<tr>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
						<td>Sin Datos</td>
					</tr>
				</tbody>
			</table>';
		}
		
		return json_encode($reporte);
	}
	
	
	public function porcentaje($valor , $porcentaje)
	{
		return  explode(".",$valor / $porcentaje * 100 )[0] ;
	}


    /**
     * Updates an existing EcInformeSemanalTotalEjecutivo model.
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
     * Deletes an existing EcInformeSemanalTotalEjecutivo model.
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
     * Finds the EcInformeSemanalTotalEjecutivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EcInformeSemanalTotalEjecutivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EcInformeSemanalTotalEjecutivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
