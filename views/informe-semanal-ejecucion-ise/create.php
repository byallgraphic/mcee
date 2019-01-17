<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InformeSemanalEjecucionIse */

$this->title = '5 y 6. Informe Semanal Ejecución - Informe de cierre de fase';
$this->params['breadcrumbs'][] = ['label' => '5 y 6. Informe Semanal Ejecución - Informe de cierre de fase', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="informe-semanal-ejecucion-ise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'institucion' => $institucion,
        'sedes' => $sedes,
    ]) ?>

</div>
