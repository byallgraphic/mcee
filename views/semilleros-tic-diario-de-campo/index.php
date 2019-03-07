<?php

/**********
Versión: 001
Fecha: 18-08-2018
Desarrollador: Maria Viviana Rodas
Descripción: Formulario diario de campo
---------------------------------------
Modificaciones: 
----------------------------------------------------------------
Fecha: 2019-02-26
Desarrollador: Edwin Molina Grisales
Descripción: Se elimina ciclos y se trabaja con el año de la url
----------------------------------------------------------------
Fecha: 22-10-2018
Desarrollador: Edwin Molina Grisales
Descripción: Se agrega variables enviadas por GET anio y esDocente para regresar al menu principal
------------------------------------------------------------
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
**********/

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use fedemotta\datatables\DataTables;
use yii\grid\GridView;
use app\models\Fases;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SemillerosTicDiarioDeCampoBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$nombre = 'Semilleros TIC Diario De Campo';
$this->params['breadcrumbs'][] =$nombre;

if( !$sede || $sede < 0 ){
	$this->registerJs( "$( cambiarSede ).click()" );
	return;
}
?>



<?php
		Modal::Begin([
			'header'=>'<h3>'.$nombre.'</h3>',
			'id'=>'modal',
			'size'=>'modal-lg',
		
		]);
		echo "<div id='modalContent'></div>";
		
		Modal::end();
		
		?>

<div class="semilleros-tic-diario-de-campo-index">

    <h1><?= Html::encode($nombre) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Agregar',['value'=>Url::to(['create', 'anio' => $anio, 'esDocente' => $esDocente]),'class'=>'btn btn-success','id'=>'modalButton'])?>
		
		
		<?= Html::a('Volver', 
									[
										'semilleros/index',
										'anio' 		=> $anio,
										'esDocente' => $esDocente,
									], 
									['class' => 'btn btn-info']) ?>
				

    </p>
	
	

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
		'clientOptions' => [
		'language'=>[
                'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json',
            ],
		"lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
		"info"=>false,
		"responsive"=>true,
		 "dom"=> 'lfTrtip',
		 "tableTools"=>[
			 "aButtons"=> [  
					// [
					// "sExtends"=> "copy",
					// "sButtonText"=> Yii::t('app',"Copiar")
					// ],
					// [
					// "sExtends"=> "csv",
					// "sButtonText"=> Yii::t('app',"CSV")
					// ],
					[
					"sExtends"=> "xls",
					"oSelectorOpts"=> ["page"=> 'current']
					],
					[
					"sExtends"=> "pdf",
					"oSelectorOpts"=> ["page"=> 'current']
					],
					// [
					// "sExtends"=> "print",
					// "sButtonText"=> Yii::t('app',"Imprimir")
					// ],
				],
			],
	],
           'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'anio',
            [
				'attribute'=>'id_fase',
				/*
				se consulta la descripcion de la fase 
				*/
				'value' => function( $model ){
					$fases = Fases::findOne($model->id_fase);
					$fases= $fases ? $fases->descripcion : '';
					
					
					return  $fases ;	
				},	
			],
            // 'descripcion',
            // 'hallazgos',
            // 'estado',

            [
			'class' => 'yii\grid\ActionColumn',
			'template'=>'{view}{update}{delete}',
				'buttons' => [
				'view' => function ($url, $model) {
					
					$url = $url."&anio=".$_GET['anio']."&esDocente=".$_GET['esDocente'];
					
					return Html::a('<span name="detalle" class="glyphicon glyphicon-eye-open" value ="'.$url.'" ></span>', $url, [
								'title' => Yii::t('app', 'lead-view'),
					]);
				},

				'update' => function ($url, $model) {
					
					$url = $url."&anio=".$_GET['anio']."&esDocente=".$_GET['esDocente'];
					
					return Html::a('<span name="actualizar" class="glyphicon glyphicon-pencil" value ="'.$url.'"></span>', $url, [
								'title' => Yii::t('app', 'lead-update'),
					]);
				}

			  ],
			
			],

        ],
    ]); ?>
</div>
