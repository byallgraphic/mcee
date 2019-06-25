<?php
/********************
Modificaciones:
Fecha: 11-04-2019
Persona encargada: Viviana Rodas
Cambios realizados: Se agrega bootstrap al formulario
----------------------------------------
**********/

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSencibilizacionArtistica */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJs( file_get_contents( '../web/js/contenedor.js' ) );
$this->registerJs( file_get_contents( '../web/js/sensibilizacion.js' ) );



//no se puede saber cuando se edita en el js
if( strpos($_GET['r'], 'update') > -1)
{
?>
	<script>
	
		id = $("#id").val();
		
		function actualizarReqTecnicos(id)
		{
			$.get( "index.php?r=isa-iniciacion-sencibilizacion-artistica/requerimientos&id="+id,
						function( data )
						{
							$.each(data, function( index, value ) 
							{
								idActividad = index;
								
								selectActividad = $("#isaactividadesisa-"+index+"-requerimientos_tecnicos");
								
								$.each( data[index], function( idRequerimiento, value1 ) 
								{
									
									//se elimina el elemento del chosen para evitar que lo selecionen nuevamente
									idSelect = "#"+selectActividad.attr("id");
									$(""+ idSelect +" option[value='"+idRequerimiento+"']").remove();
									
									texto = $('#'+selectActividad.attr('id')+' option:eq('+idRequerimiento+')').text();
									idNombre = "requerimientos[]["+idActividad+"]["+idRequerimiento+"]";
									$("#reqTecnicos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  value = '+value1+' type="text" size="2" maxlength="2" min="0" style="width:35px;" ></li>');
								});
							});
							//se actiualiza la informacion que tiene el chosen del id seleccionado
							selectActividad.trigger("chosen:updated");
						},
					"json");
		}
	
		
		function actualizarReqLogisticos(id)
		{
			$.get( "index.php?r=isa-iniciacion-sencibilizacion-artistica/requerimientos-logisticos&id="+id,
						function( data )
						{
							$.each(data, function( index, datos ) 
							{
								
								idActividad = datos.id_actividad;
								selectActividad = $("#isaactividadesisa-"+idActividad+"-requerimientos_logisticos");
								idRequerimiento = datos.id_requerimiento;
								cantidad = datos.cantidad;
								dirOrigen  = datos.dir_origen; 
								dirDestino = datos.dir_destino;
								
								texto = $('#'+selectActividad.attr('id')+' option:eq('+idRequerimiento+')').text();
								// alert(texto);
								idNombre = "reqLogisticos[]["+idActividad+"]["+idRequerimiento+"]";
								
								if(texto == "Transporte")
								{
									$("#reqLogisticos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a> <br>Cantidad &nbsp;&nbsp;&nbsp;<input id="'+idNombre+'" name="'+idNombre+'" value ="'+cantidad+'" type="text" size="2" maxlength="2"  style="width:35px;" >       <br> Dir.Origen &nbsp;<input id="'+idNombre+'" name="'+idNombre+'"  value ="'+dirOrigen+'"  type="text" size="30" >    <br>Dir.Destino    <input id="'+idNombre+'" name="'+idNombre+'"  value ="'+dirDestino+'"  type="text" size="30" ></li>');
								}
								else
								{
									$("#reqLogisticos-"+idActividad+" ul").append('<li class="search-choice"><span>'+texto+'</span> <a onclick="borrarRequerimiento(this);" class="search-choice-close" data-option-array-index=""></a><input id="'+idNombre+'" name="'+idNombre+'"  value = '+cantidad+' type="text" size="2" maxlength="2" min="0" style="width:35px;" ></li>');
								}
							});
							
							
							// se elimina el elemento del chosen para evitar que lo selecionen nuevamente no funciona correctamente en el each que precede este
							$.each(data, function( index, datos ) 
							{
								
								idActividad = datos.id_actividad;
								selectActividad = $("#isaactividadesisa-"+idActividad+"-requerimientos_logisticos");
								idRequerimiento = datos.id_requerimiento;
								
								idSelect = "#"+selectActividad.attr("id");
								$(""+ idSelect +" option[value='"+idRequerimiento+"']").remove();
							});
							
							// se actiualiza la informacion que tiene el chosen del id seleccionado
							selectActividad.trigger("chosen:updated");
						},
					"json");
		}

		
		
		actualizarReqTecnicos(id);
		actualizarReqLogisticos(id);
		
	</script>
	
<?php 
} 
?>
	


<script>

//Click del boton agregar equipo campo y cargar contenido del formulario agregar en el modal
// $("#modalEquipo").click(function()
$(".modalEquipo").click(function()
{
	$( '[id^=modalContenido]' ).html('')
	num = $(this).attr('id').split("_")[1];
	
	$("#modalCampo_"+num+"").modal('show')
	.find("#modalContenido_"+num+"")
	.load($(this).attr('value'));
});

</script>




<div class="isa-iniciacion-sencibilizacion-artistica-form">

    <?php $form = ActiveForm::begin(); ?>
	
	  <label>
        <input type="hidden" id="id" value="<?= isset($model->id) ? $model->id : ''?>">
    </label>
<div class="row">
	<div class="col-md-8">
		<?= $form->field($model, 'id_institucion')->dropDownList($institucion) ?>
		
	</div>
	<div class="col-md-4"></div>
</div>
	
	<div class="row">
	  <div class="col-md-8"><?= $form->field($model, 'id_sede')->dropDownList($sede) ?></div>
	  <div class="col-md-4"></div>
	</div>
    
	<div class="row">
		<div class="col-md-6"><?= $form->field($model, 'caracterizacion_si_no')->dropDownList($arraySiNo ) ?></div>
		<div class="col-md-6"></div>
	</div>
    
	<div class="row">
	  <div class="col-md-6"><?= $form->field($model, 'caracterizacion_nombre')->textInput() ?></div>
	  <div class="col-md-6"><?= $form->field($model, 'caracterizacion_fecha')->widget(
        DatePicker::className(), [
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
            ],
    ]);  ?></div>
	</div>
    

    <div class="row">
	  <div class="col-md-6"><?= $form->field($model, 'caracterizacion_justificacion')->textInput() ?></div>
	  <div class="col-md-6"><?= $form->field($model, 'estado')->hiddenInput(['value'=> 1])->label(false) ?> </div>
	</div>
    
	

    <div class="panel panel panel-primary" >
        <div class="panel-heading" style="margin-bottom: 15px;">Fortalecer el vínculo comunidad-escuela mediante el mejoramiento de la oferta en artes y cultura desde las instituciones educativas oficiales para la ocupación del tiempo libre en las comunas y corregimientos de Santiago de Cali.</div>
        <?= $this->context->actionViewFases($model, $form);   ?>
    </div>
  

    <input type="hidden" id="id" value="<?= isset($model->id) ? $model->id : ''?>">

    <div class="form-group">
       
		<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']);	 ?>
		
    </div>

    <?php ActiveForm::end(); ?>

	
	<?=$this->registerCss("
					.nav-tabs > li 
					{
						width: 50%;
						
					}
					a[href='#w3-tab0']
					{
						height: 82px;
					}
					"); ?>
</div>
