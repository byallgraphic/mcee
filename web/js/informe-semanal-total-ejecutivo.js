$(document).ready(function() 
{
$.get( "index.php?r=ec-informe-semanal-total-ejecutivo/reporte-total-ejecutivo",
			function( data )
			{
				$("#example").html( data );
				
				setTimeout(function(){ crearDataTable(); }, 1000);
				
			},
		"json");


    
} );





function crearDataTable()
{
	$('#example').DataTable( {
		

		'aoColumnDefs': [
			
            {
                "render": function ( data, type, row ) 
				{
                    return data + '%';
                },
                "targets": 4,
            },
		    {
				"render": function ( data, type, row ) 
				{
					return data + '%';
				},
				"targets": 5,
            },

			{
				"render": function ( data, type, row ) 
				{
					return data + '%';
				},
				"targets": 6,
            },
			{
				"render": function ( data, type, row ) 
				{
					return data + '%';
				},
				"targets": 7,
            },
			
			{
				"render": function ( data, type, row ) 
				{
					return data + '%';
				},
				"targets": 8,
            },
		
        ],
		"scrollX": true,
		"scrollY": "350px",		
		
        "footerCallback": function ( row, data, start, end, display ) 
		{
            var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            },
			
		
				
             // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
           
			// Update footer
            $( api.column( 2 ).footer() ).html(
                pageTotal +' (total '+ total +')'
            );
			
					
             // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
           
			// Update footer
            $( api.column( 3 ).footer() ).html(
                pageTotal +' (total '+ total+')'
            );
			
					
             // Total over all pages
            total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
           
			// Update footer
            $( api.column( 9 ).footer() ).html(
                pageTotal +' (total '+ total+')'
            );
			
			
					
             // Total over all pages
            total = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
           
			// Update footer
            $( api.column( 10 ).footer() ).html(
                pageTotal +' (total '+ total+')'
            );
			
			
			
			var i;
			for (i = 4; i <= 8; i++) 
			{ 
			  // promedio
				var columnData = api
               .column( i, { page: 'current'} )
                .data();
 
				var theColumnTotal = columnData
                .reduce( function (a, b) 
				{
                    return intVal(a) + intVal(b);
                }, 0 );
 
				// Update footer
				$( api.column( i ).footer() ).html(
				   ('Promedio ')+   (theColumnTotal / columnData.count()).toFixed(2) + '%'
				);
				
			}
				
          
        }
    } );
	
}
