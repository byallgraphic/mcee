<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Instituciones;
use app\models\Sedes;

/* @var $this yii\web\View */
/* @var $model app\models\InformeSemanalEjecucionIse */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Informe Semanal Ejecucion Ises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="informe-semanal-ejecucion-ise-view">

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
            'attribute'=>'institucion_id',
            'value' => function( $model )
                {
                    $nombreInstituciones = Instituciones::findOne($model->institucion_id);
                    return $nombreInstituciones ? $nombreInstituciones->descripcion : '';  
                }, //para buscar por el nombre
            ],
           /* [
            'attribute'=>'sede_id',
            'value' => function( $model )
                {
                    $nombreSedes = Sedes::findOne($model->sede_id);
                    return $nombreSedes ? $nombreSedes->descripcion : '';  
                }, //para buscar por el nombre
            ],*/
            'fecha_inicio',
            'fecha_fin',
            //'proyecto_id',
            //'estado',
        ],
    ]) ?>

</div>
