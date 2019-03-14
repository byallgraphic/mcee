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
Fecha: 2018-09-19
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

use yii\bootstrap\Collapse;

$items = [];

// $sesiones = Sesiones::find()
				// ->where( 'id_fase=1' )
				// ->andWhere( 'estado=1' )
				// ->all();

foreach( $sesiones as $keySesion => $sesion ){
	
	$ejecucionesFases	= $datosModelos[ $sesion->id ]['ejecucionesFase'];
	$datosSesion		= $datosModelos[ $sesion->id ]['datosSesion'];
	
	$items[] = 	[
					'label' 		=>  $sesion->descripcion,
					'content' 		=>  $this->render( 'sesionItem', 
													[ 
														'sesion' 			=> $sesion,
														'ejecucionesFases' 	=> $ejecucionesFases,
														'datosSesion' 		=> $datosSesion,
														'form' 				=> $form,
													] 
										),
					'contentOptions'=> []
				];
}



?>

<?= Collapse::widget([
	'items' => $items,
    'options' => [ "id" => "collapseOne" ],
]); ?>

	