$( document ).ready(function() 
{

	// se ocultan de entrada
  //caracterizacion nombre
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_nombre" ).toggle();
	
	//carcterizacion fecha 
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_fecha" ).toggle();
	
	for(i=1;i<=4;i++)
	{
		$( ".field-isaactividadesisa-"+i+"-contenido_nombre" ).toggle();
		$( ".field-isaactividadesisa-"+i+"-contenido_fecha" ).toggle();
	}
   
   
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


$("#isaactividadesisa-1-contenido_si_no").change(function() 
{
	$( ".field-isaactividadesisa-1-contenido_nombre" ).toggle();
	$( ".field-isaactividadesisa-1-contenido_fecha" ).toggle();
	$( ".field-isaactividadesisa-1-contenido_justificacion" ).toggle();
});



$("#isaactividadesisa-2-contenido_si_no").change(function() 
{
	$( ".field-isaactividadesisa-2-contenido_nombre" ).toggle();
	$( ".field-isaactividadesisa-2-contenido_fecha" ).toggle();
	$( ".field-isaactividadesisa-2-contenido_justificacion" ).toggle();
});



$("#isaactividadesisa-4-contenido_si_no").change(function() 
{
	$( ".field-isaactividadesisa-4-contenido_nombre" ).toggle();
	$( ".field-isaactividadesisa-4-contenido_fecha" ).toggle();
	$( ".field-isaactividadesisa-4-contenido_justificacion" ).toggle();
});


