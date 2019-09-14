<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Estados;
use app\models\NombresProyectosParticipacion;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\Personas;
use app\models\Perfiles;

/* @var $this yii\web\View */
/* @var $model app\models\ParticipacionProyectosMaestro */

$this->title = "Detalle";
$this->params['breadcrumbs'][] = [
									'label'	=> 'Participacion en proyectos de maestros', 
									'url'	=> [
													'index',
													'idSedes' 		=> $idSedes,
													'idInstitucion'	=> $idInstitucion,
												],
								];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="participacion-proyectos-maestro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            [ 
				'attribute' => 'programa_proyecto',
				'value' 	=> function( $model ){
					$nombreProyecto = NombresProyectosParticipacion::findOne( $model->programa_proyecto );
					return $nombreProyecto ? $nombreProyecto->descripcion : '';
				},
				
			],
            [ 
				'attribute' => 'participante',
				'value'		=> function( $model ){
					$persona = Personas::findOne( $model->participante );
					return $persona ? $persona->nombres." ".$persona->apellidos : '';
				}
			],
            [ 
				'attribute' => 'tipo',
				'value'		=> function( $model ){
					$perfil = Perfiles::findOne( $model->tipo );
					return $perfil ? $perfil->descripcion : '';
				},
			],
            'objeto',
            'duracion',
            'anio_inicio',
            'anio_fin',
            'tematica',
            'areas',
            'otros',
            'materiales_recursos',
            'logros',
            'observaciones',
            [ 
				'attribute' => 'id_institucion',
				'value'		=> function( $model ){
					$instituciones = Instituciones::findOne( $model->id_institucion );
					return $instituciones ? $instituciones->descripcion : '';
				},
			],
            [ 
				'attribute' => 'estado',
				'value' 	=> function( $model ){
					$estados = Estados::findOne( $model->estado );
					return $estados ? $estados->descripcion : '';
				},
			],
        ],
    ]) ?>

</div>
