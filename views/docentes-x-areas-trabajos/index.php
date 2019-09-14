<?php
/**********
Versión: 001
Fecha: 27-03-2018
Desarrollador: Edwin Molina Grisales
Descripción: CRUD Dcoentes por áreas de trabajo
---------------------------------------
Modificaciones:
Fecha: 27-03-2018
Persona encargada: Edwin Molina Grisales
Se corrige los queries respectivos, ya que se repetía varias veces los metodos ->where() en una sola consulta
---------------------------------------
Fecha: 05-04-2018
Persona encargada: Viviana Rodas
Cambios realizados: Se agregan los datatabes
---------------------------------------
Fecha: 06-09-2018
Persona encargada: Andrés Felipe Giraldo
Cambios realizados: Se agregan librerias de modales, se agrega funcion de modal y se cambia el enlace por un botón. Se incluye js que muestra el modal.
**********/
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


use app\models\Personas;
use app\models\AreasTrabajos;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocentesXAreasTrabajosBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/modal.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Docentes por áreas  de trabajo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docentes-xareas-trabajos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Agregar',['value'=>Url::to(['create']),'class'=>'btn btn-success','id'=>'modalButton'])?>
    </p>
    <?php
		Modal::Begin([
			'header'=>'<h3>DocentesXAreasTrabajos</h3>',
			'id'=>'modal',
			'size'=>'modal-lg',
		
		]);
		echo "<div id='modalContent'></div>";
		
		Modal::end();
		
	?>
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
			[
				'attribute' => 'id_perfiles_x_personas_docentes',
				'label'		=> 'Docente',
				'value' 	=> function( $model ){
									$personas = Personas::find()
													->select( "d.id_perfiles_x_personas as id, ( personas.nombres || ' ' || personas.apellidos ) nombres" )
													->innerJoin('perfiles_x_personas pf', 'personas.id=pf.id_personas' )
													->innerJoin('docentes d', 'd.id_perfiles_x_personas=pf.id' )
													->where( 'personas.estado=1' )
													->andWhere( 'd.estado=1' )
													->andWhere( 'd.id_perfiles_x_personas='.$model->id_perfiles_x_personas_docentes )
													->one();
									return $personas ? $personas->nombres: '';
								},
				'filter' 	=> ArrayHelper::map( Personas::find()
													->select( "d.id_perfiles_x_personas as id, ( personas.nombres || ' ' || personas.apellidos ) nombres" )
													->innerJoin('perfiles_x_personas pf', 'pf.id_personas=personas.id' )
													->innerJoin('docentes d', 'd.id_perfiles_x_personas=pf.id' )
													->where( 'personas.estado=1' )
													->andWhere( 'd.estado=1' )
													->all(), 'id', 'nombres' ),
			],
			[
				'attribute' => 'id_areas_trabajos',
				'value' 	=> function( $model ){
									$areasTrabajo = AreasTrabajos::findOne($model->id_areas_trabajos);
									return $areasTrabajo ? $areasTrabajo->descripcion: '';
								},
				'filter' 	=> ArrayHelper::map( AreasTrabajos::find()->all(), 'id', 'descripcion' ),
			],

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
