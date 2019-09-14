<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalPpt */

$this->title = 'Agregar Informe de avance misional del proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Informe de avance misional del proyecto', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-avance-misional-ppt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'instituciones'=> $instituciones,
		'estados'=>$estados,
    ]) ?>

</div>
