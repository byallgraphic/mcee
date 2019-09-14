<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GcMomento1 */

$this->title = 'Momento 1';
$this->params['breadcrumbs'][] = ['label' => 'Momento 1', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Momento 1";
?>
<div class="gc-momento1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'propositos' => $propositos,
		'modelPlaneacionxdia' => $modelPlaneacionxdia,
		'diasPlaneacion' => $diasPlaneacion,
		'modelResultadosMomento1' => $modelResultadosMomento1,
    ]) ?>

</div>
