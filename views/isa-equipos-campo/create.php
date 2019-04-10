<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaEquiposCampo */

$this->title = 'Agregar Equipos Campo';
$this->params['breadcrumbs'][] = ['label' => 'Equipos Campos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="isa-equipos-campo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
