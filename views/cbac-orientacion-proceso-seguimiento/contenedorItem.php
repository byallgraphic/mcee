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

    $imps =[
        1 =>    "Logros: Resultados de avance que permitan constatar que, por medio de las actividades realizadas, se está logrando fortalecer la oferta de programas culturales para estudiantes en el proceso formativo de competencias básicas dentro y fuera del aula para los estudiantes de grados sexto a once de las Instituciones Educativas Oficiales.",
        2 =>    "Fortalezas que se detectaron en el desarrollo de la actividad para potenciar los objetivos del proyecto.",
        3 =>    "Debilidades, dificultades, problemas que se le presentaron en el desarrollo de la actividad y que pueden afectar negativamente el  cumplimiento de los objetivos del proyecto.",
        4 =>    "Retos: Condiciones externas a tener en cuenta y que pueden afectar o beneficiar el logro de  los objetivos del proyecto.",
        5 =>    "Alternativas adoptadas por los profesionales de campo para superar debilidades o solucionar dificultades.",
        6 =>    "Observaciones de los profesionales del equipo de campo en el desarrollo de la actividad en las sedes de las IEO.",
        7 =>    "Articulación:  Resultado de la articulación con otros proyectos de la iniciativa Mi Comunidad es Escuela.",
        8 =>    "Alarmas:  Situaciones emergentes que pueden impedir el desarrollo de actividades y/o el logro de objetivos.",
        9 =>    "",
    ];

    if($index == 1){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 1. Aplicar en campo la propuesta didáctica en arte y cultura con docentes y directivos docentes </h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 1. Aplicar en campo la propuesta didáctica en arte y cultura con docentes y directivos docentes "])->label(false); ?>
    <?php
    }
    if($index == 2){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 2. Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas.</h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 2. Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas."])->label(false); ?>
    <?php
    }
    if($index == 3){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 3:  Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes.</h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 3:  Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes."])->label(false); ?>
    <?php
    }
    if($index == 4){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 4. Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales.</h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 4. Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales."])->label(false); ?>
    <?php
    }
    if($index == 5){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 5: Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias.</h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 5: Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias."])->label(false); ?>
    <?php
    }
    if($index == 6){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad No. 6: Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas.</h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad No. 6: Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas."])->label(false); ?>
    <?php
    }
    if($index == 7){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 7. Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida.</h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 7. Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida."])->label(false); ?>
    <?php
    }
    if($index == 8){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 8. Realizar talleres de promoción de lectura, escritura y oralidad a familias. </h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 8. Realizar talleres de promoción de lectura, escritura y oralidad a familias."])->label(false); ?>
    <?php
    }
    if($index == 9){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 9. Apoyar el desarrollo de los proyectos institucionales.</h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 9. Apoyar el desarrollo de los proyectos institucionales."])->label(false); ?>
    <?php
    }
    if($index == 10){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 10. Divulgar las experiencias de vínculo de las familias a la escuela. </h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 10. Divulgar las experiencias de vínculo de las familias a la escuela."])->label(false); ?>
    <?php
    }
    if($index == 11){ ?>
        <h3 style='background-color: #ccc;padding:5px;'>Actividad 11. Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas.</h3>
        <?= $form->field($actividades_isa, "[$index]nombre")->hiddenInput(['value'=> "Actividad 11. Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas."])->label(false); ?>
    <?php
    }
    echo $form->field($actividades_isa, "id_actividad")->hiddenInput(['value'=> $index])->label(false);
    //var_dump($datos);
?>

<?= $form->field($actividades_isa, "[$index]total_sesiones_realizadas")->textInput([ 'value' => isset($datos[$index]['total_sesiones_realizadas']) ? $datos[$index]['total_sesiones_realizadas'] : '' ]) ?>
<?= $form->field($actividades_isa, "[$index]avance_sede")->textInput([ 'value' => isset($datos[$index]['avance_sede']) ? $datos[$index]['avance_sede'] : '' ]) ?>
<?= $form->field($actividades_isa, "[$index]avance_ieo")->textInput([ 'value' => isset($datos[$index]['avance_ieo']) ? $datos[$index]['avance_ieo'] : '' ]) ?>
<?= $form->field($actividades_isa, "[$index]documentos_seguimiento")->textInput([ 'value' => isset($datos[$index]['documentos_seguimiento']) ? $datos[$index]['documentos_seguimiento'] : '' ]) ?>
<?= $form->field($actividades_isa, "[$index]documentos_evaluacion")->textInput([ 'value' => isset($datos[$index]['documentos_evaluacion']) ? $datos[$index]['documentos_evaluacion'] : '' ]) ?>

<?php
    foreach( $imps as $keyFase => $imp ){
        
        if($keyFase == 9){
            $contenedores[] = 	[
                'label' 		=>  $imp,
                'content' 		=>  $this->render( 'contenedorItemImp', 
                                                [  
                                                    'form' => $form,
                                                    "model" => $model,
                                                    'actividades_isa' => $actividades_isa,
                                                    'index' => $index,
                                                    'fase' => $keyFase,
                                                    'datos' => $datos,
                                                    'impOps'=> $impOps,
                                                ] 
                                    ),
                //'options' => ['style' => 'display: none;'],
                'contentOptions'=> []
            ];
        }else{
            $contenedores[] = 	[
                'label' 		=>  $imp,
                'content' 		=>  $this->render( 'contenedorItemImp', 
                                                [  
                                                    'form' => $form,
                                                    "model" => $model,
                                                    'actividades_isa' => $actividades_isa,
                                                    'index' => $index,
                                                    'fase' => $keyFase,
                                                    'datos' => $datos,
                                                    'impOps'=> $impOps,
                                                ] 
                                    ),
                'contentOptions'=> []
            ];
        }
        
        
    }
    use yii\bootstrap\Collapse;
    echo Collapse::widget([
        'items' => $contenedores,
    ]);
?>
<?= $form->field($actividades_isa, "[$index]resumen_alertar")->textInput([ 'value' => isset($datos[$index]['resumen_alertar']) ? $datos[$index]['resumen_alertar'] : '' ]) ?>

