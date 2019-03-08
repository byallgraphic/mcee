
$( document ).ready(function()
{
    
});


$('div[id *= ecactividadesise],[id *= actividad_1]').change(function() 
{
    ValId = $(this).attr("id");
    num = ValId.split("-");    
    actividad_1 = $('[id *= ecactividadesise-'+num[1]+'-actividad_1]').val();
    $("#ecactividadesise-"+num[1]+"-actividad_1_porcentaje").val(calcularPorcentajeActividad(actividad_1));
    calcularAvances(num[1]);
});

$('div[id *= ecactividadesise],[id *= actividad_2]').change(function() 
{
    ValId = $(this).attr("id");
    num = ValId.split("-");    
    actividad_2 = $('[id *= ecactividadesise-'+num[1]+'-actividad_2]').val();
    $("#ecactividadesise-"+num[1]+"-actividad_2_porcentaje").val(calcularPorcentajeActividad(actividad_2));
    calcularAvances(num[1]);
});

$('div[id *= ecactividadesise],[id *= actividad_3]').change(function() 
{
    ValId = $(this).attr("id");
    num = ValId.split("-");    
    actividad_3 = $('[id *= ecactividadesise-'+num[1]+'-actividad_3]').val();
    $("#ecactividadesise-"+num[1]+"-actividad_3_porcentaje").val(calcularPorcentajeActividad(actividad_3));
    calcularAvances(num[1]);
});


function calcularAvances(num)
{
    setTimeout(function()
	{
        
        total ="";
        avance_sede ="";
        //numero del que identifica a la caja de texto Estudiantes Gra para saber a que total debe sumar
        
        $('[class *= avance-'+num+'-sede]').each(function( ) 
        {
            total += $(this).val();
        });

        total = total.split("%");

        sum = 0;
        total.forEach(function(numero){
            sum+= numero != '' ? parseFloat(numero) : 0;
        });



        $("#ecactividadesise-"+num+"-avance_sede").val((sum/3).toFixed(1)+"%");
       
        $('[class *= avance-sede]').each(function( ) 
        {
            avance_sede += $(this).val();
        });

        avance_sede = avance_sede.split("%")

        sum_avance = 0;
        avance_sede.forEach(function(numero){
            sum_avance += numero != '' ? parseFloat(numero) : 0;
        });    

        numItems = $('.avance-sede').length;        
        $(".avance-ieo").val(((sum_avance / (numItems*100) )*100).toFixed(1)+"%");
        
    }, 1000);  
};


function calcularPorcentajeActividad($value) {
    console.log($value);
    if($value == 1){
        return "25%"
    }
    if ($value == 2){  
        return "50%"
    }
    if ($value == 3){
        return "75%";
    }
    if ($value == 4){
        return "100%";
    }
 }