/**********
Versión: 001
Fecha: 10-04-2019
Desarrollador: Oscar David Lopez Villa
Descripción: isa equipos campo
---------------------------------------
Modificaciones:
Fecha: 10-04-2019
Persona encargada: Oscar David Lopez Villa
Cambios realizados: se guarda el formulario mediante ajax para evitar redireccion del formulario
----------------------------------------
**********/

$( "#BtnGuardar" ).click(function() 
{
	_csrf = $("#_csrf").val();
	nombre = $("#isaequiposcampo-nombre").val();
	descripcion =$("#isaequiposcampo-descripcion").val();
	cantidad = $("#isaequiposcampo-cantidad").val();
	var parametros = 
	{
		_csrf,
		"IsaEquiposCampo" : 
		{
			'nombre':nombre,
			'descripcion':descripcion,
			'cantidad':cantidad,
		}
	};
	
	$.ajax(
	{
		type: "POST",
		url: "index.php?r=isa-equipos-campo/create",
		data: parametros,
		success: function() 
		{
			$('#modalCampo').modal('hide');
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
		}
	})
});


//cierra el modal en caso de no ser necesario
$('#BtnCerrar').click(function()
{
	$('#modalCampo').modal('hide');
	$('body').removeClass('modal-open');
	$('.modal-backdrop').remove();
	$('body').css( "overflow: auto;");	
	
});
	

