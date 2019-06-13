<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;
use app\models\IsaPorcentajesActividades;
use app\models\IsIsaActividadesIsIsa;


$porcentajes = new IsaPorcentajesActividades();

$totalSesiones 	= 0;
$avanceSede 	= 0;
$avanceIEO 		= 0;

$data = IsIsaActividadesIsIsa::find()
				->alias( 'a' )
				->innerJoin( 'isa.informe_semanal_isa i', 'i.id=a.id_informe_semanal_isa' )
				->where( 'a.estado=1' )
				->andWhere( 'i.estado=1' )
				->andWhere( 'i.id_institucion='.$_SESSION['instituciones'][0] )
				->andWhere( 'a.id_actividad='.$idActividad )
				->all();

$totalIEO = count( $data );
foreach( $data as $k => $v ){
	$totalSesiones += $v['sesiones_realizadas'];
	
	$avanceIEO += $v['porcentaje']/$totalIEO;
	
	if($_SESSION['sede'][0] == $v['porcentaje'] )
		$avanceSede += $v['porcentaje'];
}

$data = IsIsaActividadesIsIsa::find()
				->alias( 'a' )
				->innerJoin( 'isa.informe_semanal_isa i', 'i.id=a.id_informe_semanal_isa' )
				->where( 'a.estado=1' )
				->andWhere( 'i.estado=1' )
				->andWhere( 'i.id_institucion='.$_SESSION['instituciones'][0] )
				->andWhere( 'i.id_sede='.$_SESSION['sede'][0] )
				->andWhere( 'a.id_actividad='.$idActividad )
				->all();


foreach( $data as $k => $v ){
	$avanceSede += $v['porcentaje'];
}


?>

<div class="container-fluid">
    <div class="ieo-form">
			<div class="row">
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]total_sesiones")->textInput(['readonly' => true, 'value' => $totalSesiones /*$datos['PorcentajesActividades'][$idActividad]['total_sesiones']*/ ])?></div>
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]avance_sede")->textInput( [ 'readonly' => true, 'value' => $avanceSede /*$datos['PorcentajesActividades'][$idActividad]['avance_sede']*/ ])?></div>
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]avance_ieo")->textInput( [ 'readonly' => true, 'value' => $avanceIEO /*$datos['PorcentajesActividades'][$idActividad]['avance_ieo']*/ ])?> </div>
			</div>
             

			<div class="row">
			  <div class="col-md-6"><?= $form->field($porcentajes, "[$idActividad]seguimiento_actividades")->textInput([ 'value' => $datos['PorcentajesActividades'][$idActividad]['seguimiento_actividades'] ])?></div>
			  <div class="col-md-6"><?= $form->field($porcentajes, "[$idActividad]evaluacion_actividades")->textInput([ 'value' => $datos['PorcentajesActividades'][$idActividad]['evaluacion_actividades'] ])?></div>
			</div>			 
                      
					<?= $form->field($porcentajes, "[$idActividad]id_actividades_seguimiento")->hiddenInput( [ 'value' => $idActividad ] )->label(false ) ?>
                    <?= $form->field($porcentajes, "[$idActividad]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
            </div>
</div>