<?php
/**********
Versión: 001
Fecha: 03-01-2019
Desarrollador: Edwin Molina Grisales
Descripción: Se usa para llamar al script _form tanto para crear como editar registros Consolidado por mes - Misional
---------------------------------------
**********/

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaEncArtisticaMisional */

$this->title = 'Consolidado por mes - Misional';
$this->params['breadcrumbs'][] = ['label' => 'Isa Enc Artistica Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>

<!-- <?= Html::a('Volver', 
									[
										'isa-enc-artistica-misional/index',
									], 
									['class' => 'btn btn-info']) ?> -->
									
<div class="isa-enc-artistica-misional-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> --!>

    <?= $this->render('_form', [
        'model' 		=> $model,
		'models' 		=> $models,
		'institucion' 	=> $institucion,
        'sede' 			=> $sede,
        'indicadores' 	=> $indicadores,
        'actividades' 	=> $actividades,
        'guardado' 		=> $guardado,
    ]) ?>

</div>
