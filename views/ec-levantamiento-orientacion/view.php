<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Estados;
use yii\helpers\ArrayHelper;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Parametro;

/* @var $this yii\web\View */
/* @var $model app\models\EcLevantamientoOrientacion */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Levantamiento de orientación misional y método', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-levantamiento-orientacion-view">

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
            [
				'attribute'=>'id_institucion',
				'value' => function( $model )
				{
					$institucion = Instituciones::findOne($model->id_institucion);
					return $institucion ? $institucion->descripcion : '';
				}, 
			],
            [
				'attribute'=>'id_sede',
				'value' => function( $model )
				{
					$sedes = Sedes::findOne($model->id_sede);
					return $sedes ? $sedes->descripcion : '';
				}, //para buscar por el nombre
				'filter' 	=> ArrayHelper::map(Sedes::find()->all(), 'id', 'descripcion' ),
				
			],
            'visita_realizada',
            'actividad_seguimiento',
            'profesional_encargado',
            'fortalezas_identificadas',
            'necesidades_orientacion',
            'observacion_general',
            'uso_insumo',
			 [
				'attribute'=>'id_tipo_levantamiento',
				'value' => function( $model )
				{
					$nombreParametro = Parametro::findOne($model->id_tipo_levantamiento);
					return $nombreParametro ? $nombreParametro->descripcion : '';
				},
				
			],
           [
				'attribute'=>'estado',
				'value' => function( $model )
				{
					$nombreEstado = Estados::findOne($model->estado);
					return $nombreEstado ? $nombreEstado->descripcion : '';
				},
				
			],
        ],
    ]) ?>

</div>
