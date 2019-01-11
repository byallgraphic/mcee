<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GcCiclos */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Gc Ciclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="gc-ciclos-view">

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
            'descripcion',
            'fecha_inicio',
            'fecha_finalizacion',
            'fecha_cierre',
            'fecha_maxima_acceso',
            'id_creador',
            'estado',
            'id_semana',
        ],
    ]) ?>

</div>
