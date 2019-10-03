<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;


use fedemotta\datatables\DataTables;
use yii\grid\GridView;

use app\models\Instituciones;
use app\models\Sedes;
use app\models\Estados;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IsaIniciacionSensibilizacionArtisticaConsolidadoBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '5. Consolidado por mes - Operativo';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/js/isaIniciacionSensibilizacionArtisticaConsolidado.js',
    [
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\dosamigos\editable\EditableBootstrapAsset::className(),
					]
	]
);

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
<h3 style='background-color: #ccc;padding:5px;'><?=$this->title?></h3>
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

<div class="isa-iniciacion-sensibilizacion-artistica-consolidado-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=  Html::button('Agregar',['value'=>Url::to(['create']),'class'=>'btn btn-success','id'=>'modalButton', 'onClick' => 'inicilializandoFunciones()' ]) ?>
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
            'fecha',
            'periodo',
			// [
				// 'attribute' => 'estado',
				// 'value' 	=> function( $model ){
					// $estado = Estados::findOne($model->estado);
					// return $estado ? $estado->descripcion : '';
				// },
			// ],
            //'total_sesiones_realizadas',
            //'avance_por_mes',
            //'total_sesiones_aplazadas',
            //'total_sesiones_canceladas',
            //'vecinos',
            //'lideres_comunitarios',
            //'empresarios_comerciantes_microempresas',
            //'representantes_organizaciones_locales',
            //'asociaciones_grupos_comunitarios',
            //'otros_actores',
            //'actas',
            //'reportes',
            //'listados',
            //'plan_trabajo',
            //'formato_seguimiento',
            //'formato_evaluacion',
            //'fotografias',
            //'videos',
            //'otros_productos',
            //'id_actividad',

            [
			'class' => 'yii\grid\ActionColumn',
			'template'=>'{update}',
				'buttons' => [
					// 'view' 	 => function ($url, $model) {
									// return Html::a('<span name="detalle" class="glyphicon glyphicon-eye-open" value ="'.$url.'" ></span>', $url, [
												// 'title' => Yii::t('app', 'lead-view'),
									// ]);
								// },

					'update' => function ($url, $model) {
									return Html::a('<span name="actualizar" class="glyphicon glyphicon-pencil" value ="'.$url.'" onClick="inicilializandoFunciones();"></span>', $url, [
												'title' => Yii::t('app', 'lead-update'),
									]);
								}
				],
			
			],

        ],
    ]); ?>
</div>
