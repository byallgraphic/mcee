<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformeAvanceEjecucionMisional */

$this->title = 'Actualizar 9 Informe de avance ejecución y misional';
$this->params['breadcrumbs'][] = ['label' => 'Ec Informe Avance Ejecucion Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="ec-informe-avance-ejecucion-misional-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'coordinador' =>$coordinador,
		'secretario' =>$secretario,
		'instituciones'=> $instituciones,
		'coordinadorProyecto'=> $coordinadorProyecto,
		'ejes'=> $ejes,
    ]) ?>

</div>
