<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\ZonasEducativas;

/* @var $this yii\web\View */
/* @var $model app\models\ImplementacionIeo */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Implementacion Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="implementacion-ieo-view">

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
            [
            'attribute'=>'sede_id',
            'value' => function( $model )
                {
                    $nombreSedes = Sedes::findOne($model->sede_id);
                    return $nombreSedes ? $nombreSedes->descripcion : '';  
                }, //para buscar por el nombre
            ],
            //'sede_id',
            //'zona_educativa',
            [
            'attribute'=>'zona_educativa',
            'value' => function( $model )
                {
                    $zona = ZonasEducativas::findOne($model->zona_educativa);
                    return $zona ? $zona->descripcion : '';  
                }, //para buscar por el nombre
            ],
            'comuna',
            'barrio',
            //'profesional_cargo',
            'horario_trabajo',
            //'estado',
        ],
    ]) ?>

</div>
