<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImplementacionIeo */

$this->title = 'Agregar Implementacion Ieo';
$this->params['breadcrumbs'][] = ['label' => 'Implementacion Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="implementacion-ieo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('__form', [
        'model' => $model,
        'zonasEducativas' => $zonasEducativas,
    ]) ?>

</div>
