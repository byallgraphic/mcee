<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\pppSeguimientooperador */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos pedagógicos', 'url' => ['index']];
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
        'sede'				=> $sede,
        'indicadores' 		=> $indicadores,
        'actividades' 		=> $actividades,
        'guardado' 			=> $guardado,
        'reportAct'         => $reportAct,
        'reportExist'       => $reportExist
    ]) ?>

</div>
