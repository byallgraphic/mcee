<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcProyectos */

$this->title = 'Agregar Ec Proyectos';
$this->params['breadcrumbs'][] = ['label' => 'Ec Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-proyectos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
