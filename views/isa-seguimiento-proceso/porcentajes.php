<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;
use app\models\IsaPorcentajesActividades;
use app\models\IsIsaActividadesIsIsa;
use yii\helpers\ArrayHelper;

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
//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	$id = $_GET['id'];
	// traer el id de la tabla IsaOrientacionMetodologicaVariaciones para luego traer el modelo con los datos correspondintes
	$pa = new IsaPorcentajesActividades();
	$pa = $pa->find()->where("id_rom_actividades = $idActividad and id_seguimiento_proceso =". $id)->all();
	$pa = ArrayHelper::getColumn($pa,'id');
	
	// traer el modelo con los datos de cada actividad
	$porcentajes = IsaPorcentajesActividades::findOne($pa[0]);
}

?>

<div class="container-fluid">
    <div class="ieo-form">
			<div class="row">
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]total_sesiones")->textInput(['readonly' => true, 'value' => $totalSesiones  ])?></div>
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]avance_sede")->textInput( [ 'readonly' => true, 'value' => $avanceSede ])?></div>
			  <div class="col-md-4"><?= $form->field($porcentajes, "[$idActividad]avance_ieo")->textInput( [ 'readonly' => true, 'value' => $avanceIEO ])?> </div>
			</div>
             

			<div class="row">
			  <div class="col-md-6"><?= $form->field($porcentajes, "[$idActividad]seguimiento_actividades")->textInput( )?></div>
			  <div class="col-md-6"><?= $form->field($porcentajes, "[$idActividad]evaluacion_actividades")->textInput()?></div>
			</div>			 
					<?= $form->field($porcentajes, "[$idActividad]id_rom_actividades")->hiddenInput( [ 'value' => $idActividad ] )->label(false ) ?>
                    <?= $form->field($porcentajes, "[$idActividad]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
            </div>
</div>