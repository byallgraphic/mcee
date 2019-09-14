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
use yii\widgets\DetailView;

use app\models\Periodos;
use	yii\helpers\ArrayHelper;
use app\models\PonderacionResultados;
/* @var $this yii\web\View */
/* @var $model app\models\PonderacionResultados */

use app\models\Sedes;


 

/* @var $this yii\web\View */
/* @var $model app\models\PonderacionResultados */

$this->title = 'Detalle';
$this->params['breadcrumbs'][] = 
	[
		'label' => 'Ponderación de resultados', 
		'url' => [
					'index',
					
				 ]
	];

$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="ponderacion-resultados-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'attribute'=>'id_periodo',
				'value' => function( $model )
				{
					$Periodos = Periodos::findOne($model->id_periodo);
					return $Periodos ? $Periodos->descripcion : '';
				}, //para buscar por el nombre
				'filter' 	=> ArrayHelper::map(Periodos::find()->all(), 'id', 'descripcion' ),
				
			],
			[
				'attribute'=>'calificacion',
				//para buscar por el nombre
				'filter' 	=> ArrayHelper::map(PonderacionResultados::find()->all(), 'calificacion', 'calificacion' ),
				
			],	
        ],
    ]) ?>

</div>
