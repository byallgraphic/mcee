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
			//se quita todo del modal de equipos
			$('#modalCampo').modal('hide');
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
			
			equipos = $('#isaactividadesisa-1-num_equipo_campo');
			$.get(
					"index.php?r=isa-equipos-campo/docentes-por-institucion",
				{
					institucion:	institucion.val(),
				},
				function( data )
				{
					equipos.html('');
					equipos.val('');
					equipos.trigger("chosen:updated");
					
				},
			);
			
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
	

