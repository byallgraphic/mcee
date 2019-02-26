<?php

/**********
Versión: 001
Fecha: 2018-08-28
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I ESTUDIANTES
---------------------------------------
**********/


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */

$this->title = 'EJECUCIÓN FASE III ESTUDIANTES '.$anio;//." - ".$ciclo->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Ejecución Fase III Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ejecucion-fase-create">

    <h1><?= Html::encode($fase->descripcion)." ".$anio;//." - ".$ciclo->descripcion ?></h1>

    <?= $this->render('_form', [
			'datosModelos'	=> $datosModelos,
            'profesional'	=> $profesional,
            'fase'  		=> $fase,
            'institucion'	=> $institucion,
            'sede' 		 	=> $sede,
            'docentes' 		=> $docentes,
			//'ciclo'			=> $ciclo,
			'condiciones'	=> $condiciones,
			'guardado'		=> $guardado,
			'cursos'		=> $cursos,
			'anio'			=> $anio,
			'esDocente'		=> $esDocente,
    ]) ?>

</div>
