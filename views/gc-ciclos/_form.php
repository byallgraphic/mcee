<?php
/**********
Versión: 001
Fecha: 2019-01-29
Desarrollador: Edwin Molina Grisales
Descripción: Ciclos
---------------------------------------
**********/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use nex\chosen\Chosen;
use dosamigos\datepicker\DatePicker;

use app\models\GcSemanas;

/* @var $this yii\web\View */
/* @var $model app\models\GcCiclos */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);


//Creo un objeto Json con el nombre del formulario que se forma y los atributos de la tabla
$jsModelSemana = [
	'formName'	=> $modelSemanas[0]->formName(),
	'attributes'=> $modelSemanas[0]->attributes(),
];

//Registro el js (gc-ciclos.j)
$this->registerJs( "var modelSemana = ".\yii\helpers\Json::htmlEncode( $jsModelSemana ).";" );
$this->registerJs( "var totalSemanas = ".( count( $modelSemanas )-1 ).";" );
$this->registerJs( file_get_contents( '../web/js/gc-ciclos.js' ) );
?>




<div class="gc-ciclos-form">

    <?php $form = ActiveForm::begin([
						'layout' => 'horizontal' 
					]); ?>
					
	<?= Html::activeHiddenInput( $modelCiclo, "id" ) ?>

    <?= $form->field($modelCiclo, 'fecha')->widget(
		DatePicker::className(), [
			
			 // modify template for custom rendering
			'template' => '{addon}{input}',
			'language' => 'es',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'yyyy-mm-dd'
			]
	]); ?>

    <?= $form->field($modelCiclo, 'descripcion')->textarea() ?>

    <?= $form->field($modelCiclo, 'fecha_inicio')->widget(
		DatePicker::className(), [
			
			 // modify template for custom rendering
			'template' => '{addon}{input}',
			'language' => 'es',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'yyyy-mm-dd'
			]
	]); ?>

    <?= $form->field($modelCiclo, 'fecha_finalizacion')->widget(
		DatePicker::className(), [
			
			 // modify template for custom rendering
			'template' => '{addon}{input}',
			'language' => 'es',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'yyyy-mm-dd'
			]
	]); ?>

    <?= $form->field($modelCiclo, 'fecha_cierre')->widget(
		DatePicker::className(), [
			
			 // modify template for custom rendering
			'template' => '{addon}{input}',
			'language' => 'es',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'yyyy-mm-dd'
			]
	]); ?>

    <?= $form->field($modelCiclo, 'fecha_maxima_acceso')->widget(
		DatePicker::className(), [
			
			 // modify template for custom rendering
			'template' => '{addon}{input}',
			'language' => 'es',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'yyyy-mm-dd'
			]
	]); ?>

    <?= $form->field($modelCiclo, 'id_creador')->widget(
				Chosen::className(), [
					'items' => $docentes,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => false,
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			]); ?>
	
	<?= Html::activeHiddenInput( $modelBitacora, "id" ) ?>
	
	<?= $form->field( $modelDocentesXBitacora, "docente" )->widget(
				Chosen::className(), [
					'items' => $docentes,
					'disableSearch' => 5, // Search input will be disabled while there are fewer than 5 items
					'multiple' => true,
					'clientOptions' => [
						'search_contains' => true,
						'single_backstroke_delete' => false,
					]
			]); ?>

			
	<div id='dv-btn-Semanas' style='background-color:#;padding:5px;'>
		
		<div>
			 <div class="form-group text-right"'>
				<?= Html::button('Agregar semana', ['class' => 'btn btn-success btn-add-semanas']) ?>
				<?= Html::button('Eliminar semana', ['class' => 'btn btn-danger btn-remove-semanas']) ?>
			</div>
		</div>
	
	</div>
	
	<div id='dvSemanas' style='background-color:#eee;'>
		
		<?php foreach( $modelSemanas as $index => $modelSemana ) : ?>
		
			<div id='dv-semana-0' style='background-color:#eee;padding:5px;'>
				
				<div id='semana-title' style='font-size:18pt;background-color:#3c8dbc;padding:0 5px 0;'>
					Semana <?= $index ?>
				</div>
				
				<div class='semana-contenido' style='padding:5px;'>
				
					<?= Html::activeHiddenInput( $modelSemana, '['.$index.']id' ) ?>
		
					<?= $form->field($modelSemana, '['.$index.']fecha_inicio')->widget(
						DatePicker::className(), [
							
							 // modify template for custom rendering
							'template' => '{addon}{input}',
							'language' => 'es',
							'clientOptions' => [
								'autoclose' => true,
								'format' => 'yyyy-mm-dd'
							]
					]); ?>
					
					<?= $form->field($modelSemana, '['.$index.']fecha_finalizacion')->widget(
						DatePicker::className(), [
							
							 // modify template for custom rendering
							'template' => '{addon}{input}',
							'language' => 'es',
							'clientOptions' => [
								'autoclose' => true,
								'format' => 'yyyy-mm-dd'
							]
					]); ?>
					
					<?= $form->field($modelSemana, '['.$index.']fecha_cierre')->widget(
						DatePicker::className(), [
							
							 // modify template for custom rendering
							'template' => '{addon}{input}',
							'language' => 'es',
							'clientOptions' => [
								'autoclose' => true,
								'format' => 'yyyy-mm-dd'
							]
					]); ?>
					
					<?= $form->field($modelSemana, '['.$index.']descripcion')->textarea(); ?>
				
				</div>
				
			</div>
		
		<?php endforeach; ?>
		
	</div>
			
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'btn-guardar' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>