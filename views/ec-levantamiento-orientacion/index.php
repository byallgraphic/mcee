<?php

/**********
Modificación: 
Fecha: 23-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver al index donde estan los botones de competencias basicas - proyecto
---------------------------------------

**********/

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;


use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EcLevantamientoOrientacionBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Levantamiento de orientación misional y método';
$this->params['breadcrumbs'][] = $this->title;
$idTipoInforme =$_GET['idTipoInforme'];
if( @$_GET['guardado'])
{
	
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
				<h3>Levantamiento de orientación misional y método</h3>
				</div>
				<div class="modal-body">
				<div id='modalContent'></div>
			</div>

		</div>
	</div>
</div>

<div class="ec-levantamiento-orientacion-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=  Html::button('Agregar',['value'=>Url::to(['create','idTipoInforme'	=> $idTipoInforme]),'class'=>'btn btn-success','id'=>'modalButton']) ?>
		
		
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


            // 'id_institucion',
            // 'id_sede',
            'visita_realizada',
            'actividad_seguimiento',
            'profesional_encargado',
            'fortalezas_identificadas',
            //'necesidades_orientacion',
            //'observacion_general',
            //'uso_insumo',
            //'id_tipo_levantamiento',
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
