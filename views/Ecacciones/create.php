<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcAcciones */

$this->title = 'Agregar Ec Acciones';
$this->params['breadcrumbs'][] = ['label' => 'Ec Acciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-acciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
