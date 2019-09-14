<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Instituciones;
use app\models\Sedes;
/* @var $this yii\web\View */
/* @var $model app\models\CbacPlanMisionalOperativo */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => '1 Planeación Competencias Básicas Arte y Cultura', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="cbac-plan-misional-operativo-view">

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
            [
            'attribute'=>'id_institucion',
            'value' => function( $model )
                {
                    $nombreInstituciones = Instituciones::findOne($model->id_institucion);
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
            [
            'attribute'=>'caracterizacion_diagnostico',
            'value' => function( $model )
                {
                    
                    return $model->caracterizacion_diagnostico == 0 ? "SI" : 'NO';  
                }, //para buscar por el nombre
            ],
            //'caracterizacion_diagnostico',
            'fecha_caracterizacion_',
            'nombre_caracterizacion',
            'caracterizacion_no_justificacion',
            //'estado',
        ],
    ]) ?>

</div>
