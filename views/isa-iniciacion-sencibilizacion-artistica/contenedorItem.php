<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\IsaActividadesIsa;
use yii\helpers\ArrayHelper;

//saber que se esta editando
if( strpos($_GET['r'], 'update') > -1)
{
	//traer el id de la tabla isa.actividades_isa para luego traer el modelo con los datos correspondintes
	$isa = new IsaActividadesIsa();
	$isa = $isa->find()->where("id_procesos_generales = $idProceso and id_iniciacion_sencibilizacion_artistica=". $model->id)->all();
	$isa = ArrayHelper::map($isa,'id','id_procesos_generales');
	//traer el modelo con los datos de cada actividad
	$actividades_isa = IsaActividadesIsa::findOne(key($isa));
}
?>


    <h3 style='background-color: #ccc;padding:5px;'>Fecha prevista para realizar la actividad</h3>
    <?= $form->field($actividades_isa, "[$idProceso]fecha_prevista_desde")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> 

     <?= $form->field($actividades_isa, "[$idProceso]fecha_prevista_hasta")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> 
   <h3 style='background-color: #ccc;padding:5px;'>Equipo o equipos de intervención encargado(s) </h3>
   <?= $form->field($actividades_isa, "[$idProceso]num_equipo_campo")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]perfiles")->textInput() ?>

   <?= $form->field($actividades_isa, "[$idProceso]docente_orientador")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]fases")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]num_encuentro")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]nombre_actividad")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]actividad_desarrollar")->textInput() ?>

	<?= $form->field($actividades_isa, "[$idProceso]lugares_recorrer")->textInput() ?>
           
   <?= $form->field($actividades_isa, "[$idProceso]tematicas_abordadas")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]objetivos_especificos")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]tiempo_previsto")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]productos")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]contenido_vigencia")->textInput() ?>
   <h3 style='background-color: #ccc;padding:5px;'>¿El contenido de esta actividad  responde al plan de acción construido colectivamente para la institución desde la articulación de la estrategia MCEE?</h3>
   <?= $form->field($actividades_isa, "[$idProceso]contenido_si_no")->dropDownList($arraySiNo ) ?>
   <?= $form->field($actividades_isa, "[$idProceso]contenido_nombre")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]contenido_fecha")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> 
   <?= $form->field($actividades_isa, "[$idProceso]contenido_justificacion")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]articulacion")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]cantidad_participantes")->textInput() ?>
   <h3 style='background-color: #ccc;padding:5px;'>Recursos previstos para realizar la actividad</h3>
   <?= $form->field($actividades_isa, "[$idProceso]requerimientos_tecnicos")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]requerimientos_logisticos")->textInput() ?>
   <h3 style='background-color: #ccc;padding:5px;'>Programación: Entrega o envío de la programación de la actividad a los participantes,  líderes comunitarios o directivas de la institución</h3>
   <?= $form->field($actividades_isa, "[$idProceso]destinatarios")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]fecha_entrega_envio")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> 
   <?= $form->field($actividades_isa, "[$idProceso]observaciones_generales")->textInput() ?>
   <h3 style='background-color: #ccc;padding:5px;'>Diligenciamiento del Plan de Actividades</h3>
   <?= $form->field($actividades_isa, "[$idProceso]nombre_diligencia")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]rol")->textInput() ?>
   <?= $form->field($actividades_isa, "[$idProceso]fecha")->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]);  ?> 
	
	<?= $form->field($actividades_isa, "[$idProceso]id_procesos_generales")->hiddenInput(["value" => $idProceso])->label(false);?> 