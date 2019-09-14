<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estimulos */

$this->title = 'Agregar Estimulos';
$this->params['breadcrumbs'][] = ['label' => 'Estimulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="estimulos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
