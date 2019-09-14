<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PccTbConsolidacionArticulacion */

$this->title = 'Agregar Pcc Tb Consolidacion Articulacion';
$this->params['breadcrumbs'][] = ['label' => 'Pcc Tb Consolidacion Articulacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="pcc-tb-consolidacion-articulacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
