	$( "#modalContent" ).on( "change", "#isisainformesemanalisa-nro_semana,#isisainformesemanalisa-desde,#isisainformesemanalisa-hasta", function(){
		
		if( $( "#isisainformesemanalisa-desde" ).val() != '' && $( "#isisainformesemanalisa-hasta" ).val() != '' )
		{
			$.post( "index.php?r=is-isa-informe-semanal-isa/create",
				{
					nroSemana 	: $( "#isisainformesemanalisa-nro_semana" ).val(),
					fecha_desde : $( "#isisainformesemanalisa-desde" ).val(),
					fecha_hasta : $( "#isisainformesemanalisa-hasta" ).val(),
				},
				function(data){
					$( "#modalContent" ).html( data );
				}
			);
		}
	})