<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ieo */

$this->title = 'Agregar Ieo';
$this->params['breadcrumbs'][] = ['label' => 'Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ieo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
