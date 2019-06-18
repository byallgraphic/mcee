<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Instituciones;
use app\models\Sedes;
/* @var $this yii\web\View */
/* @var $model app\models\IsaSeguimientoProceso */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Isa Seguimiento Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="isa-seguimiento-proceso-view">

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
            'fecha',
            
			[
				'attribute' => 'id_institucion',
				'value' => function( $model ){
					$institucion = Instituciones::findOne( $model->id_institucion );
					return $institucion ? $institucion->descripcion: '' ;
				},
			],
			[
				'attribute' => 'id_sede',
				'value' => function( $model ){
					$sedes = Sedes::findOne($model->id_sede);
					return $sedes ? $sedes->descripcion : '';
				},
			],
        ],
    ]) ?>

</div>
