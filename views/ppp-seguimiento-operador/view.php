<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\PppTipoSeguimiento;
use app\models\Parametro;
use app\models\Instituciones;
use app\models\Personas;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ge Seguimiento Operadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ge-seguimiento-operador-view">

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
				'attribute'=>'id_tipo_seguimiento',
				'value' => function( $model )
				{
					
					$tipoSeguimiento = PppTipoSeguimiento::findOne($model->id_tipo_seguimiento);
					return $tipoSeguimiento->descripcion;
				},
				
			], 
            'email',
			[
				'attribute'=>'id_operador',
				'value' => function( $model )
				{
					
					$operador = Parametro::findOne($model->id_operador);
					return $operador->descripcion;
				},
				
			],
            'cual_operador',
            'proyecto_reportar',
			[
				'attribute'=>'id_ie',
				'value' => function( $model )
				{
					
					$instituciones = Instituciones::findOne($model->id_ie);
					return $instituciones->descripcion;
				},
				
			],
			[
				'attribute'=> 'mes_reporte',
				'value' => function( $model )
				{
						$mesReporte = [
						1  => 'Enero',
						2  => 'Febrero',
						3  => 'Marzo',
						4  => 'Abril',
						5  => 'Mayo',
						6  => 'Junio',
						7  => 'Julio',
						8  => 'Agosto',
						9  => 'Septiembre',
						10 => 'Octubre',
						11 => 'Noviembre',
						12 => 'Diciembre',
					];
					return $mesReporte[$model->mes_reporte];
				},
				
			],
           
            [
				'attribute'=>'id_persona_responsable',
				'value' => function( $model )
				{
					
					$personas = Personas::findOne($model->id_persona_responsable);
					return $personas ? $personas->nombres." ".$personas->apellidos : '';
				},
				
			],
            'descripcion_actividad',
            'poblacion_beneficiaria',
            'quienes',
            'numero_participantes',
            'duracion_actividad',
            'logros_alcanzados',
            'dificultadades',
            'avances_cumplimiento_cuantitativos',
            'avances_cumplimiento_cualitativos',
            'dificultades',
            'propuesta_dificultades',
        ],
    ]) ?>

</div>
