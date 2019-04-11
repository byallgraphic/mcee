<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */

$this->title = 'Seguimiento al Operador';
$this->params['breadcrumbs'][] = ['label' => 'Seguimiento al Operador', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>

<div id="modal-form" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <?= Html::a('Volver',
                    [
                        'acompanamiento-in-situ/index',
                    ],
                    ['class' => 'btn btn-info']) ?>
            </div>
            <div class="modal-body">
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
                    ]) ?>

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<?= Html::a('Volver',
									[
										'acompanamiento-in-situ/index',
									],
									['class' => 'btn btn-info']) ?>



<script>
    $('#modalContent .main-header').hide();
    $('#modalContent .main-sidebar').hide();
    $('#modalContent .content-wrapper').css('margin-left','0');
</script>
