<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cobertura */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Coberturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="cobertura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
