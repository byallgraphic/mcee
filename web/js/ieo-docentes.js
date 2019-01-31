
$( document ).ready(function()
{
    
	//solo numeron en la caja de estudiantes
	$('div[id *= tiposcantidadpoblacion],[id *= tiempo_libre]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    
    $('div[id *= tiposcantidadpoblacion],[id *= edu_derechos]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('div[id *= tiposcantidadpoblacion],[id *= sexualidad]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('div[id *= tiposcantidadpoblacion],[id *= ciudadania]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('div[id *= tiposcantidadpoblacion],[id *= medio_ambiente]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('div[id *= tiposcantidadpoblacion],[id *= familia]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('div[id *= tiposcantidadpoblacion],[id *= directivos]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});

});

$('div[class *= docentes],[id *= cantidad]').keyup(function() 
{
	
	total =0;
	
	//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
	ValId = $(this).attr("class");
	num = ValId.split("-");

	
	//cuando se presione un numero se hace la suma
	$('[class *= docentes-'+num[2]+'-cantidad]').each(function( ) 
	{
	 	 total += $(this).val()*1;
	});

	$("#tiposcantidadpoblacion-"+num[2]+"-total").val(total);
	//se asigna la suma total a la caja de texto correspondiente
	//$("#estudiantesimpieo-"+num[1]+"-total").val(total);

});