/**********
Versión: 001
Fecha: 27-03-2018
---------------------------------------
Modificaciones:
Fecha: 01-05-2018
Persona encargada: Oscar David Lopez
Cambios realizados: validacion para cuando no tenga sede seleccionada
---------------------------------------
**********/

$( document ).ready(function() 
{
	
	var btnObj = $( "#btnAgregarObj" );
	btnObj.click(function(){
		var id_objetivo = $("#intervencion-0");
		var valueBtn = parseInt(btnObj.val(), 'number') + 1;

		id_objetivo.after(
			id_objetivo
				.clone()
				.attr('id', 'intervencion-'+ (valueBtn))
				.prepend( "<div onclick='$(this).parent().remove();' class='col text-right delete-area'>x</div>" )
		);
		
		
		$(this).val(valueBtn);
		$('#intervencion-'+ (valueBtn) + ' input').val('');
		$('#intervencion-'+ (valueBtn) + ' textarea').val('');
		id_objetivo.prop('disabled', true);
	
	});
	
	$('#save_form').click(function(e)
	{
		e.preventDefault();
		var i=0;
		var intervencion_ieo = [];
		$('.intervencion').each(function( index ) 
		{
			intervencion_ieo[i] = 
			{
				perfiles				:$('#isaintervencionieo-'+index+'-perfiles').val(),
				docente_orientador		:$('#isaintervencionieo-'+index+'-docente_orientador').val(),
				fases					:$('#isaintervencionieo-'+index+'-fases').val(),
				num_encuentro			:$('#isaintervencionieo-'+index+'-num_encuentros').val(),
				nombre_actividad		:$('#isaintervencionieo-'+index+'-nombre_actividad').val(),
				actividad_desarrollar	:$('#isaintervencionieo-'+index+'-actividad_desarrollar').val(),
				lugares_recorrer		:$('#isaintervencionieo-'+index+'-lugares_recorrer').val(),
				tematicas_abordadas		:$('#isaintervencionieo-'+index+'-tematicas_abordadas').val(),
				objetivos_especificos	:$('#isaintervencionieo-'+index+'-objetivos_especificos').val(),
				tiempo_previsto			:$('#isaintervencionieo-'+index+'-tiempo_previsto').val(),
				id_equipos_campo		:$('#isaactividadesisa-'+index+'-num_equipo_campo').val(),
				productos				:$('#isaintervencionieo-'+index+'-productos').val()
			};
			i++;
		});
		
		
		var activadesIsa = [];
		
		$.each([ 1, 2, 4 ], function( index, value ) 
		{
		  activadesIsa[value] = 
			{
				fecha_prevista_desde		: $('#isaactividadesisa-'+value+'-fecha_prevista_desde').val(),
				fecha_prevista_hasta		: $('#isaactividadesisa-'+value+'-fecha_prevista_hasta').val(),
				contenido_si_no 			: $('#isaactividadesisa-'+value+'-contenido_si_no').val(),
				contenido_nombre 			: $('#isaactividadesisa-'+value+'-contenido_nombre').val(),
				contenido_fecha 			: $('#isaactividadesisa-'+value+'-contenido_fecha').val(),
				contenido_justificacion		: $('#isaactividadesisa-'+value+'-contenido_justificacion').val(),
				articulacion 				: $('#isaactividadesisa-'+value+'-articulacion').val(),
				cantidad_participantes		: $('#isaactividadesisa-'+value+'-articulacion').val(),
				requerimientos_tecnicos		: $('#isaactividadesisa-'+value+'-requerimientos_tecnicos').val(),
				requerimientos_logisticos	: $('#isaactividadesisa-'+value+'-requerimientos_logisticos').val(),
				destinatarios 				: $('#isaactividadesisa-'+value+'-destinatarios').val(),
				fecha_entrega_envio 		: $('#isaactividadesisa-'+value+'-fecha_entrega_envio').val(),
				observaciones_generales 	: $('#isaactividadesisa-'+value+'-observaciones_generales').val(),
				nombre_diligencia 			: $('#isaactividadesisa-'+value+'-nombre_diligencia').val(),
				rol 						: $('#isaactividadesisa-'+value+'-rol').val(),
				fecha 						: $('#isaactividadesisa-'+value+'-fecha').val(),
				id_procesos_generales 		: $('#isaactividadesisa-'+value+'-id_procesos_generales').val()
	
			}
			
		});
	
	
		
		var formData = new FormData();
		formData.append("id_institucion", $('#isainiciacionsencibilizacionartistica-id_institucion').val());
		formData.append("id_sede", $('#isainiciacionsencibilizacionartistica-id_sede').val());
		formData.append("caracterizacion_si_no", $('#isainiciacionsencibilizacionartistica-caracterizacion_si_no').val());
		formData.append("caracterizacion_nombre", $('#isainiciacionsencibilizacionartistica-caracterizacion_nombre').val());
		formData.append("caracterizacion_fecha", $('#isainiciacionsencibilizacionartistica-caracterizacion_fecha').val());
		formData.append("caracterizacion_justificacion", $('#isainiciacionsencibilizacionartistica-caracterizacion_justificacion').val());
		formData.append("intervencion_ieo", JSON.stringify(intervencion_ieo));
		formData.append("activadesIsa", JSON.stringify(activadesIsa));
		
		
		if ($(this).val() === '0')
		{
			$.ajax({
				url: "index.php?r=isa-iniciacion-sencibilizacion-artistica%2Fstore",
				cache: false,
				contentType: false,
				processData: false,
				async: true,
				data: formData,
				type: 'POST',
				success: function (res, status) {
					if (status == 'success') {
						$("#modal-ge").modal('hide');
						$('#modal-guardado').modal('show');
					}
				},
            });
			
		}
		
		
		
	});
	






});