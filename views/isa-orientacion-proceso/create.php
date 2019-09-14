<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaOrientacionProceso */

$this->title = 'Agregar Orientación Proceso';
$this->params['breadcrumbs'][] = ['label' => 'Isa Orientacion Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="isa-orientacion-proceso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'instituciones'=> $instituciones,
		'datos' => 0,
    ]) ?>

</div>
