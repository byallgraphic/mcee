<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CbacIntegrantesXEquipo;
use nex\chosen\Chosen;
$intreganteEquipo = new CbacIntegrantesXEquipo();


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
							'items' => [],
							'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
							'multiple' => true,
							'clientOptions' => [
								'search_contains' => true,
								'single_backstroke_delete' => false,
							],
                            'placeholder' => 'Seleccione...',
					])->label("Integrantes")?>
					

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





