<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GcBitacora */

$this->title = 'Actualizar Bitacora';
$this->params['breadcrumbs'][] = ['label' => 'Gc Bitacoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="gc-bitacora-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'docentes' => $docentes,
		'sede' => $sede,
		'jornadas' => $jornadas,
		'ciclos' => $ciclos,
    ]) ?>

</div>
