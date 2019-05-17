<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;


use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GeSeguimientoOperadorFrenteBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seguimiento Operador Frentes';
$this->params['breadcrumbs'][] = $this->title;


if( Yii::$app->request->get( 'guardado' ) ){

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
    <h3><?= $this->title ?></h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>
<div class="ge-seguimiento-operador-frente-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=  Html::button('Agregar',['value'=>Url::to(['create', 'idTipoSeguimiento'  => Yii::$app->request->get( 'idTipoSeguimiento' )]),'class'=>'btn btn-success','id'=>'modalButton']) ?>

        <?= Html::a('Volver',
            [
                'acompanamiento-in-situ/index',
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


            //'id',

            [
               'label' => 'Tipo de seguimiento',
               'value' => 'tipo_seguimiento.descripcion',
            ],
            'email:email',
            //'id_persona_diligencia',
            //'id_gestor_a_evaluar',
            'mes_reporte',
            'fecha_corte',
            'cumple_cronograma:boolean',
            //'descripcion_cronograma',
            //'compromisos_establecidos',
            //'cuantas_reuniones',
            //'aportes_reuniones',
            //'logros',
            //'dificultades',
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
                    return Html::a('<span name="actualizar" class="glyphicon glyphicon-pencil" value ="'.Url::to(['create', 'id' => $model->id, 'idTipoSeguimiento'  => Yii::$app->request->get( 'idTipoSeguimiento' )]).'"></span>', Url::to(['create', 'id' => $model->id, 'idTipoSeguimiento'  => Yii::$app->request->get( 'idTipoSeguimiento' )]), [
                        'title' => Yii::t('app', 'lead-update'),
                    ]);
                }

			  ],

			],

        ],
    ]); ?>
</div>
