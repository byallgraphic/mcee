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
    
    $contenedores = [];
    $actividades =[
        1 => "Aplicar en campo la propuesta didáctica en arte y cultura con docentes y directivos docentes",
        2 => "Realizar Seminario sobre arte y cultura para fortalecer competencias básicas en las instituciones educativas. ",
        3 => "Aplicar en campo la propuesta didáctica en arte y cultura con estudiantes ",
        4 => "Realizar difusión y promoción de las jornadas didácticas de competencias en las instituciones educativas oficiales.",
        5 => "Realizar proyectos extra clase mediante clubes de fortalecimiento de competencias.",
        6 => "Realizar estrategia de promoción de la consulta sobre arte, cultura, promoción de lectura y escritura para fortalecimiento de competencias básicas.",
        7 => "Realizar visitas pedagógicas que favorezcan el desarrollo de competencias básicas  y habilidades para la vida.",
        8 => "Realizar talleres de promoción de lectura, escritura y oralidad a familias.",
        9 => "Apoyar el desarrollo de los proyectos institucionales",
        10 => "Divulgar las experiencias de vínculo de las familias a la escuela. ",
        11 => "Realizar seguimiento y evaluación de las acciones desarrolladas con las familias de las instituciones educativas.",
        12 => ""
    ];


    if($index == 1){
        echo "<h3 style='background-color: #ccc;padding:5px;'>Instituciones educativas con prácticas de aula de los docentes a través de la integración de estrategias y métodos provenientes de las artes y la cultura.</h3>";
    }
    if($index == 2){
        echo "<h3 style='background-color: #ccc;padding:5px;'>Estudiantes de instituciones educativas oficiales participantes en procesos formativos para fortalecer competencias básicas.</h3>";
    }
    if($index == 3){
        echo "<h3 style='background-color: #ccc;padding:5px;'>Instituciones educativas que integran acciones que vinculan a las familias al proceso formativo de los estudiantes de las IEO, desarrollados</h3>";
    }
?>


    <?= $form->field($imp_misional, "[$index]mison")->textInput([ 'value' => isset($datos[$index]['mison']) ? $datos[$index]['mison'] : '' ]) ?>
    <?= $form->field($imp_misional, "[$index]descripcion")->textInput([ 'value' => isset($datos[$index]['descripcion']) ? $datos[$index]['descripcion'] : '' ]) ?>
    <?= $form->field($imp_misional, "[$index]hallazgo")->textInput([ 'value' => isset($datos[$index]['hallazgo']) ? $datos[$index]['hallazgo'] : '' ]) ?>

    <?php
        foreach( $actividades as $keyFase => $actividad ){
            
            if($index ==  1 && $keyFase <= 2){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividadMisional' => $actividadMisional,
                                                        'index' => $keyFase,
                                                        'datos' => $datos
													] 
										),
					'contentOptions'=> []
				];
            }
            else if($index ==  2 && $keyFase > 2 && $keyFase <= 7){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividadMisional' => $actividadMisional,
                                                        'index' => $keyFase,
                                                        'datos' => $datos
													] 
										),
					'contentOptions'=> []
				];
            }
            else if($index ==  3 && $keyFase == 12){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividadMisional' => $actividadMisional,
                                                        'index' => $keyFase,
                                                        'datos' => $datos
													] 
                                        ),
                    'options' => ['style' => 'display: none;'],
					'contentOptions'=> []
				];
            }
            else if($index ==  3 && $keyFase > 7){
                $contenedores[] = 	[
					'label' 		=>  $actividad,
					'content' 		=>  $this->render( 'contenedorItem', 
													[  
                                                        'form' => $form,
                                                        "model" => $model,
                                                        'actividadMisional' => $actividadMisional,
                                                        'index' => $keyFase,
                                                        'datos' => $datos
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
    

    <h3 style='background-color: #ccc;padding:5px;'>INDICADORES DE RESULTADO</h3>
    <?= $form->field($imp_misional, "[$index]sedes_institucion_1")->textInput([ 'value' => isset($datos[$index]['sedes_institucion_1']) ? $datos[$index]['sedes_institucion_1'] : '' ]) ?>
    <?= $form->field($imp_misional, "[$index]sedes_institucion_2")->textInput([ 'value' => isset($datos[$index]['sedes_institucion_2']) ? $datos[$index]['sedes_institucion_2'] : '' ]) ?>
    <?= $form->field($imp_misional, "[$index]docentes_institucion_1")->textInput([ 'value' => isset($datos[$index]['docentes_institucion_1']) ? $datos[$index]['docentes_institucion_1'] : '' ]) ?>
    <?= $form->field($imp_misional, "[$index]docentes_institucion_2")->textInput([ 'value' => isset($datos[$index]['docentes_institucion_2']) ? $datos[$index]['docentes_institucion_2'] : '' ]) ?>

    <h3 style='background-color: #ccc;padding:5px;'>Cuál es el % del estado general de  promover del acompañamiento de padres de familia desde el arte y la cultura en el proceso de fortalecimiento de competencias básicas de estudiantes de las IEO.</h3>
    <?= $form->field($imp_misional, "[$index]avance_sede")->textInput([ 'value' => isset($datos[$index]['avance_sede']) ? $datos[$index]['avance_sede'] : '' ]) ?>
    <?= $form->field($imp_misional, "[$index]avance_ieo")->textInput([ 'value' => isset($datos[$index]['avance_ieo']) ? $datos[$index]['avance_ieo'] : '' ]) ?>
    <?= $form->field($imp_misional, "[$index]componente_id")->hiddenInput(['value'=> $index])->label(false); ?>



