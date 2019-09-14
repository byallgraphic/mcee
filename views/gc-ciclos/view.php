<?php
/**********
Versión: 001
Fecha: 2019-01-29
Desarrollador: Edwin Molina Grisales
Descripción: Ciclos
---------------------------------------
**********/

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Personas;
use app\models\GcDocentesXBitacora;

/* @var $this yii\web\View */
/* @var $model app\models\GcCiclos */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Gc Ciclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="gc-ciclos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('Borrar', ['delete', 'id' => $modelCiclo->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $modelCiclo,
        'attributes' => [
            'fecha',
            'descripcion',
            'fecha_inicio',
            'fecha_finalizacion',
            'fecha_cierre',
            'fecha_maxima_acceso',
            [ 
				'attribute' => 'id_creador',
				'value' => function( $model ){
					$persona = Personas::findOne( $model->id_creador );
					return $persona ? $persona->nombres." ".$persona->apellidos: '';
				},
			],
            // 'estado',
        ],
    ]) ?>
	
	<?= DetailView::widget([
        'model' => $modelBitacora,
        'attributes' => [
            [ 
				'attribute' => 'id',
				'label' 	=> 'Docentes',
				'format'	=> 'raw',
				'value' 	=> function( $model ){
					
					$docentes = [];
					
					$modelDocentesXBitacora = GcDocentesXBitacora::findAll([ 'id_bitacora' => $model->id ]);
					
					foreach( $modelDocentesXBitacora as $key => $model )
					{
						$persona 	= Personas::findOne( $model->docente );
						$docentes[] = $persona ? $persona->nombres." ".$persona->apellidos: '';
					}
					
					return Html::ul( $docentes );
				},
			],
            // 'estado',
        ],
    ]) ?>
	
	<?php foreach( $modelSemanas as $index => $modelSemana ) : ?>
	
		<h1 style='text-align:center;'>Semana<?= $index+1 ?></h1>
	
		<?= DetailView::widget([
			'model' => $modelSemana,
			'attributes' => [
				'fecha_inicio',
				'fecha_finalizacion',
				'fecha_cierre',
				'descripcion',
				// 'estado',
			],
		]) ?>
		
	<?php endforeach; ?>

</div>
