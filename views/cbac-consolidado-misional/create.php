<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaConsolidadoMisional */

$this->title = 'Agregar Consolidado Misional';
$this->params['breadcrumbs'][] = ['label' => 'Isa Consolidado Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="isa-consolidado-misional-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'institucion'=> $institucion,
    ]) ?>

</div>
