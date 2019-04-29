<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperadorFrente */

$this->title = 'Seguimiento Operador Frente';
$this->params['breadcrumbs'][] = ['label' => 'Seguimiento Operador Frentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>

<?= Html::a('Volver', 
									[
										'acompanamiento-in-situ/index',
									], 
									['class' => 'btn btn-info']) ?>
				
				
<div class="ge-seguimiento-operador-frente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'guardado' 			=> $guardado,
		'personas' 			=> $personas,
		'mesReporte' 			=> $mesReporte,
		'sino' 			=> $sino,
        'sede'				=> $sede,
		'seleccion' 			=> $seleccion,
    ]) ?>

</div>
<script>
    $('#modalContent .main-header').hide();
    $('#modalContent .main-sidebar').hide();
    $('#modalContent .content-wrapper').css('margin-left','0');
</script>