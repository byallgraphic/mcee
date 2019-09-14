<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */

$this->title = 'Actualizar Seguimiento Operador';
$this->params['breadcrumbs'][] = ['label' => 'Seguimiento Operador', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="ge-seguimiento-operador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
