<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion | redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;

?>

 <?= $form->field($actividadMisional, "[$index]estado")->textInput([ 'value' => isset($datos[$index]['estado']) ? $datos[$index]['estado'] : '' ]) ?>
 <?= $form->field($actividadMisional, "[$index]logros")->textInput([ 'value' => isset($datos[$index]['logros']) ? $datos[$index]['logros'] : '' ]) ?>
 <?= $form->field($actividadMisional, "[$index]fortalezas")->textInput([ 'value' => isset($datos[$index]['fortalezas']) ? $datos[$index]['fortalezas'] : '' ]) ?>
 <?= $form->field($actividadMisional, "[$index]debilidades")->textInput([ 'value' => isset($datos[$index]['debilidades']) ? $datos[$index]['debilidades'] : '' ]) ?>
 <?= $form->field($actividadMisional, "[$index]retos")->textInput([ 'value' => isset($datos[$index]['retos']) ? $datos[$index]['retos'] : '' ]) ?>
 <?= $form->field($actividadMisional, "[$index]alarmas")->textInput([ 'value' => isset($datos[$index]['alarmas']) ? $datos[$index]['alarmas'] : '' ]) ?>
