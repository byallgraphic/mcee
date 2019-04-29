<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

use nex\chosen\Chosen;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */
/* @var $form yii\widgets\ActiveForm */


if( !$sede ){
    $this->registerJs( "$( cambiarSede ).click()" );
    return;
}

if(Yii::$app->request->get('guardado')){
	
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
    <label>
        <input type="hidden" id="id" value="<?= isset($model->id) ? $model->id : ''?>">
    </label>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => ['store']]); ?>

    <input type="hidden" id="id_tipo_seguimiento" value="<?= Yii::$app->request->get('idTipoSeguimiento') ?>">

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


    <?=  $form->field($model, 'id_persona_responsable')->dropDownList($personas, ['prompt' => 'Seleccione un profecional' ]); ?>

	<h3 style='background-color:#ccc;padding:5px;'><?= "Avances del proyecto"?></h3>

    <?= $form->field($model, 'indicador')->textInput() ?>

    <?= $form->field($model, 'avances_cumplimiento_cuantitativos')->textarea() ?>

    <?= $form->field($model, 'avances_cumplimiento_cualitativos')->textarea() ?>

    <?= $form->field($model, 'dificultades')->textarea() ?>

    <?= $form->field($model, 'propuesta_dificultades')->textarea() ?>

    <?php /*$form->field($model, 'estado')->textInput() */ ?>

    <h3 style='background-color:#ccc;padding:5px;'><?= "REPORTE DE ACTIVIDADES"?></h3>

    <div class="objetivo" id="objetivo-0">
        <div id="" class="id_objetivo">
            <?= $form->field($reportAct, 'objetivo')->textInput(['disabled' => false, 'id' => 'id_objetivo']) ?>
            <?= $form->field($reportAct, 'actividad')->textInput(['disabled' => false, 'id' => 'id_actividad']) ?>
            <?= $form->field($reportAct, 'descripcion')->textInput(['id' => 'descripcion_actividad']) ?>
            <?= $form->field($reportAct, 'poblacion_beneficiaria')->dropDownList(['Docentes', 'Estudiantes', 'Directivos', 'Otros'], ['prompt' => 'Seleccione una opcion', 'id' => 'poblacion_beneficiaria']); ?>
            <div id="id_quienes">
                <?=  $form->field($reportAct, 'quienes')->textInput(['id' => 'quienes']); ?>
            </div>
            <?= $form->field($reportAct, 'num_participantes')->textInput(['type' => 'number', 'id' => 'numero_participantes']) ?>
            <?= $form->field($reportAct, 'duracion')->textInput(['id' => 'duracion_actividad']) ?>
            <?= $form->field($reportAct, 'logros')->textarea(['id' => 'logros_alcanzados']) ?>
            <?= $form->field($reportAct, 'dificultades')->textarea(['id' => 'dificultadades']) ?>
        </div>

        <div class="evidencia_actividades">
            <h3 style='background-color:#ccc;padding:5px;'><?= "Evidencias de soporte"?></h3>
            <p>Listado de participantes, registro visual, informe de actividades o acta</p>
            <?= $form->field($model, 'documentFile[]')->fileInput(['multiple' => true, 'id' => "file-upload"]) ?>
        </div>
    </div>

    <button id="btnAgregarObj" type="button" class="btn btn-primary" value="0">Agregar Actividades</button>
    <br>
    <br>
    <div class="form-group">

        <?php
            if (Yii::$app->request->get('id')){
        ?>
                <?= Html::button('Actualizar', ['class' => 'btn btn-success',  'id' => 'save_form', 'value' => 1]) ?>
        <?php
            }else{
        ?>
                <?= Html::button('Guardar', ['class' => 'btn btn-success',  'id' => 'save_form', 'value' => 0]) ?>
        <?php
            }
        ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $( document ).ready(function() {
        //$('#modal-form').modal('show');
        $(".modal-guardado").modal('hide');

        $("#id_cual").hide();
        $("#id_quienes").hide();

        $('#id_operador input').on('change', function() {
            if ($(this).val() === '144'){
                $("#id_cual").show();
            }else{
                $("#id_cual").hide();
            }
        });

        $('#id_poblacion').on('change', function() {
            if ($(this).val() === '3'){
                $("#id_quienes").show();
            }else{
                $("#id_quienes").hide();
            }
        });

        var btnObj = $( "#btnAgregarObj" );
        btnObj.click(function(){
            var id_objetivo = $("#objetivo-0");
            var valueBtn = parseInt(btnObj.val(), 'number') + 1;

            id_objetivo.after(
                id_objetivo
                    .clone()
                    .attr('id', 'objetivo-'+ (valueBtn))
                    .prepend( "<div onclick='$(this).parent().remove();' class='col text-right delete-area'>x</div>" )
            );

            $(this).val(valueBtn);
            $('#objetivo-'+ (valueBtn) + ' input').val('');
            $('#objetivo-'+ (valueBtn) + ' textarea').val('');

            id_objetivo.prop('disabled', true);
        });

        $('#save_form').click(function(e){
            e.preventDefault();
            var reporte_actividades = new FormData();
            $('.objetivo').each(function( index ) {
                reporte_actividades[index] = {
                    objetivo: $('#objetivo-'+index+' #id_objetivo').val(),
                    actividad: $('#objetivo-'+index+' #id_actividad').val(),
                    descripcion_actividad: $('#objetivo-'+index+' #descripcion_actividad').val(),
                    id_poblacion: $('#objetivo-'+index+' #poblacion_beneficiaria').val(),
                    numero_participantes: $('#objetivo-'+index+' #numero_participantes').val(),
                    duracion_actividad: $('#objetivo-'+index+' #duracion_actividad').val(),
                    logros_alcanzados: $('#objetivo-'+index+' #logros_alcanzados').val(),
                    dificultadades: $('#objetivo-'+index+' #dificultadades').val()
                };
            });

            var formData = new FormData();
            formData.append("id", $('#id').val());
            formData.append("id_tipo_seguimiento", $(location).attr('href').split("&")[1].split("=")[1]);
            formData.append("email", $('#geseguimientooperador-email').val());
            formData.append("id_operador", $('input:checked', '#id_operador').val());
            formData.append("proyecto_reportar", $('#geseguimientooperador-proyecto_reportar').val());
            formData.append("id_ie", $('#geseguimientooperador-id_ie').val());
            formData.append("mes_reporte", $('#geseguimientooperador_mes_reporte_chosen').find('.chosen-results').find('.result-selected').data("option-array-index"));
            formData.append("semana_reportada", $('#geseguimientooperador-semana_reporte').val());
            formData.append("id_persona_responsable", $('#geseguimientooperador-id_persona_responsable').val());
            formData.append("indicador", $('#geseguimientooperador-indicador').val());
            formData.append("avances_cumplimiento_cuantitativos", $('#geseguimientooperador-avances_cumplimiento_cuantitativos').val());
            formData.append("avances_cumplimiento_cualitativos", $('#geseguimientooperador-avances_cumplimiento_cualitativos').val());
            formData.append("dificultades", $('#geseguimientooperador-dificultades').val());
            formData.append("propuesta_dificultades", $('#geseguimientooperador-propuesta_dificultades').val());
            formData.append("reporte_actividades", JSON.stringify(reporte_actividades));
            formData.append("file", $('#file-upload').prop("files"));

            if ($(this).val() === '1'){
                $.ajax({
                    url: "index.php?r=ge-seguimiento-operador%2Fupdate",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    type: 'POST',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
                    },
                    success: function (res, status) {
                        if (status == 'success') {
                            $("#modal-ge").modal('hide');
                            $('#modal-guardado').modal('show');
                        }
                    },
                });
            }else{
                $.ajax({
                    url: "index.php?r=ge-seguimiento-operador%2Fstore",
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: true,
                    data: formData,
                    type: 'POST',
                    success: function (res, status) {
                        if (status == 'success') {
                            $("#modal-ge").modal('hide');
                            $('#modal-guardado').modal('show');
                        }
                    },
                });
            }

        })
    });
</script>