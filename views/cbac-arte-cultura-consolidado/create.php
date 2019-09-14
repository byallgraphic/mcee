<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSensibilizacionArtisticaConsolidado */

$this->title = 'Consolidado por mes - Operativo';
$this->params['breadcrumbs'][] = ['label' => 'Isa Iniciacion Sensibilizacion Artistica Consolidados', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>

<!-- <?= Html::a('Volver', 
									[
										'sensibilizacion-artistica/index',
									], 
									['class' => 'btn btn-info']) ?> --!>

<div class="isa-iniciacion-sensibilizacion-artistica-consolidado-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'models' 			=> $models,
		'institucion' 		=> $institucion,
        'sede' 				=> $sede,
        'actividades'		=> $actividades,
        'modelEncabezado'	=> $modelEncabezado,
        'guardado'			=> $guardado,
    ]) ?>

</div>


<script>
    $('#modalContent .main-header').hide();
    $('#modalContent .main-sidebar').hide();
    $('#modalContent .content-wrapper').css('margin-left','0');
</script>