<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Programas */

$this->title = 'Agregar Programas';
$this->params['breadcrumbs'][] = ['label' => 'Programas', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="programas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
