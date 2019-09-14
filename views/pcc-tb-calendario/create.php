<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PccTbCalendario */

$this->title = 'Agregar Pcc Tb Calendario';
$this->params['breadcrumbs'][] = ['label' => 'Pcc Tb Calendarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="pcc-tb-calendario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
