<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CbacEquiposCampo */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Equipos Campos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="cbac-equipos-campo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
