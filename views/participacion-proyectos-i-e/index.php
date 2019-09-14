<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use fedemotta\datatables\DataTables;

use app\models\NombresProyectosParticipacion;
use app\models\Instituciones;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipacionProyectosIEBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$nombre = "Participacion Proyectos IE";
$this->params['breadcrumbs'][] = $nombre;

$institucion = Instituciones::findOne( $idInstitucion );
?>


<?php
		Modal::Begin([
			'header'=>'<h3>'.$nombre.'</h3>',
			'id'=>'modal',
			'size'=>'modal-lg',
		
		]);
		echo "<div id='modalContent'></div>";
		
		Modal::end();
		
		?>

<div class="participacion-proyectos-ie-index">

    <h1><?= Html::encode($nombre) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Agregar',['value'=>Url::to(['create']),'class'=>'btn btn-success','id'=>'modalButton'])?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

            // 'id',
            [ 
				'attribute' => 'programa_proyecto', 
				'value' => function( $model ){
					$nombreProyecto = NombresProyectosParticipacion::findOne( $model->programa_proyecto );
					return $nombreProyecto ? $nombreProyecto->descripcion: '' ;
				}, 
			],
            'participacion:boolean',
            'operador',
            'entidad_financia',
            //'objetivo',
            //'duracion',
            //'anio_inicio',
            //'anio_finalizacion',
            //'tematica',
            //'areas',
            //'sedes',
            //'numero_docentes',
            //'numero_estudiantes',
            //'numero_padres',
            //'numero_directivos',
            //'otros',
            //'materiales_recursos',
            //'logros',
            //'observaciones',
            //'id_institucion',
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
