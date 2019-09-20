<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PccTbCalendario */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Pcc Tb Calendarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="pcc-tb-calendario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>