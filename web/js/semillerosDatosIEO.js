/**********
Versión: 001
Fecha: 2018-08-28
Desarrollador: Edwin Molina Grisales
Descripción: Formulario SEMILLEROS DATOS IEO
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

$( document ).ready(function(){
	
	
	/************************************************************************************************************************************************
	 * Validando datos extras
	 ************************************************************************************************************************************************/
	 setTimeout(function(){
		 
		$( "#semillerosdatosieo-docente_aliado" ).each(function(x){
			
			$('#w0').yiiActiveForm('find', this.id ).validate = function (attribute, value, messages, deferred, $form) {
				
				//Si no se ha ingresado fecha y mas de una fila (ejecucion de fase)
				if( $( "[id^=dvFilas]" ).length > 0 ){
					return true;
				}
				else{
					yii.validation.addMessage(messages,"Debe agregar por lo menos un aucuerdo institucional en cualquier fase", this );
					return false;
				}
			}
		});
	}, 500 );
	 
	 
	
	$( "#semillerosdatosieo-personal_a" ).change(function(){
		
		$( "#list_docente_aliado option" ).attr({disabled:true});
		
		$( "#list_docente_aliado option["+this.value+"]" ).attr({disabled:false});
		
	});
	
	$( "#semillerosdatosieo-personal_a,#semillerosdatosieo-docente_aliado" ).change(function(){
		
		var val = true;
		
		val = ( $.trim( $( "#semillerosdatosieo-personal_a" ).val() ) != '' ? true : false ) && val;
		val = ( $.trim( $( "#semillerosdatosieo-docente_aliado" ).val() ) != '' ? true : false ) && val;
		
		if( val )
		{
			$( "#guardar" ).val( 0 )
			this.form.submit();
		}
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
				$( "textarea", filaClonada ).each(function(){
		
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