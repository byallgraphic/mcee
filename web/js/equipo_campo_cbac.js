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
// $( "BtnGuardar" ).click(function() 
$( ".BtnGuardar" ).click(function() 
{
	_csrf = $("#_csrf").val();
	nombre = $("#cbacequiposcampo-nombre").val();
	descripcion =$("#cbacequiposcampo-descripcion").val();
	integrantes = $("#cbacintegrantesxequipo-id_perfil_persona_institucion").val();
	var parametros = 
	{
		_csrf,
		"CbacEquiposCampo" : 
		{
			'nombre':nombre,
			'descripcion':descripcion,
			'integrantes':integrantes,
		}
	};
	
	$.ajax(
	{
		type: "POST",
		url: "index.php?r=cbac-equipos-campo/crear-equipo",
		data: parametros,
		success: function() 
		{
			//se quita todo del modal de equipos
			// $('#modalCampo_1').modal('hide');
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
			//se llena nuevamente el chosen con la informacion
			
			$.get("index.php?r=cbac-equipos-campo/equipos",
			function( data )
			{
				var i;
				for (i = 1; i <= 6; i++) 
				{ 
					$('#modalCampo_'+i+'').modal('hide');
					equipos = $('#cbacintervencionieo-'+i+'-id_equipo_campos');
					equipos.html('');
					equipos.trigger("chosen:updated");
					equipos.append( JSON.parse(data));
					equipos.trigger("chosen:updated");
				}
			});
			
		}
	})
});


//cierra el modal en caso de no ser necesario
$('.BtnCerrar').click(function()
{
	for (i = 1; i <= 6; i++) 
	{ 
		$('#modalCampo_'+i+'').modal('hide');
		
	}
	$('body').removeClass('modal-open');
	$('.modal-backdrop').remove();
	$('body').css( "overflow: auto;");
	
});
	

