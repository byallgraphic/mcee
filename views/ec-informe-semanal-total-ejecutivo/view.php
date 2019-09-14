<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformeSemanalTotalEjecutivo */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Informe Semanal Total Ejecutivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-informe-semanal-total-ejecutivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'institucion_id',
            'cantidad_ieo',
            'cantidad_sedes',
            'porcentaje_ieo',
            'porcentaje_sedes',
            'porcentaje_actividad_uno',
            'porcentaje_actividad_dos',
            'porcentaje_actividad_tres',
            'poblacion_beneficiada_directa',
            'poblacion_beneficiada_indirecta',
            'alarmas_generales',
        ],
    ]) ?>

</div>
