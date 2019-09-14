<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcInformePlaneacionIeo */

$this->title = 'Informe de avance Mensual I.E.O - Misional';
$this->params['breadcrumbs'][] = ['label' => 'Informe de avance Mensual I.E.O - Misional', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-informe-planeacion-ieo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
	    'model' => $model,
		'comunas' => $comunas,
		'sedes'=> $sedes,
		'instituciones' => $instituciones,
		'fases' => $fases, 
		'codigoDane' => $codigoDane,
		'datos'=>0,
		'datoRespuesta' => 0,
		'datoInformePlaneacionProyectos' =>0,
		'zonaEducativa' => $zonaEducativa,
		
    ]) ?>

</div>
