<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\EcProyectos;

use app\models\PerfilesXPersonas;
use app\models\Personas;
use app\models\PerfilesXPersonasInstitucion;
use app\models\Instituciones;
/* @var $this yii\web\View */
/* @var $model app\models\EcInformeEjecutivoEstado */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ec Informe Ejecutivo Estados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ec-informe-ejecutivo-estado-view">

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
				'attribute' => 'id_eje',
				'value'		=> function( $model )
								{
									$ejes = EcProyectos::findOne($model->id_eje);
									return $ejes ? $ejes->descripcion: '';
							    },
			],
			[
				'attribute' => 'id_persona',
				'value'		=> function( $model )
								{
									$idPersona			= PerfilesXPersonas::findOne($model->id_persona)->id_personas;
									$nombrePersona 		= Personas::findOne($idPersona);
									$nombrePersona 		= $nombrePersona->nombres." ".$nombrePersona->apellidos ;
									
									// return $ejes ? $ejes->descripcion: '';
									return $nombrePersona;
							    },
			],
			[
				'attribute' => 'id_coordinador',
				'value'		=> function( $model )
								{
									$idPerfilesXpersonasCoordinador	= PerfilesXPersonasInstitucion::findOne($model->id_coordinador)->id_perfiles_x_persona;
									$perfiles_x_personaCoordinador 	= PerfilesXPersonas::findOne($idPerfilesXpersonasCoordinador)->id_personas;		
									$coordinador 					= Personas::findOne($perfiles_x_personaCoordinador);
									$coordinador					= $coordinador->nombres." ".$coordinador->apellidos;
		

									// return $ejes ? $ejes->descripcion: '';
									return $coordinador;
							    },
			],
			[
				'attribute' => 'id_secretaria',
				'value'		=> function( $model )
								{
									$idPerfilesXpersonasSecretaria	= PerfilesXPersonasInstitucion::findOne($model->id_secretaria)->id_perfiles_x_persona;
									$perfiles_x_personaSecretaria 	= PerfilesXPersonas::findOne($idPerfilesXpersonasSecretaria)->id_personas;		
									$secretaria 					= Personas::findOne($perfiles_x_personaSecretaria);
									$secretaria 					= $secretaria->nombres." ".$secretaria->apellidos;
		

									// return $ejes ? $ejes->descripcion: '';
									return $secretaria;
							    },
			],
            'mision',
            'descripcion',
            'avance_producto',
            'hallazgos',
            'logros',
            'fecha_creacion',
			[
				'attribute' => 'id_institucion',
				'value'		=> function( $model )
								{
									$institucionNombre  = Instituciones::findOne($model->id_institucion)->descripcion;
									// return $ejes ? $ejes->descripcion: '';
									return $institucionNombre;
							    },
			],
        ],
    ]) ?>

</div>
