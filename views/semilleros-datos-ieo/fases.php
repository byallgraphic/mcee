<?php

/**********
Versión: 001
Fecha: 2018-08-28
Desarrollador: Edwin Molina Grisales
Descripción: Formulario SEMILLEROS DATOS IEO
---------------------------------------
Modificaciones:
Fecha: 2018-11-06
Desarrollador: Edwin Molina Grisales
Descripción: Se hacen modificaciones varias para guardar varios profesionales A, docentes aliados y nombres de docentes
---------------------------------------
Modificaciones:
Fecha: 2018-10-29
Persona encargada: Edwin Molina Grisales
Descripción: Se modifican el contenido de acuerdo a los modelos enviados desde el controlador
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
													] 
										),
					'contentOptions'=> []
				];
}

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => $items,
]);