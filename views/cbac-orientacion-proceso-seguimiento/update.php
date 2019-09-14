<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CbacOrientacionProcesoSeguimiento */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Orientacion Proceso Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="cbac-orientacion-proceso-seguimiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
    ]) ?>

</div>
