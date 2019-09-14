<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcAvances */

$this->title = 'Agregar Ec Avances';
$this->params['breadcrumbs'][] = ['label' => 'Ec Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-avances-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
