<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;


use fedemotta\datatables\DataTables;
use yii\grid\GridView;
use app\models\Parametro;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estrategia Embellecimiento Espacios';
$this->params['breadcrumbs'][] = $this->title;
?> 

<h1></h1>
	
<div id="modal" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>Estrategia Embellecimiento Espacios </h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>
<div class="estrategia-embellecimiento-espacios-index">

   

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

            //'id',
			[ 
				'attribute' => 'seguimiento_uso_espacios' ,
				'format' 	=> 'raw' ,
				'value'		=> function( $model ){
					$usoEspacios = Parametro::findOne( $model->seguimiento_uso_espacios );
					return $usoEspacios ? $usoEspacios->descripcion : '' ;
				},
			],

            'plan_enlucimiento',
			[ 
				'attribute' => 'estrateguia_enbellecimiento' ,
				'format' 	=> 'raw' ,
				'value'		=> function( $model ){
					$estrategiaEmbellecimiento = Parametro::findOne( $model->estrateguia_enbellecimiento );
					return $estrategiaEmbellecimiento ? $estrategiaEmbellecimiento->descripcion : '' ;
				},
			],
			[ 
				'attribute' => 'ruta' ,
				'format' 	=> 'raw' ,
				'value'		=> function( $model ){
					return Html::a( "Ver archivo", Url::to( "@web/".$model->ruta , true), [ "target"=>"_blank" ] );
				},
			],
            [
			'class' => 'yii\grid\ActionColumn',
			'template'=>'{delete}'
			
			],

        ],
    ]); ?>
</div>
