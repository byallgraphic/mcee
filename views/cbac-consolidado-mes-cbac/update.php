<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CbacConsolidadoMesCbac */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Consolidado Mes Cbacs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="cbac-consolidado-mes-cbac-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
        'datos'=> $datos,
    ]) ?>

</div>
