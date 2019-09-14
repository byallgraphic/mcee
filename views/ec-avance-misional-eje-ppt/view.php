<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalEjePpt */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Eje Ppts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-avance-misional-eje-ppt-view">

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
            'resposable_sem',
            'operador',
            'acciones_realizadas',
            'proceso_gestion_avances',
            'proceso_gestion_dificultades',
            'estrategias_avances',
            'estrategias_dificultades',
            'orientaciones_avances',
            'orientaciones_dificultades',
            'guia_avances',
            'guia_dificultades',
            'iniciativas_avances',
            'iniciativas_dificultades',
            'red_municipal_avances',
            'red_municipal_dificultades',
            'proyectos_avances',
            'proyectos_dificultades',
            'dispositivo_avances',
            'dispositivo_dificultades',
            'fuente_informacion',
            'avances_importantes',
            'dificultades_importantes',
            'alarmas_importantes',
            'estado',
        ],
    ]) ?>

</div>
