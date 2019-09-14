<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IsaConsolidadoMisional */

$this->title = 'Actualizar Consolidado Misional';
$this->params['breadcrumbs'][] = ['label' => 'Isa Consolidado Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="isa-consolidado-misional-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'institucion'=> $institucion,
    ]) ?>

</div>
