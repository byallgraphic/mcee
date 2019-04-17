<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Gestión escolar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ge-seguimiento-operador-view">

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
            'id_tipo_seguimiento',
            'email:email',
            'id_operador',
            'cual_operador',
            'proyecto_reportar',
            'id_ie',
            'mes_reporte',
            'semana_reporte',
            'id_persona_responsable',
            'descripcion_actividad',
            'poblacion_beneficiaria',
            'quienes',
            'numero_participantes',
            'duracion_actividad',
            'logros_alcanzados',
            'dificultadades',
            'avances_cumplimiento_cuantitativos',
            'avances_cumplimiento_cualitativos',
            'dificultades',
            'propuesta_dificultades',
            'estado',
        ],
    ]) ?>

</div>
