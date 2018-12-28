<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CbacConsolidadoMesCbac */

$this->title = 'Agregar Cbac Consolidado Mes Cbac';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Consolidado Mes Cbacs', 'url' => ['index']];
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
