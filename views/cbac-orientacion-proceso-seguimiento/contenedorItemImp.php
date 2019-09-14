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

<?= $form->field($impOps, "[$index][$fase]semana_1")->textInput([ 'value' => isset($datos[$index]['semana_1']) ? $datos[$index]['semana_1'] : '' ]) ?>
<?= $form->field($impOps, "[$index][$fase]semana_2")->textInput([ 'value' => isset($datos[$index]['semana_2']) ? $datos[$index]['semana_2'] : '' ]) ?>
<?= $form->field($impOps, "[$index][$fase]semana_3")->textInput([ 'value' => isset($datos[$index]['semana_3']) ? $datos[$index]['semana_3'] : '' ]) ?>
<?= $form->field($impOps, "[$index][$fase]semana_4")->textInput([ 'value' => isset($datos[$index]['semana_4']) ? $datos[$index]['semana_4'] : '' ]) ?>
<h3 style='background-color: #ccc;padding:5px;'>ORIENTACION METODOLÓGICA</h3>
<?= $form->field($impOps, "[$index][$fase]resumen")->textInput([ 'value' => isset($datos[$index]['resumen']) ? $datos[$index]['resumen'] : '' ]) ?>