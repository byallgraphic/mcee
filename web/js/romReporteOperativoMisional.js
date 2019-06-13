	
	$( "#modalContent" ).on( 'beforeValidateAttribute', function( evt, attribute, messages ){
		
		var val = false;
		
		//Esto es el id del campo a buscar
		var _target = attribute.id.split( '-' );
		
		//La opción depende del controlador
		var opcion = _target[0];
		
		//El formulario tiene varios campos con ids formados como controlador-consecutivo-nombre_campo
		//La condición es que es válido solo si por lo menos un campo es diferente a vacio
		//siempre se valida todos los que empiezan con controlador-consectivo
		_target = _target[0]+'-'+_target[1];
		
		
		switch( opcion ){
			
			case 'isatipocantidadpoblacionrom': 
			
				$( "[id^="+_target+"]" ).each(function(){
					if( $.trim( $( this ).val() ) != '' && $( this ).val()*1 >= 0 ){
						val = true;
						return false;
					}
				});
				
				if( !val )
					messages.push('Debe ingresar al menos una población');
			
			break;
			
			default: break;
		}
	});
	
	function removeFile( cmp, evidencia, campo, archivo ){
		
		Swal.fire({
			title: 'Está seguro de que desea borrar el archivo?',
			text: "Una vez borrado el archivo no podrá recuperarlo",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar',
		}).then((result) => {
			if( result.value )
			{
				$.post(
					"index.php?r=rom-reporte-operativo-misional/eliminar-archivo", 
					{
						id_evidencia	: evidencia,
						campo 			: campo,
						archivo 		: archivo,
					}, 
					function(data){
						
						if( data.resultado == true ){
							
							$( cmp ).parent().parent().css({ display:'none'});
						}
						else{
							Swal.fire({
								title: 'No se logró borrar el archivo',
								text: "Inténtelo de nuevo más tarde",
								type: 'warning',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'OK',
							})
						}
					}, 
					"json" 
				);
			}
		});
	}
	
	function openViewFiles( evidencia ){
		
		$.get(
				"index.php?r=rom-reporte-operativo-misional/archivos-evidencias", 
				{
					id_evidencia	: evidencia,
				}, 
				function(data){
					$( "#modalArchivosContent" ).html( data );
					
					$( "#modalArchivos" ).modal('show')
						.find("#modalArchivosContent")
						.load( $(this).attr('value') );
					
				}, 
				"json" 
			);
	}
	
	//Click del boton agregar equipo campo y cargar contenido del formulario agregar en el modal
	// $("#modalEquipo").click(function()
	// $(".modalEquipo").click(function()
	$("#modal").on( 'click', '.modalEquipo' , function()
	{ console.log( $( this).val() )
		
		// openViewFiles( $( this).val() )
	
		$( '[id^=modalArchivosContent]' ).html('')
		// num = $(this).attr('id').split("_")[1];
		
		$( "#modalArchivos" ).modal('show')
				.find("#modalArchivosContent")
				.load( $(this).attr('value') );
	});
	
	// var timepicker = new TimePicker('duracion_actividad', {
        // lang: 'en',
        // theme: 'dark'
    // });
	
	// var timepicker = new TimePicker('duracion_sesion', {
        // lang: 'en',
        // theme: 'dark'
    // });
	
	// timepicker.on('change', function(evt) {
        // var value = (evt.hour || '00') + ':' + (evt.minute || '00');
        // evt.element.value = value;

    // });