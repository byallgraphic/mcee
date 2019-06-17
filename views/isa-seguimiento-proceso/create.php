<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaSeguimientoProceso */

$this->title = 'Agregar Isa Seguimiento Proceso';
$this->params['breadcrumbs'][] = ['label' => 'Isa Seguimiento Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="isa-seguimiento-proceso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'model' => $model,
		'sedes' => $sedes,
		'instituciones'=> $instituciones,
		'datos' => 0,
    ]) ?>

</div>
