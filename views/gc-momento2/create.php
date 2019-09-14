<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GcMomento2 */

$this->title = 'Momento 2';
$this->params['breadcrumbs'][] = ['label' => 'Momento 2', 'url' => ['index']];
// $this->params['breadcrumbs'][] = "Agregar";
?>
<div class="gc-momento2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'modelEvidenciasMomento2' => $modelEvidenciasMomento2,
        'planeacionDias' => $planeacionDias,
        'id_semana' => $id_semana
    ]) ?>

</div>
