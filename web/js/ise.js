
$( document ).ready(function()
{
    
	//solo numeron en la caja de estudiantes
	$('div[id *= ecestudiantesise],[id *= grado]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});

});
	

$('div[id *= ecestudiantesise],[id *= grado]').on('keyup mouseup',function(e) 
{

	total =0;
	console.log('a');
	//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
	ValId = $(this).attr("id");
	num = ValId.split("-");
	
	//cuando se presione un numero se hace la suma
	$('[id *= ecestudiantesise-'+num[1]+'-grado]').each(function( ) 
	{
	  total += $(this).val()*1;
	});

	//se asigna la suma total a la caja de texto correspondiente
	$("#ecestudiantesise-"+num[1]+"-total").val(total);

});