<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RomReporteOperativoMisional */

$this->title = 'Agregar Reporte Operativo Misional';
$this->params['breadcrumbs'][] = ['label' => 'Rom Reporte Operativo Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="rom-reporte-operativo-misional-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sedes' => $sedes,
        'institucion' => $institucion,
		'datos' => $datos,
		'actividadesParticipadas' => $actividadesParticipadas,
    ]) ?>

</div>
