<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcInformeAvanceEjecucionMisional */

$this->title = 'Agregar 9 Informe de avance ejecución y misional';
$this->params['breadcrumbs'][] = ['label' => 'Ec Informe Avance Ejecucion Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-informe-avance-ejecucion-misional-create">

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
