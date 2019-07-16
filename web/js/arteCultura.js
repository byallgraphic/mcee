$( document ).ready(function() 
{

	// se ocultan de entrada
  //justificacion caracterizacion
	$( ".field-cbacplanmisionaloperativo-caracterizacion_no_justificacion" ).toggle();
	

	for(i=1;i<=6;i++)
	{
		$( ".field-cbacpmoactividades-"+i+"-contenido_justificacion" ).toggle();
		
		tiempoPrevisto = $("#cbacpmoactividades-"+i+"-tiempo_previsto");
		
		tiempoPrevisto.timepicker({
            timeFormat: 'H:i',
            step: (5)
        });
		
		tiempoPrevisto.keypress(function(tecla) 
		{
			if(tecla.charCode >= 8) 
				return false;

		});

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
  
  //se elimina el elemento del chosen para evitar que lo selecionen nuevamente
  idSelect = "#"+$(this).attr("id");
  $(""+ idSelect +" option[value='"+idReqTecnicos+"']").remove();
  $(''+idSelect+'').trigger("chosen:updated");
  
  
  
  $("#reqTecnicos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  type="text" size="2" maxlength="2"  style="width:35px;" ></li>');
  
});

$('div[id *= cbacpmoactividades-],[id *= -requerimientos_logoisticos]').change(function(){
  

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
		idSelect = $("#cbacpmoactividades-"+ idActividad +"-requerimientos_logoisticos");
		idSelect.append('<option value="'+ idItem +'">'+nombreItem+'</option>');
		idSelect.trigger("chosen:updated");
	}
	if (infoInput[0] == "requerimientos")
	{
		idSelect = $("#cbacpmoactividades-"+ idActividad +"-requerimientos_tecnicos");
		idSelect.append('<option value="'+ idItem +'">'+nombreItem+'</option>');
		idSelect.trigger("chosen:updated");
	}
	
};
