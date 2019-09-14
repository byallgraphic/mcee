<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalEjePpt */

$this->title = 'Agregar Informe de avance misional del proyecto X EJE PPT';
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Eje Ppts', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-avance-misional-eje-ppt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'estados' => $estados,
    ]) ?>

</div>
