$( document ).ready(function() 
{

	// se ocultan de entrada
  //caracterizacion caracterizacion_justificacion
	$( ".field-isainiciacionsencibilizacionartistica-caracterizacion_justificacion" ).toggle();
	
	for(i=1;i<=4;i++)
	{
		$( ".field-isaactividadesisa-"+i+"-contenido_justificacion" ).toggle();
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


$('div[id *= isaactividadesisa-],[id *= -requerimientos_tecnicos]').change(function(){
  
  resul = $(this).attr("id").split("-");
  idActividad = resul[1];
  texto = $('option:selected',$(this)).text();
  idReqTecnicos = $(this).val();
  // idNombre = "requerimiento_"+idActividad+"_"+idReqTecnicos;
  idNombre = "requerimientos[]["+idActividad+"]["+idReqTecnicos+"]";
  
  $("#reqTecnicos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  type="number" size="2" maxlength="2" min="0" style="width:10%;" ></li>');
  
});


function borrarRequerimiento(obj)
{
	$(obj).parent().remove();	
};


