/**********
---------------------------------------
Modificaciones:
Fecha: 09-01-2019
Persona encargada: Edwin Molina - Johan Ospina
Cambios realizados: Se mejora script para pedir la institución y la sede. Los script correspondientes js están todo incluidos en header.js.
---------------------------------------
Fecha: 17-09-2018
Persona encargada: Oscar David Lopez Villa
Cambios realizados: Se habilita el swal para cambio de sede
---------------------------------------
**********/ 

//extraer el valor de institucion seleccionada de las cookies
function readCookie(name) {

  return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + name.replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;

}



$( "#cambiarInstitucion" ).click(function() 
{
    var datosInstitucion = [];

    $.get( "index.php?r=instituciones%2Finstituciones", function(data) {
    })
    .done(function( data ) {

       

        //que institucion selecciono
        const {value: institucion} = swal({

            closeOnConfirm: false,
            closeOnCancel: false,
            allowOutsideClick: false,
            title: 'Seleccione una Institución',
            input: 'select',
            inputOptions: $.parseJSON(data),
            inputPlaceholder: 'Seleccione...',
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value !== '')
                    {

                        //crear variable de session que tenga la institucion que seleciono
                        var Institucion = $.get( "index.php?instituciones="+value, function(data)
                        {
                            $("#InstitucionSede").html(" ");

                            $("#InstitucionSede").append(data.replace('"', ' ').replace('"', ' '));
                            
                        });

                        return fetch('index.php?r=sedes/sedes&idInstitucion='+value)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                else{
                                    location.reload();
                                }
                            });
                    }
                    else
                    {
                        resolve('Debe seleccionar una institucion')
                    }
                })
            }
        })
    });
});


$( "#cambiarSede" ).click(function() 
{
	
	institucionJS = readCookie( "institucionJs" );
		return fetch('index.php?r=sedes/sedes&idInstitucion='+institucionJS)
			  .then(response => {
				if (!response.ok) {
				  throw new Error(response.statusText)
				}
				(prueba) =   response.json()
		
		
		//que institucion selecciono
		const {value: institucion} = swal({
		  title: 'Seleccione una Sede',
		  input: 'select',
		  inputOptions: (prueba),
		  inputPlaceholder: 'Ninguna Sede',
		  allowEscapeKey: false,
		  allowOutsideClick: false,
		  inputValidator: (value) => {
			return new Promise((resolve) => {
			  if (value !== '') 
			  {  
				  //crear variable de session que tenga la institucion que seleciono
				 var Institucion = $.get( "index.php?sede="+value, function() 
					{
						
					resolve(window.location.reload(true));
					})
			  }
			  else 
			  {
				   var sede = $.get( "index.php?sede=-1", function() 
					{
					})
					resolve(window.location.reload(true));
			  }
			})
		  }
		})
	 })
});

$( document ).ready(function() {
    $('#searchLeft').keyup(function(){
        var searchText = $(this).val();

        $('ul > li').each(function(){
            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText.toUpperCase()) !== -1;

            $(this).toggle(showCurrentLi);
            $('.treeview-menu').css('display','block')

        });
    });
});