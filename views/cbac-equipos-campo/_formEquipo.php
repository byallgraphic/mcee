<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CbacIntegrantesXEquipo;
use nex\chosen\Chosen;
$intreganteEquipo = new CbacIntegrantesXEquipo();

$this->registerJs( file_get_contents( '../web/js/equipo_campo_cbac.js' ) );

/* @var $this yii\web\View */
/* @var $model app\models\CbacEquiposCampo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="cbac-equipos-campo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>
	
	
    <?php $form->field($intreganteEquipo, 'id_perfil_persona_institucion')->textInput() ?>
	
	<?= $form->field($intreganteEquipo, "id_perfil_persona_institucion")->widget(
						Chosen::className(), [
							'items' => $integrantes,
							'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
							'multiple' => true,
							'clientOptions' => [
								'search_contains' => true,
								'single_backstroke_delete' => false,
							],
                            'placeholder' => 'Seleccione...',
					])->label("Integrantes")?>
					

    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" id ="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
    <div class="form-group">
		
        <button type="button" class='btn btn-success BtnGuardar' name ='BtnGuardar' id='BtnGuardar'>Guardar</button>
        
		<button type="button" class='btn btn-info BtnCerrar' id='BtnCerrar'>Cerrar</button>
	
    </div>

    <?php ActiveForm::end(); ?>

</div>





