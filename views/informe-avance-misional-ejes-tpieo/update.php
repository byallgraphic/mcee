<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformePlaneacionIeo */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Informe de avance misional ejes - Ejecutivo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="ec-informe-planeacion-ieo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'comunas' => $comunas,
		'barrios' => $barrios,
		'sedes'=> $sedes,
		'instituciones' => $instituciones,
		'fases' => $fases, 
		'codigoDane' => $codigoDane,
		'datos'=>$datos,
		'datoRespuesta'=>$datoRespuesta,
		'datoInformePlaneacionProyectos'=>$datoInformePlaneacionProyectos,
		'zonaEducativa' => $zonaEducativa
    ]) ?>

</div>
