<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PlantaDocenteAdministrativa */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Planta Docente Administrativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="planta-docente-administrativa-view">

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
            'descripcion',
            'tipo_documento_id',
            'ruta',
            'estado',
        ],
    ]) ?>

</div>
