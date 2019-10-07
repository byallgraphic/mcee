/**********
Versión: 001
Fecha: 2018-08-28
Desarrollador: Edwin Molina Grisales
Descripción: Formulario SEMILLEROS DATOS IEO
---------------------------------------
Modificaciones:
Fecha: 2019-02-12
Desarrollador: Edwin Molina Grisales
Descripción: El campo select para docentes se deja de selección multiple
---------------------------------------
Fecha: 2019-02-05
Desarrollador: Edwin Molina Grisales
Descripción: El plugin chosen se deja en español
---------------------------------------
Fecha: 2018-11-08
Desarrollador: Edwin Molina Grisales
Descripción: Se hacen cambios para calcular el total de docentes
---------------------------------------
Fecha: 2018-11-06
Desarrollador: Edwin Molina Grisales
Descripción: Se hacen modificaciones varias para guardar varios profesionales A, docentes aliados y nombres de docentes
---------------------------------------
Modificaciones:
Fecha: 2018-10-29
Persona encargada: Edwin Molina Grisales
Descripción: Se agrega validacion de campos dinámicos
---------------------------------------
Modificaciones:
Fecha: 2018-09-19
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin XEditable, para poderlos editar
---------------------------------------
**********/


//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
var arrayTitles = [
	"Nombre del docente",
	"Nombre de las asignaturas asignadas",
	"Especialidad de la Media Técnica o Técnica",
	"Total Docentes",
	"OBSERVACIONES",
];

