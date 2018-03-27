<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Personas;
use app\models\Escalafones;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocentesBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Docentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docentes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'id_perfiles_x_personas',
				'label'		=> 'Docentes',
				'value' => function( $model ){
								
								// $personas = Personas::findOne($model->id_perfiles_x_personas);
								$personas = Personas::find()
															->innerJoin( 'perfiles_x_personas pf', 'personas.id=pf.id_personas' )
															->innerJoin( 'docentes d', 'pf.id=d.id_perfiles_x_personas' )
															->where( 'pf.id='.$model->id_perfiles_x_personas )->one();
								// echo "--------<br><br><pre>"; var_dump($personas); echo "</pre>";
								return $personas ? $personas->nombres." ".$personas->apellidos: '';
							},
				'filter' => ArrayHelper::map(Personas::find()
															->select( "pf.id, ( personas.nombres || ' ' || personas.apellidos) nombres" )
															->innerJoin( 'perfiles_x_personas pf', 'personas.id=pf.id_personas' )
															->innerJoin( 'docentes d', 'pf.id=d.id_perfiles_x_personas' )
															->all(), 'id', 'nombres' ),
			],
			[
				'attribute' => 'id_escalafones',
				'value' => function( $model ){
					$escalafones = Escalafones::findOne($model->id_escalafones);
					return $escalafones? $escalafones->descripcion : '';
				},
				'filter' => ArrayHelper::map(Escalafones::find()->all(), 'id', 'descripcion' ),
			],
			'Antiguedad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
