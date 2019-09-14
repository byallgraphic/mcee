<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Ec Datos Basicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelDatosBasico->id, 'url' => ['view', 'id' => $modelDatosBasico->id]];
$this->params['breadcrumbs'][] = "Actualizar";
?>
<div class="ec-datos-basicos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelDatosBasico' 	=> $modelDatosBasico,
            'modelPlaneacion' 	=> $modelPlaneacion,
            'modelVerificacion' => $modelVerificacion,
            'modelReportes' 	=> $modelReportes,
            'tiposVerificacion'	=> $tiposVerificacion,
            'profesional'		=> $profesional,
            'sede'				=> $sede,
            'institucion'		=> $institucion,
            'urlVolver'			=> $urlVolver,
            'rutasArchivos'		=> $rutasArchivos,
    ]) ?>

</div>
