<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcInformeSemanalTotalEjecutivo */

$this->title = '5 y 6. InformeSemanalEjecución - Informe de cierre de fase - total ejecutivo';
$this->params['breadcrumbs'][] = ['label' => '5 y 6. InformeSemanalEjecución - Informe de cierre de fase - total ejecutivo', 'url' => ['index']];
$this->params['breadcrumbs'][] = "";

?>
<div class="ec-informe-semanal-total-ejecutivo-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5 style = "background-color: pink;" class="col-md-4" ><?= Html::encode("Filtrar por fecha para mostrar el promedio exacto") ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
