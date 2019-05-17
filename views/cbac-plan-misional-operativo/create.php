<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CbacPlanMisionalOperativo */

$this->title = '1 Planeación Competencias Básicas Arte y Cultura';
$this->params['breadcrumbs'][] = ['label' => '1 Planeación Competencias Básicas Arte y Cultura', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="cbac-plan-misional-operativo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
		'arraySiNo' => $arraySiNo,
    ]) ?>

</div>
