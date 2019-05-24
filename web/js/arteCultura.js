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


//crear los requerimientos tecnicos con el campo de texto para la cantidad
$('div[id *= cbacpmoactividades-],[id *= -requerimientos_tecnicos]').change(function(){
  resul = $(this).attr("id").split("-");
  idActividad = resul[1];
  texto = $('option:selected',$(this)).text();
  idReqTecnicos = $(this).val();
  idNombre = "requerimientos[]["+idActividad+"]["+idReqTecnicos+"]";
  
  $("#reqTecnicos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  type="text" size="2" maxlength="2"  style="width:35px;" ></li>');
  
});

//crear los requerimientos tecnicos con el campo de texto para la cantidad
$('div[id *= cbacpmoactividades-],[id *= -requerimientos_logoisticos]').change(function(){
  
  resul = $(this).attr("id").split("-");
  idActividad = resul[1];
  texto = $('option:selected',$(this)).text();
  idReqLogisticos = $(this).val();
  idNombre = "reqLogisticos[]["+idActividad+"]["+idReqLogisticos+"]";
  
  $("#reqLogisticos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  type="text" size="2" maxlength="2"  style="width:35px;" ></li>');
  
});

