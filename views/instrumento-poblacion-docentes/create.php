<?php
/**********
Modificación: 
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
---------------------------------------

**********/

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InstrumentoPoblacionEstudiantes */

$this->title = 'Instrumento Población Docentes';
// $this->params['breadcrumbs'][] = ['label' => 'Instrumento Población Estudiantes', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>



<div class="instrumento-poblacion-docentes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'instituciones' => $instituciones,
		'sedes' 		=> $sedes,
		'estudiantes'	=> $estudiantes,
		'estados'		=> $estados,
		'anio' 			=> $anio,
        'esDocente' 	=> $esDocente,
    ]) ?>

</div>
