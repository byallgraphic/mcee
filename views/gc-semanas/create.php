<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GcSemanas */

$this->title = 'Agregar Gc Semanas';
$this->params['breadcrumbs'][] = ['label' => 'Gc Semanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="gc-semanas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
