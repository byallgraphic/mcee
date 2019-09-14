<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalProyecto */

$this->title = 'Agregar Informe de avance misional del proyecto X PROYECTO';
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-avance-misional-proyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'estados' => $estados,
    ]) ?>

</div>
