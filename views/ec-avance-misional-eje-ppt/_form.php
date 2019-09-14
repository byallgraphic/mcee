<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalEjePpt */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ec-avance-misional-eje-ppt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resposable_sem')->textInput() ?>

    <?= $form->field($model, 'operador')->textInput() ?>

    <?= $form->field($model, 'acciones_realizadas')->textArea() ?>

	<h3 style="background-color:GRAY;padding:5px;">Análisis de avance en las transformaciones del eje</h3>
	
	<h3 style="background-color:#ccc;padding:5px;">Procesos de gestión institucional de los proyectos pedagógicos transversales fortalecidos</h3>
	
    <?= $form->field($model, 'proceso_gestion_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'proceso_gestion_dificultades')->textArea()->label("Dificultades")?>
	
	<h3 style="background-color:#ccc;padding:5px;">Estrategias de Transversalización y vinculación en el PEI instaladas</h3>
    <?= $form->field($model, 'estrategias_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'estrategias_dificultades')->textArea()->label("Dificultades") ?>

	<h3 style="background-color:#ccc;padding:5px;">Orientaciones conceptuales y metodológicas para el fortalecimiento de las competencias básicas y habilidades para la vida en los estudiantes a través de los ppt</h3>
    <?= $form->field($model, 'orientaciones_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'orientaciones_dificultades')->textArea()->label("Dificultades") ?>

	<h3 style="background-color:PEACHPUFF;padding:5px;">Análisis de avance en los productos del eje</h3>
	<h3 style="background-color:MOCCASIN;padding:5px;">Guía de orientaciones de los Proyectos Pedagógicos Transversales actualizadas y apropiadas</h3>
    <?= $form->field($model, 'guia_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'guia_dificultades')->textArea()->label("Dificultades") ?>

	<h3 style="background-color:MOCCASIN;padding:5px;">Iniciativas de mediación y transversalización de los Proyectos Pedagógicos Transverales fortalecidos</h3>
    <?= $form->field($model, 'iniciativas_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'iniciativas_dificultades')->textArea()->label("Dificultades") ?>

	<h3 style="background-color:MOCCASIN;padding:5px;">Red Municipal de docentes de Proyectos Pedagógicos Transversales activa</h3>
    <?= $form->field($model, 'red_municipal_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'red_municipal_dificultades')->textArea()->label("Dificultades") ?>

	<h3 style="background-color:MOCCASIN;padding:5px;">Proyectos Pedagógicos Transversales integrados al Proyecto Educativo Institucional</h3>
    <?= $form->field($model, 'proyectos_avances')->textArea()->label("Avances")?>

    <?= $form->field($model, 'proyectos_dificultades')->textArea()->label("Dificultades") ?>

	<h3 style="background-color:MOCCASIN;padding:5px;">Dispositivo de gestión institucional de los Proyectos pedagógicos Transversales</h3>
    <?= $form->field($model, 'dispositivo_avances')->textArea()->label("Avances") ?>

    <?= $form->field($model, 'dispositivo_dificultades')->textArea()->label("Dificultades") ?>

    <?= $form->field($model, 'fuente_informacion')->textArea()->label("Fuente de información para este análisis") ?>

    <?= $form->field($model, 'avances_importantes')->textArea()->label("Avances Mas Importantes del Acompañamiento") ?>

    <?= $form->field($model, 'dificultades_importantes')->textArea()->label("Dificultades Mas Importantes del Acompañamiento") ?>

    <?= $form->field($model, 'alarmas_importantes')->textArea() ?>

    <?= $form->field($model, 'estado')->DropDownList($estados) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
