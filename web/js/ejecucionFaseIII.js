/**********
Versión: 001
Fecha: 2018-08-21
Desarrollador: Edwin Molina Grisales
Descripción: Formulario EJECUCION FASE III
---------------------------------------
Modificaciones:
Fecha: 2019-02-05
Descripción: Se desagregan DATOS PROFESIONALES y docente creador con respecto a a la conformación de los semilleros
---------------------------------------
Fecha: 2018-09-18
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin Textarea, para poderlos editar
---------------------------------------
**********/

// $( document ).ready(function(){
	
	// var con = 1;
	
	$.fn.combodate.defaults.minYear = new Date().getFullYear()-1;
	$.fn.combodate.defaults.maxYear = new Date().getFullYear()+5;
	
	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitles = [
		"Nombre del creador",
		"Asignatura en la que se usa la aplicación",
		// "Nombre del docente usuario de la Aplicación",
		"Grado en el que se usa la aplicación",
		// "Número de estudiantes cultivadores",
		"Número de Apps 0.0 usadas",
		"Nombre de las aplicaciones usadas",
		"TIC (infraestructura existente en la IEO)",
		"Tipo de Uso del Recurso",
		"Digitales",
		"Tipo de Uso del Recurso",
		"Escolares (No TIC)",
		"Tipo de Uso del Recurso",
		"Tiempo de uso de los recursos TIC en el uso de las App 0.0 (Horas)",
		"Número",
		"Tipo de producción",
		"Indice de temas escolares disciplinares tratados y abordados a través del uso de las App 0.0",
		"Indice de problematicas abordadas a través del uso de las App 0.0",
		"Fecha de Uso de las aplicaciones",
		"OBSERVACIONES GENERALES",
	];
	
	
	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitlesCondicionesInstitucionales = [
		"Por parte de la IEO",
		"Por parte de UNIVALLE",
		"Por parte de la SEM",
		"OTRO",
	];
	
	$( "[id$=numero_apps_usadas]" ).on( 'save', function( e, params ){
		
		var _self = this;
		
		var total = params.newValue*1;
		
		$( "[id$=numero_apps_usadas]" ).each(function(){
			
			if( this != _self )
			{
				total += this.value*1;
			}
		});
		
		$( "#semillerosticcondicionesinstitucionalesfaseiii-total_aplicaciones_usadas" ).val( total );
	});
	
	
	// $( "[id$=numero_estudiantes]" ).on( 'save', function( e, params ){
		
		// var _self = this;
		
		// var total = params.newValue*1;
		
		// var sesion = this.id.split("-")[1];
		
		// $( "#semillerosticejecucionfaseiii-"+sesion+"-estudiantes_cultivadores" ).val( total );
	// });
	
	$( "[id$=docente_creador]" ).on( 'change', function( e, params ){
		
		var _self = this;
		
		var total = $( "option:selected" , _self ).length;
		
		var sesion = this.id.split("-")[1];
		
		$( "#semillerosticejecucionfaseiii-"+sesion+"-estudiantes_cultivadores" ).val( total );
	});
	
	//Cuando se abre un acordeon se ponen todos los elementos del encabezado del mismo tamaño
	$('#collapseOne').on('shown.bs.collapse', function(){
		
		//this para este caso es el panel al que se dió click
		$( ".title, .title3, .title2", this ).each(function(){
			
			//Para este caso this es el div con clase .title
			var alto = $( this ).prop("scrollHeight");
			
			//pongo el span del tamaño requerido
			$( "span", this ).each(function(){
				//this es el span
				$( this ).css({ height: alto });
			});
		});
		
	});
	
	//Oculto el primer acordeon para que no se vea
	//Esto se hace por que si clona sobre algo que ya tiene textareas editables aparecen comportamientos insesperados
	//Por tal motivo se mantiene el primer item del acordeon oculto
	$( ".panel" ).first().css({display:'none'});
	
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
	
	var panel = $( ".panel" ).first();
	panel.remove();
	
	$( "[id^=btnAddFila]" ).each(function(){
		
		$( this ).click(function(){
			
			var id = this.id.substr( "btnAddFila".length );
			
			//Clono sobre el primer item del acordeon, que siempre está oculto
			var cloneCollapse = panel.clone();
			
			
			//Busco todos los campos y se les cambia el nombre y al id
			$( "textarea,input,select", cloneCollapse ).each(function(){
				
				//this es el respectivo campo (textarea,input o select )
				$( this ).prop({
					id		: this.id.replace( /-[0-9]+-/gi, "-"+con+"-" ),
					name	: this.name.replace( /\[[0-9]+\]/gi, "["+con+"]" ),
				});
			});
			
			$( ".panel-group" ).append( cloneCollapse );
			
			$( "select[id^=semillerosticejecucionfaseiii]", cloneCollapse ).each(function(x){
				$( this ).attr({multiple:true})
			})
				
			$( "select[id^=datosieoprofesional],select[id^=semillerosticejecucionfaseiii]", cloneCollapse ).each(function(x){
				
				$( this ).chosen({
							"search_contains"			:true,
							"single_backstroke_delete"	:false,
							"disable_search_threshold"	:5,
							"placeholder_text_single"	:"Seleccione...",
							"placeholder_text_multiple"	:"Seleccione...",
							"no_results_text"			:"Sin resultados",
						});
			});
			
			//Se muestra el item del acordeon
			cloneCollapse.css({ display: "" });	
			
			var anchorA = $( ".panel-title > a" , cloneCollapse );
			
			anchorA
				.html( "Registro "+(con-1) )
				.attr( "href", anchorA.attr("href").substr( 0 , anchorA.attr("href").length-1 )+con );
			
			var panelCollapse = $( ".panel-collapse" , cloneCollapse );
			panelCollapse.attr( "id", panelCollapse.attr( "id" ).substr( 0, panelCollapse.attr( "id" ).length-1 )+con )
			
			//Agregando la validacion de los campos para datos ieo profesional
			$( "#datosieoprofesional-"+con+"-id_institucion" ).parent()
				.removeClass( "field-datosieoprofesional-0-id_institucion" )
				.addClass( "field-datosieoprofesional-"+con+"-id_institucion" );
				
			$( "#datosieoprofesional-"+con+"-id_profesional_a" ).parent()
				.removeClass( "field-datosieoprofesional-0-id_profesional_a" )
				.addClass( "field-datosieoprofesional-"+con+"-id_profesional_a" );
			
			$( "#w0" ).yiiActiveForm( 'add', 
					{
						"id"		: "datosieoprofesional-"+con+"-id_institucion",
						"name"		: "DatosIeoProfesional["+con+"][id_institucion]",
						"container"	: ".field-datosieoprofesional-"+con+"-id_institucion",
						"input"		: "#datosieoprofesional-"+con+"-id_institucion",
						"validate"	: function (attribute, value, messages, deferred, $form) {
										yii.validation.required(value, messages, {"message":"Institución no puede estar vacío."});
										yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Institución debe ser un número entero.","skipOnEmpty":1});
									}
					},
				);
				
			$( "#w0" ).yiiActiveForm( 'add', 
					{
						"id"		: "datosieoprofesional-"+con+"-id_profesional_a",
						"name"		: "DatosIeoProfesional["+con+"][id_profesional_a]",
						"container"	: ".field-datosieoprofesional-"+con+"-id_profesional_a",
						"input"		: "#datosieoprofesional-"+con+"-id_profesional_a",
						"validate"	: function (attribute, value, messages, deferred, $form) {
										yii.validation.required(value, messages, {"message":"Profesional A no puede estar vacío."});
										yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Profesional A debe ser un número entero.","skipOnEmpty":1});
									}
					},
				);
			
			//Agregando la validacion de los campos para ejecucion de fase
			$( "#semillerosticejecucionfaseiii-"+con+"-total_aplicaciones_usadas" ).parent()
				.removeClass( "field-semillerosticejecucionfaseiii-0-total_aplicaciones_usadas" )
				.addClass( "field-semillerosticejecucionfaseiii-"+con+"-total_aplicaciones_usadas" );
				
			$( "#w0" ).yiiActiveForm( 'add', 
					{
						"id"		: "semillerosticejecucionfaseiii-"+con+"-total_aplicaciones_usadas",
						"name"		: "SemillerosTicEjecucionFaseIii["+con+"][total_aplicaciones_usadas]",
						"container"	: ".field-semillerosticejecucionfaseiii-"+con+"-total_aplicaciones_usadas",
						"input"		: "#semillerosticejecucionfaseiii-"+con+"-total_aplicaciones_usadas",
						"validate"	: function (attribute, value, messages, deferred, $form) {
										yii.validation.string(value, messages, {"message":"Total Aplicaciones Usadas debe ser una cadena de caracteres.","skipOnEmpty":1});
										yii.validation.required(value, messages, {"message":"Total Aplicaciones Usadas no puede estar vacío.","skipOnEmpty":1});
									}
					},
				);
			
			$( "#semillerosticejecucionfaseiii-"+con+"-estudiantes_cultivadores" ).parent()
				.removeClass( "field-semillerosticejecucionfaseiii-0-estudiantes_cultivadores" )
				.addClass( "field-semillerosticejecucionfaseiii-"+con+"-estudiantes_cultivadores" );
				
			$( "#w0" ).yiiActiveForm( 'add', 
					{
						"id"		: "semillerosticejecucionfaseiii-"+con+"-estudiantes_cultivadores",
						"name"		: "SemillerosTicEjecucionFaseIii["+con+"][estudiantes_cultivadores]",
						"container"	: ".field-semillerosticejecucionfaseiii-"+con+"-estudiantes_cultivadores",
						"input"		: "#semillerosticejecucionfaseiii-"+con+"-estudiantes_cultivadores",
						"validate"	: function (attribute, value, messages, deferred, $form) {
										yii.validation.string(value, messages, {"message":"Número de estudiantes cultivadores debe ser una cadena de caracteres.","skipOnEmpty":1});
										yii.validation.required(value, messages, {"message":"Número de estudiantes cultivadores no puede estar vacío.","skipOnEmpty":1});
									}
					},
				);
				
			//Agregando validación a todos los campos textarea de ejecución de fase
			$( "textarea[id^=semillerosticejecucionfaseiii]", cloneCollapse ).each(function(){
				
				$( "#"+this.id ).parent()
					.removeClass( "field-"+this.id.replace( /-[0-9]+-/gi, "-0-" ) )
					.addClass( "field-"+this.id );
					
				$( "#w0" ).yiiActiveForm( 'add', 
						{
							"id"		: "#"+this.id,
							"name"		: this.name,
							"container"	: ".field-"+this.id,
							"input"		: "#"+this.id,
							"validate"	: function (attribute, value, messages, deferred, $form) {
											yii.validation.string(value, messages, {"message":"Debe ser una cadena de caracteres.","skipOnEmpty":1});
											yii.validation.required(value, messages, {"message":"No puede estar vacío.","skipOnEmpty":1});
										}
						},
					);
			});
			
			$( "#btnRemoveFila"+id ).css({ display: "" });
			
			//Pongo todos los textarea del item del acordeon clonado para que se siempre editable
			$( "textarea", cloneCollapse ).each(function(x){
		
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
			
			//Calculo de apps usadas, esto mismo está para los campos ya registrados al inicio del script
			$( "[id$=numero_apps_usadas]", cloneCollapse ).on( 'save', function( e, params ){
		
				var _self = this;
				
				var total = params.newValue*1;
				
				$( "[id$=numero_apps_usadas]" ).each(function(){
					
					if( this != _self )
					{
						total += this.value*1;
					}
				});
				
				$( "#semillerosticcondicionesinstitucionalesfaseiii-total_aplicaciones_usadas" ).val( total );
			});
			
			// //Calculo de estudaintes cultivadores, esto mismo está para los campos ya registrados al inicio del script
			// $( "[id$=numero_estudiantes]", cloneCollapse  ).on( 'save', function( e, params ){
		
				// var _self = this;
				
				// var total = params.newValue*1;
				
				// var sesion = this.id.split("-")[1];
				
				// $( "#semillerosticejecucionfaseiii-"+sesion+"-estudiantes_cultivadores" ).val( total );
			// });
			
			//Calculo de estudaintes cultivadores, esto mismo está para los campos ya registrados al inicio del script
			$( "[id$=docente_creador]", cloneCollapse  ).on( 'change', function( e, params ){
		
				var _self = this;
				
				var total = $( "option:selected" , _self ).length;
				
				var sesion = this.id.split("-")[1];
				
				$( "#semillerosticejecucionfaseiii-"+sesion+"-estudiantes_cultivadores" ).val( total );
			});
			
			$('[id$=fecha_sesion]', cloneCollapse ).parent().datepicker({"autoclose":true,"format":"dd-mm-yyyy","language":"es"});
			
			//Agregando validación a todos los campos textarea de ejecución de fase
			$( "[id^=datossesiones]", cloneCollapse ).each(function(){
				
				if( this.id.substr(-2) != 'id' ){
					
					$( "#"+this.id ).parent()
						.removeClass( "field-"+this.id.replace( /-[0-9]+-/gi, "-0-" ) )
						.addClass( "field-"+this.id );
						
					$( "#w0" ).yiiActiveForm( 'add', 
							{
								"id"		: "#"+this.id,
								"name"		: this.name,
								"container"	: ".field-"+this.id,
								"input"		: "#"+this.id,
								"validate"	: function (attribute, value, messages, deferred, $form) {
												// yii.validation.string(value, messages, {"message":"Debe ser una cadena de caracteres.","skipOnEmpty":1});
												yii.validation.required(value, messages, {"message":"No puede estar vacío.","skipOnEmpty":1});
											}
							},
						);
				}
			});
			
			con++;
		});
		
	});
	
	$( "[id^=btnRemoveFila]" ).each(function(){
		
		$( this ).click(function(){
			
			var total = $( ".panel" ).length;
			
			if( total > min ){
				
				if( total == min+1 ){
					$( this ).css({ display: "none" });
				}
				
				$( ".panel" ).last().remove()
				
				con--;				
			}
		});
	});
	
	// $( "[name=btnAddSession]" ).click(function(){
	$( "#collapseOne" ).on( "click", "[name=btnAddSession]", function(){
		
		var contenedor = $( this ).parent().parent();
		
		var index = $( "[id$=id_sesion] option", contenedor ).length-1;
	
		$.get( "index.php?r=ejecucion-fase-iii/add-session-item&index="+index , function( data ){
			
			if( data != '' )
				$( "[id$=id_sesion]", contenedor ).append( data )
		});
	})
	
// });