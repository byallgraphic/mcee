<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlanEstudios */

$this->title = 'Agregar Plan Estudios';
$this->params['breadcrumbs'][] = ['label' => 'Plan Estudios', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="plan-estudios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
