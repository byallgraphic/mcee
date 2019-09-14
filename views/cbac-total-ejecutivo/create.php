<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CbacTotalEjecutivo */

$this->title = 'Agregar Consolidado por mes Competencias Basicas Arte y Cultura Total Ejecutivo';
$this->params['breadcrumbs'][] = ['label' => '5 Consolidado por mes Competencias Basicas Arte y Cultura Total Ejecutivo', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="cbac-total-ejecutivo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'avance_ieo' => $avance_ieo,
        'avance_actividad_sede' => $avance_actividad_sede,
        'avance_actividad_ieo' => $avance_actividad_ieo,
        'beneficiarios' => $beneficiarios,
        'sesiones_realizadas_ieo' => $sesiones_realizadas_ieo,
        'sesiones_aplazadas_ieo' => $sesiones_aplazadas_ieo,
        'sesiones_canceladas_ieo' => $sesiones_canceladas_ieo,
        'avance_objetivos_sede' => $avance_objetivos_sede,
    ]) ?>

</div>
