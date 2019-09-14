<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcRespuestas */

$this->title = 'Agregar Ec Respuestas';
$this->params['breadcrumbs'][] = ['label' => 'Ec Respuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-respuestas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
