var consecutivo = 1;

function agregarCampos(){
	
	$.post( 
		"index.php?r=plan-estudios/agregar-campos",
		{
			consecutivo : consecutivo,
		},
		function( data ){
			$( "#dvTable" ).append( data );
			
			//oculto el boton eliminar
			$( "#btnEliminar" ).css({display:""});
            

            //agrego las validaciones correspondientes a los campos
            
            $( "#w0" ).yiiActiveForm( 'add', {
				"id":"planestudios-"+consecutivo.toString()+"-descripcion",
				"name":"["+consecutivo.toString()+"]descripcion",
				"container":".field-planestudios-"+consecutivo.toString()+"-descripcion",
				"input":"#planestudios-"+consecutivo.toString()+"-descripcion",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"Descripcion no puede estar vacío."});
					yii.validation.text(attribute, messages, {"message":"Falló la subida del archivo.","skipOnEmpty":true,"mimeTypes":[],"wrongMimeType":"Sólo se aceptan archivos con los siguientes tipos MIME: .","extensions":[],"wrongExtension":"Sólo se aceptan archivos con las siguientes extensiones: ","maxFiles":1,"tooMany":"Puedes subir como máximo 1 archivo."});
				}
			});
						
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"planestudios-"+consecutivo.toString()+"-tipo_documento_id",
				"name":"["+consecutivo.toString()+"]tipo_documento_id",
				"container":".field-planestudios-"+consecutivo.toString()+"-tipo_documento_id",
				"input":"#planestudios-"+consecutivo.toString()+"-tipo_documento_id",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"Tipo de Documento no puede estar vacío."});
					yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"Tipo de Documento debe ser un número entero.","skipOnEmpty":1});
				}
			});
			
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"planestudios-"+consecutivo.toString()+"-file",
				"name":"["+consecutivo.toString()+"]file",
				"container":".field-planestudios-"+consecutivo.toString()+"-file",
				"input":"#planestudios-"+consecutivo.toString()+"-file",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"File no puede estar vacío."});
					yii.validation.file(attribute, messages, {"message":"Falló la subida del archivo.","skipOnEmpty":true,"mimeTypes":[],"wrongMimeType":"Sólo se aceptan archivos con los siguientes tipos MIME: .","extensions":[],"wrongExtension":"Sólo se aceptan archivos con las siguientes extensiones: ","maxFiles":1,"tooMany":"Puedes subir como máximo 1 archivo."});
				}
			});
			
			$( "#w0" ).yiiActiveForm( 'add', {
				"id":"planestudios-"+consecutivo.toString()+"-estado",
				"name":"["+consecutivo.toString()+"]estado",
				"container":".field-planestudios-"+consecutivo.toString()+"-estado",
				"input":"#planestudios-"+consecutivo.toString()+"-estado",
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
				"id":"planestudios-0-file",
				"name":"[0]file",
				"container":".field-planestudios-0-file",
				"input":"#planestudios-0-file",
				"validate":function (attribute, value, messages, deferred, $form) {
					yii.validation.required(value, messages, {"message":"File no puede estar vacío."});
					yii.validation.file(attribute, messages, {"message":"Falló la subida del archivo.","skipOnEmpty":true,"mimeTypes":[],"wrongMimeType":"Sólo se aceptan archivos con los siguientes tipos MIME: .","extensions":[],"wrongExtension":"Sólo se aceptan archivos con las siguientes extensiones: ","maxFiles":1,"tooMany":"Puedes subir como máximo 1 archivo."});
				}
			});
		}, 1000 );
	}
	catch(e){}

});