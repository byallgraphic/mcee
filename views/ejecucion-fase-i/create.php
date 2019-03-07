<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I
---------------------------------------
Fecha: 2019-02-12
Descripción: Ya no se pide el ciclo y el año viene por url y todas las realiciones con id_ciclo se cambian a año
---------------------------------------
**********/


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EjecucionFase */

$this->title = 'EJECUCIÓN DE FASE I '.$anio;
$this->params['breadcrumbs'][] = ['label' => 'Ejecucion Fases', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";
?>



<div class="ejecucion-fase-create">

    <h1><?= Html::encode($fase->descripcion)." ".$anio ?></h1>

    <?= $this->render('_form', [
        'model' 				=> $model,
		'fase'  				=> $fase,
		'institucion'			=> $institucion,
		'sede' 		 			=> $sede,
		'docentes' 				=> $docentes,
		'sesiones' 				=> $sesiones,
		// 'personas'	 			=> $personas,
		'datosIeoProfesional'	=> $datosIeoProfesional,
		'condiciones'			=> $condiciones,
		'datosModelos'			=> $datosModelos,
		'guardado'				=> $guardado,
		// 'ciclo'					=> $ciclo,
		'profesionales'			=> $profesionales,
		'anio'					=> $anio,
		'esDocente'				=> $esDocente,
    ]) ?>

</div>
