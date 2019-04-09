//Click del boton agregar y cargar contenido del formulario agregar en el modal
$("#modalEquipo").click(function()
{
	$("#modalCampo").modal('show')
	.find("#modalContenido")
	.load($(this).attr('value'));
	return false;
});