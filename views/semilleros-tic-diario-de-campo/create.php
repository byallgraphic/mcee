<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SemillerosTicDiarioDeCampo */

$this->title = 'Semilleros TIC Diario De Campo';
$this->params['breadcrumbs'][] = ['label' => 'Semilleros TIC Diario De Campo', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="semilleros-tic-diario-de-campo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'diarioCampo' 	=> $diarioCampo,
		'movimientos' 	=> $movimientos,
		'fases' 		=> $fases,
		'fasesModel'	=> $fasesModel,
		'ciclos' 		=> $ciclos,
		'cicloslist'	=> $cicloslist,
		'anios' 		=> $anios,
		'anio' 			=> $anio,
		'esDocente' 	=> $esDocente,
		'dataResumen' 	=> $dataResumen,
		'index'			=> 0,
    ]) ?>

</div>
