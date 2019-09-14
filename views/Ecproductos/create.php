<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcProductos */

$this->title = 'Agregar Ec Productos';
$this->params['breadcrumbs'][] = ['label' => 'Ec Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-productos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
