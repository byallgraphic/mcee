<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estimulos */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Estimulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="estimulos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
