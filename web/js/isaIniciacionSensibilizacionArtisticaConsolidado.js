	//Click del boton agregar equipo campo y cargar contenido del formulario agregar en el modal
	// $("#modalEquipo").click(function()
	// $(".modalEquipo").click(function()
	$("#modal").on( 'click', '.modalEquipo' , function()
	{
		
		// openViewFiles( $( this).val() )
	
		$( '[id^=modalArchivosContent]' ).html('')
		// num = $(this).attr('id').split("_")[1];
		
		$( "#modalArchivos" ).modal('show')
				.find("#modalArchivosContent")
				.load( $(this).attr('value') );
	});
	
	
	$('#modalArchivos').on('hidden.bs.modal', function (e) {
		$( ".modal" ).css({ 
					overflowX: "hidden", 
					overflowY: "auto",
				});
	});


	$( "#modalContent" ).on( "change", "#isaencabezadoiniciacionartisticaconsolidado-fecha", function(){
		
		// if( $( "#isisainformesemanalisa-desde" ).val() != '' && $( "#isisainformesemanalisa-hasta" ).val() != '' )
		if( $( "#isaencabezadoiniciacionartisticaconsolidado-desde" ).val() != '' )
		{
			$.post( "index.php?r=isa-iniciacion-sensibilizacion-artistica-consolidado/create",
				{
					fecha_desde : $( "#isaencabezadoiniciacionartisticaconsolidado-fecha" ).val(),
				},
				function(data){
					$( "#modalContent" ).html( data );
				}
			);
		}
	});

		
	function actualizar_total_participantes( index ){
		
		var total = 0;
		
		$( "[data-participante="+index+"]" ).each(function(){
			total += this.value*1;
		})
		
		$(  "#"+index+"-total_participantes" ).val( total );
	}
	
	//A todos los que tengan campo participantes se les agrega evento change
	$( "[data-participante]" )
		.each(function(){
			
			//Cada vez que se haga un change se actualiza el total de participantes
			$( this ).change(function(){
				actualizar_total_participantes( $( this ).data('participante') );
			});
		});
	
	$( "[data-participante]" ).each(function(){
		actualizar_total_participantes( $( this ).data('participante') );
	});
	
	function actualizar_porcentaje_sede(){
		
		var total = 0;
		
		$( "[data-porcentaje]" ).each(function(){
			total += $( this ).val()*1;
		});
		
		$( "#total_porcentaje_sede" ).val( total );
	}
	
	function actualizar_porcentaje_ieo(){
		
		var total = 0;
		
		$( "[data-porcentaje]" ).each(function(){
			total += $( this ).val()*1;
		});
		
		$( "#total_porcentaje_ieo" ).val( total );
	}
	
	$( "[data-porcentaje]" ).each(function(){
		
		$( this ).change(function(){
			actualizar_porcentaje_sede();
			actualizar_porcentaje_ieo();
		});
	});
	
	
	function inicilializandoFunciones(){
		
		setTimeout(function(){
			
			//A todos los que tengan campo participantes se les agrega evento change
			$( "[data-participante]" )
				.each(function(){
					
					//Cada vez que se haga un change se actualiza el total de participantes
					$( this ).change(function(){
						actualizar_total_participantes( $( this ).data('participante') );
					});
				});
			
			$( "[data-participante]" ).each(function(){
				actualizar_total_participantes( $( this ).data('participante') );
			});
			
			$( "[data-porcentaje]" ).each(function(){
			
				$( this ).change(function(){
					actualizar_porcentaje_sede();
					actualizar_porcentaje_ieo();
				});
			});
			
			actualizar_porcentaje_sede();
			actualizar_porcentaje_ieo();
			
		}, 1000 );
		
	}
	