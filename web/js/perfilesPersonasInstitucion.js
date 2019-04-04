/**********
Versión: 001
---------------------------------------
Modificaciones:
Fecha: 03-04-2019
Persona encargada: Oscar David Lopez
Cambios realizados: se llenan los combos de sede cuando institucion cambia
					se llenan los nombre de las personas cuando perfil cambia
					Mostrar los datos en el editar
---------------------------------------
**********/


$( document ).ready(function() 
{
	
	//llenar los datos cuando se edita
	idPerfil = $( "#hidPerfilSelected" ).val();
	$( "#perfiles-id" ).val(idPerfil);
	$( "#perfiles-id" ).trigger("chosen:updated");
	
	perfil = $( "#perfiles-id");
	perfil.trigger("change");
	
	institucion = $( "#perfilespersonasinstitucion-id_institucion" );
	institucion.trigger("change");

	
	setTimeout(function()
	{ 
		sedeSelected = $("#hidSedeSelected").val();
		if(sedeSelected != "")
		{
			sede = $( "#perfilespersonasinstitucion-id_sede" );
			sede.val($("#hidSedeSelected").val());
			sede.trigger("chosen:updated");
		}
		
		persona = $( "#perfilespersonasinstitucion-id_perfiles_x_persona" );
		persona.val($("#hidPerfilesPersonasSelected").val());
		persona.trigger("chosen:updated");
		
	}, 800);
	
});


$( "#perfilespersonasinstitucion-id_institucion" ).change(function() 
{
	sede = $( "#perfilespersonasinstitucion-id_sede" );
	sede.empty();
	sede.trigger("chosen:updated");
	idInstitucion = $( "#perfilespersonasinstitucion-id_institucion" ).val();
	$.get( "index.php?r=perfiles-personas-institucion/sedes&idInstitucion="+idInstitucion,
			function( data )
			{
				sede.append(data);
				sede.trigger("chosen:updated");
			},
		"json");
	
});


$( "#perfiles-id" ).change(function() 
{
	persona = $( "#perfilespersonasinstitucion-id_perfiles_x_persona" );
	persona.empty();
	persona.trigger("chosen:updated");
	idPerfil= $( "#perfiles-id" ).val();
	$.get( "index.php?r=perfiles-personas-institucion/persona&idPerfil="+idPerfil,
			function( data )
			{
				persona.append(data);
				persona.trigger("chosen:updated");
			},
		"json");
	
});