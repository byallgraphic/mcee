<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Instituciones;
use app\models\Sedes;

/* @var $this yii\web\View */
/* @var $model app\models\CbacOrientacionProcesoSeguimiento */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Cbac Orientacion Proceso Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="cbac-orientacion-proceso-seguimiento-view">

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
            //'id',
            'seguimieno',
            'desde',
            'hasta',
            [	
            'attribute'=>'id_institcion',
            'value' => function( $model )
                {
                    $nombreInstituciones = Instituciones::findOne($model->id_institcion);
                    return $nombreInstituciones ? $nombreInstituciones->descripcion : '';  
                }, //para buscar por el nombre
            ],
            [
            'attribute'=>'id_sede',
            'value' => function( $model )
                {
                    $nombreSedes = Sedes::findOne($model->id_sede);
                    return $nombreSedes ? $nombreSedes->descripcion : '';  
                }, //para buscar por el nombre
            ],
            //'estado',
        ],
    ]) ?>

</div>
