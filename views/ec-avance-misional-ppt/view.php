<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalPpt */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Ppts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-avance-misional-ppt-view">

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
            'procesos_gestion_avances',
            'procesos_gestion_dificultades',
            'estrategias_tranversalizacion_avances',
            'estrategias_tranversalizacion_difcultades',
            'orientacion_conceptuales_avances',
            'orientacion_conceptuales_dificultades',
            'fuente_informacion',
            'avances_acompanamiento',
            'dificultades_acompanamiento',
            'alarmas_importantes',
        ],
    ]) ?>

</div>
