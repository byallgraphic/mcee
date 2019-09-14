<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformeEjecutivoEstado */

$this->title = 'Actualizar 4. Informe ejecutivo del estado del eje en la IEO';
$this->params['breadcrumbs'][] = ['label' => '4. Informe ejecutivo del estado del eje en la IEO', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="ec-informe-ejecutivo-estado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'persona' =>$persona,
		'coordinador' =>$coordinador,
		'secretario' =>$secretario,
		'instituciones'=> $instituciones,
		'ejes'=> $ejes,
    ]) ?>

</div>
