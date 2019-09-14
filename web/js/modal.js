/**********
Versión: 001
Fecha: 09-06-2018
Desarrollador: Andrés Felipe Giraldo
Descripción: js para Docentes
---------------------------------------
**********/

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

