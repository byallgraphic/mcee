<?php
/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE II
---------------------------------------
Modificaciones:
Fecha: 2018-09-18
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin Textarea, para poderlos editar
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

use app\models\PoblacionDocentesSesion;
use app\models\Sesiones;
use app\models\CondicionesInstitucionales;

$items = [];
$index = 0;
$indexEf = 0;

foreach( $sesiones as $keySesion => $sesion )
{
	
	$dataSesion 	= $datosModelos[ $sesion->id ]['dataSesion'];
	$ejecucionesFase= $datosModelos[ $sesion->id ]['ejecucionesFase'];
	$accioneRecurso	= $datosModelos[ $sesion->id ]['accionesRecursos'];
	
	$items[] = 	[
					'label' 		=>  $sesion->descripcion,
					'content' 		=>  $this->render( 'sesionItem', 
													[ 
														'idPE' 				=> $idPE, 
														'index' 			=> 0,
														'sesion' 			=> $sesion,
														'form' 				=> $form,
														'indexEf'			=> $sesion->id,
														'dataSesion'		=> $dataSesion,
														'ejecucionesFase'	=> $ejecucionesFase,
														'accioneRecurso'	=> $accioneRecurso,
														'docentes' 		=> $docentes,
													] 
										),
					'contentOptions'=> []
				];
				
	$index += count($sesiones);
	$indexEf++;
}

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => $items,
    'options' => [ "id" => "collapseOne" ],
]);

?>

