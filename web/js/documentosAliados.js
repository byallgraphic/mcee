/**********
Versión: 001
Fecha: 2018-10-03
Desarrollador: Edwin MG
Descripción: Script Js para agregar filas al Formulario Documentos Aliados
---------------------------------------
*/


var consecutivo = 1;

function agregarCampos(){
	
	$.post( 
		"index.php?r=documentos-aliados/agregar-campos",
		{
			consecutivo : consecutivo,
		},
		function( data ){
			$( "#dvTable" ).append( data );
			
			//oculto el boton eliminar
			$( "#btnEliminar" ).css({display:""});
			
			//agrego las validaciones correspondientes a los campos
			
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"documentosaliados-"+consecutivo.toString()+"-id_institucion",
				"name":"["+consecutivo.toString()+"]id_institucion",
				"container":".field-documentosaliados-"+consecutivo.toString()+"-id_institucion",
				"input":"#documentosaliados-"+consecutivo.toString()+"-id_institucion",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"Institución no puede estar vacío."});
					yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Institución debe ser un número entero.","skipOnEmpty":1});
				}
			});
			
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"documentosaliados-"+consecutivo.toString()+"-nombre",
				"name":"["+consecutivo.toString()+"]tipo_documento",
				"container":".field-documentosaliados-"+consecutivo.toString()+"-nombre",
				"input":"#documentosaliados-"+consecutivo.toString()+"-nombre",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.string(value, messages, {"message":"Nombre debe ser una cadena de caracteres.","skipOnEmpty":1});
					yii.validation.required(value, messages, {"message":"Nombre no puede estar vacío."});
				}
			});
			
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"documentosaliados-"+consecutivo.toString()+"-tipo_documento",
				"name":"["+consecutivo.toString()+"]tipo_documento",
				"container":".field-documentosaliados-"+consecutivo.toString()+"-tipo_documento",
				"input":"#documentosaliados-"+consecutivo.toString()+"-tipo_documento",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"Tipo de Documento no puede estar vacío."});
					// yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Tipo de Documento debe ser un número entero.","skipOnEmpty":1});
				}
			});
			
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"documentosaliados-"+consecutivo.toString()+"-descripcion",
				"name":"["+consecutivo.toString()+"]descripcion",
				"container":".field-documentosaliados-"+consecutivo.toString()+"-descripcion",
				"input":"#documentosaliados-"+consecutivo.toString()+"-descripcion",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.string(value, messages, {"message":"Descripcion debe ser una cadena de caracteres.","skipOnEmpty":1});
				}
			});
			
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"documentosaliados-"+consecutivo.toString()+"-file",
				"name":"["+consecutivo.toString()+"]file",
				"container":".field-documentosaliados-"+consecutivo.toString()+"-file",
				"input":"#documentosaliados-"+consecutivo.toString()+"-file",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"File no puede estar vacío."});
					yii.validation.file(attribute, messages, {"message":"Falló la subida del archivo.","skipOnEmpty":true,"mimeTypes":[],"wrongMimeType":"Sólo se aceptan archivos con los siguientes tipos MIME: .","extensions":[],"wrongExtension":"Sólo se aceptan archivos con las siguientes extensiones: ","maxFiles":1,"tooMany":"Puedes subir como máximo 1 archivo."});
				}
			});
			
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"documentosaliados-"+consecutivo.toString()+"-estado",
				"name":"["+consecutivo.toString()+"]estado",
				"container":".field-documentosaliados-"+consecutivo.toString()+"-estado",
				"input":"#documentosaliados-"+consecutivo.toString()+"-estado",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"Estado no puede estar vacío."});
					yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Estado debe ser un número entero.","skipOnEmpty":1});
				}
			});
			
			consecutivo++;
		},
		"text"
	);
}

function eliminarCampos(){
	
	var rows = $( "#dvTable div.row" );
	
	rows.eq( rows.length-1 ).remove();
	consecutivo--;
	
	if( consecutivo == 1 )
		$( "#btnEliminar" ).css({display:"none"});
}

$( document ).ready(function(){
	
	try{
	
		//Solo cuando se llama al index
		setTimeout( function(){
			if( $( "[name=guardado]" ).length > 0 ){
				swal({
					text: "Archivos guardadas exitosamente",
					icon: "success",
					button: "Cerrar",
				});
			}
		}, 1000 );
	
		setTimeout( function(){
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"documentosaliados-0-file",
				"name":"[0]file",
				"container":".field-documentosaliados-0-file",
				"input":"#documentosaliados-0-file",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"File no puede estar vacío."});
					yii.validation.file(attribute, messages, {"message":"Falló la subida del archivo.","skipOnEmpty":true,"mimeTypes":[],"wrongMimeType":"Sólo se aceptan archivos con los siguientes tipos MIME: .","extensions":[],"wrongExtension":"Sólo se aceptan archivos con las siguientes extensiones: ","maxFiles":1,"tooMany":"Puedes subir como máximo 1 archivo."});
				}
			});
		}, 1000 );
		
	}
	catch(e){
		console.log(e);
	}
});