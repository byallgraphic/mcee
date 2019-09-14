<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlanEvaluacion */

$this->title = 'Agregar Plan de Evaluación';
$this->params['breadcrumbs'][] = ['label' => 'Plan de Evaluación', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="plan-evaluacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
