/**
Modificaciones:
Fecha: 2019-02-04
Descripción: Se desagregan los campos Profesional A y docentes de cada sesión con respecto a a la conformación de los semilleros
			 y se dejan los campos select en español
---------------------------------------
Modificaciones:
Fecha: 2018-10-16
Descripción: Se premite insertar y modificar registros del formulario Ejecucion Fase I Docentes
---------------------------------------
*/

$( document ).ready(function(){
	
	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitles = [
		"Nombre del docente",
		"Nombre de las asignaturas que enseña",
		"Especialidad de la Media Técnica o Técnica",
		"Participación Sesiones(1 a 12)",
		"Número de Apps 0.0 creadas",
		"Nombre de las aplicaciones creadas",
		"Número de sesiones empleadas para la creación de cada aplicación",
		"Acciones realizadas con mayor incidencia para estimular la creación de las App 0.0",
		"Temas problema que atiende la creción",
		"Tipo de competencias inferencias y comprometidas en el proceso de creación de la App 0.0",
		"Observaciones",
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
	
	//Cuando se abre un acordeon se ponen todos los elementos del encabezado del mismo tamaño
	$('#collapseOne').on('shown.bs.collapse', function(){
		
		//this para este caso es el panel al que se dió click
		$( ".title", this ).each(function(){
			
			//Para este caso this es el div con clase .title
			var alto = $( this ).prop("scrollHeight");
			
			//pongo el span del tamaño requerido
			$( "span", this ).each(function(){
				//this es el span
				$( this ).css({ height: alto });
			});
		});
		
	});
	
	//Creo un array con las primeras posiciones de cada sesion
	//Esto se hace para que al hacer submit no aparezcan los datos vacios
	dvsFilas = [];
	$(".panel-body").each(function(x){
		
		dvsFilas[ $( "[id^=dvFilaSesion]", this ).eq(0)[0].id.substr( "dvFilaSesion".length ) ] = $( "[id^=dvFilaSesion]", this ).eq(0);
		$( "[id^=dvFilaSesion]", this ).eq(0).remove();
	});
	
	
	//Si hay un cambio en participación docentes se debe actualizar sesiones por docentes en condiciones institucionales
	//Save es el evento que genera el plugin editable al cambiar un dato
	$( "[id$=paricipacion_sesiones]" ).on( "save", function(e, params){
		
		var total = params.newValue;
		
		var _self = this;
		
		$( "[id$=paricipacion_sesiones]" ).each(function(){
			if( _self != this )
				total = total*1 + this.value*1;
		});
		
		$( "#condicionesinstitucionales-total_sesiones_ieo" ).val( total );
	});
	
	
	// //Si hay un cambio en participación docentes se debe actualizar sesiones por docentes en condiciones institucionales
	$( "[id$=docente]" ).on( "change", function(e, params){
		
		var docentes = [];
		
		$( "option:selected", $( "[id$=docente]" ) ).each(function(){
			
			var doc = $( this ).text().split( " - " );
			
			for( var x in doc ){
				
				if( $.inArray( doc[x], docentes ) === -1 ){
					docentes.push( doc[x] );
				}
			}
		});
		
		$( "#condicionesinstitucionales-total_docentes_ieo" ).val( docentes.length );
	});
	
	
	/************************************************************************************************************************************************
	 * 
	 ************************************************************************************************************************************************/
	 setTimeout(function(){

		
		 
		$( "input:text[id$=fecha_sesion]" ).each(function(x){
			
			$('#w0').yiiActiveForm('find', this.id ).validate = function (attribute, value, messages, deferred, $form) {
				
				var cmp = $( "#"+this.id ).val();
				
				var hayCamposVacios = false;
				$( "textarea[id^=ejecucionfase]", $( this.container ).parent() ).each(function(){
					if( $( this ).val() == '' ){
						hayCamposVacios = true;
					}
				});
				
				
				//Si no se ha ingresado fecha y mas de una fila (ejecucion de fase)
				if( cmp == "" && $( "[id^=dvFilaSesion]", $( this.container ).parent() ).length == 0 ){
					// alert(1);
					return true;
				}
				else if( cmp != "" && $( "[id^=dvFilaSesion]", $( this.container ).parent() ).length > 0 && !hayCamposVacios ){
					// alert(1);
					return true;
				}
				else{
					// alert(2);
					if( cmp == "" )
						yii.validation.required(cmp, messages, {"message":"Fecha de la Sesión no puede estar vacío"});
					else
						yii.validation.addMessage(messages,"Debe agregar por lo menos una ejecución de fase y llenar todos los campos", cmp );
					 
					return false;
				}
			}
		});
		
		$( "input:text[id$=duracion_sesion]" ).each(function(x){
			
			$('#w0').yiiActiveForm('find', this.id ).validate = function (attribute, value, messages, deferred, $form) {
				
				var cmp = $( "#"+this.id ).val();
				
				var hayCamposVacios = false;
				$( "textarea[id^=ejecucionfase]", $( this.container ).parent() ).each(function(){
					if( $( this ).val() == '' ){
						hayCamposVacios = true;
					}
				});
				
				
				//Si no se ha ingresado fecha y mas de una fila (ejecucion de fase)
				if( cmp == "" && $( "[id^=dvFilaSesion]", $( this.container ).parent() ).length == 0 ){
					// alert(1);
					return true;
				}
				else if( cmp != "" && $( "[id^=dvFilaSesion]", $( this.container ).parent() ).length > 0 && !hayCamposVacios ){
					yii.validation.regularExpression(value, messages, {"pattern":/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/i,"not":false,"message":"Duración de la sesión debe ser una hora valida.","skipOnEmpty":1});
					return true;
				}
				else{
					// alert(2);
					if( cmp == "" )
						yii.validation.required(cmp, messages, {"message":"Fecha de la Sesión no puede estar vacío"});
					else{
						yii.validation.regularExpression(value, messages, {"pattern":/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/i,"not":false,"message":"Duración de la sesión debe ser una hora valida.","skipOnEmpty":1});
						yii.validation.addMessage(messages,"Debe agregar por lo menos una ejecución de fase y llenar todos los campos", cmp );
					}
					 
					return false;
				}
			}
		});
	 }, 500 );
	
	
	
	
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
	
	$( "#collapseOne textarea" ).each(function(x){
	
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
	
	consecutivos = [];
	$( '[id^=dvSesion]' ).each(function(x){
		
		var pos = this.id.substr( "dvSesion".length );
		
		consecutivos[pos] = {
			inicial : $( "[id^=dvFilaSesion]", this ).length+1,
			actual  : $( "[id^=dvFilaSesion]", this ).length+1,
		} 
	});
	
	$( "[id^=btnAddFila]" ).each(function(){
		
		$( this ).click(function(){
			
			var id = this.id.substr( "btnAddFila".length );
			
			var consecutivo = consecutivos[id].actual;
			
			// var filaNueva = $( "#dvFilaSesion"+id ).clone();
			var filaNueva = dvsFilas[id].clone();
			
			$( "#dvSesion"+id ).append( filaNueva );
			
			//Cambiando los id de los textarea con el consecutivo correspondiente
			$( "select,textarea,input:hidden", filaNueva ).each(function(x){
				
				var _campo = this;
				
				$( _campo ).prop({
						id		: _campo.id.replace( /-[0-9]+-[0-9]+-/gi, "-"+id+"-"+consecutivo+"-" ),
						name	: _campo.name.replace( /\[[0-9]+\]\[[0-9]+\]/gi, "["+id+"]["+consecutivo+"]" ),
					});
				
				$( _campo ).parent()
						.removeClass( "field-"+this.id.replace( /-[0-9]+-[0-9]+-/gi, "-"+consecutivo+"-0-" ) )
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
												
												if( $( this.input ).data( "type" ) == "number" ){
													yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Debe ser un número entero.","skipOnEmpty":1});	
												}
												
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
				
				this.multiple = true;
				
				$( this ).chosen({
							"search_contains"			:true,
							"single_backstroke_delete"	:false,
							"disable_search_threshold"	:5,
							"placeholder_text_single"	:"Seleccione...",
							"placeholder_text_multiple"	:"Seleccione...",
							"no_results_text"			:"Sin resultados",
						});
			});
			
			filaNueva.css({ display: '' });
			$( "select,textarea", filaNueva ).each(function(x){
		
				$( this )
					.attr({
						readOnly: true,
						class: 'form-control',
					})
					.css({ resize: 'none' })
					.editable({
						// title: 'Ingrese la informoción',
						title: arrayTitles[x],
						rows: 10,
						emptytext: '',
					});
			});
			
			//Si hay un cambio en participación docentes se debe actualizar sesiones por docentes en condiciones institucionales
			$( "[id$=paricipacion_sesiones]", filaNueva ).on( "save", function(e, params){
				
				var total = params.newValue;

				var _self = this;
				
				$( "[id$=paricipacion_sesiones]" ).each(function(){
					if( _self != this )
						total = total*1 + this.value*1;
				});
				
				$( "#condicionesinstitucionales-total_sesiones_ieo" ).val( total );
			});
			
			// //Si hay un cambio en participación docentes se debe actualizar sesiones por docentes en condiciones institucionales
			$( "[id$=docente]", filaNueva ).on( "change", function(e, params){
				
				var docentes = [];
				
				$( "option:selected", $( "[id$=docente]" ) ).each(function(){
					
					var doc = $( this ).text().split( " - " );
					
					for( var x in doc ){
						
						if( $.inArray( doc[x], docentes ) === -1 ){
							docentes.push( doc[x] );
						}
					}
				});
				
				$( "#condicionesinstitucionales-total_docentes_ieo" ).val( docentes.length );
			});
			
			// consecutivo++;
			consecutivos[id].actual++;
			
			$( "#btnRemoveFila"+id ).css({ display: "" });
		});
		
	});
	
	$( "[id^=btnRemoveFila]" ).each(function(){
		
		$( this ).click(function(){
			
			var id = this.id.substr( "btnRemoveFila".length );
			var total = $( "[id^=dvFilaSesion]", $( this ).parent().parent() ).length;
			
			var consecutivo = consecutivos[id].inicial;
			
			if( total > 0 ){
				
				if( total == consecutivo ){
					$( this ).css({ display: "none" });
				}
				
				$( "[id^=dvFilaSesion]", $( this ).parent().parent() ).last().remove();
			}
		});
	});
	
});
