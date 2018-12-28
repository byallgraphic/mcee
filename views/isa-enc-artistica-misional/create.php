<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaEncArtisticaMisional */

$this->title = 'Consolidado por mes - Misional';
$this->params['breadcrumbs'][] = ['label' => 'Isa Enc Artistica Misionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>

<?= Html::a('Volver', 
									[
										'sensibilizacion-artistica/index',
									], 
									['class' => 'btn btn-info']) ?>
									
<div class="isa-enc-artistica-misional-create">

    <h1><?= Html::encode($this->title) ?></h1>

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
