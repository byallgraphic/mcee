<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Parametro;
use app\models\ZonasEducativas;

/* @var $this yii\web\View */
/* @var $model app\models\EcInformePlaneacionIeo */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Informe Planeacion Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-informe-planeacion-ieo-view">

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
				'attribute' => 'id_sede',
				'value' 	=> function( $model ){
					$sede = Sedes::findOne( $model->id_sede );
					return $sede ? $sede->descripcion : '';
				},
			],
            'codigo_dane',
            [
				'attribute' => 'zona_educativa',
				'value' 	=> function( $model ){
					$zona = ZonasEducativas::findOne( $model->zona_educativa );
					return $zona ? $zona->descripcion : '';
				},
			],
           [
				'attribute' => 'fase',
				'value' 	=> function( $model ){
					$fase = Parametro::findOne( $model->fase );
					return $fase ? $fase->descripcion : '';
				},
			],
            'fecha_reporte',
        ],
    ]) ?>

</div>
