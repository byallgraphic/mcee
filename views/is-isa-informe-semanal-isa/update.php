<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IsIsaInformeSemanalIsa */

$this->title = 'Actualizar Informe Semanal';
$this->params['breadcrumbs'][] = ['label' => 'Informe Semanal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="is-isa-informe-semanal-isa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
