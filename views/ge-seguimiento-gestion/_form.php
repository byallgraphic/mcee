<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use nex\chosen\Chosen;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoGestion */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);


if( !$sede ){
    $this->registerJs( "$( cambiarSede ).click()" );
    return;
}

if( $guardado ){
	
	$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
	
	$this->registerJs( "
	  swal({
			text: 'Registro guardado',
			icon: 'success',
			button: 'Salir',
		});" 
	);
}
?>

<div class="ge-seguimiento-gestion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php /* $form->field($model, 'id_tipo_seguimiento')->textInput() */ ?>
    <input name="idTipoSeguimiento" type="hidden" value="<?= $idTipoSeguimiento ?>">
	
	<h3 style='background-color:#ccc;padding:5px;'><?= "DATOS GENERALES"?></h3>

    <?= $form->field($model, 'id_ie')->dropDownList( [ $institucion->id => $institucion->descripcion ] ) ?>

    <?= $form->field($model, 'id_cargo')->radioList( $cargos ) ?>

    <?= $form->field($model, 'id_nombre')->widget(
				Chosen::className(), [
					'items' => $personas,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			])  ?>

    <?= $form->field($model, 'fecha')->widget( 
			DatePicker::className(), [
				
				 // modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy'
				]
		]) ?>

	<h3 style='background-color:#ccc;padding:5px;'><?= "Proyectos MCEE en la IEO"?></h3>
		
    <?= $form->field($model, 'id_persona_gestor')->widget(
				Chosen::className(), [
					'items' => $personas,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			])  ?>

    <?= $form->field($model, 'numero_visitas')->textInput() ?>

    <?= $form->field($model, 'socializo_plan')->radioList( $listBoleano ) ?>

    <?= $form->field($model, 'plan_trabajo_socializo')->radioList( $consideracones ) ?>

    <?= $form->field($model, 'descripcion_plan_trabajo')->textarea() ?>

    <?= $form->field($model, 'cronocrama_propuesto')->radioList( $respuestas ) ?>

    <?= $form->field($model, 'descripcion_cronograma')->textarea() ?>

    <?= $form->field($model, 'avances_proyectos')->textarea() ?>

    <?= $form->field($model, 'dificultades')->textarea() ?>

    <?= $form->field($model, 'mejoras')->textarea() ?>

    <?= $form->field($model, 'observaciones')->textarea() ?>

    <?= $form->field($model, 'calificacion_nivel')->radioList( $calificaciones ) ?>

    <?= $form->field($model, 'descripcion_calificacion')->textarea() ?>

    <?php /* $form->field($model, 'estado')->textInput() */ ?>

    <div class="form-group">
	
		<?php if ( !$guardado ) : ?>
		
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
		
		<?php endif ?>
		
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
    $this->registerJs( "
        $( document ).ready(function() {
            $('.main-footer').hide()
        });"
    );
?>