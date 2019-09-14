// $( document ).ready(function() {
    
	

// });

$('#isaconsolidadomisional-fecha').on('change', function() {

	//validar si tiene tiene alguna fecha
	valorFecha = $(this).val();
	if( valorFecha != "" )
	{
		$.get( "index.php?r=isa-seguimiento-proceso/logros&fecha="+valorFecha,
			function( data )
			{
				// alert(data);
				$.each(jQuery.parseJSON(data), function( nombre, valor ) 
				{
					
					$.each(valor, function( index, datos) 
					{		
							// idActividad = datos.id_rom_actividad;
							
							//se reemplazan los id de la tabla id_rom_actividad que proviene de la consulta con los de acuerdo 
							//a los id de la tabla IsaActividadesConsolidadoMisional
							if (datos.id_rom_actividad = 1)
								idActividad = 2;
							if (datos.id_rom_actividad = 2)
								idActividad = 3;
							if (datos.id_rom_actividad = 4)
								idActividad = 6;
							
							// se llenan los logros	
							cols = 30;
							rows = 4;
							$('#'+idActividad+'_Logro' ).append('<div class="row"><div > Logros <label> '+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.logros+' </textarea> </div></div>' );
							
							// $('#'+idActividad+'_Alter' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.alternativas+' </textarea> </div></div>' );
							// $('#'+idActividad+'_Artic' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.articulacion+' </textarea> </div></div>' );
							// $('#'+idActividad+'_Obser' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.observaciones_generales+' </textarea> </div></div>' );
							
							
							$('#'+idActividad+'_Alarm' ).append('<div class="row"><div> Alarmas <label> '+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.alarmas +' </textarea> </div></div>' );
							$('#'+idActividad+'_Forta' ).append('<div class="row"><div> Fortalezas <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.fortalezas+' </textarea> </div></div>' );
							$('#'+idActividad+'_Debil' ).append('<div class="row"><div> Debilidades <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.debilidades+' </textarea> </div></div>' );
							$('#'+idActividad+'_Retos' ).append('<div class="row"><div> Retos <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.retos+' </textarea> </div></div>' );
						
					});
					
					
				});
			}
		);
		

		
	}
	
});







