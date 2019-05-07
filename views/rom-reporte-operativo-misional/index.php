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

$this->title = 'Reporte Operativo Misional';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJs("
	$( document ).on('click', 'li', function() { 
		var cont = $( this ).attr('href');
		$( '[id^=content][id!='+cont.substr(1)+']', $(this).parent().parent() ).css({display:'none'}); 
		$( $( this ).attr('href'), $(this).parent().parent() )
			.toggle();
		
		var conClase = $( this ).hasClass( 'tab-selected' );
		
		$( 'li', $( this).parent() ).removeClass( 'tab-selected' );  
		
		if( !conClase )
			$( this, $( this).parent() ).addClass( 'tab-selected' );  
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
		
	$( '#modal' )
		.on( 'change', '[id$=estado_actividad]', function(){ 
			
			var __target = this.id.split( '-' );
			__target = __target[1];
			
			var frep = $( '#isaactividadesromxintegrantegrupo'+'-'+__target+'-fecha_reprogramacion' );
			
			if( $(this).val() == 179 )
			{
				frep.attr({disabled:true})
				frep.attr({readonly:true})
			}
			else
			{
				frep.attr({disabled:false});
				frep.attr({readonly:false});
			}
		});
		
	$( '#modal' )
		.on( 'change', '[id$=sesion_actividad]', function(){ 
			
			var __target = this.id.split( '-' );
			__target = __target[1];
			
			__self = this;
			
			if( $( __self ).val() == '' )
			{
				$( '#nro_equipo-'+__target ).val( '' )
				$( '#perfiles-'+__target ).val( '' )
				$( '#docente_orientador-'+__target ).val( '' )
			}
			else
			{	
				$.post( 'index.php?r=rom-reporte-operativo-misional/consultar-mision', 
						{ 
							rom_actividades	: __target, 
							sesion_actividad: $( __self ).val() ,
						}, 
						function( data ){
							if( data != '' ){
								$( '#modalContent' ).html( data );
							}
							else{
								
								$.get( 'index.php?r=rom-reporte-operativo-misional/consultar-intervencion-ieo', 
										{
											id: $( __self ).val() ,
										}, 
										function( data ){
											console.log( data );
											if( data ){
												$( '#nro_equipo-'+__target ).val( data.equipo_nombre )
												$( '#perfiles-'+__target ).val( data.perfiles )
												$( '#docente_orientador-'+__target ).val( data.docente_orientador )
											}
										},
										'json'
								);							
							}
						}
				);
			}
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
