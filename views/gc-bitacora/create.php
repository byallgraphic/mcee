<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GcBitacora */

$this->title = 'Agregar Bitacora';
$this->params['breadcrumbs'][] = ['label' => 'Gc Bitacoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="gc-bitacora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'docentes' => $docentes,
		'sede' => $sede,
		'jornadas' => $jornadas,
		'ciclos' => $ciclos,
    ]) ?>

</div>
