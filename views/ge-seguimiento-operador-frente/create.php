<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperadorFrente */

$this->title = '';
?>

				
<div class="ge-seguimiento-operador-frente-create">
    <?= $this->render('_form', [
        'model' => $model,
		'guardado' 			=> $guardado,
		'personas' 			=> $personas,
		'mesReporte' 			=> $mesReporte,
		'sino' 			=> $sino,
        'idTipoSeguimiento' => Yii::$app->request->get( 'idTipoSeguimiento' ),
        'sede'				=> $sede,
		'seleccion' 			=> $seleccion,
    ]) ?>

</div>
<script>
    $('#modalContent .main-header').hide();
    $('#modalContent .main-sidebar').hide();
    $('#modalContent .content-wrapper').css('margin-left','0');
</script>