$( document ).ready(function(){
	
	
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
		$( ".title, .title2, .title3", this ).each(function(){
			
			//Para este caso this es el div con clase .title
			var alto = $( this ).prop("scrollHeight");
			$( this ).css({ height: alto });
			
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
	
	$( "[id^=btnAddFila]" ).each(function(){
		
		$( this ).click(function(){
			
			var id = this.id.substr( "btnAddFila".length );
			
			var filaNueva = $( "#dvFilaSesion"+id ).clone();
			
			$( "#dvSesion"+id ).append( filaNueva );
			
			$( "#btnRemoveFila"+id ).css({ display: "" });
			
			//La fila que se clona siempre está oculta, por tal motivo la muestro
			$( filaNueva ).css({display:''});
			
			//Pongo todos los textarea del item del acordeon clonado para que se siempre editable
			$( "textarea", filaNueva ).each(function(x){
		
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
		});
		
	});
	
	$( "[id^=btnRemoveFila]" ).each(function(){
		
		$( this ).click(function(){
			
			var id = this.id.substr( "btnRemoveFila".length );
			var total = $( "[id^=dvFilaSesion"+id+"]"  ).length;
			
			if( total > 1 ){
				
				if( total == 2 ){
					$( this ).css({ display: "none" });
				}
				
				$( "[id=dvFilaSesion"+id+"]" ).last().remove()
				
			}
		});
	});
	
});