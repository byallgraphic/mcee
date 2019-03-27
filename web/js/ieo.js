$( document ).ready(function()
{
    
	//solo numeron en la caja de estudiantes
	$('div[id *= estudiantesieo],[id *= grado]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});
	
	idTipoInforme = $("#ieo-id_tipo_informe").val();
	
});
	
//selector para seleccionar solo las celdas de estudiantes
//hace la sumatoria y la asigna a total
$('div[id *= estudiantesieo],[id *= grado]').on('keyup mouseup',function(e) 
{
	total =0;
	
	//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
	ValId = $(this).attr("id");
	num = ValId.split("-");
	
	//cuando se presione un numero se hace la suma
	$('[id *= estudiantesieo-'+num[1]+'-grado]').each(function( ) 
	{
	  total += $(this).val()*1;
	});

	//se asigna la suma total a la caja de texto correspondiente
	$("#estudiantesieo-"+num[1]+"-total").val(total);

});



//selector para seleccionar solo las celdas de docentes
//hace la sumatoria y la asigna a total
$('div[id *= tiposcantidadpoblacion],[id *= tiempo_libre],[id *= edu_derechos],[id *= sexualidad],[id *= ciudadania],[id *= medio_ambiente],[id *= familia],[id *= directivos]').on('keyup mouseup',function(e) 
{
	//validacion especifica para cada reporte
	if(idTipoInforme == 2)
	{
		total =0;
		
		// numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
		ValId = $(this).attr("id");
		num = ValId.split("-");
		
		// cuando se presione un numero se hace la suma
		total += $("#tiposcantidadpoblacion-"+num[1]+"-tiempo_libre").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-edu_derechos").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-sexualidad").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-ciudadania").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-medio_ambiente").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-familia").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-directivos").val() * 1 ;
		
		// se asigna la suma total a la caja de texto correspondiente
		$("#tiposcantidadpoblacion-"+num[1]+"-total").val(total);
	}
});

//selector para seleccionar solo las celdas de docentes
//hace la sumatoria y la asigna a total
$('div[id *= tiposcantidadpoblacion],[id *= docentes],[id *= familia],[id *= directivos]').on('keyup mouseup',function(e) 
{
	//validacion especifica para cada reporte
	if(idTipoInforme == 14)
	{
		total =0;
		
		//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
		ValId = $(this).attr("id");
		num = ValId.split("-");
		
		//cuando se presione un numero se hace la suma
		total += $("#tiposcantidadpoblacion-"+num[1]+"-docentes").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-familia").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-directivos").val() * 1 ;
		
		//se asigna la suma total a la caja de texto correspondiente
		$("#tiposcantidadpoblacion-"+num[1]+"-total").val(total+"");
	}

});


//selector para seleccionar solo las celdas de docentes
//hace la sumatoria y la asigna a total
$('div[id *= tiposcantidadpoblacion],[id *= docentes],[id *= psicoorientador],[id *= familia],[id *= directivos]').on('keyup mouseup',function(e) 
{
	//validacion especifica para cada reporte
	if(idTipoInforme == 26)
	{
		total =0;
		
		//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
		ValId = $(this).attr("id");
		num = ValId.split("-");
		
		//cuando se presione un numero se hace la suma
		total += $("#tiposcantidadpoblacion-"+num[1]+"-docentes").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-psicoorientador").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-familia").val() * 1 ;
		total += $("#tiposcantidadpoblacion-"+num[1]+"-directivos").val() * 1 ;
		
		//se asigna la suma total a la caja de texto correspondiente
		$("#tiposcantidadpoblacion-"+num[1]+"-total").val(total+"");
	}

});





