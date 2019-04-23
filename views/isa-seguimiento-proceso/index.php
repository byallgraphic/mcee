<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;


use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IsaSeguimientoProcesoBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '4. Orientación del proceso - Seguimiento';
$this->params['breadcrumbs'][] = $this->title;
?> 

<h1></h1>
	
<div id="modal" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>4. Orientación del proceso - Seguimiento</h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>
<div class="isa-seguimiento-proceso-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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

            
            'seguimiento_proceso',
            'fecha_desde',
            'fecha_hasta',
            // 'id_institucion',
            //'id_sede',
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
