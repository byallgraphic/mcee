/**********
Versión: 001
Fecha: 07-06-2018
Desarrollador: Viviana Rodas
Descripción: js para sobreescribir la funcion confirm que trae yii por confirm con la libreria bootbox
---------------------------------------
*/
	
	// --- Delete action (bootbox) ---
yii.confirm = function (message, ok, cancel) {

    bootbox.confirm(
        {
            message: message,
            buttons: {
                confirm: {
                    label: "Confirmar"
                },
                cancel: {
                    label: "Cancelar"
                }
            },
            callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            }
        }
    );
    // confirm will always return false on the first call
    // to cancel click handler
    return false;
}

//Click del boton agregar y cargar contenido del formulario agregar en el modal
$("#modalButton").click(function()
{
    $("#modal").modal('show')
        .find("#modalContent")
        .load($(this).attr('value'));

});

//Click del boton detalle y editar y cargar contenido del formulario agregar en el modal
$("[name='detalle'],[name='actualizar']").click(function(e)
{
	e.preventDefault() 
	$("#modal").modal('show')
	.find("#modalContent")
	.load($(this).attr('value'));
	
});



