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
    //$('#modal-form').modal('show');


    //Click del boton agregar y cargar contenido del formulario agregar en el modal
    var btnModal = $('#modalButton-ge');
    btnModal.click(function()
    {
        $("#modal-ge").modal('show')
            .find("#modalContent")
            .load($(this).attr('value'));

        btnModal.val(btnModal.val().replace('id=1', 'id=2'))
    });
});