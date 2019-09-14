<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CbacOrientacionProcesoCbac */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Orientacion Proceso Cbacs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="cbac-orientacion-proceso-cbac-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'datos'=>$datos,
        'institucion' => $institucion,
    ]) ?>

</div>
