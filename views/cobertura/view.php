<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cobertura */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Coberturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="cobertura-view">

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
            'categoria_cobertura_id',
            'subcategoria',
            'tema_id',
            'institucion_id',
            'cantidad_niños_institucion',
            'cantidad_niñas_institucion',
            'sede_id',
            'cantidad_niños_sede',
            'cantidad_niñas_sede',
        ],
    ]) ?>

</div>
