<?php
/**********
Versión: 001
Fecha: 2018-08-16
Desarrollador: Edwin Molina Grisales
Descripción: Formulario CONFORMACION SEMILLEROS TIC ESTUDIANTES
---------------------------------------
Modificaciones:
Fecha: 2018-10-31
Persona encargada: Edwin Molina Grisales
Descripción: Se permite guardar o modificar los registros por parte del usuario
---------------------------------------
**********/

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SemillerosDatosIeoEstudiantes */

$this->title = 'CONFORMACIÓN SEMILLEROS TIC ESTUDIANTES '.$anio;//." - ".$ciclo->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Conformación Semilleros TIC Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>


<div class="semilleros-datos-ieo-estudiantes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'datosIEO' 			=> $datosIEO,
		'institucion' 		=> $institucion,
		'sede' 				=> $sede,
		'docentes' 			=> $docentes,
		'controller'		=> $this,
		'jornadas'			=> $jornadas,
		'recursos'			=> $recursos,
		'parametros'		=> $parametros,
		'fases'				=> $fases,
		'modelos'			=> $modelos,
		'profesionales'		=> $profesionales,
		'docentes_aliados'	=> $docentes_aliados,
		//'ciclo'				=> $ciclo,
		'guardado'			=> $guardado,
		'cursos'			=> $cursos,
		'esDocente'			=> $esDocente,
		'anio'				=> $anio,
    ]) ?>

</div>
