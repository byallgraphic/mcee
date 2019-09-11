$( document ).ready(function() {
  
  $("[id*='idModulo']").hide()
  
 
 $.get( "index.php?r=permisos/obtener-permisos",
			function( data )
				{			
					
					if (data == "vacio"  )
					{
						 $("[id*='idModulo']").show();
					}
					else
					{
						$.each( data, function( index, value )
						{
							$("#idModulo" +value.id_modulos ).show()
							// $("#idModulo" +value.id_modulos ).css("display","none");
						});
					}
					
					// alert(data[0].id_modulos);
				},
		"json");   
});




//informacion de los permisos que tiene el perfil 





