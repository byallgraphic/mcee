<?php
if(@$_SESSION['sesion']=="si")
{ 
	// echo $_SESSION['nombre'];
} 
//si no tiene sesion | redirecciona al login
else
{
	echo "<script> window.location=\"index.php?r=site%2Flogin\";</script>";
	die;
}
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;


    if($index == 1 || $index == 2 || $index == 3){?>
        <div style ="display : none">
            <?= $form->field($actividades_is_isa, "[$index]id_componente")->textInput(["value" => 1]) ?>
            <?= $form->field($actividades_is_isa, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }else{ ?>
        <div style ="display : none">
            <?= $form->field($actividades_is_isa, "[$index]id_componente")->textInput(["value" => 2]) ?>
            <?= $form->field($actividades_is_isa, "[$index]id_actividad")->textInput(["value" => $index]) ?>
        </div>
    <?php
    }

    if($index == 1){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 1. Realizar encuentros de sensibilización sobre el valor del arte y la cultura en la comunidad, desde las instituciones educativas oficiales.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 1. Realizar encuentros de sensibilización sobre el valor del arte y la cultura en la comunidad, desde las instituciones educativas oficiales."])->label(false); ?>
    <?php
    }
    if($index == 2){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 2: Realizar visitas eventos culturales de la ciudad para sensibilizar en torno a la importancia de la iniciación artística.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 2: Realizar visitas eventos culturales de la ciudad para sensibilizar en torno a la importancia de la iniciación artística."])->label(false); ?>
    <?php
    }
    if($index == 3){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 3: Promover la oferta cultural del municipio para sensibilización e iniciación artística.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 3: Promover la oferta cultural del municipio para sensibilización e iniciación artística."])->label(false); ?>
    <?php
    }
    if($index == 4){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 4: Realizar talleres de iniciación y sensibilización artística con la comunidad.</h3>
        <?= $form->field($actividade_is_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 4: Realizar talleres de iniciación y sensibilización artística con la comunidad."])->label(false); ?>
    <?php
    }
?>
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividade_is_isa, "[$index]sesiones_realizadas")->textInput([ 'type' => 'number']) ?> </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;&nbsp;<?= $form->field($actividade_is_isa, "[$index]porcentaje")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividade_is_isa, "[$index]sesiones_aplazadas")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($actividade_is_isa, "[$index]sesiones_canceladas")->textInput([ 'type' => 'number']) ?></div>
	</div>
    
    
    <?= $form->field($actividade_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>
	
	<div class="row">
	  <div class="col-md-4"><?= $form->field($actividades_is_isa, "[$index]duracion")->textInput() ?></div>
	  <div class="col-md-4"><?= $form->field($actividades_is_isa, "[$index]docente")->textInput() ?></div>
	  <div class="col-md-4"><?= $form->field($actividades_is_isa, "[$index]equipos")->textInput() ?></div>
	</div>


    <h2 style='background-color: #ccc;padding:5px;'>Tipo y cantidad de población</h2>
    <h3 style='background-color: #ccc;padding:5px;'>Número de participantes por actividad comunitaria por sede educativa.</h3>
    
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;<?= $form->field($tipo_poblacion_is_isa, "[$index]vecinos")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;<?= $form->field($tipo_poblacion_is_isa, "[$index]lider_comunitario")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($tipo_poblacion_is_isa, "[$index]empresarios_comerciantes")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">&nbsp;&nbsp;<?= $form->field($tipo_poblacion_is_isa, "[$index]representantes")->textInput([ 'type' => 'number']) ?></div>
	</div>
	
    
    <div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($tipo_poblacion_is_isa, "[$index]miembros_asociados")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($tipo_poblacion_is_isa, "[$index]otros_actores")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?= $form->field($tipo_poblacion_is_isa, "[$index]total")->textInput([ 'type' => 'number']) ?></div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
	</div>
   
    
    
    
    <?= $form->field($tipo_poblacion_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?>


    <h3 style='background-color: #ccc;padding:5px;'>Evidencias (Cantidad  de evidencias que resultaron de la actividad, tales  como fotografías, videos, actas, trabajos de los participantes, etc )</h3>
    <div class="row">
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]acta")->label('ACTAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]reprote")->label('REPORTES  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	</div>
	
	<div class="row">
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]listados")->label('LISTADOS  (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]plan_trabajo")->label('PLAN DE TRABAJO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	</div>
	
	<div class="row">
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]formato_seguimiento")->label('FORMATOS DE SEGUIMIENTO (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]formato_evaluacion")->label('FORMATOS DE EVALUACIÓN (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	</div>
   
    <div class="row">
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]fotografias")->label('FOTOGRAFÍAS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]videos")->label('VIDEOS (Cantidad)')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	</div>
    
	<div class="row">
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]otros")->label('Otros productos  de la actividad')->fileInput([ 'accept' => ".doc, .docx, .pdf, .xls" ]) ?></div>
	  <div class="col-md-6"></div>
	</div>
    
	

     
	<div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_is_isa, "[$index]logros")->textarea(['rows' => '3']) ?></div>
	  <div class="col-md-6"><?= $form->field($evidencias_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?></div>
	</div>
    <h3 style='background-color: #ccc;padding:5px;'>Variaciones en la implementación del proyecto:</h3>
    <h3 style='background-color: #ccc;padding:5px;'>Situaciones de dificultad y/o ventaja, surgidos o presentes durante el periodo,  que influyen en el cumplimiento de los objetivos.</h3>
    <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_is_isa, "[$index]variaciones_devilidades")->textarea(['rows' => '3']) ?> </div>
	  <div class="col-md-6"><?= $form->field($actividades_is_isa, "[$index]variaciones_fortalezas")->textarea(['rows' => '3']) ?></div>
	</div>
	
	<div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_is_isa, "[$index]retos")->textarea(['rows' => '3']) ?></div>
	  <div class="col-md-6"><?= $form->field($actividades_is_isa, "[$index]articulacion")->textarea(['rows' => '3']) ?></div>
	</div>
    
    <div class="row">
	  <div class="col-md-6"><?= $form->field($actividades_is_isa, "[$index]alrmas")->textarea(['rows' => '3']) ?></div>
	  <div class="col-md-6"><?= $form->field($actividades_is_isa, "[$index]estado")->hiddenInput(['value'=> 1])->label(false); ?></div>
	</div>
    
    
    

