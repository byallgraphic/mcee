<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalSs */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Sses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-avance-misional-ss-view">

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
            'gestion_institucional_avances',
            'gestion_institucional_dificultades',
            'proyectos_servicio_social_avances',
            'proyectos_servicio_social_difcultades',
            'competencias_habilidades_avances',
            'competencias_habilidades_dificultades',
            'fuente_informacion',
            'avances_acompanamiento',
            'dificultades_acompanamiento',
            'alarmas_importantes',
            'estado',
        ],
    ]) ?>

</div>