$( document ).ready(function(){
	
	/************************************************************************************************************************************************
	 * Validando datos extras
	 ************************************************************************************************************************************************/
	 setTimeout(function(){
		 
		var intervalo = undefined;
		
		$( "#semillerosdatosieo-personal_a" ).on( 'chosen:showing_dropdown', function(){ 
			$( "#semillerosdatosieo_personal_a_chosen" ).removeClass( 'chosen-container-single-nosearch' );
			$( "#semillerosdatosieo_personal_a_chosen input" ).attr({readOnly:false});
			
		})

		$( "#semillerosdatosieo_personal_a_chosen input" ).on( 'keyup', function(e){ 

			var slOriginal = $( "#semillerosdatosieo-personal_a" );

			var search = $( this );
			var value_search = search.val();

			if( value_search.length >= 3 && e.which == 13 )
			{
				clearTimeout( intervalo );
				intervalo = setTimeout( function(){
									$( "option:not(:selected)", slOriginal ).remove();
									search.attr({readOnly:true});
									
									clearTimeout( intervalo );
									
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
		
		
		
		
		
		var intervalo2 = undefined;
		
		$( "#semillerosdatosieo-docente_aliado" ).on( 'chosen:showing_dropdown', function(){ 
			$( "#semillerosdatosieo_docente_aliado_chosen" ).removeClass( 'chosen-container-single-nosearch' );
			$( "#semillerosdatosieo_docente_aliado_chosen input" ).attr({readOnly:false});
			
		})

		$( "#semillerosdatosieo_docente_aliado_chosen input" ).on( 'keyup', function(e){ 

			var slOriginal = $( "#semillerosdatosieo-docente_aliado" );

			var search = $( this );
			var value_search = search.val();

			if( value_search.length >= 3  && e.which == 13)
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
		 
		 
		 
		 
		 
		$( "#semillerosdatosieo-docente_aliado" ).each(function(x){
			
			$('#w0').yiiActiveForm('find', this.id ).validate = function (attribute, value, messages, deferred, $form) {
				
				//Si no se ha ingresado fecha y mas de una fila (ejecucion de fase)
				if( $( "[id^=dvFilas]" ).length > 0 ){
					return true;
				}
				else{
					yii.validation.addMessage(messages,"Debe agregar por lo menos un acuerdo institucional en cualquier fase", this );
					return false;
				}
			}
		});
	}, 500 );
	 
	 
	
	$( "#semillerosdatosieo-personal_a" ).change(function(){
		
		try{
			$( "#list_docente_aliado option" ).attr({disabled:true});
			
			$( "#list_docente_aliado option["+this.value+"]" ).attr({disabled:false});
		}
		catch(e){}
	});
	
	//Todos los campos que terminan ralizan el calculo  del campo total docentes
	$( "[id$=id_docente]" ).on( "change", function() {
		
		var total = $( "option:selected", this ).length;
		
		$( "#"+this.id.substr( 0, this.id.length-"id_docente".length )+"total_docentes" ).val( total );
		
		var fase = this.id.split("-")[1];
		
		var totalDocentes = 0;
		
		$( "[id$=total_docentes]", $( "#container-"+fase ) ).each(function(){
			totalDocentes += parseInt( this.value );
		});
		
		$( "#total_docentes-"+fase ).html( totalDocentes );
	});
	
	/****************************************************************************************
	 * Se asigna las funcionalidades de los botones agregar y eliminar
	 ****************************************************************************************/
	
	dvFilas = [];
	$( "[id^=container]" ).each(function(){
		
		var _container = $( this );
		
		var fase = $( _container ).attr( 'fase' );
		
		var filaNueva = $( "#dvFilas-"+fase+"-0", _container );
		
		//remuevo la primera fila ya que solo se usa para poderla clonar despues
		//Y nada de esa fila se guarda
		filaNueva.remove();
		
		//No dejo borrar los datos ya guardados
		var min = $( "[id^=dvFilas]", _container ).length;
		
		//Este sirve para cambiar los id de acuerdo al cosecutivo que tenga este
		var consecutivo = $( "[id^=dvFilas]", _container ).length+1;
		
		/**
		 * Le doy funcionalidad a los botones de agregar
		 * Se hace un each de cada boton
		 */
		$( "#btnAgregar"+fase ).each(function(){
			 
			//this es el boton agregar
			$( this ).click(function(){
				
				var filaClonada = filaNueva.clone();
				
				_container.append( filaClonada );
				
				$( "#btnEliminar"+fase ).css({display:''});
				
				//A todos los texareas les pongo que sea editables
				$( "textarea,input", filaClonada ).each(function(x){
		
					//Agrego data-type textarea para que el popup editable salga como textarea
					//Sin esto mostraría un input para ingresar información
					if( $( this ).data( 'type' ) == 'number' )
						$( this ).data( 'type', 'number' );
					else
						$( this ).data( 'type', 'textarea' );
				
					$( this )
						.attr({readOnly: true })
						.css({ 
							resize: 'none',
							height: '34px',
						})
						.editable({
							// title: 'Ingrese la informoción',
							title: arrayTitles[x],
							rows: 10,
							emptytext: '',
						});
				});
				
				//Cambiando los id
				//A todos los texareas, input y select que tenga la fila clonada
				$( "textarea,input,select", filaClonada ).each(function(){
		
					//this es el respectivo textarea, input o select
					var _campo = this;
					
					$( _campo ).prop({
						id		: _campo.id.replace( /-[0-9]+-[0-9]+-/gi, "-"+fase+"-"+consecutivo+"-" ),
						name	: _campo.name.replace( /\[[0-9]+\]\[[0-9]+\]/gi, "["+fase+"]["+consecutivo+"]" ),
					});
					
					$( _campo ).parent()
						.removeClass( "field-"+this.id.replace( /-[0-9]+-[0-9]+-/gi, "-"+fase+"-0-" ) )
						.addClass( "field-"+this.id );
						
					// Todos los campos son obligatorios menos el id, ya que este puede ser vacío si es un campo nuevo
					if( _campo.id.substr( -2 ) != "id" )
					{
						$( "#w0" ).yiiActiveForm( 'add', 
								{
									"id"		: _campo.id,
									"name"		: _campo.name,
									"container"	: ".field-"+_campo.id,
									"input"		: "#"+_campo.id,
									"validate"	: function (attribute, value, messages, deferred, $form) {
										
													if( $( this.input ).data( 'type' ) == 'number' )
													{
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
				});
				
				$( "select", filaClonada ).each(function(){
					
					var __self = this;
					
					$( this ).chosen({
							"search_contains"			:true,
							"single_backstroke_delete"	:false,
							"disable_search_threshold"	:5,
							"placeholder_text_single"	:"Seleccione...",
							"placeholder_text_multiple"	:"Seleccione...",
							"no_results_text"			:"Sin resultados",
						});
						
						
					var intervalo2 = undefined;
		
					$( __self ).on( 'chosen:showing_dropdown', function(){ 
						$( "div", $( __self ).parent() ).removeClass( 'chosen-container-single-nosearch' );
						$( "div input", $( __self ).parent() ).attr({readOnly:false});
						
					})

					$( "div input", $( __self ).parent() ).on( 'keyup', function(){ 

						var slOriginal = $( __self );

						var search = $( this );
						var value_search = search.val();

						if( value_search.length >= 3 )
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
				
				//Todos los campos que terminan ralizan el calculo  del campo total docentes
				$( "[id$=id_docente]", filaClonada ).on( "change", function() {
					
					$( this ).attr({multiple:true});
					
					var total = $( "option:selected", this ).length;
					
					$( "#"+this.id.substr( 0, this.id.length-"id_docente".length )+"total_docentes" ).val( total );
					
					var fase = this.id.split("-")[1];
					
					var totalDocentes = 0;
					
					$( "[id$=total_docentes]", $( "#container-"+fase ) ).each(function(){
						totalDocentes += parseInt( this.value );
					});
					
					$( "#total_docentes-"+fase ).html( totalDocentes );
				});
				
				consecutivo++;
			});
		});
		
		/**
		 * Le doy funcionalidad a los botones de eliminar
		 * Se hace un each de cada boton
		 */
		$( "#btnEliminar"+fase ).each(function(){
			 
			//this es el boton agregar
			$( this ).click(function(){
				
				if( $( "[id^=dvFilas]", _container ).length == min+1 ){
					$( this ).css({display:'none'});
				}
				
				$( "[id^=dvFilas]", _container ).last().remove();
				
				
				//Calculo el total de docentes por fase nuevamente
				var totalDocentes = 0;
				
				$( "[id$=total_docentes]", $( "#container-"+fase ) ).each(function(){
					totalDocentes += parseInt( this.value );
				});
				
				$( "#total_docentes-"+fase ).html( totalDocentes );
				
			});
		});
	});
	
	
	//Se agrega editables para los campos textarea de condiciones institucionales
	$( "textarea" ).each(function(){
		
		//Agrego data-type textarea para que el popup editable salga como textarea
		//Sin esto mostraría un input para ingresar información
		$( this ).data( 'type', 'textarea' );
	
		$( this )
			.attr({readOnly: true })
			.css({ 
				resize: 'none',
				height: '34px',
			})
			.editable({
				title: 'Ingrese la informoción',
				rows: 10,
				emptytext: '',
			});
	});
	
});