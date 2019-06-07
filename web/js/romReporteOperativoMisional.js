	
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
					if( $( this ).val()*1 > 0 ){
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