<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSensibilizacionArtisticaConsolidado */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Isa Iniciacion Sensibilizacion Artistica Consolidados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="isa-iniciacion-sensibilizacion-artistica-consolidado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
