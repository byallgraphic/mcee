<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlanDeArea */

$this->title = 'Agregar Plan De Area';
$this->params['breadcrumbs'][] = ['label' => 'Plan De Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="plan-de-area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
