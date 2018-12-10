<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */

$this->title = 'Seguimiento al Operador';
$this->params['breadcrumbs'][] = ['label' => 'Seguimiento al Operador', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ge-seguimiento-operador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' 			=> $model,
		'nombresOperador' 	=> $nombresOperador,
		'mesReporte' 		=> $mesReporte,
		'personas' 			=> $personas,
		'institucion' 		=> $institucion,
		'indicadores' 		=> $indicadores,
		'objetivos' 		=> $objetivos,
		'actividades' 		=> $actividades,
		'guardado' 			=> $guardado,
		'idTipoSeguimiento' => $idTipoSeguimiento,
		
    ]) ?>

</div>
