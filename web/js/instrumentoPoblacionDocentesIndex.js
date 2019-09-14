/**********
Versión: 001
Fecha: 2018-09-06
Desarrollador: Edwin Molina Grisales
Descripción: Instrumento población estudiantes
---------------------------------------
*/

$( document ).ready(function(){
	
	$( "#tbInfo" ).DataTable({
		"language"	: {"url":"//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		"lengthMenu": [[20,-1],[20,"All"]],
		"info"		: false,
		"responsive": true,
		"dom"		: "lfTrtip",
		"tableTools":{
			"aButtons":[
				{
					sExtends		:"div",
					sButtonText		:"Excel",
					oSelectorOpts	:{ page: "current" },
					fnClick			:function(){
						$( "#tbInfo" ).tblToExcel();
					},
				},
			],
			"sSwfPath":"/yii/mcee/web/assets/da3a8eca/swf/copy_csv_xls_pdf.swf",
		}
	});
	
	//remuevo todos los td ocultos, para que al descargar el archivo
	//se vea correctamente
	$( "#tbInfo td:hidden" ).remove();
});