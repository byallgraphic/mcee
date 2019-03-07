<?php

use yii\helpers\Html;

use fedemotta\datatables\DataTables;
use yii\grid\GridView;

use app\models\Personas;
use app\models\Instituciones;
use app\models\Sedes;
use app\models\EcPlaneacion;
use app\models\EcVerificacion;

use yii\helpers\Url;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EcDatosBasicosBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planeación y reporte de actividad';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/documentos.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$_SESSION["idTipoInforme"] = isset($_GET['idTipoInforme']) ?  $_GET['idTipoInforme'] : 0; 

$idTipoInforme = $_GET['idTipoInforme'];

if( isset($guardado) && $guardado == 1 ){
	echo Html::hiddenInput( 'guardadoFormulario', '1' );
}

?>
<div class="ec-datos-basicos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Volver', [ $urlVolver ], ['class' => 'btn btn-info']) ?>
       	
		<?=  Html::button('Agregar',['value'=>Url::to(['create','idTipoInforme'	=> $idTipoInforme]),'class'=>'btn btn-success','id'=>'modalButton']) ?>
    </p>

	<?php 
		
		Modal::Begin([
			'header'=>'<h3>Planeación y reporte de actividad</h3>',
			'id'=>'modal',
			'size'=>'modal-lg',
		
		]);
		echo "<div id='modalContent'></div>";
		
		Modal::end();

	?>

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
					'attribute' => 'profesional_campo',
					'value' 	=> function( $model ){
						$persona = Personas::findOne( $model->profesional_campo );
						return $persona ? $persona->nombres." ".$persona->apellidos : '';
					},
				],
				[
					'attribute' => 'id_institucion',
					'value' 	=> function( $model ){
						$institucion = Instituciones::findOne( $model->id_institucion );
						return $institucion ? $institucion->descripcion : '';
					},
				],
				[
					'attribute' => 'id_sede',
					'value' 	=> function( $model ){
						$sedes = Sedes::findOne( $model->id_institucion );
						return $sedes ? $sedes->descripcion : '';
					},
				],
				'fecha_diligenciamiento',
				/*[ 
					'label' 	=> 'Ruta del archivo' ,
					'attribute' => 'ruta archivo' ,
					'format' 	=> 'raw' ,
					'value'		=> function( $model ){
						$modelPlaneacion	= EcPlaneacion::findOne(['id_datos_basicos' => $model->id ]);
						$modelVerificacion	= EcVerificacion::findOne(['id_planeacion' => $modelPlaneacion->id ]);
						return Html::a( "Ver archivo", Url::to( "@web/".$modelVerificacion->ruta_archivo , true), [ "target"=>"_blank" ] );
					},
				],*/
				//'estado',

				[
					//'class' 	=> 'yii\grid\ActionColumn',
					//'template' 	=> '{view}{delete}',
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
