/**********
Versión: 001
Fecha: 27-03-2018
---------------------------------------
Modificaciones:
Fecha: 01-05-2018
Persona encargada: Edwin Molina Grisales
Cambios realizados: Se agrega filtro por AREAS DE ENSEÑANZA al CRUD
---------------------------------------
**********/

$( document ).ready(function() {
	
	if(idSedes == -1)
	{
		
		swal({
		  title: 'Sede no Asignada',
		  text: "Debe seleccionar una sede",
		  type: 'warning',
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Aceptar',
		  allowEscapeKey: false,
		  allowOutsideClick: false
		}).then((result) => {
		  if (result.value) {
			$( "#cambiarSede" ).trigger( "click" );
		  }
		})
		
		
	}
	
	
});

