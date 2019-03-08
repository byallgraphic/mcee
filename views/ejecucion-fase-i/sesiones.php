<?php
/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE I
---------------------------------------
Modificaciones:
Fecha: 2018-10-16
Descripción: Se premite insertar y modificar registros del formulario Ejecucion Fase I Docentes
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

use app\models\PoblacionDocentesSesion;
use app\models\CondicionesInstitucionales;
use app\models\DatosSesiones;

$items = [];
$index = 0;

// [ idSession ][ datoSesion ][ ejecucionFase ]
// $condiciones = CondicionesInstitucionales::find()
				// ->andWhere( 'estado=1' )
				// ->all();
$indexEf = 0;
foreach( $sesiones as $keySesion => $sesion ){
	
	/**
	 * datosModelos contiene el id de algunos modelos
	 * la clave de la segunda posicion contiene el id de Datos Session
	 */
	
	$datoSesion 	= $datosModelos[ $sesion->id ]['dataSesion'];
	$ejecucionesFase= $datosModelos[ $sesion->id ]['ejecucionesFase'];
	
	// echo "<pre>";
	// var_dump($ejecucionesFase);
	// echo "</pre>"; exit();
	
	$items[] = 	[
					'label' 		=>  $sesion->descripcion,
					'content' 		=>  $this->render( 'sesionItem', 
													[ 
														'idPE' 			=> $idPE, 
														'index' 		=> 0,
														'indexEf' 		=> $sesion->id,
														'sesion' 		=> $sesion,
														// 'datosSesion'	=> new DatosSesiones(),
														'datosSesion'	=> $datoSesion,
														// 'model' 		=> $model[0],
														'models' 		=> $ejecucionesFase,
														'condiciones'	=> $condiciones,
														'form'			=> $form,
														'datosModelos'	=> $datosModelos,
														'docentes' 		=> $docentes,
													] 
										),
					'contentOptions'=> []
				];
				
	$index += count($ejecucionesFase);
	$indexEf++;
	// $index++;
}

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => $items,
    'options' => [ "id" => "collapseOne" ],
]);

$this->registerJs( "consecutivo = $index;" );

// $options = ArrayHelper::getValue($item, 'options', []);
// Html::addCssClass($options, 'panel panel-default');
// $items[] = Html::tag('div', $this->renderItem($header, $item, ++$index), $options);

?>

