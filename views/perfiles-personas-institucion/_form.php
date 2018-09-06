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
*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\PerfilesPersonasInstitucion */
/* @var $form yii\widgets\ActiveForm */

	echo "<input type='hidden' id='hidPerfilSelected' name='hidPerfilSelected' value='".$perfilesSelected[0]['id']."'>";
	echo "<input type='hidden' id='hidPerfilesPersonasSelected' name='hidPerfilesPersonasSelected' value='".$PerfilesXPersonas[0]['id']."'>";
	echo "<input type='hidden' id='hidModificar' name='hidModificar' value='".$modificar."'>";
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);			
?>

<div class="perfiles-personas-institucion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_institucion')->dropDownList($instituciones,['prompt' => 'Seleccione...',]) ?>
	
	<?= $form->field($perfilesTable, 'id')->dropDownList($perfiles,['prompt' => 'Seleccione...','id' =>'selPerfiles','options' => [$perfilesSelected[0]['id'] => ['selected' => 'selected']]])->label("Perfil") ?>
	
	<?= $form->field($model, 'id_perfiles_x_persona')->dropDownList(['prompt' => 'Seleccione...']) ?>
	
	<?= $form->field($model, 'observaciones')->textarea(['rows' => '6']) ?>

    <?= $form->field($model, 'estado')->dropDownList($estados,['prompt' => 'Seleccione...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
