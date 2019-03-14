<?php

/**********
Versión: 001
Fecha: 2018-08-23
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I ESTUDIANTES
---------------------------------------
Modificaciones:
Fecha: 2018-11-01
Persona encargada: Edwin Molina Grisales
Cambios realizados: Cambios varios para permitir ingresar o actualizar registros
---------------------------------------
**********/


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */
$this->title = 'EJECUCIÓN FASE I ESTUDIANTES '.$anio;//." - ".$ciclo->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Ejecución fase I Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>



<div class="ejecucion-fase-create">


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
		'sesiones'		=> $sesiones,
    ]) ?>

</div>
