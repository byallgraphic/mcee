<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

use yii\bootstrap\Collapse;

$this->registerJsFile(
    '@web/js/isaIniciacionSensibilizacionArtisticaConsolidado.js',
    [
		'depends' => [
						\yii\web\JqueryAsset::className(),
						\dosamigos\editable\EditableBootstrapAsset::className(),
					]
	]
);

if( $guardado ){
	
	$this->registerJsFile("https://unpkg.com/sweetalert/dist/sweetalert.min.js");
	
	$this->registerJs( "
	  swal({
			text: 'Registro guardado',
			icon: 'success',
			button: 'Salir',
		});" 
	);
}

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSensibilizacionArtisticaConsolidado */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$form = ActiveForm::begin();

$items = [];

foreach( $actividades as $keySesion => $actividad )
{
	$items[] = 	[
					'label' 		=>  "Actividad ".$actividad->orden.". ".$actividad->descripcion,
					'content' 		=>  $this->render( 'actividades',
											[
												'actividad' => $models[$actividad->id],
												'form' 		=> $form,
												'index'		=> $actividad->id,
											]
										),
					'contentOptions'=> [],
				];
}

?>

<div class="isa-iniciacion-sensibilizacion-artistica-consolidado-form">

    <?= $form->field($modelEncabezado, 'fecha')->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm-dd',
        ],
    ]); ?>

    <?= $form->field($modelEncabezado, 'periodo')->textInput() ?>
	
    <?= $form->field($modelEncabezado, 'id_institucion')->dropDownList( [ $institucion->id => $institucion->descripcion ] ) ?>

    <?= $form->field($modelEncabezado, 'id_sede')->dropDownList([ $sede->id => $sede->descripcion ]) ?>

	<?= Collapse::widget([
		'items' => $items,
		'options' => [ "id" => "collapseOne" ],
	]); ?>
	
	<div class="form-group">
	
		<?= Html::label( "Porcentaje de Avance por Sede" ) ?>
		
		<?= Html::textInput( "total_porcentaje_sede", "", [ 
					"class" 		=> "form-control", 
					"style" 		=> "background-color:#eee",
					"disabled" 		=> true, 
					"id" 			=> "total_porcentaje_sede", 
				] ) ?>
		
	</div>
	
	<div class="form-group">
	
		<?= Html::label( "Porcentaje de Avance por IEO" ) ?>
		
		<?= Html::textInput( "total_porcentaje_sede", "", [ 
					"class" 		=> "form-control", 
					"style" 		=> "background-color:#eee",
					"disabled" 		=> true, 
					"id" 			=> "total_porcentaje_ieo", 
				] ) ?>
		
	</div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
