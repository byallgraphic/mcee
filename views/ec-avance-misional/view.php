<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalAf */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Afs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-avance-misional-af-view">

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
            'id_institucion',
            'id_sede',
            'fecha_inicio',
            'fecha_fin',
            'responsable_sem',
            'operador',
            'acciones_realizadas',
            'acompanamiento_pedagogico_avances',
            'acompanamiento_pedagogico_dificultades',
            'comunicacion_pedagogica_avances',
            'comunicacion_pedagogica_difcultades',
            'organismos_mecanismos_avances',
            'organismos_mecanismos_dificultades',
            'fuente_informacion',
            'avances_acompanamiento',
            'dificultades_acompanamiento',
            'alarmas_importantes',
            'estado',
        ],
    ]) ?>

</div>
