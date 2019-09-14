<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PlanDeArea */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Plan De Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="plan-de-area-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
