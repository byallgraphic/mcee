<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

use nex\chosen\Chosen;

/* @var $this yii\web\View */
/* @var $model app\models\GeSeguimientoOperador */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->baseUrl.'\js\jquery.timepicker.min.js');
$this->registerCssFile(Yii::$app->request->baseUrl.'\css\jquery.timepicker.min.css');

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

    <input type="hidden" id="id_tipo_seguimiento" value="1">

    <?= $form->field($model, 'email')->textInput(['enableAjaxValidation' => true]) ?>

	<h3 style='background-color:#ccc;padding:5px;'><?= "DATOS GENERALES"?></h3>

    <?= $form->field($model, 'id_operador')->radioList($nombresOperador, ['id' => 'id_operador']) ?>

    <div id="id_cual">
        <?=  $form->field($model, 'cual_operador')->textInput(); ?>
    </div>

    <?= $form->field($model, 'proyecto_reportar')->textInput() ?>

    <?= $form->field($model, 'id_ie')->dropDownList( [ $institucion->id => $institucion->descripcion ] ) ?>

    <?=  $form->field($model, 'mes_reporte')->dropDownList($mesReporte, ['prompt' => 'Seleccione un mes' ]); ?>

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
        <?php $key = 1 ?>
        <?php foreach ($reportAct AS $report){ ?>
            <div class="objetivo" id="objetivo-<?= $key ?>">
                <?php if ($key > 1){?>
                    <div onclick='deleteActividad(<?= $report->id ?>, "objetivo-<?= $key ?>")' class='col text-right delete-area'>x</div>
                <?php } ?>
                <div class="title_report">Reporte de actividad <?= $key ?></div>
                <div id="" class="id_objetivo">
                    <?= $form->field($report, 'objetivo')->textInput(['disabled' => false, 'id' => 'id_objetivo']) ?>
                    <?= $form->field($report, 'actividad')->textInput(['disabled' => false, 'id' => 'id_actividad']) ?>
                    <?= $form->field($report, 'descripcion')->textInput(['id' => 'descripcion_actividad']) ?>
                    <?= $form->field($report, 'poblacion_beneficiaria')->dropDownList(['Docentes', 'Estudiantes', 'Directivos', 'Otros'], ['prompt' => 'Seleccione una opción', 'id' => 'poblacion_beneficiaria-'.$key, 'onchange' => 'poblacionBeneficiada('.$key.')']); ?>
                    <div id="id_quienes-<?= $key ?>">
                        <?=  $form->field($report, 'quienes')->textInput(['id' => 'quienes-'.$key]); ?>
                    </div>
                    <?= $form->field($report, 'num_participantes')->textInput(['type' => 'number', 'id' => 'numero_participantes']) ?>
                    <?= $form->field($report, 'duracion')->textInput(['id' => 'duracion_actividad-'.$key, 'name' => 'duracion_actividad-'.$key]) ?>
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
                                <li id="line_file_<?= $file['id'] ?>" class="line-file-name"><a class="name-file" href="..\documentos\seguimientoOperador\<?= $file['file'] ?>" download><?= $file['file'] ?></a><div onclick='deleteFile("<?= $file['id'] ?>")' class='delete-line'>x</div></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <script>
                    $("#id_quienes-<?= $key ?>").hide();
                    $('#objetivo-'+ <?= $key ?> + ' #file-upload-'+ <?= $key ?> ).change(function(e){
                        var files = $(this).prop("files");
                        var files_length = files.length;
                        for (var x = 0; x < files_length; x++) {
                            $(this).parent().parent().find('#nameElement').find('ul').append('<li class="line-file-name"><span class="name-file">'+files[x].name+'</span><div onclick="$(this).parent().remove()" class=\'delete-line\'>x</div>' + '</li>')
                        }
                    });
                </script>
            </div>
            <?php $key++ ?>
        <?php } ?>
    <?php }else{ ?>
        <div class="objetivo" id="objetivo-1">
            <div class="title_report">Reporte de actividad 1</div>
            <div id="" class="id_objetivo">
                <?= $form->field($reportAct, 'objetivo')->textInput(['disabled' => false, 'id' => 'id_objetivo']) ?>
                <?= $form->field($reportAct, 'actividad')->textInput(['disabled' => false, 'id' => 'id_actividad']) ?>
                <?= $form->field($reportAct, 'descripcion')->textInput(['id' => 'descripcion_actividad']) ?>
                <?= $form->field($reportAct, 'poblacion_beneficiaria')->dropDownList(['Docentes', 'Estudiantes', 'Directivos', 'Otros'], ['prompt' => 'Seleccione una opción', 'id' => 'poblacion_beneficiaria-1', 'onchange' => 'poblacionBeneficiada(1)']); ?>
                <div id="id_quienes-1">
                    <?=  $form->field($reportAct, 'quienes')->textInput(['id' => 'quienes-1']); ?>
                </div>
                <?= $form->field($reportAct, 'num_participantes')->textInput(['type' => 'number', 'id' => 'numero_participantes']) ?>
                <?= $form->field($reportAct, 'duracion')->textInput(['id' => 'duracion_actividad-1', 'autocomplete' => "off"]) ?>
                <?= $form->field($reportAct, 'logros')->textarea(['id' => 'logros_alcanzados']) ?>
                <?= $form->field($reportAct, 'dificultades')->textarea(['id' => 'dificultadades']) ?>
            </div>
            <div class="evidencia_actividades">
                <h3 style='background-color:#ccc;padding:5px;'><?= "Evidencias de soporte"?></h3>
                <p>Listado de participantes, registro visual, informe de actividades o acta</p>
                <?= $form->field($model, 'documentFile[]')->fileInput(['multiple' => true, 'id' => "file-upload-1"]) ?>
                <div id="nameElement">
                    <ul></ul>
                </div>
            </div>
        </div>


        <script>
            $('#file-upload-1').change(function(e){
                var files = $(this).prop("files");
                var files_length = files.length;
                for (var x = 0; x < files_length; x++) {
                    $(this).parent().parent().find('#nameElement').find('ul').append('<li class="line-file-name"><span class="name-file">'+files[x].name+'</span><div onclick="$(this).parent().remove()" class=\'delete-line\'>x</div>' + '</li>')
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
    function deleteFile(id) {
        $.ajax({
            url: "index.php?r=ge-seguimiento-operador%2Fdfile&id="+id,
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            type: 'GET',
            success: function (res, status) {
                if (status){
                    $('#line_file_'+id).remove();
                }
            },
        });
    }
    function deleteActividad(id, objetivoId){
        $.ajax({
            url: "index.php?r=ge-seguimiento-operador%2Fdactividad&id="+id,
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            type: 'GET',
            success: function (res, status) {
                if (status){
                    $('#'+objetivoId).remove();
                }
            },
        });
    }
    function poblacionBeneficiada(id){
        if ($("#poblacion_beneficiaria-"+id).val() === '3'){
            $("#id_quienes-"+id).show();
        }else{
            $("#id_quienes-"+id).hide();
        }
    }

    $( document ).ready(function() {
        $('[id*=\'id_quienes-\']').hide();

        var btnObj = $( "#btnAgregarObj" );
        btnObj.val(parseInt($('[id*=\'objetivo-\']').length, 'number'));
        $('#duracion_actividad-1').timepicker({
            timeFormat: 'H:i',
            step: (5)
        });

        $('._jw-tpk-header ._jw-tpk-hour').text('Horas');
        $('._jw-tpk-header ._jw-tpk-minute').text('Minutos');

        //$('#modal-form').modal('show');
        $(".modal-guardado").modal('hide');

        $("#id_cual").hide();

        $('#id_operador input').on('change', function() {
            if ($(this).val() === '144'){
                $("#id_cual").show();
            }else{
                $("#id_cual").hide();
            }
        });

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

            var id_objetivo = $("#objetivo-1");
            var valueBtn = parseInt($('[id*=\'objetivo-\']').length, 'number') + 1;

            $('#objetivo-'+ (valueBtn-1)).after(
                id_objetivo
                    .clone()
                    .attr('id', 'objetivo-'+ (valueBtn))
                    .prepend( "<div onclick='$(this).parent().remove();' class='col text-right delete-area'>x</div>" )
            );

            $('#objetivo-'+ (valueBtn) + ' .title_report').text('Reporte de actividad '+ valueBtn );

            $(this).val(valueBtn);
            $('#objetivo-'+ (valueBtn) + ' input').val('');
            $('#objetivo-'+ (valueBtn) + ' #file-upload-1').attr('id', 'file-upload-'+ (valueBtn));
            $('#objetivo-'+ (valueBtn) + ' #duracion_actividad-1').attr('id', 'duracion_actividad-'+ (valueBtn))
                .attr('name', 'duracion_actividad-'+ (valueBtn));
            $('#objetivo-'+ (valueBtn) + ' #poblacion_beneficiaria-1').attr('id', 'poblacion_beneficiaria-'+ (valueBtn));
            $('#objetivo-'+ (valueBtn) + ' #id_quienes-1').attr('id', 'id_quienes-'+ (valueBtn));

            $('#poblacion_beneficiaria-'+ (valueBtn)).attr('onchange', $('#poblacion_beneficiaria-'+ (valueBtn)).attr('onchange').replace(1, 3));

            $('#duracion_actividad-'+ (valueBtn)).timepicker({
                timeFormat: 'H:i',
                step: (5)
            });

            $('._jw-tpk-header ._jw-tpk-hour').text('Horas');
            $('._jw-tpk-header ._jw-tpk-minute').text('Minutos');

            $('#objetivo-'+ (valueBtn)).find('.field-file-upload-1').find('label').attr('for', 'file-upload-'+ (valueBtn));

            var elementoFile = $('#objetivo-'+ (valueBtn) + ' #nameElement').find('ul');
            elementoFile.empty();
            $('#objetivo-'+ (valueBtn) + ' textarea').val('');

            if (elementoFile.find('li').length === 0 ){
                $('#objetivo-'+ (valueBtn) + ' #file-upload-'+ (valueBtn)).change(function(e){
                    var files = $(this).prop("files");
                    var files_length = files.length;
                    for (var x = 0; x < files_length; x++) {
                        $(this).parent().parent().find('#nameElement').find('ul').append('<li class="line-file-name"><span class="name-file">'+files[x].name+'</span><div onclick="$(this).parent().remove()" class=\'delete-line\'>x</div>' + '</li>')
                    }
                });
            }

            id_objetivo.prop('disabled', true);
        });

        $('#save_form').click(function(e){
            e.preventDefault();

            //Variables para evaluar el ingreso de datos
            var email = $('#geseguimientooperador-email');
            var id_operador = $('#id_operador');
            var proyecto_reportar = $('#geseguimientooperador-proyecto_reportar');
            var id_ie = $('#geseguimientooperador-id_ie');
            var mes_reporte = $('#geseguimientooperador-mes_reporte');
            var semana_reporte = $('#geseguimientooperador-semana_reporte');
            var id_persona_responsable = $('#geseguimientooperador-id_persona_responsable');
            var indicador = $('#geseguimientooperador-indicador');
            var avances_cumplimiento_cuantitativos = $('#geseguimientooperador-avances_cumplimiento_cuantitativos');
            var avances_cumplimiento_cualitativos = $('#geseguimientooperador-avances_cumplimiento_cualitativos');
            var dificultades_indicadores = $('#geseguimientooperador-dificultades');
            var dificultades = $('#dificultadades');
            var propuesta_dificultades = $('#geseguimientooperador-propuesta_dificultades');
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

            if (!mes_reporte.val()) {
                mes_reporte.parent().addClass('has-error');
                mes_reporte.parent().find('.help-block').html('Debe seleccionar un mes.');
                validacion = 0;
            } else
                semana_reporte.parent().removeClass('has-error');

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

            if (!dificultades_indicadores.val()) {
                dificultades_indicadores.parent().addClass('has-error');
                dificultades_indicadores.parent().find('.help-block').html('Qué propuesta(s) plantea para superar esas dificultades.');
                validacion = 0;
            } else
                dificultades_indicadores.parent().removeClass('has-error');

            reporte_obj.each(function() {
                var reg = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;

                var duracion = $(this).find("[id*='duracion_actividad']");
                if (!reg.test(duracion.val())){
                    duracion.parent().removeClass('has-success');
                    duracion.parent().addClass('has-error');
                    duracion.addClass('has-error');
                    duracion.parent().find('.help-block').html('Hora no permitida.');
                    validacion = 0;
                }

                $(this).find('input[type!="hidden"]').each(function(){
                    if (!$(this).val() && $('#save_form').text() !== "Actualizar" && $(this).attr('id').split('-')[0] !== 'quienes') {
                        $(this).parent().addClass('has-error');
                        $(this).parent().find('.help-block').html('Este campo es requerido.');
                        validacion = 0;
                    } else
                        $(this).parent().removeClass('has-error');
                });
            });

            $('[id*=\'file-upload-\']').each(function() {
                if ($(this).parent().parent().find('li').length === 0){
                    $(this).parent().addClass('has-error');
                    $(this).parent().find('.help-block').html('Este campo es requerido.');
                    validacion = 0;
                }
            });

            if (validacion === 0){
                return false;
            }

            var reporte_actividades = [];
            var index = 1;
            reporte_obj.each(function() {
                reporte_actividades[index] = {
                    objetivo: $('#objetivo-'+index+' #id_objetivo').val(),
                    actividad: $('#objetivo-'+index+' #id_actividad').val(),
                    descripcion_actividad: $('#objetivo-'+index+' #descripcion_actividad').val(),
                    id_poblacion: $('#objetivo-'+index+' [id*=\'poblacion_beneficiaria\']').val(),
                    numero_participantes: $('#objetivo-'+index+' #numero_participantes').val(),
                    duracion_actividad: $('#objetivo-'+index+' [id*=\'duracion_actividad\']').val(),
                    logros_alcanzados: $('#objetivo-'+index+' #logros_alcanzados').val(),
                    dificultadades: $('#objetivo-'+index+' #dificultadades').val(),
                    files: {

                    }
                };

                index++;
            });

            var formData = new FormData();
            formData.append("id", $('#id').val());
            formData.append("id_tipo_seguimiento", $(location).attr('href').split("&")[1].split("=")[1]);
            formData.append("email", email.val());
            formData.append("id_operador", $('input:checked', '#id_operador').val());
            formData.append("proyecto_reportar", proyecto_reportar.val());
            formData.append("id_ie", id_ie.val());
            formData.append("mes_reporte", mes_reporte.val());
            formData.append("semana_reportada", semana_reporte.val());
            formData.append("id_persona_responsable", id_persona_responsable.val());
            formData.append("indicador", indicador.val());
            formData.append("avances_cumplimiento_cuantitativos", avances_cumplimiento_cuantitativos.val());
            formData.append("avances_cumplimiento_cualitativos", avances_cumplimiento_cuantitativos.val());
            formData.append("dificultades", dificultades_indicadores.val());
            formData.append("propuesta_dificultades", propuesta_dificultades.val());
            formData.append("reporte_actividades", JSON.stringify(reporte_actividades));

            var i = 1;
            $('[id*=\'file-upload-\']').each(function(index, value) {
                var fileObj = value.files;
                var files_length = fileObj.length;
                for (var x = 0; x < files_length; x++) {
                    formData.append("files-"+i+"[]", fileObj[x]);
                }
                i++;
            });

            if ($(this).val() === '1'){
                $.ajax({
                    url: "index.php?r=ge-seguimiento-operador%2Fupdate",
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
                            location.reload();
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