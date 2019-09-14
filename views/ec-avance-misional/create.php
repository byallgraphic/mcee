<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalAf */

$this->title = 'Agregar Informe de avance misional';
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Afs', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-avance-misional-af-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'instituciones'=> $instituciones,
		'estados'=>$estados,
    ]) ?>

</div>
