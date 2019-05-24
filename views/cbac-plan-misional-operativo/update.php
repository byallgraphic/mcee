<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CbacPlanMisionalOperativo */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Plan Misional Operativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="cbac-plan-misional-operativo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
		'arraySiNo' => $arraySiNo,
    ]) ?>

</div>
