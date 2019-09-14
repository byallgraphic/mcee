<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InformeSemanalEjecucionIse */

$this->title = 'Agregar Informe Semanal Ejecucion Ise';
$this->params['breadcrumbs'][] = ['label' => 'Informe Semanal Ejecucion Ises', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="informe-semanal-ejecucion-ise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'institucion' => $institucion,
        'sedes' => $sedes,
    ]) ?>

</div>
