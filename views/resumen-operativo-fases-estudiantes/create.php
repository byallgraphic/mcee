<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */

$this->title = 'Datos Basicos';
$this->params['breadcrumbs'][] = ['label' => 'Ec Datos Basicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ec-datos-basicos-create">

    <h1 style='background-color:#ccc;'><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelDatosBasico' 	=> $modelDatosBasico,
		'modelPlaneacion' 	=> $modelPlaneacion,
		'modelVerificacion' => $modelVerificacion,
		'modelReportes' 	=> $modelReportes,
		'tiposVerificacion'	=> $tiposVerificacion,
    ]) ?>

</div>
