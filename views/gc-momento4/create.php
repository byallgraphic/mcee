<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GcMomento4 */

$this->title = 'Momento 4';
$this->params['breadcrumbs'][] = ['label' => 'Momento 4', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="gc-momento4-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
