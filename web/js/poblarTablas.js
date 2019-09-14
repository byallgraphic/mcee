function seleccionarTabla(schema,cmp )
{
	
	$.get( 'index.php?r=poblar-tabla/columnas-por-tabla&schema='+schema+'&tabla='+$( cmp ).val(), function(data){
		
		$( "#pCsvExample").html("");
	  
		if( data.data )
		{
			$( data.data ).each(function(x){
				
				var coma = "";
				
				if( x > 0 )
					coma = ";";

				$( "#pCsvExample").html( $( "#pCsvExample").html() + coma + '"' + data.data[x] +'"' );
			});
			
			$( "#pCsvExample" ).html( $( "#pCsvExample" ).html() + "<br>" + $( "#pCsvExample" ).html()  + "<br>" + $( "#pCsvExample" ).html() + "<br>..." );
			
			
			$( "#dvCampos").html("");
			$( data.data ).each(function(x){
				$( "#dvCampos").append( "<div class=campos>" + x +". "+ data.data[x] + "</div>" );
			});
		}
	  
	}, "json" );
}

function seleccionarSchema(cmp) {
    $.get( 'index.php?r=poblar-tabla/tablas&schema='+$( cmp ).val(), function(data){
        $("#poblartabla-tabla").empty();
        $('#poblartabla-tabla').append('<option value="">Seleccione...</option>');
        for(var i=0;i<data.length;i++){
            $('#poblartabla-tabla').append('<option value="'+data[i]["tablename"]+'">'+data[i]["tablename"]+'</option>')
        }

    }, "json" );
}