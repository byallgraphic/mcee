$( document ).ready(function() {
    
	

});

$('#isaseguimientoproceso-fecha').on('change', function() {

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
	}
	
});



// //llenar las fases y el contenido
// $( "#semillerosticdiariodecampo-id_fase" ).change(function() 
// {
	
	// faseO = $( "#semillerosticdiariodecampo-id_fase" ).val();
	// anio = $( "#semillerosticdiariodecampo-anio" ).val();
	// ciclo = $( "#selCiclo" ).val();
	
	// var fase = $( this ).val();

	// if( fase )
	// {
		// // $.get( "index.php?r=semilleros-tic-diario-de-campo/create&idFase="+fase+"&anio="+anio+"&esDocente=0",
			// function( data )
			// {
				// $( "#modalContent" ).html(data);
			// }
		// );
	// }
	
	// return;
	
	 // if(faseO != "" && anio != "" )
	 // {
		 // if(faseO == 1){fase=14; titulo="BITACORA FASE I"; descripcion=17; hallazgo=20;}
		 // else if(faseO == 2){fase = 15; titulo="BITACORA FASE II"; descripcion=18; hallazgo=21;}
		 // else if(faseO == 3){fase = 16; titulo="BITACORA FASE III"; descripcion=19; hallazgo=22;}
		// $.get( "index.php?r=semilleros-tic-diario-de-campo/opciones-ejecucion-diario-campo&idFase="+fase+"&descripcion="+descripcion+"&hallazgo="+hallazgo+"&idAnio="+anio+"&idCiclo="+ciclo+"&faseO="+faseO,
				// function( data )
					// {			
						// // alert(data.contenido+"-"+data.contenido1);
						
								// // if (typeof data.contenido === undefined || typeof data.contenido1 === undefined){
								// if (data.contenido =="" || data.contenido1 ==""){
									
									// swal("Importante", data.mensaje, "info");
									
								// }
								// else{
									// $("#contenido").html(data.contenido);
									// $("#contenido1").html(data.contenido1);
									
									// $("#contenido").show();
									// $("#contenido1").show(); 
									 
								// }
							// $("#encabezado").html(data.html);
							// $("#encabezado1").html(data.html1);
							
							// $("#titulo").show();
							// $("#encabezado").show();
							// $("#encabezado1").show();
							
						
						
						// $("#titulo").html(titulo);
						// $("#descripcion").html(data.descripcion);
						// $("#hallazgos").html(data.hallazgos);
						
															
					// },
			// "json");   
	 // }
	 // else{
		 // $("#titulo").hide(titulo);
		 // $("#encabezado").hide();
		 // $("#contenido").hide();
		 // $("#encabezado1").hide();
		 // $("#contenido1").hide();
		 // $( "#semillerosticdiariodecampo-id_fase" ).val('');
		 
		 // swal("Importante", "Debe seleccionar año y fase", "error");
		 // }
// });

// //llenar los barrios segun la comuna que seleccione
// $( "#selAnio" ).change(function() 
// {
	 // $( "#semillerosticdiariodecampo-id_fase" ).val('');
	 // $("#titulo").hide(titulo);
	 // $("#encabezado").hide();
	 // $("#contenido").hide();
	 // $("#encabezado1").hide();
	 // $("#contenido1").hide();
	
	// anio = $( "#selAnio" ).val();  
	
	// if(anio != "")
	// {
		// $.get( "index.php?r=semilleros-tic-diario-de-campo/llenar-ciclos&idAnio="+anio,
				// function( data )
					// {	
						
						// $('#selCiclo').empty();
						// $('#selCiclo').html(data.html);
						// $('#selCiclo').val(cicloSelected);
					// },
			// "json");   
	// }
	// else{
		// $('#selCiclo').empty();
		// $('#selCiclo').append(
		// $('<option />')
			// .text('Seleccione...')
			// .val('')
		// );
	// }
// });

// $( "#selCiclo" ).change(function() 
// {
	// $( "#semillerosticdiariodecampo-id_fase" ).val('');
	 // $("#titulo").hide(titulo);
	 // $("#encabezado").hide();
	 // $("#contenido").hide();
	 // $("#encabezado1").hide();
	 // $("#contenido1").hide();
// });



