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

//guarda la informacion cuando se de click en el boton
$( "#BtnGuardar" ).click(function() 
{
	_csrf = $("#_csrf").val();
	nombre = $("#isaequiposcampo-nombre").val();
	descripcion =$("#isaequiposcampo-descripcion").val();
	cantidad = $("#isaequiposcampo-cantidad").val();
	integrantes = $("#isaintegrantesxequipo-id").val();
	var parametros = 
	{
		_csrf,
		"IsaEquiposCampo" : 
		{
			'nombre':nombre,
			'descripcion':descripcion,
			'cantidad':cantidad,
			'integrantes':integrantes,
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
			//se llena nuevamente el chosen con la informacion
			
			$.get("index.php?r=isa-equipos-campo/equipos",
			function( data )
			{
				var i;
				for (i = 1; i <= 4; i++) 
				{ 
					equipos = $('#isaintervencionieo-'+i+'-id_equipo_campos');
					equipos.html('');
					equipos.trigger("chosen:updated");
					equipos.append(data);
					equipos.trigger("chosen:updated");
				}
			});
			
		}
	})
});



//cierra el modal en caso de no ser necesario
// $('#BtnCerrar').click(function()
$('.BtnCerrar').click(function()
{
	$('#modalCampo_1').modal('hide');
	$('#modalCampo_2').modal('hide');
	$('#modalCampo_4').modal('hide');
	$('body').removeClass('modal-open');
	$('.modal-backdrop').remove();
	$('body').css( "overflow: auto;");
	
});
	

