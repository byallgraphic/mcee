<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;


use fedemotta\datatables\DataTables;
use yii\grid\GridView;
use app\models\Parametro;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialesEducativosBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

if( isset($guardado) && $guardado == 1 )
{
	echo Html::hiddenInput( 'guardado', '1' );
}
$this->title = 'MATERIALES EDUCATIVOS PRODUCIDOS POR LA IEO';
$this->params['breadcrumbs'][] = $this->title;
?> 

<h1></h1>
	
<div id="modal" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3><?php echo $this->title; ?> </h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>
<div class="materiales-educativos-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
        <?= Html::a('Agregar', ['create'], ['class' => 'btn btn-success']) ?>
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
				'attribute' => 'ruta' ,
				'format' 	=> 'raw' ,
				'value'		=> function( $model ){
					return Html::a( "Ver archivo", Url::to( "@web/".$model->ruta , true), [ "target"=>"_blank" ] );
				},
			],
			[
				'attribute' => 'tipo',
				'value' => function( $model ){
					$parametro = Parametro::findOne($model->tipo);
					return $parametro ? $parametro->descripcion : '';
					return $parametro;
					
				},

			],
			[
				'attribute' => 'autor',
				'value' => function( $model ){
					$parametro = Parametro::findOne($model->autor);
					return $parametro ? $parametro->descripcion : '';
					return $parametro;
					
				},

			],
			[
				'attribute' => 'nivel',
				'value' => function( $model ){
					$parametro = Parametro::findOne($model->nivel);
					return $parametro ? $parametro->descripcion : '';
					return $parametro;
					
				},

			],
            'otro_cual',
            'nombre_apellidos',
            'reseña',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{delete}',
			],

        ],
    ]); ?>
</div>
