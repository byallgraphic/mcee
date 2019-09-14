<?php
/**********
Modificaciones:
Fecha: 06-09-2018
Persona encargada: Andrés Felipe Giraldo
Cambios realizados: Se incluye CSS de modal de bootstrap.
---------------------------------------
*/
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion se redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// HTML::getInputName( $model, 'id_perfiles_x_personas' );

/* @var $this yii\web\View */
/* @var $model app\models\Docentes */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="docentes-form">


	<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_perfiles_x_personas')->dropDownList( $personas, [ 'prompt' => 'Seleccione...' ] )->label( 'Docente' ) ?>

    <?= $form->field($model, 'id_escalafones')->dropDownList( $escalafones, [ 'prompt' => 'Seleccione...' ] ) ?>
    
	<?= $form->field($model, 'Antiguedad')->textInput( [ 'type' => 'number', 'placeholder' => 'Digite la antigüedad del docente' ] ) ?>

    <?= $form->field($model, 'estado')->dropDownList( $estados ) ?>
	
	<div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>
  

</div>
