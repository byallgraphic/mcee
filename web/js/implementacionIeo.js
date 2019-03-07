$( document ).ready(function()
{
    
	//solo numeron en la caja de estudiantes
	$('div[id *= estudiantesieo],[id *= grado]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});

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
$('div[id *= tiposcantidadpoblacion],[id *= docentes],[id *= psicoorientador],[id *= familia],[id *= directivos]').on('keyup mouseup',function(e) 
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
	$("#tiposcantidadpoblacion-"+num[1]+"-total").val(total);

});