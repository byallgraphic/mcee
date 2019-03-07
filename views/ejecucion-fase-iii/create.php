<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE III
---------------------------------------
Modificación: 
Fecha: 2019-02-12
Descripción: Ya no se pide el ciclo y el año viene por url y todas las realiciones con id_ciclo se cambian a año
---------------------------------------
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
**********/


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */

$this->title = 'EJECUCIÓN DE FASE III '.$anio;
$this->params['breadcrumbs'][] = ['label' => 'Ejecución Fase III', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>

<div class="form-group">
		
		<?= Html::a('Volver', 
									[
										'semilleros/index',
										'esDocente' => $esDocente,
										'anio' => $anio,
									], 
									['class' => 'btn btn-info']) ?>
				
</div>

<div class="ejecucion-fase-create">

    <h1><?= Html::encode($fase->descripcion)." ".$anio ?></h1>

    <?= $this->render('_form', [
        'model' 		=> $model,
        'models' 		=> $models,
		'fase'  		=> $fase,
		'institucion'	=> $institucion,
		'sede' 		 	=> $sede,
		'docentes' 		=> $docentes,
		'profesional'	=> $profesional,
		'condiciones'	=> $condiciones,
		'guardado'		=> $guardado,
		'profesionales'	=> $profesionales,
		'cursos'		=> $cursos,
		'listaSesiones'	=> $listaSesiones,
		'anio'			=> $anio,
    ]) ?>

</div>
