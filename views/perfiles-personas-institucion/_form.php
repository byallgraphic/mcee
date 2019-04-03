<?php
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

/**********
Versión: 001
Fecha: 25-04-2018
Desarrollador: Maria Viviana Rodas
Descripción: Form de perfiles persona institucion
---------------------------------------
Modificaciones:
Fecha: 02-01-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: 
*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nex\chosen\Chosen;

/* @var $this yii\web\View */
/* @var $model app\models\PerfilesPersonasInstitucion */
/* @var $form yii\widgets\ActiveForm */

	echo "<input type='hidden' id='hidPerfilSelected' name='hidPerfilSelected' value='".$perfilesSelected[0]['id']."'>";
	echo "<input type='hidden' id='hidPerfilesPersonasSelected' name='hidPerfilesPersonasSelected' value='".$PerfilesXPersonas[0]['id']."'>";
	echo "<input type='hidden' id='hidModificar' name='hidModificar' value='".$modificar."'>";
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$this->registerJs( file_get_contents( '../web/js/perfilesPersonasInstitucion.js' ) );	
?>

<div class="perfiles-personas-institucion-form">

    <?php $form = ActiveForm::begin(); ?>
   	
	<?= $form->field($model, 'id_institucion')->widget(
    Chosen::className(), [
        'items' => $instituciones,
        'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
		'placeholder' => 'Seleccione...', // Search input will be disabled
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ]
		]);?>
	
	
	<?= $form->field($model, 'id_sede')->widget(
    Chosen::className(), [
        'items' => [],
		'multiple' => true,
        'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
		'placeholder' => 'Seleccione...', // Search input will be disabled
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ]
		]);?>
	
	<?php $form->field($perfilesTable, 'id')->dropDownList($perfiles,['prompt' => 'Seleccione...','id' =>'selPerfiles','options' => [$perfilesSelected[0]['id'] => ['selected' => 'selected']]])->label("Perfil") ?>
	
	
	<?= $form->field($perfilesTable, 'id')->widget(
    Chosen::className(), [
        'items' => $perfiles,
        'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
		'placeholder' => 'Seleccione...', // Search input will be disabled
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ]
		])->label("Perfil");?>
	
	
	<?= $form->field($model, 'id_perfiles_x_persona')->widget(
    Chosen::className(), [
        'items' => [],
        'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
		'placeholder' => 'Seleccione...', // Search input will be disabled
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ]
		]);?>
	
	
	<?= $form->field($model, 'observaciones')->textarea(['rows' => '6']) ?>

	<?= $form->field($model, 'estado')->hiddenInput(['value'=> 1])->label(false) ?> 

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
