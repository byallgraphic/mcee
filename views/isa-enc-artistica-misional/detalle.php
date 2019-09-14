<?php
/**********
Versión: 001
Fecha: 03-01-2019
Desarrollador: Edwin Molina Grisales
Descripción: Este script hace parte del _form.php del Consolidado por mes - Misional
---------------------------------------
**********/

use yii\helpers\Html;
?>

<h4><?= $titleMision ?></h4> 

<?= Html::activeHiddenInput( $models['misional'], "[$index]id" ) ?>

<?= $form->field( $models['misional'], "[$index]mision" )->textarea() ?>

<?= $form->field( $models['misional'], "[$index]descripcion_proceso" )->textarea() ?>

<?= $form->field( $models['misional'], "[$index]hallazgos" )->textarea() ?>

<?php 
	$i = -1;
	foreach( $models['actividades'] as $actividad ) : 
	$i++;
?>

	
	<h4><?= $actividades[$i]->descripcion ?></h4> 

	<?= Html::activeHiddenInput( $actividad, "[$index][$i]id" ) ?>
	
	<?= Html::activeHiddenInput( $actividad, "[$index][$i]id_actividad", ['value' => $actividades[$i]->id] ) ?>
	
	<?= $form->field( $actividad, "[$index][$i]estado_actual" )->textarea() ?>
	
	<?= $form->field( $actividad, "[$index][$i]logros" )->textarea() ?>
	
	<?= $form->field( $actividad, "[$index][$i]fortalezas" )->textarea() ?>
	
	<?= $form->field( $actividad, "[$index][$i]debilidades" )->textarea() ?>
	
	<?= $form->field( $actividad, "[$index][$i]retos" )->textarea() ?>
	
	<?= $form->field( $actividad, "[$index][$i]alarmas" )->textarea() ?>

<?php endforeach; ?>

	<h4><?= "INDICADORES DE RESULTADO" ?></h4> 
<?php 
	
	$i = -1;
	foreach( $models['indicadores'] as $actividad ) : 
	$i++; 
?>

<?php $label = $indicadores[$i]; ?>

	<?= Html::activeHiddenInput( $actividad, "[$index][$i]id" ) ?>
	
	<?= Html::activeHiddenInput( $actividad, "[$index][$i]id_indicador", [ 'value' => $label->id ] ) ?>
	
	<?= $form->field( $actividad, "[$index][$i]valor_indicador" )->textInput()->label( $label->descripcion ) ?>

<?php endforeach; ?>

<?= $form->field( $models['misional'], "[$index]avance_sede_sensibilizacion" )->textInput() ?>