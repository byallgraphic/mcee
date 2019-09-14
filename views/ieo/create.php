<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ieo */

$this->title = '3.A Informe de avance Mensual I.E.O Fase Plan de acción - Ejecución';
$this->params['breadcrumbs'][] = ['label' => 'Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar Informe de avance Mensual I.E.O Fase Plan de acción - Ejecución";
?>
<div class="ieo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'zonasEducativas' => $zonasEducativas,
        'comunas' => $comunas,
		'personaACargo' => $personaACargo

    ]) ?>

</div>
