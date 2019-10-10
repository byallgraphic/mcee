/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE II
---------------------------------------
Modificaciones:
Fecha: 2019-02-05
Descripción: Se desagregan los campos Profesional A y docentes de cada sesión con respecto a a la conformación de los semilleros
---------------------------------------
Fecha: 2018-09-18
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin Textarea, para poderlos editar
---------------------------------------
**********/

$( document ).ready(function(){
	
	$( "#datosieoprofesional-id_profesional_a" ).chosen({
			"no_results_text"			:"Sin resultados",
		});
	
	
	
	var intervalo2 = undefined;
		
	$( "#datosieoprofesional-id_profesional_a" ).on( 'chosen:showing_dropdown', function(){ 
		$( "div", $( "#datosieoprofesional-id_profesional_a" ).parent() ).removeClass( 'chosen-container-single-nosearch' );
		$( "div input", $( "#datosieoprofesional-id_profesional_a" ).parent() ).attr({readOnly:false});
		
	})

	$( "div input", $( "#datosieoprofesional-id_profesional_a" ).parent() ).on( 'keyup', function(e){ 

		var slOriginal = $( "#datosieoprofesional-id_profesional_a" );

		var search = $( this );
		var value_search = search.val();

		if( value_search.length >= 3  && e.which == 13 )
		{
			clearTimeout( intervalo2 );
			intervalo2 = setTimeout( function(){
								$( "option:not(:selected)", slOriginal ).remove();
								search.attr({readOnly:true});
								
								clearTimeout( intervalo2 );
								
								$.get( "index?r=semilleros-datos-ieo/consultar-docentes&search="+value_search, function( data ) {
									
									
									for( var x in data ){
										slOriginal.append( "<option value='"+x+"'>"+data[x]+"</option>" );
									}
									
									slOriginal.trigger( 'chosen:updated' );
									search.val( value_search );
									search.css({readOnly:false});
									
								}, 'json' );
							}, 1000 );
		}
	}); 
	
})


	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitles = [
		// "Nombre de docentes participantes",
		"Nombre de las asignaturas que enseña",
		// "Especialidad de la Media Técnica o Técnica",
		"Número de Apps 0.0 desarrolladas e implementadas",
		"Nombre de las aplicaciones desarrolladas",
		"Nombre de las aplicaciones creadas",
		"Número",
		"Tipo de obras",
		"Indice de temas escolares disciplinares abordados a través de las App 0.0",
		"Numero de pruebas realizadas a la aplicación",
		"Número de disecciones realizadas a la aplicación",
		"Tipo de competencias inferencias y comprometidas en el proceso de creación de la App 0.0",
		"OBSERVACIONES GENERALES",
	];
	
	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitles2 = [
		"Tipo de Acción",
		"Descripción",
		"Responsable de la ejecución de la Acción",
		"Tiempo de desarrollo de las aplicaciones (Horas reloj)",
	];
	
	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitles3 = [
		"TIC (infraestructura existente en la IEO)",
		"Tipo de Uso del Recurso",
		"Digitales",
		"Tipo de Uso del Recurso",
		"Escolares (No TIC)",
		"Tipo de Uso del Recurso",
		"Tiempo de uso de los recursos TIC en el diseño de las App 0.0 (Horas reloj)",
	];
	
	
	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitlesCondicionesInstitucionales = [
		"Por parte de la IEO",
		"Por parte de UNIVALLE",
		"Por parte de la SEM",
		"OTRO",
		"Número de Sesiones por docentes participante",
		"Total sesiones por IEO",
		"Total Docentes participantes por IEO",
	];
	
	
	function totalSesiones(){
		
		//Si hay un cambio en participación docentes se debe actualizar sesiones por docentes en condiciones institucionales
		//Save es el evento que genera el plugin editable al cambiar un dato
		var total = $( "[id^=dvFilaSesion]" ).length;
		
		$( "#condicionesinstitucionales-total_sesiones_ieo" ).val( total );
	}
	
	// //Si hay un cambio en participación docentes se debe actualizar sesiones por docentes en condiciones institucionales
	$( "[id$=docentes]" ).on( "change", function(e, params){
		
		var docentes = [];
		
		$( "option:selected", $( "[id$=docentes]" ) ).each(function(){
			
			var doc = $( this ).text().split( " - " );
			
			for( var x in doc ){
				
				if( $.inArray( doc[x], docentes ) === -1 ){
					docentes.push( doc[x] );
				}
			}
		});
		
		$( "#condicionesinstitucionales-total_docentes_ieo" ).val( docentes.length );
	});
	
	//Calcula el total de apps desarrolladas para las condiciones institucionales
	$( "[id$=numero_apps_desarrolladas]" ).on( "save", function(e, params) {
		
		var _self = this;
		var total = params.newValue*1;
				
		$( "[id$=numero_apps_desarrolladas]" ).each(function(){
			if( _self != this )
			{
				total += this.value*1;
			}
		});
		
		$( "#condicionesinstitucionales-total_apps" ).val( total );
	});
	
	$( "#collapseOne textarea[id^=semillerosticejecucionfaseii]" ).each(function(x){
	
		$( this )
			.attr({readOnly: true })
			.css({resize: 'none' })
			.editable({
				title: 'Ingrese la informoción',
				title: arrayTitles[x%arrayTitles.length],
				rows: 10,
				emptytext: '',
			});
	});
	
	$( "#condiciones-institucionales textarea" ).each(function(x){
	
		$( this )
			.attr({readOnly: true })
			.css({resize: 'none' })
			.editable({
				title: 'Ingrese la informoción',
				title: arrayTitlesCondicionesInstitucionales[x],
				rows: 10,
				emptytext: '',
			});
	});
	
	$( "#datosieoprofesional-id_profesional_a" ).change(function(){
		
		$( "#guardar" ).val( 0 );
		this.form.submit();
	});
	
	//Creo un array con las primeras posiciones de cada sesion
	//Esto se hace para que al hacer submit no aparezcan los datos vacios
	//Y se pueda clonar más fácil las filas
	dvsFilas = [];
	$(".panel-body").each(function(x){
		
		var id = $( "[id^=dvFilaSesion]", this ).eq(0)[0].id.substr( "dvFilaSesion".length );
		
		dvsFilas[id] = $( "[id^=dvFilaSesion]", this ).eq(0);
		$( "[id^=dvFilaSesion]", this ).eq(0).remove();
	});
	
	
	consecutivos = [];
	$( '[id^=dvSesion]' ).each(function(x){
		
		var pos = this.id.substr( "dvSesion".length );
		
		consecutivos[pos] = {
			inicial : $( "[id^=dvFilaSesion]", this ).length+1,
			actual  : $( "[id^=dvFilaSesion]", this ).length+1,
		} 
	});
	
	/************************************************************************************************************************************************
	 * Validando datos extras
	 ************************************************************************************************************************************************/
	 setTimeout(function(){
		 
		$( "#btnAddSession" ).click(function(){
		
			var index = $( "#collapseOne > div" ).length;
		
			$.get( "index.php?r=ejecucion-fase-ii/add-session-item&index="+index , function( data ){
				
				index++;
				
				$( "#collapseOne" ).append( data );
				
				var id = $( "[id^=btnAddFila]", $( "#collapseOne > div" ) ).last()[0].id.substr( "btnAddFila".length );
				
				
				$( ".panel-body", $( "#collapseOne-collapse"+index ) ).each(function(x){
		
					dvsFilas[ $( "[id^=dvFilaSesion]", this ).eq(0)[0].id.substr( "dvFilaSesion".length ) ] = $( "[id^=dvFilaSesion]", this ).eq(0);
					$( ".chosen-container", this ).remove();
					$( "[id^=dvFilaSesion]", this ).eq(0).remove();
				});
				
				consecutivos[id] = {
					inicial : $( "[id^=dvFilaSesion]", this ).length+1,
					actual  : $( "[id^=dvFilaSesion]", this ).length+1,
				} 
				
				$( "input:text[id^=datossesiones]", $( "#collapseOne-collapse"+index ) ).each(function(){
					
					var _campo = this;
					
					$( "#w0" ).yiiActiveForm( 'add', 
								{
									"id"		: _campo.id,
									"name"		: _campo.name,
									"container"	: ".field-"+_campo.id,
									"input"		: "#"+_campo.id,
								},
							);
				});
				
				$( "[id$=fecha_sesion]", $( "#collapseOne-collapse"+index ) ).parent().datepicker({"autoclose":true,"format":"dd-mm-yyyy","language":"es"});
				
				$( "input:text[id^=datossesiones]", $( "#collapseOne-collapse"+index ) ).each(fncValidaciones);
				
				$( ".row-data-2", $( "#collapseOne-collapse"+index ) ).each(cccc);
				$( ".row-data-3", $( "#collapseOne-collapse"+index ) ).each(dddd);
				
				$( "[id^=btnAddFila]", $( "#collapseOne > div" ) ).last().click(aaaa);
				$( "[id^=btnRemoveFila]", $( "#collapseOne > div" ) ).last().click(bbbb);
			});
		})
		 
		 
		$( "input:text[id^=datossesiones]" ).each(fncValidaciones=function(x){
			
			$('#w0').yiiActiveForm('find', this.id ).validate = function (attribute, value, messages, deferred, $form) {
				
				var cmp = $( "#"+this.id ).val();
				
				//Valido que todos los campos esten llenos
				var sinCampoVacios = true;
				var hayCamposDiligenciados = false;
				$( "textarea[id^=semillerosticaccionesrecursosfaseii]", $( this.container ).parent() ).each(function(){
					if( $( this ).val() == '' ){
						sinCampoVacios = false;
					}
					else{
						hayCamposDiligenciados = true;
					}
				})
				
				$( "textarea[id^=semillerosticejecucionfaseii]", $( this.container ).parent() ).each(function(){
					if( $( this ).val() == '' ){
						sinCampoVacios = false;
					}
					else{
						hayCamposDiligenciados = true;
					}
				});
				
				//Si no se ha ingresado fecha y mas de una fila (ejecucion de fase)
				if( cmp == "" && $( "[id^=dvFilaSesion]", $( this.container ).parent() ).length == 0 && !hayCamposDiligenciados ){
					return true;
				}
				else if( cmp != "" && $( "[id^=dvFilaSesion]", $( this.container ).parent() ).length > 0 && sinCampoVacios ){
					return true;
				}
				else{
					if( cmp == "" )
						yii.validation.required(cmp, messages, {"message":"Fecha de la Sesión no puede ser vacío"});
					else if( hayCamposDiligenciados )
						yii.validation.addMessage(messages,"Debe agregar por lo menos una ejecución de fase y diligenciar todos los campos", cmp );
					else
						yii.validation.addMessage(messages,"Debe agregar por lo menos una ejecución de fase y diligenciar todos los campos", cmp );
					 
					return false;
				}
			}
		});
	 
	 
		var intervalo2 = undefined;
	 
		$( "[id^=semillerosticejecucionfaseii][id$=docentes]" ).on( 'chosen:showing_dropdown', function(){ 
			$( "div", $( "[id^=semillerosticejecucionfaseii][id$=docentes]" ).parent() ).removeClass( 'chosen-container-single-nosearch' );
			$( "div input", $( "[id^=semillerosticejecucionfaseii][id$=docentes]" ).parent() ).attr({readOnly:false});
			
		})

		$( "div input", $( "[id^=semillerosticejecucionfaseii][id$=docentes]" ).parent() ).on( 'keyup', function(e){ 

			var slOriginal = $( "[id^=semillerosticejecucionfaseii][id$=docentes]" );

			var search = $( this );
			var value_search = search.val();

			if( value_search.length >= 3  && e.which == 13 )
			{
				clearTimeout( intervalo2 );
				intervalo2 = setTimeout( function(){
									$( "option:not(:selected)", slOriginal ).remove();
									search.attr({readOnly:true});
									
									clearTimeout( intervalo2 );
									
									$.get( "index?r=semilleros-datos-ieo/consultar-docentes&search="+value_search, function( data ) {
										
										
										for( var x in data ){
											slOriginal.append( "<option value='"+x+"'>"+data[x]+"</option>" );
										}
										
										slOriginal.trigger( 'chosen:updated' );
										search.val( value_search );
										search.css({readOnly:false});
										
									}, 'json' );
								}, 1000 );
			}
		}); 
	 
	 
	 
	 
	 
	 
	 
	 
	 }, 500 );
	
	//Cuando se abre un acordeon se ponen todos los elementos del encabezado del mismo tamaño
	$('#collapseOne').on('shown.bs.collapse', function(){
		
		//this para este caso es el panel al que se dió click
		$( ".title, .title2, .title3", this ).each(function(){
			
			//Para este caso this es el div con clase .title
			var alto = $( this ).prop("scrollHeight");
			
			//pongo el span del tamaño requerido
			$( "span", this ).each(function(){
				//this es el span
				$( this ).css({ height: alto });
			});
		});
		
	});
	
	//Se agrega editables para los campos textarea de condiciones institucionales
	$( "#condiciones-institucionales textarea" ).each(function(x){
	
		$( this )
			.attr({readOnly: true })
			.css({resize: 'none' })
			.editable({
				// title: 'Ingrese la informoción',
				title: arrayTitlesCondicionesInstitucionales[x],
				rows: 10,
				emptytext: '',
			});
	});
	
	//Se agrega editables para los campos textarea de condiciones institucionales
	$( ".row-data-2" ).each(cccc=function(){
		
		var inputFechaDataSesion = $( "input[id^=datossesiones]:text", $( this ).parent().parent() );
		
		$( "textarea", this ).each(function(x){
	
			var _campo = this;
	
			$( _campo )
				.attr({readOnly: true })
				.css({resize: 'none' })
				.editable({
					// title: 'Ingrese la informoción',
					title: arrayTitles2[x],
					rows: 10,
					emptytext: '',
				});
				
			setTimeout(function(){
				$( "#w0" ).yiiActiveForm( 'add', 
						{
							"id"		: _campo.id,
							"name"		: _campo.name,
							// "container"	: ".field-"+_campo.id,
							"input"		: "#"+_campo.id,
							"validate"	: function (attribute, value, messages, deferred, $form) {
											if( inputFechaDataSesion.val() != '' )
												yii.validation.required(value, messages, {"message":"No puede estar vacío"});
											else
											return true;
										}
						},
					);
			}, 500 );
		})
	});
	
	//Se agrega editables para los campos textarea de condiciones institucionales
	$( ".row-data-3" ).each(dddd=function(){
	
		var inputFechaDataSesion = $( "input[id^=datossesiones]:text", $( this ).parent().parent() );
	
		$( "textarea", this ).each(function(x){
			
			var _campo = this;
			
			$( _campo )
				.attr({readOnly: true })
				.css({resize: 'none' })
				.editable({
					// title: 'Ingrese la informoción',
					title: arrayTitles3[x],
					rows: 10,
					emptytext: '',
				});
				
			setTimeout(function(){
				$( "#w0" ).yiiActiveForm( 'add', 
						{
							"id"		: _campo.id,
							"name"		: _campo.name,
							// "container"	: ".field-"+_campo.id,
							"input"		: "#"+_campo.id,
							"validate"	: function (attribute, value, messages, deferred, $form) {
											if( inputFechaDataSesion.val() != '' )
												yii.validation.required(value, messages, {"message":"No puede estar vacío"});
											else
											return true;
										}
						},
					);
			}, 500 );
		});
	});
	
	$( "[id^=btnAddFila]" ).each(function(){
		
		$( this ).click(aaaa=function(){
		try{
			
		
			var id = this.id.substr( "btnAddFila".length );
			
			
			// var filaNueva = $( "#dvFilaSesion"+id ).clone();
			var filaNueva = dvsFilas[id].clone();
			$( "#dvSesion"+id ).append( filaNueva );
			
			
			var consecutivo = consecutivos[id].actual;
			
			//Cambiando los id de los textarea con el consecutivo correspondiente
			$( "select,textarea,input:hidden", filaNueva ).each(function(x){
				
				var _campo = this;
				// alert( _campo.name );
				// alert( _campo.name.substr( 0, _campo.name.indexOf( '[', "semillerosticejecucionfaseii-".length )+1 )+consecutivo+_campo.name.substr( _campo.name.lastIndexOf( "[" )-1 ) );
				// $( _campo ).prop({
					// id	: _campo.id.substr( 0, _campo.id.indexOf( '-', "semillerosticejecucionfaseii-".length )+1 )+consecutivo+_campo.id.substr( _campo.id.lastIndexOf( "-" ) ),
					// name: _campo.name.substr( 0, _campo.name.indexOf( '[', "semillerosticejecucionfaseii-".length )+1 )+consecutivo+_campo.name.substr( _campo.name.lastIndexOf( "[" )-1 ),
				// });
				
				$( _campo ).prop({
						id		: _campo.id.replace( /-[0-9]+-[0-9]+-/gi, "-"+id+"-"+consecutivo+"-" ),
						name	: _campo.name.replace( /\[[0-9]+\]\[[0-9]+\]/gi, "["+id+"]["+consecutivo+"]" ),
					});
				
				
				$( _campo ).parent()
						// .removeClass( "field-"+this.id.replace( /-[0-9]+-[0-9]+-/gi, "-"+sesion+"-0-" ) )
						.addClass( "field-"+this.id );
					
				//Si el campo es diferente a id se valida qué este lleno, caso contrario no se obliga
				if( _campo.id.substr( -2 ) != 'id' )
				{
					$( "#w0" ).yiiActiveForm( 'add', 
							{
								"id"		: _campo.id,
								"name"		: _campo.name,
								"container"	: ".field-"+_campo.id,
								"input"		: "#"+_campo.id,
								"validate"	: function (attribute, value, messages, deferred, $form) {
												yii.validation.required(value, messages, {"message":"No puede estar vacío"});
											}
							},
						);
				}
				else
				{
					$( "#w0" ).yiiActiveForm( 'add', 
							{
								"id"		: _campo.id,
								"name"		: _campo.name,
								"container"	: ".field-"+_campo.id,
								"input"		: "#"+_campo.id,
								"validate"	: function (attribute, value, messages, deferred, $form) {
												return true;
											}
							},
						);
				}
			})

			$( "select", filaNueva ).each(function(x){
				
				var __self = this;
				
				$( this ).chosen({
							"search_contains"			:true,
							"single_backstroke_delete"	:false,
							"disable_search_threshold"	:5,
							"placeholder_text_single"	:"Select an option",
							"placeholder_text_multiple"	:"Seleccione",
							"no_results_text"			:"No results match",
						});
						
						
				var intervalo2 = undefined;
		
				$( __self ).on( 'chosen:showing_dropdown', function(){ 
					$( "div", $( __self ).parent() ).removeClass( 'chosen-container-single-nosearch' );
					$( "div input", $( __self ).parent() ).attr({readOnly:false});
					
				})

				$( "div input", $( __self ).parent() ).on( 'keyup', function(e){ 

					var slOriginal = $( __self );

					var search = $( this );
					var value_search = search.val();

					if( value_search.length >= 3 && e.which == 13 )
					{
						clearTimeout( intervalo2 );
						intervalo2 = setTimeout( function(){
											$( "option:not(:selected)", slOriginal ).remove();
											search.attr({readOnly:true});
											
											clearTimeout( intervalo2 );
											
											$.get( "index?r=semilleros-datos-ieo/consultar-docentes&search="+value_search, function( data ) {
												
												
												for( var x in data ){
													slOriginal.append( "<option value='"+x+"'>"+data[x]+"</option>" );
												}
												
												slOriginal.trigger( 'chosen:updated' );
												search.val( value_search );
												search.css({readOnly:false});
												
											}, 'json' );
										}, 1000 );
					}
				}); 
			});
			
			
			filaNueva.css({ display: '' });
			$( "textarea", filaNueva ).each(function(x){
		
				$( this )
					.attr({
						readOnly: true,
						class: 'form-control',
					})
					.css({ resize: 'none' })
					.editable({
						title: 'Ingrese la informoción',
						title: arrayTitles[x],
						rows: 10,
						emptytext: '',
					});
			});
			
			// //Si hay un cambio en participación docentes se debe actualizar sesiones por docentes en condiciones institucionales
			$( "[id$=docentes]", filaNueva ).on( "change", function(e, params){
				
				var docentes = [];
				
				$( "option:selected", $( "[id$=docentes]" ) ).each(function(){
					
					var doc = $( this ).text().split( " - " );
					
					for( var x in doc ){
						
						if( $.inArray( doc[x], docentes ) === -1 ){
							docentes.push( doc[x] );
						}
					}
				});
				
				$( "#condicionesinstitucionales-total_docentes_ieo" ).val( docentes.length );
			});
			
			
			//Calcula el total de apps desarrolladas para las condiciones institucionales
			$( "[id$=numero_apps_desarrolladas]", filaNueva ).on( "save", function(e, params) {
				
				var _self = this;
				var total = params.newValue*1;
						
				$( "[id$=numero_apps_desarrolladas]" ).each(function(){
					if( _self != this )
					{
						total += this.value*1;
					}
				});
				
				$( "#condicionesinstitucionales-total_apps" ).val( total );
			});
			
			$( "#btnRemoveFila"+id ).css({ display: "" });
			
			totalSesiones()
			
			consecutivos[id].actual++;
		}
		catch(e){alert(e)}
		});
		
	});
	
	$( "[id^=btnRemoveFila]" ).each(function(){
		
		$( this ).click(bbbb=function(){
			
			var id = this.id.substr( "btnRemoveFila".length );
			var total = $( "[id^=dvFilaSesion]", $( this ).parent().parent() ).length;

			if( total > 0 ){
				
				if( total == 1 ){
					$( this ).css({ display: "none" });
				}
				
				$( "[id^=dvFilaSesion]", $( this ).parent().parent() ).last().remove();
				
				//Se hacen funciones para calcular totales de condiciones institucionales
				//Calculando el numero de apps desarrolladas
				var total = 0;
				$( "[id$=numero_apps_desarrolladas]" ).each(function(){
					total += this.value*1;
				});
				
				//Calculando el total de apps
				$( "#condicionesinstitucionales-total_apps" ).val( total );
				
				
				var docentes = [];
				
				$( "option:selected", $( "[id$=docentes]" ) ).each(function(){
					
					var doc = $( this ).text().split( " - " );
					
					for( var x in doc ){
						
						if( $.inArray( doc[x], docentes ) === -1 ){
							docentes.push( doc[x] );
						}
					}
				});
				
				$( "#condicionesinstitucionales-total_docentes_ieo" ).val( docentes.length );
				
				
				totalSesiones();
			}
		});
	});