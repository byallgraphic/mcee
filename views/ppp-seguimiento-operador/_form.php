<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

use nex\chosen\Chosen;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */
/* @var $form yii\widgets\ActiveForm */

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

if( !$sede ){
    $this->registerJs( "$( cambiarSede ).click()" );
    return;
}

if(Yii::$app->request->get('guardado')){

    $this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/GeSeguimientos.js');
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/tests.js');

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

    <?= $form->field($model, 'email')->textInput(['enableAjaxValidation' => true]) ?>

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


    <?=  $form->field($model, 'id_persona_responsable')->dropDownList($personas, ['prompt' => 'Seleccione un profesional' ]); ?>

    <h3 style='background-color:#ccc;padding:5px;'><?= "Avances del proyecto"?></h3>

    <?= $form->field($model, 'indicador')->textInput() ?>

    <?= $form->field($model, 'avances_cumplimiento_cuantitativos')->textarea() ?>

    <?= $form->field($model, 'avances_cumplimiento_cualitativos')->textarea() ?>

    <?= $form->field($model, 'dificultades')->textarea() ?>

    <?= $form->field($model, 'propuesta_dificultades')->textarea() ?>

    <?php /*$form->field($model, 'estado')->textInput() */ ?>

    <h3 style='background-color:#ccc;padding:5px;'><?= "REPORTE DE ACTIVIDADES"?></h3>

    <?php if($reportExist){ ?>
        <?php foreach ($reportAct AS $key => $report){ ?>
        <div class="objetivo" id="objetivo-<?= $key ?>">
            <div id="" class="id_objetivo">
                <?= $form->field($report, 'objetivo')->textInput(['disabled' => false, 'id' => 'id_objetivo']) ?>
                <?= $form->field($report, 'actividad')->textInput(['disabled' => false, 'id' => 'id_actividad']) ?>
                <?= $form->field($report, 'descripcion')->textInput(['id' => 'descripcion_actividad']) ?>
                <?= $form->field($report, 'poblacion_beneficiaria')->dropDownList(['Docentes', 'Estudiantes', 'Directivos', 'Otros'], ['prompt' => 'Seleccione una opción', 'id' => 'poblacion_beneficiaria']); ?>
                <div id="id_quienes-<?= $key ?>">
                    <?=  $form->field($report, 'quienes')->textInput(['id' => 'quienes']); ?>
                </div>
                <?= $form->field($report, 'num_participantes')->textInput(['type' => 'number', 'id' => 'numero_participantes']) ?>
                <?= $form->field($report, 'duracion')->textInput(['id' => 'duracion_actividad']) ?>
                <?= $form->field($report, 'logros')->textarea(['id' => 'logros_alcanzados']) ?>
                <?= $form->field($report, 'dificultades')->textarea(['id' => 'dificultadades']) ?>
            </div>

            <div class="evidencia_actividades">
                <h3 style='background-color:#ccc;padding:5px;'><?= "Evidencias de soporte"?></h3>
                <p>Listado de participantes, registro visual, informe de actividades o acta</p>
                <?= $form->field($model, 'documentFile[]')->fileInput(['multiple' => true, 'id' => "file-upload-".$key]) ?>
                <div id="nameElement">
                    <?php $files = \app\models\GeSeguimientoFile::find()->where(['id_reporte_actividades' => $report->id ])->asArray()->all(); ?>
                    <ul>
                        <?php foreach($files AS $file){ ?>
                            <li><a href="..\documentos\seguimientoOperador\<?= $file['file'] ?>" download><?= $file['file'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <script>
            $("#id_quienes-<?= $key ?>").hide();
            $('#objetivo-'+ <?= $key ?> + ' #file-upload-'+ <?= $key ?> ).change(function(e){
                var files = $(this).prop("files");
                var files_length = files.length;
                for (var x = 0; x < files_length; x++) {
                    $(this).parent().parent().find('#nameElement').append('<label>'+files[x].name+'</label><br>')
                }
            });
        </script>
    <?php } ?>
    <?php }else{ ?>
        <div class="objetivo" id="objetivo-0">
            <div id="" class="id_objetivo">
                <?= $form->field($reportAct, 'objetivo')->textInput(['disabled' => false, 'id' => 'id_objetivo']) ?>
                <?= $form->field($reportAct, 'actividad')->textInput(['disabled' => false, 'id' => 'id_actividad']) ?>
                <?= $form->field($reportAct, 'descripcion')->textInput(['id' => 'descripcion_actividad']) ?>
                <?= $form->field($reportAct, 'poblacion_beneficiaria')->dropDownList(['Docentes', 'Estudiantes', 'Directivos', 'Otros'], ['prompt' => 'Seleccione una opción', 'id' => 'poblacion_beneficiaria']); ?>
                <div id="id_quienes">
                    <?=  $form->field($reportAct, 'quienes')->hiddenInput(['id' => 'quienes']); ?>
                </div>
                <?= $form->field($reportAct, 'num_participantes')->textInput(['type' => 'number', 'id' => 'numero_participantes']) ?>
                <?= $form->field($reportAct, 'duracion')->textInput(['id' => 'duracion_actividad']) ?>
                <?= $form->field($reportAct, 'logros')->textarea(['id' => 'logros_alcanzados']) ?>
                <?= $form->field($reportAct, 'dificultades')->textarea(['id' => 'dificultadades']) ?>
            </div>

            <div class="evidencia_actividades">
                <h3 style='background-color:#ccc;padding:5px;'><?= "Evidencias de soporte"?></h3>
                <p>Listado de participantes, registro visual, informe de actividades o acta</p>
                <?= $form->field($model, 'documentFile[]')->fileInput(['multiple' => true, 'id' => "file-upload-0"]) ?>
                <div id="nameElement">

                </div>
            </div>
        </div>


        <script>
            $('#file-upload-0').change(function(e){
                var files = $(this).prop("files");
                var files_length = files.length;
                for (var x = 0; x < files_length; x++) {
                    $(this).parent().parent().find('#nameElement').append('<label>'+files[x].name+'</label><br>')
                }
            });
        </script>
    <?php } ?>

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
    var timepicker = new TimePicker('duracion_actividad', {
        lang: 'en',
        theme: 'dark'
    });
    timepicker.on('change', function(evt) {
        var value = (evt.hour || '00') + ':' + (evt.minute || '00');
        evt.element.value = value;

    });
</script>
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
            var validacion = 1;
            $('.objetivo').each(function() {
                if($(this).find('.evidencia_actividades').find('#nameElement').find('li').length === 0){
                    $(this).find('input[type!="hidden"]').each(function(){
                        if (!$(this).val() && ($(this).attr('id') !== 'quienes')) {
                            $(this).parent().addClass('has-error');
                            $(this).parent().find('.help-block').html('Este campo es requerido.');
                            validacion = 0;
                        } else
                            $(this).parent().removeClass('has-error');
                    });
                }
            });

            if (validacion === 0){
                return false;
            }

            var id_objetivo = $("#objetivo-0");
            var valueBtn = parseInt(btnObj.val(), 'number') + 1;

            $('#objetivo-'+ ($(this).val())).after(
                id_objetivo
                    .clone()
                    .attr('id', 'objetivo-'+ (valueBtn))
                    .prepend( "<div onclick='$(this).parent().remove();' class='col text-right delete-area'>x</div>" )
            );

            $(this).val(valueBtn);
            $('#objetivo-'+ (valueBtn) + ' input').val('');
            $('#objetivo-'+ (valueBtn) + ' #file-upload-0').attr('id', 'file-upload-'+ (valueBtn));
            $('#objetivo-'+ (valueBtn)).find('.field-file-upload-0').find('label').attr('for', 'file-upload-'+ (valueBtn));

            $('#objetivo-'+ (valueBtn) + ' #nameElement').empty();
            $('#objetivo-'+ (valueBtn) + ' textarea').val('');

            if ($('#nameElement').find('li').length === 0 ){
                $('#objetivo-'+ (valueBtn) + ' #file-upload-'+ (valueBtn)).change(function(e){
                    var files = $(this).prop("files");
                    var files_length = files.length;
                    for (var x = 0; x < files_length; x++) {
                        $(this).parent().parent().find('#nameElement').append('<label>'+files[x].name+'</label><br>')
                    }
                });
            }

            id_objetivo.prop('disabled', true);
        });

        $('#save_form').click(function(e){
            e.preventDefault();

            //Variables para evaluar el ingreso de datos
            var email = $('#pppseguimientooperador-email');
            var id_operador = $('#id_operador');
            var proyecto_reportar = $('#pppseguimientooperador-proyecto_reportar');
            var id_ie = $('#pppseguimientooperador-id_ie');
            ////
            var semana_reporte = $('#pppseguimientooperador-semana_reporte');
            var id_persona_responsable = $('#pppseguimientooperador-id_persona_responsable');
            var indicador = $('#pppseguimientooperador-indicador');
            var avances_cumplimiento_cuantitativos = $('#pppseguimientooperador-avances_cumplimiento_cuantitativos');
            var avances_cumplimiento_cualitativos = $('#pppseguimientooperador-avances_cumplimiento_cualitativos');
            var dificultades_indicadores = $('#pppseguimientooperador-dificultades');
            var dificultades = $('#dificultadades');
            var propuesta_dificultades = $('#pppseguimientooperador-propuesta_dificultades');
            var reporte_obj = $('.objetivo');

            var validacion = 1;

            //Validar si se ingresaron los datos
            if (email.val() === '') {
                email.parent().addClass('has-error');
                email.parent().find('.help-block').html('Dirección de correo electrónico no puede estar vacío.');
                validacion = 0;
            } else
                email.parent().removeClass('has-error');

            if ($('input:checked', '#id_operador').val() === undefined) {
                id_operador.parent().addClass('has-error');
                id_operador.parent().find('.help-block').html('Debe seleccionar un nombre de operador');
                validacion = 0;
            } else
                id_operador.parent().removeClass('has-error');

            if (!proyecto_reportar.val()) {
                proyecto_reportar.parent().addClass('has-error');
                proyecto_reportar.parent().find('.help-block').html('Debe de ingresar una proyecto a reportar.');
                validacion = 0;
            } else
                proyecto_reportar.parent().removeClass('has-error');

            if (!id_ie.val()) {
                id_ie.parent().addClass('has-error');
                id_ie.parent().find('.help-block').html('Debe de ingresar una clave menor a 40 caracteres.');
                validacion = 0;
            } else
                id_ie.parent().removeClass('has-error');

            if (!semana_reporte.val()) {
                semana_reporte.parent().addClass('has-error');
                semana_reporte.parent().find('.help-block').html('Debe seleccionar una semana.');
                validacion = 0;
            } else
                semana_reporte.parent().removeClass('has-error');

            if (!id_persona_responsable.val()) {
                id_persona_responsable.parent().addClass('has-error');
                id_persona_responsable.parent().find('.help-block').html('Seleccione un responsable.');
                validacion = 0;
            } else
                id_persona_responsable.parent().removeClass('has-error');

            if (!indicador.val()) {
                indicador.parent().addClass('has-error');
                indicador.parent().find('.help-block').html('no indico a que indicador del proyecto le apuntó.');
                validacion = 0;
            } else
                indicador.parent().removeClass('has-error');

            if (!avances_cumplimiento_cualitativos.val()) {
                avances_cumplimiento_cualitativos.parent().addClass('has-error');
                avances_cumplimiento_cualitativos.parent().find('.help-block').html('indique los avances para el cumplimiento.');
                validacion = 0;
            } else
                avances_cumplimiento_cualitativos.parent().removeClass('has-error');

            if (!avances_cumplimiento_cuantitativos.val()) {
                avances_cumplimiento_cuantitativos.parent().addClass('has-error');
                avances_cumplimiento_cuantitativos.parent().find('.help-block').html('Debe describir los avances para el cumplimiento del indicador.');
                validacion = 0;
            } else
                avances_cumplimiento_cuantitativos.parent().removeClass('has-error');

            if (!dificultades.val()) {
                dificultades.parent().addClass('has-error');
                dificultades.parent().find('.help-block').html('Mencione las dificultades para el cumplimiento de los indicadores.');
                validacion = 0;
            } else
                avances_cumplimiento_cuantitativos.parent().removeClass('has-error');

            if (!propuesta_dificultades.val()) {
                propuesta_dificultades.parent().addClass('has-error');
                propuesta_dificultades.parent().find('.help-block').html('Qué propuesta(s) plantea para superar esas dificultades.');
                validacion = 0;
            } else
                propuesta_dificultades.parent().removeClass('has-error');

            reporte_obj.each(function() {
                $(this).find('input[type!="hidden"]').each(function(){
                    if (!$(this).val() && ($(this).attr('id') !== 'quienes') && $('#save_form').text() !== "Actualizar") {
                        $(this).parent().addClass('has-error');
                        $(this).parent().find('.help-block').html('Este campo es requerido.');
                        validacion = 0;
                    } else
                        $(this).parent().removeClass('has-error');
                });
            });

            var reg = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
            var duracion = $("#duracion_actividad");
            if (!reg.test(duracion.val())){
                duracion.parent().addClass('has-error');
                duracion.parent().find('.help-block').html('Hora no permitida.');
                validacion = 0;
            }

            if (validacion === 0){
                return false;
            }

            var reporte_actividades = [];
            reporte_obj.each(function( index ) {
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
            formData.append("email", email.val());
            formData.append("id_operador", $('input:checked', '#id_operador').val());
            formData.append("proyecto_reportar", proyecto_reportar.val());
            formData.append("id_ie", id_ie.val());
            formData.append("mes_reporte", $('#geseguimientooperador_mes_reporte_chosen').find('.chosen-results').find('.result-selected').data("option-array-index"));
            formData.append("semana_reportada", semana_reporte.val());
            formData.append("id_persona_responsable", id_persona_responsable.val());
            formData.append("indicador", indicador.val());
            formData.append("avances_cumplimiento_cuantitativos", avances_cumplimiento_cuantitativos.val());
            formData.append("avances_cumplimiento_cualitativos", avances_cumplimiento_cuantitativos.val());
            formData.append("dificultades", dificultades_indicadores.val());
            formData.append("propuesta_dificultades", propuesta_dificultades.val());
            formData.append("reporte_actividades", JSON.stringify(reporte_actividades));

            var files = $('#file-upload-0').prop("files");
            var files_length = files.length;
            for (var x = 0; x < files_length; x++) {
                formData.append("files[]", files[x]);
            }

            if ($(this).val() === '1'){
                $.ajax({
                    url: "index.php?r=ppp-seguimiento-operador%2Fupdate",
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: true,
                    data: formData,
                    type: 'POST',
                    success: function (res, status) {
                        if (status == 'success') {
                            $("#modal-ge").modal('hide');
                            swal({
                                text: 'Registro actualizado',
                                icon: 'success',
                                button: 'Salir',
                            });
                        }
                    },
                });
            }else{
                $.ajax({
                    url: "index.php?r=ppp-seguimiento-operador%2Fstore",
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: true,
                    data: formData,
                    type: 'POST',
                    success: function (res, status) {
                        if (status == 'success') {
                            $("#modal-ge").modal('hide');
                            //$("#datatables_w0").load(location.href + " #datatables_w0");
                            swal({
                                text: 'Registro guardado',
                                icon: 'success',
                                button: 'Salir',
                            });

                            location.reload();
                        }
                    },
                });
            }

        })
    });
</script>