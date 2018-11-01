<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ieo */

$this->title = 'Informe de avance mensual IEO fase plan de acción';
$this->params['breadcrumbs'][] = ['label' => 'Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ieo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('__form', [
        'model' => $model,
        'requerimientoExtra' => $requerimientoExtra,
        "documentosReconocimiento" =>  $documentosReconocimiento,
        'tiposCantidadPoblacion' => $tiposCantidadPoblacion,
        'estudiantesGrado' => $estudiantesGrado,
        "evidencias" => $evidencias,
        'zonasEducativas' => $zonasEducativas,
    ]) ?>

</div>
