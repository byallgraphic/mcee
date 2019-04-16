<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IsaEquiposCampo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJs( file_get_contents( '../web/js/equipo_campo.js' ) );


?>

<div class="isa-equipos-campo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput([ 'type' => 'number']) ?>

	<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" id ="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
    <div class="form-group">
		
        <button type="button" class='btn btn-success' name ='BtnGuardar' id='BtnGuardar'>Guardar</button>
        
		<button type="button" class='btn btn-info' id='BtnCerrar'>Cerrar</button>
	
		<?php Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>