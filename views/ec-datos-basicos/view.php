<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Personas;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Estados;
use app\models\Parametro;
use app\models\EcPlaneacion;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Planeación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::a('Volver', 
									[
										'index',
										'idTipoInforme' => $model->id_tipo_informe,
									], 
									['class' => 'btn btn-info']) ?>

<div class="ec-datos-basicos-view">

   <h1 style='background-color:#ccc;'><?= Html::encode("Datos Básicos") ?></h1>

    <p style='display:none'>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
				'attribute' => 'profesional_campo',
				'value' 	=> function( $model ){
					$persona = Personas::findOne( $model->profesional_campo );
					return $persona ? $persona->nombres." ".$persona->apellidos : '';
				},
			],
			[
				'attribute' => 'id_institucion',
				'value' 	=> function( $model ){
					$institucion = Instituciones::findOne( $model->id_institucion );
					return $institucion ? $institucion->descripcion : '';
				},
			],
			[
				'attribute' => 'id_sede',
				'value' 	=> function( $model ){
					$sedes = Sedes::findOne( $model->id_institucion );
					return $sedes ? $sedes->descripcion : '';
				},
			],
            'fecha_diligenciamiento',
			// [
				// 'attribute' => 'estado',
				// 'value' 	=> function( $model ){
					// $estado = Estados::findOne( $model->estado );
					// return $estado ? $estado->descripcion : '';
				// },
			// ],
        ],
    ]) ?>
	
	<div class='content-fluid'>
		
		<div class='row'>
		
			<div class='col-sm-6'>
	
				<h1 style='background-color:#ccc;'><?= Html::encode("Planeación misional") ?></h1>

				 <?= DetailView::widget([
					'model' => $modelPlaneacion,
					'attributes' => [
						'tipo_actividad',
						'fecha',
						'objetivo',
						'responsable',
						'rol',
						'descripcion_actividad',
					],
				]) ?>
				
				<h1 style='background-color:#ccc;'><?= Html::encode( "Medios de verificación y productos" ) ?></h1>
				
				
				<?= DetailView::widget([
					'model' => $modelVerificacion,
					'attributes' => [
						[
							'attribute' => 'tipo_verificacion',
							'value' 	=> function( $model ){
								$parametro = Parametro::findOne( $model->tipo_verificacion );
								return $parametro ? $parametro->descripcion : '';
							},
						],
						/*[ 
							'attribute' => 'ruta archivo' ,
							'format' 	=> 'raw' ,
							'value'		=> function( $model ){
								return Html::a( "Ver archivo", Url::to( "@web/".$model->ruta_archivo , true), [ "target"=>"_blank" ] );
							},
						],*/
					],
				]) ?>
			
			</div>
			
			<div class='col-sm-6'>
			
				<h1 style='background-color:#ccc;'><?= Html::encode( "Reportes" ) ?></h1>
				
				<?= DetailView::widget([
					'model' => $modelReportes,
					'attributes' => [
						'id_planeacion',
						'fecha_diligenciamiento',
						'ejecutado',
						'no_ejecutado',
						'variaciones',
						'observaciones',
					],
				]) ?>
			
			</div>
			
		</div>
		
	</div>

</div>
