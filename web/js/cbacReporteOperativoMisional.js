
	function habilitarEdicionRegistro( index ){	
	
		//Si se ha seleccionado una actividad y un estado
		var val = 	$( "#isaactividadesrom-"+index+"-sesion_actividad" ).val() != '' 
				 // && $( "#isaactividadesrom-"+index+"-estado_actividad" ).val() != '' 
				 && $( "#isaactividadesrom-"+index+"-estado_actividad" ).val() == '179';
		
		if( val )
			$( "#datos_rom_"+index ).css({display:''})
		else
			$( "#datos_rom_"+index ).css({display:'none'})
	}
	
	
	/************************************************************************************************
	 * Aquí valido los campos que son obligatorios
	 * Para obligar a que sean obligatorios al array messages se le debe agregar el error
	 ************************************************************************************************/
	$( "#modalContent" ).on( 'beforeValidateAttribute', function( evt, attribute, messages ){
		
		var val = false;
		
		//Esto es el id del campo a buscar
		var _target = attribute.id.split( '-' );
		
		//La opción depende del controlador
		var opcion = _target[0];
		
		var campo = _target[2];
		
		var index = _target[1];
		//El formulario tiene varios campos con ids formados como controlador-consecutivo-nombre_campo
		//La condición es que es válido solo si por lo menos un campo es diferente a vacio
		//siempre se valida todos los que empiezan con controlador-consectivo
		_target = _target[0]+'-'+_target[1];
		
		//Si se ha selecciona un encuentro y un estado
		var hayEncuentroEstado = 	$( "#isaactividadesrom-"+index+"-sesion_actividad" ).val() != '' 
								 && $( "#isaactividadesrom-"+index+"-estado_actividad" ).val() == '179';
		
		switch( opcion ){
			
			case 'isaactividadesrom': 
			
				/**
				 * 1-: Si no se ha seleccionado ningun Fecha de realización, ni encuentro ni estado de la actividad
				 *   todo es obligatorio
				 * 2-: Si hay por lo menos una fecha o un encuentro o un estado seleccionado, la actividad rom de su mismo grupo es obligatorio
				 *   Pero las demás no
				 */
				//Solo requiero validar estos campos
				var campos = ['fecha_desde', 'estado_actividad', 'sesion_actividad']
				 
				//Validación 1-:
				var obligatorio = false;
				$( campos ).each(function(){
					var cmp = this;
					$( "[id^=isaactividadesrom][id$="+cmp+"]" ).each(function(){
						if( $.trim( $( this ).val() ) != '' ){
							obligatorio = true;
						}
					});
				});
				
				//2-: No es obligatorio si ninguno del mismo indice está seleccionado
				if( obligatorio )
				{
					if( $.trim( $( "#"+attribute.id ).val() ) == '' )
					{
						var i = campos.length;
						$( campos ).each(function(){
							var cmp = this;
							
							if( $.trim( $( "#isaactividadesrom-"+index+"-"+cmp ).val() ) == '' ){
								i--;
							}
						});
						obligatorio = i == 0 ? false : true;
					}
					else{
						obligatorio = false;
					}
				}
					
					
				if( obligatorio )
					messages.push('No puede estar vacio');
			
			break;
			
			case 'isatipocantidadpoblacionrom': 
			
				if( hayEncuentroEstado ){
			
					$( "[id^="+_target+"]" ).each(function(){
						if( $.trim( $( this ).val() ) != '' && $( this ).val()*1 >= 0 ){
							val = true;
							return false;
						}
					});
					
					if( !val )
						messages.push('Debe ingresar al menos una población');
				}
			
			break;
			
			case 'isaevidenciasrom':
			
				//Si entra por aquí los campos son obligatorios
				if( hayEncuentroEstado ){
					// var campos = ['actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes', 'otros_productos'];
					
					if( $( "#"+attribute.id )[0].files && $( "#"+attribute.id )[0].files.length == 0 ){
						messages.push('Debe subir al menos un archivo');
					}
				}
			
			break
			
			case 'isaactividadesromxintegrantegrupo':
				
				if( hayEncuentroEstado ){
					
					//campos obligatorios
					var campos = ['duracion_sesion', 'logros', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'articulacion', 'evaluacion', 'observaciones_generales', 'alarmas'];
					
					//OJO: se debe validar con !== por que la funcion inArray puede devolver un 0
					if( $.inArray( campo, campos ) !== false ){
						//Si se encuentra en la lista de campos se obliga
						if( $.trim( $( "#"+attribute.id ).val() ) == '' ){
							messages.push('No puede estar vacío');
						}
					}
				}
				
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
					"index.php?r=cbac-reporte-competencias-basicas-ac/eliminar-archivo", 
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
				"index.php?r=cbac-reporte-competencias-basicas-ac/archivos-evidencias", 
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
	{
		
		// openViewFiles( $( this).val() )
	
		$( '[id^=modalArchivosContent]' ).html('')
		// num = $(this).attr('id').split("_")[1];
		
		$( "#modalArchivos" ).modal('show')
				.find("#modalArchivosContent")
				.load( $(this).attr('value') );
	});
	
	
	
	
	$( '#modal' )
		.on( 'change', '[id$=estado_actividad]', function(){ 
			
			var __target = this.id.split( '-' );
			__target = __target[1];
			
			var frep = $( '#isaactividadesromxintegrantegrupo'+'-'+__target+'-fecha_reprogramacion' );
			var jus = $( '#isaactividadesromxintegrantegrupo'+'-'+__target+'-justificacion_activiad_no_realizada' );
			
			if( $(this).val() == 179 )
			{
				frep.attr({disabled:true})
				frep.attr({readonly:true})
				
				jus.attr({readonly:true})
					.val('No Aplica');
			}
			else
			{
				frep.attr({disabled:false});
				frep.attr({readonly:false});
				
				jus.attr({readonly:false})
					.val('')
				
			}
			
			habilitarEdicionRegistro( __target );
		});
		
	$( '#modal' )
		.on( 'change', '[id$=sesion_actividad]', function(){ 
			
			var __target = this.id.split( '-' );
			__target = __target[1];
			
			__self = this;
			
			if( $( __self ).val() == '' )
			{
				$( '#nro_equipo-'+__target ).val( '' )
				$( '#perfiles-'+__target ).val( '' )
				$( '#docente_orientador-'+__target ).val( '' )
			}
			else
			{	
				$.post( 'index.php?r=cbac-reporte-competencias-basicas-ac/consultar-mision', 
						{ 
							rom_actividades	: __target, 
							sesion_actividad: $( __self ).val() ,
							nro_semana		: $( '#isaactividadesrom-'+ __target + '-nro_semana' ).val() ,
						}, 
						function( data ){
							if( data != '' ){
								
								
								$.get( 'index.php?r=cbac-reporte-competencias-basicas-ac/update', 
										{
											id: data ,
										}, 
										function( data ){
											$( '#modalContent' ).html( data );
										}
								);
								
								// $( '#modalContent' ).html( data );
							}
							else{
								
								$.get( 'index.php?r=cbac-reporte-competencias-basicas-ac/consultar-intervencion-ieo', 
										{
											id: $( __self ).val() ,
										}, 
										function( data ){
											console.log( data );
											if( data ){
												if( data.equipo_nombre != '' )
												{
													$( '#nro_equipo-'+__target ).val( data.equipo_nombre );
													$( '.nro_equipo-'+__target ).css({display:''});
												}
												else
												{
													$( '.nro_equipo-'+__target ).css({display:'none'});
												}
												
												$( '#docente_orientador-'+__target ).val( data.docente_orientador )
												$( '#perfiles-'+__target ).val( data.perfiles )
											}
										},
										'json'
								);
								
								habilitarEdicionRegistro( __target );
							}
						}
				);
			}
		});
		
		
	$('#modalArchivos').on('hidden.bs.modal', function (e) {
		$( ".modal" ).css({ 
					overflowX: "hidden", 
					overflowY: "auto",
				});
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