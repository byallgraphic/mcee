<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalEjePpt */

$this->title = 'Actualizar Informe de avance misional del proyecto X EJE PPT';
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Eje Ppts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="ec-avance-misional-eje-ppt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'estados' => $estados,
    ]) ?>

</div>
