<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Evaluacion */

$this->title = 'Agregar Evaluacion';
$this->params['breadcrumbs'][] = ['label' => 'Evaluacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="evaluacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
