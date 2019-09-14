<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModeloPedagogico */

$this->title = 'Agregar Modelo Pedagógico';
$this->params['breadcrumbs'][] = ['label' => 'Modelo Pedagogicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="modelo-pedagogico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
