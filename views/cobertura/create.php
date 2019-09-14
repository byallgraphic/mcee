<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cobertura */

$this->title = 'Agregar Cobertura';

$this->params['breadcrumbs'][] = ['label' => 'Coberturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="cobertura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'guardado', $guardado,
        'niñosInstitucion' =>  $niñosInstitucion,
        'niñasInstitucion' =>  $niñasInstitucion,
        'niñosSede' =>  $niñosSede,
        'niñasSede' =>  $niñasSede,
        'observaciones' => $observaciones,
    ]) ?>

</div>
