<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CbacConsolidadoMesCbac */

$this->title = 'Agregar Consolidado por mes Competencias Básicas Arte y Cultura';
$this->params['breadcrumbs'][] = ['label' => 'Consolidado por mes Competencias Básicas Arte y Cultura', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="cbac-consolidado-mes-cbac-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
    ]) ?>

</div>
