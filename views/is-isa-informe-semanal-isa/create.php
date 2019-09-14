<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsIsaInformeSemanalIsa */

$this->title = 'Agregar Informe Semanal';
$this->params['breadcrumbs'][] = ['label' => 'Is Isa Informe Semanal Isas', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="is-isa-informe-semanal-isa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
    ]) ?>

</div>
