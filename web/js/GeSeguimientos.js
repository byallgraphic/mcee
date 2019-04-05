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


    $('#id_operador input').on('change', function() {
        if ($(this).val() === '144'){
            $("#id_cual").show();
        }else{
            $("#id_cual").hide();
        }
    });

    $( "#btnAgregarObj" ).click(function(){
        var id_objetivo = $("#id_objetivo");

        id_objetivo.after(id_objetivo.clone());
        id_objetivo.prop('disabled', true);
    });

    $( "#btnAgregarAct" ).click(function(){
        var id_actividad = $("#id_actividad");

        id_actividad.after(id_actividad.clone());
        id_actividad.prop('disabled', true);
    });
});