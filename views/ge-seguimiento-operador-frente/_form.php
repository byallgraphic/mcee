<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use nex\chosen\Chosen;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperadorFrente */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);


if( !$sede ){
    $this->registerJs( "$( cambiarSede ).click()" );
    return;
}

?>

<div class="ge-seguimiento-operador-frente-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php /*$form->field($model, 'id_tipo_seguimiento')->textInput()*/ ?>
    <input name="idTipoSeguimiento" type="hidden" value="<?= $idTipoSeguimiento ?>">

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	
	<h3 style='background-color:#ccc;padding:5px;'><?= "DATOS GENERALES"?></h3>

    <?= $form->field($model, 'id_persona_diligencia')->widget(
				Chosen::className(), [
					'items' => $personas,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			])   ?>

    <?= $form->field($model, 'id_gestor_a_evaluar')->widget(
				Chosen::className(), [
					'items' => $personas,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			])   ?>

    <?= $form->field($model, 'mes_reporte')->dropDownList( $mesReporte, [ 'prompt' => 'Seleccione...' ] ) ?>

    <?= $form->field($model, 'fecha_corte')->widget( 
			DatePicker::className(), [
				
				 // modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy'
				]
		]) ?>
		
	<h3 style='background-color:#ccc;padding:5px;'><?= "Plan de trabajo equipo gestor"?></h3>
		
    <?= $form->field($model, 'cumple_cronograma')->radioList( $sino ) ?>

    <?= $form->field($model, 'descripcion_cronograma')->textarea() ?>

    <?= $form->field($model, 'compromisos_establecidos')->dropDownList( $seleccion, [ 'prompt' => 'Seleccione...' ]) ?>

    <?= $form->field($model, 'cuantas_reuniones')->textInput() ?>

    <?= $form->field($model, 'aportes_reuniones')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'logros')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'dificultades')->textarea(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'documentFile')->fileInput(['multiple' => true]) ?>

    <?php /* $form->field($model, 'estado')->textInput() */ ?>

    <div class="form-group">
	
		<?php if ( !$guardado ) : ?>
		
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
		
		<?php endif ?>
		
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
    $this->registerJs( "$('#modalContent .main-footer').hide()" );
?>