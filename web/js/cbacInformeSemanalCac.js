	$( "#modalContent" ).on( "change", "#cbacinformesemanalcac-nro_semana,#cbacinformesemanalcac-desde,#cbacinformesemanalcac-hasta", function(){
		
		// if( $( "#isisainformesemanalisa-desde" ).val() != '' && $( "#isisainformesemanalisa-hasta" ).val() != '' )
		if( $( "#cbacinformesemanalcac-desde" ).val() != '' )
		{
			$.post( "index.php?r=cbac-informe-semanal-cac/create",
				{
					nroSemana 	: $( "#cbacinformesemanalcac-nro_semana" ).val(),
					fecha_desde : $( "#cbacinformesemanalcac-desde" ).val(),
					fecha_hasta : $( "#cbacinformesemanalcac-hasta" ).val(),
				},
				function(data){
					$( "#modalContent" ).html( data );
				}
			);
		}
	})