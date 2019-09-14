<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\EcDatosBasicos */
/* @var $form yii\widgets\ActiveForm */

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
			1=>"bg-danger",
			3=>"bg-info",
			2=>"bg-success",
			4=>"bg-warning"
		);
		
		$color = $arrayColores[$ecProyectos[0]['id']];


?>


	

	<div class='content-fluid'>
				
				<h1 class='<?php echo $color; ?>'><?= Html::encode("Planeación misional") ?></h1>

				<?= $form->field($modelPlaneacion, 'tipo_actividad')->dropDownList( [  'Mesa de trabajo', 'Acompañamiento a la práctica', 'Salidas pedagógicas', 'Evento de ciudad' ], [ 'prompt' => 'Seleccione...' ] ) ?>
				
				<?= $form->field($modelPlaneacion, 'fecha')->widget(
					DatePicker::className(), [
						
						 // modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'dd-mm-yyyy'
						]
				]); ?>

				<?= $form->field($modelPlaneacion, 'objetivo')->textarea() ?>

				<?= $form->field($modelPlaneacion, 'responsable')->textInput() ?>

				<?= $form->field($modelPlaneacion, 'rol')->textInput() ?>
				
				<?= $form->field($modelPlaneacion, 'descripcion_actividad')->textarea() ?>
				
				<h1 class='<?php echo $color; ?>'><?= Html::encode( "Tipo actor - Cantidad asistentes" ) ?></h1>
				
				<div class="cantidades" style="margin-left: 30px;">
					<div class="row" style='text-align:center;'>
							<div class="col-sm-3" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px;'>Estudiantes</span>
						</div>
						<div class="col-sm-3" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Familias</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Docentes</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Directivos</span>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<span total class='form-control' style='background-color:#ccc;height:70px'>Otros</span>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-3" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "estudiantes", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
						<div class="col-sm-3" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "familias", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "docentes", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "directivos", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
						<div class="col-sm-2" style='padding:0px;'>
							<?=  Html::activeTextInput($modelPlaneacion, "otros", [ 'type' => 'number', 'class' => "form-control"] ) ?>
						</div>
					</div>
				</div>
				<br>
				
				<h1 class='<?php echo $color; ?>'><?= Html::encode( "Medios de verificación y productos" ) ?></h1>
				
				
				<?= $form->field($modelVerificacion, "[1]tipo_verificacion")->dropDownList( $tiposVerificacion, ['prompt' => 'Seleccione...' ] ) ?>
				
				<?php 
				
					if( count($rutasArchivos) > 0 ){
						
						echo "<div>";
						echo "<div class='text-center'><h4>Archivos cargados previamente</h4></div>";
				
						foreach( $rutasArchivos as $key => $archivo )
						{
							echo "<div style='display:flex;align-items:stretch;flex-direction: row;justify-content: center;'>";
							
							$content = Html::a( substr( $archivo->ruta_archivo, -20 ), $archivo->ruta_archivo ).'<br>';
							$span = Html::tag( 'span', '', 	[ 
																'class' 	=> 'glyphicon glyphicon-remove', 
																'style' 	=> 'color: red;', 
																'onClick' 	=> 'removeFile( this, '.$archivo->id.')', 
															] );
							
							echo Html::tag( 'div', $content, [ 'style' => 'margin:0 10px' ] );
							echo Html::tag( 'div', $span, [ 'style' => 'margin:0 10px' ] );
							
							echo "</div>";
						}
						
						echo "</div>";
					}
				?>
				
				<?= $form->field($modelVerificacion, "[1]ruta_archivo[]")->fileInput(['multiple' => true,  'accept' => ".doc, .docx, .pdf, .xls" ]) ?>

				
			
			
			
			
			
				<h1 class='<?php echo $color; ?>'><?= Html::encode( "Reportes" ) ?></h1>
				
				<?= $form->field($modelReportes, 'fecha_diligenciamiento')->widget(
					DatePicker::className(), [
						
						 // modify template for custom rendering
						'template' => '{addon}{input}',
						'language' => 'es',
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'dd-mm-yyyy'
						]
				]); ?>
				
				
				
				<?= $form->field($modelReportes, 'ejecutado')->textInput() ?>
				
				<?= $form->field($modelReportes, 'no_ejecutado')->textInput() ?>
				
				<?= $form->field($modelReportes, 'variaciones')->textInput() ?>
				
				<?= $form->field($modelReportes, 'observaciones')->textarea() ?>
			
			
		
	</div>
