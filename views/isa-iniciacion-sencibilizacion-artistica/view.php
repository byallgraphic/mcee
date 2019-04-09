<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Instituciones;
use app\models\Sedes;

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSencibilizacionArtistica */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Isa Iniciacion Sencibilizacion Artisticas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="isa-iniciacion-sencibilizacion-artistica-view">

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
			'attribute'=>'caracterizacion_si_no',
			'value' => function( $model )
				{
					$arraySiNo = 
					[
						0 => "",
						1 => "Si",
						2 => "No",
					];
					
					return $arraySiNo[$model->caracterizacion_si_no];  
				}, //para buscar por el nombre
			],
            'caracterizacion_nombre',
            'caracterizacion_fecha',
            'caracterizacion_justificacion',
        ],
    ]) ?>

</div>
