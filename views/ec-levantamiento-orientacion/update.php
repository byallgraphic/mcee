<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EcLevantamientoOrientacion */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'E+C Levantamiento Orientacion', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="ec-levantamiento-orientacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sedes' => $sedes,
		'instituciones' => $instituciones,
		'estados' =>$estados,
		'parametros' =>$parametros,
		'idTipoInforme' => $idTipoInforme,
    ]) ?>

</div>
