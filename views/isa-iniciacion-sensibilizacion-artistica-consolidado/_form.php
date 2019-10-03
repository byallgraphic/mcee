<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use dosamigos\datepicker\DatePicker;

use yii\bootstrap\Collapse;

use yii\helpers\Url;

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

if( !$sede ){
	
	exit( "<div class='btn-danger' style='font-size:20pt;text-align:center;width:100%;'>Por favor seleccione una sede</div>" );
}

$fecha_desde 	= empty( $_POST['fecha_desde'] ) ? '' : $_POST['fecha_desde'];
$modelEncabezado->fecha = $fecha_desde;

/* @var $this yii\web\View */
/* @var $model app\models\IsaIniciacionSensibilizacionArtisticaConsolidado */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/modal.css", ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

$form = ActiveForm::begin(['action' => Url::to( ['create'] )]);



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
	
	<div class="row">
	  <div class="col-md-6"><?= $form->field($modelEncabezado, 'fecha')->widget(
        DatePicker::className(), [
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'language' => 'es',
            'clientOptions' => [
                'autoclose' => true,
                'format'    => 'yyyy-mm',
				'minViewMode'=>'months',
        ],
    ]); ?></div>
	 <!-- <div class="col-md-6"><?= $form->field($modelEncabezado, 'periodo')->textInput([ 'type' => 'number']) ?></div> -->
	</div>
    
	<?= Html::activeHiddenInput($modelEncabezado, 'id') ?>
	
    <div class="row">
	  <div class="col-md-8"><?= $form->field($modelEncabezado, 'id_institucion')->dropDownList( [ $institucion->id => $institucion->descripcion ] ) ?></div>
	  <div class="col-md-4"></div>
	</div>
	
    <div class="row">
	  <div class="col-md-8"><?= $form->field($modelEncabezado, 'id_sede')->dropDownList([ $sede->id => $sede->descripcion ]) ?></div>
	  <div class="col-md-4"></div>
	</div>


	<?= Collapse::widget([
		'items' => $items,
		'options' => [ "id" => "collapseOne" ],
	]); ?>
	
	<div class="row">
	  <div class="col-md-6"><?= Html::label( "Porcentaje de Avance por Sede" ) ?>
		
		<?= Html::textInput( "total_porcentaje_sede", "", [ 
					"class" 		=> "form-control", 
					"style" 		=> "background-color:#eee",
					"disabled" 		=> true, 
					"id" 			=> "total_porcentaje_sede", 
				] ) ?></div>
	  <div class="col-md-6"><?= Html::label( "Porcentaje de Avance por IEO" ) ?>
		
		<?= Html::textInput( "total_porcentaje_sede", "", [ 
					"class" 		=> "form-control", 
					"style" 		=> "background-color:#eee",
					"disabled" 		=> true, 
					"id" 			=> "total_porcentaje_ieo", 
				] ) ?></div>
	</div>
	
    

    <?php ActiveForm::end(); ?>

</div>
