/**********
Versión: 001
Fecha: 2018-09-03
Desarrollador: Edwin Molina Grisales
Descripción: RESUMEN OPERATIVO FASES ESTUDIANTES
---------------------------------------
**********/

$( document ).ready(function(){
	
	$( "#tb" ).DataTable({
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
						$( "#tb" ).tblToExcel();
					},
				},
			],
			"sSwfPath":"/yii/mcee/web/assets/da3a8eca/swf/copy_csv_xls_pdf.swf",
		}
	});
});