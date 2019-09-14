<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IsaOrientacionProceso */

$this->title = 'Actualizar Orientación Proceso';
$this->params['breadcrumbs'][] = ['label' => 'Isa Orientacion Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="isa-orientacion-proceso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'instituciones'=> $instituciones,
		'datos' => $datos
    ]) ?>

</div>
