<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSencibilizacionArtistica */

$this->title = 'Agregar Iniciación Sensibilización Artistica';
$this->params['breadcrumbs'][] = ['label' => 'Iniciación Sensibilización Artistica', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="isa-iniciacion-sencibilizacion-artistica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
    ]) ?>

</div>
