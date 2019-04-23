<?php
/**********
Versión: 001
Fecha: 03-01-2019
Desarrollador: Edwin Molina Grisales
Descripción: Indice de Consolidado por mes - Misional
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;

use app\models\Instituciones;
use app\models\Sedes;
use app\models\Estados;


use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IsaEncArtisticaMisionalBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '5.Consolidado por mes - Misional';
$this->params['breadcrumbs'][] = $this->title;

if( $guardado )
{	
	$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
	
	$this->registerJs( "
	  swal({
			text: 'Registro guardado',
			icon: 'success',
			button: 'Salir',
		});" 
	);
}
?> 

<h1></h1>
	
<div id="modal" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>5.Consolidado por mes - Misional</h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>
<div class="isa-enc-artistica-misional-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?php /*Html::a('Agregar', ['create'], ['class' => 'btn btn-success'])*/ ?>
		<?= Html::button('Agregar',['value'=>Url::to(['isa-enc-artistica-misional/create']),'class'=>'btn btn-success','id'=>'modalButton'])?>
		<?= Html::a('Volver', 
									[
										'sensibilizacion-artistica/index',
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
			
			[
				'attribute' => 'id_institucion',
				'value' 	=> function( $model ){
					$institucion = Instituciones::findOne($model->id_institucion);
					return $institucion ? $institucion->descripcion : '';
				},
			],
			[
				'attribute' => 'id_sede',
				'value' 	=> function( $model ){
					$sede = Sedes::findOne($model->id_sede);
					return $sede ? $sede->descripcion : '';
				},
			],
            'periodo',
			[
				'attribute' => 'estado',
				'value' 	=> function( $model ){
					$estado = Estados::findOne($model->estado);
					return $estado ? $estado->descripcion : '';
				},
			],

            [
				'class' => 'yii\grid\ActionColumn',
				'template'=>'{update}',			
				'buttons' => [
								'update' => function ($url, $model) {
												return Html::a('<span name="actualizar" class="glyphicon glyphicon-pencil" value ="'.$url.'"></span>', $url, [
															'title' => Yii::t('app', 'lead-update'),
															]);
											}
							],
			],

        ],
    ]); ?>
</div>
