<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EcAvanceMisionalProyecto */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
?>

<div class="ec-avance-misional-proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipo_sem')->textInput() ?>

    <?= $form->field($model, 'operado')->textInput() ?>

    <?= $form->field($model, 'acciones_realizadas')->textInput() ?>
	
	<h3 style="background-color:#ccc;padding:5px;">Análisis de avance en las transformaciones del proyecto</h3>

    <?= $form->field($model, 'actores_lideres')->textArea()
	->label("Actores líderes de los tres ejes con conocimientos, habilidades y disposiciones fortalecidas para orientar, gestionar, articular e integrar, pedagógica y metodológicamente sus procesos en la escuela.")?>

    <?= $form->field($model, 'proceso_gestion')->textArea()
	->label("Procesos de gestión institucional de los Proyectos Pedagógicos Transversales, de Articulación Familiar y de Proyectos de Servicio Social Estudiantil fortalecidos con mecanismos e instrumentos de planeación, ejecución, seguimiento y evaluación")	?>

    <?= $form->field($model, 'iniciativas_pedagogicas')->textArea()
	->label("Iniciativas pedagógicas situadas en y/o entre los ejes (PPT, AF, PSSE) fortalecidas en su estrategia formativa y metodológica como escenarios transversales de fortalecimiento de Competencias Básicas y Habilidades para la Vida. ")?>

	<?= $form->field($model, 'visiones')->textArea()
	->label("Visiones compartidas de las I.E.O en torno al sentido y las estrategias transversales para el fortalecimiento de las Competencias Básicas y Habilidades para la Vida") ?>
	
    <?= $form->field($model, 'estudiantes')->textArea() 
	->label("Estudiantes que consideran y perciben mayor vinculación entre los saberes escolares y su ejercicio cotidiano, su proyecto de vida y las relaciones que entablan con su comunidad.") ?>

    <?= $form->field($model, 'fuente_informacion')->textArea() 
	->label("Fuente de información para este análisis") ?>

    <?= $form->field($model, 'avances_importante')->textArea() 
	->label("Avances Mas Importantes del Acompañamiento") ?>

    <?= $form->field($model, 'dificultades_importantes')->textArea() 
	->label("Dificultades Mas Importantes del Acompañamiento") ?>   


    <?= $form->field($model, 'alarmas_importantes')->textArea()  ?>

    <?= $form->field($model, 'estado')->DropDownList($estados) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
