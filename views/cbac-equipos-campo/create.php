<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CbacEquiposCampo */

$this->title = 'Agregar Cbac Equipos Campo';
$this->params['breadcrumbs'][] = ['label' => 'Cbac Equipos Campos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="cbac-equipos-campo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
