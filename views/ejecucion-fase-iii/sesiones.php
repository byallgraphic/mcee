<?php

/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE III
---------------------------------------
Modificaciones:
Fecha: 2018-09-18
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin Textarea, para poderlos editar
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$items = [];
$index = 0;

$i = 0;
foreach( $models as $key => $model ){
	
	$profesional = $model['profesionales'];
	$datosSesion = $model['datosSesion'];
	$model 		 = $model['ejecucionFase'];
	
	$items[] = 	[
					'label' 		=>  "Sesión ".$i,
					'content' 		=>  $this->render( 'sesionItem', 
													[ 
														'index' 		=> $i,
														'model' 		=> $model,
														'fase' 			=> $fase,
														'institucion'	=> $institucion,
														'sede'			=> $sede,
														'docentes'		=> $docentes,
														'form'			=> $form,
														'profesional'	=> $profesional,
														'profesionales'	=> $profesionales,
														'cursos'		=> $cursos,
														'dataSesion'	=> $datosSesion,
														'listaSesiones'	=> $listaSesiones,
													] 
										),
					'contentOptions'=> []
				];
	
	$i++;
}

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => $items,
    'options' => [ "id" => "collapseOne" ],
]);

?>

	