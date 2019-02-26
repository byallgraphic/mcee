<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\Instituciones;
use app\models\Sedes;

use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iniciación Sensibilización Artistica';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

if( isset($guardado) && $guardado == 1 ){
	echo Html::hiddenInput( 'guardadoFormulario', '1' );
}
?>

<h1></h1>
	
<div id="modal" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>Iniciación Sensibilización Artistica</h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>
<div class="isa-iniciacion-sencibilizacion-artistica-index">

   

    <p>
        <?=  Html::button('Agregar',['value'=>Url::to(['create']),'class'=>'btn btn-success','id'=>'modalButton']) ?>
		
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
			'attribute'=>'id_institucion',
			'value' => function( $model )
				{
					$nombreInstituciones = Instituciones::findOne($model->id_institucion);
					return $nombreInstituciones ? $nombreInstituciones->descripcion : '';  
				}, //para buscar por el nombre
			],
            [
			'attribute'=>'id_sede',
			'value' => function( $model )
				{
					$nombreSedes = Sedes::findOne($model->id_sede);
					return $nombreSedes ? $nombreSedes->descripcion : '';  
				}, //para buscar por el nombre
			],
            'caracterizacion_si_no',
            'caracterizacion_nombre',
            //'caracterizacion_fecha',
            //'caracterizacion_justificacion',
            //'estado',

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

        ],
    ]); ?>
</div>
