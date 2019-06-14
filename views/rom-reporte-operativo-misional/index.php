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

$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->title = 'Reporte Operativo Misional';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/romReporteOperativoMisional.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJs("
	$( document ).on('click', 'li', function() { 
		try{
			
			var cont = $( this ).attr('href');
			$( '[id^=content][id!='+cont.substr(1)+']', $(this).parent().parent() ).css({display:'none'}); 
			$( $( this ).attr('href'), $(this).parent().parent() )
				.toggle();
			
			var conClase = $( this ).hasClass( 'tab-selected' );
			
			$( 'li', $( this).parent() ).removeClass( 'tab-selected' );  
			
			if( !conClase )
				$( this, $( this).parent() ).addClass( 'tab-selected' );  
		}
		catch(e){}
	});
	
	
	$( '#modal' )
		.on( 'change', 'input:file', function(){ 
			
			var __target = this.id.split( '-' );
			__target = __target[0] + \"-\" + __target[1];
			
			var can = $( '#'+__target+'-cantidad' );
			
			var total = 0;
			
			$( \"[id^=\"+__target+\"]input:file\" ).each(function(){
				total += this.files.length;
			});
			
			can.val( total );
		});
	
	
");

if( isset($guardado) && $guardado == 1 ){
	echo Html::hiddenInput( 'guardadoFormulario', '1' );
}

if( !$sede ){
	$this->registerJs( "$( cambiarSede ).click()" );
	return;
}

?>

<h1></h1>
	
<div id="modal" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>2 Reporte Operativo Misional</h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>


<div id="modalArchivos" class="fade modal" role="dialog" tabindex="-1" >
	<div class="modal-dialog modal-md modalemg">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Evidencias</h3>
			</div>
			<div class="modal-body">
				<div id='modalArchivosContent'></div>
			</div>
		</div>
	</div>
</div>

<div class="rom-reporte-operativo-misional-index">

   

    <p>
        <?=  Html::button('Agregar',['value'=>Url::to(['create']),'class'=>'btn btn-success','id'=>'modalButton']) ?>
		<?= Html::a('Volver',['sensibilizacion-artistica/index',],['class' => 'btn btn-info']) ?>
		
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

            //'id',
            [
			'attribute'=>'id_institucion',
			'value' => function( $model )
				{
					$nombreInstituciones = Instituciones::findOne($model->id_institucion);
					return $nombreInstituciones ? $nombreInstituciones->descripcion : '';  
				}, //para buscar por el nombre
			],
			[
			'attribute'=>'id_sedes',
			'value' => function( $model )
				{
					$nombreSedes = Sedes::findOne($model->id_sedes);
					return $nombreSedes ? $nombreSedes->descripcion : '';  
				}, //para buscar por el nombre
			],
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
