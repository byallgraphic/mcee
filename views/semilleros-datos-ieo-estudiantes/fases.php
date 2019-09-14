<?php
/**********
Versión: 001
Fecha: 2018-08-16
Desarrollador: Edwin Molina Grisales
Descripción: Formulario CONFORMACION SEMILLEROS TIC ESTUDIANTES
				Muestrea la vista del acordeon de fases
---------------------------------------
Modificaciones:
Fecha: 2018-10-31
Persona encargada: Edwin Molina Grisales
Descripción: Se permite guardar o modificar los registros por parte del usuario
---------------------------------------
Modificaciones:
Fecha: 2018-09-19
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin XEditable, para poderlos editar
---------------------------------------
**********/

use app\models\PoblacionDocentesSesion;
use app\models\Sesiones;

$items = [];
$index = 0;

foreach( $fases as $keyFase => $fase ){
							
	$acuerdos = $modelos[ $fase->id ];
	
	$items[] = 	[
					'label' 		=>  $fase->descripcion,
					'content' 		=>  $this->render( 'faseItem', 
													[ 
														'index' 	=> 0,
														'fase' 		=> $fase,
														'docentes' 	=> $docentes,
														'jornadas' 	=> $jornadas,
														'recursos' 	=> $recursos,
														'parametros'=> $parametros,
														'acuerdos'	=> $acuerdos,
														'form'		=> $form,
														'cursos'	=> $cursos,
													] 
										),
					'contentOptions'=> []
				];
}

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => $items,
]);