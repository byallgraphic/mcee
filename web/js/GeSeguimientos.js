/**********
Versión: 001
Fecha: 27-03-2018
---------------------------------------
Modificaciones:
Fecha: 01-05-2018
Persona encargada: Oscar David Lopez
Cambios realizados: validacion para cuando no tenga sede seleccionada
---------------------------------------
**********/

$( document ).ready(function() {
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
        );

        $(this).val(valueBtn);
        id_objetivo.prop('disabled', true);
    });

    $('#save_form').click(function () {
        var reporte_actividades = [];
        $('.objetivo').each(function( index ) {
            reporte_actividades[index] = {
                id_objetivo: $('#objetivo-'+index+' #id_objetivo').val(),
                id_actividad: $('#objetivo-'+index+' #id_actividad').val(),
                descripcion_actividad: $('#objetivo-'+index+' #descripcion_actividad').val(),
                id_poblacion: $('#objetivo-'+index+' #poblacion_beneficiaria').val(),
                numero_participantes: $('#objetivo-'+index+' #numero_participantes').val(),
                duracion_actividad: $('#objetivo-'+index+' #duracion_actividad').val(),
                logros_alcanzados: $('#objetivo-'+index+' #logros_alcanzados').val(),
                dificultadades: $('#objetivo-'+index+' #dificultadades').val()
            };
        });

        var data = {
            id_tipo_seguimiento: $('#id_tipo_seguimiento').val(),
            email: $('#geseguimientooperador-email').val(),
            id_operador: $('input:checked', '#id_operador').val(),
            proyecto_reportar: $('#geseguimientooperador-proyecto_reportar').val(),
            id_ie: $('#geseguimientooperador-id_ie').val(),
            mes_reporte: $('#geseguimientooperador_mes_reporte_chosen').find('.chosen-results').find('.result-selected').data("option-array-index"),
            semana_reportada: $('#geseguimientooperador-semana_reporte').val(),
            id_persona_responsable: $('#geseguimientooperador-id_persona_responsable').val(),
            id_indicador: $('input:checked', '#geseguimientooperador-id_indicador').val(),
            avances_cumplimiento_cuantitativos: $('#geseguimientooperador-avances_cumplimiento_cuantitativos').val(),
            avances_cumplimiento_cualitativos: $('#geseguimientooperador-avances_cumplimiento_cualitativos').val(),
            dificultades: $('#geseguimientooperador-dificultades').val(),
            propuesta_dificultades: $('#geseguimientooperador-propuesta_dificultades').val(),
            reporte_actividades: reporte_actividades
        };
        $.post( "index.php?r=ge-seguimiento-operador%2Fstore", data );
    })
});