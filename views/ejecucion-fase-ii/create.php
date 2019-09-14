<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE II
----------------------------------------
Modificaciones
Fecha: 2019-02-12
Descripción: Ya no se pide el ciclo y el año viene por url y todas las realiciones con id_ciclo se cambian a año
---------------------------------------
**********/


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */

$this->title = 'EJECUCIÓN DE FASE II '.$anio;
$this->params['breadcrumbs'][] = ['label' => 'Ejecución Fase II', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>
<div class="ejecucion-fase-create">

    <h1><?= Html::encode($fase->descripcion)." ".$anio ?></h1>

    <?= $this->render('_form', [
		'fase'  				=> $fase,
		'institucion'			=> $institucion,
		'sede' 		 			=> $sede,
		'docentes' 				=> $docentes,
		'sesiones' 				=> $sesiones,
        'datosModelos'			=> $datosModelos,
        'condiciones'			=> $condiciones,
        'datosIeoProfesional'	=> $datosIeoProfesional,
        'datosModelos'			=> $datosModelos,
		'guardado'				=> $guardado,
		'profesionales'			=> $profesionales,
		'anio'					=> $anio,
		'esDocente'				=> $esDocente,
		'especialidades'		=> $especialidades,
    ]) ?>

</div>
