<?php
/**********
Versión: 001
Fecha: (23-03-2018)
Desarrollador: Viviana Rodas
Descripción: Lista de distribuiones academicas - indicador de desempeño
---------------------------------------
*/

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DistribucionesIndicadorDesempenoBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Distribuciones académicas - indicador desempeños';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distribuciones-indicador-desempeno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'clientOptions' => [
		'language'=>[
                'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
            ],
		"lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
		"info"=>false,
		"responsive"=>true,
		],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
				'attribute'=>'id_distribuciones',
				'value' => function( $model )
				{
					/**
					* Llenar descripcion asignatura con id_distribuciones
					*/
					//variable con la conexion a la base de datos 
					$connection = Yii::$app->getDb();
					$command = $connection->createCommand("select concat(a.descripcion,' ',p.descripcion) as distribucion  
															from distribuciones_x_indicador_desempeno as did, distribuciones_academicas as da, asignaturas as a, asignaturas_x_niveles_sedes as ans,paralelos as p
															where did.id_distribuciones = da.id
															and da.id_asignaturas_x_niveles_sedes = ans.id
															and ans.id_asignaturas = a.id
															and da.id = $model->id_distribuciones
															and da.id_paralelo_sede = p.id
															group by a.descripcion, p.descripcion
															");
					$result = $command->queryAll();
								
					return $result[0]['distribucion'];
				},
				
			],
			[
				'attribute'=>'id_indicador_desempeno',
				'value' => function( $model )
				{
					/**
					* Llenar descripcion indicador desempeño
					*/
					//variable con la conexion a la base de datos 
					$connection = Yii::$app->getDb();
					$command = $connection->createCommand(" select id.descripcion
															from indicador_desempeno id, distribuciones_x_indicador_desempeno as did
															where did.id_indicador_desempeno = id.id
															and did.id_indicador_desempeno = $model->id_indicador_desempeno
															group by id.id
															");
					$result = $command->queryAll();
								
					return $result[0]['descripcion'];
				},
				
			], 

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>