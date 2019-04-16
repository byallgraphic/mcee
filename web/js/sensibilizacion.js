$( document ).ready(function() 
{
	
	// se ocultan de entrada
  //caracterizacion nombre
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_nombre" ).toggle();
	
	//carcterizacion fecha 
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_fecha" ).toggle()
	
	//justificacion caracterizacion
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_justificacion" ).toggle();
   
});


//Click del boton agregar y cargar contenido del formulario agregar en el modal
$("#modalEquipo").click(function()
{
	$("#modalCampo").modal('show')
	.find("#modalContenido")
	.load($(this).attr('value'));
});


$("#isainiciacionsencibilizacionartistica-caracterizacion_si_no").change(function() 
{
	//caracterizacion nombre
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_nombre" ).toggle();
	
	//carcterizacion fecha 
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_fecha" ).toggle()
	
	//justificacion caracterizacion
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_justificacion" ).toggle();
});
