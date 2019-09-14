/**********
Versión: 001
Fecha: 2019-01-29
Desarrollador: Edwin Molina Grisales
Descripción: Ciclos
---------------------------------------
**********/

	/**
	 * Nota: El objeto modelSemana es creado desde la vista _form
	 */
	
	//Máximo de semanas permitidas para agregar
	var maxSemanasPermitidas = 6;
	var minSemanasPermitidas = $( "[id^=dv-semana]" ).length-1;
	
	//Formato de fechas por defecto
	$.fn.datepicker.defaults.language 	= "es";
	$.fn.datepicker.defaults.format 	= "yyyy-mm-dd";
	
	var consecutivosSemana = totalSemanas;
	
	$( "#btn-guardar" ).addClass( 'disabled' ).attr({disabled:true});
	

	//Siempre hay un objeto semana y este se usa para replicar las demás semanas
	var objSemana = $( "#dv-semana-0" );
	
	//Remuevo el objSemana para que no se vea en la vista y al hacer el submit no se envíe la información
	objSemana.remove();
	
	/***********************************************************************************
	 * Desde aquí quito atributos y clases que no requiero para los nuevos elmentos
	 * que clono del elemento objSemana
	 ***********************************************************************************/
	
	//Quito las clases no necesarias que se encuentran en el div-semana-0
	$( ".form-group", objSemana ).each(function(){
		//Dejo solo la clase form group
		$( this )
			.removeClass()
			.addClass( "form-group" );
	});

	//Los campos que tengan for, que son los label los dejo vacio
	$( "[for]", objSemana ).attr({'for':''});
	
	//Y los ids y name los dejo vacio de todos los campos input y textarea
	// $( "input:text,textarea", objSemana ).prop({id: '', name: '' });
	
	
	/**
	 * funciones para agregar contenido de semanas
	 */
	$( ".btn-add-semanas" ).click(function(){
		
		//No dejo agregar más del máximo de semanas permitidas
		if( $("[id^=dv-semana]").length < maxSemanasPermitidas ){
			
			//Aumento consecutivo de la semana
			consecutivosSemana++;
			
			/**
			 * clono la semana original y la agrego al div que contiene la información de todas 
			 * las semanas (dvSemanas)
			 */
			var clon = objSemana.clone();
			clon.appendTo( "#dvSemanas" );
			
			//Todos los inputs tipo text del clone son fechas
			$( "input:text", clon )
				.each(function(){
					
					//this se refiere al campo input
					
					//Se hace de acuerdo con parent por que originalmente lo hace así el yii por defecto para las fechas
					
					$( this ).parent().datepicker({
						autoclose	: true,
						format		: "yyyy-mm-dd",
						language	: "es",
						startDate	: $( "#gcciclos-fecha_inicio" ).datepicker( "getDate" ),
						endDate		: $( "#gcciclos-fecha_finalizacion" ).datepicker( "getDate" ),
					});
				});
			
			//Cambio los ids y names de cada campo
			$( "input:text,input:hidden,textarea", clon ).each(function(){
				
				var attribute = this.id.substr( modelSemana.formName.length+3 );
				
				$( this ).prop({
					id	: modelSemana.formName.toLowerCase()+"-"+consecutivosSemana+"-"+attribute,
					name: modelSemana.formName+"["+consecutivosSemana+"]["+attribute+"]",
				});
				
			});
			
			//Al label con atributo for le dejo el mismo id recién puesto
			$( "input:text", clon ).each(function(){
				$( this ).parent().parent().parent().addClass( 'field-'+this.id );
				$( "[for]", $( this ).parent().parent().parent() ).attr({'for':this.id});
				
				

				
			});
			
			$( "input:text,textarea", clon ).each(function(){
				
				$('#w0').yiiActiveForm('add', {
					id			: this.id,
					name		: this.name,
					container	: '.field-'+this.id,
					input		: '#'+this.id,
					error		: '.help-block',
					validate	: function (attribute, value, messages, deferred, $form) {
									yii.validation.required(value, messages, {message: "El campo no puede estar vacío"});
								},
				});
			});
			
			//Al label con atributo for le dejo el mismo id recién puesto
			$( "textarea", clon ).each(function(){
				$( this ).parent().parent().addClass( 'field-'+this.id );
				$( "[for]", $( this ).parent().parent() ).attr({'for':this.id});
			});
			
			//Por último cambio el titulo de todas las semanas para que se vea siempre en orden
			$( "[id=semana-title]", $( "#dvSemanas" ) ).each(function(x){
				
				var con = x+1;
				$( this ).html( 'Semana '+con );
			});
			
			//Deshabilito el boton agregar en caso de llegar al máximo
			if( consecutivosSemana == maxSemanasPermitidas ){
				$( ".btn-add-semanas" ).addClass( 'disabled' ).attr({disabled:true});
			}
			
			$( "gcsemanas-"+consecutivosSemana+"-fecha_inicio" ).parent().datepicker(function(){
				
			});
			
			//Habilito siempre boton eliminar
			$( ".btn-remove-semanas" ).removeClass( 'disabled' ).attr({disabled:false});
			
			$( "#btn-guardar" ).removeClass( 'disabled' ).attr({disabled:false});
		}
	});

	$( ".btn-remove-semanas" ).click(function(){
		
		$( "[id^=dv-semana]" ).last().remove();
		
		//habilito siempre boton agregar
		$( ".btn-add-semanas" ).removeClass( 'disabled' ).attr({disabled:false});
		
		//Deshabilito solo si no hay nada más que eliminar
		if( $( "[id^=dv-semana]" ).length == minSemanasPermitidas ){
			$( ".btn-remove-semanas" ).addClass( 'disabled' ).attr({disabled:true});
			
			$( "#btn-guardar" ).addClass( 'disabled' ).attr({disabled:true});
		}
	}).addClass( 'disabled' ).attr({disabled:true});

	
	//Al seleccionar la fecha la fecha de inicio es igual o mayor a fecha
	$( "#gcciclos-fecha" ).change(function(){
		$( "#gcciclos-fecha_inicio" )
			.parent().datepicker( 'setStartDate', $( this ).parent().datepicker( 'getDate' ) );
	});
	
	$( "#gcciclos-fecha_inicio" ).change(function(){
		
		$( "#gcciclos-fecha_finalizacion" )
			.parent().datepicker( 'setStartDate', $( this ).parent().datepicker( 'getDate' ) );
			
		$( "#gcciclos-fecha_cierre" )
			.parent().datepicker( 'setStartDate', $( this ).parent().datepicker( 'getDate' ) );
	});
	
	$( "#gcciclos-fecha_finalizacion" ).change(function(){
			
		$( "#gcciclos-fecha_cierre" )
			.parent().datepicker( 'setEndDate', $( this ).parent().datepicker( 'getDate' ) );
		
		$( "#gcciclos-fecha_maxima_acceso" )
			.parent().datepicker( 'setEndDate', $( this ).parent().datepicker( 'getDate' ) );
	});