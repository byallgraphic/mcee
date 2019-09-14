$( document ).ready(function() 
{
 
	// se ocultan de entrada
  //caracterizacion caracterizacion_justificacion
	$( ".field-cbaciniciacionsencibilizacionartistica-caracterizacion_justificacion" ).toggle();
	
	for(i=1;i<=4;i++)
	{
		$( ".field-cbacactividadesisa-"+i+"-contenido_justificacion" ).toggle();
		
		tiempoPrevisto = $("#intervencionieo-"+i+"-tiempo_previsto");
		
		tiempoPrevisto.timepicker({
            timeFormat: 'H:i',
            step: (5)
        });
		
		 tiempoPrevisto.keypress(function(tecla) {
        if(tecla.charCode >= 8) return false;
		
    });
	}
 


});

$("#cbaciniciacionsencibilizacionartistica-caracterizacion_si_no").change(function() 
{
	//caracterizacion nombre
	$( ".field-cbaciniciacionsencibilizacionartistica-caracterizacion_nombre" ).toggle();
	
	//carcterizacion fecha 
	$( ".field-cbaciniciacionsencibilizacionartistica-caracterizacion_fecha" ).toggle()
	
	//justificacion caracterizacion
	$( ".field-cbaciniciacionsencibilizacionartistica-caracterizacion_justificacion" ).toggle();
});


$("#cbacactividadesisa-1-contenido_si_no").change(function() 
{
	$( ".field-cbacactividadesisa-1-contenido_nombre" ).toggle();
	$( ".field-cbacactividadesisa-1-contenido_fecha" ).toggle();
	$( ".field-cbacactividadesisa-1-contenido_justificacion" ).toggle();
});



$("#cbacactividadesisa-2-contenido_si_no").change(function() 
{
	$( ".field-cbacactividadesisa-2-contenido_nombre" ).toggle();
	$( ".field-cbacactividadesisa-2-contenido_fecha" ).toggle();
	$( ".field-cbacactividadesisa-2-contenido_justificacion" ).toggle();
});



$("#cbacactividadesisa-4-contenido_si_no").change(function() 
{
	$( ".field-cbacactividadesisa-4-contenido_nombre" ).toggle();
	$( ".field-cbacactividadesisa-4-contenido_fecha" ).toggle();
	$( ".field-cbacactividadesisa-4-contenido_justificacion" ).toggle();
});

//crear los requerimientos tecnicos con el campo de texto para la cantidad
$('div[id *= cbacactividadesisa-],[id *= -requerimientos_tecnicos]').change(function(){
  
  resul = $(this).attr("id").split("-");
  idActividad = resul[1];
  texto = $('option:selected',$(this)).text();
  idReqTecnicos = $(this).val();
  idNombre = "requerimientos[]["+idActividad+"]["+idReqTecnicos+"]";
  
    
  //se elimina el elemento del chosen para evitar que lo selecionen nuevamente
  idSelect = "#"+$(this).attr("id");
  $(""+ idSelect +" option[value='"+idReqTecnicos+"']").remove();
  $(''+idSelect+'').trigger("chosen:updated");
  
  
  $("#reqTecnicos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  type="text" size="2" maxlength="2"  style="width:35px;" ></li>');
  
});

//crear los requerimientos logisticos con el campo de texto para la cantidad
$('div[id *= cbacactividadesisa-],[id *= -requerimientos_logistico]').change(function(){
  
  resul = $(this).attr("id").split("-");
  idActividad = resul[1];
  texto = $('option:selected',$(this)).text();
  idReqLogisticos = $(this).val();
  idNombre = "reqLogisticos[]["+idActividad+"]["+idReqLogisticos+"]";
  
  //se elimina el elemento del chosen para evitar que lo selecionen nuevamente
  idSelect = "#"+$(this).attr("id");
  $(""+ idSelect +" option[value='"+idReqLogisticos+"']").remove();
  $(''+idSelect+'').trigger("chosen:updated");
  
  if(texto == "Transporte")
  {
	$("#reqLogisticos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a> <br>Cantidad &nbsp;&nbsp;&nbsp;<input id="'+idNombre+'" name="'+idNombre+'"  type="text" size="2" maxlength="2"  style="width:35px;" >       <br> Dir.Origen &nbsp;<input id="'+idNombre+'" name="'+idNombre+'"  type="text" size="30" >    <br>Dir.Destino    <input id="'+idNombre+'" name="'+idNombre+'"  type="text" size="30" ></li>');
    
  }
 else
 {
	$("#reqLogisticos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  type="text" size="2" maxlength="2"  style="width:35px;" ></li>');
  
 }
  
 
});


function borrarRequerimiento(obj)
{
	
	$(obj).parent().remove();
	
	idInput = $(obj).siblings("input").attr("id")
	
	infoInput = idInput.split("[");
	idActividad =  infoInput[2].split("]")[0];
	idItem =infoInput[3].split("]")[0] ;
	nombreItem = $(obj).siblings("span").text()

	if (infoInput[0] == "reqLogisticos")
	{
		idSelect = $("#cbacactividadesisa-"+ idActividad +"-requerimientos_logisticos");
		idSelect.append('<option value="'+ idItem +'">'+nombreItem+'</option>');
		idSelect.trigger("chosen:updated");
	}
	if (infoInput[0] == "requerimientos")
	{
		idSelect = $("#cbacactividadesisa-"+ idActividad +"-requerimientos_tecnicos");
		idSelect.append('<option value="'+ idItem +'">'+nombreItem+'</option>');
		idSelect.trigger("chosen:updated");
	}

	
};




