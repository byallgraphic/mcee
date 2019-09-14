<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CbacConsolidadoMisional */

$this->title = '5 Consolidado por mes Competencias Basicas Arte y Cultura Misional';
$this->params['breadcrumbs'][] = ['label' => 'Consolidado por mes Competencias Básicas Arte y Cultura Misional', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="cbac-consolidado-misional-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
    ]) ?>

</div>
