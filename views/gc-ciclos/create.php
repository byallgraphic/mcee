<?php
/**********
Versión: 001
Fecha: 2019-01-29
Desarrollador: Edwin Molina Grisales
Descripción: Ciclos
---------------------------------------
**********/

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GcCiclos */

$this->title = 'Agregar Gc Ciclos';
$this->params['breadcrumbs'][] = ['label' => 'Gc Ciclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="gc-ciclos-create">

 

    <?= $this->render('_form', [
        'modelCiclo' 			=> $modelCiclo,
		'modelBitacora' 		=> $modelBitacora,
		'modelSemanas' 			=> $modelSemanas,
		'modelDocentesXBitacora'=> $modelDocentesXBitacora,
		'docentes'				=> $docentes,
    ]) ?>

</div>
