$( document ).ready(function() 
{

	// se ocultan de entrada
  //justificacion caracterizacion
	$( ".field-cbacplanmisionaloperativo-caracterizacion_no_justificacion" ).toggle();
	

	for(i=1;i<=6;i++)
	{
		$( ".field-cbacpmoactividades-"+i+"-contenido_justificacion" ).toggle();
		
	}
   
});


//caracterización general
$("#cbacplanmisionaloperativo-caracterizacion_diagnostico").change(function() 
{
	//caracterizacion nombre
	$( ".field-cbacplanmisionaloperativo-nombre_caracterizacion" ).toggle();
	
	//carcterizacion fecha 
	$( ".field-cbacplanmisionaloperativo-fecha_caracterizacion_" ).toggle()
	
	//justificacion caracterizacion
	$( ".field-cbacplanmisionaloperativo-caracterizacion_no_justificacion" ).toggle();
});



$('div[id *= cbacpmoactividades-],[id *= -contenido_si_no]').change(function(){
	
	resul = $(this).attr("id").split("-");
	idActividad = resul[1];
	
	$(".field-cbacpmoactividades-"+idActividad+"-contenido_nombre" ).toggle();
	$(".field-cbacpmoactividades-"+idActividad+"-contenido_fecha" ).toggle();
	$(".field-cbacpmoactividades-"+idActividad+"-contenido_justificacion" ).toggle();

});

$('div[id *= isaactividadesisa-],[id *= -requerimientos_tecnicos]').change(function(){
  
  // console.log('El texto seleccionado es:', $('option:selected',$(this)).text());
  resul = $(this).attr("id").split("-");
  idActividad = resul[1];
  texto = $('option:selected',$(this)).text();
  idReqTecnicos = $(this).val();
  // idNombre = "requerimiento_"+idActividad+"_"+idReqTecnicos;
  idNombre = "requerimientos[]["+idActividad+"]["+idReqTecnicos+"]";
  
  $("#reqTecnicos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  type="number" size="2" maxlength="2" min="0" style="width:10%;" ></li>');
  
});


