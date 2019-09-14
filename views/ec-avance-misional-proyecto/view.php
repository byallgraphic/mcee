<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalProyecto */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Avance Misional Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-avance-misional-proyecto-view">

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
            'equipo_sem',
            'operado',
            'acciones_realizadas',
            'actores_lideres',
            'proceso_gestion',
            'iniciativas_pedagogicas',
            'estudiantes',
            'fuente_informacion',
            'avances_importante',
            'dificultades_importantes',
            'alarmas_importantes',
            'estado',
        ],
    ]) ?>

</div>
