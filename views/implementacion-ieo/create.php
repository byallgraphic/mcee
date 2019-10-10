<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImplementacionIeo */

$this->title = 'Agregar Informe de avance Mensual I.E.O Fase Implementación Plan de acción - Ejecución';
$this->params['breadcrumbs'][] = ['label' => 'Informe de avance Mensual I.E.O Fase Implementación Plan de acción - Ejecución', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="implementacion-ieo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('__form', [
        'model' => $model,
        'zonasEducativas' => $zonasEducativas,
        'nombres' => $nombres,
        'comunas' => $comunas,
		'sede' => $sede,
		'institucion'=> $institucion,
    ]) ?>

</div>
