<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalSs */

$this->title = 'Agregar Informe de avance misional del proyecto X IEO SS';
$this->params['breadcrumbs'][] = ['label' => 'Agregar', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-avance-misional-ss-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'instituciones'=> $instituciones,
		'estados' => $estados,
    ]) ?>

</div>
