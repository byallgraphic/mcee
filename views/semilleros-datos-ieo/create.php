<?php

/**********
Modificaciones:
Fecha: 2018-10-29
Desarrollador: Edwin Molina Grisales
Descripción: Se modifican los datos enviados a la vista form de aucerdo a los parametros del controlador
---------------------------------------
Modificación: 
Fecha: 2019-02-12
Descripción: Se elimina el ciclo
---------------------------------------
Fecha: 22-10-2018
Desarrollador: Maria Viviana Rodas
Descripción: Se agrega boton de volver a la vista de botones
---------------------------------------
**********/

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SemillerosDatosIeo */
$this->title = 'CONFORMACIÓN SEMILLEROS TIC '.$anio;
$this->params['breadcrumbs'][] = ['label' => 'Semilleros Datos Ieos', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Agregar";

?>

<div class="form-group">
		
		<?= Html::a('Volver', 
									[
										'semilleros/index',
										'anio' 		=> $anio,
										'esDocente' => $esDocente,
									], 
									['class' => 'btn btn-info']) ?>
				
</div>				
				
<div class="semilleros-datos-ieo-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'datosIEO' 			=> $datosIEO,
		'institucion' 		=> $institucion,
		'sede' 				=> $sede,
		'docentes' 			=> $docentes,
		'controller' 		=> $controller,
		'jornadas' 			=> $jornadas,
		'recursos' 			=> $recursos,
		'parametros'		=> $parametros,
		'fases'				=> $fases,
		'modelos'			=> $modelos,
        'profesionales'		=> $profesionales,
        'docentes_aliados'	=> $docentes_aliados,
        // 'ciclo'				=> $ciclo,
        'guardado'			=> $guardado,
        'anio'				=> $anio,
        'esDocente'			=> $esDocente,
    ]) ?>

</div>
