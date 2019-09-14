
var avenceSede = 1;
var subAvence = 0;
var avence = 0;
var avenceIeo = 0;

$( document ).ready(function()
{
    
	//solo numeron en la caja de estudiantes
	$('div[id *= ecactividadesise],[id *= actividad_1]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    
    $('div[id *= ecactividadesise],[id *= actividad_2]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    
    $('div[id *= ecactividadesise],[id *= actividad_3]').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
    });
    

});
	
//selector para seleccionar solo las celdas de estudiantes
//hace la sumatoria y la asigna a total
$('div[id *= ecactividadesise],[id *= actividad_1]').change(function() 
{
	total =0;
	
	//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
	ValId = $(this).attr("id");
	num = ValId.split("-");
	
	//cuando se presione un numero se hace la suma
	$('[id *= ecactividadesise-'+num[1]+'-actividad_1]').each(function( ) 
	{
        total += ($(this).val()*1);
	});
  
    porentaje = calcularPorcentajeActividad(total+1);
    $("#ecactividadesise-"+num[1]+"-actividad_1_porcentaje").val(porentaje);
    //se asigna la suma total a la caja de texto correspondiente
    
    //
    $("#ecactividadesise-"+num[1]+"-avance_sede").val(avenceSede+"%");
    $("#ecactividadesise-"+num[1]+"-avance_ieo").val(avenceIeo+"%");
    console.log(total);
    console.log(porentaje);

    
    
    

});

$('div[id *= ecactividadesise],[id *= actividad_2]').change(function() 
{
	total =0;
	
	//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
	ValId = $(this).attr("id");
	num = ValId.split("-");
	
	//cuando se presione un numero se hace la suma
	$('[id *= ecactividadesise-'+num[1]+'-actividad_2]').each(function( ) 
	{
        total += ($(this).val()*1);
	});
    
    setTimeout(function(){ 
        
        porentaje = calcularPorcentajeActividad(total+1);    
        //se asigna la suma total a la caja de texto correspondiente
        $("#ecactividadesise-"+num[1]+"-actividad_2_porcentaje").val(porentaje);
        $("#ecactividadesise-"+num[1]+"-avance_sede").val(avenceSede+"%");
        $("#ecactividadesise-"+num[1]+"-avance_ieo").val(avenceIeo+"%");
    
    }, 500);
    

});

$('div[id *= ecactividadesise],[id *= actividad_3]').change(function() 
{
	total =0;
	
	//numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
	ValId = $(this).attr("id");
	num = ValId.split("-");
	
	//cuando se presione un numero se hace la suma
	$('[id *= ecactividadesise-'+num[1]+'-actividad_3]').each(function( ) 
	{
        total += ($(this).val()*1);
	});
    
    setTimeout(function(){ 
        
        porentaje = calcularPorcentajeActividad(total+1);    
        //se asigna la suma total a la caja de texto correspondiente
        $("#ecactividadesise-"+num[1]+"-actividad_3_porcentaje").val(porentaje);
        $("#ecactividadesise-"+num[1]+"-avance_sede").val(avenceSede+"%");
        $("#ecactividadesise-"+num[1]+"-avance_ieo").val(avenceIeo+"%");
    
    }, 500);
    

});



function calcularPorcentajeActividad($value) {
    
    subAvence += $value;
    avance = (subAvence / 12) * 100;
    avenceIeo =  Math.round(((avance) / 500)*100);

    if($value == 1){
        avenceSede +=8;
        return "25%"
    }
    if ($value == 2){
        avenceSede +=16;
        
        return "50%"
    }
    if ($value == 3){
        avenceSede +=25;
       
        return "75%";
    }
    if ($value == 4){
        avenceSede +=33;
       
        return "100%";
    }
 }