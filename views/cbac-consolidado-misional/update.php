<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CbacConsolidadoMisional */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Consolidado Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="cbac-consolidado-misional-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'institucion' => $institucion,
        'sedes' => $sedes,
        'datos'=>$datos,
    ]) ?>

</div>
