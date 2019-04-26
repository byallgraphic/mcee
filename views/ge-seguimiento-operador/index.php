<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;


use fedemotta\datatables\DataTables;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GeSeguimientoOperadorBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seguimiento operador';
$this->params['breadcrumbs'][] = $this->title;


$this->registerCssFile('@web/css/GeSeguimientos.css');
$this->registerJsFile('@web/js/jquery-3.3.1.min.js');
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@web/js/GeSeguimientos.js');
$this->registerJsFile('@web/js/GeSeguimientosForm.js');

?>


<div id="modal-guardado" class="modal fade bd-example-modal-sm" style="display: none" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Registro guardado con exito</p>
            </div>
        </div>
    </div>
</div>
<h1></h1>
	
<div id="modal-ge" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3><?php echo $this->title ?></h3>
</div>
<div class="modal-body">
<div id='modalContent'></div>
</div>

</div>
</div>
</div>
<div class="ge-seguimiento-operador-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=  Html::button('Agregar',['value'=>Url::to(['create', 'id' => 1]),'class'=>'btn btn-success','id'=>'modalButton-ge']) ?>
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
            'objetivo',
            //'proyecto_reportar',
            //'id_ie',
            //'mes_reporte',
            //'semana_reporte',
            //'id_persona_responsable',
            //'descripcion_actividad',
            //'poblacion_beneficiaria',
            //'quienes',
            //'numero_participantes',
            //'duracion_actividad',
            //'logros_alcanzados',
            //'dificultadades',
            //'avances_cumplimiento_cuantitativos',
            //'avances_cumplimiento_cualitativos',
            //'dificultades',
            //'propuesta_dificultades',
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
                                'id' => 'modal-ge',
                                'onclick' => '
                                        $("#modal-ge").modal(\'show\')
                                            .find("#modalContent")
                                            .load($(this).attr(\'value\'));'
					]);
				}

			  ],
			
			],

        ],
    ]); ?>
</div>