<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GcMomento3 */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Gc Momento3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="gc-momento3-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
