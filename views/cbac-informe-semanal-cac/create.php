<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CbacInformeSemanalCac */

$this->title = 'Nuevo Informe de ejecución semanal Competencias Arte y Cultura';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Informe Semanal Cacs', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="cbac-informe-semanal-cac-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
    ]) ?>

</div>
