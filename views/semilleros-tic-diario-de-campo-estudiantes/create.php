<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SemillerosTicDiarioDeCampoEstudiantes */

$this->title = 'Agregar Semilleros TIC Diario De Campo Estudiantes';
$this->params['breadcrumbs'][] = ['label' => 'Semilleros TIC Diario De Campo Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="semilleros-tic-diario-de-campo-estudiantes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'diarioCampo'	=> $diarioCampo,
        'movimientos'	=> $movimientos,
		'fases' 		=> $fases,
        'fasesModel' 	=> $fasesModel,
        'ciclos' 		=> $ciclos,
		'cicloslist' 	=> $cicloslist,
        'anios' 		=> $anios,
		'anioSelected'	=> "",
		'cicloSelected' => '',
		'anio' 			=> $anio,
		'esDocente' 	=> $esDocente,
		'index'			=> 0,
		'dataResumen'	=> $dataResumen,
    ]) ?>

</div>
