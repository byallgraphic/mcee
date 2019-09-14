<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Instituciones;
use app\models\EcProyectos;
use app\models\PerfilesXPersonas;
use app\models\Personas;
use app\models\PerfilesXPersonasInstitucion;
/* @var $this yii\web\View */
/* @var $model app\models\EcInformeAvanceEjecucionMisional */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Informe Avance Ejecucion Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-informe-avance-ejecucion-misional-view">

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
				'attribute' => 'id_eje',
				'value'		=> function( $model )
								{
									$ejes = EcProyectos::findOne($model->id_eje);
									return $ejes ? $ejes->descripcion: '';
							    },
			],
			[
			'attribute'=>'id_coordinador',
			'value' => function( $model )
				{
					
					$idPerfilesXpersonas	= PerfilesXPersonasInstitucion::findOne($model->id_coordinador)->id_perfiles_x_persona;
					$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
					$nombres 				= Personas::findOne($perfiles_x_persona);
					$nombres				= $nombres->nombres." ".$nombres->apellidos;
					
					return $nombres;
				}, 
			],
			[
			'attribute'=>'id_secretaria',
			'value' => function( $model )
				{
					
					$idPerfilesXpersonas	= PerfilesXPersonasInstitucion::findOne($model->id_secretaria)->id_perfiles_x_persona;
					$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
					$nombres 				= Personas::findOne($perfiles_x_persona);
					$nombres				= $nombres->nombres." ".$nombres->apellidos;
					
					return $nombres;
				}, 
			],
			[
			'attribute'=>'id_coor_proyecto_uni',
			'value' => function( $model )
				{
					
					$idPerfilesXpersonas	= PerfilesXPersonasInstitucion::findOne($model->id_coor_proyecto_uni)->id_perfiles_x_persona;
					$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
					$nombres 				= Personas::findOne($perfiles_x_persona);
					$nombres				= $nombres->nombres." ".$nombres->apellidos;
					
					return $nombres;
				}, 
			],
			[
			'attribute'=>'id_coor_proyecto_sec',
			'value' => function( $model )
				{
					
					$idPerfilesXpersonas	= PerfilesXPersonasInstitucion::findOne($model->id_coor_proyecto_sec)->id_perfiles_x_persona;
					$perfiles_x_persona 	= PerfilesXPersonas::findOne($idPerfilesXpersonas)->id_personas;		
					$nombres 				= Personas::findOne($perfiles_x_persona);
					$nombres				= $nombres->nombres." ".$nombres->apellidos;
					
					return $nombres;
				}, 
			],
            'descripcion',
            'presentacion',
            'productos',
            'presentacion_retos',
            'alarmas',
            'consolidad_avance',
            'fecha_creacion',
        ],
    ]) ?>

</div>
