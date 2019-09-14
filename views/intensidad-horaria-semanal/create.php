<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IntensidadHorariaSemanal */

$this->title = 'Agregar Intensidad Horaria Semanal';
$this->params['breadcrumbs'][] = ['label' => 'Intensidad Horaria Semanales', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="intensidad-horaria-semanal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'tiposDocumento' => $tiposDocumento,
    ]) ?>

</div>
