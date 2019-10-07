/**********
Versión: 001
Fecha: 2018-08-28
Desarrollador: Edwin Molina Grisales
Descripción: Formulario SEMILLEROS DATOS IEO ESTUDIANTES
---------------------------------------
Modificaciones:
Fecha: 2018-10-31
Persona encargada: Edwin Molina Grisales
Descripción: Se permite guardar o modificar los registros por parte del usuario
---------------------------------------
Modificaciones:
Fecha: 2018-09-19
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se cambia los campo input de cada sección por textarea, y se le agrega el plugin XEditable, para poderlos editar
---------------------------------------
**********/

$( document ).ready(function(){

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
				title: 'Ingrese la información',
				rows: 10,
				emptytext: '',
			});
	});
	
	
	/************************************************************************************************************************************************
	 * Validando datos extras
	 ************************************************************************************************************************************************/
	 setTimeout(function(){
		 
		 
		



		var intervalo2 = undefined;
		
		var __self = $("#semillerosdatosieoestudiantes-profecional_a")[0];
			
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
		
		
		var __self2 = $("#semillerosdatosieoestudiantes-docente_aliado")[0];
			
		$( __self2 ).on( 'chosen:showing_dropdown', function(){ 
			$( "div", $( __self2 ).parent() ).removeClass( 'chosen-container-single-nosearch' );
			$( "div input", $( __self2 ).parent() ).attr({readOnly:false});
			
		})

		$( "div input", $( __self2 ).parent() ).on( 'keyup', function(e){ 

			var slOriginal = $( __self2 );

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


		
		 
		 
		 
		 
		 
		$( "#semillerosdatosieoestudiantes-docente_aliado" ).each(function(x){
			
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
	
	$( "#semillerosdatosieoestudiantes-profecional_a" ).change(function(){
		
		$( "#list_docente_aliado option" ).attr({disabled:true});
		
		$( "#list_docente_aliado option["+this.value+"]" ).attr({disabled:false});
		
	});
	
	// $( "#semillerosdatosieoestudiantes-profecional_a,#semillerosdatosieoestudiantes-docente_aliado" ).change(function(){
		
		// var val = true;
		
		// val = ( $.trim( $( "#semillerosdatosieoestudiantes-profecional_a" ).val() ) != '' ? true : false ) && val;
		// val = ( $.trim( $( "#semillerosdatosieoestudiantes-docente_aliado" ).val() ) != '' ? true : false ) && val;
		
		// if( val )
		// {
			// $( "#guardar" ).val( 0 )
			// this.form.submit();
		// }
	// });
	
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
					// $( this ).data( 'type', 'textarea' );
				
					$( this )
						.attr({readOnly: true })
						.css({ 
							resize: 'none',
							height: '34px',
						})
						.editable({
							title: 'Ingrese la información',
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
													
													if( $( this.input ).data( "type" ) == 'number' )
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


				$( "select[id$=curso]", filaClonada ).each(function(){

					$( this ).chosen({
							"search_contains"			:true,
							"single_backstroke_delete"	:false,
							"disable_search_threshold"	:5,
							"placeholder_text_single"	:"Seleccione una opcion",
							"placeholder_text_multiple"	:"Seleccione algunas opciones",
							"no_results_text"			:"no se encontraron resultados",
						});

                    if (typeof $( "select[id$=curso]" ).change === "function") {

                        $( "select[id$=curso]" ).change(function () {

                            var  selectChange = $(this);
                            var gradoEstudiantes = $( this ).val();
                            var data = {
                                id: gradoEstudiantes[gradoEstudiantes.length-1]
                            };
                            $.post( 'index?r=semilleros-datos-ieo-estudiantes%2Fget-estudiantes', data )
                                .done(function( data ) {
                                    var curso = $('select option[value='+ gradoEstudiantes[gradoEstudiantes.length-1] +']').eq(0).text();
                                    $('#ModalLabel').text('Estudiantes del Curso  ' + curso);
                                    $('#listEstudiantes').empty();
                                    console.log(JSON.parse(data));
                                    $.each(JSON.parse(data), function( index, value ) {
                                        $('#listEstudiantes').append('<input onchange="agregarEstudiante($(this),\'' + selectChange.attr('id') +'\',\'' + curso +'\')" type="checkbox" name="selectChange" value="'+ index +'">'+ value +'<br>')
                                    });
                                });

                            $('#exampleModal').modal({ show: true})
                        });
                    }
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
				title: 'Ingrese la información',
				rows: 10,
				emptytext: '',
			});
	});

    if (typeof $( "select[id$=curso]" ).change === "function") {

        $( "select[id$=curso]" ).change(function () {

            var  selectChange = $(this);
            var gradoEstudiantes = $( this ).val();
            var data = {
                id: gradoEstudiantes[gradoEstudiantes.length-1]
            };
            $.post( 'index?r=semilleros-datos-ieo-estudiantes%2Fget-estudiantes', data )
                .done(function( data ) {
                    var curso = $('select option[value='+ gradoEstudiantes[gradoEstudiantes.length-1] +']').eq(0).text();
                    $('#ModalLabel').text('Estudiantes del Curso  ' + curso);
                    $('#listEstudiantes').empty();
                    var buscarCurso = selectChange.attr('id');
                    var cursos = $('[id^='+buscarCurso.substring(0,buscarCurso.length-5)+'estudiantes_id]').val();
                    $.each(JSON.parse(data), function( index, value ) {
                        $('#listEstudiantes').append('<input onchange="agregarEstudiante($(this),\'' + selectChange.attr('id') +'\',\'' + curso +'\')" type="checkbox" name="selectChange" id="estudiante_'+curso+'_'+index+'" value="'+ index +'">'+ value +'<br>')
						if (cursos !== ''){
                            $.each(JSON.parse(cursos), function( index, arraycurso ) {
                                console.log(arraycurso);
                                var idEstudiate = $('#estudiante_' + curso + '_' + arraycurso);
                                if ($.inArray(idEstudiate.val(), arraycurso) === 0){
                                    idEstudiate.prop('checked', true)
                                }
                            });
						}
                    });
                });

            $('#exampleModal').modal({ show: true});
        });
    }
});

function agregarEstudiante(ischeck, buscarIn, curso) {
    var estudiantes = $('[id^='+buscarIn.substring(0,buscarIn.length-5)+'estudiantes_id]');
    var countEstudiantes = $('[id^='+buscarIn.substring(0,buscarIn.length-5)+'cantidad_inscritos]');
    var countEstudiantesF = 0;
    var listEstudiante = estudiantes.val();
    if (listEstudiante === ''){
        listEstudiante = {};
    }else{
        listEstudiante = JSON.parse(listEstudiante)
    }

	if(ischeck.prop('checked') === true){
	    if (listEstudiante[curso] !== undefined){
            if ($.inArray(ischeck.val(), listEstudiante[curso]) !== 0){
                listEstudiante[curso][listEstudiante[curso].length] = ischeck.val();
			}
        }else{
            listEstudiante[curso] = [];
	        listEstudiante[curso][0] = ischeck.val();
        }

        estudiantes.val(JSON.stringify(listEstudiante));
	}

    if(ischeck.prop('checked') === false){
        if (listEstudiante[curso] !== undefined){
            if ($.inArray(ischeck.val(), listEstudiante[curso]) === 0){
                var toDelete = listEstudiante[curso].indexOf(ischeck.val());
                listEstudiante[curso].splice(toDelete, 1);
            }
        }
        estudiantes.val(JSON.stringify(listEstudiante));
    }

    $.each(listEstudiante, function( index, cursos ) {
        $.each(cursos, function( index2, estudiantes ) {
        	console.log(estudiantes);
            countEstudiantesF++;
        });
    });

    countEstudiantes.val(countEstudiantesF);
}