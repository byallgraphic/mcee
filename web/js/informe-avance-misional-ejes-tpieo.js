$( document ).ready(function(){
	
$("#divPorcentajes").hide();
	
});

//semaforizacion segun documento 3A
function colorBarra(valor)
{
	color ="";
	if(valor < 50)
	{
		color = "red";
	}
	else if(valor < 70)
	{
		color = "yellow";
	}
	else if (valor < 100)
	{
		color = "green";
	}
	else
	{
		color ="blue";
	}
	return color;
}

//calcula los porcentaje de avances 
$( "#porcentajes" ).click(function() 
{
	
	$("#divPorcentajes").toggle();
	var i;
	valor = 0;
	for (i = 1; i <=49 ; i++) 
	{ 
		valor += $("#ecavances-"+i+"-estado_actual").val()*1;
		
		switch (i) 
		{
			
			//Proyecto Pedagógicos Transversales primeros 3 indicadores
			case 3:
				PorcentajeAvanceProceso     = Math.trunc(((valor)/12)*100);
				valor =0;
			break;
			
			case 6:
				porcentajeAvanceEstrategias = Math.trunc(((valor)/12)*100);
				valor =0;
			break;
			
			case 9:
				porcentajeAvanceOrientaciones = Math.trunc(((valor)/12)*100);
				valor =0;
				i = 14
			break;
			//Proyecto Pedagógicos Transversales
			
			//Proyecto de Servicio Social Estudiantil primeros 3 indicadores
			case 17:
				porcentajeAvanceGestion= Math.trunc(((valor)/12)*100);
				valor =0;
			break;
			
			case 20:
				porcentajeAvanceProyectos = Math.trunc(((valor)/12)*100);
				valor =0;
			break;
			
			case 23:
				porcentajeAvanceCompetencias= Math.trunc(((valor)/12)*100);
				valor =0;
				i=29;
			break;
			//Proyecto de Servicio Social Estudiantil
			
			// Articulación Familiar primeros 3 indicadores
			case 32:
				porcentajeAvanceAcompanamiento = Math.trunc(((valor)/12)*100);
				valor =0;
			break;
			
			case 35:
				porcentajeAvanceComunicacion= Math.trunc(((valor)/12)*100);
				valor =0;
			break;
			
			case 38:
				porcentajeAvanceDotar= Math.trunc(((valor)/12)*100);
				valor =0;
				i=44;
			break;
			// Articulación Familiar 
			
			
			//Proyecto Fortalecimiento de Competencias Básicas desde la Transversalidad indicador
		
			case 49:
				porcentajeAvanceEstado= Math.trunc(((valor)/20)*100);
				valor =0;
			break;
			
			//Proyecto Fortalecimiento de Competencias Básicas desde la Transversalidad 
			
		}	
	}
	
	//Proyecto Pedagógicos Transversales 3 indicadores
	$("#porcentajeAvance1").css({"width": ""+PorcentajeAvanceProceso      +"%","background-color":""+colorBarra(PorcentajeAvanceProceso)}).text(PorcentajeAvanceProceso+"%");	
	$("#porcentajeAvance2").css({"width": ""+porcentajeAvanceEstrategias  +"%","background-color":""+colorBarra(porcentajeAvanceEstrategias)}).text(porcentajeAvanceEstrategias+"%");
	$("#porcentajeAvance3").css({"width": ""+porcentajeAvanceOrientaciones+"%","background-color":""+colorBarra(porcentajeAvanceOrientaciones)}).text(porcentajeAvanceOrientaciones+"%");
	
	//Proyecto de Servicio Social Estudiantil 3 indicadores
	$("#porcentajeAvance5").css({"width": ""+porcentajeAvanceGestion+"%","background-color":""+colorBarra(porcentajeAvanceGestion)}).text(porcentajeAvanceGestion+"%");
	$("#porcentajeAvance6").css({"width": ""+porcentajeAvanceProyectos+"%","background-color":""+colorBarra(porcentajeAvanceProyectos)}).text(porcentajeAvanceProyectos+"%");
	$("#porcentajeAvance7").css({"width": ""+porcentajeAvanceCompetencias+"%","background-color":""+colorBarra(porcentajeAvanceCompetencias)}).text(porcentajeAvanceCompetencias+"%");
	
	 
	// Articulación Familiar primeros 3 indicadores
	$("#porcentajeAvance9").css({"width": ""+porcentajeAvanceAcompanamiento+"%","background-color":""+colorBarra(porcentajeAvanceAcompanamiento)}).text(porcentajeAvanceAcompanamiento+"%");
	$("#porcentajeAvance10").css({"width": ""+porcentajeAvanceComunicacion+"%","background-color":""+colorBarra(porcentajeAvanceComunicacion)}).text(porcentajeAvanceComunicacion+"%");
	$("#porcentajeAvance11").css({"width": ""+porcentajeAvanceDotar+"%","background-color":""+colorBarra(porcentajeAvanceDotar)}).text(porcentajeAvanceDotar+"%");
	
	
	//Proyecto Fortalecimiento de Competencias Básicas desde la Transversalidad indicador
	$("#porcentajeAvance13").css({"width": ""+porcentajeAvanceEstado+"%","background-color":""+colorBarra(porcentajeAvanceEstado)}).text(porcentajeAvanceEstado+"%");
	
	
	
	for (j = 1; j <=17 ; j++) 
	{ 
		valor += $("#ecrespuestas-"+j+"-respuesta").val()*1;
		switch (j) 
		{
			//Proyecto Pedagógicos Transversales ultimo indicador - productos del eje
			case 5:
				porcentajeAvanceProductos1     = Math.trunc(((valor)/20)*100);
				valor =0;
				i=10
			break;
			
			//Proyecto de Servicio Social Estudiantil ultimo indicador - productos
			
			case 11:
				porcentajeAvanceProductos2 = Math.trunc(((valor)/20)*100);
				valor =0;
			break;
			
			//Articulación Familiar ultimo indicador - productos
			case 17:
				porcentajeAvanceProductos3 = Math.trunc(((valor)/20)*100);
				valor =0;
			break;
			
			
			
		}	
	}
	
	
	$("#porcentajeAvance4").css({"width": ""+porcentajeAvanceProductos1+"%","background-color":""+colorBarra(porcentajeAvanceProductos1)}).text(porcentajeAvanceProductos1+"%");
	$("#porcentajeAvance8").css({"width": ""+porcentajeAvanceProductos2+"%","background-color":""+colorBarra(porcentajeAvanceProductos2)}).text(porcentajeAvanceProductos2+"%");
	$("#porcentajeAvance12").css({"width": ""+porcentajeAvanceProductos3+"%","background-color":""+colorBarra(porcentajeAvanceProductos3)}).text(porcentajeAvanceProductos3+"%");
	

	
});

