<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Modulos;
use app\models\Perfiles;

/* @var $this yii\web\View */
/* @var $model app\models\Permisos */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="permisos-view">

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
				'attribute' => 'id_modulos',
				'value'		=> function( $model )
								{
									$modulo = Modulos::findOne( $model->id_modulos );
									return $modulo ? $modulo->descripcion: '';
							   },
			],
			[
				'attribute' => 'id_perfiles',
				'value'		=> function( $model )
								{
									$perfil = Perfiles::findOne( $model->id_perfiles );
									return $perfil ? $perfil->descripcion: '';
							   },
			],
            'eliminar',
            'editar',
            'listar',
            'agregar',
        ],
    ]) ?>

</div>
