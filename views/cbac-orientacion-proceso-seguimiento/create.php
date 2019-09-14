<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CbacOrientacionProcesoSeguimiento */

$this->title = '4 Orientación del proceso Competencias Básicas Arte y Cultura Seguimiento';
$this->params['breadcrumbs'][] = ['label' => '4 Orientación del proceso Competencias Básicas Arte y Cultura Seguimiento', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="cbac-orientacion-proceso-seguimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
    ]) ?>

</div>
