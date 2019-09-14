<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ZonasEducativas;
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */

$this->title = "Detalles";
$this->params['breadcrumbs'][] = ['label' => 'Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ieo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            //'id',
            'persona_acargo',
			[
			'attribute'=>'zonas_educativas_id',
			'value' => function( $model )
				{
					$zona = ZonasEducativas::findOne($model->zonas_educativas_id);
					return $zona ? $zona->descripcion : '';  
				}, //para buscar por el nombre
			],
			'comuna',
			'barrio',
            //'estado',
        ],
    ]) ?>

</div>
