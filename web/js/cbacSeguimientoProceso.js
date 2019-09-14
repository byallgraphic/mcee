// $( document ).ready(function() {
    
	

// });

$('#cbacseguimientoproceso-fecha').on('change', function() {

	//validar si tiene tiene alguna fecha
	valorFecha = $(this).val();
	if( valorFecha != "" )
	{
		$.get( "index.php?r=cbac-seguimiento-proceso/logros&fecha="+valorFecha,
			function( data )
			{
				// alert(data);
				$.each(jQuery.parseJSON(data), function( nombre, valor ) 
				{
					
					$.each(valor, function( index, datos) 
					{		
							idActividad = datos.id_rom_actividad;
							// se llenan los logros	
							cols = 40;
							rows = 4;
							$('#'+idActividad+'_Logro' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.logros+' </textarea> </div></div>' );
							$('#'+idActividad+'_Alter' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.alternativas+' </textarea> </div></div>' );
							$('#'+idActividad+'_Artic' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.articulacion+' </textarea> </div></div>' );
							$('#'+idActividad+'_Obser' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.observaciones_generales+' </textarea> </div></div>' );
							$('#'+idActividad+'_Alarm' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.alarmas +' </textarea> </div></div>' );
							$('#'+idActividad+'_Forta' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.fortalezas+' </textarea> </div></div>' );
							$('#'+idActividad+'_Debil' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.debilidades+' </textarea> </div></div>' );
							$('#'+idActividad+'_Retos' ).append('<div class="row"><div class="col-md-6"> <label>'+nombre+' - '+ datos.fecha_diligencia+'</label> <textarea rows="4" cols="'+cols+'"> '+ datos.retos+' </textarea> </div></div>' );
						
					});
					
					
				});
			}
		);
		
		$.get( "index.php?r=cbac-seguimiento-proceso/datos-avances&fecha="+valorFecha,
			function( data )
			{
				datos = jQuery.parseJSON(data);
				
				for ( i = 1 ; i<=4; i++)
				{
					$('#cbacporcentajesactividades-'+i+'-total_sesiones').val("");
					$('#cbacporcentajesactividades-'+i+'-avance_sede').val("");
					$('#cbacporcentajesactividades-'+i+'-avance_ieo').val("");
					
					$('#cbacporcentajesactividades-'+i+'-total_sesiones').val(datos[0]);
					$('#cbacporcentajesactividades-'+i+'-avance_sede').val(datos[1]+"%");
					$('#cbacporcentajesactividades-'+i+'-avance_ieo').val(datos[2]+"%");
				}
				
			}
		);
		
	}
	
});







