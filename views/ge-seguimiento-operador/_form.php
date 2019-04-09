<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use nex\chosen\Chosen;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/css/GeSeguimientos.css');
$this->registerJsFile('@web/js/jquery-3.3.1.min.js');
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@web/js/GeSeguimientos.js');

if( $guardado ){
	
	$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/GeSeguimientos.js');

    $this->registerJs( "
	  swal({
			text: 'Registro guardado',
			icon: 'success',
			button: 'Salir',
		});" 
	);
}
?>

<div class="ge-seguimiento-operador-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => ['store']]); ?>

    <input id="id_tipo_seguimiento" value="<?= Yii::$app->request->get('idTipoSeguimiento') ?>">

    <?= $form->field($model, 'email')->textInput() ?>

	<h3 style='background-color:#ccc;padding:5px;'><?= "DATOS GENERALES"?></h3>

    <?= $form->field($model, 'id_operador')->radioList($nombresOperador, ['id' => 'id_operador']) ?>

    <div id="id_cual">
        <?=  $form->field($model, 'cual_operador')->textInput(); ?>
    </div>

    <?= $form->field($model, 'proyecto_reportar')->textInput() ?>

    <?= $form->field($model, 'id_ie')->dropDownList( [ $institucion->id => $institucion->descripcion ] ) ?>

    <?= $form->field($model, 'mes_reporte')
			->widget(
				Chosen::className(), [
					'items' => $mesReporte,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			]) ?>

    <?=  $form->field($model, 'semana_reporte')->dropDownList(['semana 1','semana 2','semana 3','semana 4'], ['prompt' => 'Seleccione una semana' ]); ?>

    <?= $form->field($model, 'id_persona_responsable')->widget(
				Chosen::className(), [
					'items' => $personas,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'placeholder' => 'Seleccione...',
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
						'no_results_text'			=> 'Sin resultados para ',
					]
			]) ?>

    <?= Chosen::widget([
        'name' => 'ChosenTest',
        'value' => 3,
        'items' => [1 => 'First item', 2 => 'Second item', 3 => 'Third item'],

        'placeholder' => 'Select',
    ]);?>
	<h3 style='background-color:#ccc;padding:5px;'><?= "Avances del proyecto"?></h3>

    <?= $form->field($model, 'id_indicador')->radioList( $indicadores ) ?>

    <?= $form->field($model, 'avances_cumplimiento_cuantitativos')->textarea() ?>

    <?= $form->field($model, 'avances_cumplimiento_cualitativos')->textarea() ?>

    <?= $form->field($model, 'dificultades')->textarea() ?>

    <?= $form->field($model, 'propuesta_dificultades')->textarea() ?>

    <?php /*$form->field($model, 'estado')->textInput() */ ?>

    <h3 style='background-color:#ccc;padding:5px;'><?= "REPORTE DE ACTIVIDADES"?></h3>

    <div class="objetivo" id="objetivo-0">
        <div id="" class="id_objetivo">
            <?= $form->field($model, 'id_objetivo')->textInput(['disabled' => false, 'id' => 'id_objetivo']) ?>
            <?= $form->field($model, 'id_actividad')->textInput(['disabled' => false, 'id' => 'id_actividad']) ?>
            <?= $form->field($model, 'descripcion_actividad')->textInput(['id' => 'descripcion_actividad']) ?>
            <?= $form->field($model, 'poblacion_beneficiaria')->dropDownList(['docentes', 'estudiantes', 'directivos', 'otros'], ['prompt' => 'Seleccione una opcion', 'id' => 'poblacion_beneficiaria']); ?>
            <div id="id_quienes">
                <?=  $form->field($model, 'quienes')->textInput(['id' => 'quienes']); ?>
            </div>
            <?= $form->field($model, 'numero_participantes')->textInput(['type' => 'number', 'id' => 'numero_participantes']) ?>
            <?= $form->field($model, 'duracion_actividad')->textInput(['id' => 'duracion_actividad']) ?>
            <?= $form->field($model, 'logros_alcanzados')->textarea(['id' => 'logros_alcanzados']) ?>
            <?= $form->field($model, 'dificultadades')->textarea(['id' => 'dificultadades']) ?>
        </div>

        <div class="evidencia_actividades">
            <h3 style='background-color:#ccc;padding:5px;'><?= "Evidencias de soporte"?></h3>
            <p>Listado de participantes, registro visual, informe de actividades o acta</p>
            <?= $form->field($model, 'documentFile')->fileInput(['multiple' => true, 'id' => "file-upload"]) ?>
        </div>
    </div>

    <button id="btnAgregarObj" type="button" class="btn btn-primary" value="0">Agregar Actividades</button>
    <br>
    <br>
    <div class="form-group">

        <?php if ( !$guardado ) : ?>

        <?= Html::button('Guardar', ['class' => 'btn btn-success',  'id' => 'save_form']) ?>

		<?php endif ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
