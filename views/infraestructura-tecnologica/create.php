<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InfraestructuraTecnologica */

$this->title = 'Agregar Infraestructura Tecnológica';
$this->params['breadcrumbs'][] = ['label' => 'Infraestructura Tecnologicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="infraestructura-tecnologica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
