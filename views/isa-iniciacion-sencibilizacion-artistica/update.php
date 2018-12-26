<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSencibilizacionArtistica */

$this->title = 'Actualizar Iniciación Sensibilización Artistica';
$this->params['breadcrumbs'][] = ['label' => 'Iniciación Sensibilización Artistica', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="isa-iniciacion-sencibilizacion-artistica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
