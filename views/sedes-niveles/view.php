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

/**********
Versión: 001
Fecha: 04-04-2018
Desarrollador: Edwin Molina Grisales
Descripción: CRUD Dcoentes por sedes por niveles
---------------------------------------
Modificaciones:
Fecha: 27-03-2018
Persona encargada: Edwin Molina Grisales
Se deja la descripción de la sede y el nivel en lugar de sus ids
---------------------------------------
**********/

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Niveles;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SedesNiveles */

$this->title ='Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Sedes Niveles', 'url' => ['index', 'idSedes' => $modelSedes->id, 'idInstitucion' => $modelInstitucion->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>
<div class="sedes-niveles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
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
				'attribute' => 'id_niveles',
				'value' 	=> function( $model ){
					$niveles = Niveles::findOne($model->id_niveles);
					return $niveles ? $niveles->descripcion : '';
				},
			],
			[ 
				'attribute' => 'id_sedes',
				'label' 	=> 'Sede',
				'value'		=> $modelSedes->descripcion,
			]
        ],
    ]) ?>

</div>
