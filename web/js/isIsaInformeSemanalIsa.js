	$( "#modalContent" ).on( "change", "#isisainformesemanalisa-nro_semana", function(){
		
		$.post( "index.php?r=is-isa-informe-semanal-isa/create",
			{
				nroSemana : $( this ).val(),
			},
			function(data){
				$( "#modalContent" ).html( data );
			}
		);
	})