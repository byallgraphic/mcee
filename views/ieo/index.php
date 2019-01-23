<?php

/**********
Modificación: 
Fecha: 23-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver al index donde estan los botones de competencias basicas - proyecto
---------------------------------------

**********/

use yii\helpers\Html;
use fedemotta\datatables\DataTables;
use yii\grid\GridView;
use app\models\ZonasEducativas;
								
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '3.A Informe de avance Mensual I.E.O Fase Plan de acción - Ejecución';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$_SESSION["idTipoInforme"] = isset($_GET['idTipoInforme']) ?  $_GET['idTipoInforme'] : 0; 



if( isset($guardado) && $guardado == 1 ){
	echo Html::hiddenInput( 'guardadoFormulario', '1' );
}
?>


<div class="ieo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::button('Agregar',['value'=>Url::to(['create']),'class'=>'btn btn-success','id'=>'modalButton'])?>
		
		
		<?= Html::a('Volver', 
									[
										'ec-competencias-basicas-proyectos/index',
									], 
									['class' => 'btn btn-info']) ?>
				


    </p>

	<?php 
		
		Modal::Begin([
			'header'=>'<h3>3.A Informe de avance Mensual I.E.O Fase Plan de acción - Ejecución</h3>',
			'id'=>'modal',
			'size'=>'modal-lg',
		
		]);
		echo "<div id='modalContent'></div>";
		
		Modal::end();

	?>

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
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'persona_acargo',
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
			[
				'class' => 'yii\grid\ActionColumn',
				'template'=>'{view}{update}{delete}',
					'buttons' => [
					'view' => function ($url, $model) {
						return Html::a('<span name="detalle" class="glyphicon glyphicon-eye-open" value ="'.$url.'" ></span>', $url, [
									'title' => Yii::t('app', 'lead-view'),
						]);
					},
	
					'update' => function ($url, $model) {
						return Html::a('<span name="actualizar" class="glyphicon glyphicon-pencil" value ="'.$url.'"></span>', $url, [
									'title' => Yii::t('app', 'lead-update'),
						]);
					}
	
				  ],
				
				],
            //'proyecto_id',
            //'estado',

            
        ],
    ]); ?>
</div>
