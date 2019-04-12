<?php

use yii\helpers\Html;

$this->registerCssFile('@web/css/GeSeguimientos.css');
$this->registerJsFile('@web/js/jquery-3.3.1.min.js');
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@web/js/GeSeguimientos.js');

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */

$this->title = 'Seguimiento al Operador';
$this->params['breadcrumbs'][] = ['label' => 'Seguimiento al Operador', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>


<div class="ge-seguimiento-operador-create">
    <script>
        $('#modalContent .main-header').hide();
        $('#modalContent .main-sidebar').hide();
        $('#modalContent .content-wrapper').css('margin-left','0');
    </script>

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
    ]) ?>

</div>
