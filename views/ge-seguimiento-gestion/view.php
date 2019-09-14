<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoGestion */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ge Seguimiento Gestions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ge-seguimiento-gestion-view">

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
            'id_ie',
            'id_cargo',
            'id_nombre',
            'fecha',
            'id_persona_gestor',
            'numero_visitas',
            'socializo_plan',
            'plan_trabajo_socializo',
            'descripcion_plan_trabajo',
            'cronocrama_propuesto',
            'descripcion_cronograma',
            'avances_proyectos',
            'dificultades',
            'mejoras',
            'observaciones',
            'calificacion_nivel',
            'descripcion_calificacion',
            'estado',
        ],
    ]) ?>

</div>
