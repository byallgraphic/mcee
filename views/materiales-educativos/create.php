<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaterialesEducativos */

$this->title = 'Agregar Materiales Educativos';
$this->params['breadcrumbs'][] = ['label' => 'Materiales Educativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="materiales-educativos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'tipo' => $tipo,
		'autor' => $autor,
		'nivel' => $nivel,
		'estados' => $estados,
    ]) ?>

</div>

