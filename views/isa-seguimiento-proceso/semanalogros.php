<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;
use app\models\IsaSemanaLogros;
use app\models\IsaOrientacionMetodologicaActividades;


$semanLogros = new IsaSemanaLogros();

$orientacion = new IsaOrientacionMetodologicaActividades();

// echo "<pre>"; print_r($datos); echo "</pre>"; 

// die;

?>

<div class="container-fluid">
            <div class="ieo-form">
			
				<div class="row">
					
					<div id="<?= $idLogros;?>_logros"></div>
				 
				</div>  
                 
                <div class="row">
				  <div class="col-md-8"><?= $form->field($orientacion, "[$idLogros]descripcion")->textarea(['rows' => '3', 'value' => $datos['OrientacionMetodologicaActividades'][$idActividad][$idLogros]['descripcion'] ])->label("ORIENTACION METODOLÓGICA")?></div>
				  <div class="col-md-4"></div>
				</div> 

					<?= $form->field($semanLogros, "[$idLogros]id_logros_actividades")->hiddenInput( [ 'value' => $idLogros ] )->label(false ) ?>
                    <?= $form->field($semanLogros, "[$idLogros]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
					<?= $form->field($orientacion, "[$idLogros]id_actividades")->hiddenInput( [ 'value' => $idActividad ] )->label(false ) ?>
					<?= $form->field($orientacion, "[$idLogros]id_logros")->hiddenInput( [ 'value' => $idLogros ] )->label(false ) ?>
					
			</div>
</div>