<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Datos Basicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ec-datos-basicos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'profesional_campo',
            'id_institucion',
            'id_sede',
            'fecha_diligenciamiento',
            'estado',
        ],
    ]) ?>

</div>
