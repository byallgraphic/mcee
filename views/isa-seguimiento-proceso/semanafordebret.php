<?php
/* @var $this yii\web\View */
/* @var $model app\models\Ieo */
/* @var $form yii\widgets\ActiveForm */


use app\models\EcAvances;
use yii\widgets\ActiveForm;
use app\models\IsaSemanaLogrosForDebRet;
use app\models\IsaOrientacionMetodologicaVariaciones;


$semanLogros = new IsaSemanaLogrosForDebRet();
$orientacion = new IsaOrientacionMetodologicaVariaciones();
// echo $idVariaciones;
// echo "<pre>"; var_dump($datos['OrientacionMetodologicaVariaciones'][$idVariaciones][$idIsaForDebRet]['descripcion']); echo "</pre>";

// die;
?>

<div class="container-fluid">
            <div class="ieo-form">
			
				<div class="row">
					<div id="<?= $idIsaForDebRet;?>_logrosVariciones"></div>
				</div>
				
                <div class="row">
				  <div class="col-md-8"><?= $form->field($orientacion, "[$idIsaForDebRet]descripcion")->textarea(['rows' => '3' ])->label("ORIENTACION METODOLÓGICA")?></div>
				  <div class="col-md-4"></div>
				</div>  
                    
                    <?= $form->field($semanLogros, "[$idIsaForDebRet]id_for_deb_ret")->hiddenInput( [ 'value' => $idIsaForDebRet ] )->label(false ) ?>
                    <?= $form->field($semanLogros, "[$idIsaForDebRet]estado")->hiddenInput( [ 'value' => '1' ] )->label(false ) ?>
					
					
					<?= $form->field($orientacion, "[$idIsaForDebRet]id_variaciones_actividades")->hiddenInput( [ 'value' => $idVariaciones ] )->label(false ) ?>
					<?= $form->field($orientacion, "[$idIsaForDebRet]id_for_deb_ret")->hiddenInput( [ 'value' => $idIsaForDebRet ] )->label(false ) ?>
            </div>
</div>