<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SemillerosTicDiarioDeCampoEstudiantes */

$this->title = "Detalle";
$this->params['breadcrumbs'][] = ['label' => 'Semilleros Tic Diario De Campo Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="semilleros-tic-diario-de-campo-estudiantes-view">

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
            'id_fase',
            'estado',
        ],
    ]) ?>

</div>
