<?php

/**********
Versión: 001
Fecha: 2018-08-23
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I ESTUDIANTES
---------------------------------------
Modificaciones:
Fecha: 2018-11-02
Persona encargarda: Edwin Molina Grisales
Descripción: Modificaciones varias para poder insertar o actualizar los registros del usuario
---------------------------------------
**********/


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */

$this->title = 'EJECUCIÓN FASE II ESTUDIANTES '.$anio;//." - ".$ciclo->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Ejecución Fase II Estudiantes', 'url' => ['index']];
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
