
	function totalSesiones(){
		
		var total = $( "[id^=dvFilaSesion]" ).length*1;
		
		$( "#semillerosticcondicionesinstitucionalesestudiantes-total_sesiones" ).val( total );
	}
	
	function promedioEstudiantes(){
		
		var total = 0;
		
		var estudiantes 	= $( "#semillerosticcondicionesinstitucionalesestudiantes-participantes_por_curso" ).val()*1;
		var sesiones 		= $( "[id^=dvFilaSesion]" ).length*1;
		
		if( sesiones > 0 )
			total = Math.round( estudiantes/sesiones );
		
		$( "#semillerosticcondicionesinstitucionalesestudiantes-total_estudiantes" ).val( total );
	}
	
	
	//Calculo el total de participacion de sesiones y se replica para cuando se agregue campo nuevo
	function totalEstudiantesParticipantes( campo, inicial ){
		
		var _self = campo;
		
		var total = 0;
		
		if( inicial ){
			total = inicial*1;
		}
		
		//Total de cursos
		var cursos = $( "#semillerosticdatosieoprofesionalestudiantes-curso_participantes option:selected" ).text().split(",").length;
		
		$( "[id$=estudiantes_participantes]" ).each(function(){
			if( this != _self )
				total += this.value*1;
		});
		
		$( "#semillerosticcondicionesinstitucionalesestudiantes-participantes_por_curso" ).val( total );
		
		if( cursos > 0 )
			$( "#semillerosticcondicionesinstitucionalesestudiantes-promedio_estudiantes_por_curso" ).val( Math.round( total/cursos ) );
		
		promedioEstudiantes();
		
	}
	
	$( "[id$=estudiantes_participantes]" ).on( "save", function( e, params ){
		totalEstudiantesParticipantes( this, params.newValue )
	});
	
	// //Calculo el total de participacion de sesiones y se replica para cuando se agregue campo nuevo
	// $( "[id$=estudiantes_participantes]" ).on( "save", function( e, params ){
		
		// var _self = this;
		
		// var total = params.newValue*1;
		
		// //Total de cursos
		// var cursos = $( "#semillerosticdatosieoprofesionalestudiantes-curso_participantes" ).val().split(",").length;
		
		// $( "[id$=estudiantes_participantes]" ).each(function(){
			// if( this != _self )
				// total += this.value*1;
		// });
		
		// $( "#semillerosticcondicionesinstitucionalesestudiantes-participantes_por_curso" ).val( total );
		
		// if( cursos > 0 )
			// $( "#semillerosticcondicionesinstitucionalesestudiantes-promedio_estudiantes_por_curso" ).val( Math.round( total/cursos ) );
		
		// promedioEstudiantes();
		
	// });
	
	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitles = [
		"Número de estudiantes participantes",
		"Número de Apps 0.0 desarrolladas e implementadas",
		"Nombre de las aplicaciones desarrolladas",
		"Tipo de Acción",
		"Descripción",
		"Responsable de la ejecución de la Acción",
		"Tiempo de desarrollo de las aplicaciones (Horas reloj)",
		"TIC (infraestructura existente en la IEO)",
		"Tipo de Uso del Recurso",
		"Digitales",
		"Tipo de Uso del Recurso",
		"Escolares (No TIC)",
		"Tipo de Uso del Recurso",
		"Tiempo de uso de los recursos TIC en el diseño de las App 0.0 (Horas)",
		"Número",
		"Tipo de obras",
		"Indice de temas escolares disciplinares abordados a través de las App 0.0",
		"Numero de pruebas realizadas a la aplicación",
		"Número de disecciones realizadas a la aplicación",
		"OBSERVACIONES GENERALES",
	];
	
	//Copio los titulos y los dejo como arrary para que se más fácil usarlos en los popups
	var arrayTitlesCondicionesInstitucionales = [
		"Por parte de la IEO",
		"Por parte de UNIVALLE",
		"Por parte de la SEM",
		"OTRO",
		"Número de Sesiones participantes por curso",
		"Número de estudiantes participantes por curso (Promedio)",
		"Total sesiones por IEO",
		"Total estudiantes IEO (Promedio)",
	];
	
	//this para este caso es el panel al que se dió click
	$( ".title" ).each(function(x){
		
		//Para este caso this es el div con clase .title
		var alto = $( this ).prop("scrollHeight");
		
		//pongo el span del tamaño requerido
		$( "span", this ).each(function(){
			
			//this es el span
			$( this ).css({ height: alto });
		});
	});
	
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
	
	//Se agrega editables para los campos textarea de condiciones institucionales
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
	
	//Se agrega editables para los campos textarea de condiciones institucionales
	$( "textarea[id^=semillerosticejecucionfaseiiestudiantes]" ).each(function(x){
		
		if( $( this ).data( "typevalidation" ) == "number" )
		{
			$( this ).data( 'type', 'number' );
		}
		else{
			$( this ).data( 'type', 'textarea' );
		}
	
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
	
	
	
	/************************************************************************************************************************************************
	 * 
	 ************************************************************************************************************************************************/
	 setTimeout(function(){
		 
		$( "input:text[id^=datossesiones]" ).each(function(x){
			
			$('#w0').yiiActiveForm('find', this.id ).validate = function (attribute, value, messages, deferred, $form) {
				
				var cmp = $( "#"+this.id ).val();
				
				var hayCamposVacios = false;
				/*$( "textarea[id^=semillerosticejecucionfaseiiestudiantes]", $( this.container ).parent() ).each(function(){
					if( $( this ).val() == '' ){
						hayCamposVacios = true;
					}
				});*/
				
				
				//Si no se ha ingresado fecha y mas de una fila (ejecucion de fase)
				/*if( cmp == "" && $( "[id^=dvFilaSesion]", $( this.container ).parent() ).length == 0 ){
					// alert(1);
					return true;
				}*/
				/*else if( cmp != "" && $( "[id^=dvFilaSesion]", $( this.container ).parent() ).length > 0 && !hayCamposVacios ){
					// alert(1);
					return true;
				}
				else{
					// alert(2);
					if( cmp == "" )
						yii.validation.required(cmp, messages, {"message":"No puede estar vacío"});
					else
						yii.validation.addMessage(messages,"Debe agregar por lo menos una ejecución de fase y llenar todos los campos", cmp );
					 
					return false;
				}*/
			}
		});
	 }, 5000 );
	
	
	// /********************************************************************************
	 // * Si el usuario cambia el profesional o el curso de los participantes
	 // * se recarga la página con los nuevos datos y no se guarda nada
	 // ********************************************************************************/
	// $( "#semillerosticdatosieoprofesionalestudiantes-id_profesional_a" ).change(function(){
		
		// // if( $( "#semillerosticdatosieoprofesionalestudiantes-id_profesional_a" ).val() != '' && $( "#semillerosticdatosieoprofesionalestudiantes-curso_participantes" ).val() != '' )
		// if( $( this ).val() != '' )
		// {
			// $( "#guardar" ).val(0)
			// this.form.submit();
		// }
	// });
	
    $( "#semillerosticdatosieoprofesionalestudiantes-curso_participantes" ).change(function(){
        var estudiantes_id = $('#semillerosticdatosieoprofesionalestudiantes-estudiantes_id').val();
        var keysCursos = [];

        if (estudiantes_id !== ''){
            $.each(JSON.parse(estudiantes_id), function( index, value ) {
                keysCursos[index] = index;
            });
        }
        // if( $( "#semillerosticdatosieoprofesionalestudiantes-id_profesional_a" ).val() != '' && $( "#semillerosticdatosieoprofesionalestudiantes-curso_participantes" ).val() != '' )
        if( $( this ).val() != '' )
        {
            // $( "#guardar" ).val(0);

            var  selectChange = $(this);
            var gradoEstudiantes = $( this ).val();
            var data = {
                id: gradoEstudiantes[gradoEstudiantes.length-1]
            };
            var curso = '';
            $.post( 'index?r=semilleros-datos-ieo-estudiantes%2Fget-estudiantes', data )
                .done(function( data ) {
                    curso = $('select option[value='+ gradoEstudiantes[gradoEstudiantes.length-1] +']').eq(0).text();
                    $('#ModalLabel').text('Estudiantes del Curso  ' + curso);
                    $('#listEstudiantes').empty();
                    var buscarCurso = selectChange.attr('id');
                    var cursos = $('[id^='+buscarCurso.substring(0,buscarCurso.length-5)+'estudiantes_id]').val();
                    $.each(JSON.parse(data), function( index, value ) {
                        $('#listEstudiantes').append('<input onchange="agregarEstudiante($(this),\'' + selectChange.attr('id') +'\',\'' + curso +'\')" type="checkbox" name="selectChange" id="estudiante_'+curso+'_'+index+'" value="'+ index +'">'+ value +'<br>')
                        /*if (cursos !== ''){
                            $.each(JSON.parse(cursos), function( index, arraycurso ) {
                                console.log(arraycurso);
                                var idEstudiate = $('#estudiante_' + curso + '_' + arraycurso);
                                if ($.inArray(idEstudiate.val(), arraycurso) === 0){
                                    idEstudiate.prop('checked', true)
                                }
                            });
                        }*/
                    });

                    var estudiantes = $('#semillerosticdatosieoprofesionalestudiantes-estudiantes_id');
                    var listEstudiante = estudiantes.val();
                    if (listEstudiante === ''){
                        listEstudiante = {};
                    }else{
                        listEstudiante = JSON.parse(listEstudiante)
                    }

                    if (estudiantes_id !== ''){
                        if(!(curso in JSON.parse(estudiantes_id))) {
                            $('#exampleModal').modal({ show: true});
                        }
                    }else {
                        $('#exampleModal').modal({ show: true});
                    }

                    listEstudiante[curso] = [];
                    listEstudiante[curso][0] = '';

                    $('.search-choice-close').click(function () {
                        curso = $(this).parent().find('span').text();
                        console.log(curso);
                        delete listEstudiante[curso];

                        estudiantes.val(JSON.stringify(listEstudiante));
                    });

                    estudiantes.val(JSON.stringify(listEstudiante));
                });
        }
    });


    function agregarEstudiante(ischeck, buscarIn, curso) {
        var estudiantes = $('#semillerosticdatosieoprofesionalestudiantes-estudiantes_id');
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

        // $('#guardarEstudiantes').click(function () {
            // $( "#semillerosticdatosieoprofesionalestudiantes-id_profesional_a" ).submit()
        // });
    }
	
	
	$( "[id^=container]" ).each(function(){
		
		var _container = $( this );
		
		var sesion = $( _container ).attr( 'sesion' );
		
		var filaNueva = $( "#dvFilaSesion-"+sesion+"-0", _container );
		
		//remuevo la primera fila ya que solo se usa para poderla clonar despues
		//Y nada de esa fila se guarda
		filaNueva.remove();
		
		//No dejo borrar los datos ya guardados
		var min = $( "[id^=dvFilaSesion]", _container ).length;
		
		//Este sirve para cambiar los id de acuerdo al cosecutivo que tenga este
		var consecutivo = $( "[id^=dvFilaSesion]", _container ).length+1;
		
		/**
		 * Le doy funcionalidad a los botones de agregar
		 * Se hace un each de cada boton
		 */
		$( "#btnAddFila"+sesion ).each(function(){
			 
			//this es el boton agregar
			$( this ).click(function(){
				
				var filaClonada = filaNueva.clone();
				
				_container.append( filaClonada );
				
				$( "#btnRemoveFila"+sesion ).css({display:''});
				
				//A todos los texareas les pongo que sea editables
				$( "textarea", filaClonada ).each(function(x){
		
					//Agrego data-type textarea para que el popup editable salga como textarea
					//Sin esto mostraría un input para ingresar información
					if( $( this ).data( "typevalidation" ) == "number" )
					{
						$( this ).data( 'type', 'number' );
					}
					else{
						$( this ).data( 'type', 'textarea' );
					}
				
					$( this )
						.attr({readOnly: true })
						.css({ 
							resize: 'none',
							height: '34px',
						})
						.editable({
							title: arrayTitles[x],
							rows: 10,
							emptytext: '',
						});
				});
				
				//Cambiando los id
				//A todos los texareas, input y select que tenga la fila clonada
				$( "textarea,input", filaClonada ).each(function(){
		
					//this es el respectivo textarea
					var _campo = this;
					
					$( _campo ).prop({
						id		: _campo.id.replace( /-[0-9]+-[0-9]+-/gi, "-"+sesion+"-"+consecutivo+"-" ),
						name	: _campo.name.replace( /\[[0-9]+\]\[[0-9]+\]/gi, "["+sesion+"]["+consecutivo+"]" ),
					});
					
					$( _campo ).parent()
						.removeClass( "field-"+this.id.replace( /-[0-9]+-[0-9]+-/gi, "-"+sesion+"-0-" ) )
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
													
													if( $( this.input ).data( "typevalidation" ) == "number" ){
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
				
				//Calculando eltotal de participantes
				//save es le metodo que lanza el plugin editable antes de actualizar el campo
				$( "[id$=estudiantes_participantes]" ).on( "save", function( e, params ){
					totalEstudiantesParticipantes( this, params.newValue );
				});
				
				//Se calcula el total de sesiones
				totalSesiones()
				
				consecutivo++;
			});
		});
		
		/**
		 * Le doy funcionalidad a los botones de eliminar
		 * Se hace un each de cada boton
		 */
		$( "#btnRemoveFila"+sesion ).each(function(){
			 
			//this es el boton agregar
			$( this ).click(function(){
				
				if( $( "[id^=dvFilaSesion]", _container ).length == min+1 ){
					$( this ).css({display:'none'});
				}
				
				$( "[id^=dvFilaSesion]", _container ).last().remove();
				
				//Se calccula el total de estudiantes participantes
				totalEstudiantesParticipantes( null, 0 );
				
				//Se calcula el total de sesiones
				totalSesiones();
			});
		});
	});
