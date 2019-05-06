<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoGestion */

$this->title = '';
?>
				
<div class="ge-seguimiento-gestion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' 			=> $model,
        'cargos' 			=> $cargos,
        'institucion' 		=> $institucion,
        'sede'				=> $sede,
        'idTipoSeguimiento' => Yii::$app->request->get( 'idTipoSeguimiento' ),
        'listBoleano' 		=> $listBoleano,
        'consideracones' 	=> $consideracones,
        'respuestas' 		=> $respuestas,
        'calificaciones'	=> $calificaciones,
        'guardado' 			=> $guardado,
        'personas' 			=> $personas,
    ]) ?>

</div>

<script>
    $('#modalContent .main-header').hide();
    $('#modalContent .main-sidebar').hide();
    $('#modalContent .content-wrapper').css('margin-left','0');
</script>