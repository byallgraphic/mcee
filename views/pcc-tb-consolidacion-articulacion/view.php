<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PccTbConsolidacionArticulacion */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Pcc Tb Consolidacion Articulacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="pcc-tb-consolidacion-articulacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('Borrar', ['delete', 'id' => $model->Id], [
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
            'Id',
            'Fecha_accion',
            'Id_formador',
            'Nombre1',
            'Apellido1',
            'IE',
            'Mes',
            'Avance_actores:ntext',
            'Avance_transv:ntext',
            'Insercion_PEI:ntext',
            'Avance_biblio:ntext',
            'Avance_otros:ntext',
            'Adjuntos:ntext',
            'Observaciones:ntext',
        ],
    ]) ?>

</div>
