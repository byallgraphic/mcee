<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\ZonasEducativas;

use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '3. B Informe de avance Mensual I.E.O Fase Implementación Plan de acción - Ejecución';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$idTipoInforme = $_GET['idTipoInforme'];
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
<h3>3. B Informe de avance Mensual I.E.O Fase Implementación Plan de acción - Ejecución</h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>
<div class="implementacion-ieo-index">

   

    <p>
         <?=  Html::button('Agregar',['value'=>Url::to(['create','idTipoInforme'=> $idTipoInforme]),'class'=>'btn btn-success','id'=>'modalButton']) ?>
		
		
			<?php
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand(
		"
			select p.descripcion,p.id
			from ec.tipo_informe as ti, ec.componentes as c, ec.proyectos as p
			where ti.id = $idTipoInforme
			and ti.id_componente = c.id
			and c.descripcion = p.descripcion
			
		");
		$ecProyectos = $command->queryAll();
		
		
		$arrayVolver = array(
		'Articulación Familiar' =>'ec-competencias-basicas-proyectos-articulacion/index',
		'Proyecto de Servicio Social Estudiantil' =>'ec-competencias-basicas-proyectos-obligatorio/index',
		'Proyectos Pedagógicos Transversales' =>'ec-competencias-basicas-proyectos/index',
		'Proyecto Fortalecimiento de Competencias Básicas desde la Transversalidad' =>'ec-competencias-basicas-transversalidad/index',
		);


		
		echo Html::a('Volver', 
						[
							$arrayVolver[$ecProyectos[0]['descripcion']],
						], 
						['class' => 'btn btn-info']
					)
		?>
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
			//'institucion_id',
			[
			'attribute'=>'institucion_id',
			'value' => function( $model )
				{
					$nombreInstituciones = Instituciones::findOne($model->institucion_id);
					return $nombreInstituciones ? $nombreInstituciones->descripcion : '';  
				}, //para buscar por el nombre
			],
			[
			'attribute'=>'sede_id',
			'value' => function( $model )
				{
					$nombreSedes = Sedes::findOne($model->sede_id);
					return $nombreSedes ? $nombreSedes->descripcion : '';  
				}, //para buscar por el nombre
			],
            //'sede_id',
			//'zona_educativa',
			[
			'attribute'=>'zona_educativa',
			'value' => function( $model )
				{
					$zona = ZonasEducativas::findOne($model->zona_educativa);
					return $zona ? $zona->descripcion : '';  
				}, //para buscar por el nombre
			],
		'comuna',
            //'barrio',
            //'profesional_cargo',
            //'horario_trabajo',
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
