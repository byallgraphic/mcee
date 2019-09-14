<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSensibilizacionArtisticaConsolidado */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Isa Iniciacion Sensibilizacion Artistica Consolidados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="isa-iniciacion-sensibilizacion-artistica-consolidado-view">

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
            'fecha',
            'id_institucion',
            'id_sede',
            'estado',
            'total_sesiones_realizadas',
            'avance_por_mes',
            'total_sesiones_aplazadas',
            'total_sesiones_canceladas',
            'vecinos',
            'lideres_comunitarios',
            'empresarios_comerciantes_microempresas',
            'representantes_organizaciones_locales',
            'asociaciones_grupos_comunitarios',
            'otros_actores',
            'actas',
            'reportes',
            'listados',
            'plan_trabajo',
            'formato_seguimiento',
            'formato_evaluacion',
            'fotografias',
            'videos',
            'otros_productos',
            'id_actividad',
        ],
    ]) ?>

</div>
