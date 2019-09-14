<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\EcProyectos;
use app\models\EcAcciones;
use app\models\EcProductos;
use app\models\EcEstrategias;
use app\models\EcProcesos;
use app\models\ComunasCorregimientos;
use app\models\BarriosVeredas;
use nex\chosen\Chosen;
use	yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Parametro;

use yii\bootstrap\Progress;
/* @var $this yii\web\View */
/* @var $model app\models\EcInformePlaneacionIeo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/ecinformeplaneacionieo.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$idTipoInforme = (isset($_GET['idTipoInforme'])) ?  $_GET['idTipoInforme'] :  $model->id_tipo_informe;
?>
  <?=  Html::button('Porcentajes de avance',['value'=>Url::to(['create']),'class'=>'btn btn-success','id'=>'porcentajes']) ?>
<br>
<br>
<br>

<style>
#myProgress {
  width: 50%;
   height: 3%;
  background-color: #ddd;
}

.myBar {
   width: 0%;
   height: 100%;
  background-color: green;
  text-align: center;
  color: white;
}
</style>
<!-- se coloca el jquery en esta parte ya que en el archivo ecinformeplaneacionieo.js externo por alguna razon no lo coje -->
<script>


$("#divPorcentajes").hide();
$.get( "index.php?r=ecinformeplaneacionieo/info-porcentajes",
			function( data )
			{
				// alert(data);
				
					$("#divPorcentajes").html(data);
				
			},
		"json");
		
		
		
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
				porcentajeAvanceProductos2 = Math.trunc(((valor)/24)*100);
				valor =0;
			break;
			
			//Articulación Familiar ultimo indicador - productos
			case 17:
				porcentajeAvanceProductos3 = Math.trunc(((valor)/24)*100);
				valor =0;
			break;
			
			
		}	
	}
	
	$("#porcentajeAvance4").css({"width": ""+porcentajeAvanceProductos1+"%","background-color":""+colorBarra(porcentajeAvanceProductos1)}).text(porcentajeAvanceProductos1+"%");
	$("#porcentajeAvance8").css({"width": ""+porcentajeAvanceProductos2+"%","background-color":""+colorBarra(porcentajeAvanceProductos2)}).text(porcentajeAvanceProductos2+"%");
	$("#porcentajeAvance12").css({"width": ""+porcentajeAvanceProductos3+"%","background-color":""+colorBarra(porcentajeAvanceProductos3)}).text(porcentajeAvanceProductos3+"%");
	
});

</script>	

 <?php // $this->context->actionInfoPorcentajes(); ?>
 
 <div id='divPorcentajes'>
 </div>
  <!-- <div class="panel panel-danger">
		
		<div class="panel-heading">
			<h3 class="panel-title">Proyecto Pedagógicos Transversales</h3>
		</div>
		<div class="panel-body">
		
			Cuál es el estado general de avance de los procesos de gestión de los Proyectos Pedagógicos Transversales		
			<div id="myProgress">
			  <div id="porcentajeAvance1" class="myBar">0%</div>
			</div>
			<br>
			Cuál es el estado de avance del proceso de transversalización y vinculación al PEI de los Proyectos Pedagógicos Transversales
			<div id="myProgress">
			  <div id="porcentajeAvance2" class="myBar">0%</div>
			</div>
			<br>

			Cuál es el estado de avance de la orientación conceptual y metodológica de los Proyectos Pedagógicos Transversales
			<div id="myProgress">
			  <div id="porcentajeAvance3" class="myBar">0%</div>
			</div>
			<br>

			Cuál es el estado de avance de los productos correspondientes al eje PPT 
			<div id="myProgress">
			  <div id="porcentajeAvance4" class="myBar">0%</div>
			</div>
			<br>
		</div>

	</div>  
	<div class="panel panel-success">
		
		<div class="panel-heading">
			<h3 class="panel-title">Proyecto de Servicio Social Estudiantil </h3>
		</div>
		<div class="panel-body">
 
		Cuál es el estado de avance de la gestión de los PSSE
		<div id="myProgress">
			<div id="porcentajeAvance5" class="myBar">0%</div>
		</div>
		<br>
		  
		Cuál es el estado de avance de los procesos con la comunidad en el eje PSSE
		<div id="myProgress">
			<div id="porcentajeAvance6" class="myBar">0%</div>
		</div>
		<br>
		Cuál es el estado de avance de la orientación conceptual y metodológica de los Proyectos de servicio social
		<div id="myProgress">
			<div id="porcentajeAvance7" class="myBar">0%</div>
		</div>
		<br>
		Cuál es el estado de avance de los productos del eje PSSE
		<div id="myProgress">
			  <div id="porcentajeAvance8" class="myBar">0%</div>
			</div>
		</div>
	</div> 
	
	<div class="panel panel-primary">
		
		<div class="panel-heading">
			<h3 class="panel-title">Articulación Familiar</h3>
		</div>
		<div class="panel-body">
 
	  Cuál es el estado de avance del acompañamiento pedagógico que realizar las familias en el desarrollo de las CB y HV de los estudiantes.
	  <div id="myProgress">
			<div id="porcentajeAvance9" class="myBar">0%</div>
		</div>
		<br>
	  Cuál es el estado de avance de los procesos de comunicación entre la familia y la escuela
	  <div id="myProgress">
			<div id="porcentajeAvance10" class="myBar">0%</div>
		</div>
		<br>
	  Cuál es el estado de avance en la articulación de los organismos y mecanismos de participación de las familias en la escuela 
	  <div id="myProgress">
			<div id="porcentajeAvance11" class="myBar">0%</div>
		</div>
		<br>

	  Cuál es el estado de avance de los productos requeridos por el eje de Articulación Familiar
	<div id="myProgress">
			<div id="porcentajeAvance12" class="myBar">0%</div>
		</div>
		<br>

		</div>
	</div>  
	
	<div class="panel panel-info">
		
		<div class="panel-heading">
			<h3 class="panel-title"> Proyecto Fortalecimiento de Competencias Básicas desde la Transversalidad </h3>
		</div>
		<div class="panel-body">
 
		Estado general de avance de las transformaciones esperadas por el Proyecto Fortalecimiento de las Competencias Básicas y las Habilidades para la Vida desde la transversalidad
	  
		<div id="myProgress">
			<div id="porcentajeAvance13" class="myBar">0%</div>
		</div>
		<br>
	 

		</div>
	</div>  -->


	
  <div class="ec-informe-planeacion-ieo-form">
	
    <?php 
    	$form = ActiveForm::begin();
     ?>
	 
	 <?= $form->field($model, 'id_institucion')->dropDownList($instituciones) ?>
	 
	 <?= $form->field($model, 'id_sede')->dropDownList($sedes) ?>
	 
	 <label> Código Dane </label>

	<h6 style='border: 1px solid #ccc;padding:10px;border-radius:4px;'><?=$codigoDane?></h6>
	 
	<?= $form->field($model, 'zona_educativa')->dropDownList($zonaEducativa,['prompt' => 'Seleccione...']) ?>

	

	
	<label> Comuna </label>

	<h6 style='border: 1px solid #ccc;padding:10px;border-radius:4px;'><?=$comunas?></h6>

	<label> Barrio</label>
	<h6 style='border: 1px solid #ccc;padding:10px;border-radius:4px;'><?=$barrios?></h6>
	
	<?= $form->field($model, 'fase')->DropDownList($fases,['prompt'=>'Seleccione...']) ?>
	
	<?= $form->field($model, 'id_tipo_informe')->hiddenInput( [ 'value' => $idTipoInforme ] )->label( false ) ?>
	        
        
		<?= $form->field($model, 'fecha_reporte')->widget(
			DatePicker::className(), [
				 // modify template for custom rendering
				'template' => '{addon}{input}',
				'language' => 'es',
				'clientOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy'
				]
		])->label('Fecha del reporte (dd-mm-aaaa)');?> 	

	    <h3 style='background-color: #ccc;padding:5px;'>I.E.O Misional</h3>

	    <?= $this->context->actionViewFases($model,$form,$datos,$datoRespuesta,$datoInformePlaneacionProyectos);   ?>
	   


        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
