<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaProyectosSeguimiento */

$this->title = 'Agregar Isa Proyectos Seguimiento';
$this->params['breadcrumbs'][] = ['label' => 'Isa Proyectos Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="isa-proyectos-seguimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
