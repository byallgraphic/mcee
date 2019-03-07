<?php

/**********
Modificaciones:
Fecha: 2019-01-22
Persona encargada: Edwin Molina Grisales
Cambios realizados: Si no se ha seleccionado una sede, se pide
---------------------------------------
**********/


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\bootstrap\Collapse;

use dosamigos\datepicker\DatePicker;
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */
/* @var $form yii\widgets\ActiveForm */

if( !$sede ){
	$this->registerJs( "$( cambiarSede ).click()" );
	return;
}

$idTipoInforme = $_GET['idTipoInforme'];

$connection = Yii::$app->getDb();
		$command = $connection->createCommand(
		"
			select p.id
			from ec.tipo_informe as ti, ec.componentes as c, ec.proyectos as p
			where ti.id = $idTipoInforme
			and ti.id_componente = c.id
			and c.descripcion = p.descripcion
			
		");
		$ecProyectos = $command->queryAll();
		

//colores del acordeon
		$arrayColores = array
		(
			1=>"panel panel-danger",
			3=>"panel panel-info",
			2=>"panel panel-success",
			4=>"panel panel-warning"
		);
		
		$color = $arrayColores[$ecProyectos[0]['id']];
		

?>

<div class="ec-datos-basicos-form">

    <?php $form = ActiveForm::begin([ 'layout' => 'horizontal']); ?>

    <?= $form->field($modelDatosBasico, 'profesional_campo')->dropDownList( $profesional, [ 'prompt' => 'Seleccione...' ] ) ?>

    <?= $form->field($modelDatosBasico, 'id_institucion')->dropDownList( [ $institucion->id => $institucion->descripcion ] ) ?>

    <?= $form->field($modelDatosBasico, 'id_sede')->dropDownList( [ $sede->id => $sede->descripcion ] ) ?>

	<?= $form->field($modelDatosBasico, 'fecha_diligenciamiento')->widget(
					DatePicker::className(), [
						
						 // modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'dd-mm-yyyy'
						]
				]); ?>

    <?php // echo $form->field($modelDatosBasico, 'estado')->textInput(); ?>
	
	
	<?= Collapse::widget([
		'items' => [
						[
							'label' 		=>  'AGREGANDO PLANEACIÓN MISIONAL',
							
							'content' 		=>  $this->render( 'planeacionMisional', [ 
														'form' 				=> $form,
														'modelPlaneacion' 	=> $modelPlaneacion,
														'modelVerificacion' => $modelVerificacion,
														'modelReportes' 	=> $modelReportes,
														'tiposVerificacion'	=> $tiposVerificacion,
														'modelDatosBasico' => $modelDatosBasico,
														'idTipoInforme' => $idTipoInforme,
														
												] ),
								'contentOptions' => ['class' => 'in'],
								'options' => ['class' => $color]
						]
					] 
				]); ?>
	
	<?php $this->render( 'planeacionMisional', [ 
			'form' 				=> $form,
			'modelPlaneacion' 	=> $modelPlaneacion,
			'modelVerificacion' => $modelVerificacion,
			'modelReportes' 	=> $modelReportes,
			'tiposVerificacion'	=> $tiposVerificacion,
			'modelDatosBasico' => $modelDatosBasico,
			'idTipoInforme' => $idTipoInforme,
	] ); ?>
		
    <div class="form-group" style="text-align: -webkit-center;">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
