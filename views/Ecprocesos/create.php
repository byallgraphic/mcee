<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcProcesos */

$this->title = 'Agregar Ec Procesos';
$this->params['breadcrumbs'][] = ['label' => 'Ec Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-procesos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
