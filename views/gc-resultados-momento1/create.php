<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GcResultadosMomento1 */

$this->title = 'Agregar Gc Resultados Momento1';
$this->params['breadcrumbs'][] = ['label' => 'Gc Resultados Momento1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="gc-resultados-momento1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
