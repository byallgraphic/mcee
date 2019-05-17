<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperadorFrente */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Seguimiento Operador Frentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ge-seguimiento-operador-frente-view">

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
            'id_persona_diligencia',
            'id_gestor_a_evaluar',
            'mes_reporte',
            'fecha_corte',
            'cumple_cronograma:boolean',
            'descripcion_cronograma',
            'compromisos_establecidos',
            'cuantas_reuniones',
            'aportes_reuniones',
            'logros',
            'dificultades',
            'estado',
        ],
    ]) ?>

</div>
