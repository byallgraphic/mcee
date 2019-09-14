<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GcMomento3 */

$this->title = 'Momento 3';
$this->params['breadcrumbs'][] = ['label' => 'Momento 3', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="gc-momento3-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
